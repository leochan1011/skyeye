@extends('layouts.app')

@section('content')
<div class="col-xl-2 mb-4 offset-2">
    <div class="card border-success shadow-sm">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col">
                    <small><div class="font-weight-bold text-success text-uppercase mb-1">
                        Total Mission Count</div></small>
                    <div class="h5 mb-0 font-weight-bold text-muted">{{count($latlng)}}</div>
                </div>
                <div class="mr-2">
                    <i class="fas fa-flag fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab" aria-controls="month" aria-selected="true">Heat Map</a>
                    </li>
                </ul>
                <div class="panel">
                    <button class="btn btn-outline-success my-2 my-sm-0" onclick="changeGradient()">Change gradient</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" onclick="changeRadius()">Change radius</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" onclick="changeOpacity()">Change opacity</button>
                </div> 
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="month" role="tabpanel">
                        <div>            
                            <div id="heatmap-canvas" style="height: 600px; width: 100%; position: relative; overflow: hidden;"></div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#" role="tab" aria-controls="bar" aria-selected="true">Bar Chart</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="bar" role="tabpanel">
                    <div>
                        <canvas id="bar_chart" width="250" height="250"></canvas>
                    </div>
                </div>    
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row justify-content-center mb-3">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#month" role="tab" aria-controls="month" aria-selected="true">Doughnut Chart</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="month" role="tabpanel">
                    <div>
                        <canvas id="doughnut-chart" height="260"></canvas>
                    </div>
                </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#month" role="tab" aria-controls="month" aria-selected="true">Time-Series</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link"  href="#day" role="tab" aria-controls="day" aria-selected="false">Day</a>
                </li> --}}
                </ul>
            </div>
            <div class="card-body">
        
                <div class="tab-content mt-3">
                <div class="tab-pane active" id="month" role="tabpanel">
                    <div class="row justify-content-center pb-3">
                        <canvas id="myChart" width="250" height="400"></canvas>
                    </div>
                </div>
                {{-- <div class="tab-pane" id="day" role="tabpanel" aria-labelledby="day-tab">  
                    <div class="row justify-content-center pb-3">
                        <div id="myChart2" width="250" height="250"></div>
                    </div>
                </div>       --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>
// time series
var plot = function(count) {
    var canvas = document.getElementById('myChart');
    var ctx = canvas.getContext("2d");
    data = count.count;
    labels =  count.label;

    // gradient color setting
    var gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(0, 153, 153, 1)');   
    gradient.addColorStop(1, 'rgba(0, 153, 153, 0)');
 
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: gradient,
                borderColor: gradient,
                fill: true,
                lineTension: 0.1,
                pointRadius: 4,
                label: 'Total',
                data: data,
            },
            {
                fill: false,
                borderColor: 'rgba(64, 36, 203, 1)',
                lineTension: 0.1,
                pointRadius: 4,
                label: 'Creator 1',
                data: count.count1,
            },
            {
                fill: false,
                lineTension: 0.1,
                borderColor: 'rgba(203, 36, 36, 1)',
                pointBackgroundColor: "white",
                pointRadius: 4,
                label: 'Creator 2',
                data: count.count2,
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    // distribution: 'series',
                    time: {
                        unit: 'month'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    },
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        userCallback: function(label, index, labels) {
                            // when the floored value is the same as the value we have a whole number
                            if (Math.floor(label) === label) {
                                return label;
                            }

                        },
                    },
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    },
                }]
            },
            title:{
                display: true,
                text: 'Mission Frequency in Month'
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
}

// jquery ajax
mission_count = {}
$.ajax({
    url: "{{route('mission_count')}}",
    method: "GET",
}).done(function(data) {
    mission_count = data;
    console.log(data);
    plot(data);
});


// Pie chart
new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Hill Search", "Sea Search"],
      datasets: [
        {
          label: "Frequency",
          backgroundColor: ["#3cba9f", "#3e95cd", "#8e5ea2", "#e8c3b9","#c45850"],
          data: [42,18]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Type of Rescues Searching'
      }
    }
});

// Bar chart 
var bar_plot = function(count) {
            var ctx = $('#bar_chart');
            ctx[0].height = 200;
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
            },
            title: {
                display: true,
                text: 'Mission Distribution'
            },
            legend: {
                display: false
            },
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
<script async
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=visualization&callback=initMap">
</script>
<script>
    function initMap() {
        map = new google.maps.Map(document.getElementById('heatmap-canvas'), {
            zoom: 10.7,
            center: {lat: 22.3193, lng: 114.1694},
            mapTypeId: google.maps.MapTypeId.TERRAIN
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(),
            map: map
        });
        }

        function changeGradient() {
        var gradient = [
            'rgba(0, 255, 255, 0)',
            'rgba(0, 255, 255, 1)',
            'rgba(0, 191, 255, 1)',
            'rgba(0, 127, 255, 1)',
            'rgba(0, 63, 255, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(0, 0, 223, 1)',
            'rgba(0, 0, 191, 1)',
            'rgba(0, 0, 159, 1)',
            'rgba(0, 0, 127, 1)',
            'rgba(63, 0, 91, 1)',
            'rgba(127, 0, 63, 1)',
            'rgba(191, 0, 31, 1)',
            'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
        }
        
        function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 30);
        }

        function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
        }

        // Heatmap data
        function getPoints() {
            return [
                @foreach ($latlng as $latlong)
                    new google.maps.LatLng({{$latlong->Latitude}}, {{$latlong->Longitude}}),
                @endforeach
            ];
        }
</script>

<script>
    $('#bologna-list a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
@endsection
