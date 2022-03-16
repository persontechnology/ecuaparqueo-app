@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('verVehiculoMapa', $espacio))
@section('content')
    <!-- Simple text stats with icons -->


    <!-- /simple text stats with icons -->
    <div class="card" id="draggable-default-container">
        <div class="card-body">
            <div id="map"></div>
        </div>
    </div>
    <!-- /basic -->
    {{-- modal --}}

    @push('linksCabeza')
    @endpush

    @prepend('linksPie')
        <script>
            var map;
            var marker;

            function initMap() {
                var myLatLng = {
                    lat: -2.282374000000000,
                    lng: -78.122086999999993
                }
                map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: 10,
                    mapTypeId: 'hybrid'
                });
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    draggable: true,
                    position: myLatLng,
                    title: "Oficina CACTU sede Cotopaxi",
                });
                marker.setMap(map);
                marker.addListener('dragend', function() {
                    var destinationLat = marker.getPosition().lat();
                    var destinationLng = marker.getPosition().lng();
                });
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;                

            }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0Ko6qUa0EFuDWr77BpNJOdxD-QLstjBk&callback=initMap">
        </script>

<style type="text/css">
    #map {
      height: 400px;
      width: auto;
    }
  </style>
    @endprepend

@endsection
