<?php

namespace App\Http\Controllers;

use App\DataTables\ParqueaderoDataTable;
use App\Http\Requests\Parqueaderos\RqActualizar;
use App\Http\Requests\Parqueaderos\RqGuardar;
use App\Models\Espacio;
use App\Models\Parqueadero;
use App\Models\TipoVehiculo;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParqueaderoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:Parqueaderos']);
    }

    public function index(ParqueaderoDataTable $dataTable)
    {
        return $dataTable->render('parqueaderos.index');
    }
    public function nuevo()
    {
        $guardias = User::where('estado','Activo')->role('Guardia')->get();
        return view('parqueaderos.nuevo', ['guardias' => $guardias]);
    }
    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $parqueadero = new Parqueadero();
            $parqueadero->nombre = $request->nombre;
            $parqueadero->descripcion = $request->descripcion;
            $parqueadero->user_create = Auth::user()->id;
            $parqueadero->save();
            $parqueadero->guardias()->sync($request->guardias);
            DB::commit();
            request()->session()->flash('success', 'Parqueadero creado');
            return redirect()->route('parqueaderos');
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('danger', $e);
            return redirect()->route('parqueaderos');
        }
    }

    public function editar($id)
    {
        $parqueadero = Parqueadero::find($id);
        $guardias = $guardias = User::where('estado','Activo')->role('Guardia')->get();
        return view('parqueaderos.editar', ['parqueadero' => $parqueadero, 'guardias' => $guardias]);
    }
    public function actualizar(RqActualizar $request)
    {
        try {
            DB::beginTransaction();
            $parqueadero = Parqueadero::find($request->id);
            $parqueadero->nombre = $request->nombre;
            $parqueadero->descripcion = $request->descripcion;
            $parqueadero->user_update = Auth::user()->id;
            $parqueadero->save();
            $parqueadero->guardias()->sync($request->guardias);
            DB::commit();
            request()->session()->flash('success', 'Parqueadero actualizado');
            return redirect()->route('parqueaderos');
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('danger', 'Ocurrio un error, consulte con administrador o vuelva intentar.');
            return redirect()->route('parqueaderoEditar', $request->id);
        }
    }
    public function listarEspacios(Request $request, $parqueaderoId)
    {
        
        $parqueadero=Parqueadero::find($parqueaderoId);
        $espacios = $parqueadero->espacios()->with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje']);
        $tipos = TipoVehiculo::get();
        $estacionamiento = Espacio::get();
        // if ($request->has('estados') && $request->estados) {
        //     $espacios = $espacios->where('espacios.estado', $request->estado);
        // }
        $espacios = $espacios->get();
        $vehiculos = Vehiculo::where('estado', 'ACTIVO')->whereNotIn('id', $estacionamiento->pluck('vehiculo_id'))->get();

        return view('espacios.index', ['espacios' => $espacios, 'vehiculos' => $vehiculos, 'parqueadero' => $parqueadero, 'tipos' => $tipos]);
    }
    public function listarBrazos(Request $request, Parqueadero $parqueadero)
    {
        return view('brazos.index', ['parqueadero' => $parqueadero]);
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:parqueaderos,id'
        ]);
        $parqueadero=Parqueadero::find($request->id);
        try {
            DB::beginTransaction();
            $parqueadero->delete();
            DB::commit();
            request()->session()->flash('success','Parqueadero eliminado.');
        } catch (\Throwable $th) {
            request()->session()->flash('danger','No se puede eliminar '.$parqueadero->nombre.' ya que contiene información relacionada.');
            DB::rollback();
        }
        return redirect()->route('parqueaderos');
    }
}
