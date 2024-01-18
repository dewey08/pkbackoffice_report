@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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

use App\Http\Controllers\LeaveController;
$checkleader = LeaveController::checkleader($user_id);
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
<body >
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

                <div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                          
                             คำร้องขอบ้านพัก                        

</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
    <form  method="post" action="{{ route('guest.guesthouse_petition_save') }}" enctype="multipart/form-data"> 
        @csrf      
        <div class="row push">
         
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> ข้าพเจ้า :</label>
                    </div> 
            
                    <div class="col-lg-4 ">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                    </div> 
                    <div class="col-lg-2">
                        <label style="text-align: left"> ตำแหน่งงาน :</label>
                    </div> 
            
                    <div class="col-lg-4 ">
                    {{ $inforpersonuser -> POSITION_IN_WORK }} 
                    </div> 
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> ระดับ :</label>
                    </div> 
            
                    <div class="col-lg-4 ">
                    {{ $inforpersonuser -> HR_LEVEL_NAME }}  
                    </div> 
                    <div class="col-lg-2">
                        <label style="text-align: left"> ติดต่อ :</label>
                    </div> 
            
                    <div class="col-lg-4 ">
                    <input name="PETITION_HR_TEL" id="PETITION_HR_TEL" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" maxlength="10" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>
                    </div> 
                </div>
                <br>
              

                    <div class="row">
                    <div class="col-lg-2">
                            <label style="text-align: left"> ประเภทคำร้อง :</label>
                        </div> 
                        <div class="col-lg-4 ">

                        <select name="PETITION_TYPE" id="PETITION_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" required>
                                <option value="" >--กรุณาประเภท --</option>
                              
                                <option value="1" >ขอเข้าพัก</option>
                                <option value="2" >ขอเปลี่ยนแปลง</option>
                                <option value="3" >ขอย้ายออก</option>
                             
                                </select>
                      
                        </div>
                        <div class="col-lg-2">
                            <label style="text-align: left"> ปัจจุบันอาศัยอยู่ที่ :</label>
                        </div> 
                    <div class="col-lg-4 ">
                        <input name="PETITION_ADD" id="PETITION_ADD" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>
                    </div>                    
                </div> 
                <br>
                <div class="row">
                        <div class="col-lg-2">
                            <label style="text-align: left"> หมายเหตุ :</label>
                        </div> 
                        <div class="col-lg-10 ">
                            <input name="PETITION_REMARK" id="PETITION_REMARK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>
                        </div>         
                
                </div> 
                <br>

            </div> 
        </div> 

        <input type="hidden" name="USER_ID" id="USER_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึก</button>
        <a href="{{ url('person_guesthouse/guesthouse_petition/'.$id_user)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i> ยกเลิก</a>
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

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>

@endsection