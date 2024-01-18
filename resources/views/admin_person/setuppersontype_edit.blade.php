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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลกลุ่มบุคลากร</h2>    

    
        <form  method="post" action="{{ route('admin.updatepersontype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
      <label >รหัส {{ $infopersontype->HR_PERSON_TYPE_ID }}</label>
      <input type = "hidden"  name = "HR_PERSON_TYPE_ID"  id="HR_PERSON_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infopersontype->HR_PERSON_TYPE_ID }}">
      </div>
      <div class="col-lg-1">
      <label >กลุ่มบุคลากร</label>
      </div>
      <div class="col-lg-3">
      <input  name = "HR_PERSON_TYPE_NAME"  id="HR_PERSON_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infopersontype->HR_PERSON_TYPE_NAME }}" onkeyup="check_hr_person_type_name();">
      <div style="color: red; font-size: 16px;" id="hr_person_type_name"></div>
    </div>
   
     <div class="col-lg-1">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "HR_LEAVE04_CMD"  id="HR_LEAVE04_CMD" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infopersontype->HR_LEAVE04_CMD }}" onkeyup="check_hr_leave04_cmd();">
      <div style="color: red; font-size: 16px;" id="hr_leave04_cmd"></div> 
    </div> 
    <div class="col-lg-1">
      <label >จำนวนวันลา</label>
      </div>
      <div class="col-lg-1">
      <input  name = "HR_LEAVE04_DAY"  id="HR_LEAVE04_DAY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infopersontype->HR_LEAVE04_DAY }}" onkeyup="check_hr_leave04_day();" >
      <div style="color: red; font-size: 16px;" id="hr_leave04_day"></div> 
    </div>
    <div class="col-lg-1">
      <label >วัน</label>
      </div>


      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_person/setupinfopersongroup')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
    function check_hr_person_type_name()
    {                         
      hr_person_type_name = document.getElementById("HR_PERSON_TYPE_NAME").value;             
            if (hr_person_type_name==null || hr_person_type_name==''){
            document.getElementById("hr_person_type_name").style.display = "";     
            text_hr_person_type_name = "*กรุณาระบุกลุ่มบุคลากร";
            document.getElementById("hr_person_type_name").innerHTML = text_hr_person_type_name;
            }else{
            document.getElementById("hr_person_type_name").style.display = "none";
            }
    } 
    function check_hr_leave04_cmd()
    {                         
      hr_leave04_cmd = document.getElementById("HR_LEAVE04_CMD").value;             
            if (hr_leave04_cmd==null || hr_leave04_cmd==''){
            document.getElementById("hr_leave04_cmd").style.display = "";     
            text_hr_leave04_cmd = "*กรุณาระบุรายละเอียด";
            document.getElementById("hr_leave04_cmd").innerHTML = text_hr_leave04_cmd;
            }else{
            document.getElementById("hr_leave04_cmd").style.display = "none";
            }
    }
    function check_hr_leave04_day()
    {                         
      hr_leave04_day = document.getElementById("HR_LEAVE04_DAY").value;             
            if (hr_leave04_day==null || hr_leave04_day==''){
            document.getElementById("hr_leave04_day").style.display = "";     
            text_hr_leave04_day = "*กรุณาระบุจำนวนวันลา";
            document.getElementById("hr_leave04_day").innerHTML = text_hr_leave04_day;
            }else{
            document.getElementById("hr_leave04_day").style.display = "none";
            }
    } 
  
   </script>
   <script>      
    $('form').submit(function () {
     
      var hr_person_type_name,text_hr_person_type_name;
      var hr_leave04_cmd,text_hr_leave04_cmd;
      var hr_leave04_day,text_hr_leave04_day;    
       
      hr_person_type_name = document.getElementById("HR_PERSON_TYPE_NAME").value;
      hr_leave04_cmd = document.getElementById("HR_LEAVE04_CMD").value;
      hr_leave04_day = document.getElementById("HR_LEAVE04_DAY").value;    
  
       
      if (hr_person_type_name==null || hr_person_type_name==''){
      document.getElementById("hr_person_type_name").style.display = "";     
      text_hr_person_type_name = "*กรุณาระบุกลุ่มบุคลากร";
      document.getElementById("hr_person_type_name").innerHTML = text_hr_person_type_name;
      }else{
      document.getElementById("hr_person_type_name").style.display = "none";
      }
      if (hr_leave04_cmd==null || hr_leave04_cmd==''){
      document.getElementById("hr_leave04_cmd").style.display = "";     
      text_hr_leave04_cmd = "*กรุณาระบุรายละเอียด";
      document.getElementById("hr_leave04_cmd").innerHTML = text_hr_leave04_cmd;
      }else{
      document.getElementById("hr_leave04_cmd").style.display = "none";
      }

      if (hr_leave04_day==null || hr_leave04_day==''){
      document.getElementById("hr_leave04_day").style.display = "";     
      text_hr_leave04_day = "*กรุณาระบุจำนวนวันลา";
      document.getElementById("hr_leave04_day").innerHTML = text_hr_leave04_day;
      }else{
      document.getElementById("hr_leave04_day").style.display = "none";
      }
     
  
      if(hr_person_type_name==null || hr_person_type_name=='' ||
      hr_leave04_cmd==null || hr_leave04_cmd==''||
      hr_leave04_day==null || hr_leave04_day==''       
      )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script> 

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection