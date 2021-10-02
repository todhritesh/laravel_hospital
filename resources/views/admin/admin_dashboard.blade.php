@extends('admin.admin_layout')

@section('css')
<style>
        .line-chart {
        animation: fadeIn 600ms cubic-bezier(0.57, 0.25, 0.65, 1) 1 forwards;
        opacity: 0;
        max-width: 640px;
        width: 100%;
    }
    .aspect-ratio {
        height: 0;
        padding-bottom: 50%;
    }
    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }
</style>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        //   ['Work',     11],
        //   ['Eat',      2],
        //   ['Commute',  2],
        //   ['Watch TV', 2],
        //   ['Sleep',    7]
        @php echo $chart_data @endphp
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
@endsection
@section('graph')

<div class="container">
@if (Auth::user()->isadmin!="doctor" || Auth::user()->isadmin=="admin")
{{-- pie chat --}}
<div class="row">
    <h3>Total patients stats :</h3>
    <div class="col-lg-8 col-md-10 mx-auto my-3">
        <div id="piechart" style="width: 900px; height: 450px;"></div>
    </div>
</div>
@endif

@if (Auth::user()->isadmin!="staff" || Auth::user()->isadmin=="admin")
{{-- line chart --}}
<div class="row ">
    <h3>Daily patients stats :</h3>
    <div class="col-lg-8 col-md-10 mx-auto mb-5 pb-2">
        <div class="line-chart">
            <div class="aspect-ratio">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
</div>
@endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://codepen.io/grayghostvisuals/pen/a08e0d79c150ff5030f9b6afaa137749"></script>
<script>
    var date = @json($patient);
    console.log(date);
    var chart    = document.getElementById('chart').getContext('2d'),
    gradient = chart.createLinearGradient(0, 0, 0, 450);

    gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)');
    gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
    gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');


    var data  = {
        {{--labels: [{{$values}}],--}}
        labels: [

            // "{{\Carbon\Carbon::today()->subDays(3)}}",
            // "{{\Carbon\Carbon::today()->subDays(2)}}",
            // "{{\Carbon\Carbon::today()->subDays(1)}}",
            // "{{\Carbon\Carbon::today()->subDays(0)}}",
            "{{substr(\Carbon\Carbon::today()->subDays(3),0,-8)}}",
            "{{substr(\Carbon\Carbon::today()->subDays(2),0,-8)}}",
            "{{substr(\Carbon\Carbon::today()->subDays(1),0,-8)}}",
            "{{substr(\Carbon\Carbon::today()->subDays(0),0,-8)}}",

         ],
        datasets: [{
                label: 'Total Patient',
                backgroundColor: gradient,
                pointBackgroundColor: 'white',
                borderWidth: 1,
                borderColor: '#911215',
                data: [
                    {{ $a->count() }},
                    {{ $b->count() }},
                    {{ $c->count() }},
                    {{ $d->count() }}
                ]
        }]
    };


    var options = {
        responsive: true,
        maintainAspectRatio: true,
        animation: {
            easing: 'easeInOutQuad',
            duration: 520
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: 'rgba(200, 200, 200, 0.05)',
                    lineWidth: 1
                }
            }],
            yAxes: [{
                gridLines: {
                    color: 'rgba(200, 200, 200, 0.08)',
                    lineWidth: 1
                }
            }]
        },
        elements: {
            line: {
                tension: 0.4
            }
        },
        legend: {
            display: false
        },
        point: {
            backgroundColor: 'white'
        },
        tooltips: {
            titleFontFamily: 'Open Sans',
            backgroundColor: 'rgba(0,0,0,0.3)',
            titleFontColor: 'black',
            caretSize: 5,
            cornerRadius: 2,
            xPadding: 10,
            yPadding: 10
        }
    };


    var chartInstance = new Chart(chart, {
        type: 'line',
        data: data,
            options: options
    });
</script>

@endsection
