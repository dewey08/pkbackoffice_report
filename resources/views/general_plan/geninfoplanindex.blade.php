@extends('layouts.backend')


    <link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">


@section('content')

<style>

#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
	}

    body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
      }

      table, td, th {
            border: 1px solid black;
            } 
</style>

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



use App\Http\Controllers\MeetingController;
$checkver = MeetingController::checkver($user_id);
$countver = MeetingController::countver($user_id);

$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}


?>
<!-- Advanced Tables -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
        {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }} {{ $inforpersonuser -> HR_LNAME }}
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <div class="row">
            <div>
              <a href="{{ url('general_plan/plan_dashboard/'.$inforpersonuserid -> ID)}}"
                class="btn btn-warning loadscreen">Dashboard</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/planwork/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนปฏิบัติงาน</a>
            </div>
            <div>&nbsp;</div>

            <div>
              <a href="{{ url('general_plan/plan_project/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนงานโครงการ</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_humandev/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนพัฒนาบุคลากร</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_durable/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซื้อครุภัณฑ์</a>
            </div>
            <div>&nbsp;</div>
            <a href="{{ url('general_plan/plan_repair/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
              style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซ่อมบำรุง</a>
          </div>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
  <div class="block-content">
    <form action="{{ route('guest.geninfoplanindex',$iduser) }}" method="post">
      @csrf
      <div class="row">
        <div class="col-md-2 d-flex justify-content-center align-items-center fs-16">
          ข้อมูลประจำปีงบประมาณ :
        </div>
        <div class="col-md-2">
          <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg fs-16"
            style=" font-family: 'Kanit', sans-serif;">
            @foreach ($budgets as $budget)
            @if($budget->LEAVE_YEAR_ID== $year_id)
            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
            @else
            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="col-md-1">
          <span>
            <button type="submit" class="btn btn-info fs-16">แสดง</button>
          </span>
        </div>
      </div>
    </form>
    <div class="block-content mt-3 mb-4 shadow pb-4">
      <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
        <thead style="background-color: #FFEBCD;">
          <tr height="40">
            <td class="text-font" style="text-align: center;" width="5%">ลำดับ</td>
            <td class="text-font" class="text-font" style="text-align: center;">แผนงาน</td>
            <td class="text-font" style="text-align: center;" width="10%">จำนวน</td>
            <td class="text-font" style="text-align: center;" width="10%">งบประมาณ</td>
            <td class="text-font" style="text-align: center;" width="10%">ดำเนินการ</td>
            <td class="text-font" style="text-align: center;" width="10%">ใช้จริง</td>
            <td class="text-font" style="text-align: center;" width="10%">ร้อยละ</td>
          </tr>
        </thead>
        <tbody>
          <tr height="40">
            <td class="text-font text-pedding" style="text-align: center;">1</td>
            <td class="text-font text-pedding">แผนงานโครงการ กิจกรรม</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countplan_1}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_1,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_1}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_1,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_1,2)}}</td>
          </tr>
          @foreach($plan_activity_sub as $plan)
          <tr height="25" style="color:#a20">
            <td class="text-font text-pedding" style="text-align: center;"></td>
            <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetall'],2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetsuccess'],2)}}</td>
            @php($percent = ($plan['budget_countall'] ==
            0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
          </tr>
          @endforeach
          <tr height="40">
            <td class="text-font text-pedding" style="text-align: center;">2</td>
            <td class="text-font text-pedding">แผนพัฒนาบุคลากร</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countplan_2}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_2,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_2}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_2,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_2,2)}}</td>
          </tr>
          @foreach($plan_humandev_sub as $plan)
          <tr height="25" style="color:#a20">
            <td class="text-font text-pedding" style="text-align: center;"></td>
            <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetall'],2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetsuccess'],2)}}</td>
            @php($percent = ($plan['budget_countall'] ==
            0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
          </tr>
          @endforeach
          <tr height="40">
            <td class="text-font text-pedding" style="text-align: center;">3</td>
            <td class="text-font text-pedding">แผนจัดซื้อครุภัณฑ์</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countplan_3}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_3,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_3}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_3,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_3,2)}}</td>
          </tr>
          @foreach($plan_purchase_sub as $plan)
          <tr height="25" style="color:#a20">
            <td class="text-font text-pedding" style="text-align: center;"></td>
            <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetall'],2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetsuccess'],2)}}</td>
            @php($percent = ($plan['budget_countall'] ==
            0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
          </tr>
          @endforeach
          <tr height="40">
            <td class="text-font text-pedding" style="text-align: center;">4</td>
            <td class="text-font text-pedding">แผนซ่อมบำรุง</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countplan_4}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_4,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_4}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_4,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_4,2)}}</td>
          </tr>
          @foreach($plan_maintenance_sub as $plan)
          <tr height="25" style="color:#a20">
            <td class="text-font text-pedding" style="text-align: center;"></td>
            <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetall'],2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
            <td class="text-font text-pedding" style="text-align: right;">
              {{number_format($plan['budget_budgetsuccess'],2)}}</td>
            @php($percent = ($plan['budget_countall'] ==
            0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
          </tr>
          @endforeach
          <tr height="40">
            <td class="text-font text-pedding" style="text-align: center;" colspan="2">รวม</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$sum_1}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_2,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{$sum_3}}</td>
            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_4,2)}}</td>
            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sum_5,2)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="block-content mt-3 mb-4 shadow">
      <div class="row">
        <div class="col-md-8 mb-2">
          <div class="panel p-1 bg-sl2-sb3">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">บันทึกรายรับรายจ่าย
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="columnchart_material" class="f-kanit" style="width: 100%;height:500px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-2">
          <div class="panel p-1 bg-sl2-sb3 mb-2">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">ร้อยละงบประมาณที่เบิกจ่าย
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="chart_div_1" class="f-kanit d-flex justify-content-center" style="width: 100%;height:220px;"></div>
            </div>
          </div>
          <div class="panel p-1 bg-sl2-sb3">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">ร้อยละความสำเร็จของแผนงาน
            </div>
            <div class="pane-body bg-white d-flex justify-content-center align-items-center" style="overflow-y:hidden">
              <div id="chart_div_2" class="f-kanit d-flex justify-content-center" style="width: 100%;height:220px;"></div>
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
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->

<script>
  google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['',  {{number_format($sum_6,2)}}]
        ]);
        var options = {
          width: 200, height: 200,
          greenFrom: 90, greenTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById('chart_div_1'));
        chart.draw(data, options);
      }
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['',{{number_format($sum_5,2)}}]
         
        ]);

        var options = {
          width: 200, height: 200,
          greenFrom: 90, greenTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById('chart_div_2'));
        chart.draw(data, options);
      }
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
         ['แผนงาน', 'งบประมาณ', 'ใช้จริง'],
         ['แผนงานโครงการ กิจกรรม', <?php echo $sumpiceplan_1; ?>,<?php echo $sumpicesucces_1; ?>],
         ['แผนพัฒนาบุคลากร', <?php echo $sumpiceplan_2; ?>,<?php echo $sumpicesucces_2; ?>],
         ['แผนจัดซื้อครุภัณฑ์', <?php echo $sumpiceplan_3; ?>,<?php echo $sumpicesucces_3; ?>],
         ['แผนซ่อมแซม', <?php echo $sumpiceplan_4;?>,<?php echo $sumpicesucces_4; ?>]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },2,
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
            // colors: ['#82b54b'],
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
        chart.draw(view, options);
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
  });
</script>

@endsection
