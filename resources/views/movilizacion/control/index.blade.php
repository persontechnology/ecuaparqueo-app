@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('controlOdernMovilizacion'))

@section('barraLateral')

@endsection
@section('content')

    @livewire('orden-movilizacion-control.listado')
    
@push('scripts')
  
@endpush
@endsection
