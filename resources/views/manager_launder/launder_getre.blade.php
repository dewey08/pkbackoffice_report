@extends('layouts.launder')   

<meta http-equiv="Content-Security-Policy"  name="viewport" content="width=device-width, initial-scale=1.0">

<style>
.time-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 10vh;
}
.time-container #displayTime {
  display: flex;
  align-self: center;
  font-size: 5rem;

}
	</style>

@section('content')

<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
      font-family: 'Kanit', sans-serif;
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
      } 

      @media only screen and (min-width: 1200px) {
    label {
    float:right;
  }

      }
      
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
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

?>
<?php
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d');
     
?>         
<!-- Advanced Tables -->
<body onload="startTime()">
<br>
<br>
<center>    

    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">

        <br>
                            <div class="time-container">
                            <h1 id="displayTime"></h1>
                            </div>
                            <center>{{ DateThai($datenow) }}</center>
                            <br>
                            <br>
                            <center>
                            <div class="content">
                            <div class="row push">
                            <div class="col-sm-6 col-md-4 invisible" data-toggle="appear">
                            <a class="block block-rounded block-link-pop" href="{{ url('manager_launder/launder_getre_dep/receive')}}">
                            <div class="block block-rounded text-center bg-danger">
                                <div class="block-content">

                                        <span>
                                        <img src="../image/dirty.png" width="150" height="150">
                                        </span>

                                </div>
                                <div class="block-content">
                                    <p class="text-white text-uppercase font-w1000" style="font-size: 40px;">
                                      รับผ้า
                                    </p>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-6 col-md-4 invisible" data-toggle="appear">
                            <a class="block block-rounded block-link-pop" href="{{ url('manager_launder/launder_getre_dep/check')}}">
                            <div class="block block-rounded text-center bg-warning">
                                <div class="block-content">

                                        <span>
                                        <img src="../image/cleaning.png" width="150" height="150">
                                        </span>

                                </div>
                                <div class="block-content">
                                    <p class="text-white text-uppercase font-w1000" style="font-size: 40px;">
                                      ตรวจรับผ้า
                                    </p>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-6 col-md-4 invisible" data-toggle="appear">
                        <a class="block block-rounded block-link-pop" href="{{ url('manager_launder/launder_getre_dep/send')}}">
                            <div class="block block-rounded text-center bg-success">
                                <div class="block-content">

                                        <span>
                                        <img src="../image/delivery.png" width="150" height="150">
                                        </span>

                                </div>
                                <div class="block-content">
                                    <p class="text-white text-success font-w1000" style="font-size: 40px;">
                                        ส่งผ้า
                                    </p>
                                </div>

                        </div>
                      </div>
                      </a>
                    </div>
                    </div>
                </div>
         
        </div>
    </div>


  
@endsection
@section('footer')

 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

<script>

function startTime(){
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById("displayTime").innerHTML = h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  function checkTime(i){
    if(i < 10){
      i = "0" + i
    }
    return i;
  }
}

</script>

@endsection