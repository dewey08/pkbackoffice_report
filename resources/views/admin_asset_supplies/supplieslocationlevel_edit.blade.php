@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลชั้น</h2>    

    
        <form  method="post" action="{{ route('admin.updatesupplieslocationlevel') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ชื่อชั้น</label>
      </div>
      <div class="col-lg-3">
      <input  name = "LOCATION_LEVEL_NAME"  id="LOCATION_LEVEL_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplieslocationlevel->LOCATION_LEVEL_NAME}}" onkeyup="check_locationlevelname();">
      <div style="color: red; font-size: 16px;" id="locationlevelname"></div> 
    </div>


      <input type="hidden" name = "LOCATION_ID"  id="LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$idlocation}}">
      <input type="hidden" name = "LOCATION_LEVEL_ID"  id="LOCATION_LEVEL_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplieslocationlevel->LOCATION_LEVEL_ID}}">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsupplieslocationlevel/'.$idlocation)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_locationlevelname()
    {                         
        locationlevelname = document.getElementById("LOCATION_LEVEL_NAME").value;             
            if (locationlevelname==null || locationlevelname==''){
            document.getElementById("locationlevelname").style.display = "";     
            text_locationlevelname = "*กรุณาระบุชื่อชั้น";
            document.getElementById("locationlevelname").innerHTML = text_locationlevelname;
            }else{
            document.getElementById("locationlevelname").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var locationlevelname,text_locationlevelname; 
     
      locationlevelname = document.getElementById("LOCATION_LEVEL_NAME").value; 
   
                     
      if (locationlevelname==null || locationlevelname==''){
      document.getElementById("locationlevelname").style.display = "";     
      text_locationlevelname = "*กรุณาระบุชื่อชั้น";
      document.getElementById("locationlevelname").innerHTML = text_locationlevelname;
      }else{
      document.getElementById("locationlevelname").style.display = "none";
      }
  
  
      if(locationlevelname==null || locationlevelname==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection