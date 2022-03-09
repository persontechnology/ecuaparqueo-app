@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacionNuevo'))
@section('content')

<form action="{{ route('odernMovilizacionGuardar') }}" method="POST" autocomplete="off">
    @csrf
    <div class="card">
        <div class="card-header bg-transparent header-elements-sm-inline py-sm-0">
            <h1 class="card-title py-sm-3 text-primary"><strong>ORDEN DE MOVILIZACIÓN</strong></h1>
            <div class="header-elements">
                <h1 class="text-primary mr-1"><strong class="text-danger">{{ $numero }}</strong></h1>
            </div>
        </div>
        <div class="card-body">

            @include('movilizacion.datos',['orden'=>null])
                
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
