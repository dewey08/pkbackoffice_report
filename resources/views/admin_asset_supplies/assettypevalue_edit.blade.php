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
        font-size: 10px;
        
        }

    label{
                font-family: 'Kanit', sans-serif;
                font-size: 10px;
                font-size: 1.0rem;
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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขประเภทครุภัณฑ์ตามมูลค่า</h2> 
    <form  method="post" action="{{ route('admin.updateassettypevalue') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >ชื่อรายการ</label>
                        </div>
                    <div class="col-lg-4">
                        <input  name = "TYPE_VALUE_NAME"  id="TYPE_VALUE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassettypevalueT->TYPE_VALUE_NAME}}" onkeyup="check_typevaluename();">
                        <div style="color: red; font-size: 16px;" id="typevaluename"></div> 
                    </div>
                    <div class="col-lg-6">
                    
                        </div>
                    </div>
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >รายละเอียด</label>
                        </div>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="TYPE_VALUE_DETAIL" name="TYPE_VALUE_DETAIL" rows="3" onkeyup="check_typevaluedetail();">{{$infoassettypevalueT->TYPE_VALUE_DETAIL}}</textarea>
                            <div style="color: red; font-size: 16px;" id="typevaluedetail"></div> 
                        </div>
                    </div>    
                        <input type="hidden"  name = "TYPE_VALUE_ID"  id="TYPE_VALUE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassettypevalueT->TYPE_VALUE_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_asset_supplies/setupassettypevalue')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')
<script>   
    function check_typevaluename()
    {                         
        typevaluename = document.getElementById("TYPE_VALUE_NAME").value;             
            if (typevaluename==null || typevaluename==''){
            document.getElementById("typevaluename").style.display = "";     
            text_typevaluename = "*กรุณาระบุชื่อรายการ";
            document.getElementById("typevaluename").innerHTML = text_typevaluename;
            }else{
            document.getElementById("typevaluename").style.display = "none";
            }
    }
    function check_typevaluedetail()
    {                         
        typevaluedetail = document.getElementById("TYPE_VALUE_DETAIL").value;             
            if (typevaluedetail==null || typevaluedetail==''){
            document.getElementById("typevaluedetail").style.display = "";     
            text_typevaluedetail= "*กรุณาระบุรายละเอียด";
            document.getElementById("typevaluedetail").innerHTML = text_typevaluedetail;
            }else{
            document.getElementById("typevaluedetail").style.display = "none";
            }
    }
    

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