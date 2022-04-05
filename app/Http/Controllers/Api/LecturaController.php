<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Lectura\RqSalida;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LecturaController extends Controller
{


    public function salida(RqSalida $request)
    {
        $estado=false;
        $mensaje="Vehículo no tiene orden movilización y no puede salir.";

        $vehiculo=Vehiculo::where('numero_movil',$request->placaMovil)->orWhere('placa',$request->placaMovil)->first();
        
        if($vehiculo->tipo==='Especial' || $vehiculo->tipo==='Invitados'){
            $estado=true;
            $mensaje='Vehículos es de tipo '.$vehiculo->tipo.' y puede salir';
        }
        
        $ordenMovilizacion=$vehiculo->ordenesMovilizaciones()
        ->where(function($q){
            $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
            $q->where('fecha_retorno','>=',Carbon::now()->format('Y-m-d H:i'));
        })
        ->where('estado','ACEPTADA')
        ->first();

        if($ordenMovilizacion){
            $estado=true;
            $mensaje='Vehículo tiene orden movilización '.$ordenMovilizacion->numero.' y puede salir.';   
        }

        return response()->json(
            [
                'estado'=>$estado,
                'mensaje'=>$mensaje
            ]

        );

    }
}
