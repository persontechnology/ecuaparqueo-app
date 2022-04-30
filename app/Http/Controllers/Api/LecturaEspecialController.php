<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LecturaEspecial;
use Illuminate\Http\Request;

class LecturaEspecialController extends Controller
{
   
    public function diezUltimasLista(Request $request)
    {
        $lis= LecturaEspecial::where('finalizado',false)->latest()->take(5)->get();
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

    public function finalizarLectura(Request $request)
    {
        $le=LecturaEspecial::find($request->id);
        $le->finalizado=true;
        $le->guardia_id=$request->user()->id;
        $le->save();
        return response()->json('ok');
    }
}
