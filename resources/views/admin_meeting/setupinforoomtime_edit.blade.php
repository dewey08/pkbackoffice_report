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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลช่วงเวลา</h2>    

    
        <form  method="post" action="{{ route('admin.updateroomtime') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
        <div class="col-lg-2">
      <label >รายละเอียดช่วงเวลา</label>
      </div>
      <div class="col-lg-4">
      <input  name = "TIME_SC_NAME"  id="TIME_SC_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infotime->TIME_SC_NAME}}" onkeyup="check_time_sc_name();">
      <div style="color: red; font-size: 16px;" id="time_sc_name"></div> 
    </div>
     
     <div class="col-lg-1">
      <label >เริ่มต้น</label>
      </div>
      <div class="col-lg-2">
      <input  name = "TIME_SC_BEGIN"  id="TIME_SC_BEGIN" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$infotime->TIME_SC_BEGIN}}" onchange="check_time_sc_begin();">
      <div style="color: red; font-size: 16px;" id="time_sc_begin"></div> 
    </div>
   
      <div class="col-lg-1">
      <label >สิ้นสุด</label>
      </div>
      <div class="col-lg-2">
      <input  name = "TIME_SC_END"  id="TIME_SC_END" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$infotime->TIME_SC_END}}" onchange="check_time_sc_end();">
      <div style="color: red; font-size: 16px;" id="time_sc_end"></div> 
    </div>
  
      <input  type="hidden" name = "TIME_SC_ID"  id="TIME_SC_ID" class="form-control input-lg" value="{{$infotime->TIME_SC_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_meeting/setupinforoomtime')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      

@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script>
   
        function check_time_sc_name()
        {                         
            time_sc_name = document.getElementById("TIME_SC_NAME").value;             
                if (time_sc_name==null || time_sc_name==''){
                document.getElementById("time_sc_name").style.display = "";     
                text_time_sc_name = "*กรุณาระบุรายละเอียดช่วงเวลา";
                document.getElementById("time_sc_name").innerHTML = text_time_sc_name;
                }else{
                document.getElementById("time_sc_name").style.display = "none";
                }
        }
        function check_time_sc_begin()
        {                         
            time_sc_begin = document.getElementById("TIME_SC_BEGIN").value;             
                if (time_sc_begin==null || time_sc_begin==''){
                document.getElementById("time_sc_begin").style.display = "";     
                text_time_sc_begin = "*กรุณาระบุเริ่มต้น";
                document.getElementById("time_sc_begin").innerHTML = text_time_sc_begin;
                }else{
                document.getElementById("time_sc_begin").style.display = "none";
                }
        }
        function check_time_sc_end()
        {                         
            time_sc_end = document.getElementById("TIME_SC_END").value;             
                if (time_sc_end==null || time_sc_end==''){
                document.getElementById("time_sc_end").style.display = "";     
                text_time_sc_end = "*กรุณาระบุสิ้นสุด";
                document.getElementById("time_sc_end").innerHTML = text_time_sc_end;
                }else{
                document.getElementById("time_sc_end").style.display = "none";
                }
        }
      
       
       </script>
       <script>      
        $('form').submit(function () {
         
          var time_sc_name,text_time_sc_name;
          var time_sc_begin,text_time_sc_begin;
          var time_sc_end,text_time_sc_end;
                   
          time_sc_name = document.getElementById("TIME_SC_NAME").value;
          time_sc_begin = document.getElementById("TIME_SC_BEGIN").value;
          time_sc_end = document.getElementById("TIME_SC_END").value;
               
           
          if (time_sc_name==null || time_sc_name==''){
          document.getElementById("time_sc_name").style.display = "";     
          text_time_sc_name = "*กรุณาระบุรายละเอียดช่วงเวลา";
          document.getElementById("time_sc_name").innerHTML = text_time_sc_name;
          }else{
          document.getElementById("time_sc_name").style.display = "none";
          }
          if (time_sc_begin==null || time_sc_begin==''){
          document.getElementById("time_sc_begin").style.display = "";     
          text_time_sc_begin = "*กรุณาระบุเริ่มต้น";
          document.getElementById("time_sc_begin").innerHTML = text_time_sc_begin;
          }else{
          document.getElementById("time_sc_begin").style.display = "none";
          }
          if (time_sc_end==null || time_sc_end==''){
          document.getElementById("time_sc_end").style.display = "";     
          text_time_sc_end = "*กรุณาระบุสิ้นสุด";
          document.getElementById("time_sc_end").innerHTML = text_time_sc_end;
          }else{
          document.getElementById("time_sc_end").style.display = "none";
          }
         
          if(time_sc_name==null || time_sc_name==''||
          time_sc_begin==null || time_sc_begin==''||
          time_sc_end==null || time_sc_end=='')
        {
        alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
        return false;   
        }
        }); 
      </script>
    
    
<script>

<script>
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