@extends('layouts.supplies')
    
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
      font-size: 14px;
      
      }

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
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

?>

<center>    
    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ยกเลิกรายการทะเบียนคุม</h2> 
                <div align="left">
        <form  method="post" action="{{ route('msupplies.cancelpurchaseupdate') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="CON_ID" id="CON_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$conid}}">

        <div class="row">
        <div class="col-sm-2">
        <label>เลขทะเบียนคุม :</label>
        </div> 
        <div class="col-lg-4 text-left">
        {{$connum}}
        </div>  
        <div class="col-sm-2">
                <label>ประเภทจัดหา :</label>
            </div>         
        <div class="col-lg-4 text-left">        
        {{$suptypename}}
        </div>

        </div>
       
       


      <div class="row">
        <div class="col-sm-2">
                <label>รายละเอียดพัสดุ :</label>
            </div>         
        <div class="col-lg-4 text-left">        
        {{$condetail}}
        </div>       
     
        <div class="col-sm-2">
                <label>เหตุผลความจำเป็น :</label>
            </div>         
        <div class="col-lg-4 text-left">        
        {{$resonname}}
        </div>
       
       </div>
    
    

    

       <div class="row">

            <div class="col-sm-2">
            <label>ผู้ออกทะเบียน :</label>
            </div> 
            <div class="col-sm-4 text-left">
            {{$personrequestname}}
            </div> 
            <div class="col-sm-2">
            <label>ผู้ทำรายการ :</label>
            </div> 
            <div class="col-sm-4 text-left">
            {{$regisbyname}}
            </div> 
            </div>
          
       
              <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-save mr-2"></i>ยืนยันการยกเลิกทะเบียนคุม</button>
                    <a href="{{ url('manager_supplies/purchase')  }}" class="btn btn-hero-sm btn-hero-secondary"  ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')



@endsection