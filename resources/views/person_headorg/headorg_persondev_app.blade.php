@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
<?php

  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
            }

            .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
                  .form-control {
    font-size: 13px;
                  }   
      
                  table, td, th {
            border: 1px solid black;
            }  
      
       
</style>

<br>
<br>
<center>

<!-----------------------------------------ตรวจสอบ----------------------------------->

<div >
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">


          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">

          อนุมัติข้อมูล ประชุม/อบรม/ดูงาน เลขที่ {{ $inforrecordindex -> ID }}

          </h2>
        </div>
        <div class="modal-body">


        <form  method="post" action="{{ route('horg.updateinfodevapp') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforrecordindex -> ID }}"/>

        <div class="row">

        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวข้อประชุม :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_HEAD_USE }}</h1>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
            <label >สถานที่จัดประชุม :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_ORG_NAME }}</h1>
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
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_LEVEL_NAME}}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >หน่วยงานที่จัด :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_ORGANIZER_NAME }}</h1>
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
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label>ระหว่างวันที่ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforrecordindex -> DATE_GO) }} ถึง {{ DateThai($inforrecordindex -> DATE_BACK) }}</h1>
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
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_COMMENT }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >ลักษณะ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_GO_NAME }}</h1>
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
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_VEHICLE_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label>การเบิกเงิน :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> WITHDRAW_NAME }}</h1>
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
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LEADER_HR_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >มอบหมายงานให้ :</label>
            </div>
        </div>

        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> OFFER_WORK_HR_NAME }}</h1>
            </div>
        </div>
        </div>





     
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "APPROVE_COMMENT"  id="APPROVE_COMMENT" class="form-control input-lg" ></textarea>
        <br>
      <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  style="font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
        <button type="submit"  name = "SUBMIT" style="font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" class="btn btn-danger btn-lg" value="not_approved" >ไม่อนุมัติ</button>
        <a href="{{ url('person_headorg/infodevapp')}}"  class="btn btn-hero-sm btn-secondary" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ปิดหน้าต่าง</a>

        </div>
        </div>
        </form>
</body>




@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


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




    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
