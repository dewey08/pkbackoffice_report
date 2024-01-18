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

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead > tr > th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
</style>
<body onload="run01();">
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser-> HR_PREFIX_NAME }}   {{ $inforpersonuser-> HR_FNAME }}  {{ $inforpersonuser-> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตอบรับวิทยากร</h2> 


                <div class="row">

                    <div class="col-sm-2">
                        <div class="form-group">
                        <label >หัวข้อประชุม :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group" >
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_HEAD_USE }}</h1>
                        </div>
                    </div>
             
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label >สถานที่จัดประชุม :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> LOCATION_ORG_NAME }}</h1>
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
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_LEVEL_NAME}}</h1>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label >หน่วยงานที่จัด :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_ORGANIZER_NAME }}</h1>
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
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> LOCATION_NAME }}</h1>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label>ระหว่างวันที่ :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforrecordindex-> DATE_GO) }} ถึง {{ DateThai($inforrecordindex-> DATE_BACK) }}</h1>
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
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_COMMENT }}</h1>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label >ลักษณะ :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_GO_NAME }}</h1>
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
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> RECORD_VEHICLE_NAME }}</h1>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label>การเบิกเงิน :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> WITHDRAW_NAME }}</h1>
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
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> LEADER_HR_NAME }}</h1>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label >มอบหมายงานให้ :</label>
                        </div>
                    </div>
                    <div class="col-sm-3 text-left">
                        <div class="form-group">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex-> OFFER_WORK_HR_NAME }}</h1>
                        </div>
                    </div>
                    </div>
             <br>
                        
        <form  method="post" action="{{ route('perdev.persondevaccept_update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name='ID' id='ID' value="{{$inforrecordindex->ID}}">
        <input type="hidden" name='iduser' id='iduser' value="{{$inforpersonuserid->ID}}">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="form-check-input" id="RECORD_EXPERT_RESULT" name="RECORD_EXPERT_RESULT" value="can"  <?php if($inforrecordindex->RECORD_EXPERT_RESULT=='can'){echo 'checked';} ?>>&nbsp;&nbsp;ยินดีเป็นวิทยากรตามวันเวลา และสถานที่ ที่กำหนดไว้<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="form-check-input" id="RECORD_EXPERT_RESULT" name="RECORD_EXPERT_RESULT" value="cannot"  <?php if($inforrecordindex->RECORD_EXPERT_RESULT=='cannot'){echo 'checked';} ?>>&nbsp;&nbsp;ไม่สามารถไปเป็นวิทยากรตามวันเวลา และสถานที่ ที่กำหนดไว้<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="form-check-input" id="RECORD_EXPERT_RESULT" name="RECORD_EXPERT_RESULT" value="other"  <?php if($inforrecordindex->RECORD_EXPERT_RESULT=='other'){echo 'checked';} ?>>&nbsp;&nbsp;อื่นๆ<br>

        <br>
        หมายเหตุ ::
        <textarea id="RECORD_EXPERT_REMARK" name="RECORD_EXPERT_REMARK" class="form-control input-sm" rows="4" cols="50" >{{$inforrecordindex->RECORD_EXPERT_REMARK}}
        </textarea>
        
        


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid->ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<script>
  

   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});



  
</script>



@endsection