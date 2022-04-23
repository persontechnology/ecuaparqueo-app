<?php

namespace App\Http\Controllers;

use App\Models\LecturaInvitado;
use Illuminate\Http\Request;

class LecturaInvitadoController extends Controller
{
    public function diezUltimasLista(Request $request)
    {
        $lis= LecturaInvitado::where('finalizado',false)->get();
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

    public function detalle(Request $request)
    {
        $li=LecturaInvitado::find($request->id);
        $li->tipo='Revisión';
        $li->save();
        return response()->json('ok');
    }
}
