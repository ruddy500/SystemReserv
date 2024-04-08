<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function ambiente(){
       
        return $this->belongsTo(Ambientes::class,'ambientes_id' );
    }
    
}
