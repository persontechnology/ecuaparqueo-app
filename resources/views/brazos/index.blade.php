@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderoListarBrazos', $parqueadero))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">
        <a href="" class="breadcrumb-elements-item" data-toggle="modal" data-target="#modalBrazos">
            Nuevo Brazo
            <i class="fa-solid fa-building ml-1"></i>
        </a>
    </div>
@endsection
@section('content')

    @livewire('brazos.index', ['parqueadero' => $parqueadero], key($parqueadero->id))


    @push('linksCabeza')
        <script src="{{ asset('global_assets/js/plugins/buttons/spin.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/plugins/buttons/ladda.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/demo_pages/components_buttons.js') }}"></script>
    @endpush

    @prepend('linksPie')
   
    @endprepend

@endsection
