@extends('layouts.personcheck')

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
            @media only screen and (min-width: 1200px) {
        label {
            float:right;
        }


    .text-pedding{
    padding-left:10px;
                        }

            .text-font {
        font-size: 13px;
                    }
        }

        .form-control{
        font-size: 13px;
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
    function Datetime($time_a,$time_b)
{
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
   
    return $time_diff_h." ชม. ".$time_diff_m." น. ";
  
    }

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');


use App\Http\Controllers\ManagercheckinController;
    use Illuminate\Support\Facades\DB;
    use App\Checkin;
?>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">

                          <!-- Dynamic Table Simple -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลการลงเวลา {{$infotime->HR_FNAME}} {{$infotime->HR_LNAME}}</B></h3>
                   
            </div>
                       <div class="block-content block-content-full">
                            <form id="form_edit" action="{{route('mcheckin.inforpersoncheck_new_update')}}"  method="post">
                                @csrf

                                <input type="hidden" name="idref" id="idref" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infotime->CHECKIN_ID}}">

                                <div class="row push">

                                <div class="col-sm-2">
                                    <label>วันที่ :</label>
                                    </div> 
                                    <div class="col-lg-2">
                                        <input name="CHEACKIN_DATE" id="CHEACKIN_DATE" class="form-control input-lg datepicker {{ $errors->has('CHEACKIN_DATE') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($infotime->CHEACKIN_DATE)}}"  readonly>
                                    </div> 
                                    <div class="col-sm-1">
                                         <label>เวลาบันทึก :</label>
                                    </div> 
                                    <div class="col-lg-1">
                                        <input name="CHEACKIN_TIME" id="CHEACKIN_TIME" class="js-masked-time form-control {{ $errors->has('CHEACKIN_TIME') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infotime->CHEACKIN_TIME}}">
                                    </div>


                                </div>

                                <div class="row push">
                             <div class="col-sm-2">
                            <label >ประเภทการลงเวลา:</label>
                            </div>
                            <div class="col-sm-2">

                            <select name="CHECKIN_TYPE_ID" id="CHECKIN_TYPE_ID" class="form-control input-lg {{ $errors->has('CHECKIN_TYPE_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
                           
                            @foreach ($checkintypes as $checkintype)   
                                @if($checkintype -> CHECKIN_TYPE_ID == $infotime->CHECKIN_TYPE_ID)                 
                                <option value="{{ $checkintype -> CHECKIN_TYPE_ID }}" selected>{{ $checkintype -> CHECKIN_TYPE_NAME }}</option>           
                                @else
                                <option value="{{ $checkintype -> CHECKIN_TYPE_ID }}">{{ $checkintype -> CHECKIN_TYPE_NAME }}</option>           
                              
                                @endif
                            @endforeach 
                            </select>    
                            </div>
                            <div class="col-sm-1">
                            <label for="comment">ชื่อเวร:</label>
                            </div>
                            <div class="col-sm-3">                           
                                <select name="OPERATE_JOB_ID" id="OPERATE_JOB_ID" class="form-control input-lg {{ $errors->has('OPERATE_JOB_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" required>
                                   
                                      @foreach ($operatejobs as $operatejob)   
                                          @if($operatejob -> OPERATE_JOB_ID == $infotime->OPERATE_JOB_ID)
                                          <option value="{{ $operatejob -> OPERATE_JOB_ID }}" selected>{{ $operatejob -> OPERATE_JOB_NAME }}</option> 
                                          @else
                                          <option value="{{ $operatejob -> OPERATE_JOB_ID }}">{{ $operatejob -> OPERATE_JOB_NAME }}</option>   
                                          @endif
                                      @endforeach 
                              </select>    
                            </div>
    
                            <div class="col-sm-1">
                            <label >หมายเหตุ:</label>
                            </div>
                            <div class="col-sm-3">
                              <input class="form-control" id="CHECKIN_REMARK" name="CHECKIN_REMARK" value="{{$infotime->CHECKIN_REMARK}}" style=" font-family: 'Kanit', sans-serif;">
                            </div>
                            </div>
                            

     
       


        <div class="modal-footer">
        <div align="right">
        <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" style="font-family: 'Kanit', sans-serif;font-weight:normal;"  ><i class="fas fa-save"></i>&nbsp;บันทึกแก้ไขข้อมูล</span>
        <a href="{{ url('manager_checkin/inforpersoncheck_new')  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close"></i>&nbsp;ยกเลิก</a>
    </form>
    </div>

       
        </div>



                              
                           
                      
               

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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
                autoclose: true                         //Set เป็นปี พ.ศ.
            }) //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


$('.btn-submit-edit').click(function (e) { 

var form = $('#form_edit');
formSubmit(form)
       
});

</script>

@endsection
