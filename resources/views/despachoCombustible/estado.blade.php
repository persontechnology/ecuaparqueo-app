@switch($estado)
    @case('Autorizado')
        <span class="badge badge-primary">{{ $estado }}</span>
        @break
    @case('Anulado')
        <span class="badge badge-danger">{{ $estado }}</span>
        @break
    @case('Despachado')
        <span class="badge badge-success">{{ $estado }}</span>
        @break
@endswitch