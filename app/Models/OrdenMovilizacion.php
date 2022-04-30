<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class OrdenMovilizacion extends Model
{
    use HasFactory;
    
    // Deivid, esto creara automaticamnet el siguente numero de orden y lo guardara en bbdd
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->numero = $model->NumeroSiguente();
        });
    }

    //Deivid, crear numero siguente para la orden

    public function scopeNumeroSiguente()
    {
        $orden = $this->select('numero')->latest('id')->first();
        if ($orden) {
            $ordenNumero = $orden->numero;
            $quitarChart = substr($ordenNumero, 1);
            $ordenNumeroGenerado = '#' . str_pad($quitarChart + 1, 10, "0", STR_PAD_LEFT);
        } else {
            $ordenNumeroGenerado = '#' . str_pad(1, 10, "0", STR_PAD_LEFT);
        }
        return $ordenNumeroGenerado;
    }

    // Deivid, formateando para hora salida
    public function getHoraSalidaAttribute($from)
    {
        return Carbon::parse($from)->format('H:i');
    }
    // Deivid, formateando para hora retorno
    public function getHoraRetornoAttribute($from)
    {
        return Carbon::parse($from)->format('H:i');
    }

        

    // Deivid, una orden tiene un usuario conductor
    public function conductor()
    {
        return $this->belongsTo(User::class,'conductor_id');
    }


    // Deivid, una orden tiene un usuario solicitante
    public function solicitante()
    {
        return $this->belongsTo(User::class,'solicitante_id');
    }

    // Deivid, una orden tiene un usuario autorizado
    public function autorizado()
    {
        return $this->belongsTo(User::class,'autorizado_id');
    }

    // Deivid, una orden tiene un vehiculo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    // Deivid, usuario creado
    public function usuarioCreado()
    {
        return $this->belongsTo(User::class,'user_create');
    }
    // Deivid, usuario actualizado
    public function usuarioActualizado()
    {
        return $this->belongsTo(User::class,'user_update');
    }
    

    public function getColorEstadoAttribute()
    {   
        
        $color='';
        switch ($this->estado) {
            case 'SOLICITADO':
                $color='info';
                 break;
            case 'ACEPTADA':
                $color='success';
                 break;
            case 'DENEGADA':
                $color='danger';
                 break;
            case 'RECORRIDO':
                $color='warning';
                 break;
            case 'FINALIZADO':
                $color='secondary';
                 break;
            case 'INCUMPLIDA':
                $color='purple';
                 break;
            case 'FUERA DE HORARIO':
                $color='dark'; 
                break;
        }

        return $color;
    }

}
