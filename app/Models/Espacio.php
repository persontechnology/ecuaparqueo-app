<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }   

    public function getColorEstadoAttribute()
    {
        $colorEstado = '';
        switch ($this->estado) {
            case 'Activo':
                $colorEstado = "success";
                break;
            case 'Inactivo':
                $colorEstado = "danger";
                break;
            case 'Presente':
                $colorEstado = "info";
                break;
            case 'Ausente':
                $colorEstado = "warning";
                break;
            case 'Solicitado':
                $colorEstado = "pink";
                break;
            case 'Reservado':
                $colorEstado = "primary";
                break;
        }
        return  $colorEstado;
    }
}
