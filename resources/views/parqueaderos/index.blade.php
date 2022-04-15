@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderos'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('parqueaderosNuevo') }}" class="breadcrumb-elements-item">
        <i class="fa-solid fa-building mr-1 text-info"></i> Nuevo Parquedero
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
