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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขโปรแกรมที่ใช้ติดตั้ง</h2> 
    <form  method="post" action="{{ route('admin.updateinformcomprogram') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-2">
                                <label >ชื่อโปรแกรม</label>
                            </div>
                            <div class="col-lg-4">
                                <input  name = "PRO_NAME"  id="PRO_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$comprogramT->PRO_NAME}}" onkeyup="check_proname();">
                                <div style="color: red; font-size: 16px;" id="proname"></div> 
                            </div>
                            <div class="col-lg-2">
                                    <label >เวอร์ชัน</label>
                                </div>
                            <div class="col-lg-4">
                                <input  name = "PRO_VER"  id="PRO_VER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$comprogramT->PRO_VER}}" onkeyup="check_prover();">
                                <div style="color: red; font-size: 16px;" id="prover"></div> 
                            </div>
                                            
                        <input type="hidden"  name = "PRO_ID"  id="PRO_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$comprogramT->PRO_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupinformcomprogram')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_proname()
    {                         
        proname = document.getElementById("PRO_NAME").value;             
            if (proname==null || proname==''){
            document.getElementById("proname").style.display = "";     
            text_proname = "*กรุณาระบุชื่อโปรแกรม";
            document.getElementById("proname").innerHTML = text_proname;
            }else{
            document.getElementById("proname").style.display = "none";
            }
    }
    function check_prover()
    {                         
        prover = document.getElementById("PRO_VER").value;             
            if (prover==null || prover==''){
            document.getElementById("prover").style.display = "";     
            text_prover = "*กรุณาระบุเวอร์ชั่น";
            document.getElementById("prover").innerHTML = text_prover;
            }else{
            document.getElementById("prover").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var proname,text_proname; 
      var prover,text_prover; 
     
      proname = document.getElementById("PRO_NAME").value; 
      prover = document.getElementById("PRO_VER").value;
   
                     
      if (proname==null || proname==''){
      document.getElementById("proname").style.display = "";     
      text_proname = "*กรุณาระบุชื่อโปรแกรม";
      document.getElementById("proname").innerHTML = text_proname;
      }else{
      document.getElementById("proname").style.display = "none";
      }
      if (prover==null || prover==''){
      document.getElementById("prover").style.display = "";     
      text_prover = "*กรุณาระบุเวอร์ชั่น";
      document.getElementById("prover").innerHTML = text_prover;
      }else{
      document.getElementById("prover").style.display = "none";
      }
  
      if(proname==null || proname=='' ||
      prover==null || prover==''    
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection