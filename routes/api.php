<?php

use App\Http\Controllers\Api\BrazoController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LecturaController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\NotificacionLecturaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Deivid; Acceso a la API
Route::post('/login', [LoginController::class,'login']);
Route::post('/reset-password', [LoginController::class,'resetPassword']);

// Fabian, Acceso a los brazos code
Route::post('/obtener-brazo', [BrazoController::class,'obtenerBrazo']);
Route::post('/cerrar-brazo', [BrazoController::class,'cerrarBrazo']);
Route::post('/buscar-vehiculo-tarjeta', [BrazoController::class,'buscarVehiculoTarjeta']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum','throttle:1000,1'])->group(function(){
    Route::post('/actualizar-contrasena', [HomeController::class,'actualizarContrasena']);
    Route::post('/lectura-salida-vehicular', [LecturaController::class,'salida']);
    Route::post('/lectura-entrada-vehicular', [LecturaController::class,'consultaLecturaEntrada']);

    // notificaciones
    Route::post('/lista-notificaciones-lectura', [NotificacionLecturaController::class,'consultaLecturaEntrada']);

});
