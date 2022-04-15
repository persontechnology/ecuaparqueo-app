@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('vehiculosOrdenMovilizacion',$vehiculo))
@section('content')
@livewire('vehiculos.orden-movilizaciones', ['vehiculo' => $vehiculo], key('orden-movilizacion-'.$vehiculo->id))
@endsection
