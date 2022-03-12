<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left">
            <a href="{{ route('parqueaderoEditar', ['id' => $parqueadero->id]) }}" class="dropdown-item">
                <i class="fa-solid fa-user-pen text-primary">
                </i> Editar
            </a>
            <a href="#" onclick="event.preventDefault();eliminar(this);" data-id="{{ $parqueadero->id }}"
                data-url="{{ route('departamentosEliminar') }}"
                data-msg="Está seguro de eliminar {{ $parqueadero->nombre }}!" class="dropdown-item">
                <i class="fa-solid fa-trash text-danger"></i>
                Eliminar
            </a>
            <a href="{{ route('parqueaderosListaEspacios', $parqueadero->id) }}" class="dropdown-item">
                <i class="icon-road text-pink"></i>
                Estacionamientos
            </a>
        </div>
    </div>
</div>
