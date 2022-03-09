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
    // public function scopeNumeroSiguente(){
    //     return IdGenerator::generate(['table' => 'orden_movilizacions','field'=>'numero', 'length' => 10, 'prefix' =>'0','reset_on_prefix_change'=>true]);
    // }

    public function scopeNumeroSiguente()
    {
        $orderObj = $this->select('numero')->latest('id')->first();
        if ($orderObj) {
            $orderNr = $orderObj->numero;
            $removed1char = substr($orderNr, 1);
            $generateOrder_nr = '#' . str_pad($removed1char + 1, 10, "0", STR_PAD_LEFT);
        } else {
            $generateOrder_nr = '#' . str_pad(1, 10, "0", STR_PAD_LEFT);
        }
        return $generateOrder_nr;
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
        return "{$this->conductor->apellidos} {$this->conductor->nombres}";
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

}
