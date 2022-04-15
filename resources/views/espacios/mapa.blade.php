@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('espaciosVerVehiculoMapa',$espacio))



@section('content')
    <div class="card" id="draggable-default-container">
        <div class="card-body">
            <div id="map"></div>
        </div>
    </div>

@prepend('linksPie')
    <script>
        var map;
        var marker;

        function initMap() {
            var myLatLng = {
                lat: {{ $lat ?? -2.282374 }},
                lng: {{ $lon ?? -78.122086999999993 }}
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
                title: "Ubicación",
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
            height: 650px;
            width: auto;
        }
    </style>
@endprepend

@endsection
