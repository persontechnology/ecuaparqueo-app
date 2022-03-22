<?php

namespace App\Http\Controllers;

use App\DataTables\ParqueaderoDataTable;
use App\Http\Requests\Parqueaderos\RqActualizar;
use App\Http\Requests\Parqueaderos\RqGuardar;
use App\Models\Espacio;
use App\Models\GuardiaParqueadero;
use App\Models\OrdenMovilizacion;
use App\Models\Parqueadero;
use App\Models\TipoVehiculo;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
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
        $guardias = User::role('Guardia')->whereNotIn('id', $this->idsGuardiasActivos())->get();
        return view('parqueaderos.nuevo', ['guardias' => $guardias]);
    }
    public function guardar(RqGuardar $request)
    {

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
        $paraqueadero = Parqueadero::find($id);
        $ids = $paraqueadero->guardias->pluck('id');
        $usuarios = User::role('Guardia')->whereNotIn('id', $ids->merge($this->idsGuardiasActivos()))->get();
        return view('parqueaderos.editar', ['parqueadero' => $paraqueadero, 'guardias' => $paraqueadero->guardias->merge($usuarios), 'ids' => $ids]);
    }
    public function actualizar(RqActualizar $request)
    {

        $idsUser = $this->idsGuardiasActivos();
        try {
            DB::transaction(function () use ($request,  $idsUser) {
                $parqueadero = Parqueadero::find($request->id);
                $parqueadero->nombre = $request->nombre;
                $parqueadero->descripcion = $request->descripcion;
                $parqueadero->direccion = $request->direccion;
                $parqueadero->numero_total = $request->numero_total;
                $parqueadero->user_create = Auth::user()->id;
                $parqueadero->save();

                GuardiaParqueadero::where('parqueadero_id', $parqueadero->id)->update(['estado' => 'Inactivo']);

                if ($request->has('guardias')) {

                    foreach ($request->guardias as $guardia) {
                        $guardiaEncontrado = GuardiaParqueadero::where(['guardia_id' => $guardia, 'estado' => 'Inactivo'])->first();
                        if ($guardiaEncontrado) {
                            $guardiaEncontrado->estado = 'Activo';
                            $guardiaEncontrado->save();
                        } else {
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
                }
                DB::commit();
            });
            request()->session()->flash('success', 'Parqueadero actualizado');
            return redirect()->route('parqueaderos');
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('danger', $e);
            return redirect()->route('parqueaderoEditar', $request->id);
        }
    }
    public function listarEspacios(Request $request, Parqueadero $parqueadero)
    {
        $espacios = $parqueadero->espacios()->with(['vehiculo.tipoVehiculo', 'vehiculo.kilometraje']);
        $tipos = TipoVehiculo::get();
        $estacionamiento = Espacio::get();
        if ($request->has('estados') && $request->estados) {
            $espacios = $espacios->where('espacios.estado', $request->estado);
        }
        $espacios = $espacios->get();
        $vehiculos = Vehiculo::where('estado', 'ACTIVO')->whereNotIn('id', $estacionamiento->pluck('vehiculo_id'))->get();

        return view('espacios.index', ['espacios' => $espacios, 'vehiculos' => $vehiculos, 'parqueadero' => $parqueadero, 'tipos' => $tipos]);
    }
    public function listarBrazos(Request $request, Parqueadero $parqueadero)
    {

        return view('espacios.index', ['parqueadero' => $parqueadero]);
    }
    public function idsGuardiasActivos()
    {
        $ids = [];
        $guardiasArqueaderos = Parqueadero::with('guardias')->get();
        $guadiasAcivos = $guardiasArqueaderos->pluck('guardias');
        if (count($guadiasAcivos) > 0) {
            foreach ($guadiasAcivos as $activos) {
                foreach ($activos as $ac) {
                    array_push($ids, $ac->id);
                }
            }
        }
        return $ids;
    }
}
