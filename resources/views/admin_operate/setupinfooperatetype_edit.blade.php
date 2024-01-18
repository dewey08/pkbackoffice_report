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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทเวร</h2>    

    
        <form  method="post" action="{{ route('admin.updateoperatetype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
        <div class="col-lg-1">
      <label >ประเภทเวร</label>
      </div>
      <div class="col-lg-3">
      <input  name = "OPERATE_TYPE_NAME"  id="OPERATE_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infooperatetype->OPERATE_TYPE_NAME}}" onkeyup="check_operate_type_name();">
      <div style="color: red; font-size: 16px;" id="operate_type_name"></div>
    </div>
      <div class="col-lg-1">
      <label >หน่วย OT</label>
      </div>
      <div class="col-lg-3">
      <input  name = "OPERATE_TYPE_UNIT_OT"  id="OPERATE_TYPE_UNIT_OT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infooperatetype->OPERATE_TYPE_UNIT_OT}}" onkeyup="check_operate_type_unit_ot();">
      <div style="color: red; font-size: 16px;" id="operate_type_unit_ot"></div>
    </div>
    
      <input  type="hidden" name = "OPERATE_TYPE_ID"  id="OPERATE_TYPE_ID" class="form-control input-lg" value="{{$infooperatetype->OPERATE_TYPE_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_operate/setupoperatetype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')


<script>
   
    function check_operate_type_name()
    {                         
      operate_type_name = document.getElementById("OPERATE_TYPE_NAME").value;             
            if (operate_type_name==null || operate_type_name==''){
            document.getElementById("operate_type_name").style.display = "";     
            text_operate_type_name = "*กรุณาระบุประเภทเวร";
            document.getElementById("operate_type_name").innerHTML = text_operate_type_name;
            }else{
            document.getElementById("operate_type_name").style.display = "none";
            }
    }
    function check_operate_type_unit_ot()
    {                         
      operate_type_unit_ot = document.getElementById("OPERATE_TYPE_UNIT_OT").value;             
            if (operate_type_unit_ot==null || operate_type_unit_ot==''){
            document.getElementById("operate_type_unit_ot").style.display = "";     
            text_operate_type_unit_ot = "*กรุณาระบุหน่วย OT";
            document.getElementById("operate_type_unit_ot").innerHTML = text_operate_type_unit_ot;
            }else{
            document.getElementById("operate_type_unit_ot").style.display = "none";
            }
    }
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var operate_type_name,text_operate_type_name;
      var operate_type_unit_ot,text_operate_type_unit_ot;
     
      operate_type_name = document.getElementById("OPERATE_TYPE_NAME").value;
      operate_type_unit_ot = document.getElementById("OPERATE_TYPE_UNIT_OT").value;
                
       
      if (operate_type_name==null || operate_type_name==''){
      document.getElementById("operate_type_name").style.display = "";     
      text_operate_type_name = "*กรุณาระบุประเภทเวร";
      document.getElementById("operate_type_name").innerHTML = text_operate_type_name;
      }else{
      document.getElementById("operate_type_name").style.display = "none";
      }
      if (operate_type_unit_ot==null || operate_type_unit_ot==''){
      document.getElementById("operate_type_unit_ot").style.display = "";     
      text_operate_type_unit_ot = "*กรุณาระบุหน่วย OT";
      document.getElementById("operate_type_unit_ot").innerHTML = text_operate_type_unit_ot;
      }else{
      document.getElementById("operate_type_unit_ot").style.display = "none";
      }
        
      if(operate_type_name==null || operate_type_name==''||
      operate_type_unit_ot==null || operate_type_unit_ot==''
    )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>


@endsection