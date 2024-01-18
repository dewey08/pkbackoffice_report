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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มรายการส่งการเงิน</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliessendmoneyitem') }}" enctype="multipart/form-data">
        @csrf
            <div class="row push">                       
                <div class="col-lg-2">
                    <label >รายการส่งการเงิน</label>
                </div>
                <div class="col-lg-10">
                    <input  name = "MONEY_SEND_ITEM_NAME"  id="MONEY_SEND_ITEM_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_moneysendname();">
                    <div style="color: red; font-size: 16px;" id="moneysendname"></div> 
                </div>
                {{-- <div class="col-lg-7">
                      
                    </div> --}}
            </div>           
        </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliessendmoneyitem')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_moneysendname()
    {                         
        moneysendname = document.getElementById("MONEY_SEND_ITEM_NAME").value;             
            if (moneysendname==null || moneysendname==''){
            document.getElementById("moneysendname").style.display = "";     
            text_moneysendname = "*กรุณาระบุรายการส่งการเงิน";
            document.getElementById("moneysendname").innerHTML = text_moneysendname;
            }else{
            document.getElementById("moneysendname").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var moneysendname,text_moneysendname; 
     
      moneysendname = document.getElementById("MONEY_SEND_ITEM_NAME").value; 
   
                     
      if (moneysendname==null || moneysendname==''){
      document.getElementById("moneysendname").style.display = "";     
      text_moneysendname = "*กรุณาระบุรายการส่งการเงิน";
      document.getElementById("moneysendname").innerHTML = text_moneysendname;
      }else{
      document.getElementById("moneysendname").style.display = "none";
      }
  
  
      if(moneysendname==null || moneysendname==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>


@endsection