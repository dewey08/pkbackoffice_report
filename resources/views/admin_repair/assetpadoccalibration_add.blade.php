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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มหน่วยงานสอบเทียบ</h2>    
        <form  method="post" action="{{ route('admin.saveassetpadoccalibration') }}" enctype="multipart/form-data">
            @csrf
            <div class="row push">
                <div class="col-lg-1">
                    <label >ชื่อหน่วยงาน</label>
                </div>
                <div class="col-lg-4">
                    <input  name = "CALIBRAT_NAME"  id="CALIBRAT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_calibratname();">
                    <div style="color: red; font-size: 16px;" id="calibratname"></div> 
                </div>
                <div class="col-lg-1">
                        <label >ชื่อ-นามสกุล</label>
                    </div>
                    <div class="col-lg-3">
                        <input  name = "CONTACT_NAME"  id="CONTACT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_contactname();">
                        <div style="color: red; font-size: 16px;" id="contactname"></div> 
                    </div>
                    <div class="col-lg-1">
                            <label >เบอร์โทร</label>
                        </div>
                        <div class="col-lg-2">
                            <input  name = "PHONE"  id="PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_phone();">
                            <div style="color: red; font-size: 16px;" id="phone"></div> 
                        </div>
                </div>
            <div class="row push">
                   
                    <div class="col-lg-1">
                        <label >ที่อยู่</label>
                    </div>
                   
                    <div class="col-lg-11"> 
                        <textarea  name="CALIBRAT_ADDR"  id="CALIBRAT_ADDR" rows="3" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_calibrataddr();"></textarea>                                
                        <div style="color: red; font-size: 16px;" id="calibrataddr"></div> 
                    </div> 
            </div>           
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>  บันทึกข้อมูล</button>
                <a href="{{ url('admin_repair/Setupassetpadoccalibration')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
            </div>
        </div>
   
    </form>  
         
@endsection

@section('footer')

<script>   
    function check_calibratname()
    {                         
        calibratname = document.getElementById("CALIBRAT_NAME").value;             
            if (calibratname==null || calibratname==''){
            document.getElementById("calibratname").style.display = "";     
            text_calibratname= "*กรุณาระบุชื่อรายการ";
            document.getElementById("calibratname").innerHTML = text_calibratname;
            }else{
            document.getElementById("calibratname").style.display = "none";
            }
    }
    function check_contactname()
    {                         
        contactname = document.getElementById("CONTACT_NAME").value;             
            if (contactname==null || contactname==''){
            document.getElementById("contactname").style.display = "";     
            text_contactname = "*กรุณาระบุชื่อ-นามสกุล";
            document.getElementById("contactname").innerHTML = text_contactname;
            }else{
            document.getElementById("contactname").style.display = "none";
            }
    }
    function check_phone()
    {                         
        phone = document.getElementById("PHONE").value;             
            if (phone==null || phone==''){
            document.getElementById("phone").style.display = "";     
            text_phone = "*กรุณาระบุเบอร์โทร";
            document.getElementById("phone").innerHTML = text_phone;
            }else{
            document.getElementById("phone").style.display = "none";
            }
    }
    function check_calibrataddr()
    {                         
        calibrataddr = document.getElementById("CALIBRAT_ADDR").value;             
            if (calibrataddr==null || calibrataddr==''){
            document.getElementById("calibrataddr").style.display = "";     
            text_calibrataddr = "*กรุณาระบุที่อยู่";
            document.getElementById("calibrataddr").innerHTML = text_calibrataddr;
            }else{
            document.getElementById("calibrataddr").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var calibratname,text_calibratname; 
      var contactname,text_contactname; 
      var phone,text_phone;
      var calibrataddr,text_calibrataddr;

    calibratname = document.getElementById("CALIBRAT_NAME").value; 
    contactname = document.getElementById("CONTACT_NAME").value; 
    phone = document.getElementById("PHONE").value; 
    calibrataddr = document.getElementById("CALIBRAT_ADDR").value; 
   
                     
      if (calibratname==null || calibratname==''){
      document.getElementById("calibratname").style.display = "";     
      text_calibratname= "*กรุณาระบุชื่อหน่วยงาน";
      document.getElementById("calibratname").innerHTML = text_calibratname;
      }else{
      document.getElementById("calibratname").style.display = "none";
      }

      if (contactname==null || contactname==''){
      document.getElementById("contactname").style.display = "";     
      text_contactname = "*กรุณาระบุชื่อ-นามสกุล";
      document.getElementById("contactname").innerHTML = text_contactname;
      }else{
      document.getElementById("contactname").style.display = "none";
      }

      if (phone==null || phone==''){
      document.getElementById("phone").style.display = "";     
      text_phone = "*กรุณาระบุเบอร์โทร";
      document.getElementById("phone").innerHTML = text_phone;
      }else{
      document.getElementById("phone").style.display = "none";
      }

      if (calibrataddr==null || calibrataddr==''){
      document.getElementById("calibrataddr").style.display = "";     
      text_calibrataddr = "*กรุณาระบุที่อยู่";
      document.getElementById("calibrataddr").innerHTML = text_calibrataddr;
      }else{
      document.getElementById("calibrataddr").style.display = "none";
      }  
  
      if(calibratname==null || calibratname==''||
      contactname==null || contactname==''||
      phone==null || phone==''||
      calibrataddr==null || calibrataddr==''    
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection