@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Bienvenido
    </div>
    <div class="card-body">
        <h4 class="card-title">
            {{ config('app.name','ECUAPARQUEO') }}
        </h4>
    </div>
    <div class="card-footer text-muted">
        {{ date('Y') }}
    </div>
</div>
@endsection
