
<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left">
            <a href="{{ route('odernMovilizacionEditar',['id'=>$orden->id ]) }}" class="dropdown-item"><i class="fa-solid fa-pen-to-square text-primary"></i> Editar</a>
            <a href="#" onclick="event.preventDefault();eliminar(this);" data-id="{{ $orden->id }}" data-url="{{ route('odernMovilizacionEliminar') }}" data-msg="Está seguro de eliminar orden N° {{ $orden->numero }}!" class="dropdown-item"><i class="fa-solid fa-trash text-danger"></i> Eliminar</a>
            <a href="#" class="dropdown-item"><i class="fa-solid fa-file-pdf"></i> PDF</a>
        </div>
    </div>
</div>