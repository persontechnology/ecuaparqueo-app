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
                                <label for="tipo">Tipo<i class="text-danger">*</i></label>
                                <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror"
                                    required>
                                    <option value="Pública" {{ old('tipo', $empresa->tipo) == 'Pública' ? 'selected' : '' }}>
                                        Pública</option>
                                    <option value="Privada" {{ old('tipo', $empresa->tipo) == 'Privada' ? 'selected' : '' }}>
                                        Privada</option>
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
                                <label for="nombre">Nombre<i class="text-danger">*</i></label>
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $empresa->nombre) }}" required autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="codigo">Código<i class="text-danger">*</i></label>
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror"
                                    name="codigo" value="{{ old('codigo', $empresa->codigo) }}" required>

                                @error('codigo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="version">Versión<i class="text-danger">*</i></label>
                                <input id="version" type="text" class="form-control @error('version') is-invalid @enderror"
                                    name="version" value="{{ old('version', $empresa->version) }}" required>

                                @error('version')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="norma">Norma<i class="text-danger">*</i></label>
                                <input id="norma" type="text" class="form-control @error('norma') is-invalid @enderror"
                                    name="norma" value="{{ old('norma', $empresa->norma) }}" required>

                                @error('norma')
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
                                    <label for="fecha_caducidad_inicio">Fecha caducidad inicio<i class="text-danger">*</i></label>
                                    <input id="fecha_caducidad_inicio" readonly type="date"
                                        class="form-control @error('fecha_caducidad_inicio') is-invalid @enderror"
                                        name="fecha_caducidad_inicio"
                                        value="{{ old('fecha_caducidad_inicio', $empresa->fecha_caducidad_inicio) }}"
                                        required>

                                    @error('fecha_caducidad_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="fecha_caducidad_fin">Fecha caducidad fin<i class="text-danger">*</i></label>
                                    <input id="fecha_caducidad_fin" type="date"
                                        class="form-control @error('fecha_caducidad_fin') is-invalid @enderror"
                                        name="fecha_caducidad_fin"
                                        value="{{ old('fecha_caducidad_fin', $empresa->fecha_caducidad_fin) }}" required>

                                    @error('fecha_caducidad_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="estado">Estado<i class="text-danger">*</i></label>
                                    <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror"
                                        required>
                                        <option value="Activo" {{ old('estado', $empresa->estado) == 'Activo' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="Inactivo"
                                            {{ old('estado', $empresa->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
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
                                    <label for="">Fecha caducidad inicio<i class="text-danger">*</i> {{ $empresa->fecha_caducidad_inicio }}</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha caducidad fin<i class="text-danger">*</i> {{ $empresa->fecha_caducidad_fin }}</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Estado<i class="text-danger">*</i> {{ $empresa->estado }}</label>
                                </div>
                            </div>
                        </div>
                    @endrole
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción<i class="text-danger">*</i></label>
                                <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                    name="descripcion"
                                    required>{{ old('descripcion', $empresa->descripcion) }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="foto">Foto de perfil<i class="text-danger">*</i></label>
                                <label class="custom-file">
                                    <input type="file" accept="image/*" id="foto" name="foto"
                                        class="custom-file-input @error('foto') is-invalid @enderror">
                                    <span class="custom-file-label">Seleccione foto</span>
                                </label>
                                <span class="form-text text-muted">Formatos aceptados: gif, png, jpg, jpeg.</span>
                                @if (Storage::exists($empresa->logo))
                                    <a href="{{ Storage::url($empresa->logo) }}">
                                        <img src="{{ Storage::url($empresa->logo) }}" class="rounded-circle" width="45"
                                            alt="">
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="codigo_tarjeta_vehiculo_invitado">Código de tarjeta para vehículo invitado<i class="text-danger">*</i></label>
                                <input id="codigo_tarjeta_vehiculo_invitado" type="text" class="form-control @error('codigo_tarjeta_vehiculo_invitado') is-invalid @enderror"
                                    name="codigo_tarjeta_vehiculo_invitado" value="{{ old('codigo_tarjeta_vehiculo_invitado', $empresa->codigo_tarjeta_vehiculo_invitado) }}" required />
                                @error('codigo_tarjeta_vehiculo_invitado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="minutos_extras_entrada_vehiculos">Minutos extras para la entrada de vehículos<i class="text-danger">*</i></label>
                                <input id="minutos_extras_entrada_vehiculos" type="number" class="form-control @error('minutos_extras_entrada_vehiculos') is-invalid @enderror"
                                    name="minutos_extras_entrada_vehiculos" value="{{ old('minutos_extras_entrada_vehiculos', $empresa->minutos_extras_entrada_vehiculos) }}" required />
                                @error('minutos_extras_entrada_vehiculos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="url_web_gps">URL web service GPS</label>
                        <input id="url_web_gps" type="text" class="form-control @error('url_web_gps') is-invalid @enderror"
                            name="url_web_gps" value="{{ old('url_web_gps', $empresa->url_web_gps) }}" />
                        @error('url_web_gps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="token">Token</label>
                        <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" name="token"
                            value="{{ old('token', $empresa->token) }}" />
                        @error('token')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    

                </fieldset>
            </div>
            <div class="card-footer bg-transparent">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
@endsection
