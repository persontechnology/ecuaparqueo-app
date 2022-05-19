@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('despacho-combustible.index'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('despacho-combustible.create') }}" class="breadcrumb-elements-item">
        <i class="fa-solid fa-gas-pump mr-1 text-info"></i>Nuevo despacho
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
