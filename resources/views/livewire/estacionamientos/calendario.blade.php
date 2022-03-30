<div>
    <div class="d-flex align-items-center ">
        <div class="card-body">
            <div class="d-sm-flex pb-3">
                <div class="flex-grow-1 mb-3 mb-sm-0">
                    <div style="padding:1px;"
                        class="card-body  d-lg-flex align-items-lg-center justify-content-lg-between flex-lg-wrap">
                        <div class="d-flex align-items-center ">
                            <div id="tickets-status">
                                @if (Storage::exists($vehiculo->foto ?? ''))
                                    <a data-toggle="tooltip" data-placement="bottom"
                                        title="{{ $vehiculo->kilometraje->numero ?? '' }}"
                                        href="{{ Storage::url($vehiculo->foto ?? '') }}">
                                        <img src="{{ Storage::url($vehiculo->foto ?? '') }}" class="rounded-circle"
                                            width="50" height="50" alt="">
                                    </a>
                                @else
                                    <i id="icon" class="icon-car"></i>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold "> {{ $vehiculo->placa ?? '' }}</h5>
                                <span class="badge badge-mark border-success mr-1"></span> <span
                                    class="text-muted">{{ $vehiculo->tipoVehiculo->nombre ?? '' }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group-feedback form-group-feedback-left ">
                    <input type="search" wire:model="search" class="form-control form-control-lg" name="placa" value=""
                        placeholder="Buscar orden">
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>

                <div class="ml-sm-3">
                    <select name="estados" wire:model="estadoParqueadero"
                        class="custom-select custom-select-lg wmin-sm-200 mb-3 mb-sm-0">
                        <option value="">Todos Estados</option>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>

            </div>
            <div class="card row">

                <div class="card-body" id='calendar-container' wire:ignore>
                    <div class="col-sm-12" id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        var contt = 0;
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');
        var data = @this.Ordenes;
        var calendar = new Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
            },

            // timeZone: 'local',
            initialView: 'dayGridMonth',
            events: JSON.parse(data),
            locale: 'es',
            editable: true,
            selectable: true,
            displayEventTime: false,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            datesSet: function(arg) {
                if (contt === 1) {
                    calendar.removeAllEvents();
                    debugger;
                    var ff = @this.actualizarDate(moment(arg.start).format('yyyy-MM-DD HH:mm'),
                        moment(arg
                            .end)
                        .format('yyyy-MM-DD HH:mm'));
                    ff.then(function(result) {
                        var arrayResult = (JSON.parse(result))
                        if (arrayResult?.length > 0) {
                            arrayResult.forEach(element => {
                                calendar.addEvent(element);
                            });
                        }
                    });
                }
                contt = 1;
            },

        });
        calendar.render();

    });

</script>
