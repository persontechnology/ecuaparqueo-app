<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturaInvitado extends Model
{
    use HasFactory;
    public function brazo()
    {
        return $this->belongsTo(Brazo::class, 'brazo_id');
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
    public function guardia()
    {
        return $this->belongsTo(User::class, 'guardia_id');
    }
}
