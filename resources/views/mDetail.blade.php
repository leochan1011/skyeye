@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                
            <div class="card">
                <div class="card-header">
                    Mission Detail
                </div>
                <div class="card-body">
                    Mission Name: {{ $mDetail->MNAME}} <br>
                    Started Time: {{ $mDetail->MStartTime}} <br>
                    Location Name: {{ $mDetail->MLocationName}} <br>
                    Center Latitude: {{ $mDetail->CenterLat}}<br>
                    Center Longitude: {{ $mDetail->CenterLng}}<br>
                    Finished Time: {{ $mDetail->MEndTime}}<br>
                    Range: {{$mDetail->MRange}}<br>
                    Altitude: {{$mDetail->MAltitude}}
                </div>
            </div>
            
        </div>
    </div>
</div>
 <!-- Google map -->
 <div class="mw-100">
                
    <div id="map-canvas" style="height: 550px; width: 100%; position: relative; overflow: hidden;"></div>
    
</div>
@endsection

<!-- <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
-->

<!-- 
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly"></script>
<script defer>
    function initMap() {
        var mapOptions = {
            zoom: 15,
            minZoom: 6,
            maxZoom: 20,
            zoomControl:true,
            zoomControlOptions: {
                style:google.maps.ZoomControlStyle.DEFAULT
            },
            center: new google.maps.LatLng({{ $mDetail->CenterLat }}, {{ $mDetail->CenterLng }}),
            mapTypeId: "satellite",
            scrollwheel: false,
            panControl:false,
            mapTypeControl:false,
            scaleControl:false,
            overviewMapControl:false,
            rotateControl:false
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var image = new google.maps.MarkerImage( null, null, null, new google.maps.Size(40,52));

        
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng({{ $mDetail->CenterLat }}, {{ $mDetail->CenterLng }}),
            icon:image,
            map: map,
            //title: place.name
        });
        // displays a 45° view
        map.setTilt(45);
        
    }
    
    google.maps.event.addDomListener(window, 'load', initMap);

    
</script>
-->



<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly"
    async
></script>
<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById("map-canvas"), {
    center: { lat: {{ $mDetail->CenterLat }}, lng: {{ $mDetail->CenterLng }} },
    zoom: 15,
    mapTypeId: "satellite",
    });
    map.setTilt(45);
    
    var image = new google.maps.MarkerImage( null, null, null, new google.maps.Size(40,52));   
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng({{ $mDetail->CenterLat }}, {{ $mDetail->CenterLng }}),
        icon:image,
        map: map,
        //title: place.name
    });
}
</script>

