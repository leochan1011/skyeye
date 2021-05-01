@extends('layouts.app')

@section('content')
<style>
  @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
  @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
  @import url('https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700');
  body{
      font-family: 'Open Sans', sans-serif;
  }
  section{
      float:left;
      width:100%;
      background: #fff;  /* fallback for old browsers */
      padding:30px 0;
  }
  h1{float:left; width:100%; color:#232323; margin-bottom:30px; font-size: 14px;}
  h1 span{font-family: 'Libre Baskerville', serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
  h1 a{color:#131313; font-weight:bold;}

  /*Profile Card 3*/
  .profile-card-3 {
    font-family: 'Open Sans', Arial, sans-serif;
    position: relative;
    float: left;
    overflow: hidden;
    width: 100%;
    text-align: center;
    height:400px;
    border:none;
    margin-bottom: 10%;
  }
  .profile-card-3 .background-block {
      float: left;
      width: 100%;
      height: 200px;
      overflow: hidden;
  }
  .profile-card-3 .card-content {
    width: 100%;
    padding: 15px 25px;
    color:#232323;
    float:left;
    background:#efefef;
    height:50%;
    border-radius:0 0 5px 5px;
    position: relative;
    z-index: 100;
  }
  .profile-card-3 .card-content::before {
      content: '';
      background: #efefef;
      width: 120%;
      height: 100%;
      left: 11px;
      bottom: 51px;
      position: absolute;
      z-index: -1;
      transform: rotate(-13deg);
  }
  .profile-card-3 .profile {
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.836);
    position: absolute;
    bottom: 50%;
    left: 50%;
    width: 90px;
    height: 85px;
    opacity: 1;
    box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
    border: 2px solid rgb(255, 255, 255);
    -webkit-transform: translate(-50%, 0%);
    transform: translate(-50%, 0%);
    z-index:101;
  }
  .profile-card-3 h2 {
    margin: 0 0 5px;
    font-weight: 600;
    font-size:25px;
  }
</style>
<div class="container">
  <div class="row">
      <!--Profile Card 1-->
    <div class="col-md-4">
        <div class="card profile-card-3 shadow">
            <div class="background-block" style="background-image:linear-gradient(to top right,#e66465, #9198e5);">
              <div class="background"></div>
            </div>
            <div class="profile-thumb-block" style="font-size: 25px;">
              <i class="fab fa-battle-net fa-3x profile"></i>
            </div>
            <div class="card-content">
              <h2>Skyeye Introduction</h2>
              <div class="icon-block mt-5">
                <a class="btn btn-outline-primary btn-lg shadow-sm" href="{{ url('/intro') }}" role="button">View</a>
              </div>
            </div>
        </div>
    </div>
    <!--Profile Card 2-->
    <div class="col-md-4">
        <div class="card profile-card-3 shadow">
            <div class="background-block" style="background-image:linear-gradient(to top right,#64d7e6, #bae591);">
                <div class="background"></div>
            </div>
            <div class="profile-thumb-block" style="font-size: 16px;">
                    <i class="fas fa-user-cog fa-4x profile"></i>
            </div>
            <div class="card-content">
                    <h2>User Management</h2>
                        <div class="icon-block mt-5">
                            <a class="btn btn-outline-primary mr-2 btn-lg shadow-sm" href="{{ url('/users/create') }}" role="button">Create</a>
                            <a class="btn btn-outline-secondary md-2 btn-lg shadow-sm" href="{{ url('/users') }}" role="button">View & Edit</a>
                        </div>
                    </div>
            </div>
    </div>
    
    <!--Profile Card 3-->
    <div class="col-md-4">
      <div class="card profile-card-3 shadow">
          <div class="background-block" style="background-image:linear-gradient(to top right,#ac64e6, #91d4e5);">
            <div class="background"></div>
          </div>
          <div class="profile-thumb-block">
            <img src="/img/Drone.png" class="profile" alt="">
          </div>
          <div class="card-content">
            <h2>Drone Management</h2>
            <div class="icon-block mt-5">
              <a class="btn btn-outline-primary mr-2 btn-lg shadow-sm" href="{{ url('/drone/create') }}" role="button">Create</a>
              <a class="btn btn-outline-secondary md-2 btn-lg shadow-sm" href="{{ url('/drone') }}" role="button">View & Edit</a>
            </div>
          </div>
        </div>
      </div>
    
    <!--Profile Card 4-->
    <div class="col-md-4">
        <div class="card profile-card-3 shadow">
            <div class="background-block" style="background-image:linear-gradient(to top right,#d3e664, #91e5d3);">
                <div class="background"></div>
            </div>
            <div class="profile-thumb-block" style="font-size: 22px;">
                    <i class="fas fa-map-marked-alt fa-3x profile"></i>
            </div>
            <div class="card-content">
                    <h2>Mission Record</h2>
                        <div class="icon-block mt-5">
                            <a class="btn btn-outline-primary btn-lg shadow-sm" href="{{ url('/mission') }}" role="button">View</a>
                        </div>
                    </div>
            </div>
    </div>
    
    <!--Profile Card 5-->
    <div class="col-md-4">
      <div class="card profile-card-3 shadow">
          <div class="background-block" style="background-image:linear-gradient(to top right,#e264e6, #e59191);">
              <div class="background"></div>
          </div>
          <div class="profile-thumb-block" style="font-size: 25px;">
            <i class="fas fa-poll fa-3x profile"></i>
          </div>
          <div class="card-content">
          <h2>Data Visualization</h2>
            <div class="icon-block mt-5">
              <a class="btn btn-outline-primary btn-lg shadow-sm" href="{{ url('/dv') }}" role="button">View</a>
            </div>
          </div>
      </div>
    </div>

    <!--Profile Card 6 coming soon-->
    <div class="col-md-4">
      <div class="card profile-card-3 shadow">
          <div class="background-block" style="background-image:linear-gradient(to top right,#f7f45a, #3fece4);">
              <div class="background"></div>
          </div>
          <div class="profile-thumb-block" style="font-size: 23px;">
            <i class="fab fa-skyatlas fa-3x profile"></i>
          </div>
          <div class="card-content">
          <h2>FYP2021 Future</h2>
            <div class="icon-block mt-5">
              <a class="btn btn-outline-primary btn-lg disabled" href="#" role="button" tabindex="-1" aria-disabled="true">Coming Soon</a>
            </div>
          </div>
      </div>
    </div>

  </div>
</div>
@endsection
