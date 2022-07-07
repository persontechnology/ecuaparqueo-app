<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'userId'=>'required|exists:users,id',
            'pwdActual' => 'required|string|min:8|max:255',
            'pwdNueva' => 'required|string|min:8|max:255',
            'pwdRepita' => 'required|string|min:8|max:255|same:pwdNueva'
        ]);
        $user=User::find($request->userId);
        if (! $user || ! Hash::check($request->pwdActual, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }
        $user->password=Hash::make($request->pwdNueva);
        $user->save();
        return response()->json(['message'=>'ok']);
    }
}
