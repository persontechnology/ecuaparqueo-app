@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('estacionamientos', $parqueadero))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">
        <a data-toggle="modal" data-target="#exampleModal" class="breadcrumb-elements-item">
            Nuevo Estacionamiento <i class="fa-solid fa-building ml-1"></i>
        </a>
    </div>

@endsection
@section('content')
    <!-- Simple text stats with icons -->

    <div class="row text-center">
        <div class="col-sm-2">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <a href="#" class="btn bg-transparent border-teal text-teal rounded-pill border-2 btn-icon mr-3">
                    <i class="icon-road"></i>
                </a>
                <div>
                    <div class="font-weight-semibold">
                        {{ count($parqueadero->espacios) }}/{{ $parqueadero->numero_total ?? 0 }}</div>
                    <span class="text-muted">Total</span>
                </div>
            </div>
        </div>
        <div class="col-sm-7 ">
            {{-- <span class="badge badge-success badge-pill align-self-center ml-auto">Activo</span> --}}
            <span class="badge badge-danger badge-pill align-self-center ml-auto">Inactivo</span>
            <span class="badge badge-info badge-pill align-self-center ml-auto">Presente</span>
            <span class="badge badge-warning badge-pill align-self-center ml-auto">Ausente</span>
            {{-- <span class="badge badge-pink badge-pill align-self-center ml-auto">Solicitado</span>
            <span class="badge badge-primary badge-pill align-self-center ml-auto">Resevado</span> --}}

        </div>
        <div class="col-sm-3">

            <div class="text-right mb-0 mb-1">
                <button class="btn btn-primary" id="btn-update"><i class="icon-rotate-ccw3 mr-1"></i>ACTUALIZAR
                    POSICIÓN</button>
            </div>
        </div>
    </div>

    <!-- /simple text stats with icons -->
    <div class="card" id="draggable-default-container"
        style="overflow:scroll;height:1000px;border:1px solid rgb(37 43 54 / 65%);background-color:#252b3675; position: inherit;">
        <div class="card-body">
            <div>
                @if (count($espacios) > 0)

                    @foreach ($espacios as $espacio)
                        <div id="item-{!! json_encode($espacio->id) !!}-establecimiento"
                            class="shadow-sm  draggable-element rounded-5 text-center"
                            style="position: relative; left:{{ $espacio->left }}px; top: {{ $espacio->top }}px;">

                            <div class="card text-center">
                                <div class="card-body ">
                                    <div class="media">
                                        <div class="mr-2">
                                            <span style="padding: .7125rem .8375rem;"
                                                class="position-absolute top-0 left-50 start-100 translate-middle badge rounded-pill {{ $espacio->estadosColor($espacio->estado) }}">{{ $espacio->numero }}</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-title font-weight-semibold">{{ $espacio->vehiculo->placa }}
                                            </div>
                                            @if (Storage::exists($espacio->vehiculo->foto))
                                                <a data-toggle="tooltip" data-placement="bottom" title="{{ $espacio->vehiculo->kilometraje->numero ?? '' }}" href="{{ Storage::url($espacio->vehiculo->foto) }}">
                                                    <img src="{{ Storage::url($espacio->vehiculo->foto) }}"
                                                        class="rounded-circle" width="60" height="60" alt="">
                                                </a>
                                            @else
                                                <i id="icon" class="icon-car"></i>
                                            @endif                  
                                           
                                        </div>

                                        <div class="ml-1">
                                            <div class="list-icons position-static">
                                                <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-center" style="">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="icon-pencil4"></i>
                                                        Editar
                                                    </a>
                                                    <a href="{{ route('verVehiculoMapa', $espacio->id) }}"
                                                        class="dropdown-item">
                                                        <i class="icon-location4"></i>
                                                        Ver Localidad
                                                    </a>
                                                    <a href="{{ route('listarReservaVehiculo', $espacio->id) }}"
                                                        class="dropdown-item">
                                                        <i class="icon-calendar2"></i>
                                                        Ver reservas
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="icon-list"></i>
                                                        Ingreso del vehículo
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- /basic -->
    {{-- modal --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear nuevo estacionamiento en el parqueadero
                        {{ $parqueadero->nombre }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('estacionamientoNuevo') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input id="parqueadero_id" name="parqueadero_id" type="hidden" value="{{ $parqueadero->id }}"
                            class="form-control @error('parqueadero_id') is-invalid @enderror" />
                        <div class="form-group">
                            <label for="numero">Número:</label>

                            <input id="numero" type="number" required
                                class="form-control @error('numero') is-invalid @enderror" name="numero"
                                value="{{ old('numero') }}">

                            @error('numero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Seleccinar un vehículo:</label>
                            <select name="vehiculo_id" style="width:100%;" id="vehiculo_id"
                                class="form-control @error('vehiculo_id') is-invalid @enderror" required>
                                <option value="">
                                    SELECCIONAR UN VEHÍCULO
                                </option>
                                @if (count($vehiculos) > 0)
                                    @foreach ($vehiculos as $ve)
                                        <option value="{{ $ve->id }}" data-image="{{ Storage::url($ve->foto) }}">
                                            {{ $ve->placa }}-{{ $ve->descripcion }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>


                            </fieldset>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('linksCabeza')
        <script src="{{ asset('global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
        <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/select2/js/select2.js') }}"></script>
    @endpush

    @prepend('linksPie')
        <script>
            $(document).ready(function() {
                setListaEstablecimientos({!! json_encode($espacios) !!});
                setIdParqueadero({!! json_encode($parqueadero) !!})
                $('#vehiculo_id').select2({
                    templateResult: insertarImagenSelect,
                    templateSelection: insertarImagenSelect
                });

                function insertarImagenSelect(opt) {
                    if (!opt.id) {
                        return opt.text;
                    }
                    var optimage = $(opt.element).attr('data-image');
                    if (!optimage) {
                        return opt.text;
                    } else {
                        var $opt = $(
                            '<span><img src="' + optimage +
                            '" width="50" height="40" class="rounded-circle mr-2" /> ' + opt.text +
                            '</span>'
                        );
                        return $opt;
                    }
                };
            });
            @if ($errors->has('number') || $errors->has('parqueadero_id') || $errors->has('vehiculo_id'))
                $('#exampleModal').modal('show');
            @endif
        </script>
        <script src="{{ asset('js/parqueadero/estacionamiento/index.js') }}"></script>
        <style>
            #icon {
                font-size: 55px;
            }

            .draggable-element {
                width: 250px;
            }

        </style>
    @endprepend

@endsection
