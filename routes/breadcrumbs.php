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
Breadcrumbs::for('vehiculosUbicacionMapa', function (BreadcrumbTrail $trail,$vehiculo) {
    $trail->parent('vehiculos');
    $trail->push('Ubicación', route('vehiculosUbicacionMapa',$vehiculo->id));
});
Breadcrumbs::for('vehiculosOrdenMovilizacion', function (BreadcrumbTrail $trail,$vehiculo) {
    $trail->parent('vehiculos');
    $trail->push('Ordenes de movilización', route('vehiculosOrdenMovilizacion',$vehiculo->id));
});

// kilometrajes
Breadcrumbs::for('kilometrajes', function (BreadcrumbTrail $trail,$vehiculo) {
    $trail->parent('vehiculos');
    $trail->push('Kilometrajes', route('kilometrajes',$vehiculo->id));
});


// parqueaderos
Breadcrumbs::for('parqueaderos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Parqueadero', route('parqueaderos'));
});
Breadcrumbs::for('parqueaderosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('parqueaderos');
    $trail->push('Nuevo', route('parqueaderosNuevo'));
});

Breadcrumbs::for('parqueaderosEditar', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('parqueaderos');
    $trail->push('Editar', route('parqueaderosEditar', $parqueadero->id));
});


// espacios
Breadcrumbs::for('espacios', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('parqueaderos');
    $trail->push('Espacios', route('espacios',$parqueadero->id));
});
Breadcrumbs::for('espaciosNuevo', function (BreadcrumbTrail $trail,$parqueadero) {
    $trail->parent('espacios',$parqueadero);
    $trail->push('Nuevo', route('espaciosNuevo',$parqueadero->id));
});
Breadcrumbs::for('espaciosVerVehiculoMapa', function (BreadcrumbTrail $trail,$espacio) {
    $trail->parent('espacios',$espacio->parqueadero);
    $trail->push('Ubicación', route('espaciosVerVehiculoMapa',$espacio->id));
});

// orden de movilización
Breadcrumbs::for('odernMovilizacion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Orden de movilización nuevo', route('odernMovilizacion'));
});

Breadcrumbs::for('odernMovilizacionListado', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Orden de movilización listado', route('odernMovilizacionListado'));
});


// control orden de movilizacion
Breadcrumbs::for('controlOdernMovilizacion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Control orden de movilización', route('controlOdernMovilizacion'));
});
Breadcrumbs::for('controlOdernMovilizacionAprobarReprobar', function (BreadcrumbTrail $trail, $orden) {
    $trail->parent('controlOdernMovilizacion');
    $trail->push('Aceptar o Denegar', route('controlOdernMovilizacionAprobarReprobar',$orden->id));
});

// lecturas
Breadcrumbs::for('vehiculosLecturas', function (BreadcrumbTrail $trail,$vehiculoId) {
    $trail->parent('vehiculos');
    $trail->push('Lecturas', route('vehiculosLecturas',$vehiculoId));
});


// despacho de combustible
Breadcrumbs::for('despacho-combustible.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Despacho de combustible', route('despacho-combustible.index'));
});
Breadcrumbs::for('despacho-combustible.create', function (BreadcrumbTrail $trail) {
    $trail->parent('despacho-combustible.index');
    $trail->push('Nuevo', route('despacho-combustible.create'));
});
Breadcrumbs::for('despacho-combustible.show', function (BreadcrumbTrail $trail,$dc) {
    $trail->parent('despacho-combustible.index');
    $trail->push('Ver', route('despacho-combustible.show',$dc->id));
});
Breadcrumbs::for('despacho-combustible.edit', function (BreadcrumbTrail $trail,$dc) {
    $trail->parent('despacho-combustible.show',$dc);
    $trail->push('Editar', route('despacho-combustible.edit',$dc));
});

// estacion de servicios
Breadcrumbs::for('estacion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Estación de servicios', route('estacion.index'));
});
Breadcrumbs::for('estacion.create', function (BreadcrumbTrail $trail) {
    $trail->parent('estacion.index');
    $trail->push('Nuevo', route('estacion.create'));
});
Breadcrumbs::for('estacion.edit', function (BreadcrumbTrail $trail,$es) {
    $trail->parent('estacion.index');
    $trail->push('Editar', route('estacion.edit',$es->id));
});

// lecturas 
// normales
Breadcrumbs::for('lectura-normal.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Lecturas normales', route('lectura-normal.index'));
});
Breadcrumbs::for('lectura-especial.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Lecturas especiales', route('lectura-especial.index'));
});
Breadcrumbs::for('lectura-invitado.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Lecturas invitados', route('lectura-invitado.index'));
});