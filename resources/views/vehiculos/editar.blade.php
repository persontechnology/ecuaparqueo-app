@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('vehiculosEditar',$vehiculo))


@section('content')

<!-- 2 columns form -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('actualizarVehiculo') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $vehiculo->id }}" required>
            <div class="row">
                <div class="col-lg-10">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-address-card"></i> Detalle de vehículo</legend>
                    @include('vehiculos.datos',['vehiculo'=>$vehiculo])
                </div>

                <div class="col-lg-2">
                    <legend class="font-weight-semibold"><i class="fa-solid fa-truck"></i> Tipo de vehículo</legend>
                    <fieldset>
                        @foreach ($tipoVehiculos as $tv)
                        <div class="form-check">
                            <input type="radio" value="{{$tv->id}}" {{ $vehiculo->tipo_vehiculo_id==$tv->id ?'checked':'' }} name="tipoVehiculo"  class="form-check-input" id="permi-0-{{ $tv->id }}">
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


 <!-- Full width modal -->
 <div id="modal_full" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecionar conductor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    {{$dataTable->table()}}
                </div>
            </div>

            <div class="modal-footer">
                
                <button type="button" onclick="seleccionarConductor(this);" data-id="" data-user="" class="btn btn-primary" data-dismiss="modal">Sin conductor</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /full width modal -->
@push('scripts')
    {{$dataTable->scripts()}}
@endpush



@prepend('linksPie')
    <script>
        function seleccionarConductor(arg){
            var id=$(arg).data('id');
            var user=$(arg).data('user');
            $('#conductor').val(id);
            $('#conductorInfo').val(user);
            $('#modal_full').modal('hide');
        }
    </script>
@endprepend

@endsection
