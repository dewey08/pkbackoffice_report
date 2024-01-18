@extends('layouts.backend')
   
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
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                   
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-header block-header-default ">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยกเลิกการลา</B></h3>
                </div>
                <div class="block-content">    

    
        <form  method="post" action="{{ route('leave.updatecancelver') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforleave -> ID }}"/>
        <div class="row push">
        <div class="col-lg-4">
        <div class="form-group">
            <label >ปีงบประมาณ</label>
            <p>{{ $inforleave -> LEAVE_YEAR_ID }}</p>
        </div>              
        <div class="form-group">
            <label >ชื่อผู้ลา</label>
            <p>{{ $inforleave -> LEAVE_PERSON_FULLNAME }}</p>
        </div> 
        <div class="form-group">
            <label >ประเภทการลา</label>
            <p>{{ $inforleave -> LEAVE_TYPE_NAME }}</p>
        </div>
        <div class="form-group">
            <label >เหตุผลการลา</label>
            <p>{{ $inforleave -> LEAVE_BECAUSE }}</p>
        </div> 
        <div class="form-group">
            <label >สถานที่ไป</label>
            <p>{{ $inforleave -> LOCATION_NAME }}</p>
        </div> 
       
               
         </div>
         
    <div class="col-lg-4">
    <div class="form-group">
            <label >มอบหมายงาน</label>
            <p>{{ $inforleave -> LEAVE_WORK_SEND }}</p>
        </div>       
        <div class="form-group">
            <label >วันเริ่มลา</label>
            <p>{{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}</p>
        </div>       
        <div class="form-group">
            <label >สิ้นสุดวันลา</label>
            <p>{{ DateThai($inforleave -> LEAVE_DATE_END) }}</p>
        </div>
        <div class="form-group">
            <label >ลาเต็มวัน/ครึ่งวัน</label>
            <p>
            @if($inforleave -> DAY_TYPE_ID == 3)
           ครึ่งวัน(บ่าย)
           @elseif($inforleave -> DAY_TYPE_ID == 2)
           ครึ่งวัน(เช้า)
           @else
           เติมวัน
           @endif   
            
            </p>
        </div>
        <div class="form-group">
            <label >เบอร์ติดต่อ</label>
            <p>{{ $inforleave -> LEAVE_CONTACT_PHONE }}</p>
        </div>    
        
       
   
   

      </div>
      <div class="col-lg-4">
      <div class="form-group">
            <label >ระหว่างลาติดต่อ</label>
            <p>{{ $inforleave -> LEAVE_CONTACT }}</p>
        </div>    
      
     
         <div class="form-group">
            <label >รวมวันลา</label>
            <p>{{ number_format($inforleave -> LEAVE_SUM_ALL,1) }}  วัน</p>
        </div>  
        <div class="form-group">
            <label >วันทำการ</label>
            <p>{{ number_format($inforleave -> WORK_DO,1) }} วัน</p>
        </div>  
        <div class="form-group">
            <label >วันหยุดเสาร์ - อาทิตย์</label>
            <p>{{ number_format($inforleave -> LEAVE_SUM_SETSUN,1) }} วัน</p>
        </div>   
        <div class="form-group">
            <label >วันหยุดนักขัตฤกษ์</label>
            <p>{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY,1) }} วัน</p>
        </div>                               
      
      
      </div>
      </div>
      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
      <input type="hidden" name = "LEAVE_STATUS_CODE"  id="LEAVE_STATUS_CODE" value="Cancel">
    
      <label >เหตุผลการยกเลิก</label>
      <textarea   name = "COMMENT"  id="COMMENT" class="form-control input-lg" required>{{ $inforleave ->LEAVE_CANCEL_COMMENT }}</textarea>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>ยืนยันการยกเลิกคำขอ</button>&nbsp;&nbsp;
        
      
        <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-sign-out-alt mr-2"></i>ยกเลิก</a></div><br> 
      
          
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