@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('espacios',$parqueadero))

@section('barraLateral')
<div class="breadcrumb justify-content-center">
    
    <a href="{{ route('espaciosPdf',$parqueadero->id) }}" target="_blank" class="breadcrumb-elements-item">
        Descargar PDF <i class="fa-solid fa-file-pdf ml-1 text-success"></i>
    </a>
    
    <a href="{{ route('espaciosNuevo',$parqueadero->id) }}" class="breadcrumb-elements-item">
        Nuevo espacio <i class="icon-road text-pink ml-1"></i>
    </a>
</div>
@endsection

@section('content')
@if (!$parqueadero->espacios->count()>0)
    <form action="{{ route('espaciosCrearRangoEspacios') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $parqueadero->id }}">
        <div class="card">
            <div class="card-header">
                <h2 class="text-info"><strong>No tiene espacios creados</strong></h2>
                Cree un rango de espacios, para luego asignar un vehículo.
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="rango">Crear espacios hasta<i class="text-danger">*</i></label>
                    <input id="rango" type="number" class="form-control @error('rango') is-invalid @enderror" name="rango" value="{{ old('rango') }}" required autofocus>

                    @error('rango')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Crear espacios</button>
            </div>
        </div>
    </form>
@endif
@if ($parqueadero->espacios->count()>0)

    <div class="card">
        <div class="card-header">
            <span class="badge badge-success">Activo</span>
            <span class="badge badge-danger">Inactivo</span>
            <span class="badge badge-info">Presente</span>
            <span class="badge badge-warning">Ausente</span>
            <span class="badge badge-pink">Solicitado</span>
            <span class="badge badge-primary">Reservado</span>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th># Espacio</th>
                            <th># Espacio</th>
                            <th>Vehículo <small># móvil placa</small></th>
                            <th>Conductor</th>
                            <th>Tipo Vehículo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parqueadero->espacios as $esp)
                            <tr>
                                <td>
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                    
                                            <div class="dropdown-menu dropdown-menu-left">
                                                
                                                
                                                <a href="{{ route('espaciosVerVehiculoMapa', $esp->id) }}" class="dropdown-item">
                                                    <i class="fa-solid fa-location-dot text-secondary"></i>
                                                    Ver ubicación
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" onclick="event.preventDefault();eliminar(this);" data-id="{{ $esp->id }}"
                                                    data-url="{{ route('espaciosEliminar') }}"
                                                    data-msg="Está seguro de eliminar {{ $esp->numero }}!" class="dropdown-item">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                    Eliminar
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">{{ $esp->numero }}</td>
                                <td class="text-center">
                                    
                                    <form action="{{ route('espaciosActualizarVehiculo') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $esp->id }}">
                                        <select class="form-control form-control-sm" name="vehiculo" onchange="this.form.submit()">
                                            <option value=""></option>
                                            @if ($esp->vehiculo)
                                                <option {{ $esp->vehiculo->numero_movil_placa??'' }} selected>{{ $esp->vehiculo->numero_movil_placa??'N/A' }}</option>    
                                            @endif
                                            
                                            @foreach ($vehiculos as $veh)
                                                <option value="{{ $veh->id }}" wire:key="{{ $esp->id.$veh->id }}">{{ $veh->numero_movil_placa }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    {{ $esp->vehiculo->info_conductor??'' }}
                                </td>
                                <td>
                                    {{ $esp->vehiculo->tipoVehiculo->nombre??'' }}
                                </td>
                                <td>
                                    <span class="badge badge-{{ $esp->color_estado }}">{{ $esp->estado}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endif

@endsection
