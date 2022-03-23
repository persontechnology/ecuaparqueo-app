<div>
    <div wire:ignore.self class="modal fade" id="PagamentoLongModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
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

                        <div class="d-flex align-items-center ">
                            <a class="btn bg-transparent border-indigo text-indigo rounded-pill border-2 btn-icon">
                                <i class="icon-location4"></i>
                            </a>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold ">Latitud</h5>
                                <span id="latitude" class="text-muted">{{ $lat ?? 'Datos no encontrados' }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center ">
                            <a class="btn bg-transparent border-indigo text-indigo rounded-pill border-2 btn-icon">
                                <i class="icon-location4"></i>
                            </a>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold ">Longitud</h5>
                                <span id="longitude" class="text-muted">{{ $lon ?? 'Datos no encontrados' }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="card" id="draggable-default-container">
                    <div class="card-body">
                        <div wire:ignore id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@prepend('linksPie')
    <script>
        function cargarMapa() {
            var latitude = $("#latitude").text();
            var longitude = $("#longitude").text();
            var myLatlng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
            var mapOptions = {
                center: myLatlng,
                zoom: 15,
                mapTypeId: 'hybrid'
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Hello World!'
            });

        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0Ko6qUa0EFuDWr77BpNJOdxD-QLstjBk">
    </script>

    <style type="text/css">
        #map {
            height: 400px;
            width: auto;
        }

    </style>
@endprepend
