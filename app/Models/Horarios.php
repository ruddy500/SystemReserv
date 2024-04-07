<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function ambientes(){ //estoy cambiando el nombre de dias a ambientes
         /**
         * Esta línea de código define una relación muchos a muchos entre los modelos 
         * Horarios y Ambientes, utilizando una tabla pivot llamada hambiente_horarios, 
         * donde HorarioId y AmbienteId son las claves externas que vinculan los registros
         * de ambas tablas en la tabla pivot
         * */
        return $this->belongsToMany(Ambientes::class,'ambiente_horario','HorarioId','AmbienteId');

}
}


