<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosNotificacion extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $table = 'usuarios_notificacion';
}
