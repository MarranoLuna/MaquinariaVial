<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_service';
    protected $fillable = ['service', 'kilometers'];

    public function serviceMachines()
    {
        return $this->hasMany(ServiceMachine::class, 'id_service', 'id_service');
    }
}
