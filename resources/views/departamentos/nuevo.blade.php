@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('departamentosNuevo'))
@section('content')
<form action="{{ route('guardarDepartamento') }}" method="POST" autocomplete="off">
    @csrf
    <div class="card">
        <div class="card-body">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                  
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autofocus>

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                  
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" >

                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <p>Selecionar Supervisor</p>

            
            @if ($usuarios->count()>0)
                @foreach ($usuarios as $sup)
                    <div class="form-check">
                        <input type="radio" value="{{$sup->id}}" {{ old('supervisor')==$sup->id ?'checked':'' }} name="supervisor"  class="form-check-input" id="permi-0-{{ $sup->id }}" required>
                        <label class="form-check-label" for="permi-0-{{ $sup->id }}" >{{ $sup->email }}
                        </label>
                        
                        <a href="#" data-popup="popover" data-trigger="hover" title="{{ $sup->apellidos }} {{ $sup->nombres }}" data-content="{{ $sup->documento }}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </div>
                    
                @endforeach
            @else
                    @include('layouts.alert',['type'=>'danger','msg'=>'No existe usuarios con rol supervisor.!'])
                    <a href="{{ route('usuariosNuevo') }}">Crear uno nuevo</a>
            @endif
        </div>
        <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
            <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto">Guardar</button>
        </div>
    </div>
</form>

@endsection
