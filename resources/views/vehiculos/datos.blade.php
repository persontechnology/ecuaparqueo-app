<fieldset>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="numero_movil">Número Móvil<i class="text-danger">*</i></label>
                <input id="numero_movil" type="text" class="form-control @error('numero_movil') is-invalid @enderror"
                    name="numero_movil" value="{{ old('numero_movil', $vehiculo->numero_movil ?? '') }}" required
                    autofocus>

                @error('numero_movil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="placa">Placa<i class="text-danger">*</i></label>
                <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa"
                    value="{{ old('placa', $vehiculo->placa ?? '') }}" required>

                @error('placa')
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
                <label for="modelo">Modelo</label>
                <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo"
                    value="{{ old('modelo', $vehiculo->modelo ?? '') }}">

                @error('modelo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca"
                    value="{{ old('marca', $vehiculo->marca ?? '') }}">

                @error('marca')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="color">Color</label>
                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color"
                    value="{{ old('color', $vehiculo->color ?? '') }}">

                @error('color')
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
                <label for="conductorInfo">Conductor</label>
                <div class="input-group">
                    <input type="hidden" name="conductor" id="conductor"
                        value="{{ old('conductor', $vehiculo->conductor->id ?? '') }}">
                    <input type="text" readonly id="conductorInfo" name="conductorInfo"
                        value="{{ old('conductorInfo', $vehiculo->conductor->apellidos_nombres ?? '') }}" data-toggle="modal"
                        data-target="#modal_full" class="form-control @error('conductor') is-invalid @enderror"
                        placeholder="Seleccionar el conductor..">
                    <span class="input-group-append">
                        <span data-toggle="modal" data-target="#modal_full" class="input-group-text"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                    </span>
                </div>

                @error('conductor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                    <option value="Activo"
                        {{ old('estado', $vehiculo->estado ?? '') == 'Activo' ? 'selected' : '' }}>
                        Activo
                    </option>
                    <option value="Inactivo"
                        {{ old('estado', $vehiculo->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>
                        Inactivo</option>
                </select>

                @error('estado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror">
                    <option value="Normal"
                        {{ old('tipo', $vehiculo->tipo ?? '') == 'Normal' ? 'selected' : '' }}>
                        Normal
                    </option>
                    <option value="Invitados"
                        {{ old('tipo', $vehiculo->tipo ?? '') == 'Invitados' ? 'selected' : '' }}>
                        Invitados
                    </option>
                    <option value="Especial"
                    {{ old('tipo', $vehiculo->tipo ?? '') == 'Especial' ? 'selected' : '' }}>
                    Especial
                    </option>
                </select>

                @error('tipo')
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
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                    name="descripcion">{{ old('descripcion', $vehiculo->descripcion ?? '') }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="foto">Foto</label>
                <label class="custom-file">
                    <input type="file" accept="image/*" id="foto" name="foto"
                        class="custom-file-input @error('foto') is-invalid @enderror">
                    <span class="custom-file-label">Seleccione foto</span>
                </label>
                <span class="form-text text-muted">Formatos aceptados: gif, png, jpg, jpeg.</span>
                @if (Storage::exists($vehiculo->foto ?? ''))
                    <a href="{{ Storage::url($vehiculo->foto ?? '') }}">
                        <img src="{{ Storage::url($vehiculo->foto ?? '') }}" class="rounded-circle" width="45"
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
        <div class="col-sm-6">
            <div class="form-group">
                <label for="codigo_tarjeta">Código de Tarjeta</label>
                <input id="codigo_tarjeta" type="text" class="form-control @error('codigo_tarjeta') is-invalid @enderror" name="codigo_tarjeta"
                    value="{{ old('codigo_tarjeta', $vehiculo->codigo_tarjeta ?? '') }}">

                @error('codigo_tarjeta')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="imei">Número IMEI</label>
                <input id="imei" type="text" class="form-control @error('imei') is-invalid @enderror" name="imei"
                    value="{{ old('imei', $vehiculo->imei ?? '') }}">

                @error('imei')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>



</fieldset>
