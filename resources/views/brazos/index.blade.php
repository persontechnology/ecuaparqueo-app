@extends('layouts.app')
{{-- @section('breadcrumbs', Breadcrumbs::render('parqueaderosListarBrazos', $parqueadero)) --}}


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
