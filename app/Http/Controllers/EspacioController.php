<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;

class EspacioController extends Controller
{
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
