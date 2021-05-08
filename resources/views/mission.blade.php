@extends('layouts.app')

@section('content')
<style>
    .card{
        margin-bottom: 10px;
    }
</style>
<div class="container">
    <div class="col-md-6 offset-md-3 mb-3">
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{url('mission')}}" method="GET" role="search">

                    <div class="input-group ">
                        <span class="input-group-btn mr-2 ">
                            <button class="btn btn-info" type="submit" title="Search projects">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search Mission ID / Name / Location" id="term">
                        <a href="{{url('mission')}}" class="rese">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                            <small class="text-muted">Created by {{ $mission_info->uname}}</small>
                        </div>
                      </div>
                </div>
                
                <div class="card-body">
                    <b><u>Mission ID:</u></b> {{$mission_info->MID}}<br>
                    <b><u>Location Name:</u></b> {{ $mission_info->MLocationName}}<br>
                    <b><u>Description:</u></b> {{$mission_info->MDESC}}

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