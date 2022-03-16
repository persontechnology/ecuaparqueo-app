@section('content')
    <div id='calendar'></div>

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
        <script>
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                },

                // timeZone: 'local',
                initialView: 'timeGridDay',
                slotDuration: '00:15:00',
                defaultTimedEventDuration: '00:15:00',
                locale: 'es',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true,
                selectMirror: true,
                droppable: true,
                select: function(arg) {
                    console.log(arg)
                    console.log(arg.end)
                    calendar.unselect()
                },
                eventClick: function(arg) {
                    // if (confirm('Está seguro de eliminar ordén')) {
                    //     arg.event.remove()
                    // }
                    // console.log(arg.event)
                },

            });

            calendar.render();
        </script>
    @endprepend
@endsection
