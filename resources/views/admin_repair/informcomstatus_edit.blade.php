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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขสถานะ</h2> 
    <form  method="post" action="{{ route('admin.updateInformcomstatus') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-1">
                                <label >สถานะ</label>
                            </div>
                            <div class="col-lg-5">
                                <input  name = "STATUS_NAME"  id="STATUS_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoInformcomstatusT->STATUS_NAME}}" onkeyup="check_statusname();">
                                <div style="color: red; font-size: 16px;" id="statusname"></div> 
                            </div>
                            <div class="col-lg-6">
                                
                            </div>                       
                        <input type="hidden"  name = "STATUS_ID"  id="STATUS_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoInformcomstatusT->STATUS_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/SetupInformcomstatus')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')
<script>   
    function check_statusname()
    {                         
        statusname = document.getElementById("STATUS_NAME").value;             
            if (statusname==null || statusname==''){
            document.getElementById("statusname").style.display = "";     
            text_statusname = "*กรุณาระบุสถานะ";
            document.getElementById("statusname").innerHTML = text_statusname;
            }else{
            document.getElementById("statusname").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var statusname,text_statusname; 
     
      statusname = document.getElementById("STATUS_NAME").value; 
   
                     
      if (statusname==null || statusname==''){
      document.getElementById("statusname").style.display = "";     
      text_statusname = "*กรุณาระบุสถานะ";
      document.getElementById("statusname").innerHTML = text_statusname;
      }else{
      document.getElementById("statusname").style.display = "none";
      }
  
  
      if(statusname==null || statusname==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>


@endsection