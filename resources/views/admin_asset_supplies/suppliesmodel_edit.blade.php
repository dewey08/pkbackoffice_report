@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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


@section('content')
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลรุ่นสินค้า</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliesmodel') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >รุ่นสินค้า</label>
      </div>
      <div class="col-lg-3">
      <input  name = "MODEL_NAME"  id="MODEL_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesmodel->MODEL_NAME}}" onkeyup="check_brandname();">
      <div style="color: red; font-size: 16px;" id="brandname"></div>   
    </div>
    
      <input  type="hidden" name = "MODEL_ID"  id="MODEL_ID" class="form-control input-lg" value="{{$infosuppliesmodel->MODEL_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesmodel')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_brandname()
    {                         
        brandname = document.getElementById("MODEL_NAME").value;             
            if (brandname==null || brandname==''){
            document.getElementById("brandname").style.display = "";     
            text_brandname = "*กรุณาระบุรุ่นสินค้า";
            document.getElementById("brandname").innerHTML = text_brandname;
            }else{
            document.getElementById("brandname").style.display = "none";
            }
    }
    
   
   </script>
    <script>      
    $('form').submit(function () {
     
      var brandname,text_brandname; 
      
     
      brandname = document.getElementById("BRAND_NAME").value; 
    
                
      if (brandname==null || brandname==''){
      document.getElementById("brandname").style.display = "";     
      text_brandname = "*กรุณาระบุยี่ห้อสินค้า";
      document.getElementById("brandname").innerHTML = text_brandname;
      }else{
      document.getElementById("brandname").style.display = "none";
      }
  
          
          
      if(brandname==null || brandname==''
      
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection