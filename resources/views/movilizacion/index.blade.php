@extends('layouts.app')

@section('content')

<form action="{{ route('odernMovilizacionGuardar') }}" method="POST" autocomplete="off">
    @csrf
    <div class="card">
        <div class="card-header bg-transparent header-elements-sm-inline py-sm-0">
            <h1 class="card-title py-sm-3 text-primary"><strong>ORDEN DE MOVILIZACIÓN</strong></h1>
            <div class="header-elements">
                <h1 class="text-primary mr-1"><strong>N°</strong> <strong class="text-danger">{{ $numero }}</strong></h1>
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



{{-- modal conductor --}}
<div id="modal_full_conductor" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecionar conductor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    {!! $conductorDataTable->html()->table() !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- /modal conductor --}}

{{-- modal vehiculo --}}
<div id="modal_full_vehiculo" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecionar vehículo</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    {!! $vehiculoDataTable->html()->table() !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- /modela vehiculo --}}


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
