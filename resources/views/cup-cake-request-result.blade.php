@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                

                <div class="card-body">

                    {{$result_text}}



                </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>

<script  
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&libraries=visualization&language=es"></script>
@endsection



@push('scripts')

<script>
var map;
var var_lat_detect1  ;
var var_lng_detect1  ;
var detect_location='';
var markers = [];

function encontroUbicacion2(position){
	//console.log("Deteccion de ubicacion");

    var_lat_detect1=position.coords.latitude ; 
    var_lng_detect1=position.coords.longitude;   
	
	$("#g_lat").val(var_lat_detect1);
	$("#g_lng").val(var_lng_detect1);
	var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
        
    var my_directionsDisplay = new google.maps.DirectionsRenderer;
        
    map = new google.maps.Map(document.getElementById("map"), {
          zoom: 17,
          center: {lat:var_lat_detect1 ,lng:var_lng_detect1},
styles: [{"featureType":"all","elementType":"all","stylers":[{"hue":"#e7ecf0"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#636c81"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#636c81"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#f1f4f6"}]},{"featureType":"landscape","elementType":"labels.text.fill","stylers":[{"color":"#496271"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-70}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#c6d3dc"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#898e9b"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3eaf8"}]}]
          
        });    
        
        var marker = new google.maps.Marker({
            position: {lat:var_lat_detect1 ,lng:var_lng_detect1},
            map: map,
            draggable: true,
            title: "Ubicacion de Comercio"
          });      
        
        
    marker.addListener("dragend", function() {
        	//console.log("--> LAT:" + this.position.lat()  + ", LNG"+ this.position.lng());                 
        	document.getElementById("g_lat").value = this.position.lat() ;
        	document.getElementById("g_lng").value = this.position.lng();

            
        	 
      
        });
	
        
}

function no_encontroUbicacion2(){		
	encontroUbicacion(null);
 	alert("Ocurrio un problema en su explorador");
}
 
function initMap_Ubicame() {
		navigator.geolocation.getCurrentPosition(encontroUbicacion2, no_encontroUbicacion2);
}

$(function() {    
  initMap_Ubicame();
})       

</script>



    
@endpush