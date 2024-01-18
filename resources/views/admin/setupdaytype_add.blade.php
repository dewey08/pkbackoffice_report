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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทวันลา</h2>    

    
        <form  method="post" action="{{ route('admin.savedaytype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
      <div>&nbsp;</div>
      <div class="col-sm-1">
      <label >รหัส</label>
      </div>
      <div class="col-sm-3 text-left">
      <input  name = "DAY_TYPE_ID"  id="DAY_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_day_type_id();">
      <div style="color: red; font-size: 16px;" id="day_type_id"></div>
    </div>
   
      <div class="col-sm-2">
      <label >ประเภทวันลา</label>
      </div>
      <div class="col-sm-3 text-left">
      <input  name = "DAY_TYPE_NAME"  id="DAY_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_day_type_name();" >
      <div style="color: red; font-size: 16px;" id="day_type_name"></div>
    </div>

    

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin/setupinfodaytype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  function check_day_type_id()
  {                         
    day_type_id = document.getElementById("DAY_TYPE_ID").value;             
          if (day_type_id==null || day_type_id==''){
          document.getElementById("day_type_id").style.display = "";     
          text_day_type_id = "*กรุณาระบุรหัส";
          document.getElementById("day_type_id").innerHTML = text_day_type_id;
          }else{
          document.getElementById("day_type_id").style.display = "none";
          }
  }
  function check_day_type_name()
  {                         
    day_type_name = document.getElementById("DAY_TYPE_NAME").value;             
          if (day_type_name==null || day_type_name==''){
          document.getElementById("day_type_name").style.display = "";     
          text_day_type_name = "*กรุณาระบุประเภทวันลา";
          document.getElementById("day_type_name").innerHTML = text_day_type_name;
          }else{
          document.getElementById("day_type_name").style.display = "none";
          }
  }

</script>
<script>      
  $('form').submit(function () {
    var day_type_id,text_day_type_id;
    var day_type_name,text_day_type_name;

    day_type_id = document.getElementById("DAY_TYPE_ID").value;
    day_type_name = document.getElementById("DAY_TYPE_NAME").value;

    if (day_type_id==null || day_type_id==''){
    document.getElementById("day_type_id").style.display = "";     
    text_day_type_id= "*กรุณาระบุรหัส";
    document.getElementById("day_type_id").innerHTML = text_day_type_id;
    }else{
    document.getElementById("day_type_id").style.display = "none";
    }
    if (day_type_name==null || day_type_name==''){
    document.getElementById("day_type_name").style.display = "";     
    text_day_type_name= "*กรุณาระบุประเภทวันลา";
    document.getElementById("day_type_name").innerHTML = text_day_type_name;
    }else{
    document.getElementById("day_type_name").style.display = "none";
    }

    if(day_type_id==null || day_type_id==''||
    day_type_name==null || day_type_name==''          
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