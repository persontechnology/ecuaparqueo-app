<?php

namespace App\Http\Controllers;

use App\Http\Requests\Espacios\RqGuardar;
use App\Models\Espacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspacioController extends Controller
{
    public function guardar(RqGuardar $request)
    {
        $espacioObj = Espacio::where(['parqueadero_id' => $request->parqueadero_id])->orderBy('created_at', 'desc')->limit(1)->first();

        $espacio = new Espacio();
        $espacio->numero = $request->numero;
        $espacio->vehiculo_id = $request->vehiculo_id;
        $espacio->parqueadero_id = $request->parqueadero_id;
        $espacio->left = $espacioObj->left ?? 26;
        $espacio->top = $espacioObj->top ?? 10;
        $espacio->user_create = Auth::user()->id;
        $espacio->save();
        request()->session()->flash('success', 'Estacionamiento creada');
        return redirect()->route('parqueaderosListaEspacios', $espacio->parqueadero_id);
    }
    public function actualizarTodos(Request $request)
    {
        $data = $request->validate([
            'espacios*' => 'required'
        ]);

        foreach ($request['espacios'] as $establecimiento) {
            $actualizarEstablecimiento = Espacio::find($establecimiento['id']);
            if ($actualizarEstablecimiento) {
                $actualizarEstablecimiento->left = $establecimiento['left'];
                $actualizarEstablecimiento->top = $establecimiento['top'];
                $actualizarEstablecimiento->save();
            }
        }
        return response()->json(['tipo' => 'success', 'msj' => "Datos  actualizados exitosamente..."]);
    }
}
