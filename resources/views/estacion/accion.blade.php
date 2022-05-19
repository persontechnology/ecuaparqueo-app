
<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left">
            <a href="{{ route('estacion.edit',$es->id) }}" class="dropdown-item"><i class="fa-solid fa-user-pen text-primary"></i> Editar</a>
            <a href="#" onclick="event.preventDefault();eliminarR(this);" data-url="{{ route('estacion.destroy',$es->id) }}" data-msg="Está seguro de eliminar {{ $es->nombre }}!" class="dropdown-item"><i class="fa-solid fa-trash text-danger"></i> Eliminar</a>
        </div>
    </div>
</div>