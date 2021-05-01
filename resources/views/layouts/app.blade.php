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
        body:before {
            position: absolute;
            content: "";
            z-index: 1;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.2);
            opacity: 0.5;
            visibility: hidden;
            -webkit-transition: .3s all ease-in-out;
            -o-transition: .3s all ease-in-out;
            transition: .3s all ease-in-out; }
        body.show-sidebar:before {
            opacity: 1;
            visibility: visible; }

        .site-section {
        padding: 7rem 0; }

        aside, main {
        height: 100vh;
        min-height: 580px; }

        aside {
        width: 250px;
        left: 0;
        z-index: 1001;
        position: fixed;
        -webkit-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        transform: translateX(-100%);
        background-color: #fff;
        -webkit-transition: 1s -webkit-transform cubic-bezier(0.23, 1, 0.32, 1);
        transition: 1s -webkit-transform cubic-bezier(0.23, 1, 0.32, 1);
        -o-transition: 1s transform cubic-bezier(0.23, 1, 0.32, 1);
        transition: 1s transform cubic-bezier(0.23, 1, 0.32, 1);
        transition: 1s transform cubic-bezier(0.23, 1, 0.32, 1), 1s -webkit-transform cubic-bezier(0.23, 1, 0.32, 1); }
        .show-sidebar aside {
            -webkit-transform: translateX(0%);
            -ms-transform: translateX(0%);
            transform: translateX(0%); }
        aside .toggle {
            padding-left: 30px;
            padding-top: 30px;
            position: absolute;
            right: 0;
            -webkit-transform: translateX(100%);
            -ms-transform: translateX(100%);
            transform: translateX(100%); }
        .show-sidebar aside {
            -webkit-box-shadow: 10px 0 30px 0 rgba(206, 25, 25, 0.1);
            box-shadow: 10px 0 30px 0 rgba(235, 12, 12, 0.1); }
        aside .side-inner {
            padding: 30px 0;
            height: 100vh;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch; }
            aside .side-inner .nav-menu ul, aside .side-inner .nav-menu ul li {
            padding: 0;
            margin: 0px;
            list-style: none; }
            aside .side-inner .nav-menu ul li a {
            font-size: 15px;
            display: block;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
            padding-bottom: 10px;
            color: #8b8b8b;
            position: relative;
            -webkit-transition: .3s padding-left ease;
            -o-transition: .3s padding-left ease;
            transition: .3s padding-left ease; }
            aside .side-inner .nav-menu ul li a:before {
                content: "";
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 0px;
                background-color: #ff7315;
                opacity: 0;
                visibility: hidden;
                -webkit-transition: .3s opacity ease, .3s visibility ease, .3s width ease;
                -o-transition: .3s opacity ease, .3s visibility ease, .3s width ease;
                transition: .3s opacity ease, .3s visibility ease, .3s width ease; }
            aside .side-inner .nav-menu ul li a:active, aside .side-inner .nav-menu ul li a:focus, aside .side-inner .nav-menu ul li a:hover {
                outline: none; }
            aside .side-inner .nav-menu ul li a:hover {
                background: #fcfcfc;
                color: #000; }
                aside .side-inner .nav-menu ul li a:hover:before {
                width: 4px;
                opacity: 1;
                visibility: visible; }
            aside .side-inner .nav-menu ul li.active a {
            background: #fcfcfc;
            color: #000; }
            aside .side-inner .nav-menu ul li.active a:before {
                opacity: 1;
                visibility: visible;
                width: 4px; }
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
            
            <div class="container">
                <div class="toggle d-flex flex-row bd-highlight">
                    <button class="js-menu-toggle btn btn-link shadow-sm" data-toggle="collapse" data-target="#main-navbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>  
                    <!-- Logo and Title -->
                    <a class="navbar-brand d-flex ml-3" href="{{ url('/') }}">
                        <div><img src="/svg/logo.svg" style="height: 25px; border-right: 1px solid #333333" class="pr-2"></div>
                        <div class="pt-1 pl-2">{{ __('Skyeye') }}</div> 
                    </a>
                </div> 
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
        <aside class="sidebar">
            <div class="side-inner">
                <div class="nav-menu">
                <ul>
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
                </div>
            </div>
        </aside>

        <main class="py-4" id="main">
            @yield('content')
            @yield('userinfo')
        </main>
    </div>
    <script>
        // function openNav() {
          
        //   document.getElementById("sidedata").style.width = "250px";
        //   document.getElementById("main").style.marginLeft = "300px"; }
        
        // function closeNav() {
        //   document.getElementById("sidedata").style.width = "0";
        //   document.getElementById("main").style.marginLeft= "0"; }
        $(function() {

            'use strict';

            $('.js-menu-toggle').click(function(e) {

                var $this = $(this);

                

                if ( $('body').hasClass('show-sidebar') ) {
                    $('body').removeClass('show-sidebar');
                    $this.removeClass('active');
                } else {
                    $('body').addClass('show-sidebar');	
                    $this.addClass('active');
                }

                e.preventDefault();

            });

            // click outisde offcanvas
            $(document).mouseup(function(e) {
            var container = $(".sidebar");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ( $('body').hasClass('show-sidebar') ) {
                        $('body').removeClass('show-sidebar');
                        $('body').find('.js-menu-toggle').removeClass('active');
                    }
            }
            }); 
        });
    </script>
</body>
</html>
