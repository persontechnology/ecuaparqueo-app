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
         //13915804}
         //return $request->code;
         //1 Invitado
        if($request->has('code')){
            if($request->code==="123456789"){
                $brazo=Brazo::where('codigo',"Bra-01")->first();
                $brazo->estado_brazo=true;
                $brazo->save();
                for ($i=0; $i <100000 ; $i++) { 
                   
                }
                $brazo2=Brazo::where('codigo',"Bra-01")->first();
                $brazo2->estado_brazo=false;
                $brazo2->save();
                return response()->json(6);
            }else{
                $vihiculo = Vehiculo::where(['codigo_tarjeta'=>$request->code,'estado'=>'Activo'])->first();       
                if ($vihiculo) {
                    $user=User::find(1);
                    return response()->json($vihiculo->placa);
    
                } else {
        
                    return response()->json(3);
                }
            }
        }
        return response()->json(3);
    }
}
