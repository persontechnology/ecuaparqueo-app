<div>
    @if ($lecturas->count()>0)
        <div class="card">
            <div class="card-header">
                <button class="btn btn-link" wire:click="pdf">
                    Descargar PDF <i class="fa-solid fa-file-pdf ml-1"></i>
                </button>
                <div class="form-row">
                    <div class='form-group col-md-5'>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Desde</label>
                            <input type="date" class="form-control" wire:model="desde" id="exampleFormControlInput1" >
                        </div>
                    </div>
                    <div class='form-group col-md-5'>
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
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Salida</th>
                            <th>Entrada</th>
                            <th>% Combustible</th>
                            <th>Kilometraje</th>
                            <th>Brazo y parqueadero salida</th>
                            <th>Brazo y parqueadero entrada</th>
                            <th>Orden Movilización</th>
                            <th>Guardia entrada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturas as $lec)
                        <tr>
                            <td scope="row">{{ $lec->created_at }} </td>
                            <td>{{ $lec->fecha_retorno }}</td>
                            <td>{{ $lec->porcentaje_combustible }}</td>
                            <td>{{ $lec->kilometraje }}</td>
                            <td>{{ $lec->brazoSalida->codigo??'' }} {{ $lec->brazoSalida->parqueadero->nombre??'' }}</td>
                            <td>{{ $lec->brazoEntrada->codigo??'' }} {{ $lec->brazoEntrada->parqueadero->nombre??'' }}</td>
                            <td>{{ $lec->ordenMovilizacion->numero??'' }}</td>
                            {{-- <td>{{ $lec->guardia->apellidos_nombres }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                {{ $lecturas->links() }}
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                @include('layouts.alert',['msg'=>'Vehículo no tiene lecturas','type'=>'info'])
            </div>
        </div>
    @endif
</div>
