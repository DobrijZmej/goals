@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> -->
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
                <style>
                #chart_div{
                    position: absolute;
                    left:0px;
                }
                </style>
                <div id="chart_div"></div>
                <script>
                google.charts.load('current', {packages: ['corechart', 'line']});
                $(document).ready(function(){
                    google.charts.setOnLoadCallback(drawLineColors);
                });
                $(window).resize(function(){
                    $("#chart_div").html('');
                    $("#chart_div").height(0).width(0);
                    google.charts.setOnLoadCallback(drawLineColors);
                });
                function drawLineColors(){
                    $pageHeight = $(document).height();
                    $pageWidth = $(document).width();
                    $pageHeight = $pageHeight - ($pageHeight*0.1);
                    $pageWidth  = $pageWidth  - ($pageWidth*0.01);
                    $chartTop = $("#chart_div").offset().top;
                    $("#chart_div").height($pageHeight-$chartTop).width($pageWidth);

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                    var data = new google.visualization.DataTable();

                    var columns = [];
                    var rows = [];
                    $.ajax({
                        url:"{{ route('charts.lines') }}",
                        type:"GET",
                        async:false,
                        success: function(restData){
                            //console.log(restData);
                            rows = restData.lines;
                            columns = restData.goals;
                        }
                    });
                    //console.log(rows);
                    rows.forEach(function(row, i){
                        row.forEach(function(data, j){
                            if(j==0){
                                data = moment(row[0], 'DD.MM.YYYY hh:mm:ss').toDate();
                                rows[i][0] = data;
                                //console.log(data);
                            } else {
                                data = Number.parseInt(data);
                                rows[i][j] = data;
                            }
                        });
                    }
                    );
                    //console.log(rows);
                    //console.log(columns[0].name);

                    data.addColumn('date', 'X');
                    columns.forEach(function(row, i){
                        data.addColumn('number', row);
                    });
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
                            textStyle:{color:'white'},
                            titleTextStyle:{color:'white'},
                        },
                        /*chartArea: {
                            width: '94%',
                            height: '94%'
                        },*/
                        backgroundColor: '#002b36',
                        /*curveType: 'function',*/
                        width: '100%',
                        height: '100%',
                        /*vAxis: {gridlines: {interval: 1}
                        }*/
                    };

                    chart.draw(data, options);
                };
                </script>
            </div>
        <!-- </div>
    </div> -->
</div>
@endsection
