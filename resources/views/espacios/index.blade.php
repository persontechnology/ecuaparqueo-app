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
    <div class="card p-3">
        <form class="form-inline" method="GET">
            <div class="d-sm-flex">
                <div class="form-group-feedback form-group-feedback-left flex-grow-1 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-lg" name="placa" value="" placeholder="Buscar Placa">
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>

                <div class="ml-sm-3">
                    <select name="estados" class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
                        <option value="">Todos Estados</option>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
                <div class="ml-sm-3">
                    <select name="tipos" class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
                        <option value="">Todos </option>
                        @if (count($tipos) > 0)
                            @foreach ($tipos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="ml-sm-3">
                    <button type="submit" class="btn btn-teal btn-ladda btn-ladda-progress ladda-button"
                        data-style="slide-down">
                        <span class="ladda-label">Buscar</span>
                        <span class="ladda-spinner"></span>
                        <div class="ladda-progress" style="width: 148px;"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- /simple text stats with icons -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive-lg">
                @if (count($espacios) > 0)
                    <table class="table table-bordered table-sm">
                        <thead style="font-size: 11px; text-align: center;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Km</th>
                                <th scope="col">% Combustible</th>
                                <th scope="col">Fecha de ingreso: </th>
                                <th scope="col">Fecha de salida:</th>
                                <th scope="col">Ver posición</th>
                                <th scope="col">No. orden </th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px; text-align: center;">
                            @foreach ($espacios as $espacio)
                                <tr>
                                    <th scope="row"><span
                                            class="badge rounded-pill {{ $espacio->estadosColor($espacio->estado) }}">{{ $espacio->numero }}</span>
                                    </th>
                                    <td>
                                        <span
                                            class="badge rounded-3 {{ $espacio->estadosColor($espacio->estado) }}">{{ $espacio->estado }}</span>
                                    </td>
                                    <td>{{ $espacio->vehiculo->placa }}</td>
                                    <td>{{ $espacio->vehiculo->kilometraje->numero ?? '' }}</td>
                                    <td>5435</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a target="_baxk" href="{{ route('verVehiculoMapa', $espacio->id) }}"
                                            class="btn btn-outline-success btn-icon border-2 ml-2">
                                            <i class="icon-location4"></i>
                                        </a>
                                    </td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        <script src="{{ asset('global_assets/js/plugins/buttons/spin.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/plugins/buttons/ladda.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/demo_pages/components_buttons.js') }}"></script>
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

            td {
                white-space: nowrap;
            }

            .draggable-element {
                width: 250px;
            }

        </style>
    @endprepend

@endsection
