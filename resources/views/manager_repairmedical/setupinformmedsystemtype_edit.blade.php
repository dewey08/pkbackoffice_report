@extends('layouts.repairmedical')
  
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

    
        <form  method="post" action="{{ route('mrepairmedical.setting_typesystem_update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">

      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "INFORMMED_ST_NAME"  id="INFORMMED_ST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosystem->INFORMMED_ST_NAME}}" >
      <div style="color: red; font-size: 16px;" id="article_name"></div> 
    </div>
    
      <input  type="hidden" name = "INFORMMED_ST_ID"  id="INFORMMED_ST_ID" class="form-control input-lg" value="{{$infosystem->INFORMMED_ST_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('manager_repairmedical/repairmedinfosetting_typesystem')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')





@endsection