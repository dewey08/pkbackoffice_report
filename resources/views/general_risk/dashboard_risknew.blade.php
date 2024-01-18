@extends('layouts.risk_dashboard')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}


.text-pedding{
   padding-left:10px;
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
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                    <div>
                                        <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero-warning" >
                                            
                                            <span class="nav-main-link-name">Dashboard</span>
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงานความเสี่ยง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refteam/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทบทวนความเสี่ยง</a>
                                </div>
                                <div>&nbsp;</div>
                                                         
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">

                    <center>
                        <div style="width: 100%;">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- PIE CHART -->
                                    <div class="card shadow lg">
                                    
                                            <?php $data_levelAI[] = array('อัตราการเกิดความเสี่ยง ','ระดับความรุนแรง'); ?>
                                                @foreach ($levelAI_piecharts as $levelAI_piechart)
                                                    <?php $data_levelAI[] = array($levelAI_piechart->RISKREP_LEVEL,$levelAI_piechart->level_count); ?>   
                                                        @endforeach 
                                    
                                        <div class="card-body shadow lg">
                                    
                                        <div id="piechart_levelAI" style="width: 100%; height: 500px;"></div>
                                        </div>
                                        
                                    </div>
                                
                                </div>
                                <div class="col-md-6">
                                    <!-- PIE CHART -->
                                    <div class="card shadow lg">
                                                
                                                <div class="card-body shadow lg">
        
                                                <div id="piechart_levAI" style="width: 100%; height: 500px;"></div>
        
                                                </div>
                                            
                                            </div>
                                        
                                    </div>
                                </div> 
                            </div> 
                        <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow lg">
                                        <div id="piechart_12" style="width: 100%; height: 500px;"></div>
                                    </div>
                                </div>                          
                                <div class="col-md-6">
                                    <div class="card shadow lg">
                                        <div id="piechart_levABCDE" style="width: 100%; height: 500px;"></div>
                                    </div>
                                </div>    
                            </div> 

                        <br>              
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow lg">                                
                                            <?php $data_type[] = array('ประเภทรายงาน','จำนวนประเภทรายงาน'); ?>
                                                @foreach ($sexpiechart as $sex_piechart)
                                                    <?php $data_type[] = array($sex_piechart->RISKREP_SEX,$sex_piechart->sex_count); ?>   
                                                        @endforeach                             
                                    
                                            <div id="donutchart" style="width: 100%; height: 500px;"></div>
                                    </div>                            
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow lg">
                                        <div id="piechart_age" style="width:100%; height: 500px;"></div>
                                    </div>                                        
                                </div>                            
                            </div>
                        </div>  
                        <br> <br>
                        </center>
                </div> 
                  
                           
                    </div>
                </div>

                

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

<script src="{{ asset('google/Charts.js') }}"></script>

<script>
   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
         var data = google.visualization.arrayToDataTable( <?php
             echo json_encode($data_levelAI);
             ?>);
         var options = {
           title: 'อัตราการเกิดความเสี่ยง ระดับความรุนแรงทั้งหมด ',
           fontName: 'Kanit', 
           pieHole: 0.4, 
         };
         var chart = new google.visualization.PieChart(document.getElementById('piechart_levelAI'));
         chart.draw(data, options);
         }
 </script>
 <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
         var data = google.visualization.arrayToDataTable( [
           ['Task', 'Hours per Day'],
           ['C',     <?php echo $lev_C; ?>],
           ['D',     <?php echo $lev_D; ?>],
           ['E',     <?php echo $lev_E; ?>],
           ['H',     <?php echo $lev_H; ?>],
           ]);
         var options = {
           title: 'อัตราการเกิดความเสี่ยง ระดับความรุนแรง C,D,E,H',
           fontName: 'Kanit', 
           pieHole: 0.4, 
         };
         var chart = new google.visualization.PieChart(document.getElementById('piechart_levAI'));
         chart.draw(data, options);
         }
 </script>
 <script type="text/javascript">
   google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'Hours per Day'],
          ['1',  <?php echo $levels_1; ?>],
          ['2',   <?php echo $levels_2; ?>],
         
          ]);
        var options = {
          title: 'อัตราการเกิดความเสี่ยง ระดับความรุนแรง 1,2',
          fontName: 'Kanit', 
          pieHole: 0.4, 
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_12'));
        chart.draw(data, options);
        }
</script>
<script type="text/javascript">
   google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'Hours per Day'],
          ['A',     <?php echo $lec_A; ?>],
          ['B',     <?php echo $lec_B; ?>],
          ['C',     <?php echo $lec_C; ?>],
          ['D',     <?php echo $lec_D; ?>],
          ['E',     <?php echo $lec_E; ?>],
          ]);
        var options = {
          title: 'อัตราการเกิดความเสี่ยง ระดับความรุนแรง A,B,C,D,E',
          fontName: 'Kanit', 
          pieHole: 0.4, 
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_levABCDE'));
        chart.draw(data, options);
        }
</script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['อายุ', 'Speakers (in millions)'],
          ['อายุระหว่าง 1-15 ปี', <?php echo $AGE_1; ?>], ['อายุระหว่าง 16-35 ปี', <?php echo $AGE_2; ?>],['อายุระหว่าง 36-55 ปี', <?php echo $AGE_3; ?>],
          ['อายุระหว่าง 56-75 ปี', <?php echo $AGE_4; ?>], ['อายุระหว่าง 76 ปีขึ้นไป', <?php echo $AGE_5; ?>]
         
        ]);
        var options = {
          title: 'อัตราการเกิดความเสี่ยงช่วงอายุ',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  2: {offset: 0.2},
                    4: {offset: 0.3},
                    5: {offset: 0.4},
                    6: {offset: 0.5},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_age'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['ชาย',     <?php echo $SEX_1; ?>],
          ['หญิง',     <?php echo $SEX_2; ?>],
         
        ]);

        var options = {
          title: 'อัตราการเกิดระความเสี่ยง ชาย & หญิง',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

@endsection
