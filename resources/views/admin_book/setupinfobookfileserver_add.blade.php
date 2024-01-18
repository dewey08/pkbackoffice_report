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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทหนังสือ</h2>    

    
        <form  method="post" action="{{ route('admin.savebookfile') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-lg-1">
      <label >รหัส</label>
      </div>
      <div class="col-lg-2">
      <input  name = "SERVER_ID"  id="SERVER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_server_id();">
      <div style="color: red; font-size: 16px;" id="server_id"></div> 
    </div>
    <div class="col-lg-2">
      <label >ชื่อเอกสารที่จัดเก็บ</label>
      </div>
      <div class="col-lg-2">
      <input  name = "SERVER_NAME"  id="SERVER_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_server_name();">
      <div style="color: red; font-size: 16px;" id="server_name"></div>   
    </div>
      <div class="col-lg-1">
      <label >PATH</label>
      </div>
      <div class="col-lg-4">
      <input  name = "SERVER_PATH"  id="SERVER_PATH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_server_path();">
      <div style="color: red; font-size: 16px;" id="server_path"></div> 
    </div>

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_book/setupbookfile')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           

@endsection

@section('footer')
<script>
   
  function check_server_id()
  {                         
    server_id = document.getElementById("SERVER_ID").value;             
          if (server_id==null || server_id==''){
          document.getElementById("server_id").style.display = "";     
          text_server_id = "*กรุณาระบุรหัส";
          document.getElementById("server_id").innerHTML = text_server_id;
          }else{
          document.getElementById("server_id").style.display = "none";
          }
  }
  function check_server_name()
  {                         
    server_name = document.getElementById("SERVER_NAME").value;             
          if (server_name==null || server_name==''){
          document.getElementById("server_name").style.display = "";     
          text_server_name = "*กรุณาระบุชื่อเอกสารที่จัดเก็บ";
          document.getElementById("server_name").innerHTML = text_server_name;
          }else{
          document.getElementById("server_name").style.display = "none";
          }
  }
  function check_server_path()
  {                         
    server_path = document.getElementById("SERVER_PATH").value;             
          if (server_path==null || server_path==''){
          document.getElementById("server_path").style.display = "";     
          text_server_path = "*กรุณาระบุ PATH";
          document.getElementById("server_path").innerHTML = text_server_path;
          }else{
          document.getElementById("server_path").style.display = "none";
          }
  }
 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var server_id,text_server_id;
    var server_name,text_server_name;
    var server_path,text_server_path;
    
   
    server_id = document.getElementById("SERVER_ID").value;
    server_name = document.getElementById("SERVER_NAME").value;
    server_path=document.getElementById("SERVER_PATH").value;
   
              
     
    if (server_id==null || server_id==''){
    document.getElementById("server_id").style.display = "";     
    text_server_id = "*กรุณาระบุรหัส";
    document.getElementById("server_id").innerHTML = text_server_id;
    }else{
    document.getElementById("server_id").style.display = "none";
    }
    if (server_name==null || server_name==''){
    document.getElementById("server_name").style.display = "";     
    text_server_name = "*กรุณาระบุชื่อเอกสารที่จัดเก็บ";
    document.getElementById("server_name").innerHTML = text_server_name;
    }else{
    document.getElementById("server_name").style.display = "none";
    }
    if (server_path==null || server_path==''){
    document.getElementById("server_path").style.display = "";     
    text_server_path = "*กรุณาระบุ PATH";
    document.getElementById("server_path").innerHTML = text_server_path;
    }else{
    document.getElementById("server_path").style.display = "none";
    }
   
      
    if(server_id==null || server_id==''||
    server_name==null || server_name==''||
    server_path==null || server_path=='' 
     )
  {
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
  }
  }); 
</script>


@endsection