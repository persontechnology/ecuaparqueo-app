<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Espacio;
use App\Models\LecturaInvitado;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturaInvitadoController extends Controller
{
    public function diezUltimasLista(Request $request)
    {
        $lis= LecturaInvitado::where('finalizado',false)->latest()->take(5)->get();
        $data = array();
        foreach ($lis as $le) {
            array_push($data,[
                'id'=>$le->id,
                'mensaje' => 'Vehículo invitado en brazo '.$le->brazo->codigo.' solicita '.$le->tipo, 
                'tipo'=>$le->tipo,
                'fecha'=>$le->created_at->diffForHumans(),
                'titulo'=>'N° MÓVIL X'
            ]);
        }
        return response()->json($data);
    }

    public function revision(Request $request)
    {
        $li= LecturaInvitado::find($request->id);
       $espacios= $li->brazo->parqueadero->espacios()->whereNull('vehiculo_id')->get();
        return response()->json(['espacios'=>$espacios,'lectura'=>$li]);
    }
    public function finalizar(Request $request)
    {
        $regPlaca="/^([A-Z]){3}-[0-9]{4}$/";
        $request->validate([
            'placa'=>'required|string|max:255|regex:'.$regPlaca,
            'motivo'=>'required|string|max:255',
            'espacio'=>'nullable|exists:espacios,id',
            'id'=>'required|exists:lectura_invitados,id'
        ]);
        try {
            DB::beginTransaction();
            $ve=Vehiculo::where('placa',$request->placa)->first();
            if(!$ve){
                $ve=new Vehiculo();
                $ve->numero_movil=$request->placa;
                $ve->placa=$request->placa;
                $ve->user_create=$request->user()->id;
                $ve->tipo='Invitados';
                $ve->save();
            }
            $li=LecturaInvitado::find($request->id);
            $li->motivo=$request->motivo;
            $li->finalizado=true;
            $li->fecha_entrada=Carbon::now();
            $li->vehiculo_id=$ve->id;
            $li->guardia_id=$request->user()->id;
            $li->espacio_id=$request->espacio;
            $li->save();
            
            if($request->espacio){
                foreach (Espacio::where('vehiculo_id',$ve->id)->get() as $e) {
                    $e->vehiculo_id=null;
                    $e->save();
                }
                $es=Espacio::find($request->espacio);
                $es->vehiculo_id=$ve->id;
                $es->estado='Ausente';
                $es->save();
            }
            
            $li->brazo->estado_brazo = true;
            $li->brazo->save();
            DB::commit();

            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('no');
        }

    }

    public function finalizarSalida(Request $request)
    {
        $regPlaca="/^([A-Z]){3}-[0-9]{4}$/";
        $request->validate([
            'placa'=>'required|string|max:255|regex:'.$regPlaca,
            'id'=>'required|exists:lectura_invitados,id'
        ]);
        try {
            DB::beginTransaction();
            $ve=Vehiculo::where('placa',$request->placa)->first();
            if(!$ve){
                $ve=new Vehiculo();
                $ve->numero_movil=$request->placa;
                $ve->placa=$request->placa;
                $ve->user_create=$request->user()->id;
                $ve->tipo='Invitados';
                $ve->save();
            }
            $li=LecturaInvitado::find($request->id);
            $li->finalizado=true;
            $li->fecha_salida=Carbon::now();
            $li->vehiculo_id=$ve->id;
            $li->guardia_id=$request->user()->id;
            $li->save();
            
            foreach (Espacio::where('vehiculo_id',$ve->id)->get() as $e) {
                $e->vehiculo_id=null;
                $e->estado='Presente';
                $e->save();
            }
                
            $li->brazo->estado_brazo = true;
            $li->brazo->save();
            DB::commit();

            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('no');
        }
    }

    public function eliminar(Request $request)
    {
        
        $request->validate([
            'id'=>'required|exists:lectura_invitados,id'
        ]);
        try {
            DB::beginTransaction();
           
            $li=LecturaInvitado::find($request->id);
            $li->brazo->estado_brazo=9;
            $li->brazo->save();
            $li->delete();
            
            DB::commit();

            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('no');
        }
    }
}
