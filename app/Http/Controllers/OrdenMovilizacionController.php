<?php

namespace App\Http\Controllers;

use App\DataTables\OrdenMovilizacion\ConductorSolicitanteDataTable;
use App\Http\Requests\RqActualizarOrdenMovilizacion;
use App\Http\Requests\RqEliminarOrdenMOvilizacion;
use App\Http\Requests\RqGuardarOrdenMovilizacion;
use App\Models\Empresa;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\User;
use App\Models\Vehiculo;
use App\Notifications\OrdenMovilizacionIngresadaNoty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrdenMovilizacionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Orden de Movilización']);
    }

    public function index(ConductorSolicitanteDataTable $dataTable)
    {
        $parqueaderos=Parqueadero::where('estado','Activo')->get();
        $ordenes=OrdenMovilizacion::whereDate('fecha_salida','>=',Carbon::now()->subMonth(2))->get();
        $data = array(
            'empresa'=>Empresa::first(),
            'parqueaderos' => $parqueaderos,
            'numero'=>OrdenMovilizacion::NumeroSiguente(),
            'ordenesMovilizaciones'=>$ordenes
        );
        return $dataTable->render('movilizacion.calendar.index',$data);
        // return $dataTable->render('movilizacion.index');
    }
    
    public function guardar(RqGuardarOrdenMovilizacion $request)
    {
        $orden =new OrdenMovilizacion();        
        $orden->fecha_salida=Carbon::parse($request->fecha_salida);
        $orden->fecha_retorno=Carbon::parse($request->fecha_retorno);
        $orden->numero_ocupantes=$request->numero_ocupantes;
        $orden->procedencia=$request->procedencia;
        $orden->destino=$request->destino;
        $orden->comision_cumplir=$request->comision_cumplir;
        $orden->estado='SOLICITADO';
        
        $orden->solicitante_id=$request->solicitante;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->conductor_id=$request->conductor;
        // actualizar conductor de vehiculo
        $orden->vehiculo->conductor_id=$request->conductor;
        $orden->vehiculo->save();

        $orden->user_create=Auth::user()->id;
        $orden->save();
        
        $usuariosControlOrdenMovilizacion = User::permission('Control Orden de Movilización')->get();
        if($usuariosControlOrdenMovilizacion->count()>0){
            Notification::sendNow($usuariosControlOrdenMovilizacion, new OrdenMovilizacionIngresadaNoty($orden));
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' guardado. Se envió un correo a los '.$usuariosControlOrdenMovilizacion->count().' usuarios con permiso Control de Orden de movilización para su respectiva ACEPTACIÓN o DENAGACIÓN');
        }else{
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' guardado');
        }
        
        return redirect()->route('odernMovilizacion');

    }

    // RqActualizarOrdenMovilizacion
    public function actualizar(RqActualizarOrdenMovilizacion $request)
    {
        

        $orden =OrdenMovilizacion::find($request->id_orden_parqueadero);
        $orden->fecha_salida=Carbon::parse($request->fecha_salida);
        $orden->fecha_retorno=Carbon::parse($request->fecha_retorno);
        $orden->numero_ocupantes=$request->numero_ocupantes;
        $orden->procedencia=$request->procedencia;
        $orden->destino=$request->destino;
        $orden->comision_cumplir=$request->comision_cumplir;
        $orden->conductor_id=$request->conductor;
        $orden->solicitante_id=$request->solicitante;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->user_update=Auth::user()->id;
        $orden->save();
        // actualizar conductor de vehiculo
        $orden->vehiculo->conductor_id=$request->conductor;
        $orden->vehiculo->save();
        
        $usuariosControlOrdenMovilizacion = User::permission('Control Orden de Movilización')->get();
        if($usuariosControlOrdenMovilizacion->count()>0){
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' actualizado. Se envió un correo a los usuarios con permiso Control de Orden de movilización para su respectiva ACEPTACIÓN o DENAGACIÓN');
        }else{
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' actualizado');
        }
        return redirect()->route('odernMovilizacion');
    }

    public function eliminar(RqEliminarOrdenMOvilizacion $request)
    {
        
        $or=OrdenMovilizacion::find($request->id);
        try {
            $or->delete();
            
        } catch (\Throwable $th) {
            request()->session()->flash('success','Ordén de movilización no eliminado');
        }
        return redirect()->route('odernMovilizacion');
    }

    public function obtener(Request $request)
    {
        $orden=OrdenMovilizacion::with(['vehiculo','vehiculo.tipoVehiculo','conductor','solicitante'])->find($request->id);
        return $orden;
    }

    public function listado()
    {
        return view('movilizacion.calendar.listado');
    }
}
