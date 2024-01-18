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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขรายการซ่อม</h2> 
                <form  method="post" action="{{ route('admin.updateinformcomrepairlist') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label >รายการซ่อม</label>
                        </div>
                        <div class="col-lg-4">
                            <input  name = "REPAIR_LIST_NAME"  id="REPAIR_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$repairlistT->REPAIR_LIST_NAME}}" onkeyup="check_repairname();">
                            <div style="color: red; font-size: 16px;" id="repairname"></div> 
                        </div>
                        <div class="col-lg-1">
                            <label >ราคา</label>
                        </div>
                        <div class="col-lg-5">
                            <input  name = "REPAIR_LIST_PRICE"  id="REPAIR_LIST_PRICE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$repairlistT->REPAIR_LIST_PRICE}}" onkeyup="check_repairlistprice();">
                            <div style="color: red; font-size: 16px;" id="repairlistprice"></div> 
                        </div>                     
                        <input type="hidden"  name = "REPAIR_LIST_ID"  id="REPAIR_LIST_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$repairlistT->REPAIR_LIST_ID}}">
                    </div>
                    <div class="modal-footer">
                        <div align="right">
                            <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                                <a href="{{ url('admin_repair/Setupinformcomrepairlist')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                        </div>  
                    </div>
                </form> 
@endsection

@section('footer')


<script>   
    function check_repairname()
    {                         
        repairname = document.getElementById("REPAIR_LIST_NAME").value;             
            if (repairname==null || repairname==''){
            document.getElementById("repairname").style.display = "";     
            text_repairname = "*กรุณาระบุรายการซ่อม";
            document.getElementById("repairname").innerHTML = text_repairname;
            }else{
            document.getElementById("repairname").style.display = "none";
            }
    }
    function check_repairlistprice()
    {                         
        repairlistprice = document.getElementById("REPAIR_LIST_PRICE").value;             
            if (repairlistprice==null || repairlistprice==''){
            document.getElementById("repairlistprice").style.display = "";     
            text_repairlistprice = "*กรุณาระบุราคา";
            document.getElementById("repairlistprice").innerHTML = text_repairlistprice;
            }else{
            document.getElementById("repairlistprice").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var repairname,text_repairname; 
      var repairlistprice,text_repairlistprice; 
     
      repairname = document.getElementById("REPAIR_LIST_NAME").value; 
      repairlistprice = document.getElementById("REPAIR_LIST_PRICE").value; 
   
                     
      if (repairname==null || repairname==''){
      document.getElementById("repairname").style.display = "";     
      text_repairname = "*กรุณาระบุรายการซ่อม";
      document.getElementById("repairname").innerHTML = text_repairname;
      }else{
      document.getElementById("repairname").style.display = "none";
      }
      if (repairlistprice==null || repairlistprice==''){
      document.getElementById("repairlistprice").style.display = "";     
      text_repairlistprice = "*กรุณาระบุราคา";
      document.getElementById("repairlistprice").innerHTML = text_repairlistprice;
      }else{
      document.getElementById("repairlistprice").style.display = "none";
      }
      
  
      if(repairname==null || repairname=='' ||
      repairlistprice==null || repairlistprice=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>
@endsection