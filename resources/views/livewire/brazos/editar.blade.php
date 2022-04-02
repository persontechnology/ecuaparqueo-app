<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Brazo</h5>
                <button type="button" wire:click.prevent="cancelModalUpdate()" class="close"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="selected_id">
                        <label for="exampleFormControlInput1">Código</label>
                        <input type="text" class="form-control" wire:model="codigo" id="exampleFormControlInput1"
                            placeholder="Código">
                        @error('codigo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Descripción</label>
                        <input type="text" class="form-control" wire:model="descripcion" id="exampleFormControlInput2"
                            placeholder="Descripción">
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select wire:model="estado" class="form-control @error('estado') is-invalid @enderror" required>
                            <option value="Activo">
                                Activo
                            </option>
                            <option value="Inactivo">
                                Inactivo
                            </option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancelModalUpdate()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" wire:loading.attr="disabled" class="btn btn-primary"
                    data-dismiss="modal">Actualizar</button>
            </div>
        </div>
    </div>
</div>
