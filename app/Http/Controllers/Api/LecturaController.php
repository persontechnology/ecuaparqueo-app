<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Lectura\RqConsultaEntrada;
use App\Http\Requests\Api\Lectura\RqSalida;
use App\Models\Brazo;
use App\Models\Lectura;
use App\Models\NotificacionLectura;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LecturaController extends Controller
{


    public function salida(RqSalida $request)
    {
        $estado=false;
        $mensaje="Vehículo no tiene orden movilización y no puede salir.";

        $vehiculo=Vehiculo::where('numero_movil',$request->placaMovil)->orWhere('placa',$request->placaMovil)->first();
        $brazo=Brazo::where('codigo',$request->codigoBrazo)->first();
        
        try {
            DB::beginTransaction();
            // Deivid, consultas para vehiculos especiales o invitados
            // Deivid: vehiculo es especial o Invitados pueden salir sin crear una orden de movilizacion
            if($vehiculo->tipo==='Especial' || $vehiculo->tipo==='Invitados'){

                // Deivid: si vehiculo tiene una lectura de tipo salida puede salir caso contrario creamos una lectura
                $lecturaSalida=Lectura::where('vehiculo_id',$vehiculo->id)->where('tipo','Salida')
                ->latest()
                ->first();
                if($lecturaSalida){
                    $estado=true;
                    $mensaje='Vehículo ya tiene salida de tipo '.$vehiculo->tipo.' y puede salir';
                }else{
                    $this->crearLecturaSimple($vehiculo,$brazo);
                    $estado=true;
                    $mensaje='Vehículo es de tipo '.$vehiculo->tipo.' y puede salir';
                }
                
            }
            
            // Deivid: consulta para vehiculos normales
            // Deivid: verificamos si vehiculo tienen una orden de movilizacion en este momento actual

            $ordenMovilizacion=$vehiculo->ordenesMovilizaciones()
            ->where(function($q){
                $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
                $q->where('fecha_retorno','>=',Carbon::now()->format('Y-m-d H:i'));
            })
            ->where('estado','ACEPTADA')
            ->latest()
            ->first();

            // Deivid: si tiene una orden de movilizacion, verificamos si tiene lectura de salida
            if($ordenMovilizacion){
                $ordenMovilizacion->estado='OCUPADO';
                $ordenMovilizacion->save();
                $lecturaSalida=Lectura::where('vehiculo_id',$vehiculo->id)
                    ->where('tipo','Salida')
                    ->latest()
                    ->first();

                if($lecturaSalida){
                    $estado=true;
                    $mensaje='Vehículo ya tiene lectura de salida en orden de movilización '.$ordenMovilizacion->numero.' y puede salir.';   
                }else{
                    $this->crearLecturaConOrdenMovilizacion($ordenMovilizacion,$brazo);
                    $estado=true;
                    $mensaje='Vehículo tiene orden movilización '.$ordenMovilizacion->numero.' y puede salir.';   
                }
                
            }

        
            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollback();
            $mensaje='Ocurrio un error, consulte con administrador o vuelva a intentar.!';
        }

        return response()->json(
            [
                'estado'=>$estado,
                'mensaje'=>$mensaje
            ]
        );

    }
    // Deivid: crear lectura de salida sin orden de movilizacion para vehiculos especales, invitados
    public function crearLecturaSimple($vehiculo,$brazo)
    {
        $lectura=new Lectura();
        $lectura->tipo='Salida';
        $lectura->brazo_salida_id=$brazo->id;
        $lectura->vehiculo_id=$vehiculo->id;
        $lectura->save();

        // creamos al vehiculo ausente
        $lectura->vehiculo->estado='Ausente';
        $lectura->vehiculo->save();
        return $lectura;
    }
    // Deivid, crear lectura de salida para vehiculos normales que tengan orden de movilizacion
    public function crearLecturaConOrdenMovilizacion($ordenMovilizacion,$brazo)
    {
        $lectura=new Lectura();
        $lectura->tipo='Salida';
        $lectura->brazo_salida_id=$brazo->id;
        $lectura->vehiculo_id=$ordenMovilizacion->vehiculo->id;
        $lectura->orden_movilizacion_id=$ordenMovilizacion->id;
        $lectura->save();
        return $lectura;
    }

    public function consultaLecturaEntrada(RqConsultaEntrada $request)
    {
        $estado=false;
        $mensaje="El vehiculo no puede ingresar";

        $vehiculo=Vehiculo::where('numero_movil',$request->placaMovil)->orWhere('placa',$request->placaMovil)->latest()->first();
        $brazo=Brazo::where('codigo',$request->codigoBrazo)->first();
        
        if($vehiculo->tipo==='Especial' || $vehiculo->tipo==='Invitados'){
            $estado=true;
            $mensaje='Es vehiculo '.$vehiculo->tipo.' y puede ingresar. No se envia notificaciones a guardias';
        }

        $lectura=$vehiculo->lecturas()->where('tipo','Salida')->latest()->first();
        if($lectura){
            
            $contadorGuardias=0;
            $guardias= $brazo->parqueadero->guardias;
            if($guardias){
                $contadorGuardias=$guardias->count();
                foreach ($guardias as $guardia) {
                    $noti=NotificacionLectura::where(['lectura_id'=>$lectura->id,'guardia_id'=>$guardia->id])->first();
                    if(!$noti){
                        $noti=new NotificacionLectura();
                        $noti->lectura_id=$lectura->id;
                        $noti->guardia_id=$guardia->id;
                        $noti->mensaje='Vehículo '.$vehiculo->placa.' está solicitando ingresar en el brazo '.$brazo->codigo;
                        $noti->visto=false;
                        $noti->brazo_id=$brazo->id;
                        $noti->save();
                    }
                    
                }
            }
            $estado=true;
            $mensaje='Es vehiculo tiene una lectura de tipo salida y puede ingresar. Se envío notificaciones a '.$contadorGuardias.' guardias';
        }
    
        return response()->json([
            'estado'=>$estado,
            'mensaje'=>$mensaje
        ]);

    }

}
