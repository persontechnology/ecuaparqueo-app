<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesPermisosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:SuperAdmin|SiteAdmin']);
    }


    public function index()
    {
        $roles=Role::whereNotIn('name', ['SuperAdmin','SiteAdmin'])->get();
        $permisos=Permission::get();
        $data = array(
            'permisos' => $permisos,
            'roles'=>$roles
         );
        return view('roles.index',$data);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'permisos'    => 'required|array',
            'permisos.*'  => 'required|exists:permissions,id',
            'rol' => 'required|unique:roles,name|max:255',
        ]);
        try {
            DB::beginTransaction();
            $role=Role::create(['name' => $request->rol]);
            $role->syncPermissions($request->permisos);
            request()->session()->flash('success','Rol creado');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('success','Rol no creado, vuelva intentar');
        }
        return redirect()->route('roles');
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'permisos'    => 'nullable|array',
            'permisos.*'  => 'nullable|exists:permissions,id',
            'id' => 'required|exists:roles,id',
        ]);
        try {
            DB::beginTransaction();
            $role=Role::findOrFail($request->id);
            $role->syncPermissions($request->permisos);
            request()->session()->flash('success','Permisos actualizado');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('success','Permiso no actualizado, vuelva intentar');
        }
        return redirect()->route('roles');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        try {
            
            $role=Role::find($request->id);
            if(in_array($role->name,['SuperAdmin','SiteAdmin','Supervisor','Operador','Despachador'])){
                request()->session()->flash('info','No se puede eliminar rol '.$role->name);    
            }else{
                DB::beginTransaction();
                $role->delete();
                DB::commit();
                request()->session()->flash('success','Role eliminado');
            }
            
        } catch (\Throwable $th) {
            request()->session()->flash('info','Role no eliminado');
        }
        return redirect()->route('roles');
    }
}
