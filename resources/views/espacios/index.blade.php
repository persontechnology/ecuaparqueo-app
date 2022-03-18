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
@livewire('estacionamientos.index',['parqueadero'=>$parqueadero])
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
