@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('despacho-combustible.edit',$dc))
@section('content')
    <form action="{{ route('despacho-combustible.update',$dc->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Despacho <strong class="text-danger">{{ $numeroSiguente }}</strong></h1>
            </div>
            <div class="card-body">
                @include('despachoCombustible.datos',['dc'=>$dc])
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="estado">Estado<i class="text-danger">*</i></label>
                            <select name="estado" id="estado" class="form-control @error('observaciones') is-invalid @enderror" required>
                                <option value="Autorizado" {{ old('estado',$dc->estado)=='Autorizado'?'selected':'' }} >Autorizado</option>
                                <option value="Anulado" {{ old('estado',$dc->estado)=='Anulado'?'selected':'' }} >Anulado</option>
                                <option value="Despachado" disabled {{ old('estado',$dc->estado)=='Despachado'?'selected':'' }} >Despachado</option>
                            </select>
                            
                            @error('estado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer bg-transparent">
                @can('update', $dc)
                    <button type="submit" class="btn btn-primary">Actualizar</button>    
                @else
                    @include('layouts.alert',['type'=>'info','msg'=>'No se puede actualizar despacho de combustible en estado '.$dc->estado])
                @endcan
                
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
                    {!! $udt->html()->table(['id' => 'udt']) !!} 
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

<!-- Large modal -->
<div id="modal_large_vehiculo" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalConductorSolicitante">Selecionar vehículo</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    {!! $pdt->html()->table(['id' => 'pdt']) !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->
@push('linksPie')
<script src="{{ asset('js/numeroALetras.js') }}"></script>
<script src="{{ asset('js/jquery.maskMoney.min.js') }}"></script>
<script>
       

    $("#valor").maskMoney({prefix:'', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
    var vt=$('#valor').on('keyup keydown keypress',e=>{
        cargarValorLetras(e.target.value);
    })

    function cargarValorLetras(value){
        var res=numeroALetras(value, {
            plural: 'dólares',
            singular: 'dólar',
            centPlural: 'centavos',
            centSingular: 'centavo'
        });
        $('#valor_letras').val(res)
        $('#letras_valor_convertido').html(res)
    }

    cargarValorLetras($('#valor').val())

    $("#galones").maskMoney({prefix:'', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
    $('#galones').on('keyup keydown keypress',e=>{
        cargarGalonesLetras(e.target.value);
    })

    function cargarGalonesLetras(value){
        var res=numeroALetras(value, {
            plural: 'galones',
            singular: 'galon',
            centPlural: '.',
            centSingular: '.'
        });
        $('#cantidad_letras').val(res)
        $('#letras_cantidad_galones_convertido').html(res)
    }
    cargarGalonesLetras($('#galones').val())
        
</script>
@endpush
@push('scripts')
    {!! $udt->html()->scripts() !!}
    {!! $pdt->html()->scripts() !!} 

    <script>
        function seleccionarVehiculo(arg){
            $('#vehiculo').val($(arg).data('id'))
            $('#numeroMovil').val($(arg).data('numeromovil'))
            $('#kilometraje').val($(arg).data('kilometraje'))
            $('#conductor').val($(arg).data('conductorid'))
            $('#conductor_info').val($(arg).data('conductorinfo'))
            $('#modal_large_vehiculo').modal('hide');
        }

        function seleccionarChofer(arg){
            $('#conductor').val($(arg).data('conductorid'))
            $('#conductor_info').val($(arg).data('conductorinfo'))
            $('#modal_large').modal('hide');
        }
    </script>
@endpush
@endsection
