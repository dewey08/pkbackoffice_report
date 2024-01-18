@extends('layouts.risk')
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
            word-wrap:break-word;
            }
        .text{
            font-family: 'Kanit', sans-serif;                    
            }
        .ex1 {
            margin-top: 1000px;
    }
</style>
@endsection
@section('content')
<br>
<br>

<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">สถิติข้อมูลอุบัติการณ์ความเสี่ยง</h3>
        </div>
        <hr>
        <form  action="{{ route('mrisk.dashboard') }}" method="get">
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ข้อมูลประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"> 
                            @foreach ($budgetyear_dropdown as $budget)
                                @if($budget === (int) $budgetyear)
                                    <option value="{{ $budget }}" selected>{{ $budget}}</option>
                                @else
                                    <option value="{{ $budget }}">{{ $budget}}</option>
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
            <h3 class="fs-18 fw-5">เฝ้าระวังอุบัติการณ์ความรุนแรง</h3>
            <div class="row mb-2">
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-sb4">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    รายงานทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                   {{$inforisk}}<span class="fs-16"> รายงาน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-book fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y4">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ความเสี่ยงระดับ 3,4,5
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$inforisk_1}}<span class="fs-16"> รายงาน </span>
                                    <span class="fs-18">({{number_format($inforisk_1/$inforisk,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-paper-plane fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r2">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ความเสี่ยงระดับ G,H,I
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$inforisk_2}}<span class="fs-16"> รายงาน </span>
                                  <span class="fs-18">({{number_format($inforisk_2/$inforisk,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-inbox fs-30 text-white"></i> 
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-r4">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ความเสี่ยงระดับ E,F
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$inforisk_3}} <span class="fs-16"> รายงาน </span>
                                     <span class="fs-18">({{number_format($inforisk_3/$inforisk,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-friends fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <h3 class="fs-18 fw-5">ติดตามและเฝ้าระวังรายงานอุบัติการณ์ความเสี่ยง</h3>
            <div class="row mb-2">
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-s4">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    รายงานอุบัติการณ์ความเสี่ยงใหม่วันนี้
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$infotodate}}<span class="fs-16"> รายงาน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-book fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-pir1">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ความเสี่ยง รอตรวจสอบ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                     {{$infostatus1}}<span class="fs-16"> รายงาน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-paper-plane fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-p5">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                 ความเสี่ยง รอยืนยัน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$infostatus2}}<span class="fs-16"> รายงาน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-inbox fs-30 text-white"></i> 
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g4">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ความเสี่ยง รอสรุปผล
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$infostatus3}}<span class="fs-16"> รายงาน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-user-friends fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-p3 mb-2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                           อุบัติการณ์ความเสี่ยงแยกตามระดับ A-I
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_1" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>   
                <div class="col-md-6 mb-2"> 
                    <div class="panel p-1 bg-sl2-p3 mb-2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                            อุบัติการณ์ความเสี่ยงแยกตามระดับ 1-5</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart_2" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row mb-3">
        <div class="col-xl-12 mb-4" style="overflow-y:hidden">
            <div class="panel p-1 bg-sl-blue">
                <div class="panel-heading py-3 text-left text-white pl-5 ">แผนภูมิแสดงจำนวนรายงานอุบัติการณ์ความเสี่ยง แยกรายเดือน ปีงบประมาณ {{ $budgetyear}}</div>
                <div class="panel-body bg-white">
                    <div id="departments_chart01" style="font-family: 'Kanit', sans-serif;width: 100%; height:500px">
                </div>
            </div>
        </div>

        <br>

        @foreach ($infogroup_teams as $infogroupteam)
        <?php $data_02[] = array($infogroupteam->RISK_REP_TEAMLIST_NAME,$infogroupteam->total); ?> 
        @endforeach

        <div class="row mb-3">
            <div class="col-xl-12 mb-4" style="overflow-y:hidden">
                <div class="panel p-1 bg-sl-blue">
                    <div class="panel-heading py-3 text-left text-white pl-5 ">แผนภูมิแสดงจำนวนรายงานอุบัติการณ์ความเสี่ยง แยกรายทีมประสาน ปีงบประมาณ {{ $budgetyear}}</div>
                    <div class="panel-body bg-white">
                        <div id="departments_chart02" style="font-family: 'Kanit', sans-serif;width: 100%; height:500px">
                    </div>
                </div>
            </div>
            <br>


            @foreach ($infogroup_devs as $infogroupdev)
            <?php $data_03[] = array($infogroupdev->RISK_REP_DEPARTMENT_SUBNAME,$infogroupdev->total); ?> 
            @endforeach

            <div class="row mb-3">
                <div class="col-xl-12 mb-4" style="overflow-y:hidden">
                    <div class="panel p-1 bg-sl-blue">
                        <div class="panel-heading py-3 text-left text-white pl-5 ">แผนภูมิแสดงจำนวนรายงานอุบัติการณ์ความเสี่ยง แยกรายหน่วยงาน ปีงบประมาณ {{ $budgetyear}}</div>
                        <div class="panel-body bg-white">
                            <div id="departments_chart03" style="font-family: 'Kanit', sans-serif;width: 100%; height:500px">
                        </div>
                    </div>
                </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('google/Charts.js') }}"></script>


