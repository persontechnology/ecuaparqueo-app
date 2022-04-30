
    <div class="sidebar sidebar-light sidebar-secondary sidebar-expand-lg">

        <!-- Expand button -->
        <button type="button" class="btn btn-sidebar-expand sidebar-control sidebar-secondary-toggle">
            <i class="icon-arrow-right13"></i>
        </button>
        <!-- /expand button -->

       
        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Header -->
            <div class="sidebar-section sidebar-section-body d-flex align-items-center">
                <h5 class="mb-0">Selecione parqueadero</h5>
                <div class="ml-auto">
                    <button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-secondary-toggle d-none d-lg-inline-flex">
                        <i class="icon-transmission"></i>
                    </button>

                    <button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-secondary-toggle d-lg-none">
                        <i class="icon-cross2"></i>
                    </button>
                </div>
            </div>
            <!-- /header -->
            @if ($parqueaderos->count()>0)
                <!-- Sidebar search -->
                <div class="sidebar-section">
                    
                    <div class="sidebar-section-header">
                        <select  class="form-control" id="parqueadero" wire:change="changeEvent($event.target.value)">
                            @foreach ($parqueaderos as $par)
                                <option value="{{ $par->id }}" {{ old('idParqueadero')==$par->id?'selected':'' }} >{{ $par->nombre }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                </div>
                <!-- /sidebar search -->
                
                <div class="sidebar-section">
                    <div class="collapse show" id="sidebar-users">
                        <div class="sidebar-section-body">
                            <input wire:model="search" class="form-control my-1" type="search" placeholder="Buscar por N° de móvil...">
                            <ul class="media-list media-list-bordered" id="external-events-list">
                            @if ($espacios->count()>0)
                                
                                    
                                    @foreach ($espacios as $esp)
                                        <li class="media" style="cursor: move;" 
                                            data-id="{{ $esp->id }}" 
                                            data-numeromovil="{{ $esp->numero_movil }}" 
                                            data-marca="{{ $esp->marca }}"
                                            data-modelo="{{ $esp->modelo }}"
                                            data-placa="{{ $esp->placa }}"
                                            data-tipo="{{ $esp->tipoVehiculo->nombre??'' }}"
                                            data-color="{{ $esp->color }}"
                                            data-conductorid="{{ $esp->id_conductor }}"
                                            data-conductorinfo="{{ $esp->conductor->apellidos_nombres??'' }}"
                                        >

                                            @if (Storage::exists($esp->foto))
                                                <img src="{{ Storage::url($esp->foto) }}" width="36" height="36" class="rounded-circle" alt="">
                                            @endif
                                            <div class="media-body">
                                                
                                                    <strong>{{ $esp->numero_movil }}</strong> {{ $esp->placa }}
                                                
                                                <span class="font-size-xs text-muted d-block">
                                                    {{ $esp->modelo }} {{ $esp->color }}
                                                </span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <span data-popup="tooltip" title="{{ $esp->estado }}" data-placement="right" class="badge badge-mark border-{{ $esp->color_estado }}"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                    
                                
                            @else
                            <i class="alert-danger" role="alert">No existe vehículos con placa: {{ $search }}</i>
                            @endif
                        </ul>    

                        </div>
                    </div>
                </div>

            @else
                @include('layouts.alert',['type'=>'info','msg'=>'No existe parqueaderos con vehículos'])
            @endif
        </div>
        <!-- /sidebar content -->
        
    </div>


