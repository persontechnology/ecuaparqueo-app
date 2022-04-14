<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotificacionLectura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacionLecturaController extends Controller
{
    public function lecturaNotificacion(Request $request)
    {

        $user=$request->user();
        $notificacionesLectura=[];
        if($user->hasRole('Guardia')){
            if($user->notificacionesLecturas){
                foreach ($user->notificacionesLecturas()->latest()->where('visto',false)->take(5)->get() as $not) {
                    array_push($notificacionesLectura,[
                        'id'=>$not->id,
                        'lectura_id'=>$not->lectura_id,
                        'mensaje'=>$not->mensaje,
                        'fecha'=>$not->created_at->diffForHumans()
                    ]);
                }
                // $notificacionesLectura=$user->notificacionesLecturas()->latest()->where('visto',false)->take(5)->get();

            }
        }
        $data = array('notificacionesLectura' => $notificacionesLectura);
        return response()->json($data);

    }

    public function obtenerPorId(Request $request)
    {
        $noti=NotificacionLectura::find($request->notificacionLecturaId);
        $data = array(
            'id' => $noti->id,
            'fecha'=>$noti->created_at->diffForHumans(),
            'placaNumero'=>'#.'.$noti->lectura->vehiculo->numero_movil.' Placa.'.$noti->lectura->vehiculo->placa,
        );
        return response()->json($data);
    }

    public function registrarRetornoVehiculo(Request $request)
    {
        $request->validate([
            'notificacionLecturaId'=>'required|exists:notificacion_lecturas,id',
            'kilometraje'=>'required|numeric|gt:0',
            'combustible'=>'required|numeric|gt:0',
        ]);
        
        try {
            DB::beginTransaction();
            // actualizamos notificacion de lectura, visto en true
            $noti=NotificacionLectura::find($request->notificacionLecturaId);
            $noti->visto=true;
            $noti->save();

            
            // actualizamos la lectura 
            $noti->lectura->tipo='Entrada';
            $noti->lectura->porcentaje_combustible=$request->combustible;
            $noti->lectura->kilometraje=$request->kilometraje;
            $noti->lectura->fecha_retorno=Carbon::now()->format('Y-m-d H:i');
            $noti->lectura->brazo_entrada_id=$noti->brazo_id;
            $noti->lectura->guardia_id=$request->user()->id;
            $noti->lectura->save();
            
            //activar Brazo
            $noti->lectura->brazoEntrada->estado_brazo = true;
            $noti->lectura->brazoEntrada->save();
            //vehiculo
            $noti->vehiculo->espacio->estado="Presente";
            $noti->vehiculo->espacio->save();
            // actualizar estado de notificacion a finalizado
            $noti->lectura->ordenMovilizacion->estado='FINALIZADO';
            $noti->lectura->ordenMovilizacion->save();

            DB::commit();
            return response()->json([
                'estado'=>'ok',
                'mensaje'=>'Registro de retorno vehicular exitoso'
            ]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'estado'=>'no',
                'mensaje'=>$th->getMessage()
            ]);
        }



    }
}
