@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('kilometrajes',$vehiculo))

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
