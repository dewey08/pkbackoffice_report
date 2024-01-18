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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลรายการอัตราเสื่อมราคา</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliesdecline') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
      <label >ชื่อรายการ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "DECLINE_NAME"  id="DECLINE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_declinename();">
      <div style="color: red; font-size: 16px;" id="declinename"></div> 
    </div>

      <div class="col-lg-2 text-right">
      <label >อายุการใช้งาน</label>
      </div>
      <div class="col-lg-2">
      <input  name = "OLD_YEAR"  id="OLD_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_oldyear();">
      <div style="color: red; font-size: 16px;" id="oldyear"></div>  
    </div>

      <div class="col-lg-2 text-right">
      <label >อัตราเสื่อมราคา</label>
      </div>
      <div class="col-lg-2">
      <input  name = "DECLINE_PERSEN"  id="DECLINE_PERSEN" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_declinepersen();">
      <div style="color: red; font-size: 16px;" id="declinepersen"></div>  
    </div>
     

      </div>

      <div class="row push">
      <div class="col-lg-1">
      <label >เลขอ้างอิง</label>
      </div>
      <div class="col-lg-3">
      <input  name = "CODE_REF"  id="CODE_REF" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_coderef();">
      <div style="color: red; font-size: 16px;" id="coderef"></div>  
    </div>

     

      </div>
    
    
    
    </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesdecline')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_declinename()
    {                         
        declinename = document.getElementById("DECLINE_NAME").value;             
            if (declinename==null || declinename==''){
            document.getElementById("declinename").style.display = "";     
            text_declinename = "*กรุณาระบุชื่อรายการ";
            document.getElementById("declinename").innerHTML = text_declinename;
            }else{
            document.getElementById("declinename").style.display = "none";
            }
    }
    function check_oldyear()
    {                         
        oldyear = document.getElementById("OLD_YEAR").value;             
            if (oldyear==null || oldyear==''){
            document.getElementById("oldyear").style.display = "";     
            text_oldyear = "*กรุณาระบุอายุการใช้งาน";
            document.getElementById("oldyear").innerHTML = text_oldyear;
            }else{
            document.getElementById("oldyear").style.display = "none";
            }
    }
    function check_declinepersen()
    {                         
        declinepersen = document.getElementById("DECLINE_PERSEN").value;             
            if (declinepersen==null || declinepersen==''){
            document.getElementById("declinepersen").style.display = "";     
            text_declinepersen = "*กรุณาระบุอัตราเสื่อมราคา";
            document.getElementById("declinepersen").innerHTML = text_declinepersen;
            }else{
            document.getElementById("declinepersen").style.display = "none";
            }
    }
    function check_coderef()
    {                         
        coderef = document.getElementById("CODE_REF").value;             
            if (coderef==null || coderef==''){
            document.getElementById("coderef").style.display = "";     
            text_coderef = "*กรุณาระบุเลขอ้างอิง";
            document.getElementById("coderef").innerHTML = text_coderef;
            }else{
            document.getElementById("coderef").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var declinename,text_declinename; 
      var oldyear,text_oldyear;
      var declinepersen,text_declinepersen;
      var coderef,text_coderef;
     
      declinename = document.getElementById("DECLINE_NAME").value; 
      oldyear = document.getElementById("OLD_YEAR").value;
      declinepersen = document.getElementById("DECLINE_PERSEN").value;
      declinename = document.getElementById("CODE_REF").value;
   
                     
      if (declinename==null || declinename==''){
      document.getElementById("declinename").style.display = "";     
      text_declinename = "*กรุณาระบุชื่อรายการ";
      document.getElementById("declinename").innerHTML = text_declinename;
      }else{
      document.getElementById("declinename").style.display = "none";
      }
      if (oldyear==null || oldyear==''){
      document.getElementById("oldyear").style.display = "";     
      text_oldyear = "*กรุณาระบุอายุการใช้งาน";
      document.getElementById("oldyear").innerHTML = text_oldyear;
      }else{
      document.getElementById("oldyear").style.display = "none";
      }
      if (declinepersen==null || declinepersen==''){
      document.getElementById("declinepersen").style.display = "";     
      text_declinepersen = "*กรุณาระบุอัตราเสื่อมราคา";
      document.getElementById("declinepersen").innerHTML = text_declinepersen;
      }else{
      document.getElementById("declinepersen").style.display = "none";
      }
      if (coderef==null || coderef==''){
      document.getElementById("coderef").style.display = "";     
      text_coderef = "*กรุณาระบุเลขอ้างอิง";
      document.getElementById("coderef").innerHTML = text_coderef;
      }else{
      document.getElementById("coderef").style.display = "none";
      }
  
  
      if(declinename==null || declinename==''||
      oldyear==null || oldyear==''||
      declinepersen==null || declinepersen==''||
      coderef==null || coderef==''

       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection