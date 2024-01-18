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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติคำร้อง ประชุม/อบรม/ดูงาน</B></h3>
                </div>
                <div class="block-content">    

    
        <form  method="post" action="{{ route('perdev.updateapp') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforecordid }}"/>
        <div class="row">
       
        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวข้อประชุม :</label>
            </div>                               
        </div> 
        <div class="col-sm-3 text-left">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_HEAD_USE }}</h1>
            </div>                               
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
            <label >สถานที่จัดประชุม :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> LOCATION_ORG_NAME }}</h1>
            </div>                               
        </div>  
       
        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >ระดับ :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_LEVEL_NAME}}</h1>
            </div>                               
        </div>    
        <div class="col-sm-2">
            <div class="form-group">
            <label >หน่วยงานที่จัด :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_ORGANIZER_NAME }}</h1>
            </div>                               
        </div>
        </div>

        
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label>ประเภทสถานที่ประชุม :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> LOCATION_NAME }}</h1>
            </div>                               
        </div>  
        <div class="col-sm-2">
            <div class="form-group">
            <label>ระหว่างวันที่ :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforecord -> DATE_GO) }} ถึง {{ DateThai($inforecord -> DATE_BACK) }}</h1>
            </div>                               
        </div>    
       </div>
     
       
      
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >หมายเหตุ :</label>
            </div>                               
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_COMMENT }}</h1>
            </div>                               
        </div> 
        <div class="col-sm-2">
            <div class="form-group">
            <label >ลักษณะ :</label>
            </div>                               
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_GO_NAME }}</h1>
            </div>                               
        </div>   
  
        </div>
      
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label > พาหนะเดินทาง :</label>
            </div>                               
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> RECORD_VEHICLE_NAME }}</h1>
            </div>                               
        </div> 
        <div class="col-sm-2">
            <div class="form-group">
            <label>การเบิกเงิน :</label>
            </div>                               
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> WITHDRAW_NAME }}</h1>
            </div>                               
        </div>   
  
        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวหน้าฝ่าย :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> LEADER_HR_NAME }}</h1>
            </div>                               
        </div>  
        <div class="col-sm-2">
            <div class="form-group">
            <label >มอบหมายงานให้ :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforecord -> OFFER_WORK_HR_NAME }}</h1>
            </div>                               
        </div>  
        </div>

      
    
      
     
      
      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
    
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "APPROVE_COMMENT"  id="APPROVE_COMMENT" class="form-control input-lg" ></textarea>
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่อนุมัติ</button>
        <a href="{{ url('person_dev/persondevapp/'.$user_id)  }}" class="btn btn-warning btn-lg" >กลับหน้าอนุมัติ</a>
       
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