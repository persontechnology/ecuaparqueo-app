
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


                

                <!-- Online users -->
                <div class="sidebar-section">
                    <div class="collapse show" id="sidebar-users">
                        <div class="sidebar-section-body">
                            <input wire:model="search" class="form-control my-1" type="search" placeholder="Buscar por placa...">
                            <ul class="media-list media-list-bordered" id="external-events-list">
                            @if ($espacios->count()>0)
                                
                                    
                                    @foreach ($espacios as $esp)
                                        <li class="media" style="cursor: move;" data-id="{{ $esp->id }}" data-placa="{{ $esp->placa }}-{{ $esp->numero_chasis }}">
                                            @if (Storage::exists($esp->foto))
                                                
                                                    <img src="{{ Storage::url($esp->foto) }}" width="36" height="36" class="rounded-circle" alt="">
                                                
                                            @endif
                                            <div class="media-body">
                                                
                                                    {{ $esp->placa }}
                                                
                                                <span class="font-size-xs text-muted d-block">
                                                    {{ $esp->numero_chasis }}
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
                <!-- /online-users -->
               

                <!-- Filter -->
                {{-- <div class="sidebar-section">
                    <div class="sidebar-section-header">
                        <span class="font-weight-semibold">Filters</span>
                        <div class="list-icons ml-auto">
                            <a href="#sidebar-filters" class="list-icons-item" data-toggle="collapse">
                                <i class="icon-arrow-down12"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show" id="sidebar-filters">
                        <form class="sidebar-section-body" action="#">
                            <div class="form-group">
                                <label class="custom-control custom-checkbox custom-control-right mb-2">
                                    <input type="checkbox" class="custom-control-input" checked>
                                    <span class="custom-control-label position-static p-0">Free People</span>
                                </label>

                                <label class="custom-control custom-checkbox custom-control-right mb-2">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label position-static p-0">GAP</span>
                                </label>

                                <label class="custom-control custom-checkbox custom-control-right mb-2">
                                    <input type="checkbox" class="custom-control-input" checked>
                                    <span class="custom-control-label position-static p-0">Lane Bryant</span>
                                </label>

                                <label class="custom-control custom-checkbox custom-control-right mb-2">
                                    <input type="checkbox" class="custom-control-input" checked>
                                    <span class="custom-control-label position-static p-0">Ralph Lauren</span>
                                </label>

                                <label class="custom-control custom-checkbox custom-control-right">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label position-static p-0">Liz Claiborne</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- /filter -->

            @else
                @include('layouts.alert',['type'=>'info','msg'=>'No existe parqueaderos con vehículos'])
            @endif
        </div>
        <!-- /sidebar content -->
        
    </div>


