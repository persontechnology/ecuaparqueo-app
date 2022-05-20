
@if (Storage::exists($foto))
    <a href="{{ Storage::url($foto) }}">
        <img src="{{ Storage::url($foto) }}" class="img-fluid" width="30" height="40" alt="">
    </a>
@endif