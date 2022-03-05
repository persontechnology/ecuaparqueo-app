@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('empresa'))
@section('content')
<form action="{{ route('actualizarEmpresa') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        
        <div class="card-body">
            <fieldset>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                <option value="Pública" {{ old('tipo',$empresa->tipo)=='Pública'?'selected':'' }}>Pública</option>
                                <option value="Privada" {{ old('tipo',$empresa->tipo)=='Privada'?'selected':'' }}>Privada</option>
                            </select>

                            @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$empresa->nombre) }}" required >
            
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                @role('SuperAdmin')
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="fecha_caducidad_inicio">Fecha caducidad inicio:</label>
                            <input id="fecha_caducidad_inicio" readonly type="date" class="form-control @error('fecha_caducidad_inicio') is-invalid @enderror" name="fecha_caducidad_inicio" value="{{ old('fecha_caducidad_inicio',$empresa->fecha_caducidad_inicio) }}" required  >
            
                            @error('fecha_caducidad_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="fecha_caducidad_fin">Fecha caducidad fin:</label>
                            <input id="fecha_caducidad_fin" type="date" class="form-control @error('fecha_caducidad_fin') is-invalid @enderror" name="fecha_caducidad_fin" value="{{ old('fecha_caducidad_fin',$empresa->fecha_caducidad_fin) }}" required  >
            
                            @error('fecha_caducidad_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                                    <option value="Activo" {{ old('estado',$empresa->estado)=='Activo'?'selected':'' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado',$empresa->estado)=='Inactivo'?'selected':'' }}>Inactivo</option>
                                </select>

                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                    </div>

                </div>
                @else
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha caducidad inicio: {{ $empresa->fecha_caducidad_inicio }}</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha caducidad fin: {{ $empresa->fecha_caducidad_fin }}</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Estado: {{ $empresa->estado }}</label>
                        </div>
                    </div>
                </div>
                @endrole
            
            
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required>{{ old('descripcion',$empresa->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="foto">Foto de perfil:</label>
                            <label class="custom-file">
                                <input type="file" accept="image/*" id="foto" name="foto" class="custom-file-input @error('foto') is-invalid @enderror">
                                <span class="custom-file-label">Seleccione foto</span>
                            </label>
                            <span class="form-text text-muted">Formatos aceptados: gif, png, jpg, jpeg.</span>
                            @if (Storage::exists($empresa->logo))
                            <a href="{{ Storage::url($empresa->logo) }}">
                                <img src="{{ Storage::url($empresa->logo) }}" class="rounded-circle" width="45" alt="">
                                <i>Ver logo</i>
                            </a>
                            @endif
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
            </fieldset>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection
