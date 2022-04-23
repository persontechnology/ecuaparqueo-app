<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LecturaEspecial;
use Illuminate\Http\Request;

class LecturaEspecialController extends Controller
{
    public function ultimaLista(Request $request)
    {
        $le=LecturaEspecial::where('finalizado',false)->latest()->first();
        if($le){
            $le=[
                'id'=>$le->id,
                'mensaje' => 'Vehículo '.$le->vehiculo->placa.' en brazo '.$le->brazo->codigo.' solicita '.$le->tipo, 
                'tipo'=>$le->tipo,
                'fecha'=>$le->created_at->diffForHumans(),
                'titulo'=>'N° MÓVIL '.$le->vehiculo->numero_movil
            ];
        }
        return response()->json($le);
    }
    public function finalizarLectura(Request $request)
    {
        $le=LecturaEspecial::find($request->id);
        $le->finalizado=true;
        $le->guardia_id=$request->user()->id;
        $le->save();
        return response()->json('ok');
    }
}
