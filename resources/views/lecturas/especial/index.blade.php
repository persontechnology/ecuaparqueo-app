@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('lectura-especial.index'))
@section('content')
@livewire('lecturas.especial.index')
@endsection
