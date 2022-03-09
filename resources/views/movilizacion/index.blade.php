@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacion'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('odernMovilizacionNuevo') }}" class="breadcrumb-elements-item">
        Nuevo <i class="fa-solid fa-address-card ml-1"></i>
        
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
