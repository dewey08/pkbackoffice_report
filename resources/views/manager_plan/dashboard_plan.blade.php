@extends('layouts.plan')
@section('css_before')
<style>
body *{
            font-family: 'Kanit', sans-serif;
            }
.table-cont{
  max-height: 300px;
  overflow: auto;
  background: #ddd;
  margin: 20px 10px;
  box-shadow: 0 0 1px 3px #ddd;
}
.text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }
        .text-font {
    font-size: 13px;
                  }
</style>
<script>
    function checklogin(){
     window.location.href = '{{route("index")}}';
    }
</script>
<?php
$status = Auth::user()->status;
$id_user = Auth::user()->PERSON_ID;
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos);
?>
@endsection
@section('content')
<br>
<br>
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูลแผนงานโครงการ</h3>
        </div>
        <hr>
        <form action="{{ route('mplan.dashboard') }}" method="post">
        @csrf
        <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                    <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">   
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
        <table class="mb-3 gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead class="bg-sl2-p2 text-white">
                        <tr height="40">
                              <th class="text-font"  style="text-align: center;" width="5%">ลำดับ</th>
                              <th class="text-font"  class="text-font" style="text-align: center;" >แผนงาน</th>
                              <th class="text-font" style="text-align: center;" width="10%">จำนวน</th>
                              <th class="text-font" style="text-align: center;" width="10%">งบประมาณ</th>
                              <th class="text-font" style="text-align: center;" width="10%">ดำเนินการ</th>
                              <th class="text-font" style="text-align: center;" width="10%">ใช้จริง</th>
                              <th class="text-font" style="text-align: center;" width="10%">ร้อยละ</th>
                        </tr >
                    </thead>

                    <tbody>
                        <tr height="40">
                              <td class="text-font text-pedding" style="text-align: center;" >1</td>
                              <td class="text-font text-pedding">แผนงานโครงการ กิจกรรม</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countplan_1}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_1,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_1}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_1,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_1,2)}}</td>
                        </tr >
                        @foreach($plan_activity_sub as $plan)
                        <tr height="25" style="color:#a20">
                              <td class="text-font text-pedding" style="text-align: center;" ></td>
                              <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetall'],2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetsuccess'],2)}}</td>
                              @php($percent = ($plan['budget_countall'] == 0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
                        </tr >
                        @endforeach
                        <tr height="40">
                              <td class="text-font text-pedding" style="text-align: center;" >2</td>
                              <td class="text-font text-pedding" >แผนพัฒนาบุคลากร</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countplan_2}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_2,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_2}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_2,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_2,2)}}</td>
                        </tr >

                        @foreach($plan_humandev_sub as $plan)
                        <tr height="25" style="color:#a20">
                              <td class="text-font text-pedding" style="text-align: center;" ></td>
                              <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetall'],2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetsuccess'],2)}}</td>
                              @php($percent = ($plan['budget_countall'] == 0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
                        </tr >
                        @endforeach
                        <tr height="40">
                              <td class="text-font text-pedding" style="text-align: center;" >3</td>
                              <td class="text-font text-pedding" >แผนจัดซื้อครุภัณฑ์</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countplan_3}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_3,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_3}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_3,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_3,2)}}</td>
                        </tr >
                        @foreach($plan_purchase_sub as $plan)
                        <tr height="25" style="color:#a20">
                              <td class="text-font text-pedding" style="text-align: center;" ></td>
                              <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetall'],2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetsuccess'],2)}}</td>
                              @php($percent = ($plan['budget_countall'] == 0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
                        </tr >
                        @endforeach
                        <tr height="40">
                              <td class="text-font text-pedding" style="text-align: center;" >3</td>
                              <td class="text-font text-pedding" >แผนบำรุงรักษา</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countplan_4}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpiceplan_4,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$countsucces_4}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sumpicesucces_4,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($persen_4,2)}}</td>
                        </tr >
                        @foreach($plan_maintenance_sub as $plan)
                        <tr height="25" style="color:#a20">
                              <td class="text-font text-pedding" style="text-align: center;" ></td>
                              <td class="text-font text-pedding">{{$plan['budget_name']}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countall']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetall'],2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$plan['budget_countsuccess']}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($plan['budget_budgetsuccess'],2)}}</td>
                              @php($percent = ($plan['budget_countall'] == 0)?0:$plan['budget_countsuccess']/$plan['budget_countall']*100)
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($percent,2)}}</td>
                        </tr >
                        @endforeach
                        <tr height="40">
                              <td class="text-font text-pedding" style="text-align: center;"  colspan="2">รวม</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$sum_1}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_2,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$sum_3}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_4,2)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{number_format($sum_5,2)}}</td>
                      
                        </tr >

                    </tbody>
            </table>
        </div>
        <div class="block block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบยาและเวชภัณฑ์</h3>
            <div class="row mb-2">
              <div class="col-md-8 mb-2">
                    <div class="panel p-1 bg-sl2-p2">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">บันทึกรายรับรายจ่าย
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center px-3 py-3 f-kanit" style="overflow-y:hidden">
                            <div id="columnchart_material"  style="width:100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="panel p-1 bg-sl2-p2 mb-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">ร้อยละงบประมาณที่เบิกจ่าย
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_div_1" style="width: 220px; height: 220px;"></div> 
                        </div>
                    </div>
                    <div class="panel p-1 bg-sl2-p2 mb-1">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">ร้อยละความสำเร็จของแผนงาน</div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="chart_div_2" style="width: 220px; height: 220px;"></div>
                        </div>
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
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
 <script src="{{ asset('google/Charts.js') }}"></script>

<script>
 google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['',{{number_format($sum_6,2)}}]
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
</script>
<script>
 google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
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
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
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
                title: 'แผนงาน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
        chart.draw(view, options);
    }
</script>
<!-- <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var data = google.visualization.arrayToDataTable([
         ['แผนงาน', 'งบประมาณ', 'ใช้จริง'],
         ['แผนงานโครงการ กิจกรรม', <?php echo $sumpiceplan_1; ?>,<?php echo $sumpicesucces_1; ?>],
         ['แผนพัฒนาบุคลากร', <?php echo $sumpiceplan_2; ?>,<?php echo $sumpicesucces_2; ?>],
         ['แผนจัดซื้อครุภัณฑ์', <?php echo $sumpiceplan_3; ?>,<?php echo $sumpicesucces_3; ?>],
         ['แผนซ่อมแซม', <?php echo $sumpiceplan_4;?>,<?php echo $sumpicesucces_4; ?>]
        
       ]);

       var options = {
           fontName: 'Kanit',
           hAxis: { slantedText: true, 
                     slantedTextAngle: 45
           },
         chart: {
        //    title: 'บันทึกรายรับรายจ่าย',
       
         }
       };
       var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
       chart.draw(data, google.charts.Bar.convertOptions(options));
     }
   </script> -->

@endsection
