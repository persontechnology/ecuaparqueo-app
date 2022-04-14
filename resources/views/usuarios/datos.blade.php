<fieldset>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="apellidos">Apellidos<i class="text-danger">*</i></label>
                <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos',$user->apellidos??'') }}" required  autofocus>

                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="nombres">Nombres<i class="text-danger">*</i></label>
                <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres',$user->nombres??'') }}" required >

                @error('nombres')
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
                <label for="email">Email<i class="text-danger">*</i></label>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email??'') }}" required  >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="telefono">Teléfono<i class="text-danger">*</i></label> <br>
                <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono',$user->telefono??'') }}" required  >
                <span id="valid-msg" class="hide"></span>
                <span id="error-msg" class="hide text-danger" role="alert"></span>
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="documento">Documento #<i class="text-danger">*</i></label>
                <input id="documento" type="number" class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ old('documento',$user->documento??'') }}" required  >

                @error('documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label for="cuidad">Ciudad<i class="text-danger">*</i></label>
                <input id="cuidad" type="text" class="form-control @error('cuidad') is-invalid @enderror" name="cuidad" value="{{ old('cuidad',$user->cuidad??'') }}" required  >

                @error('cuidad')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="direccion">Dirección<i class="text-danger">*</i></label>
                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion',$user->direccion??'') }}" required  >

                @error('direccion')
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
                <label for="descripcion">Descripción<i class="text-danger">*</i></label>
                <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required>{{ old('descripcion',$user->descripcion??'') }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="estado">Estado<i class="text-danger">*</i></label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Activo" {{ old('estado',$user->estado??'')==='Activo'?'selected':'' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado',$user->estado??'')==='Inactivo'?'selected':'' }}>Inactivo</option>
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
                <label for="foto">Foto de perfil</label>
                <label class="custom-file">
                    <input type="file" accept="image/*" id="foto" name="foto" class="custom-file-input @error('foto') is-invalid @enderror">
                    <span class="custom-file-label">Seleccione foto</span>
                </label>
                <span class="form-text text-muted">Formatos aceptados: gif, png, jpg, jpeg.</span>
                @if (Storage::exists($user->foto??''))
                    <a href="{{ Storage::url($user->foto??'') }}">
                        <img src="{{ Storage::url($user->foto??'') }}" class="rounded-circle" width="45" alt="">
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