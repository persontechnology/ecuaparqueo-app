@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('usuarios'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('usuariosNuevo') }}" class="breadcrumb-elements-item">
        Nuevo <i class="fa-solid fa-user-plus ml-1"></i>
        
    </a>
</div>
@endsection
@section('content')

<div class="card card-body">
    {{$dataTable->table()}}
</div>
@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@endsection
