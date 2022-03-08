<?php

namespace App\Http\Controllers;

use App\DataTables\ParqueaderoDataTable;
use App\Http\Requests\Parqueaderos\RqActualizar;
use App\Http\Requests\Parqueaderos\RqGuardar;
use App\Models\Parqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParqueaderoController extends Controller
{
    public function index(ParqueaderoDataTable $dataTable)
    {
        return $dataTable->render('parqueaderos.index');
    }
    public function nuevo()
    {
        return view('parqueaderos.nuevo');
    }
    public function guardar(RqGuardar $request)
    {
        $parqueadero = new Parqueadero();
        $parqueadero->nombre = $request->nombre;
        $parqueadero->descripcion = $request->descripcion;
        $parqueadero->direccion = $request->direccion;
        $parqueadero->numero_total = $request->numero_total;
        $parqueadero->user_create = Auth::user()->id;
        $parqueadero->save();
        request()->session()->flash('success', 'Parqueadero creado');
        return redirect()->route('parqueaderos');
    }

    public function editar($id)
    {
        $parqueadero = Parqueadero::findOrFail($id);
        //return $parqueadero;
        return view('parqueaderos.editar', ['parqueadero'=>$parqueadero]);
    }
    public function actualizar(RqActualizar $request)
    {
        $parqueadero=Parqueadero::find($request->id);
        $parqueadero->nombre = $request->nombre;
        $parqueadero->descripcion = $request->descripcion;
        $parqueadero->direccion = $request->direccion;
        $parqueadero->numero_total = $request->numero_total;
        $parqueadero->user_create=Auth::user()->id;
        $parqueadero->save();
        request()->session()->flash('success','Parqueadero actualizado');
        return redirect()->route('parqueaderos');
    }
}
