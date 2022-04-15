@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('espaciosNuevo',$parqueadero))

@section('content')
<form action="{{ route('espaciosGuardar') }}" method="POST">
    <div class="card">
        <div class="card-body">
            @csrf
            <input type="hidden" name="parqueadero_id" value="{{ $parqueadero->id }}">
            <div class="form-group">
                <label for="numero">Número de espacio<i class="text-danger">*</i></label>
                <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') }}" required>

                @error('numero')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehiculo">Selecione vehículo</label>
                <select class="form-control @error('vehiculo') is-invalid @enderror" name="vehiculo" id="vehiculo">
                    <option value=""></option> 
                    @foreach ($vehiculos as $veh)
                        <option value="{{ $veh->id }}">{{ $veh->numero_movil_placa }}</option>
                    @endforeach
                </select>
                @error('vehiculo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
        </div>
        <div class="card-footer bg-transparent">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection
