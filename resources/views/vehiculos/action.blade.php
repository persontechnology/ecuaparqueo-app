
<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left">
            <a href="{{ route('vehiculosOrdenMovilizacion',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-address-card text-warning"></i> Orden Movilización</a>
            @switch($vehiculo->tipo)
                @case('Normal')
                    <a href="{{ route('vehiculosLecturaNormal',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-down-left-and-up-right-to-center text-info"></i> Lecturas</a>
                    @break
                @case('Especial')
                    <a href="{{ route('vehiculosLecturaEspecial',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-down-left-and-up-right-to-center text-info"></i> Lecturas</a>
                    @break
                @case('Invitados')
                    <a href="{{ route('vehiculosLecturaInvitados',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-down-left-and-up-right-to-center text-info"></i> Lecturas</a>
                    @break
            @endswitch
            
            <a href="{{ route('vehiculosUbicacionMapa',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-location-dot text-success"></i> Ubicación</a>
            <a href="{{ route('kilometrajes',$vehiculo->id) }}" class="dropdown-item"><i class="fa-solid fa-location-dot text-secondary"></i> Kilometrajes</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('vehiculosEditar',['id'=>$vehiculo->id ]) }}" class="dropdown-item"><i class="fa-solid fa-pen-to-square text-primary"></i> Editar</a>
            <a href="#" onclick="event.preventDefault();eliminar(this);" data-id="{{ $vehiculo->id }}" data-url="{{ route('vehiculosEliminar') }}" data-msg="Está seguro de eliminar vehículo {{ $vehiculo->placa }}!" class="dropdown-item"><i class="fa-solid fa-trash text-danger"></i> Eliminar</a>
            
        </div>
    </div>
    
</div>