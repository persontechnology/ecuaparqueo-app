
        <fieldset>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="fecha_salida">Fecha de salida:</label>
                <div class="col-lg-10">
                    <input type="date" name="fecha_salida" id="fecha_salida" class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida',date('Y-m-d')) }}" required autofocus>
                    @error('fecha_salida')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-lg-2" for="conductorUser">Conductor</label>
                <div class="col-lg-10">
                    <div class="input-group">
                       
                        <input type="hidden" name="conductor" id="conductor" value="{{ old('conductor') }}" required>
                        <input type="text" name="conductorUser" data-toggle="modal" data-target="#modal_full_conductor" value="{{ old('conductorUser') }}" class="form-control @error('conductor') is-invalid @enderror" id="conductorUser" placeholder="Conductor sin selecionar.!" required autocomplete="">
                        
                        @error('conductor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-lg-2" for="marcaVehiculo">Marca y N° de Vehículo</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        
                        <input type="hidden" name="vehiculo" id="vehiculo" value="{{ old('vehiculo') }}" required>
                        <input type="text" name="marcaVehiculo" data-toggle="modal" data-target="#modal_full_vehiculo" value="{{ old('marcaVehiculo') }}" class="form-control @error('vehiculo') is-invalid @enderror" id="marcaVehiculo" placeholder="Vehículo sin selecionar.!" required>
                       
                        @error('vehiculo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="servidor_publico">Servidor Público:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('servidor_publico') is-invalid @enderror" name="servidor_publico" value="{{ old('servidor_publico') }}" id="servidor_publico" required>
                    @error('servidor_publico')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="direccion">Dirección:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" id="direccion" required>
                    @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="lugar_comision">Lugar de Comisión:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('lugar_comision') is-invalid @enderror" name="lugar_comision" id="lugar_comision" value="{{ old('lugar_comision') }}" required >
                    @error('lugar_comision')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="motivo">Motivo:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" id="motivo" value="{{ old('motivo') }}" required>
                    @error('motivo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="hora_salida">Hora salida:</label>
                        <div class="col-lg-8">
                            <input type="time" class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida" id="hora_salida" value="{{ old('hora_salida',date('H:i')) }}" required>
                            @error('hora_salida')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="hora_retorno">Hora retorno:</label>
                        <div class="col-lg-8">
                            <input type="time" class="form-control @error('hora_retorno') is-invalid @enderror" name="hora_retorno" id="hora_retorno" value="{{ old('hora_retorno',date('H:i')) }}" >
                            @error('hora_retorno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>