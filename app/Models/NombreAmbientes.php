<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreAmbientes extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function ambiente() {
        return $this->hasOne(Ambientes::class, 'nombre_ambientes_id');
    }

}
