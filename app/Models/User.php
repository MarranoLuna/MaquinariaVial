<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname', 
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token', // Si tu tabla users tiene remember_token
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Si tu tabla users tiene email_verified_at
            'password' => 'hashed',
        ];
    }

    // Relación muchos a muchos con Role
    // Esta es la forma estándar y recomendada
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'id_user', 'id_role', 'id_user', 'id_role');
    }
}
