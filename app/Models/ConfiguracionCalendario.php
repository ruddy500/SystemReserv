<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionCalendario extends Model
{
    use HasFactory;
    protected $table = 'configuracion_calendarios';
    public $timestamps = false;
}
