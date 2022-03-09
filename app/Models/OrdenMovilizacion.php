<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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

    //Deivid, crear numerosiguente para la orden
    public function scopeNumeroSiguente(){
        return IdGenerator::generate(['table' => 'orden_movilizacions','field'=>'numero', 'length' => 10, 'prefix' =>'0','reset_on_prefix_change'=>true]);
    }

}
