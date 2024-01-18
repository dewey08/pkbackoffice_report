@extends('layouts.compensation')
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
<br>
<br>
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลเงินเดือนค่าตอบแทน</h3>
        </div>
        <hr>
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
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
                        <button type="submit" class="btn btn-info"
                            style="font-family: 'Kanit', sans-serif;font-weight:normal;">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-4">
                    <a class="block block-rounded block-link-pop bg-sl2-g3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                รายการรับบุคคล
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($count1,2)}} <span class="fs-13">บาท</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-book fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-4">
                    <a class="block block-rounded block-link-pop bg-sl2-r3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                รายการจ่ายบุคคล
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($count2,2)}} <span class="fs-13">บาท</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-paper-plane fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-4">
                    <a class="block block-rounded block-link-pop bg-sl2-y3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                รายการรับสุทธิบุคคล
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($count3,2)}} <span class="fs-13">บาท</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-inbox fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบเงินเดือนค่าตอบแทน</h3>
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-p3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนมูลรายรับบุคคล (บาท)
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center p-3" style="overflow-y:hidden">
                            <div id="columnchart_01"
                                style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-p3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนมูลรายจ่ายบุคคล (บาท)
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center p-3" style="overflow-y:hidden">
                            <div id="columnchart_02"
                                style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
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
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เดือน','มูลค่า'],
          ['ต.ค', <?php echo $m10_1;?>],
          ['พ.ย', <?php echo $m11_1; ?>],
          ['ธ.ค', <?php echo  $m12_1;?>],
          ['ม.ค', <?php echo $m1_1; ?>],
          ['ก.พ', <?php echo $m2_1; ?>],
          ['มี.ค', <?php echo $m3_1;?>],
          ['เม.ย', <?php echo $m4_1;?>],
          ['พ.ค', <?php echo $m5_1;?>],
          ['มิ.ย', <?php echo $m6_1;?>],
          ['ก.ค', <?php echo $m7_1;?>],
          ['ส.ค', <?php echo $m8_1;?>],
          ['ก.ย', <?php echo $m9_1;?>],
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
            // colors: ['#82b54b'],
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_01'));
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
          ['เดือน','มูลค่า'],
          ['ต.ค', <?php echo $m10_2;?>],
          ['พ.ย', <?php echo $m11_2; ?>],
          ['ธ.ค', <?php echo  $m12_2;?>],
          ['ม.ค', <?php echo $m1_2; ?>],
          ['ก.พ', <?php echo $m2_2; ?>],
          ['มี.ค', <?php echo $m3_2;?>],
          ['เม.ย', <?php echo $m4_2;?>],
          ['พ.ค', <?php echo $m5_2;?>],
          ['มิ.ย', <?php echo $m6_2;?>],
          ['ก.ค', <?php echo $m4_2;?>],
          ['ส.ค', <?php echo $m8_2;?>],
          ['ก.ย', <?php echo $m9_2;?>],
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
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_02'));
        chart.draw(view, options);
    }
</script>
@endsection