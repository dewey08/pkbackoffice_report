@extends('layouts.medical')

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
    
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos); 
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
        }
        p {
            word-wrap:break-word;
        }
        .text{
            font-family: 'Kanit', sans-serif;
        }
</style>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลยาและเวชภัณฑ์</h3>
        </div>
        <hr>
        <form method="post">
        @csrf
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
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3" href="{{route('mmedical.dashboard_request_status',['budgetyear'=>$budgetyear,'status_request'=>'all'])}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ขอเบิกยาและเวชภัณฑ์
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count1}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-hand-holding fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3" href="{{route('mmedical.dashboard_request_status',['budgetyear'=>$budgetyear,'status_request'=>'Approve'])}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    หน. เห็นชอบ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count2}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-yg3" href="{{url(route('mmedical.dashboard_request_status',['budgetyear'=>$budgetyear,'status_request'=>'Verify']))}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ตรวจสอบผ่าน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count3}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check-square fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g4" href="{{url(route('mmedical.dashboard_request_status',['budgetyear'=>$budgetyear,'status_request'=>'Allow']))}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    อนุมัติ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count4}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-clipboard-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบยาและเวชภัณฑ์</h3>
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-g4">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการร้องขอเบิกยาและเวชภัณฑ์ในสถานะต่าง ๆ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_dep" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-g4">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนมูลค่าการรับเข้า และจ่ายออก ของยาและเวชภัณฆ์</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chat_bar" style="width: 100%; height: 500px;"></div>
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
          ['สถานะรายการ', 'จำนวน'],
          ['ขอเบิกยาและเวชภัณฑ์',     <?php echo $count1; ?>],
          ['หน.เห็นชอบ',     <?php echo $count2; ?>],
          ['ตรวจสอบผ่าน',     <?php echo $count3; ?>],
          ['อนุมัติ',     <?php echo $count4; ?>]   
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
        var chart = new google.visualization.PieChart(document.getElementById('chart_dep'));
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
          ['เดือน','มูลค่าการรับ','มูลค่าการจ่าย'],
          ['ต.ค', <?php echo $medical_receive_M[10];?>,<?php echo $medical_receive_M[10]; ?>],
          ['พ.ย', <?php echo $medical_receive_M[11]; ?>,<?php echo $medical_receive_M[11]; ?>],
          ['ธ.ค', <?php echo  $medical_receive_M[12];?>,<?php echo $medical_receive_M[12]; ?>],
          ['ม.ค', <?php echo $medical_receive_M[1]; ?>,<?php echo $medical_receive_M[1]; ?>],
          ['ก.พ', <?php echo $medical_receive_M[2]; ?>,<?php echo $medical_receive_M[2]; ?>],
          ['มี.ค', <?php echo $medical_receive_M[3];?>,<?php echo $medical_receive_M[3]; ?>],
          ['เม.ย', <?php echo $medical_receive_M[4];?>,<?php echo $medical_receive_M[4]; ?>],
          ['พ.ค', <?php echo $medical_receive_M[5];?>,<?php echo $medical_receive_M[5]; ?>],
          ['มิ.ย', <?php echo $medical_receive_M[6];?>,<?php echo $medical_receive_M[6]; ?>],
          ['ก.ค', <?php echo $medical_receive_M[7];?>,<?php echo $medical_receive_M[7]; ?>],
          ['ส.ค', <?php echo $medical_receive_M[8];?>,<?php echo $medical_receive_M[8]; ?>],
          ['ก.ย', <?php echo $medical_receive_M[9];?>,<?php echo $medical_receive_M[9]; ?>],
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2,
            {
                calc: "stringify",
                sourceColumn: 2,
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
                title: 'เดือน',
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