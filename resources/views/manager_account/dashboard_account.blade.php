@extends('layouts.account')

@section('content')

<?php
    $status = Auth::user()->status; 
    $id_user = Auth::user()->PERSON_ID; 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos); 


?>
<?php
    function RemoveDateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }

    function RemovegetAge($birthday) {
        $then = strtotime($birthday);
        return(floor((time()-$then)/31556926));
    }
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
           
            }

            p {
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>

<br>
<br>

    <body>
        <center>
        <div class="block" style="width: 95%;">
            <div class="content" >
                <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family:'Kanit',sans-serif;"><B>ข้อมูลงานบัญชี</B></h3>                     
                </div>
           
               
                    <form action="" method="post">
                        @csrf 
                       
                        <div class="row" >     
                            <div class="col-md-2">
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
                            <div class="col-md-1">
                                <span>
                                    <button type="button" class="btn btn-info" >แสดง</button>
                                </span> 
                            </div>
                        </div>    
                    </form>                  
                <br>
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        {{-- <i class="fa fa-2x fa fa-inbox text-white"></i> --}}
                                        <i class="fa fa-3x fas fa-file-invoice-dollar text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white mb-0">
                                    วางบิล
                                        </p>
                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                            {{(number_format($infobills,2))}}
                                        </p>
                                    
                                    </div>                                    
                                </div>
                            </a>
                        </div> 
                        <div class="col-md-6 col-xl-6">
                            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        {{-- <i class="fa fa-2x fa fa-paper-plane text-white"></i> --}}
                                        <i class="fa fa-3x far fa-credit-card text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                        <p class="text-white mb-0">
                                        เช็ค
                                        </p>
                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                            {{(number_format($infochecks,2))}}
                                        </p>                                
                                    </div>
                                </div>
                            </a>
                        </div>     
                    </div>
                    <div class="row"> 
                        <div class="col-md-6 col-xl-6">
                            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        {{-- <i class="fa fa-2x fa fa-book fas fa-hand-holding-usd text-white"></i> --}}
                                        <i class="fa fa-3x fas fa-hand-holding-usd text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right" >
                                        <p class="text-white mb-0">
                                        รายรับ
                                        </p>
                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                        {{(number_format($inforevenues,2))}}
                                        </p>                                
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-6">
                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        {{-- <i class="fa fa-2x fa fa-paper-plane text-white"></i> --}}
                                        <i class="fa fa-3x fas fa-donate text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                        <p class="text-white mb-0">
                                        รายจ่าย
                                        </p>
                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                            {{(number_format($inforepays,2))}}
                                        </p>                                
                                    </div>
                                </div>
                            </a>
                        </div> 
                                                            
                    </div>
                
                <br>
             
            </div>
        </div>

    <div style="width: 95%;">
        <div class="row">
            <div class="col-md-6">
                <!-- PIE CHART -->
                <div class="card shadow lg">
                  
                       
                  
                    <div class="card-body shadow lg">
                   
                    <div id="piechart" style="width: 100%; height: 500px;"></div>
                    </div>
                    
                </div>
               
            </div>
            <div class="col-md-6">
                <!-- PIE CHART -->
                <div class="card shadow lg">
                            
                            <div class="card-body shadow lg">

                            <div id="check" style="width: 100%; height: 500px;"></div>

                            </div>
                           
                        </div>
                       
                </div>
            </div> 
        </div>   
            <br>

        <div style="width: 95%;">
            <div class="block block-content">
                {{-- <div id="columnchart_car" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div> --}}
             </div>
 
             <div class="block block-content">             
                <div id="columnchart_material" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
             </div> 
        </div>
    <br>




    {{-- </center>   --}}
    </body>

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

<script src="{{ asset('google/Charts.js') }}"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'รายรับ-รายจ่าย'],
          ['รายรับ',     <?php echo $inforevenues; ?>],
          ['รายจ่าย',     <?php echo $inforepays; ?>],                 
          ]);
        var options = {
          title: 'อัตรา รายรับ-รายจ่าย',
          fontName: 'Kanit', 
          pieHole: 0.4, 
        };
         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
         chart.draw(data, options);
         }
 </script>   
 <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
        var data = google.visualization.arrayToDataTable( [
          ['Task', 'วางบิล-เช็ค'],
          ['เช็ค',     <?php echo $infochecks; ?>],
          ['วางบิล',     <?php echo $infobills; ?>],         
          ]);
        var options = {
          title: 'อัตรา วางบิล-เช็ค',
          fontName: 'Kanit', 
          pieHole: 0.4, 
        };
         var chart = new google.visualization.PieChart(document.getElementById('check'));
         chart.draw(data, options);
         }
 </script>   

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var data = google.visualization.arrayToDataTable([
         ['เดือน', 'รายรับ', 'รายจ่าย'],
         ['ม.ค', <?php echo $m1_11; ?>,<?php echo $m1_12; ?>],
         ['ก.พ', <?php echo $m2_11; ?>,<?php echo $m2_12; ?>],
         ['มี.ค', <?php echo $m3_11;?>,<?php echo $m3_12; ?>],
         ['เม.ย', <?php echo $m4_11;?>,<?php echo $m4_12; ?>],
         ['พ.ค', <?php echo $m5_11;?>,<?php echo $m5_12; ?>],
         ['มิ.ย', <?php echo $m6_11;?>,<?php echo $m6_12; ?>],
         ['ก.ค', <?php echo $m7_11;?>,<?php echo $m7_12; ?>],
         ['ส.ค', <?php echo $m8_11;?>,<?php echo $m8_12; ?>],
         ['ก.ย', <?php echo $m9_11;?>,<?php echo $m9_12; ?>],
         ['ต.ค', <?php echo $m10_11;?>,<?php echo $m10_12; ?>],
         ['พ.ย', <?php echo $m11_11; ?>,<?php echo $m11_12; ?>],
         ['ธ.ค', <?php echo  $m12_11;?>,<?php echo $m12_12; ?>]
       ]);

       var options = {
           fontName: 'Kanit',
           hAxis: { slantedText: true, 
                     slantedTextAngle: 45
           },
         chart: {
           title: 'บันทึกรายรับรายจ่าย',
       
         }
       };

       var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     }
   </script>


@endsection