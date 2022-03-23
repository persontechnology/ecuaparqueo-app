<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\RqActualizarPerfil;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function index()
    {
        return view('usuarios.perfil',['user'=>Auth::user()]);
    }
    public function actualizar(RqActualizarPerfil $request)
    {
        try {
            $user=Auth::user();
            $user->apellidos=$request->apellidos;
            $user->nombres=$request->nombres;
            $user->telefono=$request->telefono;
            $user->documento=$request->documento;
            $user->cuidad=$request->cuidad;
            $user->direccion=$request->direccion;
            $user->descripcion=$request->descripcion;

            if ($request->hasFile('foto')) {
                $archivo=$request->file('foto');
                if ($archivo->isValid()) {
                    Storage::delete($user->foto);
                    $path = Storage::putFileAs(
                        'public/avatars', $archivo, $user->id.'.'.$archivo->extension()
                    );
                    $user->foto=$path;
                }
            }
            
            $user->user_update=Auth::user()->id;
            $user->save();
            request()->session()->flash('success','Perfil actualizado');
        } catch (\Throwable $th) {
            request()->session()->flash('info','Error al actualizar perfil');
        }
        return redirect()->route('perfil');
    }

    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'contrasena'=>'required|string',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=Auth::user();
        if (Hash::check($request->contrasena, $user->password)) {
            $user->password=Hash::make($request->password);
            $user->user_update=Auth::user()->id;
            $user->save();
            request()->session()->flash('success','Contraseña actualizada');
        }else{
            request()->session()->flash('info','Contraseña actual incorrecta');
        }
        return redirect()->route('perfil');
    }

    public function configuracion()
    {
        $conf=Auth::user()->configuracion;
        if(!$conf){
            $conf=new Configuracion();
            $conf->user_id=Auth::user()->id;
            $conf->save();
        }
        return view('usuarios.configuracion',['configuracion'=>$conf]);
    }

    public function actualizarConfiguracion(Request $request)
    {
        $request->validate([
            'tema'=>'required|in:Default,primary,secondary,danger,success,warning,info,dark,pink,purple,indigo,teal,yellow',
            'reduccion'=>'required|in:1,0',
            'menu'=>'required|in:dark,light',
        ]);
        $conf=Auth::user()->configuracion;
        $conf->tema=$request->tema;
        $conf->reduccion=$request->reduccion;
        $conf->menu=$request->menu;
        $conf->save();
        request()->session()->flash('success','Configuración actualizado');
        return redirect()->route('configuracion');

    }
}
