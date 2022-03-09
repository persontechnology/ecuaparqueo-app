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

// parqueaderos
Breadcrumbs::for('parqueaderos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Vehículos', route('parqueaderos'));
});
Breadcrumbs::for('parqueaderosNuevo', function (BreadcrumbTrail $trail) {
    $trail->parent('parqueaderos');
    $trail->push('Nuevo', route('parqueaderoNuevo'));
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
