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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลพัสดุหลัก</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliestypemaster') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
        <div class="col-lg-1">
      <label >พัสดุ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "SUP_TYPE_MASTER_NAME"  id="SUP_TYPE_MASTER_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestypemaster->SUP_TYPE_MASTER_NAME}}" onkeyup="check_mastername();">
      <div style="color: red; font-size: 16px;" id="mastername"></div>   
    </div>

      <div class="col-lg-2">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-6">
      <input  name = "DETAIL"  id="DETAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestypemaster->DETAIL}}" onkeyup="check_detail()();"> 
      <div style="color: red; font-size: 16px;" id="detail"></div>    
    </div>

     
      <input type="hidden"  name = "SUP_TYPE_MASTER_ID"  id="SUP_TYPE_MASTER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestypemaster->SUP_TYPE_MASTER_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestypemaster')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_mastername()
    {                         
        mastername = document.getElementById("SUP_TYPE_MASTER_NAME").value;             
            if (mastername==null || mastername==''){
            document.getElementById("mastername").style.display = "";     
            text_mastername = "*กรุณาระบุพัสดุ";
            document.getElementById("mastername").innerHTML = text_mastername;
            }else{
            document.getElementById("mastername").style.display = "none";
            }
    }
    function check_detail()
    {                         
        detail = document.getElementById("DETAIL").value;             
            if (detail==null || detail==''){
            document.getElementById("detail").style.display = "";     
            text_detail= "*กรุณาระบุรายละเอียด";
            document.getElementById("detail").innerHTML = text_detail;
            }else{
            document.getElementById("detail").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
        var mastername,text_mastername;
        var detail,text_detail;
            
        mastername = document.getElementById("SUP_TYPE_MASTER_NAME").value;
        detail = document.getElementById("DETAIL").value;    
                     
      if (mastername==null || mastername==''){
      document.getElementById("mastername").style.display = "";     
      text_mastername = "*กรุณาระบุพัสดุ";
      document.getElementById("mastername").innerHTML = text_mastername;
      }else{
      document.getElementById("mastername").style.display = "none";
      }

     
                     
      if (detail==null || detail==''){
      document.getElementById("detail").style.display = "";     
      text_detail = "*กรุณาระบุรายละเอียด";
      document.getElementById("detail").innerHTML = text_detail;
      }else{
      document.getElementById("detail").style.display = "none";
      }
  
  
      if(mastername==null || mastername=='' ||
      detail==null || detail==''   
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>




@endsection