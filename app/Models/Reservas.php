<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    protected $fillable = [
        'CantEstudiante',
        'TotalEstudiantes',
        'Tipo',
        'Estado',
        'fecha',
        'TipoAmbiente',
        'Fuesugerido',
        'motivos_id',
        'docentes_grupal', // Asegúrate de que esto esté en los fillables
    ];
    protected $casts = [
        'docentes_grupal' => 'array', // Esto permite que Laravel maneje automáticamente el almacenamiento como JSON
    ];
    
    public $timestamps = false;
    protected $table = 'reservas';

    
    public function docente(){
        return $this->belongsTo(Usuarios::class, 'docentes_id');
    }

    public function ambientes(){
        return $this->belongsToMany(Ambientes::class,'reservas_ambiente');
    }

    public function materiasSeleccionado(){
        return $this->hasMany(MateriasSeleccionado::class, 'reservas_id');
    }

    public function periodosSeleccionado(){
        return $this->hasMany(PeriodosSeleccionado::class, 'reservas_id');
    }

    public function motivo() {
        return $this->belongsTo(Motivos::class, 'motivos_id');
    }
    
}
