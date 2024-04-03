<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dias extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function periodos(){

        //primer parametro es el modelo con el que se relaciona 
        //y el segundo parametro es la tabla por el cual se relacionan
        return $this->belongsToMany(Periodos::class, 'horarios','DiaId', 'PeriodoId')->withPivot('Estado');
    }
    
}
