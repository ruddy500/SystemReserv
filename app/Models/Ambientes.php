<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function horarios(){

        //primer parametro es el modelo con el que se relaciona 
        //y el segundo parametro es la tabla por el cual se relacionan
        return $this->belongsToMany(Horarios::class,'ambiente_horario', 'AmbienteId', 'HorarioId');
    }

    public function nombreambiente() {
        return $this->hasOne(NombreAmbientes::class,'nombre_ambientes_id', 'id');
    }
}
