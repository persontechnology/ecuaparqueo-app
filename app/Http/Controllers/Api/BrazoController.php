<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brazo;
use App\Models\Lectura;
use App\Models\NotificacionLectura;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;

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

                return response()->json(1);
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
    public function buscarVehiculoTarjetaSalida(Request $request)
    {

        if ($request->has('code')) {
            $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            $brazo = Brazo::where(['codigo' => $request->codeBrazo, 'estado' => 'Activo'])->first();
            
            if ($request->code === "123456789") {
                $brazo->estado_brazo = true;
                $brazo->save();
                return response()->json(1);
            } 

            // if ($vehiculo && $vehiculo->espacio && $brazo) {
            // } else {
            //     return response()->json(3);
            // }
            if ($vehiculo->tipo === "Especial") {
                $lectura = new Lectura();
                $lectura->tipo = 'Salida';
                $lectura->brazo_salida_id = $brazo->id;
                $lectura->vehiculo_id = $vehiculo->id;
                $lectura->save();
                $espacio = $vehiculo->espacio;
                $espacio->estado = "Ausente";
                $espacio->save();
                $brazo->estado_brazo = true;
                $brazo->save();
                return response()->json(1);
            } 
            
            if ($vehiculo->tipo === "Normal") {
                $ordenMovilizacion = $vehiculo->ordenesMovilizaciones()
                    ->where(function ($q) {
                        $q->where('fecha_salida', '<=', Carbon::now()->format('Y-m-d H:i'));
                        $q->where('fecha_retorno', '>=', Carbon::now()->format('Y-m-d H:i'));
                    })
                    ->where('estado', 'ACEPTADA')
                    ->latest()
                    ->first();
                if ($ordenMovilizacion) {
                    $lectura = new Lectura();
                    $lectura->tipo = 'Salida';
                    $lectura->brazo_salida_id = $brazo->id;
                    $lectura->vehiculo_id = $vehiculo->id;
                    $lectura->orden_movilizacion_id = $ordenMovilizacion->id;
                    $lectura->save();
                    $espacio = $vehiculo->espacio;
                    $espacio->estado = "Ausente";
                    $espacio->save();
                    $brazo->estado_brazo = true;
                    $brazo->save();
                    return response()->json(1);
                } else {
                    return response()->json(3);
                }
            }

        }
        return response()->json(3);
    }
    public function buscarVehiculoTarjetaEntrada(Request $request)
    {

        if ($request->has('code')) {
            $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            $brazo = Brazo::where(['codigo' => $request->codeBrazo, 'estado' => 'Activo'])->first();
            if ($request->code === "123456789") {
                $lectura = new Lectura();
                $lectura->tipo = 'Entrada';
                $lectura->brazo_salida_id = $brazo->id;
                $lectura->save();
                $contadorGuardias = 0;
                $guardias = $brazo->parqueadero->guardias;
                if ($guardias) {
                    $contadorGuardias = $guardias->count();
                    foreach ($guardias as $guardia) {
                        //Agreges al invitado
                       /*  $noti = NotificacionLectura::where(['lectura_id' => $lectura->id, 'guardia_id' => $guardia->id])->first();
                        if (!$noti) {
                            $noti = new NotificacionLectura();
                            $noti->lectura_id = $lectura->id;
                            $noti->guardia_id = $guardia->id;
                            $noti->brazo_id = $brazo->id;
                            $noti->mensaje = 'Vehículo ' . $vehiculo->placa . ' está solicitando ingresar en el brazo ' . $brazo->codigo;
                            $noti->visto = false;
                            $noti->save();
                        } */
                    }
                }
                return response()->json(1);
            } else {
                if ($vehiculo && $vehiculo->espacio && $brazo) {
                    $lectura = $vehiculo->lecturas()->where('tipo', 'Salida')->latest()->first();
                    if ($lectura) {
                        
                        if ($vehiculo->tipo === "Especial") {
                            $lectura->fecha_retorno = Carbon::now();
                            $lectura->tipo = "Entrada";
                            $lectura->brazo_entrada_id=$brazo->id;
                            $lectura->save();
                            $brazo->estado_brazo = true;
                            $brazo->save();
                            return response()->json(1);

                        } elseif ($vehiculo->tipo === "Normal") {
                            $contadorGuardias = 0;
                            $guardias = $brazo->parqueadero->guardias;
                            if ($guardias) {
                                $contadorGuardias = $guardias->count();
                                foreach ($guardias as $guardia) {
                                    $noti = NotificacionLectura::where(['lectura_id' => $lectura->id, 'guardia_id' => $guardia->id])->first();
                                    if (!$noti) {
                                        $noti = new NotificacionLectura();
                                        $noti->lectura_id = $lectura->id;
                                        $noti->guardia_id = $guardia->id;
                                        $noti->brazo_id = $brazo->id;
                                        $noti->mensaje = 'Vehículo ' . $vehiculo->placa . ' está solicitando ingresar en el brazo ' . $brazo->codigo;
                                        $noti->visto = false;
                                        $noti->save();
                                    }
                                }
                            }
                            return response()->json(1);
                        }
                    }
                } else {

                    return response()->json(3);
                }
            }
        }
        return response()->json(3);
    }
}
