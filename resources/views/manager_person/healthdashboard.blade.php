@extends('layouts.personhealth')
@section('css_before')
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
    .table-cont {
        max-height: 300px;
        overflow: auto;

        background: #ddd;
        margin: 20px 10px;
        box-shadow: 0 0 1px 3px #ddd;
    }
    .text-pedding {
        padding-left: 10px;
    }
    .text-font {
        font-size: 13px;
    }
</style>
<script>
    function checklogin() {
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
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสุขภาพประจำปี</B></h3>  
            </div>
            <div class="block-content">
            <form action="{{ route('health.healthdashboard_search') }}" method="post">
                    @csrf 
            <div class="row" >
        
           
                   
            <div class="col-md-2">
                &nbsp;ข้อมูลประจำปี : &nbsp;
            </div>
            <div class="col-md-2">
                <span>
                             <select name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">   
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
                        <button type="submit" class="btn btn-info f-kanit">แสดง</button>
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
                                    ไม่คัดกรอง
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$amontpersonnot}} <span class="fs-26">({{number_format(($amontpersonnot/$countperson)*100,2)}}%)</span>
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
                                คัดกรองสุขภาพ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$countpersonscreen}} <span class="fs-26">({{number_format(($countpersonscreen/$countperson)*100,2)}}%)</span>
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
                                ยืนยันยันการตรวจ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{($countpersonscon+$countpersonbody)}} <span class="fs-26">({{number_format((($countpersonscon+$countpersonbody)/$countperson)*100,2)}}%)</span>
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
                                    ตรวจร่างกาย
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$countpersonbody}} <span class="fs-26">({{number_format((($countpersonbody)/$countperson)*100,2)}}%)</span>
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
        <div class="block-content my-3 shadow">
            <h3 class="fs-18 fw-4">ดัชนีมวลกาย (BMI)</h3>
            <div class="row">
                <div class="col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-yg3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ไม่มีข้อมูล
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_6}} <span class="fs-26">({{number_format(($result_6/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-r3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    นน. ต่ำกว่าเกณฑ์
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_1}} <span class="fs-26">({{number_format(($result_1/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-y3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                สมส่วน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_2}} <span class="fs-26">({{number_format(($result_2/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-b3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                น้ำหนักเกิน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_3}} <span class="fs-26">({{number_format(($result_3/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-r3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                โรคอ้วน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_4}} <span class="fs-26">({{number_format(($result_4/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-2">
                    <a class="block block-rounded block-link-pop bg-sl2-g3">
                        <div class="block-content d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                โรคอ้วนอันตราย
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$result_5}} <span class="fs-26">({{number_format(($result_5/$countpersonscreen)*100,2)}}%)</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <!-- <i class="fa fa-inbox fs-30 text-white"></i> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content my-3 shadow">
            <h3 class="fs-18 fw-4">ข้อมูลแผนภูมิการตรวจสุขภาพประจำปี</h3>
            <div class="row mb-2">
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">ดัชนีมวลกาย BMI
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="donutchart_1" style = "width: 49%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">สรุปผลตรวจร่างกาย
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="donutchart_2" style = "width: 49%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนบุคลากรที่รับการตรวจ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id = "container" style = "width: 95%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-o3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">ประวัติการเจ็บป่วย
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="Illness_history" style = "width: 95%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<?php $data[] = array('หน่วยงาน','ตรวจแล้ว','ยังไม่ตรวจ'); ?>
@foreach ($groupworks as $groupwork)
<?php 
            $countpersonbody = DB::table('health_screen')
            ->leftjoin('hrd_person','hrd_person.ID','=','health_screen.HEALTH_SCREEN_PERSON_ID')
            ->where('HEALTH_SCREEN_YEAR','=',$year_id)
            ->where('hrd_person.HR_DEPARTMENT_SUB_SUB_ID','=',$groupwork->HR_DEPARTMENT_SUB_SUB_ID)
            ->where('HEALTH_SCREEN_STATUS','=','SUCCESS')->count();
            
            $countperson = DB::table('hrd_person')
            ->where('HR_DEPARTMENT_SUB_SUB_ID','=',$groupwork->HR_DEPARTMENT_SUB_SUB_ID)
            ->where('HR_STATUS_ID','=',1)->count();
            
            $person_not = $countperson-$countpersonbody;

            $data[] = array($groupwork->HR_DEPARTMENT_SUB_SUB_NAME,$countpersonbody,$person_not); 
            ?>
@endforeach
<script src="{{ asset('google/Charts.js') }}"></script>
<script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable( <?php echo json_encode($data); ?> );

        var options = {
            fontName: 'Kanit',
            // title: 'จำนวนบุคลากรที่รับการตรวจ',
            isStacked: true
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('container'));
        chart.draw(data, options);
    }

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ['BMI', 'ร้อยละ'],
            ['ไม่มีข้อมูล', <?php echo $result_6; ?> ],
            ['นน. ต่ำกว่าเกณฑ์', <?php echo $result_1; ?> ],
            ['สมส่วน', <?php echo $result_2; ?> ],
            ['น้ำหนักเกิน', <?php echo $result_3; ?> ],
            ['โรคอ้วน', <?php echo $result_4; ?> ],
            ['โรคอ้วนอันตราย', <?php echo $result_5; ?> ]
        ]);

        var options = {
            // title: '......',   
            // height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart_1'));
        chart.draw(data, options);
    }

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['ผลสุขภาพ', 'ร้อยละ','id'],
            ['ป่วย', <?php echo $totalhealth_1; ?> ,1],
            ['เสี่ยง', <?php echo $totalhealth_2; ?> ,2],
            ['สุขภาพดี', <?php echo $totalhealth_3; ?> ,3]
        ]);

        var options = {
            // title: '......',   
            // height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart_2'));
        chart.draw(data, options);
        
        google.visualization.events.addListener(chart, 'select', selectHandler); 
        function selectHandler(e)  {   
            window.location.href = "{{route('health.healthdashboard_physical_examination_results').'?bodyresult='}}"
                                    +data.getValue(chart.getSelection()[0].row, 2)
                                    +"&budgetyear=ทั้งหมด"
        }
    }
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart4);
    
    function drawChart4() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable( 
            [
                ['ชื่อโรค','ไม่มี','มี','link'],
                ['โรคเบาหวาน',{{$Illness_history[1]['nothave']}},{{$Illness_history[1]['have']}},'1'],
                ['โรคความดัน',{{$Illness_history[2]['nothave']}},{{$Illness_history[2]['have']}},'2'],
                ['โรคตับ',{{$Illness_history[3]['nothave']}},{{$Illness_history[3]['have']}},'3'],
                ['โรคอัมพาต',{{$Illness_history[4]['nothave']}},{{$Illness_history[4]['have']}},'4'],
                ['โรคไขมันในเบือด',{{$Illness_history[6]['nothave']}},{{$Illness_history[6]['have']}},'6'],
                ['โรคไวรัสตับอักเสบ',{{$Illness_history[27]['nothave']}},{{$Illness_history[27]['have']}},'27'],
                ['โรคต่อมธัยรอยด์',{{$Illness_history[28]['nothave']}},{{$Illness_history[28]['have']}},'28'],
            ]
            );
        var view = new google.visualization.DataView(data);
        view.setColumns([0,1,2]);
        var options = {
            fontName: 'Kanit',
            // title: 'จำนวนบุคลากรที่รับการตรวจ',
            isStacked: true
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('Illness_history'));
        chart.draw(view, options);
    
        google.visualization.events.addListener(chart, 'select', selectHandler); 
        function selectHandler(e)  {   
            window.location.href = "{{route('health.healthdashboard_Illness_history').'?disease='}}"
                                    +data.getValue(chart.getSelection()[0].row, 3)
                                    +"&budgetyear={{$year_id}}"
        }
    }
     
//create trigger to resizeEnd event     
$(window).resize(function() {
    if(this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {
        $(this).trigger('resizeEnd');
    }, 0);
});

//redraw graph when window resize is completed  
$(window).on('resizeEnd', function() {
    drawChart();
    drawChart2();
    drawChart3();
    drawChart4();
});
</script>
@endsection
