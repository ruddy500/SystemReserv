<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function horarios(){
        /**
         * Esta línea de código define una relación muchos a muchos entre los modelos 
         * Ambientes y Horarios, utilizando una tabla pivot llamada ambiente_horario, 
         * donde AmbienteId y HorarioId son las claves externas que vinculan los registros
         *  de ambas tablas en la tabla pivot 
         * */

        return $this->belongsToMany(Horarios::class,'ambiente_horario', 'AmbienteId', 'HorarioId');
    } 

    public function nombreambiente() {
        /**
         * La función nombreambiente() establece una relación de pertenencia con el 
         * modelo NombreAmbientes. Esto significa que cada instancia de este modelo "pertenece a" 
         * un registro en el modelo NombreAmbientes, identificado por la columna 'nombre_ambientes_id'
         */
        return $this->belongsTo(NombreAmbientes::class, 'nombre_ambientes_id');
    }

}
