<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left">
            
            <a href="{{ route('espacios', $parqueadero->id) }}" class="dropdown-item">
                <i class="icon-road text-pink"></i>
                Espacios
            </a>
            <a href="{{ route('parqueaderosListarBrazos', $parqueadero->id) }}" class="dropdown-item">
                <i class=" icon-enter3 text-info"></i>
                Brazos
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('parqueaderosEditar', ['id' => $parqueadero->id]) }}" class="dropdown-item">
                <i class="fa-solid fa-user-pen text-primary">
                </i> Editar
            </a>
            <a href="#" onclick="event.preventDefault();eliminar(this);" data-id="{{ $parqueadero->id }}"
                data-url="{{ route('parqueaderosEliminar') }}"
                data-msg="Está seguro de eliminar {{ $parqueadero->nombre }}!" class="dropdown-item">
                <i class="fa-solid fa-trash text-danger"></i>
                Eliminar
            </a>
            
        </div>
    </div>
</div>
