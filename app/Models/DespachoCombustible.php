<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DespachoCombustible extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->numero = $model->NumeroSiguente();
            // el codigo es para el despacho de combustible en la estacion
            $model->codigo=Str::upper(Str::random(6));
           
        });
    }

    protected $fillable = [
        'numero',
        'codigo',
        'fecha',
        'kilometraje',
        'destino',
        'concepto',
        'cantidad_galones',
        'cantidad_letras',
        'valor',
        'valor_letras',
        'observaciones',
        'chofer_id',
        'vehiculo_id',
        'despachador_id',
        'foto',
        'estado',
        'autorizado_id'
    ];

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

    // Deivid, un despacho de combustible tiene un vehiculo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    // Deivid, un despacho de combustile tiene un conductor
    public function conductor()
    {
        return $this->belongsTo(User::class,'chofer_id');
    }
    
    // Deivid, un despacho de combustible tiene un usuario que autoriza el despacho
    public function autorizado()
    {
        return $this->belongsTo(User::class,'autorizado_id');
    }

    // Deivid, un despacho de combustible tiene un usuario despachador de cmbustible, este es de la estacion
    public function despachador()
    {
        return $this->belongsTo(User::class,'despachador_id');
    }
    // Deivid, un dc tiene una estacion de gasolinera
    public function estacionGasolinera()
    {
        return $this->belongsTo(Estacion::class,'estacion_id');
    }
    // retornor direciion de foto
    public function getFotoLinkAttribute()
    {
        if(Storage::exists($this->foto)){
            return Storage::url($this->foto) ;
        }
        
    }

}
