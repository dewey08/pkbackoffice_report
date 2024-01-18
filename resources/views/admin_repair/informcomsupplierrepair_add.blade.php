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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลร้านซ่อม</h2>    
        <form  method="post" action="{{ route('admin.saveinformcomsupplierrepair') }}" enctype="multipart/form-data">
            @csrf
            <div class="row push">
                <div class="col-lg-1">
                    <label >ชื่อร้าน</label>
                </div>
                <div class="col-lg-5">
                    <input  name = "SUPPLIER_NAME"  id="SUPPLIER_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_suppliername();">                    
                    <div style="color: red; font-size: 16px;" id="suppliername"></div>
                </div>               
                <div class="col-lg-1">
                    <label >PHONE</label>
                </div>
                <div class="col-lg-2">
                        <input  name = "PHONE"  id="PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_phone();">             
                        <div style="color: red; font-size: 16px;" id="phone"></div>
                    </div>
                <div class="col-lg-1">
                        <label >FAX</label>
                    </div>
                    <div class="col-lg-2">
                            <input  name = "FAX"  id="FAX" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_fax();">             
                            <div style="color: red; font-size: 16px;" id="fax"></div>
                        </div>
            </div>
            <div class="row push">
                    <div class="col-lg-1">
                        <label >ที่อยู่</label>
                    </div>
                    <div class="col-lg-5">
                        {{-- <input  name = "ADDRESS"  id="ADDRESS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"> --}}
                        <textarea class="form-control" id="ADDRESS" name="ADDRESS" rows="3" onkeyup="check_address();"></textarea>
                        <div style="color: red; font-size: 16px;" id="address"></div>
                    </div>
                   
                    <div class="col-lg-1">
                        <label >MOBILE</label>
                    </div>
                    <div class="col-lg-5">
                            <input  name = "MOBILE"  id="MOBILE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_mobile();">             
                            <div style="color: red; font-size: 16px;" id="mobile"></div>
                        </div>
                </div>
                <div class="row push">
                        <div class="col-lg-1">
                            <label >CONTACT</label>
                        </div>
                        <div class="col-lg-5">
                            <input  name = "CONTACT"  id="CONTACT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_contact();">
                            <div style="color: red; font-size: 16px;" id="contact"></div>
                        </div>                       
                        <div class="col-lg-1">
                            <label >EMAIL</label>
                        </div>
                        <div class="col-lg-5">
                                <input  name = "EMAIL"  id="EMAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_email();">             
                                <div style="color: red; font-size: 16px;" id="email"></div>
                            </div>
                    </div>
            <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i>  บันทึกข้อมูล</button>
                <a href="{{ url('admin_repair/Setupinformcomsupplierrepair')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close"></i>  ยกเลิก</a> 
            </div>
        </div>
        </form>  
         
@endsection

