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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลยี่ห้อเครื่องยนต์</h2>    

    
        <form  method="post" action="{{ route('admin.updatecarmachinbrand') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ยี่ห้อเครื่องยนต์</label>
      </div>
      <div class="col-lg-3">
      <input  name = "CAR_MACHIN_BRAND_NAME"  id="CAR_MACHIN_BRAND_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infocarmachinbrand->CAR_MACHIN_BRAND_NAME}}" onkeyup="check_car_machin_brand_name();">
      <div style="color: red; font-size: 16px;" id="car_machin_brand_name"></div> 
    </div>
    
      <input  type="hidden" name = "CAR_MACHIN_BRAND_ID"  id="CAR_MACHIN_BRAND_ID" class="form-control input-lg" value="{{$infocarmachinbrand->CAR_MACHIN_BRAND_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_car/setupcarmachinbrand')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>
   
    function check_car_machin_brand_name()
    {                         
        car_machin_brand_name = document.getElementById("CAR_MACHIN_BRAND_NAME").value;             
            if (car_machin_brand_name==null || car_machin_brand_name==''){
            document.getElementById("car_machin_brand_name").style.display = "";     
            text_car_machin_brand_name = "*กรุณาระบุยี่ห้อเครื่องยนต์";
            document.getElementById("car_machin_brand_name").innerHTML = text_car_machin_brand_name;
            }else{
            document.getElementById("car_machin_brand_name").style.display = "none";
            }
    }
   
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var car_machin_brand_name,text_car_machin_brand_name;      
     
      car_machin_brand_name = document.getElementById("CAR_MACHIN_BRAND_NAME").value;   
                
      if (car_machin_brand_name==null || car_machin_brand_name==''){
      document.getElementById("car_machin_brand_name").style.display = "";     
      text_car_machin_brand_name= "*กรุณาระบุยี่ห้อเครื่องยนต์";
      document.getElementById("car_machin_brand_name").innerHTML = text_car_machin_brand_name;
      }else{
      document.getElementById("car_machin_brand_name").style.display = "none";
      }
     
        
      if(car_machin_brand_name==null || car_machin_brand_name==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection