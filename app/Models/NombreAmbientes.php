<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreAmbientes extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function ambientes() {
        /**
         * La función ambiente() establece una relación de pertenencia con el 
         * modelo Ambientes. Esto significa que cada instancia de este modelo "pertenece a" 
         * un registro en el modelo Ambientes, identificado por la columna 'nombre_ambientes_id'
         */
        return $this->hasMany(Ambientes::class, 'nombre_ambientes_id');
    }

}
