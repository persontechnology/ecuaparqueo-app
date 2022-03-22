<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    // Deivid, formateando informacion del conductor
    public function getInfoConductorAttribute()
    {
        if($this->conductor){
            return "{$this->conductor->apellidos} {$this->conductor->nombres}";
        }
        return '';
        
    }

    // Deivid, formateando informacion del vehiculo
    public function getInfoVehiculoAttribute()
    {
        return "{$this->vehiculo->placa}-{$this->vehiculo->numero_chasis}";   
    }

    // Deivid, una orden tiene un conductor
    public function conductor()
    {
        return $this->belongsTo(User::class,'user_id');
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
    
    // Deivid, usuario aceptado
    public function usuarioAceptado()
    {
        return $this->belongsTo(User::class,'user_acepted');
    }
    // Deivid, usuario aceptado
    public function usuarioDenegado()
    {
        return $this->belongsTo(User::class,'user_denegated');
    }

    public function getColorEstadoAttribute()
    {   
        $color='bg-primary';
        switch ($this->estado) {
            case 'SOLICITADO':
                $color='bg-primary';
                break;
            case 'DENEGADA':
                $color='bg-secondary';
                break;
            case 'ACEPTADA':
                $color='bg-success';
                break;
            case 'OCUPADO':
                $color='bg-danger';
                break;
            case 'FINALIZADO':
                $color='bg-warning';
                break;
        }
        return $color;
    }

}
