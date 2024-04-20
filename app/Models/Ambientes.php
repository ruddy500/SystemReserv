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
        return $this->belongsTo(NombreAmbientes::class, 'nombre_ambientes_id');
    }

    public function reserva(){
        return $this->belongsTo(Reservas::class, 'reservas_id');
    }

}
