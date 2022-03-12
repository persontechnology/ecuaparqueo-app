<fieldset>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa"
                    value="{{ old('placa', $vehiculo->placa ?? '') }}" required autofocus>

                @error('placa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="color">Color:</label>
                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color"
                    value="{{ old('color', $vehiculo->color ?? '') }}" required>

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
                <label for="numero_chasis">Número de chasis:</label>
                <input id="numero_chasis" type="text" class="form-control @error('numero_chasis') is-invalid @enderror"
                    name="numero_chasis" value="{{ old('numero_chasis', $vehiculo->numero_chasis ?? '') }}" required>

                @error('numero_chasis')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                    <option value="Activo" {{ old('estado', $vehiculo->estado ?? '') == 'Activo' ? 'selected' : '' }}>
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
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                    name="descripcion" required>{{ old('descripcion', $vehiculo->descripcion ?? '') }}</textarea>
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

        
    </div>

</fieldset>
