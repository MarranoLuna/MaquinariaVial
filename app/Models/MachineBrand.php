<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineBrand extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_brand';
    protected $fillable = ['brand']; 

    public function machines()
    {
        return $this->hasMany(Machine::class, 'id_brand', 'id_brand');
    }
}
