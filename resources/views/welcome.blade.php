@extends('layouts.app')

@section('content')

<!-- Container -->
<div class="flex-fill">

    <!-- Error title -->
    <div class="text-center mb-4">
        <h1 class="display-3 font-weight-semibold line-height-1 mb-2">
            {{ config('app.name','') }}
        </h1>
        <h5>Sistema de parqueo inteligente.</h5>
        <img src="{{ asset('img/appmovil.png') }}" class="img-fluid mb-4" height="230" alt="">
        
        <h5>Descarga nuestra aplicación móvil para android</h5>
    </div>
    <!-- /error title -->


    <!-- Error content -->
    <div class="text-center">
        <a href="{{ asset('apk/app-universal-release-ecuaparqueo.apk') }}" class="btn btn-primary"><i class="icon-download4 mr-2"></i> Descargar</a>
    </div>
    <!-- /error wrapper -->

</div>
<!-- /container -->
@endsection
