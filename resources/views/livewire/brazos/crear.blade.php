<!-- Modal -->
<div wire:ignore.self class="modal fade" id="storeModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Brazo</h5>
                <button type="button" class="close" wire:click.prevent="cancelModalCrear()" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Código Registro hardware</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Código"
                            wire:model="codigo">
                        @error('codigo')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Descripción</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" wire:model="descripcion"
                            placeholder="Descripción">
                        @error('descripcion')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" wire:click.prevent="cancelModalCrear()"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
