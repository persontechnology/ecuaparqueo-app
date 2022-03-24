@extends('layouts.app')

@section('content')
<form action="" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            Header
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td class="col-2 py-0" rowspan="4" id="example1"></td>
                            <th class="col-6 py-0 text-center" rowspan="4">
                                <h1>FORMULARIO ORDEN DE MOVILIZACIÓN DENTRO DEL ÁREA DE CONSECIÓN</h1>
                            </th>
                            <th class="col-2 py-0">CÓDIGO</th>
                            <td class="col-2 py-0">{{ $empresa->codigo }}</td>
                        </tr>
                        <tr>
                            <th class="py-0">VERSIÓN</th>
                            <td class="py-0">{{ $empresa->version }}</td>
                        </tr>
                        <tr>
                            <th class="py-0">FECHA</th>
                            <td class="py-0">{{ \Carbon\Carbon::now() }}</td>
                        </tr>
                        <tr>
                            <th class="py-0">NORMA</th>
                            <td class="py-0">{{ $empresa->norma }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <fieldset>
                <legend class="font-weight-semibold">
                    NÚMERO DE ORDEN: <strong class="text-danger text-right" id="numero_orden_movilizacion">{{ $orden->numero }}</strong>
                </legend>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fecha_solicitud">Fecha de solicitud:</label>
                            <input type="text" id="fecha_solicitud" name="fecha_solicitud" readonly onkeydown="event.preventDefault()" value="{{ $orden->created_at }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fecha_salida">Fecha y hora de salida<i class="text-danger">*</i></label>
                                
                            <div class='input-group' id='datetimepicker1' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                
                                <input id='fecha_salida' onkeydown="event.preventDefault()" name="fecha_salida" type='text' class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida',$orden->fecha_salida)}}" data-td-target='#datetimepicker1' required/>
                                <span class='input-group-append' data-td-target='#datetimepicker1' data-td-toggle='datetimepicker'>
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </span>
                                @error('fecha_salida')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fecha_retorno">Fecha y hora de retorno<i class="text-danger">*</i></label>
                                
                            <div class='input-group' id='datetimepicker2' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                <input id='fecha_retorno' onkeydown="event.preventDefault()" name="fecha_retorno" type='text' class="form-control @error('fecha_retorno') is-invalid @enderror" value="{{ old('fecha_retorno',$orden->fecha_retorno)}}" data-td-target='#datetimepicker2' required/>
                                <span class='input-group-append' data-td-target='#datetimepicker2' data-td-toggle='datetimepicker'>
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </span>
                                @error('fecha_retorno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label  for="numero_ocupantes">N° ocupantes<i class="text-danger">*</i></label>
                            <div class="input-group">
                                <input type="number" name="numero_ocupantes" value="{{ old('numero_ocupantes',$orden->numero_ocupantes) }}" class="form-control @error('numero_ocupantes') is-invalid @enderror" id="numero_ocupantes" required>
                                @error('numero_ocupantes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="numeroMovil">N° Movil</label>
                            <div class="input-group">
                                
                                <input type="hidden" name="vehiculo" id="vehiculo" value="{{ old('vehiculo',$orden->vehiculo_id) }}" required>
                                <input type="text" readonly onkeydown="event.preventDefault()" name="numeroMovil" value="{{ old('numeroMovil',$orden->vehiculo->numero_movil) }}" class="form-control @error('vehiculo') is-invalid @enderror" id="numeroMovil" placeholder="Vehículo sin selecionar.!">
                                
                                @error('vehiculo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="marca">Marca</label>
                            <div class="input-group">
                                <input type="text" readonly onkeydown="event.preventDefault()" name="marca" value="{{ old('marca',$orden->vehiculo->marca) }}" class="form-control" id="marca">
                                @error('marca')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="modelo">Modelo</label>
                            <div class="input-group">
                                <input type="text" readonly onkeydown="event.preventDefault()" name="modelo" value="{{ old('modelo',$orden->vehiculo->modelo) }}" class="form-control @error('modelo') is-invalid @enderror" id="modelo">
                                @error('modelo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="placa">Placa</label>
                            <div class="input-group">
                                <input type="text" readonly onkeydown="event.preventDefault()" name="placa" value="{{ old('placa',$orden->vehiculo->placa) }}" class="form-control @error('placa') is-invalid @enderror" id="placa">
                                @error('placa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="tipo">Tipo</label>
                            <div class="input-group">
                                <input type="text" readonly onkeydown="event.preventDefault()" name="tipo" value="{{ old('tipo',$orden->vehiculo->tipoVehiculo->nombre) }}" class="form-control" id="tipo">
                                @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label  for="color">Color</label>
                            <div class="input-group">
                                <input type="text" readonly onkeydown="event.preventDefault()" name="color" value="{{ old('color',$orden->vehiculo->color) }}" class="form-control @error('color') is-invalid @enderror" id="color">
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  for="procedencia">Procedencia<i class="text-danger">*</i></label>
                            <div class="input-group">
                                <input type="text" name="procedencia" value="{{ old('procedencia',$orden->procedencia) }}" class="form-control @error('procedencia') is-invalid @enderror" id="procedencia" required>
                                @error('procedencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  for="destino">Destino<i class="text-danger">*</i></label>
                            <div class="input-group">
                                <input type="text" name="destino" value="{{ old('destino',$orden->destino) }}" class="form-control @error('destino') is-invalid @enderror" id="destino" required>
                                @error('destino')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label  for="comision_cumplir">Comisión a cumplir<i class="text-danger">*</i></label>
                    
                    <div class="input-group">
                        <textarea name="comision_cumplir" class="form-control @error('comision_cumplir') is-invalid @enderror" id="comision_cumplir" required>{{ old('comision_cumplir',$orden->comision_cumplir) }}</textarea>
                        @error('comision_cumplir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="conductor_info">Datos del conductor<i class="text-danger">*</i></label>
                            <div class="input-group">
                                <input type="hidden" name="conductor" id="conductor" value="{{ old('conductor',$orden->conductor_id??'') }}">
                                <input type="text" data-opcion="conductor" onclick="modalConductorSolicitante(this);" onkeydown="event.preventDefault()" readonly id="conductor_info" name="conductor_info" value="{{ old('conductor_info',$orden->InfoConductor) }}" data-toggle="modal" data-target="#modal_large" class="form-control @error('conductor') is-invalid @enderror" placeholder="Seleccionar conductor.." required>
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

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="solicitante_info">Datos del solicitante</label>
                            <div class="input-group">
                                <input type="hidden" name="solicitante" id="solicitante" value="{{ old('solicitante',$orden->solicitante_id??'') }}">
                                <input type="text" data-opcion="solicitante" onclick="modalConductorSolicitante(this);" onkeydown="event.preventDefault()" readonly id="solicitante_info" name="solicitante_info" value="{{ old('solicitante_info',$orden->info_solicitante) }}"  data-toggle="modal" data-target="#modal_large" class="form-control @error('solicitante') is-invalid @enderror" placeholder="Seleccionar solicitante..">
                                <span class="input-group-append">
                                    <span data-toggle="modal" data-target="#modal_large" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </span>
                            </div>

                            @error('solicitante')
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


<!-- Large modal -->
<div id="modal_large" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalConductorSolicitante"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    {{$dataTable->table()}}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="buttonModalConductorSolicitante" onclick="seleccionarConductorSolicitante(this);" data-id="" data-user="" class="btn btn-primary" data-dismiss="modal"></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->

@push('scripts')
    {{$dataTable->scripts()}}
@endpush


@push('linksCabeza')
      
    @if (Storage::exists($empresa->logo))
        <style>
            #example1 {
                background: url("{{ Storage::url($empresa->logo) }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }    
        </style>
    @endif
    

@endpush

@prepend('linksPie')
    <script>
         // seleciona conductor o solicitante
        var conductorOSolictante="";
        function modalConductorSolicitante(arg){
            conductorOSolictante=$(arg).data('opcion');
            switch (conductorOSolictante) {
                case 'conductor':
                    $('#tituloModalConductorSolicitante').html('Selecionar conductor');
                    $('#buttonModalConductorSolicitante').html('Sin conductor');
                    break;
                case 'solicitante':
                    $('#tituloModalConductorSolicitante').html('Selecionar solicitante');
                    $('#buttonModalConductorSolicitante').html('Sin solicitante');
                    break;
            }
        }
        function seleccionarConductorSolicitante(arg){
            switch (conductorOSolictante) {
                case 'conductor':
                    $('#conductor').val($(arg).data('id'));
                    $('#conductor_info').val($(arg).data('user'));
                    break;
            
                case 'solicitante':
                    $('#solicitante').val($(arg).data('id'));
                    $('#solicitante_info').val($(arg).data('user'));
                    break;
            }

            $('#modal_large').modal('hide');
        }
    </script>
@endprepend
@endsection
