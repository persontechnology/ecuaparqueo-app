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

    public function kilometraje()
    {
        return $this->belongsTo(Kilometraje::class,'kilometraje_id');
    }

    public function kilometrajes()
    {
        return $this->hasMany(Kilometraje::class);
    }


    // Deivid, un vehiculo esta en espacios de un parquadero
    public function espacios()
    {
        return $this->hasMany(Espacio::class);
    }
    //DEivid, funcion para retornar color segun a lso estado
    public function getColorEstadoAttribute()
    {   
        



        $color='border-success';
        switch ($this->estado) {
            case 'Activo':
                $color='primary';
                break;
            case 'Inactivo':
                $color='secondary';
                break;
            case 'Presente':
                $color='success';
                break;
            case 'Ausente':
                $color='danger';
                break;
        }
        return $color;
    }
}
