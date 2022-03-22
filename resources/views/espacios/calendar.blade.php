@section('content')
    @livewire('estacionamientos.calendario',['vehiculo'=>$espacio->vehiculo])
    @push('scripts')
    @endpush

    @push('linksCabeza')
        {{-- calendar --}}
        <link href='{{ asset('js/fullcalendar-5.10.2/lib/main.min.css') }}' rel='stylesheet' />
        <script src='{{ asset('js/fullcalendar-5.10.2/lib/main.min.js') }}'></script>
        <script src="{{ asset('js/fullcalendar-5.10.2/lib/locales/es.js') }}"></script>

        <!-- Popperjs -->
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!-- Tempus Dominus JavaScript -->
        <script src="{{ asset('js/tempus-dominus/dist/js/tempus-dominus.js') }}"></script>

        <!-- Tempus Dominus Styles -->
        <link rel="stylesheet" href="{{ asset('js/tempus-dominus/dist/css/tempus-dominus.css') }}">
        <script src="{{ asset('js/monent.js') }}"></script>
    @endpush

    @prepend('linksPie')
    @endprepend
@endsection
