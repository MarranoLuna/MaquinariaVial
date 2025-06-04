<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_province';
    protected $fillable = ['name'];

    public function constructions()
    {
        return $this->hasMany(Construction::class, 'id_province', 'id_province');
    }

}
