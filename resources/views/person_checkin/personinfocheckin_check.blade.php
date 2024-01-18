
@extends('layouts.backend')

<meta http-equiv="Content-Security-Policy"  name="viewport" content="width=device-width, initial-scale=1.0">

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
 
      }

        <style>
    #my_camera{
        width: 320px;
        height: 240px;
        border: 1px solid black;
    }

    .time-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 5vh;
}
.time-container #displayTime {
  display: flex;
  align-self: center;
  font-size: 3rem;
  
}
	</style>






@section('content')
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

  function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

 $ip = get_client_ip_env();
  
?>
<body onload="check();startTime();">
    
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_checkin/personcheckin/'.$id_user)}}" class="btn btn-info loadscreen" >ลงเวลาปฎิบัติงาน</a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_checkin/personcheckininfo/'.$id_user)}}" class="btn btn-primary loadscreen" >ข้อมูลการลงเวลา</a> 
                                </div>   
                                <div>&nbsp;</div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content content-full">
                    <div class="block block-rounded block-bordered">
                    <form  method="post" action="{{ route('checkin.save') }}" enctype="multipart/form-data">
                    @csrf

                           <br>
                            <div class="time-container">
                            <h1 id="displayTime"></h1>
                            </div>
                            <center>{{ DateThai($datenow) }}</center>
                            <div class="content">
                            <center>
                            
                             <div id="my_camera" name="my_camera"></div>
                             <div id="results">
                             <input type="hidden" name="results" id="results" value="">
                             </div>
                             </center>
                             <br> 
                             <div class="row push">
                             <div class="col-sm-2">
                            <label for="comment">ประเภทการลงเวลา:</label>
                            </div>
                            <div class="col-sm-2">

                            <select name="CHECKIN_TYPE_ID" id="CHECKIN_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                           
                            @foreach ($checkintypes as $checkintype)   
                                @if($checkintype -> CHECKIN_TYPE_ID == $idtype)                 
                                <option value="{{ $checkintype -> CHECKIN_TYPE_ID }}" selected>{{ $checkintype -> CHECKIN_TYPE_NAME }}</option>           
                                @else
                                <option value="{{ $checkintype -> CHECKIN_TYPE_ID }}">{{ $checkintype -> CHECKIN_TYPE_NAME }}</option>           
                              
                                @endif
                            @endforeach 
                            </select>    
                            </div>
                            <div class="col-sm-1">
                            <label for="comment">ชื่อเวร:</label>
                            </div>
                            <div class="col-sm-3 text-left">                           
                                <select name="OPERATE_JOB_ID" id="OPERATE_JOB_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                    <option value="">--กรุณาเลือกชื่อเวร--</option>
                                      @foreach ($operatejobs as $operatejob)   
                                          <option value="{{ $operatejob -> OPERATE_JOB_ID }}">{{ $operatejob -> OPERATE_JOB_NAME }}</option>  
                                      @endforeach 
                              </select>    
                            </div>
                            <div class="invalid-feedback">
                              กรุณาเลือกชื่อเวร.
                            </div>
                            <div class="col-sm-1">
                            <label for="comment">หมายเหตุ:</label>
                            </div>
                            <div class="col-sm-3 text-left">
                              <input class="form-control" id="CHECKIN_REMARK" name="CHECKIN_REMARK" style=" font-family: 'Kanit', sans-serif;">
                            </div>
                            </div>
                            <input type="hidden" name = "CHECKIN_IP"  id="CHECKIN_IP"   value="{{ $ip }}">

                            <input type="hidden" name = "CHECKIN_PERSON_ID"  id="CHECKIN_PERSON_ID"   value="{{ $userid }}">
                            <input type="hidden" name = "HR_POSITION_ID"  id="HR_POSITION_ID"   value="{{ $inforpersonuser -> HR_POSITION_ID }}">
                            <input type="hidden" name = "HR_DEPARTMENT_SUB_SUB_ID"  id="HR_DEPARTMENT_SUB_SUB_ID"   value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_ID }}">

                           <div id="time"></div>
                            
                            
                            
                            
                            <center>


                            <button type="submit"  class="btn btn-hero-sm btn-hero-info"  onclick="take_snapshot()"><i class="fas fa-save"></i> &nbsp;บันทึกเวลา</button>
                             
                             
                             <br>
                             <br>
                      </form>  
                    </div>
                </div>

@endsection

@section('footer')

	<!-- Webcam.min.js -->
  <script src="{{ asset('webcamjs/webcam.min.js') }}"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">

function check(){
  navigator.getUserMedia=navigator.getUserMedia||navigator.webkitGetUserMedia||navigator.mozGetUserMedia||navigator.msGetUserMedia;
  if(navigator.getUserMedia)
  {
    Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach( '#my_camera' );
     
  }else{
   
  }
}
 


</script>

<script language="JavaScript">

  function take_snapshot() {
    navigator.getUserMedia=navigator.getUserMedia||navigator.webkitGetUserMedia||navigator.mozGetUserMedia||navigator.msGetUserMedia;
    if(navigator.getUserMedia)
  {
    // take snapshot and get image data
   Webcam.snap( function(data_uri) {
     // display results in page
      $(".image-tag").val(data_uri);
      document.getElementById('results').innerHTML = '<input type="hidden" name="results" id="results" value="'+data_uri+'">';
      
    } );

  }
  
  }
</script>

<script type="text/javascript">


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}



function startTime(){
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById("displayTime").innerHTML = h + ":" + m + ":" + s;
  document.getElementById('time').innerHTML = '<input type="hidden" name="time" id="time" value="'+h+":"+m+":"+s+'">';
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


@section('footer')

