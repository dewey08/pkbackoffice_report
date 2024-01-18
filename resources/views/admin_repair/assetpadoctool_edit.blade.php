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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขชื่อเครื่องมือสอบเทียบ</h2> 
    <form  method="post" action="{{ route('admin.updateassetpadoctool') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >ชื่อเครื่องมือสอบเทียบ</label>
                        </div>
                        <div class="col-lg-3">
                            <input  name = "TOOLS_NAME"  id="TOOLS_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpadoctoolT->TOOLS_NAME}}" onkeyup="check_toolsname();"> 
                            <div style="color: red; font-size: 16px;" id="toolsname"></div> 
                        </div>
                        <div class="col-lg-1">
                            <label >ยี่ห้อ</label>
                        </div>
                        <div class="col-lg-3">    
                                <select name="BRAND_ID" id="BRAND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_brandid();">
                                    <option value="">--เลือกยี่ห้อ--</option>

                                        @foreach ($informcombrandT as $informcombrand) 
                                        @if($infoassetpadoctoolT -> BRAND_ID == $informcombrand-> BRAND_ID )                                                     
                                            <option value="{{$informcombrand-> BRAND_ID }}" selected>{{ $informcombrand-> BRAND_NAME }} </option>                                            
                                        @else
                                            <option value="{{$informcombrand-> BRAND_ID }}" >{{ $informcombrand-> BRAND_NAME }}</option>
                                        @endif
                                    @endforeach  
                                    </select> 
                                    <div style="color: red; font-size: 16px;" id="brandid"></div> 
                            </div>                
                        <div class="col-lg-1">
                            <label >รุ่น</label>
                        </div>
                        <div class="col-lg-2">
                            <input  name = "MODEL"  id="MODEL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpadoctoolT->MODEL}}" onkeyup="check_model();"> 
                            <div style="color: red; font-size: 16px;" id="model"></div>
                        </div>                                
                         <input type="hidden"  name = "TOOLS_ID"  id="TOOLS_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpadoctoolT->TOOLS_ID}}"> 
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupassetpadoctool')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
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
    function check_toolsname()
    {                         
        toolsname = document.getElementById("TOOLS_NAME").value;             
            if (toolsname==null || toolsname==''){
            document.getElementById("toolsname").style.display = "";     
            text_toolsname= "*กรุณาระบุชื่อเครื่องมือสอบเทียบ";
            document.getElementById("toolsname").innerHTML = text_toolsname;
            }else{
            document.getElementById("toolsname").style.display = "none";
            }
    }
    function check_brandid()
    {                         
        brandid = document.getElementById("BRAND_ID").value;             
            if (brandid==null || brandid==''){
            document.getElementById("brandid").style.display = "";     
            text_brandid= "*เลือกยี่ห้อ";
            document.getElementById("brandid").innerHTML = text_brandid;
            }else{
            document.getElementById("brandid").style.display = "none";
            }
    }
    function check_model()
    {                         
        model = document.getElementById("MODEL").value;             
            if (model==null || model==''){
            document.getElementById("model").style.display = "";     
            text_model= "*เลือกรุ่น";
            document.getElementById("model").innerHTML = text_model;
            }else{
            document.getElementById("model").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
        var toolsname,text_toolsname;
        var brandid,text_brandid;
        var model,text_model
            
        toolsname = document.getElementById("TOOLS_NAME").value;
        brandid = document.getElementById("BRAND_ID").value;  
        model = document.getElementById("MODEL").value;   
                     
      if (toolsname==null || toolsname==''){
      document.getElementById("toolsname").style.display = "";     
      text_toolsname = "*กรุณาระบุชื่อเครื่องมือสอบเทียบ";
      document.getElementById("toolsname").innerHTML = text_toolsname;
      }else{
      document.getElementById("toolsname").style.display = "none";
      }     
                     
      if (brandid==null || brandid==''){
      document.getElementById("brandid").style.display = "";     
      text_brandid = "*เลือกยี่ห้อ";
      document.getElementById("brandid").innerHTML = text_brandid;
      }else{
      document.getElementById("brandid").style.display = "none";
      }
      if (model==null || model==''){
      document.getElementById("model").style.display = "";     
      text_model = "*เลือกรุ่น";
      document.getElementById("model").innerHTML = text_model;
      }else{
      document.getElementById("model").style.display = "none";
      }
  
      if(toolsname==null || toolsname=='' ||
      brandid==null || brandid=='' ||
      model==null || model==''   
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection