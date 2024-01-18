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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลลักษณะการไป</h2>    

    
        <form  method="post" action="{{ route('admin.updatego') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
   
      <label >รหัส {{ $infogo->RECORD_GO_ID }}</label>
      <input type = "hidden"  name = "RECORD_GO_ID"  id="RECORD_GO_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infogo->RECORD_GO_ID }}">
      </div>

      <div class="col-lg-2">
      <label >ลักษณะการไป</label>
      </div>
      <div class="col-lg-4">
      <input  name = "RECORD_GO_NAME"  id="RECORD_GO_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infogo->RECORD_GO_NAME }}" onkeyup="check_record_go_name();">
      <div style="color: red; font-size: 16px;" id="record_go_name"></div>
    </div>

    

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_dev/setupinfogo')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
  function check_record_go_name()
  {                         
    record_go_name = document.getElementById("RECORD_GO_NAME").value;             
          if (record_go_name==null || record_go_name==''){
          document.getElementById("record_go_name").style.display = "";     
          text_record_go_name = "*กรุณาระบุลักษณะการไป";
          document.getElementById("record_go_name").innerHTML = text_record_go_name;
          }else{
          document.getElementById("record_go_name").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var record_go_name,text_record_go_name;
        
    record_go_name = document.getElementById("RECORD_GO_NAME").value;
     
    if (record_go_name==null || record_go_name==''){
    document.getElementById("record_go_name").style.display = "";     
    text_record_go_name = "*กรุณาระบุลักษณะการไป";
    document.getElementById("record_go_name").innerHTML = text_record_go_name;
    }else{
    document.getElementById("record_go_name").style.display = "none";
    }
   
   

    if(record_go_name==null || record_go_name==''
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