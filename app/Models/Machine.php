<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Machine extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_machine';
    protected $fillable = ['serial_number', 'id_type', 'id_brand', 'kilometers'];

    public function brand()
    {
        return $this->belongsTo(MachineBrand::class, 'id_brand', 'id_brand');
    }

    public function type()
    {
        return $this->belongsTo(MachineType::class, 'id_type', 'id_type');
    }

    public function serviceMachines()
    {
        return $this->hasMany(ServiceMachine::class, 'id_machine', 'id_machine');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'id_machine', 'id_machine');
    }

    public function activeAssignment()
    {
        return $this->hasOne(Assignment::class, 'id_machine', 'id_machine')->whereNull('end_date');
    }

     public function activeMaintenance()
    {
        $now = Carbon::now()->toDateString(); 
        return $this->hasOne(ServiceMachine::class, 'id_machine', 'id_machine')
                    ->where('start_date', '<=', $now) 
                    ->where('end_date', '>=', $now); 
    }
}