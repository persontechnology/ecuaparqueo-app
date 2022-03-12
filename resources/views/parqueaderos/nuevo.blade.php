@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderosNuevo'))
@section('content')
    <form action="{{ route('guardarParqueadero') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>

                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" required autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>

                            <input id="descripcion" type="text"
                                class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                value="{{ old('descripcion') }}">

                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Dirección:</label>

                            <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror"
                                name="direccion" value="{{ old('direccion') }}">

                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Número de lugares:</label>

                            <input id="numero_total" type="number"
                                class="form-control @error('numero_total') is-invalid @enderror" name="numero_total"
                                value="{{ old('numero_total') }}">

                            @error('numero_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <p>Guardias Encargados</p>
                        @if ($guardias->count() > 0)
                            @foreach ($guardias as $guardia)
                                <div class="form-check">
                                    <input type="checkbox"  value="{{ $guardia->id }}"
                                    {{ (is_array(old('guardias')) && in_array($guardia->id, old('guardias'))) ? ' checked' : '' }}
                                        name="guardias[]" 
                                        class="form-check-input @error('guardias.' . $guardia->id) is-invalid @enderror"
                                        id="guardia-{{ $guardia->id }}">

                                    <label class="form-check-label"
                                        for="permi-0-{{ $guardia->id }}">{{ $guardia->email }}
                                    </label>
                                    <a href="#" data-popup="popover" data-trigger="hover"
                                        title="{{ $guardia->apellidos }} {{ $guardia->nombres }}"
                                        data-content="{{ $guardia->documento }}">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            @include('layouts.alert', [
                                'type' => 'danger',
                                'msg' => 'No existe usuarios con rol guardia.!',
                            ])
                            <a href="{{ route('usuariosNuevo') }}">Crear uno nuevo</a>
                        @endif
                    </div>
                </div>

                <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                    <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Guardar</button>
                </div>
            </div>
    </form>

@endsection
