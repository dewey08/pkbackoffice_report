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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประภทอาหาร</h2>    

    
        <form  method="post" action="{{ route('admin.saveroomfoodtype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-2">
      <label >ประเภทอาหาร</label>
      </div>
      <div class="col-lg-3">
      <input  name = "FOOD_TYPE_NAME"  id="FOOD_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_food_type_name();">
      <div style="color: red; font-size: 16px;" id="food_type_name"></div> 
    </div>

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>  บันทึกข้อมูล</button>
         <a href="{{ url('admin_meeting/setupinforoomfoodtype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>   ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
 @endsection

@section('footer')

<script>
   
    function check_food_type_name()
    {                         
      food_type_name = document.getElementById("FOOD_TYPE_NAME").value;             
            if (food_type_name==null || food_type_name==''){
            document.getElementById("food_type_name").style.display = "";     
            text_food_type_name = "*กรุณาระบุประเภทอาหาร";
            document.getElementById("food_type_name").innerHTML = text_food_type_name;
            }else{
            document.getElementById("food_type_name").style.display = "none";
            }
    }
  
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var food_type_name,text_food_type_name;
               
      food_type_name = document.getElementById("FOOD_TYPE_NAME").value;
           
       
      if (food_type_name==null || food_type_name==''){
      document.getElementById("food_type_name").style.display = "";     
      text_food_type_name = "*กรุณาระบุประเภทอาหาร";
      document.getElementById("food_type_name").innerHTML = text_food_type_name;
      }else{
      document.getElementById("food_type_name").style.display = "none";
      }
     
      if(food_type_name==null || food_type_name=='')
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection