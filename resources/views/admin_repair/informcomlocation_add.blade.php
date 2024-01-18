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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลสถานที่ตั้ง</h2>    
        <form  method="post" action="{{ route('admin.saveinformcomlocation') }}" enctype="multipart/form-data">
            @csrf
            <div class="row push">
                <div class="col-lg-1">
                    <label >สถานที่ตั้ง</label>
                </div>
                <div class="col-lg-4">
                    <input  name = "LOCATION_NAME"  id="LOCATION_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_locationname();">
                    <div style="color: red; font-size: 16px;" id="locationname"></div> 
                </div>
                <div class="col-lg-1">
                        <label >อาคาร</label>
                    </div>
                <div class="col-lg-3">
                        {{-- <input  name = "BUILDING_ID"  id="BUILDING_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"> --}}
                        <select name="BUILDING_ID" id="BUILDING_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_buildingid();">
                            <option value="">--เลือกอาคาร--</option>
                            @foreach ($buildingT as $building)                                                     
                            <option value="{{$building->BUILDING_ID}}">{{ $building->BUILDING_NAME }} </option>                                           
                            
                            @endforeach 
                        </select> 
                        <div style="color: red; font-size: 16px;" id="buildingid"></div> 
                    </div>
                <div class="col-lg-1">
                        <label >CLASS</label>
                    </div>
                <div class="col-lg-2">
                        <input  name = "CLASS"  id="CLASS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_classZ();">
                        <div style="color: red; font-size: 16px;" id="classZ"></div> 
                    </div>
            </div>
          
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                <a href="{{ url('admin_repair/Setupinformcomlocation')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
            </div>
        </div>
        </form>  
         
@endsection

@section('footer')
<script>   
    function check_locationname()
    {                         
        locationname = document.getElementById("LOCATION_NAME").value;             
            if (locationname==null || locationname==''){
            document.getElementById("locationname").style.display = "";     
            text_locationname = "*กรุณาระบุสถานที่ตั้ง";
            document.getElementById("locationname").innerHTML = text_locationname;
            }else{
            document.getElementById("locationname").style.display = "none";
            }
    }
    function check_buildingid()
    {                         
        buildingid = document.getElementById("BUILDING_ID").value;             
            if (buildingid==null || buildingid==''){
            document.getElementById("buildingid").style.display = "";     
            text_buildingid = "*กรุณาเลือกอาคาร";
            document.getElementById("buildingid").innerHTML = text_buildingid;
            }else{
            document.getElementById("buildingid").style.display = "none";
            }
    }
    function check_classZ()
    {                         
        classZ = document.getElementById("CLASS").value;             
            if (classZ==null || classZ==''){
            document.getElementById("classZ").style.display = "";     
            text_classZ = "*กรุณาเลือกอาคาร";
            document.getElementById("classZ").innerHTML = text_classZ;
            }else{
            document.getElementById("classZ").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var locationname,text_locationname; 
      var buildingid,text_buildingid; 
      var classZ,text_classZ;

      locationname = document.getElementById("LOCATION_NAME").value; 
      buildingid = document.getElementById("BUILDING_ID").value; 
      classZ = document.getElementById("CLASS").value; 
   
                     
      if (locationname==null || locationname==''){
      document.getElementById("locationname").style.display = "";     
      text_locationname= "*กรุณาระบุสถานที่ตั้ง";
      document.getElementById("locationname").innerHTML = text_locationname;
      }else{
      document.getElementById("locationname").style.display = "none";
      }
      if (buildingid==null || buildingid==''){
      document.getElementById("buildingid").style.display = "";     
      text_buildingid= "*กรุณาเลือกอาคาร";
      document.getElementById("buildingid").innerHTML = text_buildingid;
      }else{
      document.getElementById("buildingid").style.display = "none";
      }
      if (classZ==null || classZ==''){
      document.getElementById("classZ").style.display = "";     
      text_classZ = "*กรุณาระบุ CLASS";
      document.getElementById("classZ").innerHTML = text_classZ;
      }else{
      document.getElementById("classZ").style.display = "none";
      }
  
  
      if(locationname==null || locationname=='' ||
      buildingid==null || buildingid==''||
      classZ==null || classZ==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>
@endsection