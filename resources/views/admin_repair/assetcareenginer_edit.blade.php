@extends('layouts.backend_admin')
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขช่างผูดูแล</h2> 
    <form  method="post" action="{{ route('admin.updateassetcareenginer') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >ชื่อ-นามสกุล</label>
                        </div>
                    <div class="col-lg-4">
                          
                            <select name="PERSON_ID" id="PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_personid();">
                                <option value="">--เลือกชื่อ-นามสกุล--</option>
                                    @foreach ($infoperT as $infoper) 
                                        @if($infoassetcareenginerT -> PERSON_ID == $infoper-> ID  )                                                     
                                        <option value="{{$infoper->ID}}" selected>{{ $infoper->HR_FNAME }}  {{ $infoper->HR_LNAME }}</option> 
                                        @else     
                                        <option value="{{$infoper->ID}}"> {{ $infoper->HR_FNAME }}  {{ $infoper->HR_LNAME }}</option> 
                                        @endif
                                    @endforeach
                        </select> 
                        <div style="color: red; font-size: 16px;" id="personid"></div>
                    </div>
                    <div class="col-lg-2">
                        {{-- <label >ตำแหน่ง</label> --}}
                    </div>
                    <div class="col-lg-4">
                       
                        </div>
                        <input value="{{$infoassetcareenginerT-> ENGINERCARE_ID}}" type="hidden" name = "ENGINERCARE_ID"  id="ENGINERCARE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >       
                        </div> 
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupassetcareenginer')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
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
    function check_personid()
    {                         
        personid = document.getElementById("PERSON_ID").value;             
            if (personid==null || personid==''){
            document.getElementById("personid").style.display = "";     
            text_personid = "*เลือกชื่อ-นามสกุล";
            document.getElementById("personid").innerHTML = text_personid;
            }else{
            document.getElementById("personid").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var personid,text_personid; 
     
     
      personid = document.getElementById("PERSON_ID").value; 
     
   
                     
      if (personid==null || personid==''){
      document.getElementById("personid").style.display = "";     
      text_personid = "*เลือกชื่อ-นามสกุล";
      document.getElementById("personid").innerHTML = text_personid;
      }else{
      document.getElementById("personid").style.display = "none";
      }
      
  
      if(personid==null || personid=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection