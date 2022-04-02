<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\RqLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiLoginController extends Controller
{
    public function login(RqLogin $request)
    {   
        $user = User::where('email', $request->email)->first();
     
        if( $user){
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message'=>'success',
                    'user'=>$user,
                    '_token'=>$user->createToken($request->device_name)->plainTextToken
                ]);        
            }else{
                return response()->json([
                    'message'=>'Contraseña incorrecta.'
                ]);
            }
        }else{
            return response()->json([
                'message'=>'No existe usuario con '.$request->email
            ]);
        }
    }
}
