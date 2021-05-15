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
                    <b><u>Mission Name:</u></b> {{ $mDetail->MNAME}} <br>
                    <b><u>Location Name:</u></b> {{ $mDetail->MLocationName}} <br>
                    <b><u>Number of drone:</u></b> {{ count($wayp) == 2 ? 2 : 1 }} <br>
                    <b><u>Center Latitude:</u></b> {{ $mDetail->CenterLat}}<br>
                    <b><u>Center Longitude:</u></b> {{ $mDetail->CenterLng}}<br>
                    <b><u>Started Time:</u></b> {{ $mDetail->MStartTime}} <br>
                    <b><u>Finished Time:</u></b> {{ $mDetail->MEndTime}}<br>
                    <b><u>Search Radius(M):</u></b> {{$mDetail->MRange}}<br>
                    <b><u>Flight Altitude(M):</u></b> {{$mDetail->MAltitude}}
                </div>
            </div>
            
        </div>
    </div>
</div>
 <!-- Google map -->
    <div>               
        <div id="map-canvas" style="height: 600px; width: 100%; position: relative; overflow: hidden;"></div>
    </div>
@endsection

<!-- <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key=GOOGLE_MAPS_API_KEY&libraries=places&region=GB'></script>
-->

<!-- 
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=GOOGLE_MAPS_API_KEY&callback=initMap&libraries=&v=weekly"></script>
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
        zoom: 16,
        mapTypeId: "satellite",
        });
        map.setTilt(45);
          
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng({{ $mDetail->CenterLat }}, {{ $mDetail->CenterLng }}),
            map: map,
            // title: {{$mDetail->MLocationName}}
        });
        // Add circle overlay and bind to marker
        var circle = new google.maps.Circle({
            map: map,
            radius: {{ $mDetail->MRange }},    // 10 miles in metres
            strokeOpacity: 0.8,
            strokeWeight: 1.5,
            fillColor: '#f7f705'
        });
        circle.bindTo('center', marker, 'position');
        // End of circle
        // Define a symbol using SVG path notation, with an opacity of 1.
        const lineSymbol = {
            path: "M 0,-1 0,1",
            strokeOpacity: 1,
            scale: 4,
            };
        // Create the polyline, passing the symbol in the 'icons' property.
        // Give the line an opacity of 0.
        // Repeat the symbol at intervals of 20 pixels to create the dashed effect.
        const line = new google.maps.Polyline({
            path: [
                @if (is_countable($wayp)&&count($wayp)==8)
                    @foreach ($wayp as $waypo)
                    { lat: {{$waypo['Latitude']}}, lng: {{$waypo['Longitude']}} },
                    @endforeach
                @elseif (is_countable($wayp)&&count($wayp)==2)
                   
                    @foreach ($wayp[0]['Drone 1'] as $waypo)
                    { lat: {{$waypo['Latitude']}}, lng: {{$waypo['Longitude']}} },
                    @endforeach
                    @foreach ($wayp[1]['Drone 2'] as $waypo)
                    { lat: {{$waypo['Latitude']}}, lng: {{$waypo['Longitude']}} },
                    @endforeach
                @else 
                    @foreach ($wayp[0]['Drone 1'] as $waypo)
                    { lat: {{$waypo['Latitude']}}, lng: {{$waypo['Longitude']}} },
                    @endforeach
                @endif
            ],
            strokeOpacity: 0,
            icons: [
            {
                icon: lineSymbol,
                offset: "0",
                repeat: "20px",
            },
            ],
            map: map,
        });   
        // End of polyline
        
        // Mark Victim
        var victim_lat = 0;
        var victim_lng = 0;
        victim_lat = victim_lat + {{$mDetail->MVictimLat}}0;
        victim_lng = victim_lng + {{$mDetail->MVictimLng}}0;
        var victimimg = new google.maps.MarkerImage( '/svg/victimimg.svg',null, null, null, new google.maps.Size(40,52));  
        if(victim_lat!=0){
            const beachMarker = new google.maps.Marker({
                position: new google.maps.LatLng(victim_lat, victim_lng),
                icon: victimimg,
                map: map,
                
            });
        }

        // Mark Drone
        var drone = new google.maps.MarkerImage( '/img/Drone1.png',null, null, null, new google.maps.Size(40,40));  
        const beachMarker = new google.maps.Marker({
            position: new google.maps.LatLng(
                @if (is_countable($wayp)&&count($wayp)==8)
                
                    {{$wayp[1]['Latitude']}}, {{$wayp[1]['Longitude']}} 
                
                @elseif (is_countable($wayp)&&count($wayp)==2)
                    {{$wayp[0]['Drone 1'][2]['Latitude']}}, {{$wayp[0]['Drone 1'][2]['Longitude']}} 
                
                @else 
                    {{$wayp[0]['Drone 1'][1]['Latitude']}}, {{$wayp[0]['Drone 1'][1]['Longitude']}}
                @endif
            ),
            icon: drone,
            map: map,
        });
        var drone2 = new google.maps.MarkerImage( '/img/Drone2.png',null, null, null, new google.maps.Size(40,40));
        @if  (is_countable($wayp)&&count($wayp)==2)
            const d2Marker = new google.maps.Marker({
            position: new google.maps.LatLng(
                {{$wayp[1]['Drone 2'][3]['Latitude']}}, {{$wayp[1]['Drone 2'][3]['Longitude']}} 
            ),
            icon: drone2,
            map: map,
            });
        @endif
        
    }

</script>
