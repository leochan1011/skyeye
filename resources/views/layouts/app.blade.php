<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Skyeye') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* The sidebar menu */
        .sidebar {
        height: 100%; /* 100% Full-height */
        width: 0;
        position: fixed; /* Stay in place */
        top: 0;
        left: 0;
        background-color: #111; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 60px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
        }

        /* The sidebar links */
        .sidebar a{
        padding: 8px 8px 8px 25px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidebar a:hover.col {
        color: #f1f1f1;
        }

        /* Position and style the close button (top right corner) */
        .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        }
        #main {
            transition: margin-left .5s;
            padding: 10px;
        }
    </style>
    <!-- jquery 3.6 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/34e85e76cb.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">

        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <button class="openbtn btn btn-link shadow-sm" onclick="openNav()">
                <span class="navbar-toggler-icon "></span>
            </button>  
            <div class="container">
                <!-- Sidebar Toggle (Topbar) New
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3" data-toggle="collapse" data-target="#sidedata" aria-controls="sidedata" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
                
                <!-- Logo and Title -->
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="/svg/logo.svg" style="height: 25px; border-right: 1px solid #333333" class="pr-2"></div>
                    <div class="pt-1 pl-2">{{ __('Skyeye') }}</div> 
                </a>

                <div class="topbar">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                           <!-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i>  {{ Auth::user()->UNAME }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
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
            </div>
        </nav>
    </div>
    <div class="body">
        
        <!-- Sidebar -->
        <nav class="sidebar" id="sidedata">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="col nav-link dropdown-toggle pl-4" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-cog"></i> Management
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/users/create') }}"><i class="fas fa-user-plus"></i> Create User</a>
                        <a class="dropdown-item" href="{{ url('/users') }}"><i class="fas fa-user-edit"></i> View/Eidt User</a>
                        <a class="dropdown-item" href="{{ url('/drone/create') }}"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Create Drone</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="col" href="{{ url('/mission') }}"><i class="fas fa-map-marked-alt"></i> View Mission</a>
                </li>
                <li class="nav-item">
                    <a class="col" href="{{ url('/dv') }}"><i class="fas fa-poll"></i> Dashborad</a>
                </li>
                <li class="nav-item">
                    <a class="col" href="{{ url('/intro') }}"><i class="fab fa-battle-net"></i> Introduction</a>
                </li>
            </ul>
            
            
           
            
        </nav> 

        <main class="py-4" id="main">
            @yield('content')
            @yield('userinfo')
        </main>
    </div>
    <script>
        function openNav() {
          
          document.getElementById("sidedata").style.width = "250px";
          document.getElementById("main").style.marginLeft = "300px";
        }
        
        function closeNav() {
          document.getElementById("sidedata").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
    </script>
</body>
</html>
