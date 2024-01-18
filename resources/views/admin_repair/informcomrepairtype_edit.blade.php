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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทซ่อมเพื่อทำรายงาน</h2> 
    <form  method="post" action="{{ route('admin.updateinformcomrepairtype') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-2">
                                <label >ประเภทซ่อม</label>
                            </div>
                            <div class="col-lg-3">
                                <input  name = "COM_REPAIR_TYPE_NAME"  id="COM_REPAIR_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomrepairtypeT->COM_REPAIR_TYPE_NAME}}" onkeyup="check_comrepairtypename();">
                                <div style="color: red; font-size: 16px;" id="comrepairtypename"></div>
                            </div>
                            <div class="col-lg-2">
                                <label >รายละเอียด</label>
                            </div>
                            <div class="col-lg-5">
                                <input  name = "COM_REPAIR_TYPE_DETAIL"  id="COM_REPAIR_TYPE_DETAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomrepairtypeT->COM_REPAIR_TYPE_DETAIL}}" onkeyup="check_comrepairtypedetail();"> 
                                <div style="color: red; font-size: 16px;" id="comrepairtypedetail"></div> 
                            </div>
                        </div>                
                         <input type="hidden"  name = "COM_REPAIR_TYPE_ID"  id="COM_REPAIR_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomrepairtypeT->COM_REPAIR_TYPE_ID}}"> 
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupinformcomrepairtype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')
<script>   
    function check_comrepairtypename()
    {                         
        comrepairtypename = document.getElementById("COM_REPAIR_TYPE_NAME").value;             
            if (comrepairtypename==null || comrepairtypename==''){
            document.getElementById("comrepairtypename").style.display = "";     
            text_comrepairtypename = "*กรุณาระบุประเภทซ่อม";
            document.getElementById("comrepairtypename").innerHTML = text_comrepairtypename;
            }else{
            document.getElementById("comrepairtypename").style.display = "none";
            }
    }
    function check_comrepairtypedetail()
    {                         
        comrepairtypedetail = document.getElementById("COM_REPAIR_TYPE_DETAIL").value;             
            if (comrepairtypedetail==null || comrepairtypedetail==''){
            document.getElementById("comrepairtypedetail").style.display = "";     
            text_comrepairtypedetail = "*กรุณาระบุรายละเอียด";
            document.getElementById("comrepairtypedetail").innerHTML = text_comrepairtypedetail;
            }else{
            document.getElementById("comrepairtypedetail").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var comrepairtypename,text_comrepairtypename; 
      var comrepairtypedetail,text_comrepairtypedetail; 
     
      comrepairtypename = document.getElementById("COM_REPAIR_TYPE_NAME").value; 
      comrepairtypedetail = document.getElementById("COM_REPAIR_TYPE_DETAIL").value; 
   
                     
      if (comrepairtypename==null || comrepairtypename==''){
      document.getElementById("comrepairtypename").style.display = "";     
      text_comrepairtypename = "*กรุณาระบุประเภทซ่อม";
      document.getElementById("comrepairtypename").innerHTML = text_comrepairtypename;
      }else{
      document.getElementById("comrepairtypename").style.display = "none";
      }
      if (comrepairtypedetail==null || comrepairtypedetail==''){
      document.getElementById("comrepairtypedetail").style.display = "";     
      text_comrepairtypedetail = "*กรุณาระบุรายละเอียด";
      document.getElementById("comrepairtypedetail").innerHTML = text_comrepairtypedetail;
      }else{
      document.getElementById("comrepairtypedetail").style.display = "none";
      }
      
  
      if(comrepairtypename==null || comrepairtypename=='' ||
      comrepairtypedetail==null || comrepairtypedetail=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>


@endsection