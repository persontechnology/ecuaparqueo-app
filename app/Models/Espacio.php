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
    public function estadosColor($estado)
    {
        $colorEstado = null;
        switch ($estado) {
            case 'Activo':
                $colorEstado = "badge-success";
                break;
            case 'Inactivo':
                $colorEstado = "badge-danger";
                break;
            case 'Presente':
                $colorEstado = "badge-info";
                break;
            case 'Ausente':
                $colorEstado = "badge-warning";
                break;
            case 'Solicitado':
                $colorEstado = "badge-pink";
                break;
            case 'Reservado':
                $colorEstado = "badge-primary";
                break;
            default:
                # code...
                break;
        }
        return  $colorEstado;
    }
}
