<a href="#"  onclick="event.preventDefault(); seleccionarVehiculo(this);" 
    data-id="{{ $vehiculo->id }}" 
    data-numeromovil="{{ $vehiculo->numero_movil }}" 
    data-marca="{{ $vehiculo->marca }}"
    data-modelo="{{ $vehiculo->modelo }}"
    data-placa="{{ $vehiculo->placa }}"
    data-tipo="{{ $vehiculo->tipoVehiculo->nombre??'' }}"
    data-color="{{ $vehiculo->color }}"
    data-conductorid="{{ $vehiculo->id_conductor }}"
    data-conductorinfo="{{ $vehiculo->conductor->apellidos_nombre??'' }}"
>
    <i class="fa-solid fa-hand-pointer fa-2x"></i>
</a>