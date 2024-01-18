@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />




@section('content')
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลสถานที่นัดหมาย</h2>    

    
        <form  method="post" action="{{ route('admin.updateappointlocate') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >สถานที่นัดหมาย</label>
      </div>
      <div class="col-lg-3">
      <input  name = "APPOINT_LOCATE_NAME"  id="APPOINT_LOCATE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  value="{{$infoappointlocate->APPOINT_LOCATE_NAME}}"  onkeyup="check_name();">
      <div style="color: red; font-size: 16px;" id="appointlocate_name"></div> 
    </div>
     
      <input  type="hidden" name = "APPOINT_LOCATE_ID"  id="APPOINT_LOCATE_ID" class="form-control input-lg" value="{{$infoappointlocate->APPOINT_LOCATE_ID}}">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_car/setupcarappointlocate')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>
   
    function check_name()
    {                         
        appointlocate_name = document.getElementById("APPOINT_LOCATE_NAME").value;             
            if (appointlocate_name==null || appointlocate_name==''){
            document.getElementById("appointlocate_name").style.display = "";     
            text_appointlocate_name = "*กรุณาระบุสถานที่นัดหมาย";
            document.getElementById("appointlocate_name").innerHTML = text_appointlocate_name;
            }else{
            document.getElementById("appointlocate_name").style.display = "none";
            }
    }
   
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var appointlocate_name,text_appointlocate_name;      
     
      appointlocate_name = document.getElementById("APPOINT_LOCATE_NAME").value;   
                
      if (appointlocate_name==null || appointlocate_name==''){
      document.getElementById("appointlocate_name").style.display = "";     
      text_appointlocate_name = "*กรุณาระบุสถานที่นัดหมาย";
      document.getElementById("appointlocate_name").innerHTML = text_appointlocate_name;
      }else{
      document.getElementById("appointlocate_name").style.display = "none";
      }
     
        
      if(appointlocate_name==null || appointlocate_name=='')
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection