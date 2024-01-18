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
            font-size: 13px;
            /* font-size: 1.0rem; */
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลวิธีการจัดซื้อ/จัดจ้าง</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliesbuy') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >วิธีการจัดซื้อ/จัดจ้าง</label>
      </div>
      <div class="col-lg-4">
      <input  name = "BUY_NAME"  id="BUY_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_buyname();">
      <div style="color: red; font-size: 16px;" id="buyname"></div> 
    </div>

      <div class="col-lg-2">
      <label >คำอธิบาย</label>
      </div>
      <div class="col-lg-4">
      <input  name = "BUY_COMMENT"  id="BUY_COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_buycomment();">
      <div style="color: red; font-size: 16px;" id="buycomment"></div> 
      </div>
      </div>
      <div class="row push">
       
       <div class="col-lg-2">
         <label >ราคาต่ำสุด</label>
         </div>
         <div class="col-lg-4">
         <input  name = "PRICE_MIN"  id="PRICE_MIN" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_pricemin();">
         <div style="color: red; font-size: 16px;" id="pricemin"></div> 
        </div>

         <div class="col-lg-2">
         <label >ราคาสูงสุด</label>
         </div>
         <div class="col-lg-4">
         <input  name = "PRICE_MAX"  id="PRICE_MAX" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_pricemax();">
         <div style="color: red; font-size: 16px;" id="pricemax"></div> 
        </div>
   
   
         </div>

         <div class="row push">
         <div class="col-lg-2">
         <label >ดำเนินการโดย</label>
         </div>
         <div class="col-lg-4">
         <input  name = "MAKE_BY"  id="MAKE_BY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_makeby();">
         <div style="color: red; font-size: 16px;" id="makeby"></div> 
        </div>
    
    </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesbuy')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
                       

@endsection

@section('footer')

<script>   
    function check_buyname()
    {                         
        buyname = document.getElementById("BUY_NAME").value;             
            if (buyname==null || buyname==''){
            document.getElementById("buyname").style.display = "";     
            text_buyname = "*กรุณาระบุวิธีการจัดซื้อ/จัดจ้าง";
            document.getElementById("buyname").innerHTML = text_buyname;
            }else{
            document.getElementById("buyname").style.display = "none";
            }
    }
    function check_buycomment()
    {                         
        buycomment = document.getElementById("BUY_COMMENT").value;             
            if (buycomment==null || buycomment==''){
            document.getElementById("buycomment").style.display = "";     
            text_buycomment = "*กรุณาระบุคำอธิบาย";
            document.getElementById("buycomment").innerHTML = text_buycomment;
            }else{
            document.getElementById("buycomment").style.display = "none";
            }
    }
    function check_pricemin()
    {                         
        pricemin = document.getElementById("PRICE_MIN").value;             
            if (pricemin==null || pricemin==''){
            document.getElementById("pricemin").style.display = "";     
            text_pricemin = "*กรุณาระบุราคาต่ำสุด";
            document.getElementById("pricemin").innerHTML = text_pricemin;
            }else{
            document.getElementById("pricemin").style.display = "none";
            }
    }
    function check_pricemax()
    {                         
        pricemax = document.getElementById("PRICE_MAX").value;             
            if (pricemax==null || pricemax==''){
            document.getElementById("pricemax").style.display = "";     
            text_pricemax = "*กรุณาระบุราคาสูงสุด";
            document.getElementById("pricemax").innerHTML = text_pricemax;
            }else{
            document.getElementById("pricemax").style.display = "none";
            }
    }
    function check_makeby()
    {                         
        makeby = document.getElementById("MAKE_BY").value;             
            if (makeby==null || makeby==''){
            document.getElementById("makeby").style.display = "";     
            text_makeby = "*กรุณาระบุผู้ดำเนินการ";
            document.getElementById("makeby").innerHTML = text_makeby;
            }else{
            document.getElementById("makeby").style.display = "none";
            }
    }
   
   </script>
    <script>      
    $('form').submit(function () {
     
      var buyname,text_buyname; 
      var buycomment,text_buycomment; 

      var pricemin,text_pricemin; 
      var pricemax,text_pricemax; 
      var makeby,text_makeby;    
     
      buyname = document.getElementById("BUY_NAME").value; 
      buycomment = document.getElementById("BUY_COMMENT").value;

      pricemin = document.getElementById("PRICE_MIN").value; 

      pricemax = document.getElementById("PRICE_MAX").value; 
      makeby = document.getElementById("MAKE_BY").value; 
                
      if (buyname==null || buyname==''){
      document.getElementById("buyname").style.display = "";     
      text_buyname = "*กรุณาระบุวิธีการจัดซื้อ/จัดจ้าง";
      document.getElementById("buyname").innerHTML = text_buyname;
      }else{
      document.getElementById("buyname").style.display = "none";
      }

      if (buycomment==null || buycomment==''){
      document.getElementById("buycomment").style.display = "";     
      text_buycomment = "*กรุณาระบุคำอธิบาย";
      document.getElementById("buycomment").innerHTML = text_buycomment;
      }else{
      document.getElementById("buycomment").style.display = "none";
      }     

        if (pricemin==null || pricemin==''){
      document.getElementById("pricemin").style.display = "";     
      text_pricemin = "*กรุณาระบุราคาต่ำสุด";
      document.getElementById("pricemin").innerHTML = text_pricemin;
      }else{
      document.getElementById("pricemin").style.display = "none";
      }     

          if (pricemax==null || pricemax==''){
      document.getElementById("pricemax").style.display = "";     
      text_pricemax = "*กรุณาระบุราคาสูงสุด";
      document.getElementById("pricemax").innerHTML = text_pricemax;
      }else{
      document.getElementById("pricemax").style.display = "none";
      }     

          if (makeby==null || makeby==''){
      document.getElementById("makeby").style.display = "";     
      text_makeby = "*กรุณาระบุผู้ดำเนินการ";
      document.getElementById("makeby").innerHTML = text_makeby;
      }else{
      document.getElementById("makeby").style.display = "none";
      }     
          
      if(buyname==null || buyname==''||
      buycomment==null || buycomment==''||
      pricemin==null || pricemin==''||
      pricemax==null || pricemax==''||
      makeby==null || makeby==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection