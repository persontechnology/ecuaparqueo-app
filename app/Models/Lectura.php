<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory;

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    public function ordenMovilizacion()
    {
        return $this->belongsTo(OrdenMovilizacion::class,'vehiculo_id');
    }

}

