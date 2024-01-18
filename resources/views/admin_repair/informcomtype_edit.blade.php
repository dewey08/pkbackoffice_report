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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขประเภทครุภัณฑ์ตามมูลค่า</h2> 
    <form  method="post" action="{{ route('admin.updateinformcomtype') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-2">
                                <label >ชื่อประเภท</label>
                            </div>
                            <div class="col-lg-4">
                                <input  name = "COM_TYPE_NAME"  id="COM_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomtypeT->COM_TYPE_NAME}}" onkeyup="check_comtypename();">
                                <div style="color: red; font-size: 16px;" id="comtypename"></div> 
                            </div>
                            <div class="col-lg-6">
                                
                            </div>                       
                        <input type="hidden"  name = "COM_TYPE_ID"  id="COM_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomtypeT->COM_TYPE_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupinformcomtype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_comtypename()
    {                         
        comtypename = document.getElementById("COM_TYPE_NAME").value;             
            if (comtypename==null || comtypename==''){
            document.getElementById("comtypename").style.display = "";     
            text_comtypename = "*กรุณาระบุชื่อประเภท";
            document.getElementById("comtypename").innerHTML = text_comtypename;
            }else{
            document.getElementById("comtypename").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var comtypename,text_comtypename; 
     
      comtypename = document.getElementById("COM_TYPE_NAME").value; 
   
                     
      if (comtypename==null || comtypename==''){
      document.getElementById("comtypename").style.display = "";     
      text_comtypename = "*กรุณาระบุชื่อประเภท";
      document.getElementById("comtypename").innerHTML = text_comtypename;
      }else{
      document.getElementById("comtypename").style.display = "none";
      }
  
  
      if(comtypename==null || comtypename==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection