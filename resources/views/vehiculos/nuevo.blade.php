@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('vehiculosNuevo'))


@section('content')

<!-- 2 columns form -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('guardarVehiculo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-address-card"></i> Detalle de vehículo</legend>
                    @include('vehiculos.datos',['vehiculo'=>null])
                </div>

                <div class="col-lg-4">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-truck"></i> Tipo de vehículo</legend>
                    <fieldset>
                        @foreach ($tipoVehiculos as $tv)
                        <div class="form-check">
                            <input type="radio" value="{{$tv->id}}" {{ old('tipo')==$tv->id ?'checked':'' }} name="tipo"  class="form-check-input" id="permi-0-{{ $tv->id }}">
                            <label class="form-check-label" for="permi-0-{{ $tv->id }}" >{{ $tv->nombre }}
                            </label>
                        </div>
						
                    @endforeach
                       
                    </fieldset>
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
<!-- /2 columns form -->

@endsection