@section('footer')
<script>   
    function check_suppliername()
    {                         
        suppliername = document.getElementById("SUPPLIER_NAME").value;             
            if (suppliername==null || suppliername==''){
            document.getElementById("suppliername").style.display = "";     
            text_suppliername = "*กรุณาระบุชื่อร้าน";
            document.getElementById("suppliername").innerHTML = text_suppliername;
            }else{
            document.getElementById("suppliername").style.display = "none";
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
    function check_fax()
    {                         
        fax = document.getElementById("FAX").value;             
            if (fax==null || fax==''){
            document.getElementById("fax").style.display = "";     
            text_fax = "*กรุณาระบุ FAX";
            document.getElementById("fax").innerHTML = text_fax;
            }else{
            document.getElementById("fax").style.display = "none";
            }
    }
    function check_address()
    {                         
        address = document.getElementById("ADDRESS").value;             
            if (address==null || address==''){
            document.getElementById("address").style.display = "";     
            text_address = "*กรุณาระบุที่อยู่";
            document.getElementById("address").innerHTML = text_address;
            }else{
            document.getElementById("address").style.display = "none";
            }
    }
    function check_mobile()
    {                         
        mobile = document.getElementById("MOBILE").value;             
            if (mobile==null || mobile==''){
            document.getElementById("mobile").style.display = "";     
            text_mobile = "*กรุณาระบุเบอร์มือถือ";
            document.getElementById("mobile").innerHTML = text_mobile;
            }else{
            document.getElementById("mobile").style.display = "none";
            }
    }
    function check_contact()
    {                         
        contact = document.getElementById("CONTACT").value;             
            if (contact==null || contact==''){
            document.getElementById("contact").style.display = "";     
            text_contact = "*กรุณาระบุผู้ติดต่อ";
            document.getElementById("contact").innerHTML = text_contact;
            }else{
            document.getElementById("contact").style.display = "none";
            }
    }
    function check_email()
    {                         
        email = document.getElementById("EMAIL").value;             
            if (email==null || email==''){
            document.getElementById("email").style.display = "";     
            text_email = "*กรุณาระบุอีเมล";
            document.getElementById("email").innerHTML = text_email;
            }else{
            document.getElementById("email").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var suppliername,text_suppliername; 
      var phone,text_phone; 
      var fax,text_fax;
      var address,text_address;
      var mobile,text_mobile;
      var contact,text_contact;
      var email,text_email;

      suppliername = document.getElementById("SUPPLIER_NAME").value; 
      phone = document.getElementById("PHONE").value; 
      fax = document.getElementById("FAX").value; 
      address = document.getElementById("ADDRESS").value;
      mobile = document.getElementById("MOBILE").value;
      contact = document.getElementById("CONTACT").value;
      email = document.getElementById("EMAIL").value;
      
   
                     
      if (suppliername==null || suppliername==''){
      document.getElementById("suppliername").style.display = "";     
      text_suppliername= "*กรุณาระบุชื่อร้าน";
      document.getElementById("suppliername").innerHTML = text_suppliername;
      }else{
      document.getElementById("suppliername").style.display = "none";
      }
      if (phone==null || phone==''){
      document.getElementById("phone").style.display = "";     
      text_phone= "*กรุณาระบุเบอร์โทร";
      document.getElementById("phone").innerHTML = text_phone;
      }else{
      document.getElementById("phone").style.display = "none";
      }
      if (fax==null || fax==''){
      document.getElementById("fax").style.display = "";     
      text_fax = "*กรุณาระบุ FAX";
      document.getElementById("fax").innerHTML = text_fax;
      }else{
      document.getElementById("fax").style.display = "none";
      }
      if (address==null || address==''){
      document.getElementById("address").style.display = "";     
      text_address = "*กรุณาระบุที่อยู่";
      document.getElementById("address").innerHTML = text_address;
      }else{
      document.getElementById("address").style.display = "none";
      }
      if (mobile==null || mobile==''){
      document.getElementById("mobile").style.display = "";     
      text_mobile = "*กรุณาระบุเบอร์มือถือ";
      document.getElementById("mobile").innerHTML = text_mobile;
      }else{
      document.getElementById("mobile").style.display = "none";
      }
      if (contact==null || contact==''){
      document.getElementById("contact").style.display = "";     
      text_contact = "*กรุณาระบุผู้ติดต่อ";
      document.getElementById("contact").innerHTML = text_contact;
      }else{
      document.getElementById("contact").style.display = "none";
      }
      if (email==null || email==''){
      document.getElementById("email").style.display = "";     
      text_email = "*กรุณาระบุ email";
      document.getElementById("email").innerHTML = text_email;
      }else{
      document.getElementById("email").style.display = "none";
      }
    
      if(suppliername==null || suppliername=='' ||
      phone==null || phone==''||
      fax==null || fax=='' || 
      address==null || address==''||
      mobile==null || mobile=='' ||
      contact==null || contact==''||
      email==null || email==''    
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>


@endsection