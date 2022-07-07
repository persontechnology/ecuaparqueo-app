<?php

use App\Http\Controllers\Api\BrazoController;
use App\Http\Controllers\Api\DespachoCombustibleController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LecturaController;
use App\Http\Controllers\Api\LecturaEspecialController;
use App\Http\Controllers\Api\LecturaInvitadoController;
use App\Http\Controllers\Api\LecturaNormalController;
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
Route::get('/buscar-vehiculo-tarjeta-salida', [BrazoController::class,'buscarVehiculoTarjetaSalida']);
Route::get('/buscar-vehiculo-tarjeta-entrada', [BrazoController::class,'buscarVehiculoTarjetaEntrada']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/actualizar-contrasena', [HomeController::class,'actualizarContrasena']);
    // queda fuera de la app movil
    // Route::post('/lectura-salida-vehicular', [BrazoController::class,'buscarVehiculoTarjetaSalida']);
    // Route::post('/lectura-entrada-vehicular', [BrazoController::class,'buscarVehiculoTarjetaEntrada']);

    // Deivid: notificaciones
    Route::post('/notificacion-lectura-vehicular', [NotificacionLecturaController::class,'lecturaNotificacion']);
    Route::post('/notificacion-lectura-id', [NotificacionLecturaController::class,'obtenerPorId']);
    Route::post('/notificacion-lectura-registrar-retorno-vehiculo', [NotificacionLecturaController::class,'registrarRetornoVehiculo']);
    Route::post('/notificacion-lectura-vehicular-cerrar-salida', [NotificacionLecturaController::class,'cerrarNotificacion']);



    // Lectura especiales
    Route::post('/notificacion-lectura-especial', [LecturaEspecialController::class,'diezUltimasLista']);
    Route::post('/notificacion-lectura-especial-finalizar', [LecturaEspecialController::class,'finalizarLectura']);
    // Lectura invitados
    Route::post('/notificacion-lectura-invitado', [LecturaInvitadoController::class,'diezUltimasLista']);
    Route::post('/notificacion-lectura-invitado-revision', [LecturaInvitadoController::class,'revision']);
    Route::post('/notificacion-lectura-invitado-finalizar-revision', [LecturaInvitadoController::class,'finalizar']);
    Route::post('/notificacion-lectura-invitado-finalizar-revision-salida', [LecturaInvitadoController::class,'finalizarSalida']);
    Route::post('/notificacion-lectura-invitado-finalizar-revision-eliminar', [LecturaInvitadoController::class,'eliminar']);


    // lectura normales
    Route::post('/notificacion-lectura-normal', [LecturaNormalController::class,'diezUltimasLista']);
    Route::post('/notificacion-lectura-normal-finalizar-salida', [LecturaNormalController::class,'finalizarSalida']);
    Route::post('/lectura-normal-detalle', [LecturaNormalController::class,'detalle']);
    Route::post('/lectura-normal-finalizar-entrada', [LecturaNormalController::class,'finalizarEntrada']);
    Route::post('/lectura-normal-cancelar-entrada', [LecturaNormalController::class,'cancelarEntrada']);


    // despacho de combustible
    Route::post('/dc-consulta', [DespachoCombustibleController::class,'consulta']);
    Route::post('/dc-consulta-estaciones', [DespachoCombustibleController::class,'consultaEstaciones']);
    Route::post('/dc-enviarFoto', [DespachoCombustibleController::class,'guardarFoto']);
    
    
    
    
    
    
    
    
    

});
