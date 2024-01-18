@extends('layouts.meet')
  
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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      }  
      p{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

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

           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                     
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-header block-header-default ">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตรวจสอบคำร้องจองห้องประชุม</B></h3>
                </div>
                <div class="block-content">    

    
        <form  method="post" action="{{ route('meet.updatemeetcheck') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforecordid }}"/>
       
        <div class="row">
       
        <div class="col-sm-2">
           <div class="form-group">
           <label >เรื่องการประชุม :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->SERVICE_STORY }}</h1> 
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ปีงบประมาณ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->YEAR_ID }}</h1> 
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >กลุ่มบุคคลเป้าหมาย :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
          <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->GROUP_FOCUS }}</h1> 
           </div>                               
       </div>    
       <div class="col-sm-2">
           <div class="form-group">
           <label >จำนวน :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->TOTAL_PEOPLE }} คน</h1> 
           </div>                               
       </div>
       </div>

       
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>ประสงค์ใช้ห้อง :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->ROOM_NAME}}</h1> 
           </div>                               
       </div>  
       <div class="col-sm-2">
           <div class="form-group">
           <label>วัตถุประสงค์การขอใช้ :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->OBJECTIVE_NAME}}</h1> 
           </div>                               
       </div>    
      </div>
    
      
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >ตั้งแต่วันที่ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($inforoomindex->DATE_BEGIN)}} เวลา {{formatetime($inforoomindex->TIME_BEGIN)}} น.</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >ถึงแต่วันที่ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($inforoomindex->DATE_END)}} เวลา {{formatetime($inforoomindex->TIME_END)}} น.</h1> 
           </div>                               
       </div>   
 
       </div>
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label > ผู้ร้องขอ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->PERSON_REQUEST_NAME}}</h1> 
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label > เบอร์ติดต่อ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->PERSON_REQUEST_PHONE}}</h1> 
           </div>                               
       </div> 
       
 
       </div>
     
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
    
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "SUBMIT_COMMENT"  id="SUBMIT_COMMENT" class="form-control input-lg" ></textarea>
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="approved" ><i class="fas fa-clipboard-check text-white mr-2"></i>อนุมัติ</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="not_approved" ><i class="fas fa-window-close text-white mr-2"></i>ไม่อนุมัติ</button>
        <a href="{{ url('manager_meet/managemeetcheck') }}" class="btn btn-hero-sm btn-hero-warning" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>กลับหน้าตรวจสอบ</a>
       
        </div>
        </div>
        </form>  
           
      

                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


  
</script>



@endsection