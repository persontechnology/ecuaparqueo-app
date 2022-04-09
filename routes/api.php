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
Route::get('/obtener-brazo', [BrazoController::class,'obtenerBrazo']);
Route::get('/cerrar-brazo', [BrazoController::class,'cerrarBrazo']);
Route::get('/buscar-vehiculo-tarjeta', [BrazoController::class,'buscarVehiculoTarjeta']);
Route::get('/buscar-vehiculo-tarjeta-salida', [BrazoController::class,'buscarVehiculoTarjetaSalida']);
Route::get('/buscar-vehiculo-tarjeta-entrada', [BrazoController::class,'buscarVehiculoTarjetaEntrada']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/actualizar-contrasena', [HomeController::class,'actualizarContrasena']);
    Route::post('/lectura-salida-vehicular', [LecturaController::class,'salida']);
    Route::post('/lectura-entrada-vehicular', [LecturaController::class,'consultaLecturaEntrada']);

    // Deivid: notificaciones
    Route::post('/notificacion-lectura-vehicular', [NotificacionLecturaController::class,'lecturaNotificacion']);
    Route::post('/notificacion-lectura-id', [NotificacionLecturaController::class,'obtenerPorId']);
    Route::post('/notificacion-lectura-registrar-retorno-vehiculo', [NotificacionLecturaController::class,'registrarRetornoVehiculo']);
    

});
