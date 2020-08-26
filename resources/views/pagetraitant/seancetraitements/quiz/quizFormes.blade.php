@extends('layouts.traitants')

@section('content')

    <head>
        <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('https://www.gstatic.com/charts/loader.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css')}}">

        <style type="text/css">
            .box{
                width:600px; height:400px;
            }
        </style>
        <script type="text/javascript">
            var analytics = <?php echo $dateH; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = google.visualization.arrayToDataTable(analytics);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية خلال العام',
                    hAxis: {
                        title: 'الاشهر'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    //backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatejanvier = <?php echo $datejanvier; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatejanvier = google.visualization.arrayToDataTable(analyticsdatejanvier);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية خلال شهر جانفي',
                    hAxis: {
                        title: 'شهر جانفي'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatejanvier'));
                chart.draw(datadatejanvier, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatefivrier = <?php echo $datefivrier; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatefivrier = google.visualization.arrayToDataTable(analyticsdatefivrier);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية خلال شهر فيفري',
                    hAxis: {
                        title: 'شهر فيفري'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatefivrier'));
                chart.draw(datadatefivrier, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatemars = <?php echo $datemars; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatemars = google.visualization.arrayToDataTable(analyticsdatemars);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر مارس',
                    hAxis: {
                        title: 'شهر مارس'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatemars'));
                chart.draw(datadatemars, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdateavril = <?php echo $dateavril; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadateavril = google.visualization.arrayToDataTable(analyticsdateavril);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر افريل',
                    hAxis: {
                        title: 'شهر افريل'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdateavril'));
                chart.draw(datadateavril, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatemai = <?php echo $datemai; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatemai = google.visualization.arrayToDataTable(analyticsdatemai);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر ماي',
                    hAxis: {
                        title: 'شهر ماي'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatemai'));
                chart.draw(datadatemai, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdateseptember = <?php echo $dateseptember; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadateseptember = google.visualization.arrayToDataTable(analyticsdateseptember);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر سبتمبر',
                    hAxis: {
                        title: 'شهر سبتمبر'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdateseptember'));
                chart.draw(datadateseptember, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdateoctober = <?php echo $dateoctober; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadateoctober = google.visualization.arrayToDataTable(analyticsdateoctober);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر اكتوبر',
                    hAxis: {
                        title: 'شهر اكتوبر'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdateoctober'));
                chart.draw(datadateoctober, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatenovember = <?php echo $datenovember; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatenovember = google.visualization.arrayToDataTable(analyticsdatenovember);
                var options = {
                    title : 'منحنى تطور مستوى الطفل في الالعاب التعليمية  خلال شهر نوفمبر',
                    hAxis: {
                        title: 'شهر نوفمبر'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatenovember'));
                chart.draw(datadatenovember, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatedecember = <?php echo $datedecember; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatedecember = google.visualization.arrayToDataTable(analyticsdatedecember);
                var options = {
                    title : 'منحنى تطور حالة الطفل في الحصص خلال شهر ديسمبر',
                    hAxis: {
                        title: 'شهر ديسمبر'
                    },
                    vAxis: {
                        title: 'التقييم',format: '0',
                        viewWindow: {
                            min: 0,
                            max: 10}
                    },
                    // backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatedecember'));
                chart.draw(datadatedecember, options);
            }
        </script>
    </head>
    <body>
    <br />
    <div class="container">
        <div class="card">
            <div class="panel panel-default">
                <a style="margin-right: 1024px" href="{{route('pagetraitant.show2',$enfant->id_enfant)}}" class="close" aria-label="Close"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>

                <br><br><br>
                <div class="w3-bar w3-border w3-light-blue">
                    <div class="panel-body" align="center">
                        <h3>احصائيات التطور في الالعاب التعليمية </h3>

                        <h5>==كويز الاشكال ==</h5>
                </div></div>
        <br><br><br><br>
        <div class="panel-body" align="center">
            <div id="line_chart" style="width:550px; height:350px;">

            </div></div>

        <div class="row">
            <div class="col-md-6"><div id="line_chartdatejanvier" style="width:450px; height:350px;"></div>

            </div>
            <div class="col-md-6"> <div id="line_chartdatefivrier" style="width:450px; height:350px;"></div></div>
        </div>
                <div class="row">
                    <div class="col-md-6"><div id="line_chartdatemars" style="width:450px; height:350px;"></div></div>
                    <div class="col-md-6"> <div id="line_chartdateavril" style="width:450px; height:350px;"></div></div>
                </div>
        <div class="row">
            <div class="col-md-6"><div id="line_chartdatemai" style="width:450px; height:350px;"></div></div>
            <div class="col-md-6"> <div id="line_chartdateseptember" style="width:450px; height:350px;"></div></div>
        </div>
        <div class="row">
            <div class="col-md-6"><div id="line_chartdateoctober" style="width:450px; height:350px;"></div></div>
            <div class="col-md-6"> <div id="line_chartdatenovember" style="width:450px; height:350px;"></div></div>
        </div>
        <div class="row">
            <div class="col-md-6"><div id="line_chartdatedecember" style="width:450px; height:350px;"></div></div>
        </div>
    </div>
        </div></div>
    </body>
@endsection
