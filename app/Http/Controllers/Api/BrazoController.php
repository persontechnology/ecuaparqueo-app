<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brazo;
use App\Models\Configuracion;
use App\Models\Empresa;
use App\Models\Lectura;
use App\Models\LecturaEspecial;
use App\Models\LecturaInvitado;
use App\Models\NotificacionLectura;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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
            $brazo->save();
            return response()->json(1);
           
        } else {

            return response()->json(3);
        }
    }

    // Deivid, aqui se abre el brazo
    public function abrirBrazo($brazo)
    {
        $brazo->estado_brazo = true;
        $brazo->save();
        return true;
    }
    
    // Deivid, lectura de salida de vehiculos
    public function buscarVehiculoTarjetaSalida(Request $request)
    {
        return $this->procesoVehiculo($request,'Salida');
    }

    // Deivid, lectura de entrada de vehiculos
    public function buscarVehiculoTarjetaEntrada(Request $request)
    {
        return $this->procesoVehiculo($request,'Entrada');
    }

    // Deivid, proceso de todos los tipos de vehiculos
    public function procesoVehiculo($request,$tipo)
    {
        
        try {
            
            $brazo = Brazo::where('codigo',$request->codeBrazo)->first();
            if(!$brazo){
                return response()->json('2');
            }
            
            // si la tarjeta es de invitados
            $empresa=Empresa::first();
            if($empresa){
                if($empresa->codigo_tarjeta_vehiculo_invitado===$request->code){
                    return $this->procesoVehiculoInvitados($request,$brazo,$tipo);
                }
            }
            
            // para vehiculos, especiales y normales
            $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            if($vehiculo){
                if($vehiculo->tipo==='Especial'){
                    return $this->procesoVehiculoEspecial($request,$vehiculo,$brazo,$tipo);
                }
                
            }else{
                return response()->json('3');
            }

            return response()->json('5');
        } catch (\Throwable $th) {
            return response()->json('0');
        }

    }

    // Deivid, proceso para vehiculos invitados
    public function procesoVehiculoInvitados($request,$brazo,$tipo)
    {
        try {
            DB::beginTransaction();

            $li=new LecturaInvitado();
            $li->tipo=$tipo;
            $li->brazo_id=$brazo->id;
            $li->save();
            DB::commit();
            return response()->json('1');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('0');
        }
    }

    // Deivid: proceso de lectura para vehiculos especiales
    public function procesoVehiculoEspecial($request,$vehiculo,$brazo,$tipo)
    {
        try {
            DB::beginTransaction();
            $le=new LecturaEspecial();
            $le->tipo=$tipo;
            $le->vehiculo_id=$vehiculo->id;
            $le->brazo_id=$brazo->id;
            if($tipo==='Salida'){
                $le->fecha_salida=Carbon::now();
                // Cambiar espacio a ausente y abrir el brazo
                $vehiculo-> espacio->estado = "Ausente";
            }
            
            if($tipo==='Entrada'){
                $le->fecha_entrada=Carbon::now();
                // Cambiar espacio a ausente y abrir el brazo
                $vehiculo-> espacio->estado = "Presente";
            }
            $le->chofer_id=$le->vehiculo->conductor->id??null;
            $le->save();
            $vehiculo->espacio->save();
            $this->abrirBrazo($brazo);
            DB::commit();
            return response()->json('1');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('0');
        }
    }


    // Deivid: De aqui en adelante no sirve toca elimnar. xk se refactorizo el codigo

    // Deivid: crear entrada de vehiculos especiales
    public function xbuscarVehiculoTarjetaEntrada(Request $request)
    {

        try {
            $brazo = Brazo::where('codigo',$request->codeBrazo)->first();
        
            if(!$brazo){
                return response()->json(2);
            }

            $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            
            if(!$vehiculo){
                return response()->json(3);
            }

            if($vehiculo->tipo==='Especial'){
                // Deivid: si vehiculo tiene una lectura de tipo salida puede salir caso contrario creamos una lectura
                $lecturaSimple=$this->crearLecturaSimple($vehiculo,$brazo);
                // creamos notificación
                $this->crearNotificacion($brazo,$lecturaSimple,$vehiculo,'Salida');
                $this->abrirBrazo($brazo);
                return response()->json(1);
            }

            $lectura=$vehiculo->lecturas()->where('tipo','Salida')->latest()->first();
            // o si tiene tiene lectura de entrada
            if($lectura){
                $this->crearNotificacion($brazo,$lectura,$vehiculo,'Entrada');
                // $this->abrirBrazo($brazo);
                return response()->json(1);
            }

            // si tiene orden de movilizacion
            $ordenMovilizacion=$vehiculo->ordenesMovilizaciones()
            ->where(function($q){
                $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
                $q->where('fecha_retorno','>=',Carbon::now()->format('Y-m-d H:i'));
            })
            // ->where('estado','ACEPTADA')
            // ->whereNotIn('estado',['ACEPTADA'])
            ->latest()
            ->first();

            if($ordenMovilizacion){
                
                $lecturaSalida=Lectura::where(['vehiculo_id'=>$vehiculo->id,'orden_movilizacion_id'=>$ordenMovilizacion->id])
                    ->where('tipo','Salida')
                    ->latest()
                    ->first();

                if(!$lecturaSalida){
                    $lecturaSalida=$this->crearLecturaConOrdenMovilizacion($ordenMovilizacion,$brazo);
                    $lecturaSalida->created_at=null;
                    $lecturaSalida->save();

                    // enviar al supervisor un email de completar una entrada sin salida
                }

                // Deivid, actualizamos estado del espacio y brazo
                // $espacio = $ordenMovilizacion->vehiculo->espacio;
                // $espacio->estado = "Ausente";
                // $espacio->save();
                // $this->abrirBrazo($brazo);

                // creamosn notificación
                $this->crearNotificacion($brazo,$lecturaSalida,$vehiculo,'Entrada');
                return response()->json(1);
                
            }else{
                return response()->json(4);
            }

        } catch (\Throwable $th) {
            return response()->json(0);
        }
        

    }

    

    

    public function xBuscarVehiculoTarjetaSalida(Request $request)
    {
        try {
            
            $brazo = Brazo::where('codigo',$request->codeBrazo)->first();
        
            if(!$brazo){
                return response()->json(2);
            }

            $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            
            if(!$vehiculo){
                return response()->json(3);
            }

            if($vehiculo->tipo==='Especial'){
                // Deivid: si vehiculo tiene una lectura de tipo salida puede salir caso contrario creamos una lectura
                $lecturaSimple=$this->crearLecturaSimple($vehiculo,$brazo);
                // creamos notificación
                $this->crearNotificacion($brazo,$lecturaSimple,$vehiculo,'Salida');
                $this->abrirBrazo($brazo);

                return response()->json(1);
            }

            $ordenMovilizacion=$vehiculo->ordenesMovilizaciones()
            ->where(function($q){
                $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
                $q->where('fecha_retorno','>=',Carbon::now()->format('Y-m-d H:i'));
            })
            // ->where('estado','ACEPTADA')
            ->latest()
            ->first();

            if($ordenMovilizacion){
                
                $lecturaSalida=Lectura::where(['vehiculo_id'=>$vehiculo->id,'orden_movilizacion_id'=>$ordenMovilizacion->id])
                    ->where('tipo','Salida')
                    ->latest()
                    ->first();

                if(!$lecturaSalida){
                    $lecturaSalida=$this->crearLecturaConOrdenMovilizacion($ordenMovilizacion,$brazo);
                }

                // Deivid, actualizamos estado del espacio y brazo
                $espacio = $ordenMovilizacion->vehiculo->espacio;
                $espacio->estado = "Ausente";
                $espacio->save();
                $this->abrirBrazo($brazo);

                // creamosn notificación
                $this->crearNotificacion($brazo,$lecturaSalida,$vehiculo,'Salida');
                return response()->json(1);
                
            }else{
                return response()->json(4);
            }

        } catch (\Throwable $th) {
            return response()->json(0);
        }
    }

    public function crearNotificacion($brazo,$lectura,$vehiculo,$tipo)
    {
        $guardias= $brazo->parqueadero->guardias;
        if($guardias->count()>0){
            foreach ($guardias as $guardia) {
                $noti=NotificacionLectura::where(['lectura_id'=>$lectura->id,'guardia_id'=>$guardia->id,'tipo'=>$tipo])->first();
                if(!$noti){
                    $noti=new NotificacionLectura();
                }else{
                    $noti->created_at=Carbon::now();
                }
                $noti->lectura_id=$lectura->id;
                $noti->guardia_id=$guardia->id;
                $noti->mensaje='Vehículo '.$vehiculo->placa.' está de tipo '.$tipo.' en el brazo '.$brazo->codigo;
                $noti->visto=false;
                $noti->brazo_id=$brazo->id;
                $noti->tipo=$tipo;
                $noti->save();
                
            }
        }
        return true;
    }

    public function crearLecturaSimple($vehiculo,$brazo)
    {
        $lectura=new Lectura();
        $lectura->tipo='Salida';
        $lectura->brazo_salida_id=$brazo->id;
        $lectura->vehiculo_id=$vehiculo->id;
        $lectura->save();

        return $lectura;
    }

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

    
    
}
