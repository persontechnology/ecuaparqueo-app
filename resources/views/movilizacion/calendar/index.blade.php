@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacion'))

@section('secondarySidebar')
    @livewire('orden-movilizacion.vehiculo')
    {{-- <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label for="parqueadero">Selecione parqueadero:</label>
                <select name="parqueadero" id="parqueadero" class="form-control" onchange="cargarVehiculos(this)">
                    @foreach ($parqueaderos as $par)
                        <option value="{{ $par->id }}" {{ old('idParqueadero')==$par->id?'selected':'' }} >{{ $par->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card-body">
            <ul class="media-list media-list-bordered" id="external-events">
                <div id="external-events-list">
                </div>
            </ul>
        </div>
    </div> --}}
@endsection



@section('barraLateral')
<div class="breadcrumb justify-content-center">
    <h1 class="text-danger"><strong id="numeroSiguenteOrdenMovilizacion">{{ $numero }}</strong></h1>
</div>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger border-0 alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    <button type="button" class="btn btn-danger btn-block " data-toggle="modal" data-target="#modal_full">Correguir errores <i class="fa-solid fa-pen-to-square"></i></button>
</div>

@endif



<div class="card card-body table-responsive">
    <div class="container mb-1 text-right">
        <span class="badge badge-primary">SOLICITADO</span>
        <span class="badge badge-secondary">DENEGADA</span>
        <span class="badge badge-success">ACEPTADA</span>
        <span class="badge badge-danger">OCUPADO</span>
        <span class="badge badge-warning">FINALIZADO</span>
        
    </div>
    <div id='calendar'></div>
</div>
    

    <!-- Full width modal -->
    <div id="modal_full" class="modal fade" tabindex="-1">
        <form action="{{ route('odernMovilizacionGuardar') }}" id="formOrdenMovilizacion" method="POST" autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title">ORDEN MOVILIZACIÓN <strong class="text-danger text-right" id="numero_orden_movilizacion">{{ $numero }}</strong></h1>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            
                        <div class="modal-body">

                            <input type="hidden" type="text" id="accionForm">
                            <input type="hidden" type="text" id="idEventoCalendar" name="id_orden_parqueadero" value="{{ old('id_orden_parqueadero') }}">
                            <input type="hidden" type="text" id="idParqueadero" name="idParqueadero" value="{{ old('idParqueadero') }}">
                            
                            <div class="form-group">
                                <label for="fecha_salida">Fecha y hora de salida:</label>
                                    
                                <div class='input-group' id='datetimepicker1' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                    
                                    <input id='fecha_salida' onkeydown="event.preventDefault()" name="fecha_salida" type='text' class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida')}}" data-td-target='#datetimepicker1'/>
                                    <span class='input-group-append' data-td-target='#datetimepicker1' data-td-toggle='datetimepicker'>
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </span>
                                    @error('fecha_salida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror    
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label  for="marcaVehiculo">Marca y N° de Vehículo</label>
                                <div class="input-group">
                                    
                                    <input type="hidden" name="vehiculo" id="vehiculo" value="{{ old('vehiculo') }}" required>
                                    <input type="text" onkeydown="event.preventDefault()" name="marcaVehiculo" value="{{ old('marcaVehiculo') }}" class="form-control @error('vehiculo') is-invalid @enderror" id="marcaVehiculo" placeholder="Vehículo sin selecionar.!" required>
                                    
                                    @error('vehiculo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label  for="servidor_publico">Servidor Público:</label>
                                <input type="text" class="form-control @error('servidor_publico') is-invalid @enderror" name="servidor_publico" value="{{ old('servidor_publico') }}" id="servidor_publico" required>
                                @error('servidor_publico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" id="direccion" required>
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lugar_comision">Lugar de Comisión:</label>
                                <input type="text" class="form-control @error('lugar_comision') is-invalid @enderror" name="lugar_comision" id="lugar_comision" value="{{ old('lugar_comision') }}" required >
                                @error('lugar_comision')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="motivo">Motivo:</label>
                                <input type="text" class="form-control @error('motivo') is-invalid @enderror" name="motivo" id="motivo" value="{{ old('motivo') }}" required>
                                @error('motivo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="fecha_retorno">Fecha y hora de retorno:</label>
                                    
                                <div class='input-group' id='datetimepicker2' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                    <input id='fecha_retorno' onkeydown="event.preventDefault()" name="fecha_retorno" type='text' class="form-control @error('fecha_retorno') is-invalid @enderror" value="{{ old('fecha_retorno')}}" data-td-target='#datetimepicker2'/>
                                    <span class='input-group-append' data-td-target='#datetimepicker2' data-td-toggle='datetimepicker'>
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </span>
                                </div>
                                @error('fecha_retorno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="modal-footer pt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" onclick="eliminar(this)" data-msg="" class="btn btn-warning" data-id="" data-url="{{ route('odernMovilizacionEliminar') }}" id="buttonEliminar" style="display: none;">Eliminar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            
                        </div>
                    

                </div>
            </div>
        </form>
    </div>
    <!-- /full width modal -->

@push('linksCabeza')
    {{-- selct 2 --}}
    <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
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


    @if ($errors->any())
        $('#modal_full').modal('show');
    @endif

    

    function generateStringRamdon(length) {
        const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = ' ';
        const charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        return result;
    }


    // fechas inicializacion
    const picker= new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'),{
        display: {
            buttons:{
                close:true,
            },
        },
        hooks:{
            inputFormat:(context, date) => { return moment(date).format('YYYY/MM/DD HH:mm') }
        }
    });
    const picker2= new tempusDominus.TempusDominus(document.getElementById('datetimepicker2'),{
        display: {
            buttons:{
                close:true,
            },
        },
        hooks:{
            inputFormat:(context, date) => { return moment(date).format('YYYY/MM/DD HH:mm') }
        }
    });


    // calendar
    if($('#external-events-list').html()){
        var containerEl = document.getElementById('external-events-list');
            new FullCalendar.Draggable(containerEl, {
            itemSelector: '.media',
            eventData: function(eventEl) {
                return {
                    title: $(eventEl).data('placa'),
                    'id':generateStringRamdon(100),
                }
            }
        });
    }
   

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
        scrollTime:"07:00:00",
        select: function(arg) {
           
            calendar.unselect()
        },
        eventClick: function(arg) {
            var id=arg.event.id;
            $.post( "{{ route('odernMovilizacionObtener') }}", { id:id })
            .done(function( data ) {
                actualizarOrdenMovilizacion(arg,data);
            });
        },
        
        eventDrop: function(arg) {
            var id=arg.event.id;
            $.post( "{{ route('odernMovilizacionObtener') }}", { id:id })
            .done(function( data ) {
                actualizarOrdenMovilizacion(arg,data);
            });
        },
        eventReceive:function(event,relatedEvents,revert,draggedEl,view){
            guardarOrdenMovilizacion(event)
        },
        eventResize: function(arg) {
            var id=arg.event.id;
            $.post( "{{ route('odernMovilizacionObtener') }}", { id:id })
            .done(function( data ) {
                actualizarOrdenMovilizacion(arg,data);
            });
        },
        
        events: [
            @foreach ($ordenesMovilizaciones as $ordenM)
            {
                id:'{{ $ordenM->id }}',
                title: 'Orden: {{ $ordenM->numero }}       Vehículo:{{ $ordenM->vehiculo->placa }}',
                start: '{{ $ordenM->fecha_salida }}',
                end:'{{ $ordenM->fecha_retorno }}',
                image_url:'{{ Storage::url($ordenM->vehiculo->foto) }}',
                classNames:'{{ $ordenM->color_estado }}',
                image_url: '{{ Storage::exists($ordenM->vehiculo->foto)?Storage::url($ordenM->vehiculo->foto):'' }}',
                
            },
            @endforeach
        ],
        eventContent: function(arg) {
                let arrayOfDomNodes = []
                // title event
                let titleEvent = document.createElement('div')
                if(arg.event._def.title) {
                  titleEvent.innerHTML = arg.event._def.title
                  titleEvent.classList = "fc-event-title fc-sticky"
                }
    
                // image event
                let imgEventWrap = document.createElement('div')
                if(arg.event.extendedProps.image_url) {
                  let imgEvent = '<img src="'+arg.event.extendedProps.image_url+'" class="img-flag" >'
                  imgEventWrap.classList = "fc-event-img"
                  imgEventWrap.innerHTML = imgEvent;
                }
    
                arrayOfDomNodes = [ titleEvent,imgEventWrap ]
    
                return { domNodes: arrayOfDomNodes }
              }
    });

    

    

    // funcion guardar actualizar orden de movilizacion
    function guardarOrdenMovilizacion(event){
        picker.dates.set(event.event.start);
        var newDateObj = moment(event.event.start).add(15, 'm').toDate();
        if(event.event.allDay){
            newDateObj = moment(event.event.start).add(12, 'h').toDate();
        }
        picker2.dates.set(newDateObj);
        $('#accionForm').val('nuevoOrden');
        $('#idEventoCalendar').val(event.event.id);
        $('#modal_full').modal('show');
        $('#vehiculo').val($(event.draggedEl).data('id'));
        $('#marcaVehiculo').val($(event.draggedEl).data('placa'));
        $('#numero_orden_movilizacion').html($('#numeroSiguenteOrdenMovilizacion').html());
    }
    
    // funcion guardar
    function actualizarOrdenMovilizacion(event,data){
        
        picker.dates.set(event.event.start);
        var newDateObj =event.event.end?event.event.end:event.event.start;
        if(event.event.allDay){
            newDateObj = moment(event.event.start).add(12, 'h').toDate();
        }

        picker2.dates.set(newDateObj);
        $('#accionForm').val('editarOrden');
        $('#idEventoCalendar').val(data.id);
        $('#modal_full').modal('show');
        $('#vehiculo').val(data.vehiculo.id);
        $('#marcaVehiculo').val(data.vehiculo.placa+"-"+data.vehiculo.numero_chasis);
        $('#servidor_publico').val(data.servidor_publico);
        $('#direccion').val(data.direccion);
        $('#lugar_comision').val(data.lugar_comision);
        $('#motivo').val(data.motivo);
        $('#numero_orden_movilizacion').html(data.numero);
        $('#formOrdenMovilizacion').attr("action","{{ route('odernMovilizacionActualizar') }}");
        $('#buttonEliminar').attr('data-id',data.id).attr('data-msg',"Está seguro de eliminar Orden de Movilización "+data.numero).show();

    }


    $('#modal_full').on('hidden.bs.modal', function (event) {
        if($('#accionForm').val()==='nuevoOrden'){
            var eventCalendar = calendar.getEventById($('#idEventoCalendar').val());
            eventCalendar.remove();
        }

        $('#formOrdenMovilizacion').attr("action","{{ route('odernMovilizacionGuardar') }}");
        $('#idEventoCalendar').val('');
        $('#vehiculo').val('');
        $('#marcaVehiculo').val('');
        $('#servidor_publico').val('');
        $('#direccion').val('');
        $('#lugar_comision').val('');
        $('#motivo').val('');
        $('#numero_orden_movilizacion').html('');
        $('#buttonEliminar').attr('data-id','').attr('data-msg','').hide();
    })
    calendar.render();

</script>
@endprepend
    
    
@endsection
