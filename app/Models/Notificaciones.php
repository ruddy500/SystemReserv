<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;
    public $timestamps = false; 

    public function usuarios(){
        return $this->belongsToMany(Usuarios::class,'usuarios_notificacion');
    }

    

}
