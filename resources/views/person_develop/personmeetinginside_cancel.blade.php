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
<?php
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');
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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แจ้งยกเลิกประชุมภายใน</B></h3>
                </div>
                <div class="block-content">    

    
                <form  method="post" action="{{route('perdev.personmeetinginside_updatecancel')}}" enctype="multipart/form-data">
        @csrf

        
        <input type="hidden" name="iduser" id="iduser" value="{{ $id_user }}">
        <input type="hidden" name="MEETING_INSIDE_ID" id="MEETING_INSIDE_ID" value="{{$meetinginsides->MEETING_INSIDE_ID}}">

        <input type="hidden"  name="ID" value=""/>
        <div class="row">
       
        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวข้อประชุม :</label>
            </div>                               
        </div> 
        <div class="col-sm-3 text-left">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_TITLE}}</h1>
            </div>                               
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
            <label >สถานที่จัดประชุม :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $meetinginsides -> LOCATION_ORG_NAME }}</h1>
            </div>                               
        </div>  
       
        </div>

      
        
        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label>ประเภทการประชุม :</label>
            </div>                               
        </div>  
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $meetinginsides -> MEETTINGSIDE_NAME }}</h1>
            </div>                               
        </div>  
      


       <div class="col-sm-2">
        <div class="form-group">
        <label>วันที่ :</label>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
        <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($meetinginsides -> MEETING_INSIDE_DATE) }}</h2>
        </div>
    </div>
    <div class="col-sm-1">
       <div class="form-group">
       <label>ตั้งแต่เวลา :</label>
       </div>
   </div>
   <div class="col-sm-2">
       <div class="form-group">
       <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ formatetime($meetinginsides -> MEETING_INSIDE_STARTTIME) }} ถึง {{ formatetime($meetinginsides -> MEETING_INSIDE_ENDTIME) }}</h2>
       </div>
   </div>                                            
   </div>
     
       
       <div class="row">
                                      
        <div class="col-sm-2">
            <div class="form-group">
            <label >ประธาน :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group" >
            <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->HR_FNAME}}&nbsp;&nbsp; {{$meetinginsides->HR_LNAME}}</h2>
            </div>
        </div>
 
        <div class="col-sm-2">
            <div class="form-group">
            <label >ผู้บันทึก :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_USERSAVE_NAME}}</h2>
            </div>
        </div> 
        </div>
      
        <div class="row">
                                      
            <div class="col-sm-2">
                <div class="form-group">
                <label >ห้องประชุม :</label>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->ROOM_NAME}}</h2>
                </div>
            </div>   
        </div>

      <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
    
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "MEETING_INSIDE_COMMENT"  id="MEETING_INSIDE_COMMENT" class="form-control input-lg" ></textarea>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-save mr-2"></i>ยืนยันการยกเลิก</button>&nbsp;&nbsp;
        <a href="{{url('person_dev/personmeetinginside/'.$id_user)}}"  class="btn btn-hero-sm btn-hero-secondary" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a></div><br> 
      
       
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