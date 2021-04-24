<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/test.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/34e85e76cb.js" crossorigin="anonymous"></script>
</head>
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
.profile-card-3 .background-block .background {
  width:100%;
  vertical-align: top;
  opacity: 0.9;
  -webkit-filter: blur(0.5px);
  filter: blur(0.5px);
   -webkit-transform: scale(1.8);
  transform: scale(2.8);
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
  z-index: 9999;
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
  z-index:99999;
}
.profile-card-3 h2 {
  margin: 0 0 5px;
  font-weight: 600;
  font-size:25px;
}
.profile-card-3 h2 small {
  display: block;
  font-size: 15px;
  margin-top:10px;
}

</style>
<body> 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<section>
    <div class="container">
    	<div class="row">
    	    <!--Profile Card 1-->
    		<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block" style="background-image:linear-gradient(to top right,#e66465, #9198e5);">
    		            <div class="background"></div>
    		        </div>
    		        <div class="profile-thumb-block" style="font-size: 25px;">
                        <i class="fab fa-battle-net fa-3x profile"></i>
    		        </div>
    		        <div class="card-content">
                    <h2>Skyeye Introduction</h2>
                        <div class="icon-block mt-5">
                            <a class="btn btn-outline-primary" href="{{ url('/intro') }}" role="button">View</a>
                        </div>
                    </div>
                </div>
    		</div>
    		<!--Profile Card 2-->
    		<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block" style="background-image:linear-gradient(to top right,#64d7e6, #bae591);">
    		            <div class="background"></div>
    		        </div>
    		        <div class="profile-thumb-block" style="font-size: 22px;" >
                        <i class="fas fa-user-cog fa-3x profile"></i>
    		        </div>
    		        <div class="card-content">
                        <h2>User Management</h2>
                            <div class="icon-block mt-5">
                                <a class="btn btn-outline-primary mr-2" href="{{ url('/users/create') }}" role="button">Create</a>
                                <a class="btn btn-outline-secondary md-2" href="{{ url('/users') }}" role="button">View & Edit</a>
                            </div>
                        </div>
                </div>
    		</div>
    		
    		<!--Profile Card 3-->
    		<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block" style="background-image:linear-gradient(to top right,#ac64e6, #91d4e5);">
    		            <div class="background"></div>
    		        </div>
    		        <div class="profile-thumb-block">
                        <img src="/img/Drone.png" class="profile" alt="">
    		        </div>
    		        <div class="card-content">
                        <h2>Drone Management</h2>
                        <div class="icon-block mt-5">
                            <a class="btn btn-outline-primary mr-2" href="{{ url('/users/create') }}" role="button">Create</a>
                            <a class="btn btn-outline-secondary md-2" href="{{ url('/users') }}" role="button">View & Edit</a>
                        </div>
                    </div>
                </div>
    		</div>
    		
    		<!--Profile Card 4-->
    		<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block" style="background-image:linear-gradient(to top right,#d3e664, #91e5d3);">
    		            <div class="background"></div>
    		        </div>
    		        <div class="profile-thumb-block" style="font-size: 22px;">
                        <i class="fas fa-map-marked-alt fa-3x profile"></i>
    		        </div>
    		        <div class="card-content">
                        <h2>Mission Record</h3>
                            <div class="icon-block mt-5">
                                <a class="btn btn-outline-primary" href="{{ url('/mission') }}" role="button">View</a>
                            </div>
                        </div>
                </div>
    		</div>
    		
    		<!--Profile Card 5-->
    		<div class="col-md-4">
    		    <div class="card profile-card-3">
    		        <div class="background-block" style="background-image:linear-gradient(to top right,#e264e6, #e59191);">
    		            <div class="background"></div>
    		        </div>
    		        <div class="profile-thumb-block" style="font-size: 25px;">
                        <i class="fas fa-poll fa-3x profile"></i>
    		        </div>
    		        <div class="card-content">
                        <h2>Data Visualization</h3>
                            <div class="icon-block mt-5">
                                <a class="btn btn-outline-primary" href="{{ url('/dv') }}" role="button">View</a>
                            </div>
                        </div>
                </div>
    		</div>
    	</div>
    </div>
</section>
</body>
