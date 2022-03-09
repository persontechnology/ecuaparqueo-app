@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('parqueaderos'))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">
        <a href="{{ route('parqueaderoNuevo') }}" class="breadcrumb-elements-item">
            Nuevo Espacio <i class="fa-solid fa-building ml-1"></i>
        </a>
    </div>

@endsection
@section('content')
    <div class="text-right mb-1">
        <button class="btn btn-info" id="btn-update" onclick="bbuu();">ACTUALIZAR</button>
    </div>
    <div class="card" id="draggable-default-container"
        style="overflow:scroll;height:1000px;border:1px solid rgb(218, 213, 213);background-color:lightblue; position: inherit;">

        <div class="card-body">
            <div class="d-flex justify-content-center flex-column flex-sm-row">
                <div class="jqueryui-demo-element text-center  rounded-pill" id="draggable-revert-clone">
                    <span>Agregar</span>
                </div>
                @if (count($espacios) > 0)

                    @foreach ($espacios as $estableciento)
                        <div  id="item-{!! json_encode($estableciento->id) !!}-establecimiento" class=" draggable-element text-center rounded-pill"
                            style="position: relative; left:{{ $estableciento->left }}px; top: {{ $estableciento->top }}px;">

                            <div class="card text-center">
                                <div class="card-body ">
                                    <div class="media">
                                        <div class=" mr-2">
                                            <i id="icon" class="icon-car"></i>
                                            <br>
                                            <span
                                                class="badge badge-flat border-success text-success rounded-0">Activo</span>
                                            <span style="padding: .7125rem .8375rem;"
                                                class="position-absolute top-0 left-50 start-100 translate-middle badge rounded-pill bg-danger">{{ $estableciento->numero }}</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-title font-weight-semibold">XSDSFS</div>
                                            <div><span class="text-muted">Fabian Lopez</span></div>
                                            <div class="list-icons">
                                                <span class="list-icons-item"> <i class="text-muted icon-road"></i>
                                                    10000km</span>
                                                <span class="list-icons-item"><i class="text-muted icon-gas "></i>
                                                    50%</span>
                                            </div>
                                        </div>

                                        <div class="ml-1">
                                            <div class="list-icons position-static">
                                                <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-center" style="">
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-comment-discussion"></i>
                                                        Start
                                                        chat</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a
                                                        call</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-comment-discussion"></i>
                                                        Start
                                                        chat</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-phone2"></i> Make a
                                                        call</a>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- /basic -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                setListaEstablecimientos({!! json_encode($espacios) !!})
            });
        </script>
        <script src="{{ asset('js/parqueadero/estacionamiento/index.js') }}"></script>
    @endpush
@endsection
