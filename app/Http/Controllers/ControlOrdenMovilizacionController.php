<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\OrdenMovilizacionDataTable;
use App\DataTables\OrdenMovilizacion\ConductorSolicitanteDataTable;
use App\DataTables\OrdenMovilizacion\Control\VehiculoDataTable;
use App\Http\Requests\OrdenMovilizacion\Control\RqAprobarReprobarGuardar;
use App\Models\Empresa;
use App\Models\OrdenMovilizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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

    public function AprobarReprobar(VehiculoDataTable $dataTableVehiculo,ConductorSolicitanteDataTable $dataTableConductor,$id)
    {
        
        $orden=OrdenMovilizacion::find($id);
        $data = array('orden' => $orden,'empresa'=>Empresa::first() ,'dataTableVehiculo'=>$dataTableVehiculo,'dataTableConductor'=>$dataTableConductor);

        if (request()->get('table') == 'vehiculos') {
            return $dataTableVehiculo->render('movilizacion.control.aprobarReprobar',$data);
        }
        return $dataTableConductor->render('movilizacion.control.aprobarReprobar',$data);
    }

    public function AprobarReprobarGuardar(RqAprobarReprobarGuardar $request)
    {
        $orden=OrdenMovilizacion::find($request->id_orden_parqueadero);
        $orden->estado=$request->accion;
        $orden->autorizado_id=Auth::id();
        $orden->conductor_id=$request->conductor;
        $orden->solicitante_id=$request->solicitante;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->save();
        $orden->vehiculo->conductor_id=$request->conductor;
        $orden->vehiculo->save();
        // enviar email al conductor
        request()->session()->flash('success','Orden de movilización '.$orden->estado);
        return redirect()->route('controlOdernMovilizacionAprobarReprobar',$orden->id);

    }

    public function AprobarReprobarPdf($id)
    {
        $headerHtml = view()->make('empresa.pdfHeader')->render();
        $footerHtml = view()->make('empresa.pdfFooter')->render();

        $orden=OrdenMovilizacion::find($id);
        $data = array('orden' => $orden);

       $pdf = PDF::loadView('movilizacion.pdf',$data)
        ->setOrientation('landscape')
        ->setOption('margin-top', '2.5cm')
        ->setOption('margin-bottom', '1cm')
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline('Orden '.$orden->numero.'.pdf');
    }
}
