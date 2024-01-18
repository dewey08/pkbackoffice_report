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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มเหตุการณ์</h2>
    <form  method="post" action="{{ route('admin.saveevent') }}" enctype="multipart/form-data">
        @csrf
                <div class="row push">
                    <div class="col-lg-2">
                        <label >เหตุการณ์</label>
                    </div>
                    <div class="col-lg-6">
                        <input  name = "SAFE_EVENT_NAME"  id="SAFE_EVENT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_safe_event_name();" >
                    <div style="color: red; font-size: 16px;" id="safe_event_name"></div>  
                </div>
               
            </div>
            </div>
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('admin_safe/setupevent')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
            </div> 
        </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_safe_event_name()
    {                         
        safe_event_name = document.getElementById("SAFE_EVENT_NAME").value;             
            if (safe_event_name==null || safe_event_name==''){
            document.getElementById("safe_event_name").style.display = "";     
            text_safe_event_name = "*กรุณาระบุเหตุการณ์";
            document.getElementById("safe_event_name").innerHTML = text_safe_event_name;
            }else{
            document.getElementById("safe_event_name").style.display = "none";
            }
    } 
   </script>
   <script>      
    $('form').submit(function () {
     
      var safe_event_name,text_safe_event_name;      
     
      safe_event_name = document.getElementById("SAFE_EVENT_NAME").value;   
                
      if (safe_event_name==null || safe_event_name==''){
      document.getElementById("safe_event_name").style.display = "";     
      text_safe_event_name = "*กรุณาระบุเหตุการณ์";
      document.getElementById("safe_event_name").innerHTML = text_safe_event_name;
      }else{
      document.getElementById("safe_event_name").style.display = "none";
      }
     
        
      if(safe_event_name==null || safe_event_name==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>


@endsection