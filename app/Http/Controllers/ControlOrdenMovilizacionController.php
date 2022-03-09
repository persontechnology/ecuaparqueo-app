<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\OrdenMovilizacionDataTable;
use App\Models\OrdenMovilizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlOrdenMovilizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Control Orden de Movilización']);
    }
    public function index(OrdenMovilizacionDataTable $dataTable)
    {
        return $dataTable->render('movilizacion.control.index');
    }
    public function estado(Request  $request)
    {
        $request->validate([
            'id'=>'required|exists:orden_movilizacions,id'
        ]);
        $orden=OrdenMovilizacion::find($request->id);

        if($orden->estado=='ESPERA' || $orden->estado=='DENEGADA'){
            $orden->estado='ACEPTADA';
            request()->session()->flash('success',"Orden de movilización {$orden->numero} {$orden->estado}");
            $orden->user_acepted=Auth::user()->id;
        }else{
            $orden->estado='DENEGADA';
            request()->session()->flash('warning',"Orden de movilización {$orden->numero} {$orden->estado}");
            $orden->user_denegated=Auth::user()->id;
        }
        $orden->save();

        
        return redirect()->route('controlOdernMovilizacion');

    }
}
