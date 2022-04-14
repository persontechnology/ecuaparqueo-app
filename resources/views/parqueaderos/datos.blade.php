<div class="col-sm-8">
    <div class="form-group">
        <label for="nombre">Nombre<i class="text-danger">*</i></label>
        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$parqueadero->nombre??'') }}" required autofocus>
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
            value="{{ old('descripcion',$parqueadero->descripcion??'') }}">
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>