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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34e85e76cb.js" crossorigin="anonymous"></script>
</head>
<style>

</style>
<body>
    <div class="container-w100">
        <canvas id="bar_chart" width="250" height="250"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    
    <script>
        var bar_plot = function(count) {
            var ctx = $('#bar_chart');
            ctx[0].height = 80;
            data = count.count;
            labels =  count.district;

        var stackedBar = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Count',
                    data: data,
                    backgroundColor: [
                    'rgba(252, 38, 73, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(255, 255, 65, 0.2)',
                    'rgba(128, 255, 65, 0.2)',
                    'rgba(54, 226, 83, 0.2)',
                    'rgba(37, 223, 167, 0.2)',
                    'rgba(37, 192, 223, 0.2)',
                    'rgba(37, 155, 223, 0.2)',
                    'rgba(61, 172, 255, 0.2)',
                    'rgba(61, 120, 255, 0.2)',
                    'rgba(101, 153, 255, 0.2)',
                    'rgba(101, 127, 255, 0.2)',
                    'rgba(192, 101, 200, 0.2)',
                    'rgba(219, 123, 193, 0.2)',
                    'rgba(219, 123, 139, 0.2)',
                    'rgba(201, 203, 207, 0.2)',
                   
                    ],
                    borderColor: [
                    'rgb(252, 38, 73)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 255, 65)',
                    'rgb(128, 255, 65)',
                    'rgb(54, 226, 83)',
                    'rgb(37, 223, 167)',
                    'rgb(37, 192, 223)',
                    'rgb(37, 155, 223)',
                    'rgb(61, 172, 255)',
                    'rgb(61, 120, 255)',
                    'rgb(101, 153, 255)',
                    'rgb(101, 127, 255)',
                    'rgb(192, 101, 200)',
                    'rgb(219, 123, 193)',
                    'rgb(219, 123, 139)',
                    'rgb(201, 203, 207)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        
                    },
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    },
                }],
                    yAxes: [{
                        scaleLabel: {
                            display:     true,
                            labelString: 'District'
                        },
                    }]
                }
            }
        });
        }
        mission_count = {}
        $.ajax({
            url:"/barchart_count",
            method: "GET",
        }).done(function(data) {
            mission_count = data;
            console.log(data);
            bar_plot(data);
        });

    </script>
    
</body>