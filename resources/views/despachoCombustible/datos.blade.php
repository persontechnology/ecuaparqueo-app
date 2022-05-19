<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="fecha">Fecha<i class="text-danger">*</i></label>
            <input id="fecha" type="date"
                class="form-control @error('fecha') is-invalid @enderror"
                name="fecha"
                value="{{ old('fecha',$dc->fecha??Carbon\Carbon::now()->format('Y-m-d')) }}"
                required autofocus>

            @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label  for="numeroMovil">N° Movil</label>
            <div class="input-group">
                
                <input type="hidden" name="vehiculo" id="vehiculo" value="{{ old('vehiculo',$dc->vehiculo_id??'') }}" required>
                <input type="text" data-toggle="modal" data-target="#modal_large_vehiculo" onkeydown="event.preventDefault()" name="numeroMovil" value="{{ old('numeroMovil',$dc->vehiculo->numero_movil??'') }}" class="form-control @error('vehiculo') is-invalid @enderror" id="numeroMovil" placeholder="Vehículo sin selecionar.!">
                <span class="input-group-append">
                    <span data-toggle="modal" data-target="#modal_large_vehiculo" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                </span>
                
                @error('vehiculo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="kilometraje">Kilometraje<i class="text-danger">*</i></label>
            <input id="kilometraje" type="number" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ old('kilometraje',$dc->kilometraje??'') }}" required />
            @error('kilometraje')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="conductor_info">Datos del conductor<i class="text-danger">*</i></label>
            <div class="input-group">
                <input type="hidden" name="conductor" id="conductor" value="{{ old('conductor',$dc->chofer_id??'') }}" required>
                <input type="text" data-opcion="conductor" onclick="modalConductorSolicitante(this);" onkeydown="event.preventDefault()"  id="conductor_info" name="conductor_info" value="{{ old('conductor_info',$dc->conductor->apellidos_nombres??'') }}" data-toggle="modal" data-target="#modal_large" class="form-control @error('conductor') is-invalid @enderror" placeholder="Seleccionar conductor.." required>
                <span class="input-group-append">
                    <span data-toggle="modal" data-target="#modal_large" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                </span>
            </div>

            @error('conductor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label for="destino">Destino<i class="text-danger">*</i></label>
            <input id="destino" type="text" class="form-control @error('destino') is-invalid @enderror" name="destino" value="{{ old('destino',$dc->destino??'') }}" required />
            @error('destino')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <p class="font-weight-semibold">Concepto<i class="text-danger">*</i></p>
            <div class="border p-3 rounded">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="concepto" value="Gasolina extra" {{ old('concepto',$dc->concepto??'')=='Gasolina Extra'?'checked':'' }} id="concepto_extra">
                    <label class="form-check-label" for="concepto_extra">Gasolina extra</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="concepto" value="Gasolina Super" {{ old('concepto',$dc->concepto??'')=='Gasolina Super'?'checked':'' }} id="concepto_super">
                    <label class="form-check-label" for="concepto_super">Gasolina Super</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="concepto" value="Diesel" {{ old('concepto',$dc->concepto??'')=='Diesel'?'checked':'' }} id="concepto_diesel" >
                    <label class="form-check-label" for="concepto_diesel">Diesel</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="galones">Cantidad Galones<i class="text-danger">*</i></label>
            <input id="galones" type="text" class="form-control @error('galones') is-invalid @enderror" name="galones" value="{{ old('galones',$dc->cantidad_galones??'') }}" required />
            <p id="letras_cantidad_galones_convertido"></p>
            @error('galones')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            
            <input id="cantidad_letras" type="hidden" class="form-control @error('cantidad_letras') is-invalid @enderror" name="cantidad_letras" value="{{ old('cantidad_letras',$dc->cantidad_letras??'') }}" required />
            @error('cantidad_letras')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="valor">Valor Dinero<i class="text-danger">*</i></label>
            <input id="valor" type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ old('valor',$dc->valor??'') }}" required />
            <p id="letras_valor_convertido"></p>
            @error('valor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="valor_letras" type="hidden" class="form-control @error('valor_letras') is-invalid @enderror" name="valor_letras" value="{{ old('valor_letras',$dc->valor_letras??'') }}" required />
            @error('valor_letras')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-8">
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones">{{ old('observaciones',$dc->observaciones??'') }}</textarea>
            @error('observaciones')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-check">
            <input type="checkbox" name="noti" class="form-check-input" id="dc_ls_c" {{ old('noti')?'checked':'' }}>
            <label class="form-check-label" for="dc_ls_c">Enviar notificación al conductor.</label>
        </div>
    </div>
</div>