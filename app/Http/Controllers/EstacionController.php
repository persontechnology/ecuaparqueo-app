<?php

namespace App\Http\Controllers;

use App\DataTables\EstacionDataTable;
use App\Models\Estacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Estación de servicios']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EstacionDataTable $dataTable)
    {
       return $dataTable->render('estacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $despachadores=User::role('Despachador')->get();
        return view('estacion.crear',['despachadores'=>$despachadores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:255|unique:estacions,nombre',
            'despachador'    => 'required|array',
            'despachador.*'  => 'required|exists:users,id',
        ]);
        
        try {
            DB::beginTransaction();
            $estacion=new Estacion();
            $estacion->nombre=$request->nombre;
            $estacion->save();
            $estacion->despachadores()->sync($request->despachador);
            DB::commit();
            request()->session()->flash('success','Estación ingresada');
        } catch (\Throwable $th) {
            request()->session()->flash('success','Ocurrio un error, vuelva intentar o consulte con administrador');
            DB::rollback();
        }
        return redirect()->route('estacion.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function show(Estacion $estacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Estacion $estacion)
    {
        $despachadores=User::role('Despachador')->get();
        $data = array('despachadores' => $despachadores,'estacion'=>$estacion );
        return view('estacion.editar',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estacion $estacion)
    {
        $request->validate([
            'nombre'=>'required|string|max:255|unique:estacions,nombre,'.$estacion->id,
            'despachador'    => 'required|array',
            'despachador.*'  => 'required|exists:users,id',
        ]);
        
        try {
            DB::beginTransaction();
            $estacion->nombre=$request->nombre;
            $estacion->save();
            $estacion->despachadores()->sync($request->despachador);
            DB::commit();
            request()->session()->flash('success','Estación actualizado');
        } catch (\Throwable $th) {
            request()->session()->flash('success','Ocurrio un error, vuelva intentar o consulte con administrador');
            DB::rollback();
        }
        return redirect()->route('estacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estacion $estacion)
    {
        try {
            DB::beginTransaction();
            $estacion->despachadores()->detach();
            $estacion->delete();
            DB::commit();
            request()->session()->flash('success','Estación eliminado');
            
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('danger','Ocurrio un error, vuelva intentar o consulte con administrador');
            
        }
        return redirect()->route('estacion.index');
    }
}
