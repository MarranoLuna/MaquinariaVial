<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_assignment';
    protected $fillable = ['id_construction', 'id_machine', 'id_reason', 'kilometers','start_date','end_date'];

    protected $casts = [
        'start_date' => 'date', 
        'end_date' => 'date', 
    ];


    public function construction()
    {
        return $this->belongsTo(Construction::class, 'id_construction', 'id_construction');
    }

    public function endReason()
    {
        return $this->belongsTo(EndReason::class, 'id_reason', 'id_reason');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'id_machine', 'id_machine');
    }
}
