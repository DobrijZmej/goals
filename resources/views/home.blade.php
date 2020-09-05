@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> -->
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart_div"></div>
                <script>
                google.charts.load('current', {packages: ['corechart', 'line']});
                $(document).ready(function(){
                    google.charts.setOnLoadCallback(drawLineColors);
                });
                function drawLineColors(){
                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                    var data = new google.visualization.DataTable();

                    var columns = [];
                    var rows = [];
                    $.ajax({
                        url:"{{ route('charts.lines') }}",
                        type:"GET",
                        async:false,
                        success: function(restData){
                            console.log(restData);
                            rows = restData.lines;
                            columns = restData.goals;
                        }
                    });
                    console.log(rows);
                    rows = rows.map(row=>[new Date(row[0]), Number.parseInt(row[1])]);
                    console.log(columns[0].name);

                    data.addColumn('date', 'X');
                    data.addColumn('number', columns[0].name);
                    //data.addColumn('number', 'Cats');
                    data.addRows(rows);

                    var options = {
                        hAxis: {
                            textStyle:{color:'white'},
                            format:'dd.MM.yyyy',
                        },
                        legend: {
                            position:'bottom',
                            textStyle:{color:'white'},
                        },
                        vAxis: {
                            /*title: 'Popularity',*/
                            textStyle:{color:'white'},
                            titleTextStyle:{color:'white'},
                            /*viewWindowMode:'explicit',*/
                        },
                        backgroundColor: '#002b36',
                        curveType: 'function',
                        /*chartArea: {width: '70%'},*/
                    };

                    chart.draw(data, options);
                };
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
