@extends('layouts.full')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacion'))
@section('content')

<div class="card card-body">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="parqueadero">Selecione parqueadero:</label>
                <select name="parqueadero" id="parqueadero" class="form-control" onchange="cargarVehiculos(this)">
                    @foreach ($parqueaderos as $par)
                        <option value="{{ $par->id }}">{{ $par->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div id="external-events">
                <div id='external-events-list'>
                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                        <div class='fc-event-main'>
                            XVA-0458
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-8">
            <div id='calendar'></div>
        </div>
    </div>
    
</div>
@push('scripts')
    <link href='{{ asset('js/fullcalendar-5.10.2/lib/main.min.css') }}' rel='stylesheet' />
    <script src='{{ asset('js/fullcalendar-5.10.2/lib/main.min.js') }}'></script>
    <script src="{{ asset('js/fullcalendar-5.10.2/lib/locales/es.js') }}"></script>


    

    <script>

        document.addEventListener('DOMContentLoaded', function() {

            var containerEl = document.getElementById('external-events-list');
            new FullCalendar.Draggable(containerEl, {
            itemSelector: '.fc-event',
            eventData: function(eventEl) {
                return {
                title: eventEl.innerText.trim()
                }
            }
            });


          var calendarEl = document.getElementById('calendar');
      
          var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
              left: 'prevYear,prev,next,nextYear today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
            },

            timeZone: 'local',
            initialView: 'timeGridDay',
            locale: 'es',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
            select: function(arg) {
                console.log(arg.start)
                console.log(arg.end)
                calendar.unselect()
            },
            events: [
              {
                title: 'All Day Event',
                start: '2022-03-01'
              },
              {
                title: 'Long Event',
                start: '2022-03-07',
                end: '2022-03-10'
              },
              {
                groupId: 999,
                title: 'Repeating Event',
                start: '2022-03-09T16:00:00'
              },
              {
                groupId: 999,
                title: 'Repeating Event',
                start: '2022-03-16T16:00:00'
              },
              {
                title: 'Conference',
                start: '2022-03-11',
                end: '2022-03-13'
              },
              {
                title: 'Meeting',
                start: '2022-03-12T10:30:00',
                end: '2022-03-12T12:30:00'
              },
              {
                title: 'Lunch',
                start: '2022-03-12T12:00:00'
              },
              {
                title: 'Meeting',
                start: '2022-03-12T14:30:00'
              },
              {
                title: 'Happy Hour',
                start: '2022-03-12T17:30:00'
              },
              {
                title: 'Dinner',
                start: '2022-03-12T20:00:00'
              },
              {
                title: 'Birthday Party',
                start: '2022-03-13T07:00:00'
              },
              {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2022-03-28'
              }
            ]
          });
      
          calendar.render();
          
        });
      
    </script>
    <style>
        #external-events {
            /* position: fixed;
            left: 20px;
            top: 20px;
            width: 150px; */
            padding: 0 10px;
            border: 1px solid #ccc;
            background: #eee;
            text-align: left;
        }

       

        #external-events .fc-event {
            margin: 3px 0;
            cursor: move;
        }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
        }

    </style>
@endpush

<script>
    var parqueadero=$("#parqueadero option:first").val();
    function cargarVehiculos(arg){
        console.log(arg)
    }
</script>

@endsection
