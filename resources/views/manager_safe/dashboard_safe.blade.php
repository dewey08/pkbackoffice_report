@extends('layouts.safe')
@section('css_before')

<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
</script>
<?php
    if(Auth::check()){
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;   
    }else{    
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    } 

?>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลรักษาความปลอดภัย</h3>
        </div>
        <hr>
        <form>
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach ($budgetyear_dropdown as $budget)
                            @if($budget == $budgetyear)
                            <option value="{{$budget}}" selected>{{$budget}}</option>
                            @else
                            <option value="{{$budget}}">{{$budget}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1 text-center">
                    <span>
                        <button type="submit" class="btn btn-info fw-5">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <div class="block-content shadow my-3">
            <h3 class="fs-18 fw-5">แผนภูมิข้อมูลรักษาความปลอดภัย</h3>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl2-o3 p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนของเหตุการณ์ทั้งหมดรายเดือน</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="eventall_grap" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-blue p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนของเหตุการณ์</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="event_grap" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-blue p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนของประเภทรายงาน
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_type" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-blue p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนของสถานที่เกิดเหตุ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_location" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('google/Charts.js?v='.time()) }}"></script>
<script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'เดือน');
            data.addColumn('number', 'ครั้ง');
            data.addRows([
                ['ต.ค.',{{$safeall[10]}}],
                ['พ.ย.',{{$safeall[11]}}],
                ['ธ.ค.',{{$safeall[12]}}],
                ['ม.ค.',{{$safeall[1]}}],
                ['ก.พ.',{{$safeall[2]}}],
                ['มี.ค.',{{$safeall[3]}}],
                ['เม.ย.',{{$safeall[4]}}],
                ['พ.ค.',{{$safeall[5]}}],
                ['มิ.ย.',{{$safeall[6]}}],
                ['ก.ค.',{{$safeall[7]}}],
                ['ส.ค.',{{$safeall[8]}}],
                ['ก.ย.',{{$safeall[9]}}],
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                }
            ]);
            var options = {
                fontName:'Kanit',
                fontSize:16,
                width: "100%",
                legend:{position:'center'},
                bar: {
                    groupWidth: "80%"
                },
                height: '100%',
                vAxis: {
                    title: 'ครั้ง'
                },
                hAxis: {
                    title: 'เดือน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('eventall_grap'));
            chart.draw(view, options);
        }
    </script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($eventsafe);?>);
        var options = {
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('event_grap'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($typesafe);?>);
        var options = {
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_type'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($lacatoinsafe);?>);
        var options = {
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_location'));
        chart.draw(data, options);
    }
</script>
@endsection



