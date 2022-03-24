<?php

namespace App\Http\Controllers;

use App\Models\Brazo;
use Illuminate\Http\Request;

class BrazoController extends Controller
{
    public function index()
    {
        
    }
    public function obtenerBrazo(Request $request)
    {
        $brazo = Brazo::where('codigo', $request->code)->first();
        if ($brazo) {
            if ($brazo->estado) {
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
            $brazo->estado=!$brazo->estado;
            if ($brazo->save()) {
                return response()->json(1);
            } else {
                return response()->json(0);
            }
        } else {

            return response()->json(3);
        }
    }
}
