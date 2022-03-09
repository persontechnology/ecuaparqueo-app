<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-section sidebar-user my-1">
            <div class="sidebar-section-body">
                <div class="media">
                    <a href="#" class="mr-3">
                        @if (Storage::exists(Auth::user()->foto))
                            <img src="{{ Storage::url(Auth::user()->foto) }}" class="rounded-circle" alt="">
                        @else
                            <img src="{{ asset('img/man.png') }}" class="rounded-circle" alt="">
                        @endif
                    </a>

                    <div class="media-body">
                        <div class="font-weight-semibold">
                            {{ Str::limit(Auth::user()->name, 17, '...') }}
                        </div>
                        <div class="font-size-sm line-height-sm opacity-50">
                            {{ Str::limit(Auth::user()->email, 18, '...') }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <button type="button"
                            class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="icon-transmission"></i>
                        </button>

                        <button type="button"
                            class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                            <i class="icon-cross2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Principal</div> <i class="icon-menu"
                        title="Principal"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->routeIs(['home', 'welcome']) ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span>
                            Inicio
                        </span>
                    </a>
                </li>

                @can('Usuarios')
                    <li class="nav-item">
                        <a href="{{ route('usuarios') }}"
                            class="nav-link {{ request()->routeIs('usuarios*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            <span>
                                Usuarios
                            </span>
                        </a>
                    </li>
                @endcan

                @can('Empresa')
                    <li class="nav-item">
                        <a href="{{ route('empresa') }}"
                            class="nav-link {{ request()->routeIs('empresa*') ? 'active' : '' }}">
                            <i class="fa-solid fa-building"></i>
                            <span>
                                Empresa
                            </span>
                        </a>
                    </li>
                @endcan




                @can('Departamentos')
                    <li class="nav-item">
                        <a href="{{ route('departamentos') }}"
                            class="nav-link {{ request()->routeIs('departamentos*') ? 'active' : '' }}">
                            <i class="fa-solid fa-city"></i>
                            <span>
                                Departamentos
                            </span>
                        </a>
                    </li>
                @endcan

                @can('Vehículos')
                    <li class="nav-item">
                        <a href="{{ route('vehiculos') }}"
                            class="nav-link {{ request()->routeIs('vehiculos*') ? 'active' : '' }}">
                            <i class="fa-solid fa-car-side"></i>
                            <span>
                                Vehículos
                            </span>
                        </a>
                    </li>
                @endcan

                @can('Parqueaderos')
                    <li class="nav-item">
                        <a href="{{ route('parqueaderos') }}"
                            class="nav-link {{ request()->routeIs('parqueaderos*') ? 'active' : '' }}">
                            <i class="fa-solid fa-car-side"></i>
                            <span>
                                Parqueaderos
                            </span>
                        </a>
                    </li>
                @endcan

                @can('Orden de Movilización')
                
                <li class="nav-item">
                    <a href="{{ route('odernMovilizacion') }}" class="nav-link {{ request()->routeIs('odernMovilizacion*')?'active':'' }}">
                        <i class="fa-solid fa-address-card"></i>
                        <span>
                            Ordén de movilización
                        </span>
                    </a>
                </li>
                
                @endcan



                @hasanyrole('SuperAdmin|SiteAdmin')
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Seguridad</div> <i class="icon-menu"
                            title="Seguridad"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles') }}"
                            class="nav-link {{ request()->routeIs(['roles', 'permisos']) ? 'active' : '' }}">
                            <i class="icon-lock"></i>
                            <span>
                                Roles y permisos
                            </span>
                        </a>
                    </li>
                @endhasanyrole
                <!-- Components -->
                {{-- <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Components</div> <i class="icon-menu" title="Components"></i></li>
                <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
                    <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Basic components</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Basic components">
                        <li class="nav-item"><a href="components_alerts.html" class="nav-link active">Alerts</a></li>
                    </ul>
                </li> --}}

                <!-- /components -->


            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
