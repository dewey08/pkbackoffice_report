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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลตำแหน่ง</h2>    

    
        <form  method="post" action="{{ route('admin.saveposition') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-1">
      <label >รหัส</label>
      </div>
      <div class="col-lg-3">
      <input name="HR_POSITION_ID" id="HR_POSITION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_hr_position_id();">
      <div style="color: red; font-size: 16px;" id="hr_position_id"></div>
    </div>
      <div class="col-lg-1">
      <label >ตำแหน่ง</label>
      </div>
      <div class="col-lg-3">
      <input name="HR_POSITION_NAME" id="HR_POSITION_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_hr_position_name();" >
      <div style="color: red; font-size: 16px;" id="hr_position_name"></div>
    </div>

    <input type="hidden" name ="HR_POSITION_CHECK_HOLIDAY" id="HR_POSITION_CHECK_HOLIDAY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="False">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin/setupinfoposition')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการบันทึกข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')


<script>
  function check_hr_position_id()
  {                         
    hr_position_id = document.getElementById("HR_POSITION_ID").value;             
          if (hr_position_id==null || hr_position_id==''){
          document.getElementById("hr_position_id").style.display = "";     
          text_hr_position_id = "*กรุณาระบุรหัส";
          document.getElementById("hr_position_id").innerHTML = text_hr_position_id;
          }else{
          document.getElementById("hr_position_id").style.display = "none";
          }
  }
  function check_hr_position_name()
  {                         
    hr_position_name = document.getElementById("HR_POSITION_NAME").value;             
          if (hr_position_name==null || hr_position_name==''){
          document.getElementById("hr_position_name").style.display = "";     
          text_hr_position_name = "*กรุณาระบุตำแหน่ง";
          document.getElementById("hr_position_name").innerHTML = text_hr_position_name;
          }else{
          document.getElementById("hr_position_name").style.display = "none";
          }
  }

</script>
<script>      
  $('form').submit(function () {
    var hr_position_id,text_hr_position_id;
    var hr_position_name,text_hr_position_name;

    hr_position_id = document.getElementById("HR_POSITION_ID").value;
    hr_position_name = document.getElementById("HR_POSITION_NAME").value;

    if (hr_position_id==null || hr_position_id==''){
    document.getElementById("hr_position_id").style.display = "";     
    text_hr_position_id= "*กรุณาระบุรหัส";
    document.getElementById("hr_position_id").innerHTML = text_hr_position_id;
    }else{
    document.getElementById("hr_position_id").style.display = "none";
    }
    if (hr_position_name==null || hr_position_name==''){
    document.getElementById("hr_position_name").style.display = "";     
    text_hr_position_name= "*กรุณาระบุตำแหน่ง";
    document.getElementById("hr_position_name").innerHTML = text_hr_position_name;
    }else{
    document.getElementById("hr_position_name").style.display = "none";
    }

    if(hr_position_id==null || hr_position_id==''||
    hr_position_name==null || hr_position_name==''          
    )
{
alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
return false;   
}
}); 

</script>


@endsection