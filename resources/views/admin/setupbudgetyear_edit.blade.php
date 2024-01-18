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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลปีงบประมาณ</h2>    

    
        <form  method="post" action="{{ route('admin.updatebudget') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-lg-1">
        <label >ปีงบประมาณ </label >
        </div>
       <div class="col-lg-3">
       <input  name = "LEAVE_YEAR_ID"  id="LEAVE_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforbudget->LEAVE_YEAR_ID }}">
       </div>
      <div class="col-lg-1">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "LEAVE_YEAR_NAME"  id="LEAVE_YEAR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforbudget->LEAVE_YEAR_NAME }}">
      </div>
    <div class="col-lg-1">
      <label >วันที่เริ่มต้น</label>
      </div>
      <div class="col-lg-3">
      <input  name = "DATE_BEGIN"  id="DATE_BEGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{ formate($inforbudget -> DATE_BEGIN) }}" readonly>
      </div>
      </div>

      <div class="row push">
      <div class="col-lg-1">
      <label >วันสิ้นสุด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" value="{{ formate($inforbudget -> DATE_END) }}" readonly>
      </div>

    <div class="col-lg-2">
     
      <label >จำนวนวันลาต่อปีงบประมาณ</label>
      </div>
      <div class="col-lg-1">
      <input  name = "DAY_PER_YEAR"  id="DAY_PER_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforbudget->DAY_PER_YEAR }}">
      </div>
      <label >วัน</label>
 
       
   

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin/setupinfobudget')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



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