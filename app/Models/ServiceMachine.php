<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Debería ser Relations\Pivot si la usas como pivot en belongsToMany


class ServiceMachine extends Model 
{
    use HasFactory;
    protected $table = 'service_machines'; 
    protected $primaryKey = 'id_service_machine';
    protected $fillable = [
        'id_service',
        'id_machine',
        'description',
        'kilometers_at_service',
        'start_date',        
        'end_date',
    ];


    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',   
    ];


    public function machine()
    {
        return $this->belongsTo(Machine::class, 'id_machine', 'id_machine');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}
