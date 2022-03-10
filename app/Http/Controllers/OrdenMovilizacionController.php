<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\ConductorDataTable;
use App\DataTables\Movilizacion\VehiculoDataTable;
use App\DataTables\OrdenMovilizacionDataTable;
use App\Http\Requests\RqActualizarOrdenMovilizacion;
use App\Http\Requests\RqGuardarOrdenMovilizacion;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\User;
use App\Notifications\OrdenMovilizacionIngresadaNoty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrdenMovilizacionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Orden de Movilización']);
    }

    public function index(OrdenMovilizacionDataTable $dataTable)
    {
        $parqueaderos=Parqueadero::where('estado','Activo')->get();
        $data = array('parqueaderos' => $parqueaderos );
        return view('movilizacion.calendar.index',$data);
        // return $dataTable->render('movilizacion.index');
    }

    public function nuevo(ConductorDataTable $conductorDataTable, VehiculoDataTable $vehiculoDataTable)
    {
        $numero = OrdenMovilizacion::NumeroSiguente();
        $data = array(
            'conductorDataTable' => $conductorDataTable,
            'vehiculoDataTable'=>$vehiculoDataTable,
            'numero'=>$numero
         );
        if(request()->get('table')=='table_conductor'){
            return $conductorDataTable->render('movilizacion.nuevo',$data);
        }
        
        return $vehiculoDataTable->render('movilizacion.nuevo',$data);
    }

    public function guardar(RqGuardarOrdenMovilizacion $request)
    {
        
        $orden =new OrdenMovilizacion();
        $orden->fecha_salida=$request->fecha_salida;
        $orden->user_id=$request->conductor;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->servidor_publico=$request->servidor_publico;
        $orden->direccion=$request->direccion;
        $orden->lugar_comision=$request->lugar_comision;
        $orden->motivo=$request->motivo;
        $orden->hora_salida=$request->hora_salida;
        $orden->hora_retorno=$request->hora_retorno;
        $orden->user_create=Auth::user()->id;
        $orden->save();
        
        $usuariosControlOrdenMovilizacion = User::permission('Control Orden de Movilización')->get();
        if($usuariosControlOrdenMovilizacion->count()>0){
            Notification::sendNow($usuariosControlOrdenMovilizacion, new OrdenMovilizacionIngresadaNoty($orden));
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' guardado. Se envió un correo a los usuarios con permiso Control de Orden de movilización para su respectiva ACEPTACIÓN o DENAGACIÓN');
        }else{
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' guardado');
        }
        
        return redirect()->route('odernMovilizacion');

    }

    public function editar(ConductorDataTable $conductorDataTable, VehiculoDataTable $vehiculoDataTable,$id)
    {

        $orden = OrdenMovilizacion::find($id);
        $data = array(
            'conductorDataTable' => $conductorDataTable,
            'vehiculoDataTable'=>$vehiculoDataTable,
            'orden'=>$orden
         );
        if(request()->get('table')=='table_conductor'){
            return $conductorDataTable->render('movilizacion.editar',$data);
        }
        
        return $vehiculoDataTable->render('movilizacion.editar',$data);
    }

    public function actualizar(RqActualizarOrdenMovilizacion $request)
    {
        $orden =OrdenMovilizacion::find($request->id);
        $orden->fecha_salida=$request->fecha_salida;
        $orden->user_id=$request->conductor;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->servidor_publico=$request->servidor_publico;
        $orden->direccion=$request->direccion;
        $orden->lugar_comision=$request->lugar_comision;
        $orden->motivo=$request->motivo;
        $orden->hora_salida=$request->hora_salida;
        $orden->hora_retorno=$request->hora_retorno;
        $orden->estado=$request->estado;
        $orden->user_update=Auth::user()->id;
        $orden->save();
        $usuariosControlOrdenMovilizacion = User::permission('Control Orden de Movilización')->get();
        if($usuariosControlOrdenMovilizacion->count()>0){
            Notification::sendNow($usuariosControlOrdenMovilizacion, new OrdenMovilizacionIngresadaNoty($orden));
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' actualizado. Se envió un correo a los usuarios con permiso Control de Orden de movilización para su respectiva ACEPTACIÓN o DENAGACIÓN');
        }else{
            request()->session()->flash('success','Orden de movilización '.$orden->numero.' actualizado');
        }
        return redirect()->route('odernMovilizacion');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:orden_movilizacions,id'
        ]);
        $or=OrdenMovilizacion::find($request->id);
        try {
            if($or->estado=='ESPERA'){
                $or->delete();
                request()->session()->flash('success','Ordén de Movilización eliminado');
            }else{
                request()->session()->flash('success','No se puede eliminar Ordén de Movilización, en estado '.$or->estado);
            }
            
        } catch (\Throwable $th) {
            request()->session()->flash('success','Ordén de movilización no eliminado');
        }
        return redirect()->route('odernMovilizacion');
    }
}
