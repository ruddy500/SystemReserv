<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function horarios(){
        
        return $this->hasMany(Horarios::class,'ambientes_id');

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
