<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\RqLogin;
use App\Models\User;
use App\Notifications\ResetPasswordNoty;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function login(RqLogin $request)
    {   
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'ok',
                'user'=>$user,
                'token'=>$user->createToken($request->device_name)->plainTextToken
            ]);        
        }
        
        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas son incorrectas.'],
        ]);
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
            $user->apellidos="jajajaj";
            $user->password=Hash::make($password);
            $user->save();
            $data = array('device' => $request->deviceName,'password'=> $password);
            $user->notify(new ResetPasswordNoty($data));

            return response()->json([
                'estado'=>'ok',
                'mensaje'=>'Se envió información al correo '.$request->email.' para restablecer la contraseña',
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'estado'=>'ok',
                'mensaje'=>'Ocurrio un error. Contacte con administrador',
            ]);
        }
                
        
    }
}
