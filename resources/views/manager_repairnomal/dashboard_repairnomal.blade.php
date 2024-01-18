@extends('layouts.repairnomal')
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
<!-- /////// เนื้อหา /////// -->
<div class="d-flex justify-content-center">
    <div class="block block-content mb-4" style="width: 95%;">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลการซ่อมทั่วไป</h3>
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
        <div class="block-content mt-3 mb-4 shadow">
            <div class="row"> 
                <div class="col-md-12">
                    <a class="block block-rounded block-link-pop bg-sl2-b3" href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=all')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    งานซ่อมทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_AllStatus}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-folder-open fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=REQUEST')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ร้องขอ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_1}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-envelope fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y2"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=RECEIVE')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    รับเรื่อง
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_2}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-envelope-open fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-s3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=PENDING')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                กำลังซ่อม
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_3}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-wrench fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=SUCCESS')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ซ่อมเสร็จแล้ว
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_4}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-sb3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=OUTSIDE')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ส่งซ่อมภายนอก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_5}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-truck fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-o3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=DEAL')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    จำหน่าย
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_6}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-dollar-sign fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r2"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=REPAIR_OUT')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    แจ้งยกเลิก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_7}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-times fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r3"  href="{{url('manager_repairnomal/repairnomal_search?budgetyear='.$budgetyear.'&repairstatus=CANCEL')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                ยกเลิก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repaire_status_8}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-times fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content mb-4 shadow">
            <div style="text-align: center;">
                <div class="row gutters-tiny">
                    <div class="col-md-6">
                        <table class="table table-bordered table-white ">
                            <thead>
                                <tr>
                                    <th colspan="3" class="position-relative">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            งานซ่อมบำรุง
                                        </p>
                                        <i class="far fa-5x fa fa-wrench text-success"></i>
                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            วันนี้
                                        </p>
                                        <p class="text-uppercase mb-0" style="font-size: 2.70rem;">
                                            {{$repaire_today_request}}
                                        </p>
                                    </td>
                                    <td width="">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            เดือนนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$repaire_tomonth_request}}
                                        </p>
                                    </td>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            ปีนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$repaire_toyear_request}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-white ">
                            <thead>
                                <tr>
                                    <th colspan="3" class="position-relative">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            งานบำรุงรักษา
                                        </p>
                                        <i class="far fa-5x fa fa-cogs text-warning"></i>
                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            วันนี้
                                        </p>
                                        <p class="text-uppercase mb-0" style="font-size: 2.70rem;">
                                            {{$repairePlan_today_request}}
                                        </p>
                                    </td>
                                    <td width="">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            เดือนนี้
                                        </p>
                                        <p class=" mb-0" style="font-size: 2.70rem;">
                                            {{$repairePlan_tomonth_request}}
                                        </p>
                                    </td>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            ปีนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$repairePlan_toyear_request}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content mb-4 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบซ่อมทั่วไป</h3>
            <hr>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl2-o2 p-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนงานซ่อมบำรุงของช่าง
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="workTech_pie" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-g2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">อัตราความพึงพอใจต่อการซ่อมบำรุง</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="Fanciness_score_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-g2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">จำนวนส่งซ่อมประจำปีงบประมาณทั้งหมด</div>
                        <div class="pane-body bg-white d-flex justify-content-center position-relative" style="overflow-y:hidden">
                            <div id="inforrepair_M"
                                style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                                <div class="position-absolute" style="bottom:0;right:4px">**รวมข้อมูลที่มีการยกเลิก</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-g2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">จำนวนส่งซ่อมที่เสร็จแล้วประจำปีงบประมาณ</div>
                        <div class="pane-body bg-white d-flex justify-content-center position-relative" style="overflow-y:hidden">
                            <div id="informrepair_success_M"
                                style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-g2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">อัตราสถานะงานซ่อมบำรุง</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="Per_inforrepairByStatus_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-g2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">อัตราสถานะซ่อมเอง และส่งซ่อม</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="Per_inforrepairByoutside_sucess_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-y2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">จำนวนบำรุงรักษาประจำปีงบประมาณ</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="inforrepairPlan_M"
                                style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel bg-sl-y2 p-1">
                        <div class="pane-heading py-2 px-3 text-white">อัตราการบำรุงรักษา</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="informrepairPlan_result_pie" style="width: 100%; height: 500px;"></div>
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
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['รายชื่อช่าง','จำนวนงาน'],
            @foreach($workofperson as $row)
            ['{{$row['name']}}',{{$row['amount']}}],
            @endforeach
        ]);
        var options = {
            // title: '......',   
            height: '500',
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('workTech_pie'));
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
            ['เดือน', 'จำนวนงานซ่อมที่เสร็จแล้ว'],
            ['ต.ค', <?php echo $informrepair_success_M[10]; ?> ],
            ['พ.ย', <?php echo $informrepair_success_M[11]; ?> ],
            ['ธ.ค', <?php echo $informrepair_success_M[12]; ?> ],
            ['ม.ค', <?php echo $informrepair_success_M[1]; ?> ],
            ['ก.พ', <?php echo $informrepair_success_M[2]; ?> ],
            ['มี.ค', <?php echo $informrepair_success_M[3]; ?> ],
            ['เม.ย', <?php echo $informrepair_success_M[4]; ?> ],
            ['พ.ค', <?php echo $informrepair_success_M[5]; ?> ],
            ['มิ.ย', <?php echo $informrepair_success_M[6]; ?> ],
            ['ก.ค', <?php echo $informrepair_success_M[7]; ?> ],
            ['ส.ค', <?php echo $informrepair_success_M[8]; ?> ],
            ['ก.ย', <?php echo $informrepair_success_M[9]; ?> ]
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
            colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวน',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('informrepair_success_M'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน', 'จำนวนงานซ่อมบำรุงทั้งหมด'],
            ['ต.ค', <?php echo $informrepair_M[10]; ?> ],
            ['พ.ย', <?php echo $informrepair_M[11]; ?> ],
            ['ธ.ค', <?php echo $informrepair_M[12]; ?> ],
            ['ม.ค', <?php echo $informrepair_M[1]; ?> ],
            ['ก.พ', <?php echo $informrepair_M[2]; ?> ],
            ['มี.ค', <?php echo $informrepair_M[3]; ?> ],
            ['เม.ย', <?php echo $informrepair_M[4]; ?> ],
            ['พ.ค', <?php echo $informrepair_M[5]; ?> ],
            ['มิ.ย', <?php echo $informrepair_M[6]; ?> ],
            ['ก.ค', <?php echo $informrepair_M[7]; ?> ],
            ['ส.ค', <?php echo $informrepair_M[8]; ?> ],
            ['ก.ย', <?php echo $informrepair_M[9]; ?> ]
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
            colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวน',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('inforrepair_M'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน', 'จำนวนแผนบำรุงรักษา'],
            ['ต.ค', <?php echo $informrepairPlan_M[10]; ?> ],
            ['พ.ย', <?php echo $informrepairPlan_M[11]; ?> ],
            ['ธ.ค', <?php echo $informrepairPlan_M[12]; ?> ],
            ['ม.ค', <?php echo $informrepairPlan_M[1]; ?> ],
            ['ก.พ', <?php echo $informrepairPlan_M[2]; ?> ],
            ['มี.ค', <?php echo $informrepairPlan_M[3]; ?> ],
            ['เม.ย', <?php echo $informrepairPlan_M[4]; ?> ],
            ['พ.ค', <?php echo $informrepairPlan_M[5]; ?> ],
            ['มิ.ย', <?php echo $informrepairPlan_M[6]; ?> ],
            ['ก.ค', <?php echo $informrepairPlan_M[7]; ?> ],
            ['ส.ค', <?php echo $informrepairPlan_M[8]; ?> ],
            ['ก.ย', <?php echo $informrepairPlan_M[9]; ?> ]
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
            colors: ['#ffb119'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวน',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('inforrepairPlan_M'));
        chart.draw(view, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['สถานะงานซ่อมบำรุง', 'จำนวนร้อยละ'],
            ['ร้องขอ', <?php echo $repaire_status_1; ?> ],
            ['รับเรื่อง', <?php echo $repaire_status_2; ?> ],
            ['กำลังซ่อม', <?php echo $repaire_status_3; ?> ],
            ['ซ่อมเสร็จแล้ว', <?php echo $repaire_status_4; ?> ],
            ['ส่งซ่อมภายนอก', <?php echo $repaire_status_5; ?> ],
            ['จำหน่าย', <?php echo $repaire_status_6; ?> ],
            ['แจ้งยกเลิก', <?php echo $repaire_status_7; ?> ],
            ['ยกเลิก', <?php echo $repaire_status_8; ?> ]
        ]);
        
        var options = {
            // title: '......',   
            height: '500',
            colors: ['#ffc94d','#ffd166','#4dc9ff','#80d980','#42a1ff','#ff944d','#ff8080','#ff6666'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('Per_inforrepairByStatus_pie'));
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
            ['รูปแบบการซ่อม', 'จำนวนร้อยละ'],
            ['ซ่อมเอง', <?php echo $repaire_status_4; ?>],
            ['ส่งซ่อม', <?php echo $repaire_status_5; ?>]
        ]);
        
        var options = {
            // title: '......',   
            height: '500',
            colors: ['#80d980','#42a1ff'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('Per_inforrepairByoutside_sucess_pie'));
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
            ['การบำรุงรักษา', 'จำนวนร้อยละ'],
            ['บำรุงรักษา', <?=$informrepair_result['result_have']?>],
            ['ไมไ่ด้บำรุงรักษา', <?=$informrepair_result['result_null']?>]
        ]);
        var options = {
            // title: '......',   
            height: '500',
            colors: ['#96ca4e','#ed2e35'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('informrepairPlan_result_pie'));
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
            ['ความพึงพอใจ', 'จำนวนร้อยละ'],
            ['ต้องปรับปรุง', <?=$informrepair_fanciness_score[1]?>],
            ['พอใช้', <?=$informrepair_fanciness_score[2]?>],
            ['ปานกลาง', <?=$informrepair_fanciness_score[3]?>],
            ['ดี', <?=$informrepair_fanciness_score[4]?>],
            ['ดีมาก', <?=$informrepair_fanciness_score[5]?>]
        ]);
        var options = {
            // title: '......',   
            height: '500',
            colors: ['#ed2e35','#f89b31','#f7c800','#96ca4e','#149c54'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('Fanciness_score_pie'));
        chart.draw(data, options);
    }
</script>
@endsection