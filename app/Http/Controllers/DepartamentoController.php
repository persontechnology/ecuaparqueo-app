<?php

namespace App\Http\Controllers;

use App\DataTables\DepartamentoDataTable;
use App\Http\Requests\RqActualizarDepartamento;
use App\Http\Requests\RqGuardarDepartamento;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Departamentos']);
    }

    public function index(DepartamentoDataTable $dataTable)
    {
        return $dataTable->render('departamentos.index');
    }
    public function nuevo()
    {
        $data = array(
            'usuarios'=>User::role('Supervisor')->get()
        );
        return view('departamentos.nuevo',$data);
    }

    public function guardar(RqGuardarDepartamento $request)
    {
        $depa=new Departamento();
        $depa->nombre=$request->nombre;
        $depa->descripcion=$request->descripcion;
        $depa->empresa_id=Empresa::first()->id;
        $depa->user_id=$request->supervisor;
        $depa->user_create=Auth::user()->id;
        $depa->save();
        request()->session()->flash('success','Departamento creado');
        return redirect()->route('departamentos');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:departamentos,id',
        ]);
        try {
            DB::beginTransaction();
            $depa=Departamento::find($request->id);
            $depa->delete();
            DB::commit();
            request()->session()->flash('success','Departamento eliminado');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('info','Departamento no eliminado');
        }
        return redirect()->route('departamentos');

    }

    public function editar($id)
    {
        
        $data = array(
            'usuarios'=>User::role('Supervisor')->get(),
            'dep'=>Departamento::find($id)
        );
        return view('departamentos.editar',$data);
    }
    public function actualizar(RqActualizarDepartamento $request)
    {
        $depa=Departamento::find($request->id);
        $depa->nombre=$request->nombre;
        $depa->descripcion=$request->descripcion;
        $depa->user_id=$request->supervisor;
        $depa->user_create=Auth::user()->id;
        $depa->save();
        request()->session()->flash('success','Departamento actualizado');
        return redirect()->route('departamentos');
    }
}
