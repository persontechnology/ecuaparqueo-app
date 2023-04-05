@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

<style>
  /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
#map {
  height: 100%;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style>
<div id="map"></div>


<script>
  // This example adds a user-editable rectangle to the map.
// When the user changes the bounds of the rectangle,
// an info window pops up displaying the new bounds.
var rectangle;
var map;
var infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -1.0446855920702154, lng: -78.59184179665033 },
    zoom: 9,
  });

  const bounds = {
    north: -1.0213646198838473,
    south: -1.070611275568075,
    east: -78.55972973632811,
    west: -78.61398107910158,
  };

  // Define the rectangle and set its editable property to true.
  rectangle = new google.maps.Rectangle({
    bounds: bounds,
    editable: true,
    draggable: true,
  });
  rectangle.setMap(map);
  // Add an event listener on the rectangle.
  rectangle.addListener("bounds_changed", showNewRect);
  // Define an info window on the map.
  infoWindow = new google.maps.InfoWindow();

  
}

/** Show the new coordinates for the rectangle in an info window. */
function showNewRect() {
  const ne = rectangle.getBounds().getNorthEast();
  const sw = rectangle.getBounds().getSouthWest();
  const contentString =
    "<b>Rectangle moved.</b><br>" +
    "New north-east corner: " +
    ne.lat() +
    ", " +
    ne.lng() +
    "<br>" +
    "New south-west corner: " +
    sw.lat() +
    ", " +
    sw.lng();

  // Set the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(ne);
  infoWindow.open(map);
  
  // comprobar si contiene las coordenadas
  var myLatlng = new google.maps.LatLng(-1.0368242834326094, -78.58399667052988);
  console.log(rectangle.getBounds().contains(myLatlng))

}

window.initMap = initMap;
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDxUyVFlNpM-HwzkAokj9g1I1OOpS4kZI&callback=initMap&v=weekly"
      defer
    ></script>

@endsection
