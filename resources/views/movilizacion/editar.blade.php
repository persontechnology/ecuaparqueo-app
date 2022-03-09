@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacionEditar',$orden))
@section('content')
@php
    $numero=$orden->numero;
@endphp

<form action="{{ route('odernMovilizacionActualizar') }}" method="POST" autocomplete="off">
    @csrf
    <div class="card">
        <div class="card-header bg-transparent header-elements-sm-inline py-sm-0">
            <h1 class="card-title py-sm-3 text-primary"><strong>ORDEN DE MOVILIZACIÓN</strong></h1>
            <div class="header-elements">
                <h1 class="text-primary mr-1"><strong class="text-danger">{{ $numero }}</strong></h1>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" name="id" value="{{ $orden->id }}" required>
            @include('movilizacion.datos',['orden'=>$orden])
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="estado">Estado:</label>
                <div class="col-lg-10">

                    <select name="estado" class="form-control @error('motivo') is-invalid @enderror" id="estado" required>
                        <option value="ESPERA" {{ old('estado',$orden->estado??'')=='ESPERA'?'selected':'' }}>ESPERA</option>
                        <option value="ACEPTADA" {{ old('estado',$orden->estado??'')=='ACEPTADA'?'selected':'' }}>ACEPTADA</option>
                        <option value="DENEGADA" {{ old('estado',$orden->estado??'')=='DENEGADA'?'selected':'' }}>DENEGADA</option>
                    </select>
                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
                
        </div>
        <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center text-center">   
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>





@push('scripts')
    {!! $conductorDataTable->html()->scripts() !!} 
    {!! $vehiculoDataTable->html()->scripts() !!} 

    <script>
        function seleccionarConductor(arg){
            $('#conductorUser').val($(arg).data('user'));
            $('#conductor').val($(arg).data('id'));
        }
        function seleccionarVehiculo(arg){
            $('#marcaVehiculo').val($(arg).data('vehiculo'));
            $('#vehiculo').val($(arg).data('id'));
        }
    </script>
@endpush

@endsection
