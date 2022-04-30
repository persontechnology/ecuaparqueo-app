@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('odernMovilizacion'))

@section('secondarySidebar')
    @livewire('orden-movilizacion.vehiculo')
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
    @include('movilizacion.estados')
    <table class="table">

</table>
    <div id='calendar'></div>
</div>
    

    <!-- Full width modal -->
    <div id="modal_full" class="modal fade" tabindex="-1">
        <form action="{{ route('odernMovilizacionGuardar') }}" id="formOrdenMovilizacion" method="POST" autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable modal-full">
                <div class="modal-content">
                        @csrf
                        <div class="modal-header">
                            {{-- <h1 class="modal-title">ORDEN MOVILIZACIÓN <strong class="text-danger text-right" id="numero_orden_movilizacion">{{ $numero }}</strong></h1> --}}
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            <div class="table-responsive">
                                <table class="text-center table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="col-2 py-0" rowspan="4" id="example1"></td>
                                            <th class="col-6 py-0 text-center" rowspan="4">
                                                <h1>FORMULARIO ORDEN DE MOVILIZACIÓN DENTRO DEL ÁREA DE CONSECIÓN</h1>
                                            </th>
                                            <th class="col-2 py-0">CÓDIGO</th>
                                            <td class="col-2 py-0">{{ $empresa->codigo }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-0">VERSIÓN</th>
                                            <td class="py-0">{{ $empresa->version }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-0">FECHA</th>
                                            <td class="py-0">{{ \Carbon\Carbon::now() }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-0">NORMA</th>
                                            <td class="py-0">{{ $empresa->norma }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            
                        <div class="modal-body">

                            <fieldset>
                                <legend class="font-weight-semibold">
                                    NÚMERO DE ORDEN: <strong class="text-danger text-right" id="numero_orden_movilizacion">{{ $numero }}</strong>
                                </legend>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="fecha_solicitud">Fecha de solicitud:</label>
                                            <input type="text" id="fecha_solicitud" name="fecha_solicitud" readonly onkeydown="event.preventDefault()" value="{{ old('fecha:solictud',Carbon\Carbon::now()) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="fecha_salida">Fecha y hora de salida<i class="text-danger">*</i></label>
                                                
                                            <div class='input-group' id='datetimepicker1' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                                
                                                <input id='fecha_salida' onkeydown="event.preventDefault()" name="fecha_salida" type='text' class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida')}}" data-td-target='#datetimepicker1' required/>
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
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="fecha_retorno">Fecha y hora de retorno<i class="text-danger">*</i></label>
                                                
                                            <div class='input-group' id='datetimepicker2' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                                <input id='fecha_retorno' onkeydown="event.preventDefault()" name="fecha_retorno" type='text' class="form-control @error('fecha_retorno') is-invalid @enderror" value="{{ old('fecha_retorno')}}" data-td-target='#datetimepicker2' required/>
                                                <span class='input-group-append' data-td-target='#datetimepicker2' data-td-toggle='datetimepicker'>
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </span>
                                                @error('fecha_retorno')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label  for="numero_ocupantes">N° ocupantes<i class="text-danger">*</i></label>
                                            <div class="input-group">
                                                <input type="number" name="numero_ocupantes" value="{{ old('numero_ocupantes') }}" class="form-control @error('numero_ocupantes') is-invalid @enderror" id="numero_ocupantes" required autofocus>
                                                @error('numero_ocupantes')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="numeroMovil">N° Movil</label>
                                            <div class="input-group">
                                                
                                                <input type="hidden" name="vehiculo" id="vehiculo" value="{{ old('vehiculo') }}" required>
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="numeroMovil" value="{{ old('numeroMovil') }}" class="form-control @error('vehiculo') is-invalid @enderror" id="numeroMovil" placeholder="Vehículo sin selecionar.!">
                                                
                                                @error('vehiculo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="marca">Marca</label>
                                            <div class="input-group">
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="marca" value="{{ old('marca') }}" class="form-control" id="marca">
                                                @error('marca')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="modelo">Modelo</label>
                                            <div class="input-group">
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="modelo" value="{{ old('modelo') }}" class="form-control @error('modelo') is-invalid @enderror" id="modelo">
                                                @error('modelo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="placa">Placa</label>
                                            <div class="input-group">
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="placa" value="{{ old('placa') }}" class="form-control @error('placa') is-invalid @enderror" id="placa">
                                                @error('placa')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="tipo">Tipo</label>
                                            <div class="input-group">
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="tipo" value="{{ old('tipo') }}" class="form-control" id="tipo">
                                                @error('tipo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label  for="color">Color</label>
                                            <div class="input-group">
                                                <input type="text" readonly onkeydown="event.preventDefault()" name="color" value="{{ old('color') }}" class="form-control @error('color') is-invalid @enderror" id="color">
                                                @error('color')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label  for="procedencia">Procedencia<i class="text-danger">*</i></label>
                                            <div class="input-group">
                                                <input type="text" name="procedencia" value="{{ old('procedencia') }}" class="form-control @error('procedencia') is-invalid @enderror" id="procedencia" required>
                                                @error('procedencia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label  for="destino">Destino<i class="text-danger">*</i></label>
                                            <div class="input-group">
                                                <input type="text" name="destino" value="{{ old('destino') }}" class="form-control @error('destino') is-invalid @enderror" id="destino" required>
                                                @error('destino')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  for="comision_cumplir">Comisión a cumplir<i class="text-danger">*</i></label>
                                    <div class="input-group">
                                        <textarea name="comision_cumplir" class="form-control @error('comision_cumplir') is-invalid @enderror" id="comision_cumplir" required>{{ old('comision_cumplir') }}</textarea>
                                        @error('comision_cumplir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="conductor_info">Datos del conductor</label>
                                            <div class="input-group">
                                                <input type="hidden" name="conductor" id="conductor" value="{{ old('conductor') }}">
                                                <input type="text" data-opcion="conductor" onclick="modalConductorSolicitante(this);" onkeydown="event.preventDefault()" readonly id="conductor_info" name="conductor_info" value="{{ old('conductor_info') }}" data-toggle="modal" data-target="#modal_large" class="form-control @error('conductor') is-invalid @enderror" placeholder="Seleccionar conductor..">
                                                <span class="input-group-append">
                                                    <span data-toggle="modal" data-target="#modal_large" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                </span>
                                            </div>
        
                                            @error('conductor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="solicitante_info">Datos del solicitante</label>
                                            <div class="input-group">
                                                <input type="hidden" name="solicitante" id="solicitante" value="{{ old('solicitante') }}">
                                                <input type="text" data-opcion="solicitante" onclick="modalConductorSolicitante(this);" onkeydown="event.preventDefault()" readonly id="solicitante_info" name="solicitante_info" value="{{ old('solicitante_info') }}"  data-toggle="modal" data-target="#modal_large" class="form-control @error('solicitante') is-invalid @enderror" placeholder="Seleccionar solicitante..">
                                                <span class="input-group-append">
                                                    <span data-toggle="modal" data-target="#modal_large" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                </span>
                                            </div>
        
                                            @error('solicitante')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                

                            </fieldset>

                        
                            <input type="hidden" type="text" id="accionForm">
                            <input type="hidden" type="text" id="idEventoCalendar" name="id_orden_parqueadero" value="{{ old('id_orden_parqueadero') }}">
                            
                            
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



    <!-- Large modal -->
    <div id="modal_large" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalConductorSolicitante"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        {{$dataTable->table()}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="buttonModalConductorSolicitante" onclick="seleccionarConductorSolicitante(this);" data-id="" data-user="" class="btn btn-primary" data-dismiss="modal"></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /large modal -->

    @push('scripts')
        {{$dataTable->scripts()}}
    @endpush

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

    
    @if (Storage::exists($empresa->logo))
        <style>
            #example1 {
                background: url("{{ Storage::url($empresa->logo) }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }    
        </style>
    @endif
    

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
        // scrollTime:"11:30:00",
        // now: today,
        scrollTime: moment().format("HH") + ":00:00",
        
        select: function(arg) {
           
            calendar.unselect()
        },
        eventClick: function(arg) {
            actualizarOrdenMovilizacion(arg);
        },
        
        eventDrop: function(arg) {
            actualizarOrdenMovilizacion(arg);
        },
        eventReceive:function(event,relatedEvents,revert,draggedEl,view){
            guardarOrdenMovilizacion(event)
        },
        eventResize: function(arg) {
            actualizarOrdenMovilizacion(arg);
        },
        
        events: [
            @foreach ($ordenesMovilizaciones as $ordenM)
            {
                id:'{{ $ordenM->id }}',
                title: 'Orden: {{ $ordenM->numero }}       Vehículo:{{ $ordenM->vehiculo->numero_movil_placa }}',
                start: '{{ $ordenM->fecha_salida }}',
                end:'{{ $ordenM->fecha_retorno }}',
                classNames:'bg-{{ $ordenM->color_estado }}',
                
            },
            @endforeach
        ]
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
        $('#modal_full').modal('show');
        
        $('#idEventoCalendar').val(event.event.id);
        $('#vehiculo').val($(event.draggedEl).data('id'));
        $('#numeroMovil').val($(event.draggedEl).data('numeromovil'));
        $('#marca').val($(event.draggedEl).data('marca'));
        $('#modelo').val($(event.draggedEl).data('modelo'));
        $('#placa').val($(event.draggedEl).data('placa'));
        $('#tipo').val($(event.draggedEl).data('tipo'));
        $('#color').val($(event.draggedEl).data('color'));
        $('#conductor').val($(event.draggedEl).data('conductorid'));
        $('#conductor_info').val($(event.draggedEl).data('conductorinfo'));
        
        $('#numero_orden_movilizacion').html($('#numeroSiguenteOrdenMovilizacion').html());
    }
    
    // funcion guardar
    function actualizarOrdenMovilizacion(event){
        
        var id=event.event.id;
        $.post( "{{ route('odernMovilizacionObtener') }}", { id:id })
        .done(function( data ) {
            $('#idEventoCalendar').val(data.id);
            $('#numero_ocupantes').val(data.numero_ocupantes);
            $('#fecha_solicitud').val(moment(data.created_at).format('YYYY/MM/DD HH:mm'));
            $('#vehiculo').val(data.vehiculo.id);
            $('#numeroMovil').val(data.vehiculo.numero_movil);
            $('#marca').val(data.vehiculo.marca);
            $('#modelo').val(data.vehiculo.modelo);
            $('#placa').val(data.vehiculo.placa);
            $('#tipo').val(data.vehiculo.tipo_vehiculo.nombre);
            $('#color').val(data.vehiculo.color);
            $('#procedencia').val(data.procedencia);
            $('#destino').val(data.destino);
            $('#comision_cumplir').val(data.comision_cumplir);
            console.log(data.conductor)
            if(data.conductor){
                $('#conductor').val(data.conductor.id);
                
                if(data.conductor.apellidos!=null && data.conductor.nombres!=null){
                    $('#conductor_info').val(data.conductor.apellidos+" "+data.conductor.nombres);    
                }else{
                    $('#conductor_info').val(data.conductor.email);
                }
            }else{
                $('#conductor').val('');
                $('#conductor_info').val('');    
            }

            if(data.solicitante){
                $('#solicitante').val(data.solicitante.id);
                $('#solicitante_info').val(data.solicitante.apellidos_nombres);    
            }else{
                $('#solicitante').val('');
                $('#solicitante_info').val('');    
            }
            
            
            $('#numero_orden_movilizacion').html(data.numero);
            $('#buttonEliminar').attr('data-id',data.id).attr('data-msg',"Está seguro de eliminar Orden de Movilización "+data.numero).show();
        });

        picker.dates.set(event.event.start);
        var newDateObj =event.event.end?event.event.end:event.event.start;
        if(event.event.allDay){
            newDateObj = moment(event.event.start).add(12, 'h').toDate();
        }

        picker2.dates.set(newDateObj);

        $('#accionForm').val('editarOrden');
        $('#modal_full').modal('show');
        $('#formOrdenMovilizacion').attr("action","{{ route('odernMovilizacionActualizar') }}");
        
    }

    $('#modal_full').on('hidden.bs.modal', function (event) {
        if($('#accionForm').val()==='nuevoOrden'){
            var eventCalendar = calendar.getEventById($('#idEventoCalendar').val());
            eventCalendar.remove();
        }

        $('#formOrdenMovilizacion').attr("action","{{ route('odernMovilizacionGuardar') }}");
        $('#numero_orden_movilizacion').html('');
        $('#buttonEliminar').attr('data-id','').attr('data-msg','').hide();


        $('#idEventoCalendar').val('');
        $('#numero_ocupantes').val('');
        $('#vehiculo').val('');
        $('#numeroMovil').val('');
        $('#marca').val('');
        $('#modelo').val('');
        $('#placa').val('');
        $('#tipo').val('');
        $('#color').val('');
        $('#procedencia').val('');
        $('#destino').val('');
        $('#comision_cumplir').val('');
        $('#conductor').val('');
        $('#conductor_info').val('');
        $('#solicitante').val('');
        $('#solicitante_info').val('');

    })
    calendar.render();


    $('#modal_full').on('shown.bs.modal	', function (e) {
        $('#numero_ocupantes').attr("autofocus","autofocus").focus();
    });


    // seleciona conductor o solicitante
    var conductorOSolictante="";
    function modalConductorSolicitante(arg){
        conductorOSolictante=$(arg).data('opcion');
        switch (conductorOSolictante) {
            case 'conductor':
                $('#tituloModalConductorSolicitante').html('Selecionar conductor');
                $('#buttonModalConductorSolicitante').html('Sin conductor');
                break;
            case 'solicitante':
                $('#tituloModalConductorSolicitante').html('Selecionar solicitante');
                $('#buttonModalConductorSolicitante').html('Sin solicitante');
                break;
        }
    }
    function seleccionarConductorSolicitante(arg){
        switch (conductorOSolictante) {
            case 'conductor':
                $('#conductor').val($(arg).data('id'));
                $('#conductor_info').val($(arg).data('user'));
                break;
        
            case 'solicitante':
                $('#solicitante').val($(arg).data('id'));
                $('#solicitante_info').val($(arg).data('user'));
                break;
        }

        $('#modal_large').modal('hide');
    }


</script>
@endprepend
    
    
@endsection
