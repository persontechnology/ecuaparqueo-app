@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacionListado'))


@section('content')

    @livewire('orden-movilizacion.listado')

@endsection
