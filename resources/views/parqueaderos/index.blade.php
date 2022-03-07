@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderos'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('parqueaderoNuevo') }}" class="breadcrumb-elements-item">
        Nuevo Parquedero <i class="fa-solid fa-building ml-1"></i>
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
