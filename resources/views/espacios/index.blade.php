@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderos'))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">
        <a data-toggle="modal" data-target="#exampleModal" class="breadcrumb-elements-item">
            Nuevo Estacionamiento <i class="fa-solid fa-building ml-1"></i>
        </a>
    </div>

@endsection
@section('content')
    <div class="text-right mb-1">
        <button class="btn btn-info" id="btn-update">ACTUALIZAR</button>
    </div>
    <div class="card" id="draggable-default-container"
        style="overflow:scroll;height:1000px;border:1px solid rgb(218, 213, 213);background-color:lightblue; position: inherit;">
        <div class="card-body">
            <div>
                @if (count($espacios) > 0)

                    @foreach ($espacios as $espacio)
                        <div id="item-{!! json_encode($espacio->id) !!}-establecimiento"
                            class=" draggable-element bg bg-primary rounded-5 text-center"
                            style="position: relative; left:{{ $espacio->left }}px; top: {{ $espacio->top }}px;">

                            <div class="card text-center">
                                <div class="card-body ">
                                    <div class="media">
                                        <div class=" mr-2">

                                            @if (Storage::exists($espacio->vehiculo->foto))
                                                <a href="{{ Storage::url($espacio->vehiculo->foto) }}">
                                                    <img src="{{ Storage::url($espacio->vehiculo->foto) }}"
                                                        class="rounded-circle" width="80" height="60" alt="">
                                                </a>
                                            @else
                                                <i id="icon" class="icon-car"></i>
                                            @endif
                                            <br>
                                            <span
                                                class="badge badge-flat border-success text-success rounded-0">{{ $espacio->vehiculo->estado }}</span>
                                            <span style="padding: .7125rem .8375rem;"
                                                class="position-absolute top-0 left-50 start-100 translate-middle badge rounded-pill bg-danger">{{ $espacio->numero }}</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-title font-weight-semibold">{{ $espacio->vehiculo->placa }}
                                            </div>
                                            <div><span
                                                    class="text-muted">{{ $espacio->vehiculo->tipoVehiculo->nombre }}</span></span>
                                            </div>
                                            <div class="list-icons">
                                                <span class="list-icons-item"> <i class="text-muted icon-road">km</i>
                                                    {{ $espacio->vehiculo->kilometraje->numero??'' }}</span>
                                                <span class="list-icons-item"><i class="text-muted icon-gas "></i>
                                                    50%</span>
                                            </div>
                                        </div>

                                        <div class="ml-1">
                                            <div class="list-icons position-static">
                                                <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-center" style="">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-comment-discussion"></i>
                                                        Start
                                                        chat</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a
                                                        call</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-comment-discussion"></i>
                                                        Start
                                                        chat</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a
                                                        call</a>

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

                            <input id="numero" type="number" required class="form-control @error('numero') is-invalid @enderror"
                                name="numero" value="{{ old('numero') }}">

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
                                        <option value="{{$ve->id}}" data-image="{{ Storage::url($ve->foto) }}">
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
                            '<span><img src="' + optimage + '" width="50" height="40" class="rounded-circle mr-2" /> ' + opt.text +
                            '</span>'
                        );
                        return $opt;
                    }
                };
            });
            @if ($errors->has('number')||$errors->has('parqueadero_id')||$errors->has('vehiculo_id'))
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
