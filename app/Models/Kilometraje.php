<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kilometraje extends Model
{
    use HasFactory;

    protected $casts = [
        'numero' => 'integer',
    ];
    // Deivid, un kilometraje tiene un usuario creado
    public function usuarioCreado()
    {
        return $this->belongsTo(User::class,'user_create');
    }
    // Deivid, un kilometraje tiene un usuario creado
    public function usuarioActualizado()
    {
        return $this->belongsTo(User::class,'user_update');
    }
    
}
