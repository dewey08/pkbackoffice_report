@extends('layouts.leave')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<style>
        .center {
        margin: auto;
        width: 100%;
        padding: 10px;
        }
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
            }

        label{
                    font-family: 'Kanit', sans-serif;
                    font-size: 10px;
                    font-size: 1.0rem;
            }  
            p{
                    font-family: 'Kanit', sans-serif;
                    font-size: 10px;
                    font-size: 1.0rem;
            } 

            @media only screen and (min-width: 1200px) {
        label {
            float:right;
        }

            }

            

</style>


@section('content')
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

                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default ">
                                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยกเลิกข้อมูลการลา</B></h3>
                    </div>
                <div class="block-content">
            <form  method="post" action="{{ route('leave.updatecancel') }}" enctype="multipart/form-data">
                @csrf                      
                    <input type="hidden"  name="ID" value="{{ $inforleave -> ID }}"/>                            
                    <div class="row">  
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >ปีงบประมาณ :</label>
                            </div>                               
                        </div> 
                        <div class="col-sm-3 text-left">
                            <div class="form-group" >
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_YEAR_ID }}</h1>
                            </div>                               
                        </div>       
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >ชื่อผู้ลา  :</label>
                            </div>                               
                        </div>  
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_PERSON_FULLNAME }}</h1>
                            </div>                               
                        </div> 
                        </div>
                        <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >เหตุผลการลา :</label>
                            </div>                               
                        </div>  
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_BECAUSE }}</h1>
                            </div>                               
                        </div>    
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >สถานที่ไป :</label>
                            </div>                               
                        </div>  
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND }} </h1>
                            </div>                               
                        </div>
                        </div>       
                        <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>มอบหมายงาน :</label>
                            </div>                               
                        </div>  
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND}}</h1>
                            </div>                               
                        </div>  
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label>ลาเต็มวัน/ครึ่งวัน :</label>
                            </div>                               
                        </div>  
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                            @if($inforleave -> DAY_TYPE_ID == 3)
           ครึ่งวัน(บ่าย)
           @elseif($inforleave -> DAY_TYPE_ID == 2)
           ครึ่งวัน(เช้า)
           @else
           เติมวัน
           @endif   
                            </h1>
                            </div>                               
                        </div>    
                        </div>
                        <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >วันเริ่มลา :</label>
                            </div>                               
                        </div>
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}</h1>
                            </div>                               
                        </div> 
                        <div class="col-sm-2">
                            <div class="form-group">
                            <label >สิ้นสุดวันลา :</label>
                            </div>                               
                        </div>
                        <div class="col-sm-3 text-left">
                            <div class="form-group">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_END) }}</h1>
                            </div>                               
                        </div>   
                    
                        </div>
         
                            <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label > เบอร์ติดต่อ :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT_PHONE }}</h1>
                                </div>                               
                            </div> 
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label > ระหว่างลาติดต่อ :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT }}</h1>
                                </div>                               
                            </div> 
    
                            </div>
    
                            <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label >รวมวันลา :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_ALL,1) }} วัน</h1>
                                </div>                               
                            </div> 
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label >วันทำการ :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> WORK_DO,1) }} วัน</h1>
                                </div>                               
                            </div>   
                        
                            </div>
    
                            <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label >วันหยุดเสาร์ - อาทิตย์ :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_SETSUN,1) }} วัน</h1>
                                </div>                               
                            </div> 
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label >วันหยุดนักขัตฤกษ์ :</label>
                                </div>                               
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY,1) }} วัน</h1>
                                </div>                               
                            </div>                       
                    </div>  
                    <input type="hidden" name = "LEAVE_STATUS_CODE"  id="LEAVE_STATUS_CODE" value="Cancel">
                        <label style="float:left;">เหตุผลการยกเลิก</label>
                            <textarea   name = "COMMENT"  id="COMMENT" class="form-control input-lg" style="font-family: 'Kanit', sans-serif;" required>{{$inforleave->LEAVE_CANCEL_COMMENT}}</textarea>
                <div class="modal-footer">
                    <div align="right">
                        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-save mr-2"></i>ยืนยันยกเลิกการลา</button>
                    
                        <a href="{{ url('manager_leave/personleaveinfocheckver') }}" class="btn btn-hero-sm btn-hero-secondary" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a>
                
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