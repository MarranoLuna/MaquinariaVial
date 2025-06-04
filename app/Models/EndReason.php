<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndReason extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_reason';
    protected $fillable = ['reason'];

    public function assignments() 
    {
        return $this->hasMany(Assignment::class, 'id_reason', 'id_reason');
    }
}
