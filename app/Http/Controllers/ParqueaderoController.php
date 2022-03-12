<?php

namespace App\Http\Controllers;

use App\DataTables\ParqueaderoDataTable;
use App\Http\Requests\Parqueaderos\RqActualizar;
use App\Http\Requests\Parqueaderos\RqGuardar;
use App\Models\Espacio;
use App\Models\GuardiaParqueadero;
use App\Models\Parqueadero;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParqueaderoController extends Controller
{

    public function index(ParqueaderoDataTable $dataTable)
    {
        $this->middleware(['permission:Parqueadero']);
        return $dataTable->render('parqueaderos.index');
    }
    public function nuevo()
    {
        $guardiasArqueaderos = Parqueadero::with(['guardias' => function ($guardias) {
            $guardias->where('estado', 'ACTIVO');
        }]);
        $guardias = User::role('Guardia')->get();
        return view('parqueaderos.nuevo', ['guardias' => $guardias]);
    }
    public function guardar(RqGuardar $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $parqueadero = new Parqueadero();
                $parqueadero->nombre = $request->nombre;
                $parqueadero->descripcion = $request->descripcion;
                $parqueadero->direccion = $request->direccion;
                $parqueadero->numero_total = $request->numero_total;
                $parqueadero->user_create = Auth::user()->id;
                $parqueadero->save();
                if ($request->has('guardias')) {
                    foreach ($request->guardias as $guardia) {
                        $guardiaParqueadero = new GuardiaParqueadero();
                        $guardiaParqueadero->parqueadero_id = $parqueadero->id;
                        $guardiaParqueadero->guardia_id = $guardia;
                        $guardiaParqueadero->user_create = Auth::user()->id;
                        $guardiaParqueadero->save();
                    }
                }
                DB::commit();
            });
            request()->session()->flash('success', 'Parqueadero creado');
            return redirect()->route('parqueaderos');
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('danger', 'Parqueadero no ingresado');
            return redirect()->route('parqueaderos');
        }
    }

    public function editar($id)
    {
        $parqueadero = Parqueadero::findOrFail($id);
        $guardias = User::role('Guardia')->get();
        return view('parqueaderos.editar', ['parqueadero' => $parqueadero, 'guardias' => $guardias]);
    }
    public function actualizar(RqActualizar $request)
    {
        $parqueadero = Parqueadero::find($request->id);
        $parqueadero->nombre = $request->nombre;
        $parqueadero->descripcion = $request->descripcion;
        $parqueadero->direccion = $request->direccion;
        $parqueadero->numero_total = $request->numero_total;
        $parqueadero->user_create = Auth::user()->id;
        $parqueadero->save();
        request()->session()->flash('success', 'Parqueadero actualizado');
        return redirect()->route('parqueaderos');
    }
    public function listarEspacios(Request $request, Parqueadero $parqueadero)
    {
        $espacios = $parqueadero->espacios()->with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje'])->get();
        $estacionamiento = Espacio::get();
        $vehiculos = Vehiculo::where('estado', 'ACTIVO')->whereNotIn('id', $estacionamiento->pluck('vehiculo_id'))->get();

        return view('espacios.index', ['espacios' => $espacios, 'vehiculos' => $vehiculos, 'parqueadero' => $parqueadero]);
    }
}
