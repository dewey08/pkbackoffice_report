@extends('layouts.env')
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
</style>
@endsection
@section('content')
<br>
<br>
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลสิ่งแวดล้อมและความปลอดภัย</h3>
        </div>
        <hr>
        <form action="{{ route('menv.dashboard_search') }}" method="post">
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
                            @if($budget == $yearbudget)
                            <option value="{{ $budget }}" selected>{{ $budget}}</option>
                            @else
                            <option value="{{ $budget  }}">{{ $budget}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1 text-center">
                    <span>
                        <button type="submit" class="btn btn-info fw-5 f-kanit">แสดง</button>
                    </span>
                </div>
            </div>
            
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ระบบไฟฟ้า<br> (จำนวนเช็ค)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$ele_count_check}} <span class="fs-20">{{number_format($ele_perworkyear,2)}}%</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-charging-station fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ระบบประปา<br> (จำนวนเช็ค)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$plum_count_check}} <span class="fs-20">{{number_format($plum_perworkyear,2)}}%</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-water fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-s3" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ระบบออกซิเจนเหลว <br>(จำนวนเช็ค)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$oxi_count_check}} <span class="fs-20">{{number_format($oxi_perworkyear,2)}}%</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-spray-can fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-o3" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ระบบบำบัดน้ำเสีย <br><span>(จำนวนนับรวมเช็ค 1 วัน)</span>
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$param_haveworkinday}} <span class="fs-20">{{number_format($param_perworkyear,2)}}%</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-leaf fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <hr>
            <h3 class="mt-2 fs-18 fw-8 f-kanit">ระบบบริหารจัดการขยะ</h3>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ขยะทั่วไป (ตัน)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($trash_gernaral/1000,2)}}
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-trash fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y4" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ขยะรีไซเคิล (บาท)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($trash_recycle,2)}}
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-recycle fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-yg3" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ขยะอินทรีย์ (ตัน)
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($trash_organic/1000,2)}}
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-fish fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r4" >
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ขยะอันตราย (ตัน)
                                </p>
                                <p class="text-skull-crossbones mb-0 text-white" style="font-size: 2.25rem;">
                                    {{number_format($trash_hazardous/1000,2)}}
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-skull-crossbones fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div> 
        <div class="block block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบสิ่งแวดล้อมและความปลอดภัย</h3>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-p4">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราส่วนสิ่งแวดล้อมและความปลอดภัยรวม (ยกเว้นขยะ)
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_electrical" style="width: 100%; height:500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-p4">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">เทียบอัตราส่วน ขยะติดเชื้อ-ขยะอันตราย (kg.)</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                <div id="chart_trash" style="width: 100%; height: 500px;"></div>
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
            ['ระบบบำบัดน้ำเสีย', <?=$param_perworkyear?>],
            ['ระบบออกซิเจนเหลว', <?=$oxi_perworkyear?>],
            ['ระบบประปา', <?=$plum_perworkyear?>],
            ['ระบบไฟฟ้า ', <?=$ele_perworkyear?>],
            
            
            
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
        var chart = new google.visualization.PieChart(document.getElementById('chart_electrical'));
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
            ['ขยะติดเชื้อ',     <?php echo $trash_infected; ?>],
            ['ขยะอันตราย',     <?php echo $trash_hazardous; ?>],
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
        var chart = new google.visualization.PieChart(document.getElementById('chart_trash'));
        chart.draw(data, options);
    }
</script>
@endsection