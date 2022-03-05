<div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Acerca de
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; {{ date('Y') }} <a href="{{ route('welcome') }}">{{ config('app.name','ECUAPARQUEO') }}</a> by <a href="https://PERSONTECHNOLOGY" target="_blank">Person Technology</a>
        </span>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item"><a href="{{ route('welcome') }}" class="navbar-nav-link"><i class="icon-lifebuoy mr-2"></i> Soporte</a></li>
            <li class="nav-item"><a href="{{ route('welcome') }}" class="navbar-nav-link"><i class="icon-file-text2 mr-2"></i> Documentación</a></li>
            <li class="nav-item"><a href="{{ route('welcome') }}" class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i class="icon-cart2 mr-2"></i> Comprar</span></a></li>
        </ul>
    </div>
</div>