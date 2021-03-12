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
</head>

<body class="bg-dark"> 
    <div class="video-event">
        <section id="chip-section">
            <video src="http://www.apple.com/105/media/cn/iphone-se/2020/90024c0f-285a-4bf5-af04-2c38de97b06e/anim/arcade-loop/large.mp4" muted playsinline autoplay loop ></video>
            <h1 class="video-text">
                Object detection is wonderful.<br>
                Let view about it.
            </h1>
            <div id="the-chip">
                <img src="{{'/svg/selfuav.svg'}}" id="UAV" >
            </div>
            
            
        </section> 
    </div>
    

</body>
