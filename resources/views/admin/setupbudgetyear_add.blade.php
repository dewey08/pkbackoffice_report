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

    
        <form  method="post" action="{{ route('admin.savebudget') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-lg-1">
        <label >ปีงบประมาณ</label >
        </div>
       <div class="col-lg-3">
      <input name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_leave_year_id();">
      <div style="color: red; font-size: 16px;" id="leave_year_id"></div>  
    </div>
      <div class="col-lg-1">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input name="LEAVE_YEAR_NAME" id="LEAVE_YEAR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_leave_year_name();">
      <div style="color: red; font-size: 16px;" id="leave_year_name"></div>   
    </div>
    <div class="col-lg-1">
      <label >วันที่เริ่มต้น</label>
      </div>
      <div class="col-lg-3">
      <input name = "DATE_BEGIN" id="DATE_BEGIN" class="form-control input-lg datepicker" onchange="check_date_begin();" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" >
      <div style="color: red; font-size: 16px;" id="date_begin"></div>
    </div>
      </div>

      <div class="row push">
      <div class="col-lg-1">
      <label >วันสิ้นสุด</label>
      </div>
      <div class="col-lg-3">
      <input name = "DATE_END" id="DATE_END" class="form-control input-lg datepicker" onchange="check_date_end();" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;" >
      <div style="color: red; font-size: 16px;" id="date_end"></div>
    </div>

<div class="col-lg-2">
 
  <label >จำนวนวันลาต่อปีงบประมาณ</label>
  </div>
  <div class="col-lg-1">
      <input name="DAY_PER_YEAR" id="DAY_PER_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_date_per_year();">
      <div style="color: red; font-size: 16px;" id="date_per_year"></div>
    </div>
    <label >วัน</label>
       
    <input  type="hidden" name = "ACTIVE"  id="ACTIVE" class="form-control input-lg" value="False">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> บันทึกข้อมูล</button>
         <a href="{{ url('admin/setupinfobudget')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  function check_leave_year_id()
        {                         
          leave_year_id = document.getElementById("LEAVE_YEAR_ID").value;             
                if (leave_year_id==null || leave_year_id==''){
                document.getElementById("leave_year_id").style.display = "";     
                text_leave_year_id = "*กรุณาระบุปีงบประมาณ";
                document.getElementById("leave_year_id").innerHTML = text_leave_year_id;
                }else{
                document.getElementById("leave_year_id").style.display = "none";
                }
        }
        function check_leave_year_name()
        {                         
          leave_year_name = document.getElementById("LEAVE_YEAR_NAME").value;             
                if (leave_year_name==null || leave_year_name==''){
                document.getElementById("leave_year_name").style.display = "";     
                text_leave_year_name = "*กรุณาระบุรายละเอียด";
                document.getElementById("leave_year_name").innerHTML = text_leave_year_name;
                }else{
                document.getElementById("leave_year_name").style.display = "none";
                }
        }
        function check_date_begin()
        {                         
          date_begin = document.getElementById("DATE_BEGIN").value;             
                if (date_begin==null || date_begin==''){
                document.getElementById("date_begin").style.display = "";     
                text_date_begin = "*กรุณาระบุวันที่เริ่มต้น";
                document.getElementById("date_begin").innerHTML = text_date_begin;
                }else{
                document.getElementById("date_begin").style.display = "none";
                }
        }
        function check_date_end()
        {                         
          date_end = document.getElementById("DATE_END").value;             
                if (date_end==null || date_end==''){
                document.getElementById("date_end").style.display = "";     
                text_date_end = "*กรุณาระบุวันสิ้นสุด";
                document.getElementById("date_end").innerHTML = text_date_end;
                }else{
                document.getElementById("date_end").style.display = "none";
                }
        }
        function check_date_per_year()
        {                         
          date_per_year = document.getElementById("DAY_PER_YEAR").value;             
                if (date_per_year==null || date_per_year==''){
                document.getElementById("date_per_year").style.display = "";     
                text_date_per_year = "*กรุณาระบุจำนวนวันลาต่อปีงบประมาณ";
                document.getElementById("date_per_year").innerHTML = text_date_per_year;
                }else{
                document.getElementById("date_per_year").style.display = "none";
                }
        }
</script>
<script>
  $('form').submit(function () {
          var leave_year_id,text_leave_year_id;
          var leave_year_name,text_leave_year_name;
          var date_begin,text_date_begin;
          var date_end,text_date_end;
          var date_per_year,text_date_per_year;

          leave_year_id = document.getElementById("LEAVE_YEAR_ID").value;
          leave_year_name = document.getElementById("LEAVE_YEAR_NAME").value;
          date_begin = document.getElementById("DATE_BEGIN").value;
          date_end = document.getElementById("DATE_END").value;
          date_per_year = document.getElementById("DAY_PER_YEAR").value;

          if (leave_year_id==null || leave_year_id==''){
          document.getElementById("leave_year_id").style.display = "";     
          text_leave_year_id= "*กรุณาระบุปีงบประมาณ";
          document.getElementById("leave_year_id").innerHTML = text_leave_year_id;
          }else{
          document.getElementById("leave_year_id").style.display = "none";
          }
          if (leave_year_name==null || leave_year_name==''){
          document.getElementById("leave_year_name").style.display = "";     
          text_leave_year_name= "*กรุณาระบุรายละเอียด";
          document.getElementById("leave_year_name").innerHTML = text_leave_year_name;
          }else{
          document.getElementById("leave_year_name").style.display = "none";
          }
          if (date_begin==null || date_begin==''){
          document.getElementById("date_begin").style.display = "";     
          text_date_begin= "*กรุณาระบุวันที่เริ่มต้น";
          document.getElementById("date_begin").innerHTML = text_date_begin;
          }else{
          document.getElementById("date_begin").style.display = "none";
          }
          if (date_end==null || date_end==''){
          document.getElementById("date_end").style.display = "";     
          text_date_end= "*กรุณาระบุวันสิ้นสุด";
          document.getElementById("date_end").innerHTML = text_date_end;
          }else{
          document.getElementById("date_end").style.display = "none";
          }
          if (date_per_year==null || date_per_year==''){
          document.getElementById("date_per_year").style.display = "";     
          text_date_per_year= "*กรุณาระบุจำนวนวันลาต่อปีงบประมาณ";
          document.getElementById("date_per_year").innerHTML = text_date_per_year;
          }else{
          document.getElementById("date_per_year").style.display = "none";
          }
          if(leave_year_id==null || leave_year_id=='' ||
          leave_year_name==null || leave_year_name==''||
          date_begin==null || date_begin==''||
          date_end==null || date_end==''||
          date_per_year==null || date_per_year==''
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
            });  //กำหนดเป็นวันปัจุบัน .datepicker("setDate", 0);
      
});    
</script>
@endsection