@extends('layouts.mpay')
@section('css_before')
<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
?>

<style>
    body *{
        font-family: 'Kanit', sans-serif;
    }
    p {
        word-wrap: break-word;
    }
    .text {
        font-family: 'Kanit', sans-serif;
    }
</style>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลงานจ่ายกลาง</h3>
        </div>
        <hr>
        <form  action="{{ route('mpay.dashboard') }}" method="post">
        @csrf 
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ข้อมูลประจำปี : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID== $year_id)
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1">
                    <span>
                        <button type="submit" class="f-kanit btn btn-info">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    คืนสติกเกอร์
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$nights}} <span class="fs-13">{{-- หน่วยนับ --}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-sync-alt fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                จ่ายของ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$pays}} <span class="fs-13">{{-- หน่วยนับ --}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-share fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                รับคืน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$recs}} <span class="fs-13">{{-- หน่วยนับ --}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-recycle fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                จำหน่ายทิ้ง
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$disps}} <span class="fs-13">{{-- หน่วยนับ --}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-eraser fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div> 
        <div class="block-content my-3 shadow">
            <h3 class="fs-18 fw-4">ข้อมูลแผนภูมิงานจ่ายกลาง</h3>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-b3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการ ร้องขอ-จัดสรร
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_mpay1" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-b3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการการบริหารจัดการ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_checkdep" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-b3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการร้องขอ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chat_bar" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
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
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['คืนสติกเกอร์', <?php echo $nights; ?>],          
            ['รับคืน', <?php echo $recs; ?>],           
            ['จ่ายของ', <?php echo $pays; ?>],
    ]);
        var options = {
            height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart_checkdep'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['ร้องขอ',     <?php echo $req_1; ?>],
            ['จัดสรร',     <?php echo $succ_1; ?>],
    ]);
        var options = {
            height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart_mpay1'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เดือน','จำนวน (ครั้ง)'],
          ['ม.ค', <?php echo $L1; ?>],
          ['ก.พ', <?php echo $L2; ?>],
          ['มี.ค', <?php echo $L3;?>],
          ['เม.ย', <?php echo $L4;?>],
          ['พ.ค', <?php echo $L5;?>],
          ['มิ.ย', <?php echo $L6;?>],
          ['ก.ค', <?php echo $L7;?>],
          ['ส.ค', <?php echo $L8;?>],
          ['ก.ย', <?php echo $L9;?>],
          ['ต.ค', <?php echo $L10;?>],
          ['พ.ย', <?php echo $L11; ?>],
          ['ธ.ค', <?php echo  $L12;?>]
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
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'มูลค่า',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'จำนวน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chat_bar'));
        chart.draw(view, options);
    }
</script>
@endsection