@extends('layouts.personcheck')
@section('css_before')
<?php
    $status = Auth::user()->status; 
    $id_user = Auth::user()->PERSON_ID; 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos); 
?>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }

    p {
        word-wrap: break-word;
    }

    .text {
        font-family: 'Kanit', sans-serif;
    }

    .table thead th ,.table tbody td{
        border: 1px solid #000 !important;
        vertical-align:middle;
    }
</style>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h2 class="block-title text-center fs-24">ข้อมูลการลงเวลา
            </h2>
        </div>
        <hr>
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g4" href="#">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ลงเวลาเข้าทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                {{ $amount_1 }} <span class="fs-13">ครั้ง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-clock fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="block block-rounded block-link-pop bg-sl2-yg3" href="#">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ลงเวลาออกทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                {{$amount_2}} <span class="fs-13">ครั้ง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-clock fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="block block-rounded block-link-pop bg-sl2-sb3" href="#">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ลงเวลาเข้าวันนี้
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                {{ $amount_11 }} <span class="fs-13">ครั้ง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-clock fs-30 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="block block-rounded block-link-pop bg-sl2-b3" href="#">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ลงเวลาออกวันนี้
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                {{$amount_22}} <span class="fs-13">ครั้ง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-clock fs-30 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h3 class="fs-18 fw-5 f-kanit">บันทึกการเข้าทำงาน</h3>
                </div>
                <div class="col-xl-6 mb-2">
                    <div class="card p-1 bg-sl2-sb3 text-white">
                        <div class="card-header px-3 py-2">
                            ลงเวลาเข้าวันนี้ ( วันที่ {{DateThai(date('Y-m-d'))}} )
                        </div>
                        <div class="card-body bg-white">
                            
                            <table class="table table-striped table-bordered mb-0">
                                <thead>
                                    <tr class="text-center" style="background:#dcdcdc;">
                                        <th>เวลาเข้าทำงาน</th>
                                        <th>ชื่อ - สกุล</th>
                                        <th>หน่วยงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkintable as $row)
                                    <tr>
                                        <td width="33%"  class=" text-center fs-20 fw-6">{{$row->CHEACKIN_TIME}} น.</td>
                                        <td width="33%">{{$row->HR_PREFIX_NAME.$row->HR_FNAME.' '.$row->HR_LNAME}}</td>
                                        <td width="33%">{{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-2">
                    <div class="card p-1 bg-sl2-b3 text-white">
                        <div class="card-header px-3 py-2">
                            ลงเวลาออกวันนี้ ( วันที่ {{DateThai(date('Y-m-d'))}} )
                        </div>
                        <div class="card-body bg-white">
                            <table class="table table-striped table-bordered mb-0">
                                <thead>
                                    <tr class="text-center" style="background:#dcdcdc;">
                                        <th>เวลาออกทำงาน</th>
                                        <th>ชื่อ - สกุล</th>
                                        <th>หน่วยงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkouttable as $row)
                                    <tr>
                                        <td width="33%" class="fs-18 fw-6">{{$row->CHEACKIN_TIME}}</td>
                                        <td width="33%">{{$row->HR_PREFIX_NAME.$row->HR_FNAME.' '.$row->HR_LNAME}}</td>
                                        <td width="33%">{{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <div class="block-content my-3 shadow">
            <h3 class="fs-18 fw-5">แผนภูมิข้อมูลการลงเวลา</h3>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-blue p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">บันทึกการลงเวลาเข้า-ออกทั้งหมด
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_type" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-blue p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">บันทึกการลงเวลาเข้า-ออกวันนี้
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_type2" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'Hours per Day'],
          ['เข้าทำงาน',<?php echo $type_1; ?>],
          ['ออกทำงาน',<?php echo $type_2; ?>],         
          ]);
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
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'Hours per Day'],
          ['เข้าทำงาน',<?php echo $type_11; ?>],
          ['ออกทำงาน',<?php echo $type_22; ?>]        
          ]);
        var options = {
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_type2'));
        chart.draw(data, options);
    }
</script>
@endsection