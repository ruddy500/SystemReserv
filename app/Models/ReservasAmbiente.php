<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasAmbiente extends Model
{
    use HasFactory; 
    public $timestamps = false; 
    protected $table = 'reservas_ambiente';
}
