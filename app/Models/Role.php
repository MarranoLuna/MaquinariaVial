<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_role';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role', 
    ];

    /**
     * Indica si el modelo debe tener timestamps.
     * Laravel los maneja por defecto (created_at y updated_at).
     * Si tu tabla 'roles' no tiene estos campos, establece esto a false.
     * Por tus migraciones anteriores, sí los tenías.
     *
     * @var bool
     */
    public $timestamps = true; // O false si no tienes created_at/updated_at en la tabla roles

    /**
     * Los usuarios que pertenecen a este rol.
     * Define la relación muchos a muchos con el modelo User.
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,      
            'user_roles',    
            'id_role',        
            'id_user',       
            'id_role',        
            'id_user'         
        );
    }
}
