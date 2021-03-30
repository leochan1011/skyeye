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

        <div class="col-md-12">
            <div class="fullwidth-sidebar-container">
                <div class="sidebar top-sidebar">
                    <div id="map-canvas" style="height: 550px; width: 100%; position: relative; overflow: hidden;">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
<script defer>
    function initialize() {
        var mapOptions = {
            zoom: 15,
            minZoom: 6,
            maxZoom: 20,
            zoomControl:true,
            zoomControlOptions: {
                style:google.maps.ZoomControlStyle.DEFAULT
            },
            center: new google.maps.LatLng({{ $mDetail->CenterLat }}, {{ $mDetail->CenterLng }}),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
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
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);

    
</script>
