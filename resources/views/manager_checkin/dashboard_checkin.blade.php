@extends('layouts.checkin')

@section('content')

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
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>
 
<br>
<br>
    <!-- Page Content -->
    <div class="content">                 
                    ข้อมูลการลงเวลา
                    <div class="row">
                    <div class="col-md-4 col-xl-3">
                            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        <i class="fa fa-2x fa fa-book text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right" >
                                    <p class="text-white mb-0">
                                        ลงเวลาเข้า (ครั้ง)
                                        </p>
                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                         {{$countin}}
                                        </p>
                                 
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        <i class="fa fa-2x fa fa-paper-plane text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                    <p class="text-white mb-0">
                                            ลงเวลาออก (ครั้ง)
                                        </p>
                                    <p class="text-white mb-0" style="font-size: 2.25rem;">
                                            {{$countout}}
                                        </p>
                                   
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-inbox text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                <p class="text-white mb-0">
                                    .....
                                        {{-- แผนกที่ลงเวลาเข้า --}}
                                        </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                {{-- {{$countsubin}} --}}
                                        </p>
                                    
                                    </div>
                                    
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-hand-point-up text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                <p class="text-white mb-0">
                                    .....
                                        {{-- แผนกที่ลงเวลาออก --}}
                                        </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                        {{-- {{$countsubout}} --}}
                                        </p>
                                   
                                    </div>
                                    
                                </div>
                            </a>
                        </div>   
            </div>


            {{-- <div id="columnchart_car" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div> --}}
            <br>
            {{-- <div id="columnchart_refer" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div> --}}

            

        <br>
        
        <div class="row">
            <div class="col-md-12">
                <?php $data_3[] = array('หน่วยงาน.','จำนวนครั้ง'); ?>
                        @foreach ($checkins as $checkin)
                <?php $data_3[] = array($checkin->HR_DEPARTMENT_SUB_SUB_NAME,$checkin->amount_count); ?>   
                        @endforeach  
                </div>
           <div id="barchart_Checkin" style="font-family: 'Kanit', sans-serif;width: 100%; height: auto;"></div>
        </div>
   
        <br> 

        <div class="row">
                <div class="col-md-12">
                    <?php $data_4[] = array('หน่วยงาน.','จำนวนครั้ง'); ?>
                            @foreach ($checkouts as $checkout)
                    <?php $data_4[] = array($checkout->HR_DEPARTMENT_SUB_SUB_NAME,$checkout->amount_count); ?>   
                            @endforeach  
                </div>
            <div id="barchart_Checkout" style="font-family: 'Kanit', sans-serif;width: 100%; height: auto;"></div>
    </div>
{{-- </div> --}}
<br> 

<?php $data_5[] = array('หน่วยงาน.','จำนวนครั้ง'); ?>
@foreach ($checkins as $checkin)
<?php $data_5[] = array($checkin->HR_DEPARTMENT_SUB_SUB_NAME,$checkin->amount_count); ?>   
@endforeach  


<?php $data_6[] = array('หน่วยงาน.','จำนวนครั้ง'); ?>
@foreach ($checkouts as $checkout)
<?php $data_6[] = array($checkout->HR_DEPARTMENT_SUB_SUB_NAME,$checkout->amount_count); ?>   
@endforeach 

<div class="row">
        <div class="col-md-6">
              <div id="piechart_3d_1" style="width: 100%; height: 550px;"></div>
          </div>
          <div class="col-md-6">
              <div id="piechart_3d_2" style="width: 100%; height: 550px;"></div>
          </div> 
        </div>  


 <br> 
 </body>
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

<script src="{{ asset('google/Charts.js') }}"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
      var data = google.visualization.arrayToDataTable(<?php
          echo json_encode($data_3);
          ?>);
      var options = {
        chart: {
          title: 'จำนวนครั้งในการลงเวลาเข้าจำแนกตามแผนก ปีปัจจุบัน',      
        },
        bars: 'horizontal' // Required for Material Bar Charts.
      };
      var chart = new google.charts.Bar(document.getElementById('barchart_Checkin'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
      var data = google.visualization.arrayToDataTable(<?php
          echo json_encode($data_4);
          ?>);
      var options = {
        chart: {
          title: 'จำนวนครั้งในการลงเวลาออกจำแนกตามแผนก ปีปัจจุบัน',      
        },
        bars: 'horizontal' // Required for Material Bar Charts.
      };
      var chart = new google.charts.Bar(document.getElementById('barchart_Checkout'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable( <?php
            echo json_encode($data_5);
            ?>);
        var options = {
          title: 'อัตราส่วนการลงเวลาเข้า ',
          fontName: 'Kanit',
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
      }
</script>

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable( <?php
            echo json_encode($data_6);
            ?>);
        var options = {
          title: 'อัตราส่วนการลงเวลาออก ',
          fontName: 'Kanit',
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
        chart.draw(data, options);
      }
</script>
@endsection