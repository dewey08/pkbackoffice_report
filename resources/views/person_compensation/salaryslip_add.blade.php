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
<?php 
    $datenow = date('Y-m-d');
?>  

<body onload="run01();">
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_compensation/dashboard/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                            
                                           ข้อมูลเงินเดือน
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอใบรับรอง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn btn-info" >
                                <span class="nav-main-link-name">สลิปเงินเดือน</span>
                                </a>
                                </div>
                                <div>&nbsp;</div>  <div>
                                <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                ยืม-คืน
                                </a>
                                </div>
                                <div>&nbsp;</div>




                             

                                </div>
                                </ol>
                            </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ขอสลิปเงินเดือน</h2> 
                <form  method="post" action="{{ route('compensation.infosalaryslip_save') }}" enctype="multipart/form-data"> 
                @csrf
                <div class="row push">
                <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-2">        
                        <input name="SLIP_NUMBER" id="SLIP_NUMBER" class="form-control input-sm" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{$refnumber}}">
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ลงวันที่ต้องการ :</label>
                    </div> 
                    <div class="col-lg-2">        
                        <input name="SLIP_DATE" id="SLIP_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($datenow)}}" readonly>
                    </div>
                   
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                        <input type="hidden" value=" {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}" name="SLIP_MY_HR_PERSON_NAME" id="SLIP_MY_HR_PERSON_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                        <input type="hidden" value=" {{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}" name="SLIP_POSITION_IN_WORK" id="SLIP_POSITION_IN_WORK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                        {{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ประเภทบุคลากร :</label>
                    </div> 
                    <div class="col-sm-2">
                        {{ $inforpersonuser -> HR_LEVEL_NAME }}
                        <input type="hidden"  value="{{ $inforpersonuser -> HR_LEVEL_NAME }}" name="SLIP_HR_LEVEL_NAME" id="SLIP_HR_LEVEL_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div> 

                </div>

                <div class="row push">
                    <div class="col-sm-2">
                            <label>ตั้งแต่เดือน :</label>
                    </div> 
                    <div class="col-lg-2">        
                      
                    
                     <select name="SLIP_MONTH" id="SLIP_MONTH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                
                                    <option value="1">มกราคม</option>
                                    <option value="2">กุมภาพันธ์</option>
                                    <option value="3">มีนาคม</option>
                                    <option value="4">เมษายน</option>
                                    <option value="5">พฤษภาคม</option>
                                    <option value="6">มิถุนายน</option>
                                    <option value="7">กรกฎาคม</option>
                                    <option value="8">สิงหาคม</option>
                                    <option value="9">กันยายน</option>
                                    <option value="10">ตุลาคม</option>
                                    <option value="11">พฤศจิกายน</option>
                                    <option value="12">ธันวาคม</option>
                                              
                        </select>
                    
                    
                    </div>  
                    <div class="col-sm-2 text-right">
                            <label>ปีงบประมาณ :</label>
                    </div> 
                    <div class="col-lg-2">        
                    <select name="SLIP_YEAR" id="SLIP_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                    </div>  
                              
                </div>

                <div class="row push">
                   
                    <div class="col-sm-2 ">
                        <label>ต้องการย้อนหลัง :</label>
                    </div> 
                    <div class="col-sm-2">
                        <input name="SLIP_MOUNT" id="SLIP_MOUNT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)">
                    </div>
                    <div class="col-sm-1">
                        <label for="">เดือน</label>
                    </div> 
                    <div class="col-sm-7">
                       
                    </div> 
                </div>
       

                <div class="row push">
                    <div class="col-sm-2">
                            <label>เพื่อใช้ในการ :</label>
                    </div>
                    <div class="col-sm-10">
                        <input name="SLIP_COMMENT" id="SLIP_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                    <input type="hidden" name="SLIP_HR_PERSON_ID" id="SLIP_HR_PERSON_ID" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{$inforperson -> ID}}">
                    <input type="hidden" name="SLIP_HR_PERSON_NAME" id="SLIP_HR_PERSON_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">                       
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-2">       
                    {{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}
                    <input type="hidden" name="SLIP_HR_DEP_SUB_SUB_NAME" id="SLIP_HR_DEP_SUB_SUB_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}">                       
                    </div>  

                    <div class="col-sm-2 text-right">
                            <label>เบอร์โทร :</label>
                    </div> 
                    <div class="col-lg-2">  
                    {{ $inforpersonuser -> HR_PHONE }}
                        <input type="hidden" value=" {{ $inforpersonuser -> HR_PHONE }}" name="SLIP_TEL" id="SLIP_TEL" class="form-control input-sm"  style=" font-family: 'Kanit', sans-serif;" >
                    </div>              
                </div>

            <br> 
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('person_compensation/salaryslip/'.$inforperson -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

</script>
<script> 
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

function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
    ele.onKeyPress=vchar;
    }
 
</script>

@endsection