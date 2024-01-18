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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขผู้แทนจำหน่าย</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliesvendor') }}" enctype="multipart/form-data">
        @csrf
        {{-- <div class="row push">                       
                <div class="col-lg-1">
                    <label >เลขที่บิล</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_NUM"  id="VENDOR_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_NUM}}" onkeyup="check_vendornum();">
                    <div style="color: red; font-size: 16px;" id="vendornum"></div> 
                  
                </div>
                <div class="col-lg-1">
                        <label >เลขที่ vat</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VAT_NUM"  id="VAT_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VAT_NUM}}" onkeyup="check_vatnum();">
                    <div style="color: red; font-size: 16px;" id="vatnum"></div> 
                   
                </div>
                <div class="col-lg-1">
                        <label >ชื่อย่อ</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_NAME_SHOT"  id="VENDOR_NAME_SHOT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_NAME_SHOT}}" onkeyup="check_vendornameshort();">
                    <div style="color: red; font-size: 16px;" id="vendornameshort"></div>  
                </div>               
            </div> --}}
        <div class="row push">                       
                <div class="col-lg-1">
                    <label >ชื่อตัวแทน</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_NAME"  id="VENDOR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_NAME}}" onkeyup="check_vendorname();">
                    <div style="color: red; font-size: 16px;" id="vendorname"></div> 
                </div>
                <div class="col-lg-1">
                        <label >อีเมล</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_EMAIL"  id="VENDOR_EMAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_EMAIL}}" onkeyup="check_vendoremail();">
                    <div style="color: red; font-size: 16px;" id="vendoremail"></div>  
                </div>
                <div class="col-lg-1">
                        <label >เบอร์โทร</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_PHONE"  id="VENDOR_PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_PHONE}}" onkeyup="check_vendorphone();">
                    <div style="color: red; font-size: 16px;" id="vendorphone"></div> 
                </div>               
            </div> 
        <div class="row push">                       
                <div class="col-lg-1">
                    <label >ที่อยู่</label>
                </div>
                <div class="col-lg-7">
                        <textarea class="form-control" id="VENDOR_ADDRESS" name="VENDOR_ADDRESS" rows="2" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_vendoraddress();"> {{$infosuppliesvendorT->VENDOR_ADDRESS}}</textarea>
                    {{-- <input  name = "VENDOR_ADDRESS"  id="VENDOR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"> --}}
                    <div style="color: red; font-size: 16px;" id="vendoraddress"></div> 
                </div>
                <div class="col-lg-2">
                        <label >รหัสไปรษณีย์</label>
                </div>
                <div class="col-lg-2">
                    <input  name = "VENDOR_POSTCODE"  id="VENDOR_POSTCODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_POSTCODE}}" onkeyup="check_vendorpostcode();">
                    <div style="color: red; font-size: 16px;" id="vendorpostcode"></div> 
                </div>                              
            </div> 
        <div class="row push">                       
                <div class="col-lg-1">
                    <label >ชื่อผู้ติดต่อ</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_CONTECT"  id="VENDOR_CONTECT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_CONTECT}}" onkeyup="check_vendorcontact();">
                    <div style="color: red; font-size: 16px;" id="vendorcontact"></div>  
                </div>
                <div class="col-lg-2">
                        <label >เลขประจำตัวผู้เสียภาษี</label>
                </div>
                <div class="col-lg-2">
                    <input  name = "VENDOR_TAX_NUM"  id="VENDOR_TAX_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_TAX_NUM}}" onkeyup="check_vendortaxnum();">
                    <div style="color: red; font-size: 16px;" id="vendortaxnum"></div>  
                </div>
                <div class="col-lg-1">
                        <label >Fax</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_FAX"  id="VENDOR_FAX" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_FAX}}" onkeyup="check_vendorfax();">
                    <div style="color: red; font-size: 16px;" id="vendorfax"></div> 
                </div>               
            </div> 
        <div class="row push">                       
                <div class="col-lg-1">
                    <label >ชื่อบัญชี</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_BANK_NAME"  id="VENDOR_BANK_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_BANK_NAME}}" onkeyup="check_vendorbanname();">
                    <div style="color: red; font-size: 16px;" id="vendorbanname"></div>  
                </div>
                <div class="col-lg-1">
                        <label >เลขที่บัญชี</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_BANK_NUM"  id="VENDOR_BANK_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_BANK_NUM}}" onkeyup="check_vendorbannum();">
                    <div style="color: red; font-size: 16px;" id="vendorbannum"></div> 
                </div>                            
            </div> 
        <div class="row push">                       
                <div class="col-lg-1">
                    <label >ชื่อธนาคาร</label>
                </div>
                <div class="col-lg-3">
                    <input  name = "VENDOR_BANK"  id="VENDOR_BANK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_BANK}}" onkeyup="check_vendorbank();">
                    <div style="color: red; font-size: 16px;" id="vendorbank"></div> 
                </div>
                <div class="col-lg-2">
                        <label >ประเภทบัญชี</label>
                </div>
                <div class="col-lg-2">
                    <input  name = "VENDOR_BANK_TYPE"  id="VENDOR_BANK_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesvendorT->VENDOR_BANK_TYPE}}" onkeyup="check_vendorbanktype();">
                    <div style="color: red; font-size: 16px;" id="vendorbanktype"></div>  
                </div>                            
            </div> 
                <input type="hidden" name = "VENDOR_ID"  id="VENDOR_ID" class="form-control input-lg" value="{{$infosuppliesvendorT->VENDOR_ID}}">
               </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i> บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesvendor')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i> ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_vendornum()
    {                         
        vendornum = document.getElementById("VENDOR_NUM").value;             
            if (vendornum==null || vendornum==''){
            document.getElementById("vendornum").style.display = "";     
            text_vendornum = "*กรุณาระบุเลขที่บิล";
            document.getElementById("vendornum").innerHTML = text_vendornum;
            }else{
            document.getElementById("vendornum").style.display = "none";
            }
    }
    function check_vatnum()
    {                         
        vatnum = document.getElementById("VAT_NUM").value;             
            if (vatnum==null || vatnum==''){
            document.getElementById("vatnum").style.display = "";     
            text_vatnum = "*กรุณาระบุเลขที่ vat";
            document.getElementById("vatnum").innerHTML = text_vatnum;
            }else{
            document.getElementById("vatnum").style.display = "none";
            }
    }
    function check_vendornameshort()
    {                         
        vendornameshort = document.getElementById("VENDOR_NAME_SHOT").value;             
            if (vendornameshort==null || vendornameshort==''){
            document.getElementById("vendornameshort").style.display = "";     
            text_vendornameshort = "*กรุณาระบุชื่อย่อ";
            document.getElementById("vendornameshort").innerHTML = text_vendornameshort;
            }else{
            document.getElementById("vendornameshort").style.display = "none";
            }
    }
    function check_vendorname()
    {                         
        vendorname = document.getElementById("VENDOR_NAME").value;             
            if (vendorname==null || vendorname==''){
            document.getElementById("vendorname").style.display = "";     
            text_vendorname = "*กรุณาระบุชื่อตัวแทน";
            document.getElementById("vendorname").innerHTML = text_vendorname;
            }else{
            document.getElementById("vendorname").style.display = "none";
            }
    }
    function check_vendoremail()
    {                         
        vendoremail = document.getElementById("VENDOR_EMAIL").value;             
            if (vendoremail==null || vendoremail==''){
            document.getElementById("vendoremail").style.display = "";     
            text_vendoremail = "*กรุณาระบุอีเมล";
            document.getElementById("vendoremail").innerHTML = text_vendoremail;
            }else{
            document.getElementById("vendoremail").style.display = "none";
            }
    }
    function check_vendorphone()
    {                         
        vendorphone = document.getElementById("VENDOR_PHONE").value;             
            if (vendorphone==null || vendorphone==''){
            document.getElementById("vendorphone").style.display = "";     
            text_vendorphone = "*กรุณาระบุเบอร์โทร";
            document.getElementById("vendorphone").innerHTML = text_vendorphone;
            }else{
            document.getElementById("vendorphone").style.display = "none";
            }
    }
    function check_vendoraddress()
    {                         
        vendoraddress = document.getElementById("VENDOR_ADDRESS").value;             
            if (vendoraddress==null || vendoraddress==''){
            document.getElementById("vendoraddress").style.display = "";     
            text_vendoraddress = "*กรุณาระบุที่อยู่";
            document.getElementById("vendoraddress").innerHTML = text_vendoraddress;
            }else{
            document.getElementById("vendoraddress").style.display = "none";
            }
    }
    function check_vendorpostcode()
    {                         
        vendorpostcode = document.getElementById("VENDOR_POSTCODE").value;             
            if (vendorpostcode==null || vendorpostcode==''){
            document.getElementById("vendorpostcode").style.display = "";     
            text_vendorpostcode = "*กรุณาระบุรหัสไปรษณีย์";
            document.getElementById("vendorpostcode").innerHTML = text_vendorpostcode;
            }else{
            document.getElementById("vendorpostcode").style.display = "none";
            }
    }
    function check_vendorcontact()
    {                         
        vendorcontact = document.getElementById("VENDOR_CONTECT").value;             
            if (vendorcontact==null || vendorcontact==''){
            document.getElementById("vendorcontact").style.display = "";     
            text_vendorcontact = "*กรุณาระบุชื่อผู้ติดต่อ";
            document.getElementById("vendorcontact").innerHTML = text_vendorcontact;
            }else{
            document.getElementById("vendorcontact").style.display = "none";
            }
    }
    function check_vendortaxnum()
    {                         
        vendortaxnum = document.getElementById("VENDOR_TAX_NUM").value;             
            if (vendortaxnum==null || vendortaxnum==''){
            document.getElementById("vendortaxnum").style.display = "";     
            text_vendortaxnum = "*กรุณาระบุเลขประจำตัวผู้เสียภาษี";
            document.getElementById("vendortaxnum").innerHTML = text_vendortaxnum;
            }else{
            document.getElementById("vendortaxnum").style.display = "none";
            }
    }
    function check_vendorfax()
    {                         
        vendorfax = document.getElementById("VENDOR_FAX").value;             
            if (vendorfax==null || vendorfax==''){
            document.getElementById("vendorfax").style.display = "";     
            text_vendorfax = "*กรุณาระบุ Fax";
            document.getElementById("vendorfax").innerHTML = text_vendorfax;
            }else{
            document.getElementById("vendorfax").style.display = "none";
            }
    }

    function check_vendorbanname()
    {                         
        vendorbanname = document.getElementById("VENDOR_BANK_NAME").value;             
            if (vendorbanname==null || vendorbanname==''){
            document.getElementById("vendorbanname").style.display = "";     
            text_vendorbanname = "*กรุณาระบุชื่อบัญชี";
            document.getElementById("vendorbanname").innerHTML = text_vendorbanname;
            }else{
            document.getElementById("vendorbanname").style.display = "none";
            }
    }
    function check_vendorbannum()
    {                         
        vendorbannum = document.getElementById("VENDOR_BANK_NUM").value;             
            if (vendorbannum==null || vendorbannum==''){
            document.getElementById("vendorbannum").style.display = "";     
            text_vendorbannum = "*กรุณาระบุเลขที่บัญชี";
            document.getElementById("vendorbannum").innerHTML = text_vendorbannum;
            }else{
            document.getElementById("vendorbannum").style.display = "none";
            }
    }
    function check_vendorbank()
    {                         
        vendorbank = document.getElementById("VENDOR_BANK").value;             
            if (vendorbank==null || vendorbank==''){
            document.getElementById("vendorbank").style.display = "";     
            text_vendorbank = "*กรุณาระบุชื่อธนาคาร";
            document.getElementById("vendorbank").innerHTML = text_vendorbank;
            }else{
            document.getElementById("vendorbank").style.display = "none";
            }
    }
    function check_vendorbanktype()
    {                         
        vendorbanktype = document.getElementById("VENDOR_BANK_TYPE").value;             
            if (vendorbanktype==null || vendorbanktype==''){
            document.getElementById("vendorbanktype").style.display = "";     
            text_vendorbanktype = "*กรุณาระบุประเภทบัญชี";
            document.getElementById("vendorbanktype").innerHTML = text_vendorbanktype;
            }else{
            document.getElementById("vendorbanktype").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
        var vendornum,text_vendornum;
        var vatnum,text_vatnum;
        var vendornameshort,text_vendornameshort;
        var vendorname,text_vendorname;
        var vendoremail,text_vendoremail;
        var vendorphone,text_vendorphone;
        var vendoraddress,text_vendoraddress;
        var vendorpostcode,text_vendorpostcode;
        var vendorcontact,text_vendorcontact;
        var vendortaxnum,text_vendortaxnum;
        var vendorfax,text_vendorfax;
        var vendorbanname,text_vendorbanname;
        var vendorbannum,text_vendorbannum;
        var vendorbank,text_vendorbank;
        var vendorbanktype,text_vendorbanktype;

            
        vendornum = document.getElementById("VENDOR_NUM").value;
        vatnum = document.getElementById("VAT_NUM").value;   
        vendornameshort = document.getElementById("VENDOR_NAME_SHOT").value; 
        vendorname = document.getElementById("VENDOR_NAME").value; 
        vendoremail = document.getElementById("VENDOR_EMAIL").value; 
        vendorphone = document.getElementById("VENDOR_PHONE").value; 
        vendoraddress = document.getElementById("VENDOR_ADDRESS").value; 
        vendorpostcode = document.getElementById("VENDOR_POSTCODE").value; 
        vendorcontact = document.getElementById("VENDOR_CONTECT").value; 
        vendortaxnum = document.getElementById("VENDOR_TAX_NUM").value;
        vendorfax = document.getElementById("VENDOR_FAX").value;
        vendorbanname = document.getElementById("VENDOR_BANK_NAME").value;
        vendorbannum = document.getElementById("VENDOR_BANK_NUM").value;
        vendorbank = document.getElementById("VENDOR_BANK").value;
        vendorbanktype = document.getElementById("VENDOR_BANK_TYPE").value; 
                     
      if (vendornum==null || vendornum==''){
      document.getElementById("vendornum").style.display = "";     
      text_vendornum = "*กรุณาระบุเลขที่บิล";
      document.getElementById("vendornum").innerHTML = text_vendornum;
      }else{
      document.getElementById("vendornum").style.display = "none";
      }    
                     
      if (vatnum==null || vatnum==''){
      document.getElementById("vatnum").style.display = "";     
      text_vatnum = "*กรุณาระบุเลขที่ vat";
      document.getElementById("vatnum").innerHTML = text_vatnum;
      }else{
      document.getElementById("vatnum").style.display = "none";
      }
      if (vendornameshort==null || vendornameshort==''){
      document.getElementById("vendornameshort").style.display = "";     
      text_vendornameshort = "*กรุณาระบุเลขที่ vat";
      document.getElementById("vendornameshort").innerHTML = text_vendornameshort;
      }else{
      document.getElementById("vendornameshort").style.display = "none";
      }
      if (vendorname==null || vendorname==''){
      document.getElementById("vendorname").style.display = "";     
      text_vendorname = "*กรุณาระบุชื่อตัวแทน";
      document.getElementById("vendorname").innerHTML = text_vendorname;
      }else{
      document.getElementById("vendorname").style.display = "none";
      }
      if (vendoremail==null || vendoremail==''){
      document.getElementById("vendoremail").style.display = "";     
      text_vendoremail = "*กรุณาระบุอีเมล์";
      document.getElementById("vendoremail").innerHTML = text_vendoremail;
      }else{
      document.getElementById("vendoremail").style.display = "none";
      }
      if (vendorphone==null || vendorphone==''){
      document.getElementById("vendorphone").style.display = "";     
      text_vendorphone = "*กรุณาระบุเบอร์โทร";
      document.getElementById("vendorphone").innerHTML = text_vendorphone;
      }else{
      document.getElementById("vendorphone").style.display = "none";
      }
      if (vendoraddress==null || vendoraddress==''){
      document.getElementById("vendoraddress").style.display = "";     
      text_vendoraddress = "*กรุณาระบุที่อยู่";
      document.getElementById("vendoraddress").innerHTML = text_vendoraddress;
      }else{
      document.getElementById("vendoraddress").style.display = "none";
      }
      if (vendorpostcode==null || vendorpostcode==''){
      document.getElementById("vendorpostcode").style.display = "";     
      text_vendorpostcode = "*กรุณาระบุรหัสไปรษณีย์";
      document.getElementById("vendorpostcode").innerHTML = text_vendorpostcode;
      }else{
      document.getElementById("vendorpostcode").style.display = "none";
      }
      if (vendorcontact==null || vendorcontact==''){
      document.getElementById("vendorcontact").style.display = "";     
      text_vendorcontact = "*กรุณาระบุชื่อผู้ติดต่อ";
      document.getElementById("vendorcontact").innerHTML = text_vendorcontact;
      }else{
      document.getElementById("vendorcontact").style.display = "none";
      }
      if (vendortaxnum==null || vendortaxnum==''){
      document.getElementById("vendortaxnum").style.display = "";     
      text_vendortaxnum = "*กรุณาระบุเลขประจำตัวผู้เสียภาษี";
      document.getElementById("vendortaxnum").innerHTML = text_vendortaxnum;
      }else{
      document.getElementById("vendortaxnum").style.display = "none";
      }
      if (vendorfax==null || vendorfax==''){
      document.getElementById("vendorfax").style.display = "";     
      text_vendorfax = "*กรุณาระบุ Fax";
      document.getElementById("vendorfax").innerHTML = text_vendorfax;
      }else{
      document.getElementById("vendorfax").style.display = "none";
      }
      if (vendorbanname==null || vendorbanname==''){
      document.getElementById("vendorbanname").style.display = "";     
      text_vendorbanname = "*กรุณาระบุชื่อบัญชี";
      document.getElementById("vendorbanname").innerHTML = text_vendorbanname;
      }else{
      document.getElementById("vendorbanname").style.display = "none";
      }
      if (vendorbannum==null || vendorbannum==''){
      document.getElementById("vendorbannum").style.display = "";     
      text_vendorbannum = "*กรุณาระบุเลขที่บัญชี";
      document.getElementById("vendorbannum").innerHTML = text_vendorbannum;
      }else{
      document.getElementById("vendorbannum").style.display = "none";
      }
      if (vendorbank==null || vendorbank==''){
      document.getElementById("vendorbank").style.display = "";     
      text_vendorbank = "*กรุณาระบุชื่อธนาคาร";
      document.getElementById("vendorbank").innerHTML = text_vendorbank;
      }else{
      document.getElementById("vendorbank").style.display = "none";
      }
      if (vendorbanktype==null || vendorbanktype==''){
      document.getElementById("vendorbanktype").style.display = "";     
      text_vendorbanktype = "*กรุณาระบุประเภทบัญชี";
      document.getElementById("vendorbanktype").innerHTML = text_vendorbanktype;
      }else{
      document.getElementById("vendorbanktype").style.display = "none";
      }
  
      if(vendornum==null || vendornum=='' ||
      vatnum==null || vatnum=='' ||
      vendornameshort==null || vendornameshort=='' ||
      vendorname==null || vendorname=='' ||
      vendoremail==null || vendoremail=='' ||
      vendorphone==null || vendorphone=='' ||
      vendoraddress==null || vendoraddress=='' ||
      vendorpostcode==null || vendorpostcode=='' ||
      vendorcontact==null || vendorcontact=='' ||
      vendortaxnum==null || vendortaxnum=='' ||
      vendorfax==null || vendorfax=='' ||
      vendorbanname==null || vendorbanname=='' ||
      vendorbannum==null || vendorbannum=='' ||
      vendorbank==null || vendorbank=='' ||
      vendorbanktype==null || vendorbanktype=='' 

       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection