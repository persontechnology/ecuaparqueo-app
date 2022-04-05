@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Header
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('apiLecturaSalida') }}">
            @csrf
            <input type="text" value="2" name="placaMovil">
            <input type="text" value="001" name="codigoBrazo">
            <button type="submit">SOLICITAR</button>
        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
@endsection
