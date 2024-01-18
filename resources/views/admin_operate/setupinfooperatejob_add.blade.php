@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />



@section('content')
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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลเวร</h2>    

    
        <form  method="post" action="{{ route('admin.saveoperatejob') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-1">
      <label >ชื่อเวร</label>
      </div>
      <div class="col-lg-3">
      <input  name = "OPERATE_JOB_NAME"  id="OPERATE_JOB_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_operate_job_name();">
      <div style="color: red; font-size: 16px;" id="operate_job_name"></div>
    </div>
   
    <div class="col-lg-1">
      <label >เวลาเริ่มต้น</label>
      </div>
      <div class="col-lg-1">
      <input type="text" class="js-masked-time form-control" id="OPERATE_JOB_TIMEBIGEN" name="OPERATE_JOB_TIMEBIGEN" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" onchange="check_operate_job_timebigen();">
      <div style="color: red; font-size: 16px;" id="operate_job_timebigen"></div>
    </div>
 
    <div class="col-lg-1"> 
      <label >เวลาสิ้นสุด</label>
       </div>
       <div class="col-lg-1"> 
      <input type="text" class="js-masked-time form-control" id="OPERATE_JOB_TIMEEND" name="OPERATE_JOB_TIMEEND" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" onchange="check_operate_job_timeend();">
      <div style="color: red; font-size: 16px;" id="operate_job_timeend"></div>
    </div>

    <div class="col-lg-1">
     
      <label >หน่วยงาน</label>
     </div>
     <div class="col-lg-3">
      <select name="OPERATE_DEPARTMENT_SUB_SUB_ID" id="OPERATE_DEPARTMENT_SUB_SUB_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_operate_department_subsub_id();">
        <option value="" selected>--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($hrd_departments as $hrd_department)                    
                            <option value="{{ $hrd_department -> HR_DEPARTMENT_SUB_SUB_ID }}">{{ $hrd_department -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>           
                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="operate_department_subsub_id"></div>   
      </div>
    </div>

      <div class="row push">
       
       <div class="col-lg-1">
      
         <label >จำนวนเงิน</label>
         </div>
         <div class="col-lg-3">
         <input  name = "OPERATE_JOB_MONEY"  id="OPERATE_JOB_MONEY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_operate_job_money();chkmunny();">
         <div style="color: red; font-size: 16px;" id="operate_job_money"></div>
        </div>
       
       <div class="col-lg-1">
    
         <label >ประเภทเวร</label>
        </div>
        <div class="col-lg-3">
         <select name="OPERATE_JOB_TYPE_ID" id="OPERATE_JOB_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_operate_job_type_id();">
        <option value="" selected>--กรุณาเลือกประเภทเวร--</option>
                            @foreach ($operatetypes as $operatetype)                    
                            <option value="{{ $operatetype -> OPERATE_TYPE_ID }}">{{ $operatetype -> OPERATE_TYPE_NAME }}</option>           
                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="operate_job_type_id"></div>   
         </div>
 
       <div class="col-lg-1"> 
 
         <label >รายละเอียด</label>
         </div>
         <div class="col-lg-3"> 

         <input  name = "OPERATE_JOB_DETAIL"  id="OPERATE_JOB_DETAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_operate_job_detail();">
         <div style="color: red; font-size: 16px;" id="operate_job_detail"></div>
        </div>
       </div>
    
       <div class="row push">
       
       <div class="col-lg-1">
         <label >สี</label>
         </div>
         <div class="col-lg-3">
         <select name="OPERATE_JOB_COLOR" id="OPERATE_JOB_COLOR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_operate_job_color();">
        <option value="" selected>--กรุณาเลือกสีเวร-</option>
                            @foreach ($operatecolors as $operatecolor)                    
                            <option value="{{ $operatecolor -> OPERATE_COLOR_CODE }}" style="background-color: {{$operatecolor -> OPERATE_COLOR_CODE }}; "><div style="background-color: {{$operatecolor -> OPERATE_COLOR_CODE }}; "></div>{{ $operatecolor -> OPERATE_COLOR_NAME }}</option>           
                            @endforeach 
        </select>    
        <div style="color: red; font-size: 16px;" id="operate_job_color"></div>
         </div>
       </div>
     

  
         
         </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>  บันทึกข้อมูล</button>
         <a href="{{ url('admin_operate/setupoperatejob')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>   ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
                  

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>


<script>
  $(document).ready(function() {
$('select').select2();
});
   
    function check_operate_job_name()
    {                         
      operate_job_name = document.getElementById("OPERATE_JOB_NAME").value;             
            if (operate_job_name==null || operate_job_name==''){
            document.getElementById("operate_job_name").style.display = "";     
            text_operate_job_name = "*กรุณาระบุชื่อเวร";
            document.getElementById("operate_job_name").innerHTML = text_operate_job_name;
            }else{
            document.getElementById("operate_job_name").style.display = "none";
            }
    }
    function check_operate_job_timebigen()
    {                         
      operate_job_timebigen = document.getElementById("OPERATE_JOB_TIMEBIGEN").value;             
            if (operate_job_timebigen==null || operate_job_timebigen==''){
            document.getElementById("operate_job_timebigen").style.display = "";     
            text_operate_job_timebigen = "*กรุณาระบุเวลาเริ่มต้น";
            document.getElementById("operate_job_timebigen").innerHTML = text_operate_job_timebigen;
            }else{
            document.getElementById("operate_job_timebigen").style.display = "none";
            }
    }
    function check_operate_job_timeend()
    {                         
      operate_job_timeend = document.getElementById("OPERATE_JOB_TIMEEND").value;             
            if (operate_job_timeend==null || operate_job_timeend==''){
            document.getElementById("operate_job_timeend").style.display = "";     
            text_operate_job_timeend = "*กรุณาระบุเวลาสิ้นสุด";
            document.getElementById("operate_job_timeend").innerHTML = text_operate_job_timeend;
            }else{
            document.getElementById("operate_job_timeend").style.display = "none";
            }
    }
    function check_operate_department_subsub_id()
    {                         
      operate_department_subsub_id = document.getElementById("OPERATE_DEPARTMENT_SUB_SUB_ID").value;             
            if (operate_department_subsub_id==null || operate_department_subsub_id==''){
            document.getElementById("operate_department_subsub_id").style.display = "";     
            text_operate_department_subsub_id = "*กรุณาระบุหน่วยงาน";
            document.getElementById("operate_department_subsub_id").innerHTML = text_operate_department_subsub_id;
            }else{
            document.getElementById("operate_department_subsub_id").style.display = "none";
            }
    }
    function check_operate_job_money()
    {                         
      operate_job_money = document.getElementById("OPERATE_JOB_MONEY").value;             
            if (operate_job_money==null || operate_job_money==''){
            document.getElementById("operate_job_money").style.display = "";     
            text_operate_job_money = "*กรุณาระบุจำนวนเงิน";
            document.getElementById("operate_job_money").innerHTML = text_operate_job_money;
            }else{
            document.getElementById("operate_job_money").style.display = "none";
            }
    }
    function check_operate_job_type_id()
    {                         
      operate_job_type_id = document.getElementById("OPERATE_JOB_TYPE_ID").value;             
            if (operate_job_type_id==null || operate_job_type_id==''){
            document.getElementById("operate_job_type_id").style.display = "";     
            text_operate_job_type_id = "*กรุณาระบุประเภทเวร";
            document.getElementById("operate_job_type_id").innerHTML = text_operate_job_type_id;
            }else{
            document.getElementById("operate_job_type_id").style.display = "none";
            }
    }
    function check_operate_job_detail()
    {                         
      operate_job_detail = document.getElementById("OPERATE_JOB_DETAIL").value;             
            if (operate_job_detail==null || operate_job_detail==''){
            document.getElementById("operate_job_detail").style.display = "";     
            text_operate_job_detail = "*กรุณาระบุรายละเอียด";
            document.getElementById("operate_job_detail").innerHTML = text_operate_job_detail;
            }else{
            document.getElementById("operate_job_detail").style.display = "none";
            }
    }
    function check_operate_job_color()
    {                         
      operate_job_color = document.getElementById("OPERATE_JOB_COLOR").value;             
            if (operate_job_color==null || operate_job_color==''){
            document.getElementById("operate_job_color").style.display = "";     
            text_operate_job_color = "*กรุณาเลือกสีเวร";
            document.getElementById("operate_job_color").innerHTML = text_operate_job_color;
            }else{
            document.getElementById("operate_job_color").style.display = "none";
            }
    }
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var operate_job_name,text_operate_job_name;
      var operate_job_timebigen,text_operate_job_timebigen;
      var operate_job_timeend,text_operate_job_timeend;
      var operate_department_subsub_id,text_operate_department_subsub_id;      
      var operate_job_money,text_operate_job_money;
      var operate_job_type_id,text_operate_job_type_id;
      var operate_job_detail,text_operate_job_detail;
      var operate_job_color,text_operate_job_color;
     
      operate_job_name = document.getElementById("OPERATE_JOB_NAME").value;
      operate_job_timebigen = document.getElementById("OPERATE_JOB_TIMEBIGEN").value;
      operate_job_timeend = document.getElementById("OPERATE_JOB_TIMEEND").value;
      operate_department_subsub_id = document.getElementById("OPERATE_DEPARTMENT_SUB_SUB_ID").value;
      operate_job_money = document.getElementById("OPERATE_JOB_MONEY").value;
      operate_job_type_id = document.getElementById("OPERATE_JOB_TYPE_ID").value;
      operate_job_detail = document.getElementById("OPERATE_JOB_DETAIL").value;
      operate_job_color = document.getElementById("OPERATE_JOB_COLOR").value;         
       
      if (operate_job_name==null || operate_job_name==''){
      document.getElementById("operate_job_name").style.display = "";     
      text_operate_job_name = "*กรุณาระบุชื่อเวร";
      document.getElementById("operate_job_name").innerHTML = text_operate_job_name;
      }else{
      document.getElementById("operate_job_name").style.display = "none";
      }
      if (operate_job_timebigen==null || operate_job_timebigen==''){
      document.getElementById("operate_job_timebigen").style.display = "";     
      text_operate_job_timebigen = "*กรุณาระบุเวลาเริ่มต้น";
      document.getElementById("operate_job_timebigen").innerHTML = text_operate_job_timebigen;
      }else{
      document.getElementById("operate_job_timebigen").style.display = "none";
      }
      if (operate_job_timeend==null || operate_job_timeend==''){
      document.getElementById("operate_job_timeend").style.display = "";     
      text_operate_job_timeend = "*กรุณาระบุเวลาสิ้นสุด";
      document.getElementById("operate_job_timeend").innerHTML = text_operate_job_timeend;
      }else{
      document.getElementById("operate_job_timeend").style.display = "none";
      }
      if (operate_department_subsub_id==null || operate_department_subsub_id==''){
      document.getElementById("operate_department_subsub_id").style.display = "";     
      text_operate_department_subsub_id = "*กรุณาระบุหน่วยงาน";
      document.getElementById("operate_department_subsub_id").innerHTML = text_operate_department_subsub_id;
      }else{
      document.getElementById("operate_department_subsub_id").style.display = "none";
      }
      if (operate_job_money==null || operate_job_money==''){
      document.getElementById("operate_job_money").style.display = "";     
      text_operate_job_money = "*กรุณาระบุจำนวนเงิน";
      document.getElementById("operate_job_money").innerHTML = text_operate_job_money;
      }else{
      document.getElementById("operate_job_money").style.display = "none";
      }
      if (operate_job_type_id==null || operate_job_type_id==''){
      document.getElementById("operate_job_type_id").style.display = "";     
      text_operate_job_type_id = "*กรุณาระบุประเภทเวร";
      document.getElementById("operate_job_type_id").innerHTML = text_operate_job_type_id;
      }else{
      document.getElementById("operate_job_type_id").style.display = "none";
      }
      if (operate_job_detail==null || operate_job_detail==''){
      document.getElementById("operate_job_detail").style.display = "";     
      text_operate_job_detail = "*กรุณาระบุรายละเอียด";
      document.getElementById("operate_job_detail").innerHTML = text_operate_job_detail;
      }else{
      document.getElementById("operate_job_detail").style.display = "none";
      }
      if (operate_job_color==null || operate_job_color==''){
      document.getElementById("operate_job_color").style.display = "";     
      text_operate_job_color = "*กรุณาเลือกสีเวร";
      document.getElementById("operate_job_color").innerHTML = text_operate_job_color;
      }else{
      document.getElementById("operate_job_color").style.display = "none";
      }
        
      if(operate_job_name==null || operate_job_name==''||
      operate_job_timebigen==null || operate_job_timebigen==''||
      operate_job_timeend==null || operate_job_timeend==''||
      operate_department_subsub_id==null || operate_department_subsub_id==''||
      operate_job_money==null || operate_job_money==''||
      operate_job_type_id==null || operate_job_type_id==''||
      operate_job_detail==null || operate_job_detail==''||
      operate_job_color==null || operate_job_color==''
    )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>


<script>
function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});

</script>
@endsection