@extends('layouts.repaircom')
@section('css_before')
<?php
    $status  = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url     = Request::url();
    $pos     = strrpos($url, '/') + 1;
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
<div class="block" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24" style="font-family: 'Kanit', sans-serif;">ข้อมูลการซ่อมคอมพิวเตอร์
            </h3>
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
            <div class="row">
                <div class="col-md-12">
                    <a class="block block-rounded block-link-pop bg-sl2-b3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=all')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    งานซ่อมทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_all}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-folder-open fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=REQUEST')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ร้องขอ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_request}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-envelope fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y2"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=RECEIVE')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    รับเรื่อง
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_receive}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-envelope-open fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-s3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=PENDING')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    กำลังซ่อม
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_pending}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-wrench fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=SUCCESS')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ซ่อมเสร็จแล้ว
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_success}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-sb3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=OUTSIDE')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ส่งซ่อมภายนอก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_outside}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-truck fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-o3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=DEAL')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    จำหน่าย
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_deal}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-dollar-sign fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r2"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=REPAIR_OUT')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    แจ้งยกเลิก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_repair_out}} <span class="fs-13">รายการ</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-times fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r3"
                        href="{{url('manager_repaircom/repaircom_search?budgetyear='.$budgetyear.'&repairstatus=CANCEL')}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ยกเลิก
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$repairstatus_cancel}} <span class="fs-13">รายการ</span>
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
        <div class="block-content shadow my-3">
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
                                            {{$reapaircom_day}}
                                        </p>
                                    </td>
                                    <td width="">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            เดือนนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$reapaircom_month}}
                                        </p>
                                    </td>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            ปีนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$reapaircom_year}}
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
                                        <!-- <div class="fs-14 position-absolute" style="bottom:0px;right:4px">**ยังไม่มีการสรุปผล</div> -->
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
                                            {{$reapaircomPlan_day}}
                                        </p>
                                    </td>
                                    <td width="">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            เดือนนี้
                                        </p>
                                        <p class=" mb-0" style="font-size: 2.70rem;">
                                            {{$reapaircomPlan_month}}
                                        </p>
                                    </td>
                                    <td width="33%">
                                        <p class="text-uppercase mb-0" style="font-size: 1.30rem;">
                                            ปีนี้
                                        </p>
                                        <p class="mb-0" style="font-size: 2.70rem;">
                                            {{$reapaircomPlan_year}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-content shadow my-3">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบซ่อมคอมพิวเตอร์</h3>
            <hr>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-o2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนงานซ่อมบำรุงของช่าง
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="workofperson_pie"
                                style="font-family:'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                            อัตราความพึงพอใจต่อการซ่อมบำรุง
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="Fanciness_score_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                            จำนวนส่งซ่อมประจำปีงบประมาณทั้งหมด
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="repaircom_M_column"
                                style="font-family:'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                            จำนวนส่งซ่อมที่เสร็จแล้วประจำปีงบประมาณ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="repaircom_M_success_column" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราสถานะงานซ่อมบำรุง
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="perRepairStatus_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-g2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราสถานะซ่อมเอง
                            และส่งซ่อม
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="perRepair_success_outside_pie" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-y2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                            จำนวนแผนงานบำรุงรักษาประจำปีงบประมาณ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="repaircomPlan_column" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl-y2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการบำรุงรักษา
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="perRepairPlan_Result_pie" style="width: 100%; height: 500px;"></div>
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
            height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('workofperson_pie'));
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
            ['เดือน', 'จำนวนแผนบำรุงรักษา'],
            ['ต.ค', <?php echo $countRepairPlan_M[10]; ?> ],
            ['พ.ย', <?php echo $countRepairPlan_M[11]; ?> ],
            ['ธ.ค', <?php echo $countRepairPlan_M[12]; ?> ],
            ['ม.ค', <?php echo $countRepairPlan_M[1]; ?> ],
            ['ก.พ', <?php echo $countRepairPlan_M[2]; ?> ],
            ['มี.ค', <?php echo $countRepairPlan_M[3]; ?> ],
            ['เม.ย', <?php echo $countRepairPlan_M[4]; ?> ],
            ['พ.ค', <?php echo $countRepairPlan_M[5]; ?> ],
            ['มิ.ย', <?php echo $countRepairPlan_M[6]; ?> ],
            ['ก.ค', <?php echo $countRepairPlan_M[7]; ?> ],
            ['ส.ค', <?php echo $countRepairPlan_M[8]; ?> ],
            ['ก.ย', <?php echo $countRepairPlan_M[9]; ?> ]
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
        var chart = new google.visualization.ColumnChart(document.getElementById('repaircomPlan_column'));
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
            ['ต.ค', <?php echo $repaircom_M[10]; ?> ],
            ['พ.ย', <?php echo $repaircom_M[11]; ?> ],
            ['ธ.ค', <?php echo $repaircom_M[12]; ?> ],
            ['ม.ค', <?php echo $repaircom_M[1]; ?> ],
            ['ก.พ', <?php echo $repaircom_M[2]; ?> ],
            ['มี.ค', <?php echo $repaircom_M[3]; ?> ],
            ['เม.ย', <?php echo $repaircom_M[4]; ?> ],
            ['พ.ค', <?php echo $repaircom_M[5]; ?> ],
            ['มิ.ย', <?php echo $repaircom_M[6]; ?> ],
            ['ก.ค', <?php echo $repaircom_M[7]; ?> ],
            ['ส.ค', <?php echo $repaircom_M[8]; ?> ],
            ['ก.ย', <?php echo $repaircom_M[9]; ?> ]
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
        var chart = new google.visualization.ColumnChart(document.getElementById('repaircom_M_column'));
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
            ['เดือน', 'จำนวนงานซ่อมที่เสร็จแล้ว'],
            ['ต.ค', <?php echo $repaircom_M_success[10]; ?> ],
            ['พ.ย', <?php echo $repaircom_M_success[11]; ?> ],
            ['ธ.ค', <?php echo $repaircom_M_success[12]; ?> ],
            ['ม.ค', <?php echo $repaircom_M_success[1]; ?> ],
            ['ก.พ', <?php echo $repaircom_M_success[2]; ?> ],
            ['มี.ค', <?php echo $repaircom_M_success[3]; ?> ],
            ['เม.ย', <?php echo $repaircom_M_success[4]; ?> ],
            ['พ.ค', <?php echo $repaircom_M_success[5]; ?> ],
            ['มิ.ย', <?php echo $repaircom_M_success[6]; ?> ],
            ['ก.ค', <?php echo $repaircom_M_success[7]; ?> ],
            ['ส.ค', <?php echo $repaircom_M_success[8]; ?> ],
            ['ก.ย', <?php echo $repaircom_M_success[9]; ?> ]
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
        var chart = new google.visualization.ColumnChart(document.getElementById('repaircom_M_success_column'));
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
            ['ร้องขอ', <?php echo $repairstatus_request; ?> ],
            ['รับเรื่อง', <?php echo $repairstatus_receive; ?> ],
            ['กำลังซ่อม', <?php echo $repairstatus_pending; ?> ],
            ['ซ่อมเสร็จแล้ว', <?php echo $repairstatus_success; ?> ],
            ['ส่งซ่อมภายนอก', <?php echo $repairstatus_outside; ?> ],
            ['จำหน่าย', <?php echo $repairstatus_deal; ?> ],
            ['แจ้งยกเลิก', <?php echo $repairstatus_repair_out; ?> ],
            ['ยกเลิก', <?php echo $repairstatus_cancel; ?> ]
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
        var chart = new google.visualization.PieChart(document.getElementById('perRepairStatus_pie'));
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
            ['ซ่อมเอง', <?php echo $repairstatus_success; ?>],
            ['ส่งซ่อม', <?php echo $repairstatus_outside; ?>]
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
        var chart = new google.visualization.PieChart(document.getElementById('perRepair_success_outside_pie'));
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
            ['ต้องปรับปรุง', <?=$repaircom_score[1]?>],
            ['พอใช้', <?=$repaircom_score[2]?>],
            ['ปานกลาง', <?=$repaircom_score[3]?>],
            ['ดี', <?=$repaircom_score[4]?>],
            ['ดีมาก', <?=$repaircom_score[5]?>]
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

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['การบำรุงรักษา', 'จำนวนร้อยละ'],
            ['บำรุงรักษา', <?=$repaircomPlan_result['result_have']?>],
            ['ไมไ่ด้บำรุงรักษา', <?=$repaircomPlan_result['result_null']?>]
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
        var chart = new google.visualization.PieChart(document.getElementById('perRepairPlan_Result_pie'));
        chart.draw(data, options);
    }
</script>
@endsection