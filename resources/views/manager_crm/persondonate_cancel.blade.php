@extends('layouts.crm')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
        }        
        .text-pedding{
    padding-left:10px;
                        }

            .text-font {
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
<!-- Advanced Tables -->
<br>
<br>
<br>

<center>
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ยกเลิกทะเบียนผู้บริจาค</h2> 
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('mcrm.persondonate_savecancel') }}" enctype="multipart/form-data">
@csrf


<div class="row push">
<div class="col-lg-4">
<div class="form-group"> 
 <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>
 </div>
<div class="form-group">                         
        <img src="{{ asset('image/default.jpg')}}" alt="Image" class="img-thumbnail" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>
</div>
<div class="form-group"> *ขนาดรูปไม่เกิน 350 x 350 pixel
        <input type="file" name="picture" id="picture" class="form-control">
</div>                
</div>

<input type="hidden" value="{{ $donateinfopersons->DONATE_PERSON_ID }}" name="DONATE_PERSON_ID" id="DONATE_PERSON_ID" class="form-control input-lg">

<div class="col-sm-8">
<div class="row push">

<div class="col-sm-2">
<label>ชื่อผู้บริจาค :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">              
{{ $donateinfopersons->DONATE_PERSON_NAME }}
</div> 
<div class="col-sm-2">
<label>เบอร์โทร :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_TEL }}
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>อีเมล :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_EMAIL }}
</div> 
<div class="col-sm-2">
<label>ไลน์ :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_LINE }}
</div>
</div>

<div class="row push">
<div class="col-sm-2">
<label>เลขที่เสียภาษี :</label>
</div> 
<div class="col-lg-10" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_VAT_NO }}
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>บ้านเลขที่ :</label>
</div> 
<div class="col-lg-2" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_NO_HOME }}
</div>       
<div class="col-sm-1">
<label>ถนน :</label>
</div> 
<div class="col-lg-2" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_ROAD }}
</div> 
<div class="col-sm-1">
<label>หมู่ :</label>
</div> 
<div class="col-lg-1" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_MOO }}
</div> 
<div class="col-sm-1">
<label>บ้าน :</label>
</div> 
<div class="col-lg-2" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_BAN }}  
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>จังหวัด :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_PROVINCE }} 
</div> 
<div class="col-sm-2">
<label>อำเภอ :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_AMPHER }} 
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>ตำบล :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_TUMBON }} 
</div>
<div class="col-sm-2">
<label>ไปรษณีย์ :</label>
</div> 
<div class="col-lg-4 " style="font-family: 'Kanit', sans-serif; font-size: 13px;font-size: 1.0rem;font-weight:normal;">
{{ $donateinfopersons->DONATE_PERSON_POST }}
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>เจ้าหน้าที่ :</label>
</div> 
<div class="col-lg-10 ">
{{$donateinfopersons->HR_FNAME }} {{$donateinfopersons->HR_LNAME }}
<input value="{{$id_user}}" type="hidden" name = "DONATE_PERSON_USER_ID"  id="DONATE_PERSON_USER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
</div>
</div>



</div> 
</div>
</div>  
<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-hero-sm btn-hero-danger"  onclick="return confirm('ต้องการที่จะยกเลิกทะเบียนผู้บริจาค ?')">ยืนยันการยกเลิกทะเบียนผู้บริจาค</button>
<a href="{{ url('manager_crm/persondonate')  }}" class="btn btn-secondary btn-lg"  >Close</a>
</div>



  
    
  
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


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection