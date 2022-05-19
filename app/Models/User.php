<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
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

    // Deivid, apellidos y nombres de usuario
    public function getApellidosNombresAttribute($from)
    {
        if($this->apellidos && $this->nombres){
            return $this->apellidos.' '.$this->nombres;
        }else{
            return $this->name;
        }
    }

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }

    // Un usuario tiene una sola configuracion
    public function configuracion()
    {
        return $this->hasOne(Configuracion::class);
    }


    // Deivid: un usuario tiene notiifcaciones
    public function notificacionesLecturas()
    {
        return $this->hasMany(NotificacionLectura::class,'guardia_id');
    }

    // estaciones
    public function estacionServicios()
    {
        return $this->belongsToMany(Estacion::class, 'despachadors', 'despachador_id', 'estacion_id');
    }
    
}
