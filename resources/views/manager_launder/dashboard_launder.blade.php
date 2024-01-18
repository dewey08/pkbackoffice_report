@extends('layouts.launder')
@section('css_before')
<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
?>
<style>
    body * {
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
            <h3 class="block-title text-center fs-24">ข้อมูลซักฟอก</h3>
        </div>
        <hr>
        <form method="post">
        @csrf
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ข้อมูลประจำปี : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">   
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
                <div class="col-md-1 text-center">
                    <span>
                        <button type="submit" class="btn btn-info fw-5 f-kanit">แสดง</button>
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
                                รับผ้า
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$getbacks}} <span class="fs-13">{{--หน่วยนับ--}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-book fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ตรวจรับผ้า
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$checks}} <span class="fs-13">{{--หน่วยนับ--}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-paper-plane fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ส่งผ้า
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$diss}} <span class="fs-13">{{--หน่วยนับ--}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-inbox fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                เบิก-จ่าย
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$withdrows}} <span class="fs-13">{{--หน่วยนับ--}}</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-hand-point-up fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content my-3 shadow ">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบซักฟอก</h3>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">รายการหน่วยงานที่รับผ้า</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_dep" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">รายการหน่วยงานที่ตรวจรับ</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_checkdep" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">รายการหน่วยงานที่ส่งผ้า</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_dis" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">รายการหน่วยงานที่เบิก-จ่าย</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_withdrow" style="width: 100%; height: 500px;"></div>
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
          ['บริหารกลุ่มการพยาบาล', <?php echo $d_1; ?>], ['งานอุบัติเหตุฉุกเฉิน', <?php echo $d_2; ?>], ['งานวิสัญญี', <?php echo $d_3; ?>], ['งานห้องผ่าตัด', <?php echo $d_4; ?>], ['งานห้องคลอด', <?php echo $d_5; ?>],
          ['งานผู้ป่วยใน 1', <?php echo $d_6; ?>], ['งานผู้ป่วยใน 2', <?php echo $d_7; ?>], ['งานผู้ป่วยใน 3', <?php echo $d_8; ?>], ['งานผู้ป่วยนอก', <?php echo $d_9; ?>], ['งานให้คำปรึกษา', <?php echo $d_10; ?>],
          ['งานเคลื่อนย้ายผู้ป่วย', <?php echo $d_11; ?>], ['งานจ่ายกลาง', <?php echo $d_12; ?>], ['งานบริการอาหาร ', <?php echo $d_13; ?>], ['ฝ่ายบริหารงานทั่วไป', <?php echo $d_14; ?>], ['งานการเงิน', <?php echo $d_15; ?>],
          ['ART-งานพัสดุ', <?php echo $d_16; ?>], ['BOO-งานธุรการ', <?php echo $d_17; ?>], ['CAL-งานซ่อมบำรุง ', <?php echo $d_18; ?>], ['AMB-งานยานพาหนะ', <?php echo $d_19; ?>], ['GAR-งานภูมิทัศน์', <?php echo $d_20; ?>],
          ['CLC-งานซักฟอก', <?php echo $d_21; ?>], ['SEC-งานรักษาความปลอดภัย', <?php echo $d_22; ?>], ['CLE-งานทำความสะอาด ', <?php echo $d_23; ?>], ['MED-งานเวชปฏิบัติทั่วไป', <?php echo $d_24; ?>], ['XRA-งานรังสี', <?php echo $d_25; ?>],
          ['LAB-งานเทคนิคการแพทย์', <?php echo $d_26; ?>], ['TTM-งานแพทย์แผนไทย', <?php echo $d_27; ?>], ['PLA-ฝ่ายแผนงานและประเมินผล', <?php echo $d_28; ?>], ['COM-งานศูนย์คอมพิวเตอร์', <?php echo $d_29; ?>], ['HAC-งานศูนย์ประกันสุขภาพ', <?php echo $d_30; ?>],
          ['MRD-งานเวชระเบียน', <?php echo $d_31; ?>], ['FMC-ฝ่ายเวชปฏิบัติครอบครัว', <?php echo $d_32; ?>], ['PHA-ฝ่ายเภสัชกรรมชุมชน', <?php echo $d_33; ?>], ['PTD-ฝ่ายเวชกรรมฟื้นฟู', <?php echo $d_34; ?>], ['FUN-ฝ่ายทันตสาธารณสุข', <?php echo $d_35; ?>],
          ['HED-งานสุขศึกษาและประชาสัมพันธ์', <?php echo $d_36; ?>],
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
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
          ['หน่วยงานภายใน',     <?php echo $o_1; ?>],
          ['หน่วยงานภายนอก',     <?php echo $o_2; ?>],
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
          ['บริหารกลุ่มการพยาบาล', <?php echo $di_1; ?>], ['งานอุบัติเหตุฉุกเฉิน', <?php echo $di_2; ?>], ['งานวิสัญญี', <?php echo $di_3; ?>], ['งานห้องผ่าตัด', <?php echo $di_4; ?>], ['งานห้องคลอด', <?php echo $di_5; ?>],
          ['งานผู้ป่วยใน 1', <?php echo $di_6; ?>], ['งานผู้ป่วยใน 2', <?php echo $di_7; ?>], ['งานผู้ป่วยใน 3', <?php echo $di_8; ?>], ['งานผู้ป่วยนอก', <?php echo $di_9; ?>], ['งานให้คำปรึกษา', <?php echo $di_10; ?>],
          ['งานเคลื่อนย้ายผู้ป่วย', <?php echo $di_11; ?>], ['งานจ่ายกลาง', <?php echo $di_12; ?>], ['งานบริการอาหาร ', <?php echo $di_13; ?>], ['ฝ่ายบริหารงานทั่วไป', <?php echo $di_14; ?>], ['งานการเงิน', <?php echo $di_15; ?>],
          ['ART-งานพัสดุ', <?php echo $di_16; ?>], ['BOO-งานธุรการ', <?php echo $di_17; ?>], ['CAL-งานซ่อมบำรุง ', <?php echo $di_18; ?>], ['AMB-งานยานพาหนะ', <?php echo $di_19; ?>], ['GAR-งานภูมิทัศน์', <?php echo $di_20; ?>],
          ['CLC-งานซักฟอก', <?php echo $di_21; ?>], ['SEC-งานรักษาความปลอดภัย', <?php echo $di_22; ?>], ['CLE-งานทำความสะอาด ', <?php echo $di_23; ?>], ['MED-งานเวชปฏิบัติทั่วไป', <?php echo $di_24; ?>], ['XRA-งานรังสี', <?php echo $di_25; ?>],
          ['LAB-งานเทคนิคการแพทย์', <?php echo $di_26; ?>], ['TTM-งานแพทย์แผนไทย', <?php echo $di_27; ?>], ['PLA-ฝ่ายแผนงานและประเมินผล', <?php echo $di_28; ?>], ['COM-งานศูนย์คอมพิวเตอร์', <?php echo $di_29; ?>], ['HAC-งานศูนย์ประกันสุขภาพ', <?php echo $di_30; ?>],
          ['MRD-งานเวชระเบียน', <?php echo $di_31; ?>], ['FMC-ฝ่ายเวชปฏิบัติครอบครัว', <?php echo $di_32; ?>], ['PHA-ฝ่ายเภสัชกรรมชุมชน', <?php echo $di_33; ?>], ['PTD-ฝ่ายเวชกรรมฟื้นฟู', <?php echo $di_34; ?>], ['FUN-ฝ่ายทันตสาธารณสุข', <?php echo $di_35; ?>],
          ['HED-งานสุขศึกษาและประชาสัมพันธ์', <?php echo $di_36; ?>],
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
        var chart = new google.visualization.PieChart(document.getElementById('chart_dis'));
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
          ['บริหารกลุ่มการพยาบาล', <?php echo $dw_1; ?>], ['งานอุบัติเหตุฉุกเฉิน', <?php echo $dw_2; ?>], ['งานวิสัญญี', <?php echo $dw_3; ?>], ['งานห้องผ่าตัด', <?php echo $dw_4; ?>], ['งานห้องคลอด', <?php echo $dw_5; ?>],
          ['งานผู้ป่วยใน 1', <?php echo $dw_6; ?>], ['งานผู้ป่วยใน 2', <?php echo $dw_7; ?>], ['งานผู้ป่วยใน 3', <?php echo $dw_8; ?>], ['งานผู้ป่วยนอก', <?php echo $dw_9; ?>], ['งานให้คำปรึกษา', <?php echo $dw_10; ?>],
          ['งานเคลื่อนย้ายผู้ป่วย', <?php echo $dw_11; ?>], ['งานจ่ายกลาง', <?php echo $dw_12; ?>], ['งานบริการอาหาร ', <?php echo $dw_13; ?>], ['ฝ่ายบริหารงานทั่วไป', <?php echo $dw_14; ?>], ['งานการเงิน', <?php echo $dw_15; ?>],
          ['ART-งานพัสดุ', <?php echo $dw_16; ?>], ['BOO-งานธุรการ', <?php echo $dw_17; ?>], ['CAL-งานซ่อมบำรุง ', <?php echo $dw_18; ?>], ['AMB-งานยานพาหนะ', <?php echo $dw_19; ?>], ['GAR-งานภูมิทัศน์', <?php echo $dw_20; ?>],
          ['CLC-งานซักฟอก', <?php echo $dw_21; ?>], ['SEC-งานรักษาความปลอดภัย', <?php echo $dw_22; ?>], ['CLE-งานทำความสะอาด ', <?php echo $dw_23; ?>], ['MED-งานเวชปฏิบัติทั่วไป', <?php echo $dw_24; ?>], ['XRA-งานรังสี', <?php echo $dw_25; ?>],
          ['LAB-งานเทคนิคการแพทย์', <?php echo $dw_26; ?>], ['TTM-งานแพทย์แผนไทย', <?php echo $dw_27; ?>], ['PLA-ฝ่ายแผนงานและประเมินผล', <?php echo $dw_28; ?>], ['COM-งานศูนย์คอมพิวเตอร์', <?php echo $dw_29; ?>], ['HAC-งานศูนย์ประกันสุขภาพ', <?php echo $dw_30; ?>],
          ['MRD-งานเวชระเบียน', <?php echo $dw_31; ?>], ['FMC-ฝ่ายเวชปฏิบัติครอบครัว', <?php echo $dw_32; ?>], ['PHA-ฝ่ายเภสัชกรรมชุมชน', <?php echo $dw_33; ?>], ['PTD-ฝ่ายเวชกรรมฟื้นฟู', <?php echo $dw_34; ?>], ['FUN-ฝ่ายทันตสาธารณสุข', <?php echo $dw_35; ?>],
          ['HED-งานสุขศึกษาและประชาสัมพันธ์', <?php echo $dw_36; ?>],
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
        var chart = new google.visualization.PieChart(document.getElementById('chart_withdrow'));
        chart.draw(data, options);
    }
</script>
@endsection