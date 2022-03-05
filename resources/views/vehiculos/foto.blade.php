@if (Storage::exists($vehiculo->foto))
    <a href="{{ Storage::url($vehiculo->foto) }}">
        <img src="{{ Storage::url($vehiculo->foto) }}" class="rounded-circle" width="40" height="40" alt="">
    </a>
@endif