<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function docentes(){
        return $this->belongsToMany(Usuarios::class, 'docentes_materias','docentes_id', 'materias_id');
    }
}
