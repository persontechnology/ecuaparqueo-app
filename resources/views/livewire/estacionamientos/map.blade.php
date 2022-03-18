<div>
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              
                <div class="card" id="draggable-default-container">
                    <input type="text" wire:model="lat">
                    <input type="text" wire:model="lon">
                    <div class="card-body">
                        <div wire:ignore id="map"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>

@prepend('linksPie')
    <script>
        var map;
        var marker;

        function initMap() {
            var myLatLng = {
                lat: -2.282374,
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
