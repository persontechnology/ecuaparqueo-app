@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('usuarios'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('usuariosNuevo') }}" class="breadcrumb-elements-item">
        <i class="fa-solid fa-user-plus mr-1 text-info"></i>Nuevo usuario
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
