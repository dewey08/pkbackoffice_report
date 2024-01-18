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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยกเลิกคำร้อง ขอใช้รถยนต์ทั่วไป</B></h3>
                </div>
                <div class="block-content">    

    
        <form  method="post" action="{{ route('car.updatecancelnomal') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="RESERVE_ID" value="{{$infocarnimal->RESERVE_ID}}"/>
        <input type="hidden"  name="RESERVE_PERSON_ID" value="{{$infocarnimal->RESERVE_PERSON_ID}}"/>
        

<div class="row push" style="font-family: 'Kanit', sans-serif;">

<div class="col-sm-9">

  <div class="row">
      <div class="col-lg-2" align="right">
      <label>ขอใช้รถ :</label>
      </div> 
      <div class="col-lg-8" align="left">
      {{$infocarnimal->RESERVE_NAME}}
      </div> 
  </div>    
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>สถานที่ไป :</label>
      </div> 
      <div class="col-lg-8" align="left">
      {{$infocarnimal->LOCATION_ORG_NAME}}
      </div> 
  </div>    
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>ผู้ขอ :</label>
      </div> 
      <div class="col-lg-6" align="left">
      {{$infocarnimal->HR_PREFIX_NAME}}{{$infocarnimal->HR_FNAME}} {{$infocarnimal->HR_LNAME}}
      </div> 
      <div class="col-lg-1" align="right">
      <label>โทร :</label>
      </div> 
      <div class="col-lg-3" align="left">
        {{$infocarnimal->HR_PHONE}}
      </div> 
  </div>    
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>วันที่ :</label>
      </div> 
      <div class="col-lg-6" align="left">
      {{DateThai($infocarnimal->RESERVE_BEGIN_DATE)}}
      </div> 
      <div class="col-lg-1" align="right">
      <label>เวลา :</label>
      </div> 
      <div class="col-lg-3" align="left">
      {{formatetime($infocarnimal->RESERVE_BEGIN_TIME)}}
      </div> 
  </div>    

</div>

<div class="col-sm-3">

<div class="form-group">

<img src="data:image/png;base64,{{chunk_split(base64_encode($infocarnimal->HR_IMAGE))}}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="100px" width="100px"/>
</div>

</div>
</div>
<BR>

<div class="row" style="font-family: 'Kanit', sans-serif;">

<div class="col-sm-9">

<div class="row push">
      <div class="col-lg-2" align="right">
      <label>ยานพาหนะ :</label>
      </div> 
      <div class="col-lg-2" align="left">
      {{$infocarnimal->CAR_REG}}
      </div> 
      <div class="col-lg-2" align="right">
      <label>รายละเอียด :</label>
      </div> 
      <div class="col-lg-6" align="left">
      {{$infocarnimal->CAR_DETAIL}}
      </div> 
  </div> 
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>พนักงานขับรถ :</label>
      </div> 
      <div class="col-lg-6" align="left">
      {{$CAR_DRIVER->HR_PREFIX_NAME}}{{$CAR_DRIVER->HR_FNAME}} {{$CAR_DRIVER->HR_LNAME}}
      </div> 
      <div class="col-lg-1" align="right">
      <label>โทร :</label>
      </div> 
      <div class="col-lg-3" align="left">
      {{$CAR_DRIVER->HR_PHONE}}
      </div> 
  </div>    

  <div class="row">
      <div class="col-lg-2" align="right">
      <label>สถานที่นัด :</label>
      </div> 
      <div class="col-lg-6" align="left">
      {{$infocarnimal->APPOINT_LOCATE_NAME}}
      </div> 
      <div class="col-lg-1" align="right">
      <label>เวลา :</label>
      </div> 
      <div class="col-lg-3" align="left">
      {{formatetime($infocarnimal->APPOINT_TIME)}}
      </div> 
  </div> 
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>งานฝาก :</label>
      </div> 
      <div class="col-lg-10" align="left">
      
      </div> 
    
  </div>  
  <div class="row">
      <div class="col-lg-2" align="right">
      <label>หมายเหตุ :</label>
      </div> 
      <div class="col-lg-10" align="left">
      {{$infocarnimal->COMMENT}}
      </div> 
    
  </div>    



</div>

<div class="col-sm-3">

<img src="data:image/png;base64,{{chunk_split(base64_encode($CAR_DRIVER->HR_IMAGE))}}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="100px" width="100px"/>
</div>
</div>

      
    
    
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-save mr-2"></i>ยืนยันการยกเลิกคำร้อง</button>&nbsp;&nbsp;
        <a href="{{ url('general_car/gencarinfonomal/'.$inforpersonuserid -> ID)}}"  class="btn btn-hero-sm btn-hero-secondary" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a></div><br> 
      
       
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