<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacionLectura extends Model
{
    use HasFactory;

    // una totificacion lectura tiene un alectura
    public function lectura()
    {
        return $this->belongsTo(Lectura::class,'lectura_id');
    }

    public function brazo()
    {
        return $this->belongsTo(Brazo::class,'brazo_id');
    }

}
