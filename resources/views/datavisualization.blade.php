@extends('layouts.app')

@section('content')

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
                <canvas id="myChart" width="250" height="250"></canvas>
            </div>
        </div>
        {{-- <div class="tab-pane" id="day" role="tabpanel" aria-labelledby="day-tab">  
            <div class="row justify-content-center pb-3">
                <div id="myChart" width="250" height="250"></div>
            </div>
        </div> --}}      
        </div>
    </div>
</div>

<div class="row justify-content-center">

    <div class="card shadow-sm mr-3">
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
                    <canvas id="doughnut-chart" height="300"></canvas>
                </div>
            </div>    
            </div>
        </div>
    </div>
 
    <div class="card shadow-sm ml-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#month" role="tab" aria-controls="month" aria-selected="true">Doughnut Chart2</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
            <div class="tab-pane active" id="month" role="tabpanel">
                <div>
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>    
            </div>
        </div>
    </div>

</div>


<div class="container-w100">
    <div>               
        {{-- <div id="heatmap-canvas" style="height: 600px; width: 100%; position: relative; overflow: hidden;"></div> --}}
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>

var plot = function(count) {
    var ctx = $('#myChart');
    ctx[0].height = 500;
    data = count.count;
    labels =  count.label;
 
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: 'rgba(255, 119, 0, 0.5)',
                borderColor: 'rgba(255, 119, 0, 1)',
                label: 'Count in Month',
                data: data,
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
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
                text: 'Mission Frequency'
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
}

mission_count = {}
$.ajax({
    url: "{{route('mission_count')}}",
    method: "GET",
}).done(function(data) {
    mission_count = data;
    console.log(data);
    plot(data);
});

new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Hill Search", "Sea Search"],
      datasets: [
        {
          label: "Frequency",
          backgroundColor: ["#3cba9f", "#3e95cd", "#8e5ea2", "#e8c3b9","#c45850"],
          data: [478,267]
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

</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=visualization&callback=initMap">
</script>
<script>
    function initMap() {
        map = new google.maps.Map(document.getElementById('heatmap-canvas'), {
            zoom: 10.7,
            center: {lat: 22.3193, lng: 114.1694},
            mapTypeId: 'terrain'
        });

        var heatmap = new google.maps.visualization.HeatmapLayer({
            data: heatmapData
            });
        heatmap.setMap(map);
    }
    /* Data points defined as an array of LatLng objects */
    var heatmapData = [
        new google.maps.LatLng(37.782, -122.447),
        new google.maps.LatLng(37.782, -122.445),
        new google.maps.LatLng(37.782, -122.443),
        new google.maps.LatLng(37.782, -122.441),
        new google.maps.LatLng(37.782, -122.439),
        new google.maps.LatLng(37.782, -122.437),
        new google.maps.LatLng(37.782, -122.435),
        new google.maps.LatLng(37.785, -122.447),
        new google.maps.LatLng(37.785, -122.445),
        new google.maps.LatLng(37.785, -122.443),
        new google.maps.LatLng(37.785, -122.441),
        new google.maps.LatLng(37.785, -122.439),
        new google.maps.LatLng(37.785, -122.437),
        new google.maps.LatLng(37.785, -122.435)
    ];

    var sanFrancisco = new google.maps.LatLng(37.774546, -122.433523);

    map = new google.maps.Map(document.getElementById('map'), {
    center: sanFrancisco,
    zoom: 8,
    mapTypeId: 'satellite'
    });

    var heatmap = new google.maps.visualization.HeatmapLayer({
    data: heatmapData
    });
    heatmap.setMap(map);
</script>
<script>
    $('#bologna-list a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
@endsection
