@extends('layouts.repairnomal')
  
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


?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลระบบที่ต้องการแจ้งซ่อม</h2>    

    
        <form  method="post" action="{{ route('mrepairnomal.setting_typesystem_update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">

      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "INFORMRE_ST_NAME"  id="INFORMRE_ST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosystem->INFORMRE_ST_NAME}}" >
      <div style="color: red; font-size: 16px;" id="article_name"></div> 
    </div>
    
      <input  type="hidden" name = "INFORMRE_ST_ID"  id="INFORMRE_ST_ID" class="form-control input-lg" value="{{$infosystem->INFORMRE_ST_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('manager_repairnomal/repairreinfosetting_typesystem')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>
   
    function check_article_name()
    {                         
      article_name = document.getElementById("ARTICLE_NAME").value;             
            if (article_name==null || article_name==''){
            document.getElementById("article_name").style.display = "";     
            text_article_name = "*กรุณาระบุอุปกรณ์โสต";
            document.getElementById("article_name").innerHTML = text_article_name;
            }else{
            document.getElementById("article_name").style.display = "none";
            }
    }
  
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var article_name,text_article_name;
               
      article_name = document.getElementById("ARTICLE_NAME").value;
           
       
      if (article_name==null || article_name==''){
      document.getElementById("article_name").style.display = "";     
      text_article_name = "*กรุณาระบุอุปกรณ์โสด";
      document.getElementById("article_name").innerHTML = text_article_name;
      }else{
      document.getElementById("article_name").style.display = "none";
      }
     
      if(article_name==null || article_name=='')
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection