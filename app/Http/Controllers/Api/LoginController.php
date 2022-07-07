<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RqLogin;
use App\Models\User;
use App\Notifications\ResetPasswordNoty;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
    public function login(RqLogin $request)
    {   
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if($user->estado==='Activo')        {
                return response()->json([
                    'message'=>'ok',
                    'user'=>[
                        'id'=>$user->id,
                        'name'=>$user->name,
                        'apellidos'=>$user->apellidos,
                        'nombres'=>$user->nombres,
                        'email'=>$user->email,
                        'estado'=>$user->estado
                    ],
                    'roles_permisos'=> Arr::collapse( [$user->getRoleNames(),$user->getAllPermissions()->pluck('name')]),
                    'token'=>$user->createToken($request->email)->plainTextToken
                ]);
            }else{
                throw ValidationException::withMessages([
                    'email' => ['Acceso denegado, la cuenta se encuentra inactiva'],
                ]);    
            }
        }else{
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }
        
        
    }

    public function resetPassword(Request $request)
    {
        
        $request->validate([
            'email'=>'required|exists:users,email',
            'deviceName'=>'nullable'
        ]);
        try {
            DB::beginTransaction();
            $user=User::where('email',$request->email)->first();
            $password=Str::random(20);
            $user->apellidos="loko";
            $user->password=Hash::make($password);
            $user->save();
            $data = array('device' => $request->deviceName,'password'=> $password);
            $user->notify(new ResetPasswordNoty($data));
            DB::commit();
            return response()->json([
                'estado'=>'ok',
                'mensaje'=>'Se envió información al correo '.$request->email.' para restablecer la contraseña',
            ]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'estado'=>'ok',
                'mensaje'=>'Ocurrio un error. Contacte con administrador',
            ]);
        }
                
        
    }
}
