<div class="card">
    <div class="card-header">
        <div class="form-row">

            <div class="form-group col-md-3">
                <input type="search" wire:model="NumeroOrden" class="form-control" id="inputZip" placeholder="Buscar por # orden">
            </div>

            <div class="form-group col-md-3">
                <select id="inputState" class="form-control" wire:model="IdParqueadero">
                    <option value="">Filtrar por parqueadero</option>
                    @foreach ($parqueaderos as $pa)
                        <option value="{{ $pa->id }}">{{ $pa->nombre }}</option>
                    @endforeach
                </select>
                
            </div>

            <div class="form-group col-md-3">
                <select id="inputState" class="form-control" wire:model="IdTipoVehiculo">
                    <option value="">Filtrar por tipo de Vehículo</option>
                    @foreach ($tipoVehiculos as $tv)
                        <option value="{{ $tv->id }}">{{ $tv->nombre }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-3">
                <select id="inputState" class="form-control" wire:model="EstadoOrdenMovilizacion">
                    <option value="">Filtrar por estado</option>
                    <option value="SOLICITADO">SOLICITADO</option>
                    <option value="ACEPTADA">ACEPTADA</option>
                    <option value="DENEGADA">DENEGADA</option>
                    <option value="OCUPADO">OCUPADO</option>
                    <option value="FINALIZADO">FINALIZADO</option>
                </select>
            </div>
            
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($ordenMovilizaciones->count()>0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Aprobar/Reprobar</th>
                            <th>#</th>
                            <th>Vehículo</th>
                            <th>Servidor público</th>
                            <th>Fecha Salida & Retorno</th>
                            <th>Estado</th>
                            <th>Chofer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenMovilizaciones as $com)
                            <tr>
                                <td class="text-center">
                                    
                                </td>
                                <td>{{ $com->numero }}</td>
                                <td>
                                    @if (Storage::exists($com->vehiculo->foto))
                                        <img src="{{ Storage::url($com->vehiculo->foto) }}" class="rounded-circle" width="32" height="32" alt="">    
                                    @endif
                                    
                                    {{ $com->vehiculo->placa }}
                                </td>
                                <td>{{ $com->servidor_publico }}</td>
                                <td>
                                    {{ $com->fecha_salida }} - {{ $com->fecha_retorno }}
                                </td>
                                <td>
                                    {{ $com->estado }}
                                </td>
                                <td>
                                    {{ $com->info_onductor }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                @include('layouts.alert',['type'=>'info','msg'=>'No existe ordenes de movilización'])
            @endif
        </div>
    </div>
    
    <div class="card-footer bg-white">
        {{ $ordenMovilizaciones->links() }}
    </div>    
    
    
</div>