<script type="text/javascript">
  google.charts.load('current', {
        'packages': ['corechart']
    });


   
        
google.charts.setOnLoadCallback(drawChart1);
function drawChart1() {
    var data = google.visualization.arrayToDataTable([
        ['ระดับ', 'จำนวนรายการ'],
      ['A', <?php echo $lev_A; ?> ],
      ['B', <?php echo $lev_B; ?> ],
      ['C', <?php echo $lev_C; ?> ],
      ['D', <?php echo $lev_D; ?> ],
      ['E', <?php echo $lev_E; ?> ],
      ['F', <?php echo $lev_F; ?> ],
      ['G', <?php echo $lev_G; ?> ],
      ['H', <?php echo $lev_H; ?> ],
      ['I', <?php echo $lev_I; ?> ],]);
    
    var options = {
        // colors: ['#F67A37','#9BD770'],
        fontSize: 16,
        legend: {
            position: "top",
            alignment: "center"
        },
        fontName: 'Kanit',
        pieHole: 0.4,
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_1'));
    chart.draw(data, options);
}


google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
    var data = google.visualization.arrayToDataTable([
   


      ['ระดับ', 'จำนวนรายการ'],
      ['1', <?php echo $lev_1; ?> ],
      ['2', <?php echo $lev_2; ?> ],
      ['3', <?php echo $lev_3; ?> ],
      ['4', <?php echo $lev_4; ?> ],
      ['5', <?php echo $lev_5; ?> ],]);
    
    var options = {
        // colors: ['#F67A37','#9BD770'],
        fontSize: 16,
        legend: {
            position: "top",
            alignment: "center"
        },
        fontName: 'Kanit',
        pieHole: 0.4,
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_2'));
    chart.draw(data, options);
}


//============================================ chat01================================
google.charts.setOnLoadCallback(drawChart01);
    function drawChart01() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'เดือน');
            data.addColumn('number', 'จำนวน');
            data.addRows([
                ['ตุลาคม', {{$month10}}], 
                ['พฤศจิกายน', {{$month11}}], 
                ['ธันวาคม', {{$month12}}], 
                ['มกราคม',{{$month01}}], 
                ['กุมภาพันธ์',{{$month02}}],  
                ['มีนาคม',{{$month03}}],  
                ['เมษายน',{{$month04}}], 
                ['พฤษภาคม',{{$month05}}], 
                ['มิถุนายน', {{$month06}}], 
                ['กรกฎาคม', {{$month07}}], 
                ['สิงหาคม', {{$month08}}], 
                ['กันยายน', {{$month09}}], 
              
            
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
                colors:['#5DADE2'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "40%"
                },
                height: '90%',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'เดือน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('departments_chart01'));
            chart.draw(view, options);
        }


        
//============================================ chat02================================
google.charts.setOnLoadCallback(drawChart02);
    function drawChart02() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'ทีมประสาน');
            data.addColumn('number', 'จำนวน');
            data.addRows(   <?php
            echo json_encode($data_02);
            ?>);

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
                colors:['#C39BD3'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "40%"
                },
                height: '90%',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'ทีมประสาน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('departments_chart02'));
            chart.draw(view, options);
        }



        
//============================================ chat03================================
google.charts.setOnLoadCallback(drawChart03);
    function drawChart03() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'หน่วยงาน');
            data.addColumn('number', 'จำนวน');
            data.addRows(   <?php
            echo json_encode($data_03);
            ?>);

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
                colors:['#76D7C4'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "40%"
                },
                height: '90%',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'หน่วยงาน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('departments_chart03'));
            chart.draw(view, options);
        }


</script>
@endsection