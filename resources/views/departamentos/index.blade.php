@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('departamentos'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('departamentosNuevo') }}" class="breadcrumb-elements-item">
        Nuevo departamento <i class="fa-solid fa-building ml-1"></i>
    </a>
</div>
@endsection
@section('content')

<div class="card card-body">
    <div class="table-responsive">
        {{$dataTable->table()}}
    </div>
</div>
@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@endsection
