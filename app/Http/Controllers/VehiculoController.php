<?php

namespace App\Http\Controllers;


use App\DataTables\Vehiculos\ConductorDataTable;
use App\DataTables\Vehiculos\VehiculoDataTable;
use App\Http\Requests\RqActualizarVehiculo;
use App\Http\Requests\RqGuardarVehiculo;
use App\Models\Kilometraje;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Vehículos']);
    }
    public function index(VehiculoDataTable $dataTable)
    {

        return $dataTable->render('vehiculos.index',['tiposVehiculos'=>TipoVehiculo::get()]);
    }

    public function guardarTipo(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:255|unique:tipo_vehiculos,nombre'
        ]);
        $tv=new TipoVehiculo();
        $tv->nombre=$request->nombre;
        $tv->save();
        request()->session()->flash('success','Nuevo tipo de vehículo guardado');
        return redirect()->route('vehiculos');
    }

    public function eliminarTipo(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:tipo_vehiculos,id'
        ]);
        $tv=TipoVehiculo::find($request->id);
        try {
            $tv->delete();
            request()->session()->flash('success','Tipo de vehículo eliminado');
        } catch (\Throwable $th) {
            request()->session()->flash('success','Tipo de vehículo no eliminado');
        }
        return redirect()->route('vehiculos');
    }

    public function nuevo(ConductorDataTable $dataTable)
    {
        return $dataTable->render('vehiculos.nuevo',['tipoVehiculos'=>TipoVehiculo::get()]);
    }

    public function guardar(RqGuardarVehiculo $request)
    {
        $ve=new Vehiculo();

        $ve->numero_movil=$request->numero_movil;
        $ve->modelo=$request->modelo;
        $ve->marca=$request->marca;
        $ve->placa=$request->placa;
        $ve->color=$request->color;
        $ve->conductor_id=$request->conductor;
        $ve->estado=$request->estado;
        $ve->descripcion=$request->descripcion;
        $ve->imei=$request->imei;
        $ve->tipo_vehiculo_id=$request->tipo;

        $ve->user_create=Auth::user()->id;
        $ve->save();
        if ($request->hasFile('foto')) {
            $archivo=$request->file('foto');
            if ($archivo->isValid()) {
                $path = Storage::putFileAs(
                    'public/vehiculos', $archivo, $ve->id.'.'.$archivo->extension()
                );
                $ve->foto=$path;
            }
        }
        if($request->has('kilometraje')){
            $kilometraje= new Kilometraje();
            $kilometraje->vehiculo_id=$ve->id;
            $kilometraje->numero=$request->kilometraje;
            $kilometraje->save();
            $ve->kilometraje_id=$kilometraje->id;
        }

        $ve->save();
        request()->session()->flash('success','Vehículo guardado');
        return redirect()->route('vehiculos');
    }

    public function editar(ConductorDataTable $dataTable,$id)
    {
        $ve=Vehiculo::find($id);
        $tipo=TipoVehiculo::get();
        return $dataTable->render('vehiculos.editar',['vehiculo'=>$ve,'tipoVehiculos'=>$tipo]);
    }
    public function actualizar(RqActualizarVehiculo $request)
    {
        $ve=Vehiculo::find($request->id);
        $ve->numero_movil=$request->numero_movil;
        $ve->modelo=$request->modelo;
        $ve->marca=$request->marca;
        $ve->placa=$request->placa;
        $ve->color=$request->color;
        $ve->conductor_id=$request->conductor;
        $ve->estado=$request->estado;
        $ve->descripcion=$request->descripcion;
        $ve->imei=$request->imei;
        $ve->tipo_vehiculo_id=$request->tipo;
        $ve->user_update=Auth::user()->id;
        
        if ($request->hasFile('foto')) {
            $archivo=$request->file('foto');
            if ($archivo->isValid()) {
                Storage::delete($ve->foto);
                $path = Storage::putFileAs(
                    'public/vehiculos', $archivo, $ve->id.'.'.$archivo->extension()
                );
                $ve->foto=$path;
            }
        }

        $ve->save();
        request()->session()->flash('success','Vehículo actualizado');
        return redirect()->route('vehiculos');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:vehiculos,id'
        ]);
        $ve=Vehiculo::find($request->id);
        try {
            if($ve->delete()){
                Storage::delete($ve->foto);
            }
            request()->session()->flash('success','Vehículo eliminado');
        } catch (\Throwable $th) {
            request()->session()->flash('info','Vehículo no eliminado');
        }
        return redirect()->route('vehiculos');
    }
}
