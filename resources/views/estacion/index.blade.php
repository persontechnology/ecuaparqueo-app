@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('estacion.index'))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <a href="{{ route('estacion.create') }}" class="breadcrumb-elements-item">
        <i class="fa-solid fa-plus mr-1 text-info"></i>Nueva estación
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
