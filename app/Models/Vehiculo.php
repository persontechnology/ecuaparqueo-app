<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    // Deivid, un vehiculo tiene tipo de vehiculo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class,'tipo_vehiculo_id');
    }
}
