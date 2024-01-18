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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มระดับความรุนแรง</h2>    

    
        <form  method="post" action="{{ route('srisk.setupincidence_level_save') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">       
          <div class="col-lg-2 text-right">
            <label >รหัส :</label>
            </div>
            <div class="col-lg-4">
            <input  name = "INCIDENCE_LEVEL_CODE"  id="INCIDENCE_LEVEL_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkrecord_code();">
            <div style="color: red; font-size: 16px;" id="record_code"></div>
          </div>
          <div class="col-lg-2 text-right">
            <label >ระดับความรุนแรง :</label>
            </div>
            <div class="col-lg-4">
            <input  name = "INCIDENCE_LEVEL_NAME"  id="INCIDENCE_LEVEL_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkrecord_name();">
            <div style="color: red; font-size: 16px;" id="record_name"></div>
          </div>
          </div>
       
      <div class="row push">
<div class="col-sm-2 text-right">
<label>รายละเอียดความรุนแรง :</label>
</div> 
<div class="col-lg-10 ">
<textarea name="INCIDENCE_LEVEL_NAME_DETAIL" id="INCIDENCE_LEVEL_NAME_DETAIL" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" rows="3" onkeyup="checkrecord_name_detail();"></textarea>
<div style="color: red; font-size: 16px;" id="record_name_detail"></div>
</div>
</div>



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_risk/setupincidence_level')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
  function checkrecord_code()
  {                         
    record_code = document.getElementById("INCIDENCE_LEVEL_CODE").value;             
          if (record_code==null || record_code==''){
          document.getElementById("record_code").style.display = "";     
          text_record_code = "*กรุณาระบุชื่อรหัส";
          document.getElementById("record_code").innerHTML = text_record_code;
          }else{
          document.getElementById("record_code").style.display = "none";
          }
  } 
  function checkrecord_name()
  {                         
    record_name = document.getElementById("INCIDENCE_LEVEL_NAME").value;             
          if (record_name==null || record_name==''){
          document.getElementById("record_name").style.display = "";     
          text_record_name = "*กรุณาระบุระดับ";
          document.getElementById("record_name").innerHTML = text_record_name;
          }else{
          document.getElementById("record_name").style.display = "none";
          }
  } 
  function checkrecord_name_detail()
  {                         
    record_name_detail = document.getElementById("INCIDENCE_LEVEL_NAME_DETAIL").value;             
          if (record_name_detail==null || record_name_detail==''){
          document.getElementById("record_name_detail").style.display = "";     
          text_record_name_detail = "*กรุณาระบุรายละเอียด";
          document.getElementById("record_name_detail").innerHTML = text_record_name_detail;
          }else{
          document.getElementById("record_name_detail").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var record_code,text_record_code;
    var record_name,text_record_name;
    var record_name_detail,text_record_name_detail;
        
    record_code = document.getElementById("INCIDENCE_LEVEL_CODE").value;
    record_name = document.getElementById("INCIDENCE_LEVEL_NAME").value;
    record_name_detail = document.getElementById("INCIDENCE_LEVEL_NAME_DETAIL").value;
     
    if (record_code==null || record_code==''){
    document.getElementById("record_code").style.display = "";     
    text_record_code = "*กรุณาระบุรหัส";
    document.getElementById("record_code").innerHTML = text_record_code;
    }else{
    document.getElementById("record_code").style.display = "none";
    }

    if (record_name==null || record_name==''){
    document.getElementById("record_name").style.display = "";     
    text_record_name = "*กรุณาระบุระดับ";
    document.getElementById("record_name").innerHTML = text_record_name;
    }else{
    document.getElementById("record_name").style.display = "none";
    }

    if (record_name_detail==null || record_name_detail==''){
    document.getElementById("record_name_detail").style.display = "";     
    text_record_name_detail = "*กรุณาระบุรายละเอียด";
    document.getElementById("record_name_detail").innerHTML = text_record_name_detail;
    }else{
    document.getElementById("record_name_detail").style.display = "none";
    }
   
   

    if(record_code==null || record_code=='',
    record_name==null || record_name=='',
    record_name_detail==null || record_name_detail=='')
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