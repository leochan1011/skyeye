@extends('layouts.app')

@section('content')
<style>
    .card{
        margin-bottom: 10px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($mission_info as $mission_info)
                
            <div class="card">
                <div class="card-header">
                    
                    <div class="row">
                        <div class="col-md">
                            Mission Name: {{ $mission_info->MNAME}}
                        </div>
                        <div class="col-md">
                            {{ $mission_info->MCreateTime}}
                        </div>
                        <div class="col-md text-right">
                            <small class="text-muted">{{ $mission_info->uname}}</small>
                        </div>
                      </div>
                </div>
                
                <div class="card-body">
                    <b> Location Name:</b> {{ $mission_info->MLocationName}}<br>
                    <b> Description:</b> {{$mission_info->MDESC}}

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <a class="btn btn-outline-primary shadow-sm" href="{{ url("/mission/{$mission_info->MID}") }}" role="button">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection