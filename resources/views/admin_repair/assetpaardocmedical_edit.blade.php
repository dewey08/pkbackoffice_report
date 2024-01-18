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
    <form  method="post" action="{{ route('admin.updateassetpaardocmedical') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >ชื่อรายการ</label>
                        </div>
                        <div class="col-lg-10">
                            <input  name = "AR_TOOLS_NAME"  id="AR_TOOLS_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpaardocmedicalT->AR_TOOLS_NAME}}" onkeyup="check_artoolsname();">
                            <div style="color: red; font-size: 16px;" id="artoolsname"></div> 
                        </div>
                    </div>
                        <div class="row push">
                        <div class="col-lg-2">
                            <label >ช่วงการสอบเทียบ</label>
                        </div>
                        <div class="col-lg-3">    
                            <input  name = "RANGE_VALUE"  id="RANGE_VALUE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpaardocmedicalT->RANGE_VALUE}}" onkeyup="check_rangevalue();">
                            <div style="color: red; font-size: 16px;" id="rangevalue"></div> 
                        </div>                
                        <div class="col-lg-2">
                            <label >ค่าที่ยอมได้</label>
                        </div>
                        <div class="col-lg-2">
                            <input  name = "RANGE_ACCEPT"  id="RANGE_ACCEPT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpaardocmedicalT->RANGE_ACCEPT}}" onkeyup="check_rangeaccept();">
                            <div style="color: red; font-size: 16px;" id="rangeaccept"></div> 
                        </div>
                        <div class="col-lg-1">
                            <label >หน่วย</label>
                        </div>
                        <div class="col-lg-2">
                            <input  name = "UNIT_NAME"  id="UNIT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpaardocmedicalT->UNIT_NAME}}" onkeyup="check_unitname();">
                            <div style="color: red; font-size: 16px;" id="unitname"></div> 
                        </div>
                    </div>                       
                         <input type="hidden"  name = "AR_TOOLS_ID"  id="AR_TOOLS_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetpaardocmedicalT->AR_TOOLS_ID}}"> 
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupassetpaardocmedical')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_artoolsname()
    {                         
        artoolsname = document.getElementById("AR_TOOLS_NAME").value;             
            if (artoolsname==null || artoolsname==''){
            document.getElementById("artoolsname").style.display = "";     
            text_artoolsname= "*กรุณาระบุชื่อรายการ";
            document.getElementById("artoolsname").innerHTML = text_artoolsname;
            }else{
            document.getElementById("artoolsname").style.display = "none";
            }
    }
    function check_rangevalue()
    {                         
        rangevalue = document.getElementById("RANGE_VALUE").value;             
            if (rangevalue==null || rangevalue==''){
            document.getElementById("rangevalue").style.display = "";     
            text_rangevalue = "*กรุณาระบุช่วงการสอบเทียบ";
            document.getElementById("rangevalue").innerHTML = text_rangevalue;
            }else{
            document.getElementById("rangevalue").style.display = "none";
            }
    }
    function check_rangeaccept()
    {                         
        rangeaccept = document.getElementById("RANGE_ACCEPT").value;             
            if (rangeaccept==null || rangeaccept==''){
            document.getElementById("rangeaccept").style.display = "";     
            text_rangeaccept = "*กรุณาระบุค่าที่ยอมได้";
            document.getElementById("rangeaccept").innerHTML = text_rangeaccept;
            }else{
            document.getElementById("rangeaccept").style.display = "none";
            }
    }
    function check_unitname()
    {                         
        unitname = document.getElementById("UNIT_NAME").value;             
            if (unitname==null || unitname==''){
            document.getElementById("unitname").style.display = "";     
            text_unitname = "*กรุณาระบุหน่วย";
            document.getElementById("unitname").innerHTML = text_unitname;
            }else{
            document.getElementById("unitname").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var artoolsname,text_artoolsname; 
      var rangevalue,text_rangevalue; 
      var rangeaccept,text_rangeaccept;
    var unitname,text_unitname;

      artoolsname = document.getElementById("AR_TOOLS_NAME").value; 
      rangevalue = document.getElementById("RANGE_VALUE").value; 
      rangeaccept = document.getElementById("RANGE_ACCEPT").value; 
      unitname = document.getElementById("UNIT_NAME").value; 
   
                     
      if (artoolsname==null || artoolsname==''){
      document.getElementById("artoolsname").style.display = "";     
      text_artoolsname= "*กรุณาระบุชื่อรายการ";
      document.getElementById("artoolsname").innerHTML = text_artoolsname;
      }else{
      document.getElementById("artoolsname").style.display = "none";
      }

      if (rangevalue==null || rangevalue==''){
      document.getElementById("rangevalue").style.display = "";     
      text_rangevalue = "*กรุณาระบุช่วงการสอบเทียบ";
      document.getElementById("rangevalue").innerHTML = text_rangevalue;
      }else{
      document.getElementById("rangevalue").style.display = "none";
      }

      if (rangeaccept==null || rangeaccept==''){
      document.getElementById("rangeaccept").style.display = "";     
      text_rangeaccept = "*กรุณาระบุค่าที่ยอมได้";
      document.getElementById("rangeaccept").innerHTML = text_rangeaccept;
      }else{
      document.getElementById("rangeaccept").style.display = "none";
      }
      if (unitname==null || unitname==''){
      document.getElementById("unitname").style.display = "";     
      text_unitname = "*กรุณาระบุหน่วย";
      document.getElementById("unitname").innerHTML = text_unitname;
      }else{
      document.getElementById("unitname").style.display = "none";
      }
  
  
      if(artoolsname==null || artoolsname=='' ||
      rangevalue==null || rangevalue==''||
      rangeaccept==null || rangeaccept=='' ||
      unitname==null || unitname==''    
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection