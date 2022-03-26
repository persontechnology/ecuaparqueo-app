<div>
    @if ($updateMode)
        @include('livewire.brazos.editar')
    @else
        @include('livewire.brazos.crear')
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex pb-3">
                <div class="form-group-feedback form-group-feedback-left flex-grow-1 mb-3 mb-sm-0">
                    <input type="search" wire:model="search" class="form-control form-control-lg" name="placa" value=""
                        placeholder="Buscar Código">
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>
            </div>
            <div wire:loading wire:target="qtys">
                <div class="card-overlay card-overlay-fadeout" role="status">
                    <div class="spinner-border ">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="table-responsive-lg">
                @if (count($brazos) > 0)

                    <table class="table table-bordered table-sm">
                        <thead style="font-size: 11px; text-align: center;">
                            <tr>
                                <th scope="col">Acciones</th>
                                <th scope="col">#</th>
                                <th scope="col">Código</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Estado del brazo</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px; text-align: center;">
                            @foreach ($brazos as $brazo)
                                <tr wire:key="post-field-{{ $brazo->id }}">
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal" data-target="#updateModal"
                                                wire:click="edit({{ $brazo->id }})"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $brazo->id }}</td>
                                    <td>{{ $brazo->codigo }}</td>
                                    <td>{{ $brazo->estado }}</td>
                                    <td>
                                        <div class="header-elements">
                                            <label class="custom-control custom-switch custom-control-right">
                                                @if ($brazo->estado === 'Activo')
                                                    <input type="checkbox"
                                                        class="custom-control-input btn-ladda btn-ladda-progress ladda-button"
                                                        wire:change="qtys({{ $brazo->id }})"
                                                        {{ $brazo->estado_brazo ? 'checked' : '' }}>
                                                @endif
                                                <span class="custom-control-label">Brazo
                                                    {{ $brazo->estado_brazo ? 'Abietoss' : 'Cerradoss' }}</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $brazo->descripcion }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {!! $brazos->links() !!}
                    </div>
                @else
                    <div class="text-center">No se encontraron resultados</div>
                @endif

            </div>

        </div>
    </div>
</div>
@prepend('linksPie')
    <script type="text/javascript">
        window.addEventListener('brazoStore', () => {
            $('#modalBrazos').modal('hide');
        });
    </script>
@endprepend
