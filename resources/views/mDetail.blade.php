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
@endsection