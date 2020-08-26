@extends('layouts.admin')

@section('content')
    <head>

        <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('https://www.gstatic.com/charts/loader.js')}}"></script>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style type="text/css">
            .box{
                width:800px;
                margin:0 auto;
            }
        </style>
        <script type="text/javascript">
            var analytics = <?php echo $sexe; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = google.visualization.arrayToDataTable(analytics);
                var options = {
                    title : 'النسبة المئوية للاناث و الذكور', is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsmale = <?php echo $male; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datamale = google.visualization.arrayToDataTable(analyticsmale);
                var options = {
                    title : 'النسبة المئوية للذكور في كل مستوى ',

                        is3D: true,

                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chartmale'));
                chart.draw(datamale, options);
            }
        </script>

        <script type="text/javascript">
            var analyticsFemale = <?php echo $female; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var dataFemale = google.visualization.arrayToDataTable(analyticsFemale);
                var options = {
                    title : 'النسبة المئوية للاناث في كل مستوى ',

                        is3D: true,

                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chartfemale'));
                chart.draw(dataFemale, options);
            }
        </script>
        <script type="text/javascript">
            var anal= <?php echo $niveau; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var da = google.visualization.arrayToDataTable(anal);
                var options = {
                    title : 'النسبة المئوية لمستويات التوحد',
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('pie'));
                chart.draw(da, options);
            }
        </script>
        <script type="text/javascript">
            var analyts = <?php echo $year; ?>

            google.charts.load('current', {'packages':["corechart"]});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {

                var dat = google.visualization.arrayToDataTable(analyts);

                var options = {
                    title : 'احصائيات السنوية لمرضى التوحد',
                    hAxis: {

                        format: '0'
                    },
                    vAxis: {
                       format: '0',
                        viewWindow: {
                            min: 0,
                          }
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('chart'));
                chart.draw(dat, options);
            }
        </script>
        <script type="text/javascript">
            var analytsMonth = <?php echo $dateMonth; ?>

            google.charts.load('current', {'packages':["corechart"]});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {

                var datMonth = google.visualization.arrayToDataTable(analytsMonth);

                var options = {
                    title : 'احصائيات حصص المعالجة اليومية للمرضى التوحد',
                    hAxis: {
                        title: 'الاشهر',
                        format: '0'
                    },
                    vAxis: {
                        title: 'عدد المصابين', format: '0',
                        viewWindow: {
                            min: 0,
                          }
                    },
                };
                var chart = new google.visualization.LineChart(document.getElementById('chartMonth'));
                chart.draw(datMonth, options);
            }
        </script>
        <script type="text/javascript">
            var analytsMethode = <?php echo $methode; ?>

            google.charts.load('current', {'packages':["corechart"]});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {

                var datMethode = google.visualization.arrayToDataTable(analytsMethode);

                var options = {
                    title : 'احصائيات الطرق المعتمدة اثناء حصص المعالجة',is3D: true,

                };
                var chart = new google.visualization.PieChart(document.getElementById('chartMethode'));
                chart.draw(datMethode, options);
            }
        </script>
        <script type="text/javascript">
            var analytsAge = <?php echo $range; ?>

            google.charts.load('current', {'packages':['annotationchart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datAge = google.visualization.arrayToDataTable(analytsAge);

                var options = {
                    title : 'احصائيات اعمار مرضى التوحد',
                    hAxis: {
                        title: 'عدد المصابين',
                        format: '0',
                        viewWindow: {
                            min: 0,

                        }
                    },
                    vAxis: {
                        title: 'الفئة العمرية', format: '0'
                    },
                    animation:{
                        "startup": true,
                        duration: 1000,
                        easing: 'out',
                    }
                };
                var chartAge = new google.visualization.BarChart(document.getElementById('chartAge'));
                chartAge.draw(datAge, options);
            }
        </script>


    </head>
    <body>
    <br />
    <div class="container">
        <h3 align="center">احصائيات</h3><br />
        <div class="card">

                <div class="row">


                    <div class="col-md-6"><div id="pie_chart" style="width:500px; height:500px;"></div></div>
                    <div class="col-md-6"><div id="pie" style="width:500px; height:500px;"></div></div>
                </div>


        <div class="row">
            <div class="col-md-6"><div id="pie_chartmale" style="width:500px; height:500px;"></div></div>
                <div class="col-md-6"><div id="pie_chartfemale" style="width:500px; height:500px;" ></div></div>
        </div>
            <div class="panel-body" align="center">

            <div class="col-md-6">
                <div id="chartMethode" style="width:500px; height:500px;"></div>
            </div>
            </div>

        <div class="panel-body" align="center">
                <div id="chart" style="width: 100%; height: 600px;"></div>
            <div id="chartMonth" style="width: 100%; height: 600px;"></div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $chart->html() !!}
                </div>
            </div>
<div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-body" align="center">
                        <div id="chartAge" style="width: 100%; height: 600px;"></div>
                    </div>
                </div>
</div></div></div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}


@endsection
