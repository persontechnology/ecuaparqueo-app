<?php

namespace App\Http\Controllers;
use App\Http\Requests\RqActualizarOrdenMovilizacion;
use App\Http\Requests\RqEliminarOrdenMOvilizacion;
use App\Http\Requests\RqGuardarOrdenMovilizacion;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\User;
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

    public function index()
    {
        $parqueaderos=Parqueadero::where('estado','Activo')->get();
        $data = array(
            'parqueaderos' => $parqueaderos,
            'numero'=>OrdenMovilizacion::NumeroSiguente(),
            'ordenesMovilizaciones'=>OrdenMovilizacion::whereMonth('fecha_salida',Carbon::now()->month)->get()
        );
        return view('movilizacion.calendar.index',$data);
        // return $dataTable->render('movilizacion.index');
    }

    public function guardar(RqGuardarOrdenMovilizacion $request)
    {
        
        $orden =new OrdenMovilizacion();
        $orden->fecha_salida=Carbon::parse($request->fecha_salida);
        $orden->vehiculo_id=$request->vehiculo;
        $orden->servidor_publico=$request->servidor_publico;
        $orden->direccion=$request->direccion;
        $orden->lugar_comision=$request->lugar_comision;
        $orden->motivo=$request->motivo;
        $orden->fecha_retorno=Carbon::parse($request->fecha_retorno);
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


    public function actualizar(RqActualizarOrdenMovilizacion $request)
    {
        $orden =OrdenMovilizacion::find($request->id_orden_parqueadero);
        $orden->fecha_salida=$request->fecha_salida;
        $orden->fecha_retorno=$request->fecha_retorno;
        $orden->vehiculo_id=$request->vehiculo;
        $orden->servidor_publico=$request->servidor_publico;
        $orden->direccion=$request->direccion;
        $orden->lugar_comision=$request->lugar_comision;
        $orden->motivo=$request->motivo;
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
        $orden=OrdenMovilizacion::with('vehiculo')->find($request->id);
        return $orden;
    }
}
