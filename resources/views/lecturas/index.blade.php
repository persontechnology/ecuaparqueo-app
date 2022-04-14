@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('vehiculosLecturas',$vehiculoId))
@section('content')
@livewire('lecturas.index', ['vehiculoId' => $vehiculoId], key('lectura-vehiculo-id'.$vehiculoId))
@endsection
