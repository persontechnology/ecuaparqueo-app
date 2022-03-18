<div>
    @include('livewire.estacionamientos.map')
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex pb-3">
                <div class="form-group-feedback form-group-feedback-left flex-grow-1 mb-3 mb-sm-0">
                    <input type="search" wire:model="search" class="form-control form-control-lg" name="placa" value=""
                        placeholder="Buscar Placa">
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>

                <div class="ml-sm-3">
                    <select name="estados" wire:model="estadoParqueadero"
                        class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
                        <option value="">Todos Estados</option>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
                <div class="ml-sm-3">
                    <select name="tipos" wire:model="tipoVehiculo"
                        class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
                        <option value="">Todos </option>
                        @if (count($tipos) > 0)
                            @foreach ($tipos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
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
                          
                                        <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="showMap(2)"
                                            class="btn btn-outline-success btn-icon border-2 ml-2">
                                            <i class="icon-location4"></i>
                                        </button>

                                        <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit({{ $espacio->id }})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                    </td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {!! $espacios->links() !!}
                    </div>
                @else
                    <div class="text-center">No se encontraron resultados</div>
                @endif

            </div>
        </div>
    </div>
</div>
