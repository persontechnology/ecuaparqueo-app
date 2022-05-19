<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    use HasFactory;
    public function despachadores()
    {
        return $this->belongsToMany(User::class, 'despachadors', 'estacion_id', 'despachador_id');
    }

    // Deivid, verificar si una estacion tiene despachador
    public function hasDespachador($idEstacion,$idDespachador)
    {
        $despachador=Despachador::where(['estacion_id'=>$idEstacion,'despachador_id'=>$idDespachador])->first();
        if($despachador){
            return true;
        }else{
            return false;
        }
    }
}
