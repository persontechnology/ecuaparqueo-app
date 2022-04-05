<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brazo;
use App\Models\User;
use App\Models\Vehiculo;

class BrazoController extends Controller
{
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
        /*  $tipo=new TipoVehiculo();
        $tipo->nombre=$request->code;
        $tipo->save(); */
        $brazo = Brazo::where('codigo', $request->code)->first();
        if ($brazo) {
            $brazo->estado_brazo = false;
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
        if ($request->has('code')) {
            if ($request->code === "123456789") {
                return response()->json(6);
            } else {
                $vihiculo = Vehiculo::where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
                if ($vihiculo) {

                    return response()->json($vihiculo->placa);
                } else {
                    $vihiculo = Vehiculo::where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
                    if ($vihiculo) {
                        $user = User::find(1);
                        return response()->json($vihiculo->placa);
                    } else {

                        return response()->json(3);
                    }
                }
            }
        }
        return response()->json(3);
    }
}
