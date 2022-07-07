@extends('layouts.app')

@section('content')
@if ($lecturasInvitado->count()>0)
    <div class="timeline timeline-center">
        <div class="timeline-container">
            @foreach ($lecturasInvitado as $le)
                <div class="timeline-row timeline-row-{{ $le->tipo==='Salida'?'left':'right' }}">
                    <div class="timeline-icon">
                        <div class="bg-{{ $le->tipo==='Salida'?'danger':'success' }} text-white">
                            <i class="fa-solid fa-{{ $le->tipo==='Salida'?'right':'left' }}-long"></i>
                        </div>
                    </div>

                    <div class="timeline-time">
                        {{ $le->created_at }}
                        <div class="text-muted">{{ $le->created_at->diffForHumans() }}</div>
                    </div>

                    <div class="card border-left-3 border-left-{{ $le->tipo==='Salida'?'danger':'success' }} rounded-left-0">
                        <div class="card-body">
                            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                <div>
                                    <h6 class="font-weight-semibold">
                                        Conductor: {{ $le->chofer->apellidos_nombres??'' }}
                                    </h6>
                                    <ul class="list list-unstyled mb-0">
                                        <li>N° móvil: {{ $le->vehiculo->numero_movil??'' }}</li>
                                        <li>Placa: <span class="font-weight-semibold">{{ $le->vehiculo->placa??'' }}</span></li>
                                        <li>{{ $le->proceso_orden_movilizacion }}</li>
                                        
                                    </ul>
                                </div>

                                <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
                                    
                                    <ul class="list list-unstyled mb-0">
                                        <li>Brazo: <span class="font-weight-semibold">{{ $le->brazo->codigo }}</span></li>
                                        <li class="dropdown">
                                            Tipo: <span class="badge badge-{{ $le->tipo==='Salida'?'danger':'success' }}">{{ $le->tipo }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        @if ($le->guardia)
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                <span>
                                    <span class="badge badge-mark border-danger mr-2"></span>
                                    Finalizado por:
                                    <span class="font-weight-semibold">{{ $le->guardia->apellidos_nombres??'' }}</span>
                                    a las {{ $le->updated_at }}
                                </span>
                            </div>
                        @endif
                        

                    </div>
                </div>    
            @endforeach
        </div>
    </div>

    
    <div class="card card-footer bg-white">
        {{ $lecturasInvitado->links() }}
    </div>    
    
    
@else
    @include('layouts.alert',['type'=>'info','msg'=>'No existe lecturas'])
@endif

@endsection
