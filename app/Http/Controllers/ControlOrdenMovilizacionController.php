<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\OrdenMovilizacionDataTable;
use App\DataTables\OrdenMovilizacion\ConductorSolicitanteDataTable;
use App\Models\Empresa;
use App\Models\OrdenMovilizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlOrdenMovilizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Control Orden de Movilización']);
    }
    public function index()
    {
        return view('movilizacion.control.index');
    }

    public function AprobarReprobar(ConductorSolicitanteDataTable $dataTable,$id)
    {
        $orden=OrdenMovilizacion::find($id);
        $data = array('orden' => $orden,'empresa'=>Empresa::first() );
        return $dataTable->render('movilizacion.control.aprobarReprobar',$data);
    }
}
