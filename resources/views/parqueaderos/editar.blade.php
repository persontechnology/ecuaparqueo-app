@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('departamentosEditar', $parqueadero))
@section('content')


    <form action="{{ route('actualizarParqueadero') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $parqueadero->id }}">
        <div class="card">

            <div class="card-body">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>

                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                        value="{{ old('nombre', $parqueadero->nombre) }}" required autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>

                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        name="descripcion" value="{{ old('descripcion', $parqueadero->descripcion) }}">

                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Dirección:</label>

                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror"
                        name="direccion" value="{{ old('direccion', $parqueadero->direccion) }}">

                    @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Número de lugares:</label>

                    <input id="numero_total" type="number" class="form-control @error('numero_total') is-invalid @enderror"
                        name="numero_total" value="{{ old('numero_total', $parqueadero->numero_total) }}">

                    @error('numero_total')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado', $parqueadero->estado) == 'Activo' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="Inactivo"
                            {{ old('estado', $parqueadero->estado) == 'Inactivo' ? 'selected' : '' }}>
                            Inactivo</option>
                    </select>

                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
            <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Actualizar</button>

        </div>
        </div>
    </form>

@endsection
