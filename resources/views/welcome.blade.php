<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{__('Skyeye')}}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/welcomePage.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body class="antialiased text-white bg-dark">
        <div class="welcome">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <a class="navbar-brand d-flex flex-row" href="{{ url('/') }}">
                        <div><img src="/svg/logo.svg" style="height: 25px; border-right: 1px solid #000; /*change color*/ filter: invert(1);" class="pr-2"></div>
                        <div class="pt-1 pl-2">{{ __('Skyeye') }}</div> 
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
    
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->UNAME }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </ul>

                    </div>




                <!--
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    If login, it show 'Home' in the bar 
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
                @endif-->

                </div>
            </nav>
            <div class="bg-dark">
                <div class="container">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-8 offset-md-3 "><h3 class="title-confi">Skyeye&nbsp;Project</h3></div>
                        <!-- First Parallax Image with Logo Text 
                        <img src="{{url('/img/wallpaper.jpg')}}" style="height: 700px; weight:100%; top: 0px;" class="bgimg" alt="Image" />-->
                        
                    </div>
                </div>
            </div>
            <div class="bgimg"></div>
                <!-- Container (About Section) -->
            <div class="container padding-64">
                <h3 class="row col">ABOUT SKYEYE</h3>
                <p class="row col"><em>AN Enhancement of Mountain Rescues System</em></p>
                <p style="height:850px;font-size:36px ">This project is an enhancement project designed to improve the effectiveness of mountain rescues searching the victims. 
                    With drone, AI vision and Internet of things (IoT) techniques implemented, reduce the risk of rescuer being injured can be safer while dispatch searching 
                    operation in an extreme terrain area and the effectiveness on searching can be more accurate as of the object detection feature which power by AI vision. 
                    It enables to assist rescuer in identifying victims quickly. What is more, route planning also as part of our enhancement. The best route for drone can 
                    optimize the drone operation performance that less power consumption and shorten time to reach the accident's location. </p>
            </div>   
            
            <div class="video-event">
                <section id="chip-section">
                    <!-- <video src="http://www.apple.com/105/media/cn/iphone-se/2020/90024c0f-285a-4bf5-af04-2c38de97b06e/anim/arcade-loop/large.mp4" muted playsinline autoplay loop ></video>
                    -->
                    <video src="{{'/img/od_video.mp4'}}" muted playsinline autoplay loop ></video>
                    <h1 class="video-text">
                        Object detection is wonderful.<br>
                        Let view about it.
                    </h1>
                    <div id="the-chip">
                        <img src="{{'/svg/selfuav.svg'}}" id="UAV" >
                    </div>
                    
                    
                </section> 
            </div>
   
        </div>
        
    </body>
</html>
