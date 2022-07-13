@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('lectura-invitado.index'))
@section('content')
@livewire('lecturas.invitado.index')
@endsection
