<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriasSeleccionado extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function reserva(){
        return $this->belongsTo(Reservas::class, 'reservas_id');
    }
}
