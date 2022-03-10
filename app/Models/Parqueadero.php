<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model
{
    use HasFactory;

    #region relaciones

    public function espacios()
    {
        return $this->hasMany(Espacio::class);
    }

    public function vehiculos()
    {
        return $this->hasManyThrough(Vehiculo::class, Espacio::class);
    }
}
