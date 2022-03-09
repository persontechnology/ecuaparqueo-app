<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenMovilizacionController;
use App\Http\Controllers\ParqueaderoController;
use App\Http\Controllers\RolesPermisosController;
use App\Http\Controllers\Usuarios\PerfilController;
use App\Http\Controllers\Usuarios\UsuarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['verify' => true,'register' => false]);



Route::middleware(['verified', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Deivid,Perfil de usuario
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil-actualizar', [PerfilController::class, 'actualizar'])->name('actualizarPerfil');
    Route::post('/perfil-actualizar-contrasena', [PerfilController::class, 'actualizarContrasena'])->name('actualizarContrasena');
    
    // roles y permisos
    Route::get('/roles', [RolesPermisosController::class, 'index'])->name('roles');
    Route::post('/roles-guardar', [RolesPermisosController::class, 'guardar'])->name('guardarRol');
    Route::post('/roles-actualizar', [RolesPermisosController::class, 'actualizar'])->name('actualizarRol');
    Route::post('/roles-eliminar', [RolesPermisosController::class, 'eliminar'])->name('eliminarRol');


    // usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::get('/usuarios-nuevo', [UsuarioController::class, 'nuevo'])->name('usuariosNuevo');
    Route::post('/usuarios-guardar', [UsuarioController::class, 'guardar'])->name('guardarUusario');
    Route::get('/usuarios-editar/{id}', [UsuarioController::class, 'editar'])->name('usuariosEditar');
    Route::post('/usuarios-actualizar', [UsuarioController::class, 'actualizar'])->name('actualizarUsuario');
    Route::post('/usuarios-eliminar', [UsuarioController::class, 'eliminar'])->name('usuariosEliminar');


    // empresa
    Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa');
    Route::post('/actualizarEmpresa', [EmpresaController::class, 'actualizar'])->name('actualizarEmpresa');

    // departamentos
    Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos');
    Route::get('/departamentos-nuevo', [DepartamentoController::class, 'nuevo'])->name('departamentosNuevo');
    Route::get('/departamentos-editar/{id}', [DepartamentoController::class, 'editar'])->name('departamentosEditar');
    Route::post('/departamentos-guardar', [DepartamentoController::class, 'guardar'])->name('guardarDepartamento');
    Route::post('/departamentos-eliminar', [DepartamentoController::class, 'eliminar'])->name('departamentosEliminar');
    Route::post('/departamentos-actualizar', [DepartamentoController::class, 'actualizar'])->name('actualizarDepartamento');

    // vehiculos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos');
    Route::get('/vehiculos-guardar-tipo', [VehiculoController::class, 'guardarTipo'])->name('vehiculosGuardarTipo');
    Route::post('/vehiculos-eliminar-tipo', [VehiculoController::class, 'eliminarTipo'])->name('vehiculosEliminarTipo');
    Route::get('/vehiculos-nuevo', [VehiculoController::class, 'nuevo'])->name('vehiculosNuevo');
    Route::post('/vehiculos-guardar', [VehiculoController::class, 'guardar'])->name('guardarVehiculo');
    Route::get('/vehiculos-editar/{id}', [VehiculoController::class, 'editar'])->name('vehiculosEditar');
    Route::post('/vehiculos-actualizar', [VehiculoController::class, 'actualizar'])->name('actualizarVehiculo');
    Route::post('/vehiculos-eliminar', [VehiculoController::class, 'eliminar'])->name('vehiculosEliminar');

    // orden de movilizacion
    Route::get('/odern-movilizacion', [OrdenMovilizacionController::class, 'index'])->name('odernMovilizacion');
    Route::post('/odern-movilizacion-guardar', [OrdenMovilizacionController::class, 'guardar'])->name('odernMovilizacionGuardar');
    
    
    // parqueaderos
    Route::get('/parqueaderos', [ParqueaderoController::class, 'index'])->name('parqueaderos');
    Route::get('/parqueadero-nuevo', [ParqueaderoController::class, 'nuevo'])->name('parqueaderoNuevo');
    Route::post('/parqueadero-guardar', [ParqueaderoController::class, 'guardar'])->name('guardarParqueadero');
    Route::get('/parqueadero-editar/{id}', [ParqueaderoController::class, 'editar'])->name('parqueaderoEditar');
    Route::post('/parqueadero-actualizar', [ParqueaderoController::class, 'actualizar'])->name('actualizarParqueadero');
    Route::get('/listar-espacios/{parqueadero}', [ParqueaderoController::class, 'listarEspacios'])->name('parqueaderosListaEspacios');
    
    
    // espacios
    Route::post('/todos', [EspacioController::class, 'actualizarTodos'])->name('parqueaderos.actualizar.todos');
    
    
    
    
    
    
    
    
});
