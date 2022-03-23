<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// Home > perfil
Breadcrumbs::for('perfil', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Perfil', route('perfil'));
});
// roles y perisos
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles y permisos', route('roles'));
});
// empresa y departamentos
Breadcrumbs::for('empresa', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Empresa', route('empresa'));
});
Breadcrumbs::for('departamentos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Departamentos', route('departamentos'));
});
Breadcrumbs::for('departamentosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('departamentos');
    $trail->push('Nuevo', route('departamentosNuevo'));
});
Breadcrumbs::for('departamentosEditar', function (BreadcrumbTrail $trail, $dep) {
    $trail->parent('departamentos');
    $trail->push('Editar', route('departamentosEditar', $dep->id));
});


// usuarios
Breadcrumbs::for('usuarios', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios'));
});
Breadcrumbs::for('usuariosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios');
    $trail->push('Nuevo', route('usuariosNuevo'));
});

Breadcrumbs::for('usuariosEditar', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('usuarios');
    $trail->push('Editar', route('usuariosEditar', $user->id));
});

// vehiculos
Breadcrumbs::for('vehiculos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Vehículos', route('vehiculos'));
});
Breadcrumbs::for('vehiculosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('vehiculos');
    $trail->push('Nuevo', route('vehiculosNuevo'));
});
Breadcrumbs::for('vehiculosEditar', function (BreadcrumbTrail $trail,$vehiculo) {
    $trail->parent('vehiculos');
    $trail->push('Editar', route('vehiculosEditar',$vehiculo->id));
});

// parqueaderos
Breadcrumbs::for('parqueaderos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Parqueadero', route('parqueaderos'));
});
Breadcrumbs::for('parqueaderosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('parqueaderos');
    $trail->push('Nuevo', route('parqueaderoNuevo'));
});

Breadcrumbs::for('parqueaderosEditar', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('parqueaderos');
    $trail->push('Editar', route('parqueaderoEditar', $parqueadero->id));
});

Breadcrumbs::for('estacionamientos', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('parqueaderos');
    $trail->push('Estacionamientos', route('parqueaderosListaEspacios', $parqueadero->id));
});

Breadcrumbs::for('estacionamientosReservas', function (BreadcrumbTrail $trail,$espacio) {
    $trail->parent('estacionamientos',$espacio->parqueadero);
    $trail->push('Reservas ', route('listarReservaVehiculo', $espacio->id));
});
Breadcrumbs::for('parqueaderoListarBrazos', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('parqueaderos');
    $trail->push('Brazos de '. $parqueadero->nombre, route('parqueaderoListarBrazos', $parqueadero->id));
});
Breadcrumbs::for('verVehiculoMapa', function (BreadcrumbTrail $trail,$espacio) {
    $trail->parent('estacionamientos',$espacio->parqueadero);
    $trail->push('Mapa Vehículo ', route('verVehiculoMapa', $espacio->id));
});

// orden de movilización
Breadcrumbs::for('odernMovilizacion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Orden de movilización', route('odernMovilizacion'));
});
Breadcrumbs::for('odernMovilizacionNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('odernMovilizacion');
    $trail->push('Nuevo', route('odernMovilizacionNuevo'));
});
Breadcrumbs::for('odernMovilizacionEditar', function (BreadcrumbTrail $trail, $orden) {
    $trail->parent('odernMovilizacion');
    $trail->push('Editar', route('odernMovilizacionEditar',$orden->id));
});

// control orden de movilizacion
Breadcrumbs::for('controlOdernMovilizacion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Control orden de movilización', route('controlOdernMovilizacion'));
});

