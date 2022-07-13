@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('lectura-normal.index'))
@section('content')
@livewire('lecturas.normal.index')
@endsection
