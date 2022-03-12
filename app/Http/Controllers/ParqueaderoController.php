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
        $ee = Parqueadero::where('estado', 'Activo')->with('guardias')->get();
        $ss = $ee->pluck('guardias');
        return $ss->pluck('id');
        $guardias = User::role('Guardia')->whereNotIn('id', $this->idsGuardiasActivos())->get();
        return view('parqueaderos.nuevo', ['guardias' => $guardias]);
    }
    public function guardar(RqGuardar $request)
    {
        return $request;
        $idsUser = $this->idsGuardiasActivos();
        try {
            DB::transaction(function () use ($request,  $idsUser) {
                $parqueadero = new Parqueadero();
                $parqueadero->nombre = $request->nombre;
                $parqueadero->descripcion = $request->descripcion;
                $parqueadero->direccion = $request->direccion;
                $parqueadero->numero_total = $request->numero_total;
                $parqueadero->user_create = Auth::user()->id;
                $parqueadero->save();
                if ($request->has('guardias')) {
                    foreach ($request->guardias as $guardia) {
                        $key = array_search($guardia, $idsUser);
                        if (!$key) {
                            $guardiaParqueadero = new GuardiaParqueadero();
                            $guardiaParqueadero->parqueadero_id = $parqueadero->id;
                            $guardiaParqueadero->guardia_id = $guardia;
                            $guardiaParqueadero->user_create = Auth::user()->id;
                            $guardiaParqueadero->save();
                        }
                    }
                }
                DB::commit();
            });
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
        $park = Parqueadero::find($id);


        // $parqueadero = Parqueadero::with(['guardias' => function ($guardias) {
        //     $guardias->where('estado', 'Activo');
        // }])->findOrFail($id);
        $usuarios = User::role('Guardia')->whereNotIn('id', $park->guardias->pluck('id'))->get();
   


        return view('parqueaderos.editar', ['parqueadero' => $park, 'guardias' => $park->guardias->merge($usuarios)]);
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
    public function idsGuardiasActivos()
    {
        $ids = [];
        $guardiasArqueaderos = Parqueadero::with(['guardias' => function ($guardias) {
            $guardias->where('estado', 'ACTIVO');
        }])->get();
        $guadiasAcivos = $guardiasArqueaderos->pluck('guardias');
        if (count($guadiasAcivos) > 0) {
            foreach ($guadiasAcivos as $activos) {
                foreach ($activos as $ac) {
                    array_push($ids, $ac->guardia_id);
                }
            }
        }
        return $ids;
    }
}
