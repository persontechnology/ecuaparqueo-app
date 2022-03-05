@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('roles'))
@section('content')
<div class="row">
    <div class="col-lg-4">
        <form action="{{ route('guardarRol') }}" method="POST">
            @csrf
            <div class="card">
                
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="rol">Crear nuevo rol:</label>
                          
                        <input id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ old('rol') }}" required autofocus>
        
                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @foreach ($permisos as $per)
                        <div class="form-check">
                            <input type="checkbox" value="{{$per->id}}" {{ old('permisos.'.$per->id)==$per->id ?'checked':'' }} name="permisos[{{ $per->id }}]"  class="form-check-input" id="permi-0-{{ $per->id }}">
                            <label class="form-check-label" for="permi-0-{{ $per->id }}">{{ $per->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                    <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Guardar</button>
                </div>
            </div>
        </form>
    </div>

    @foreach ($roles as $rol)
    <div class="col-lg-4">
        <form action="{{ route('actualizarRol') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $rol->id }}">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $rol->name }}</h5>
                </div>
                <div class="card-body">
                    @foreach ($permisos as $per)
                        <div class="form-check">
                            <input name="permisos[]" value="{{ $per->id }}" {{ $rol->hasPermissionTo($per) ?'checked':'' }} type="checkbox" class="form-check-input" id="permi-{{ $rol->id }}-{{ $per->id }}">
                            <label class="form-check-label" for="permi-{{ $rol->id }}-{{ $per->id }}">{{ $per->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                    <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Guardar</button>
                    @can('eliminar', $rol)
                        <button type="button" data-url="{{ route('eliminarRol') }}" data-id="{{ $rol->id }}" data-msg="Está seguro de eliminar {{ $rol->name }}!" onclick="eliminar(this)" class="btn btn-outline-danger w-100 w-sm-auto">Eliminar</button>
                    @endcan
                </div>
            </div>
        </form>
    </div>    
    @endforeach
    
</div>

@prepend('scripts')
    <script>
        
    </script>
@endprepend

@endsection
