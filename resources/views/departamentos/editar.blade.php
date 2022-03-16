@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('departamentosEditar',$dep))
@section('content')


<form action="{{ route('actualizarDepartamento') }}" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $dep->id }}">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                  
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$dep->nombre) }}" required autofocus>

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                  
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion',$dep->descripcion) }}" >

                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <p>Selecionar Supervisor</p>
            @foreach ($usuarios as $user)
                <div class="form-check">
                    <input name="supervisor" value="{{ $user->id }}" {{ $dep->supervisor->id==$user->id ?'checked':'' }} type="radio" class="form-check-input" id="supervisor-{{ $user->id }}-{{ $dep->id }}">
                    <label class="form-check-label" for="supervisor-{{ $user->id }}-{{ $dep->id }}">{{ $user->email }}</label>
                    <a href="#" data-popup="popover" data-trigger="hover" title="{{ $user->apellidos }} {{ $user->nombres }}" data-content="{{ $user->documento }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
            <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Guardar</button>
            
        </div>
    </div>
</form>

@endsection
