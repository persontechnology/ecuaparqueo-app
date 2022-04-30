<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kilometraje;
use App\Models\LecturaNormal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturaNormalController extends Controller
{
    public function diezUltimasLista(Request $request)
    {
        $lis= LecturaNormal::where('finalizado',false)->latest()->take(5)->get();
        $data = array();
        foreach ($lis as $le) {
            array_push($data,[
                'id'=>$le->id,
                'mensaje' => 'Vehículo '.$le->vehiculo->placa.' en brazo '.$le->brazo->codigo.' solicita '.$le->tipo, 
                'tipo'=>$le->tipo,
                'fecha'=>$le->created_at->diffForHumans(),
                'titulo'=>'N° MÓVIL '.$le->vehiculo->numero_movil
            ]);
        }
        return response()->json($data);
    }

    public function finalizarSalida(Request $request)
    {
        $ln=LecturaNormal::find($request->id);
        $ln->finalizado=true;
        $ln->guardia_id=$request->user()->id;
        $ln->save();
        response()->json('ok');
    }

    public function detalle(Request $request)
    {
        $ln=LecturaNormal::find($request->id);
        $data = array(
            'id' => $ln->id,
            'fecha'=>$ln->created_at->diffForHumans(),
            'placaNumero'=>$ln->vehiculo->placa,
            'movil'=>$ln->vehiculo->numero_movil,
            'kilometraje_anterior'=>$ln->vehiculo->kilometrajes()->latest()->first()->numero??0,
            'ordenMovilizacion'=>$ln->ordenMovilizacion->numero??'',
            'estado'=>$ln->proceso_orden_movilizacion
        );

        return response()->json($data);
    }
    public function finalizarEntrada(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:lectura_normals,id',
            'kilometraje'=>'required|numeric|gt:'.LecturaNormal::find($request->id)->vehiculo->kilometrajes()->latest()->first()->numero??0,
            'combustible'=>'required|integer|between:1,100',
            'ordenMovilizacion'=>'nullable|string'
        ]);
        
        try {
            DB::beginTransaction();
            $ln=LecturaNormal::find($request->id);
            $ln->fecha_entrada=Carbon::now();
            $ln->finalizado=true;
            $ln->porcentaje_combustible=$request->combustible;
            if($request->ordenMovilizacion){
                $ln->observacion=$ln->observacion.' N° orden de movilización opcional '.$request->ordenMovilizacion;
            }
            $ln->vehiculo->espacio->estado = "Presente";
            $ln->vehiculo->save();
            $ln->brazo->estado_brazo = true;
            $ln->brazo->save();

            $ln->kilometraje=$request->kilometraje;
            $ln->guardia_id=$request->user()->id;
            $ln->save();

            $kilometraje= new Kilometraje();
            $kilometraje->vehiculo_id=$ln->vehiculo->id;
            $kilometraje->numero=$request->kilometraje;
            $kilometraje->user_create=$request->user()->id;
            $kilometraje->save();
            DB::commit();
            return response()->json(['estado'=>'ok','mensaje'=>'Revisión finalizado']);
        } catch (\Throwable $th) {
            return response()->json(['estado'=>'no','mensaje'=>$th->getMessage()]);
        }
    }


    public function cancelarEntrada(Request $request)
    {
        try {
            DB::beginTransaction();
                $ln=LecturaNormal::find($request->id);
                $ln->brazo->estado_brazo=9;
                $ln->brazo->save();
                $ln->delete();
            DB::commit();
            return response()->json(['estado'=>'ok','mensaje'=>'Cancelado']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['estado'=>'no','mensaje'=>'Error']);
        }
    }
}

