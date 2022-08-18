<div class="card">
    <div class="card-header">
        <div class="form-row">
            <div class="form-group col-md-2">
                <div class="form-group">
                    <label>Descargar PDF</label>
                    <button class="btn btn-info form-control" wire:click="pdf" wire:loading.attr="disabled">
                        <i class="fa-solid fa-file-pdf ml-1"></i>
                    </button>
                </div>
            </div>
            <div class='form-group col-md-4'>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Desde</label>
                    <input type="date" class="form-control" wire:model="desde" id="exampleFormControlInput1" >
                </div>
            </div>
            <div class='form-group col-md-4'>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Hasta</label>
                    <input type="date" class="form-control" wire:model="hasta" id="exampleFormControlInput2" >
                </div>
            </div>
            <div class='form-group col-md-2'>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Mostrar hasta</label>
                    <select name="" id="" wire:model="mostrar" class="form-control">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="search" wire:model="numeroPlaca" class="form-control" id="inputZip" placeholder="Buscar por N° o Placa de vehículo.">
            </div>

            <div class="form-group col-md-6">
                <select id="inputState" class="form-control" wire:model="tipoLectura">
                    <option value="">Filtrar por estado</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($lecturasNormales->count()>0)
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <td>Tipo</td>
                            <td>N° Vehículo & Placa</td>
                            <td>Finalizado</td>
                            <td>Motivo</td>
                            <td>Fecha salida</td>
                            <td>Fecha entrada</td>
                            <td>Parqueadero & Brazo</td>
                            <td>Guardia</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturasNormales as $ln)
                           <tr>
                                <td>{{ $ln->tipo }}</td>
                                <td>{{ $ln->vehiculo->numero_movil_placa??'' }}</td>
                                <td>{{ $ln->finalizado }}</td>
                                <td>{{ $ln->motivo }}</td>
                                <td>{{ $ln->fecha_salida }}</td>
                                <td>{{ $ln->fecha_entrada }}</td>
                                <td>{{ $ln->brazo->parqueadero->nombre }}-{{ $ln->brazo->codigo }}</td>
                                <td>{{ $ln->guardia->apellidos_nombres??'' }}</td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                @include('layouts.alert',['type'=>'info','msg'=>'No existe lecturas normales.'])
            @endif
        </div>
    </div>
    
    <div class="card-footer bg-white">
        {{ $lecturasNormales->links() }}
    </div>  
</div>
