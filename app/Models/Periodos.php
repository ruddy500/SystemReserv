<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function dias(){
        /**
         * Esta línea de código define una relación muchos a muchos entre los modelos 
         * Periodos y Dias, utilizando una tabla pivot llamada horarios, 
         * donde PeriodoId y DiaId son las claves externas que vinculan los registros
         * de ambas tablas en la tabla pivot . withPivot('Estado'): Con esta función 
         * recuperamos los datos adicionales de la tabla intermedia 'horarios',
         * en este caso el atributo 'Estado'
         * */
        return $this->belongsToMany(Dias::class,'periodos');
    }
}
