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
use App\Models\LecturaNormal;
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
            return response()->json($brazo->estado_brazo);
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
        //http://192.168.1.6:8000/api/buscar-vehiculo-tarjeta-salida?codeBrazo=001&code=1
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
                return response()->json(2);
            }
            
            // si la tarjeta es de invitados
            $empresa=Empresa::first();
            if($empresa){
                if($empresa->codigo_tarjeta_vehiculo_invitado===$request->code){
                    return $this->procesoVehiculoInvitados($request,$brazo,$tipo);
                }
            }
            
            // para vehiculos, especiales y normales
            // $vehiculo = Vehiculo::with('espacio')->where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            $vehiculo = Vehiculo::where(['codigo_tarjeta' => $request->code, 'estado' => 'Activo'])->first();
            if($vehiculo&&$vehiculo->espacio){
                if($vehiculo->tipo==='Especial'){
                    return $this->procesoVehiculoEspecial($request,$vehiculo,$brazo,$tipo);
                }
                if($vehiculo->tipo==='Normal' && $tipo==='Salida'){
                    return $this->procesoVehiculoNormalSalida($request,$vehiculo,$brazo,$tipo);
                }
                if($vehiculo->tipo==='Normal' && $tipo==='Entrada'){
                    return $this->procesoVehiculoNormalEntrada($request,$vehiculo,$brazo,$tipo);
                }
                
            }

            return response()->json(3);
        } catch (\Throwable $th) {
            return response()->json(0);
        }

    }

    // proceso para entrada de vehiculos normales
    public function procesoVehiculoNormalEntrada($request,$vehiculo,$brazo,$tipo)
    {
        // 0. consultar minutos extras de entrada de vehiculos en la empresa
        $minutos_extras=Empresa::first()->minutos_extras_entrada_vehiculos??0;
        // 1. consultar si vehiculo tiene una orden de movilizacion en este momento + minutos extras de salida
        $om_actual=$vehiculo->ordenesMovilizaciones()
        ->where(function($q) use($minutos_extras){
            $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
            $q->where('fecha_retorno','>=',Carbon::now()->subMinutes($minutos_extras)->format('Y-m-d H:i'));
            $q->whereIn('estado',['RECORRIDO','FINALIZADO']);
        })
        ->latest()
        ->first();

        if($om_actual){
            return $this->crearLecturaNormalEntrada($om_actual,$tipo,$brazo,$vehiculo,'FINALIZADO');
        }

        // 2.consultar si tiene orden de  movilizacion fuera de horario de hoy dia
        $om_hoy=$vehiculo->ordenesMovilizaciones()
        ->where(function($q) {
            $q->whereDate('fecha_salida','<=',Carbon::today());
            $q->whereDate('fecha_retorno','>=',Carbon::today());
            $q->OrWhereIn('estado',['RECORRIDO','FINALIZADO']);
        })
        ->latest()
        ->first();
        if($om_hoy){
            return $this->crearLecturaNormalEntrada($om_hoy,$tipo,$brazo,$vehiculo,'FUERA HORARIO');
        }

        // 3. si no tiene orden movilizacion
        if(!$om_hoy || !$om_actual){
            return $this->crearLecturaNormalEntradaIncumplida($tipo,$brazo,$vehiculo,'INCUMPLIDA');
        }
        
        return response()->json('no tiene en este momento');
    }

    // proceso para crear lecturas normales cuando no existe orden de movilizacion
    public function crearLecturaNormalEntradaIncumplida($tipo,$brazo,$vehiculo,$estado)
    {
        
        try {
            DB::beginTransaction();
            $ln=new LecturaNormal();
            $ln->orden_movilizacion_id=null;
            $ln_anterior=LecturaNormal::where(['vehiculo_id'=>$vehiculo->id,'finalizado'=>false])->latest()->first();
            $ln->proceso_orden_movilizacion=$estado;
            if($ln_anterior){
                $ln->observacion='El vehículo volvio a entrar de forma '.$estado;
                $ln_anterior->finalizado=true;
                $ln_anterior->save();
                
            }
            $ln->tipo=$tipo;
            $ln->brazo_id=$brazo->id;
            $ln->vehiculo_id=$vehiculo->id;
            $ln->chofer_id=$vehiculo->conductor->id??null;
            $ln->save();
            DB::commit();
            return response()->json(1);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(0);
        }
    }
    // proceso para crear lecturas normales cuando existe ordende movilizacion
    public function crearLecturaNormalEntrada ($om,$tipo,$brazo,$vehiculo,$estado)
    {
        try {
            DB::beginTransaction();
            $ln=new LecturaNormal();
            $ln->orden_movilizacion_id=$om->id;
            $ln_anterior=LecturaNormal::where(['vehiculo_id'=>$vehiculo->id,'finalizado'=>false])->latest()->first();
            $ln->proceso_orden_movilizacion=$estado;
            
            if($ln_anterior){
                $ln->observacion='El vehículo volvio a entrar de forma '.$estado.', con orden de movilización '.$om->numero.' en estado '.$om->estado;
                // 4. si existe existe ordenes anteriores de tipo entrada, lo actualizamos en fializado para no mostrar alertas al guardia
                $ln_anterior->finalizado=true;
                $ln_anterior->save();
                
            }
            $ln->tipo=$tipo;
            $ln->brazo_id=$brazo->id;
            $ln->vehiculo_id=$vehiculo->id;
            $ln->chofer_id=$vehiculo->conductor->id??null;
            
            
            $ln->save();
            DB::commit();
            return response()->json(1);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(0);
        }
    }

    // proceso para salida de vehiculos normales
    public function procesoVehiculoNormalSalida($request,$vehiculo,$brazo,$tipo)
    {
        try {
            DB::beginTransaction();
            // 1. consultar si vehiculo tiene una orden de movilizacion en este momento de salida
            $ordenMovilizacion=$vehiculo->ordenesMovilizaciones()
            ->where(function($q){
                $q->where('fecha_salida','<=',Carbon::now()->format('Y-m-d H:i'));
                $q->where('fecha_retorno','>=',Carbon::now()->format('Y-m-d H:i'));
                $q->whereIn('estado',['ACEPTADA','RECORRIDO','FINALIZADO']);
            })
            ->latest()
            ->first();
            if($ordenMovilizacion){
                // 2. buscara si ya tiene una lectira de tipo salida con esta orden de movilizacion y si existe llenar una posible descripcion
                $ln_anterior=LecturaNormal::where(['vehiculo_id'=>$vehiculo->id,'finalizado'=>false])->latest()->first();
                
                // 3. crear una lectura normal de tipo salida
                $ln=new LecturaNormal();
                $ln->tipo=$tipo;
                $ln->fecha_salida=Carbon::now();
                $ln->brazo_id=$brazo->id;
                $ln->vehiculo_id=$vehiculo->id;
                $ln->orden_movilizacion_id=$ordenMovilizacion->id;
                $ln->chofer_id=$vehiculo->conductor->id??null;
                if($ln_anterior){
                    $ln->observacion='El vehículo volvio a salir, con orden de movilización '.$ordenMovilizacion->numero.' en estado '.$ordenMovilizacion->estado;
                    // 4. si existe existe ordenes anteriores de tipo salida, lo actualizamos en fializado para no mostrar alertas al guardia
                    $ln_anterior->finalizado=true;
                    $ln_anterior->save();
                    
                }
                
                $ln->save();
                $ln->ordenMovilizacion->estado='RECORRIDO';
                $ln->ordenMovilizacion->save();
                
                // 5. actualizar espacio de vehiculo
                $vehiculo->espacio->estado = "Ausente";
                $vehiculo->espacio->save();
                $this->abrirBrazo($brazo);
                DB::commit();
                return response()->json(1);
            }else{
                return response()->json(4);
            }

          
            return response()->json(3);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(0);
        }
    }

    // Deivid, proceso para vehiculos invitados
    public function procesoVehiculoInvitados($request,$brazo,$tipo)
    {
        try {
            DB::beginTransaction();
            $lie=LecturaInvitado::whereNull('vehiculo_id')->where(['finalizado'=>false,'brazo_id'=>$brazo->id])->latest()->first();
            if(!$lie){
                $li=new LecturaInvitado();
            }else{
                $li=$lie;
            }
        
            $li->tipo=$tipo;
            $li->brazo_id=$brazo->id;

            $li->save();
            DB::commit();
            return response()->json(1);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(0);
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
                $vehiculo->espacio->estado = "Ausente";
                // buscar otras alertas y poner en finalizado
                $lee=LecturaEspecial::where(['vehiculo_id'=>$vehiculo->id,'finalizado'=>false])->latest()->first();
                if($lee){
                    $lee->finalizado=true;
                    $lee->save();
                }
            }
            
            if($tipo==='Entrada'){
                $le->fecha_entrada=Carbon::now();
                // Cambiar espacio a ausente y abrir el brazo
                $vehiculo->espacio->estado = "Presente";
                 // buscar otras alertas y poner en finalizado
                 $lee=LecturaEspecial::where(['vehiculo_id'=>$vehiculo->id,'finalizado'=>false])->latest()->first();
                 if($lee){
                     $lee->finalizado=true;
                     $lee->save();
                 }
            }
            $le->chofer_id=$vehiculo->conductor->id??null;
            $le->save();
            $vehiculo->espacio->save();
            $this->abrirBrazo($brazo);
            DB::commit();
            return response()->json(1);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(0);
        }
    }
    
}
