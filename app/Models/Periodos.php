<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function fechas(){       
        return $this->belongsToMany(Fechas::class,'periodos');
    }
}
