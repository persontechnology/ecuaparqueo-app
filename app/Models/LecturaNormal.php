<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturaNormal extends Model
{
    use HasFactory;
    protected $casts = [
        'kilometraje' => 'integer',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    public function brazo()
    {
        return $this->belongsTo(Brazo::class, 'brazo_id');
    }
    public function chofer()
    {
        return $this->belongsTo(User::class, 'chofer_id');
    }
    public function guardia()
    {
        return $this->belongsTo(User::class, 'guardia_id');
    }

    public function ordenMovilizacion()
    {
        return $this->belongsTo(OrdenMovilizacion::class, 'orden_movilizacion_id');
    }
}
