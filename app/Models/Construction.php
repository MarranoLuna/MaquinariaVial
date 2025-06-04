<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_construction';
    protected $fillable = ['name', 'id_province', 'start_date', 'end_date'];

     protected $casts = [
        'start_date' => 'date', 
        'end_date' => 'date', 
    ];

    public function assignments() 
    {
        return $this->hasMany(Assignment::class, 'id_construction', 'id_construction');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province', 'id_province');
    }
}
