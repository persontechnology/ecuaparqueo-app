@if (Storage::exists($user->foto))
    <a href="{{ Storage::url($user->foto) }}">
        <img src="{{ Storage::url($user->foto) }}" class="rounded-circle" width="40" height="40" alt="">
    </a>
@endif