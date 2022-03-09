<?php

namespace App\Http\Controllers;

use App\DataTables\Movilizacion\ConductorDataTable;
use App\DataTables\Movilizacion\VehiculoDataTable;
use App\Http\Requests\RqGuardarOrdenMovilizacion;
use App\Models\OrdenMovilizacion;
use Illuminate\Http\Request;

class OrdenMovilizacionController extends Controller
{
    public function index(ConductorDataTable $conductorDataTable, VehiculoDataTable $vehiculoDataTable)
    {
        $numero = OrdenMovilizacion::NumeroSiguente();
        $data = array(
            'conductorDataTable' => $conductorDataTable,
            'vehiculoDataTable'=>$vehiculoDataTable,
            'numero'=>$numero
         );
        if(request()->get('table')=='table_conductor'){
            return $conductorDataTable->render('movilizacion.index',$data);
        }
        
        return $vehiculoDataTable->render('movilizacion.index',$data);
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
        $orden->save();
        request()->session()->flash('success','Orden de movilización # '.$orden->numero.' guardado');
        return redirect()->route('odernMovilizacion');

    }
}
