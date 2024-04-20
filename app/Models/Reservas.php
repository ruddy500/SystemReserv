<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function docente(){
        return $this->belongsTo(Usuarios::class, 'docentes_id');
    }

    public function ambientes(){
        return $this->hasMany(Ambientes::class, 'reservas_id');
    }

    public function materiasSeleccionado(){
        return $this->hasMany(MateriasSeleccionado::class, 'reservas_id');
    }

    public function periodosSeleccionado(){
        return $this->hasMany(PeriodosSeleccionado::class, 'reservas_id');
    }
    
}
