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

    // public function guardias()
    // {
    //     return $this->hasMany(GuardiaParqueadero::class);
    // }

    public function guardias()
    {
        return $this->belongsToMany(User::class,'guardia_parqueaderos','parqueadero_id','guardia_id');
    }
}
