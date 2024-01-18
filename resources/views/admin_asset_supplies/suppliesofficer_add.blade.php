@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มเจ้าหน้าที่พัสดุ</h2>    
        <form  method="post" action="{{ route('admin.saveofficer') }}" enctype="multipart/form-data">
            @csrf
            <div class="row push">
                <div class="col-lg-2">
                    <label >เจ้าหน้าที่พัสดุ</label>
                </div>
                <div class="col-lg-4">
                   
                    <select name="SUP_OFFICER_PERSON_ID" id="SUP_OFFICER_PERSON_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="">--กรุณาเลือกเจ้าหน้าที่--</option>
                         @foreach ($infopersons as $infoperson)                                                     
                        <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                        @endforeach 
                    </select> 

                </div>
            </div>
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                <a href="{{ url('admin_asset_supplies/setupofficer')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
            </div>
        </div>
        </form>  
         
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>   
 $(document).ready(function() {
$('select').select2();
});


   </script>
    <script>      
    $('form').submit(function () {
     
        var typevaluename,text_typevaluename;
        var typevaluedetail,text_typevaluedetail;
            
        typevaluename = document.getElementById("TYPE_VALUE_NAME").value;
        typevaluedetail = document.getElementById("TYPE_VALUE_DETAIL").value;    
                     
      if (typevaluename==null || typevaluename==''){
      document.getElementById("typevaluename").style.display = "";     
      text_typevaluename = "*กรุณาระบุชื่อรายการ";
      document.getElementById("typevaluename").innerHTML = text_typevaluename;
      }else{
      document.getElementById("typevaluename").style.display = "none";
      }

     
                     
      if (typevaluedetail==null || typevaluedetail==''){
      document.getElementById("typevaluedetail").style.display = "";     
      text_typevaluedetail = "*กรุณาระบุรายละเอียด";
      document.getElementById("typevaluedetail").innerHTML = text_typevaluedetail;
      }else{
      document.getElementById("typevaluedetail").style.display = "none";
      }
  
  
      if(typevaluename==null || typevaluename=='' ||
      typevaluedetail==null || typevaluedetail==''   
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>
@endsection