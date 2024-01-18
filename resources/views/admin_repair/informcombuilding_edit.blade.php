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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลอาคาร</h2> 
    <form  method="post" action="{{ route('admin.updateinformcombuilding') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-1">
                                <label >ชื่ออาคาร</label>
                            </div>
                            <div class="col-lg-5">
                                <input  name = "BUILDING_NAME"  id="BUILDING_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcombuildingT->BUILDING_NAME}}" onkeyup="check_buildingname();">
                                <div style="color: red; font-size: 16px;" id="buildingname"></div> 
                            </div>
                            <div class="col-lg-6">
                                
                            </div>                       
                        <input type="hidden"  name = "BUILDING_ID"  id="BUILDING_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcombuildingT->BUILDING_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupinformcombuilding')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_buildingname()
    {                         
        buildingname = document.getElementById("BUILDING_NAME").value;             
            if (buildingname==null || buildingname==''){
            document.getElementById("buildingname").style.display = "";     
            text_buildingname = "*กรุณาระบุชื่ออาคาร";
            document.getElementById("buildingname").innerHTML = text_buildingname;
            }else{
            document.getElementById("buildingname").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var buildingname,text_buildingname; 
     
     
      buildingname = document.getElementById("BUILDING_NAME").value; 
     
   
                     
      if (buildingname==null || buildingname==''){
      document.getElementById("buildingname").style.display = "";     
      text_buildingname = "*กรุณาระบุชื่ออาคาร";
      document.getElementById("buildingname").innerHTML = text_buildingname;
      }else{
      document.getElementById("buildingname").style.display = "none";
      }
      
  
      if(buildingname==null || buildingname=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection