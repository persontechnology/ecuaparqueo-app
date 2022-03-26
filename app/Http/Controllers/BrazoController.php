<?php

namespace App\Http\Controllers;


use App\Models\Brazo;
use App\Models\User;
use App\Models\Vehiculo;
use App\Notifications\RealTimeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrazoController extends Controller
{
    public function index()
    {
    }
    public function obtenerBrazo(Request $request)
    {
        $brazo = Brazo::where(['codigo' => $request->code, 'estado' => 'Activo'])->first();
        if ($brazo) {
            if ($brazo->estado_brazo) {
                return response()->json(1);
            } else {
                return response()->json(0);
            }
        } else {

            return response()->json(3);
        }
    }
    public function cerrarBrazo(Request $request)
    {
        $brazo = Brazo::where('codigo', $request->code)->first();
        if ($brazo) {
            $brazo->estado = !$brazo->estado;
            if ($brazo->save()) {
                return response()->json(1);
            } else {
                return response()->json(0);
            }
        } else {

            return response()->json(3);
        }
    }

    public function buscarVehiculoTarjeta(Request $request)
    {
        if($request->has('code')){
            $vihiculo = Vehiculo::where(['codigo_tarjeta'=>$request->code,'estado'=>'Activo'])->first();       
            if ($vihiculo) {
                $user=User::find(1);
                $user->notify( new RealTimeNotification($vihiculo->placa));
                return response()->json($vihiculo->placa);

            } else {
    
                return response()->json(3);
            }
        }
        return response()->json(3);
    }
}
