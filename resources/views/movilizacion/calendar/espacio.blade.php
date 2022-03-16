
    @foreach ($espacios as $esp)
        <li class="media" style="cursor: move;" data-id="{{ $esp->id }}" data-placa="{{ $esp->vehiculo->placa }}-{{ $esp->vehiculo->numero_chasis }}">
            
            @if (Storage::exists($esp->vehiculo->foto))
            <div class="mr-3">
                <a href="{{ Storage::url($esp->vehiculo->foto) }}">
                    <img src="{{ Storage::url($esp->vehiculo->foto) }}" class="rounded-circle" width="40" height="40" alt="">
                </a>
            </div>
            @endif
            

            <div class="media-body">
                <div class="media-title font-weight-semibold"><small>Placa: </small>{{ $esp->vehiculo->placa }}</div>
                
                <small>N°: {{ $esp->numero }}</small>
            </div>

            <div class="ml-3">
                Tipo: <strong>{{ $esp->vehiculo->tipoVehiculo->nombre }}</strong> <br>
                <span class="badge badge-{{ $esp->vehiculo->estado=='Activo'?'success':'warning' }} badge-pill">
                    {{ $esp->vehiculo->estado }}
                </span>
            </div>
            
        </li>
    @endforeach
