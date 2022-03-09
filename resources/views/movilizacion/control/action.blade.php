<div class="custom-control custom-switch custom-control-success mb-2">
    <input type="checkbox" data-id="{{ $orden->id }}" data-url="{{ route('controlOdernMovilizacionEstado') }}" onchange="cambiarEstado(this);" class="custom-control-input" id="sc_r_success-{{ $orden->id }}" {{ $orden->estado=='ACEPTADA'?'checked':'' }}>
    <label class="custom-control-label" for="sc_r_success-{{ $orden->id }}">{{ $orden->estado}}</label><br>
    <small>Por: 
    @switch($orden->estado)
        @case('ESPERA')
            {{ $orden->usuarioCreado->apellidos??'' }} {{ $orden->usuarioCreado->nombres??'' }}
            @break
        @case('ACEPTADA')
            {{ $orden->usuarioAceptado->apellidos??'' }} {{ $orden->usuarioAceptado->nombres??'' }}
            @break
        @case('DENEGADA')
        {{ $orden->usuarioDenegado->apellidos??'' }} {{ $orden->usuarioDenegado->nombres??'' }}
        @break
            
    @endswitch
    </small>
</div>