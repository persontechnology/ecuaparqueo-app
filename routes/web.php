<?php

use App\Http\Controllers\ControlOrdenMovilizacionController;
use App\Http\Controllers\DespachadorController;
use App\Http\Controllers\DespachoCombustibleController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\EstacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KilometrajeController;
use App\Http\Controllers\LecturaEspecialController;
use App\Http\Controllers\LecturaInvitadoController;
use App\Http\Controllers\LecturaNormalController;
use App\Http\Controllers\OrdenMovilizacionController;
use App\Http\Controllers\ParqueaderoController;
use App\Http\Controllers\Reportes\DashboardVehiculoController;
use App\Http\Controllers\RolesPermisosController;
use App\Http\Controllers\Usuarios\PerfilController;
use App\Http\Controllers\Usuarios\UsuarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Artisan;
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

    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    // Artisan::call('migrate:fresh --seed');


})->name('welcome');



Auth::routes(['verify' => true, 'register' => false]);


    


Route::middleware(['verified', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    
    // Deivid,Perfil de usuario
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil-actualizar', [PerfilController::class, 'actualizar'])->name('actualizarPerfil');
    Route::post('/perfil-actualizar-contrasena', [PerfilController::class, 'actualizarContrasena'])->name('actualizarContrasena');
    Route::get('/configuracion', [PerfilController::class, 'configuracion'])->name('configuracion');
    Route::post('/perfil-actualizar-configuracion', [PerfilController::class, 'actualizarConfiguracion'])->name('actualizarConfiguracion');

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
    

    // vehiculos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos');
    Route::get('/vehiculos-guardar-tipo', [VehiculoController::class, 'guardarTipo'])->name('vehiculosGuardarTipo');
    Route::post('/vehiculos-eliminar-tipo', [VehiculoController::class, 'eliminarTipo'])->name('vehiculosEliminarTipo');
    Route::get('/vehiculos-nuevo', [VehiculoController::class, 'nuevo'])->name('vehiculosNuevo');
    Route::post('/vehiculos-guardar', [VehiculoController::class, 'guardar'])->name('guardarVehiculo');
    Route::get('/vehiculos-editar/{id}', [VehiculoController::class, 'editar'])->name('vehiculosEditar');
    Route::post('/vehiculos-actualizar', [VehiculoController::class, 'actualizar'])->name('actualizarVehiculo');
    Route::post('/vehiculos-eliminar', [VehiculoController::class, 'eliminar'])->name('vehiculosEliminar');
    Route::get('/vehiculos-ubicacion-mapa/{id}', [VehiculoController::class, 'ubicacionMapa'])->name('vehiculosUbicacionMapa');
    
    // vehiculos orden de movilización
    Route::get('/vehiculos-orden-movilizaciones/{id}', [VehiculoController::class, 'ordenMovilizaciones'])->name('vehiculosOrdenMovilizacion');

    // lectura especial
    Route::get('/vehiculos-lecturas-especial/{id}', [VehiculoController::class, 'lecturaEspecial'])->name('vehiculosLecturaEspecial');
    // lectura normal
    Route::get('/vehiculos-lecturas-normal/{id}', [VehiculoController::class, 'lecturaNormal'])->name('vehiculosLecturaNormal');
    // lectura invitados
    Route::get('/vehiculos-lecturas-invitados/{id}', [VehiculoController::class, 'lecturaInvitados'])->name('vehiculosLecturaInvitados');
    
    

    // kilometrajes
    Route::get('/kilometrajes/{id}', [KilometrajeController::class, 'index'])->name('kilometrajes');


    // orden de movilizacion
    Route::get('/orden-movilizacion', [OrdenMovilizacionController::class, 'index'])->name('odernMovilizacion');
    Route::post('/orden-movilizacion-guardar', [OrdenMovilizacionController::class, 'guardar'])->name('odernMovilizacionGuardar');
    Route::post('/orden-movilizacion-actualizar', [OrdenMovilizacionController::class, 'actualizar'])->name('odernMovilizacionActualizar');
    Route::post('/orden-movilizacion-eliminar', [OrdenMovilizacionController::class, 'eliminar'])->name('odernMovilizacionEliminar');
    Route::post('/orden-movilizacion-obtener', [OrdenMovilizacionController::class, 'obtener'])->name('odernMovilizacionObtener');
    Route::get('/orden-movilizacion-listado', [OrdenMovilizacionController::class, 'listado'])->name('odernMovilizacionListado');

    // control orden de mobilizacion
    Route::get('/control-odern-movilizacion', [ControlOrdenMovilizacionController::class, 'index'])->name('controlOdernMovilizacion');
    Route::get('/control-odern-movilizacion-aprobar-reprobar/{id}', [ControlOrdenMovilizacionController::class, 'AprobarReprobar'])->name('controlOdernMovilizacionAprobarReprobar');
    Route::post('/control-odern-movilizacion-aprobar-reprobar-guardar', [ControlOrdenMovilizacionController::class, 'AprobarReprobarGuardar'])->name('controlOdernMovilizacionAprobarReprobarGuardar');
    Route::get('/control-odern-movilizacion-pdf/{id}', [ControlOrdenMovilizacionController::class, 'AprobarReprobarPdf'])->name('controlOdernMovilizacionPdf');
    
    // parqueaderos
    Route::get('/parqueaderos', [ParqueaderoController::class, 'index'])->name('parqueaderos');
    Route::get('/parqueaderos-nuevo', [ParqueaderoController::class, 'nuevo'])->name('parqueaderosNuevo');
    Route::post('/parqueaderos-guardar', [ParqueaderoController::class, 'guardar'])->name('parqueaderosGuardar');
    Route::get('/parqueaderos-editar/{id}', [ParqueaderoController::class, 'editar'])->name('parqueaderosEditar');
    Route::post('/parqueaderos-actualizar', [ParqueaderoController::class, 'actualizar'])->name('parqueaderosActualizar');
    Route::get('/listar-estacionamientos/{parqueadero}', [ParqueaderoController::class, 'listarEspacios'])->name('parqueaderosListaEspacios');
    Route::get('/listar-brazos/{parqueadero}', [ParqueaderoController::class, 'listarBrazos'])->name('parqueaderosListarBrazos');
    Route::post('/parqueaderos-eliminar', [ParqueaderoController::class, 'eliminar'])->name('parqueaderosEliminar');

    // espacios    
    Route::get('/espacios/{parqueadero}', [EspacioController::class, 'index'])->name('espacios');
    Route::post('/espacios-crear-rango-espacio', [EspacioController::class, 'crearRangoEspacio'])->name('espaciosCrearRangoEspacios');
    Route::post('/espacios-actualizar-vehiculo', [EspacioController::class, 'actualizarVehiculo'])->name('espaciosActualizarVehiculo');
    Route::get('/espacios-nuevo/{parqueadero}', [EspacioController::class, 'nuevo'])->name('espaciosNuevo');
    Route::post('/espacios-guardar', [EspacioController::class, 'guardar'])->name('espaciosGuardar');
    Route::post('/espacios-eliminar', [EspacioController::class, 'eliminar'])->name('espaciosEliminar');
    Route::get('/espacios-pdf/{parqueadero}', [EspacioController::class, 'pdf'])->name('espaciosPdf');
    Route::get('/espacios-ver-vehiculo-mapa/{espacio}', [EspacioController::class, 'verVehiculoMapa'])->name('espaciosVerVehiculoMapa');

    // despacho de combustible
    Route::resource('despacho-combustible', DespachoCombustibleController::class);
    Route::get('/despacho-combustible-pdf/{id}', [DespachoCombustibleController::class, 'pdf'])->name('despacho-combustible.pdf');
    // estaciones de combustible
    Route::resource('estacion', EstacionController::class);

    // lecturas
    Route::resource('lectura-normal', LecturaNormalController::class);
    Route::resource('lectura-especial', LecturaEspecialController::class);
    Route::resource('lectura-invitado', LecturaInvitadoController::class);
    

     // reportes
     Route::get('/dashboard-vehiculos', [DashboardVehiculoController::class, 'index'])->name('dashboardVehiculos');
});
