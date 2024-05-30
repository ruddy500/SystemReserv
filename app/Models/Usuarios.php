<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuarios extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;




    public function materias(){
        return $this->belongsToMany(Materias::class, 'docentes_materias','docentes_id','materias_id');
    }
    
    public function reservas(){
        return $this->hasMany(Reservas::class, 'docentes_id');
    }
    
    public function notificaciones(){
        return $this->belongsToMany(Notificaciones::class,'usuarios_notificacion');
    }
    /**
     * The attributes that are mass assignable.

     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //aqui encripta la contraseña
    public function setPasswordAttribute($password) {

        $this->attributes['password'] = bcrypt($password);
    }
}
