<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory;

    
    // Deivid, una lectura tinee un vehiculo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    // Deivid, una lectura pude tener una orden de movilizacion
    public function ordenMovilizacion()
    {
        return $this->belongsTo(OrdenMovilizacion::class,'vehiculo_id');
    }

    // Deivid, una lectura tiene un brazo
    public function brazoSalida()
    {
        return $this->belongsTo(Brazo::class,'brazo_salida_id');
    }
    // Deivid, una lectura tiene un brazo
    public function brazoEntrada()
    {
        return $this->belongsTo(Brazo::class,'brazo_entrada_id');
    }

    // una lectura tiene un guardia de entrada
    public function guardia()
    {
        return $this->belongsTo(User::class,'guardia_id');
    }

    

}

