<?php
use App\Http\Controllers\BrazoController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/obtener-brazo', [BrazoController::class, 'obtenerBrazo'])->name('obtenerBazo');
Route::get('/cerrar-brazo', [BrazoController::class, 'cerrarBrazo'])->name('cerrarBrazo');
Route::get('/buscar-vehiculo-tarjeta', [BrazoController::class, 'buscarVehiculoTarjeta'])->name('buscarVehiculoTarjeta');