@extends('layouts.risk')   
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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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
<!-- Advanced Tables -->
<br>
<br>
<br>

<center>
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">บันทึกรายงานอุบัติการณ์ความเสี่ยง</h2> 
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('mrisk.incidence_update') }}" enctype="multipart/form-data">
@csrf

<input value="{{$incidences->RISK_INCIDENCE_ID}}" type="hidden" name = "RISK_INCIDENCE_ID"  id="RISK_INCIDENCE_ID" class="form-control input-lg"  >                          

<div class="row push">

<div class="col-sm-2">
<label>หน่วยงานที่รายงาน :</label>
</div> 
<div class="col-lg-10 "> 
<input value="{{$incidences->RISK_INCIDENCE_DEPARTMENT}}" name = "RISK_INCIDENCE_DEPARTMENT"  id="RISK_INCIDENCE_DEPARTMENT" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">             

</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>ประเภทสถานที่ :</label>
</div> 
<div class="col-lg-4 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_DEPARTMENT}}" name="RISK_INCIDENCE_ORIGIN" id="RISK_INCIDENCE_ORIGIN" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 

<div class="col-sm-2">
<label>ชนิดสถานที่ :</label>
</div> 
<div class="col-lg-4 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_TYPEORIGIN}}" name="RISK_INCIDENCE_TYPEORIGIN" id="RISK_INCIDENCE_TYPEORIGIN" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>เป็นอุบัติการณ์ความเสี่ยงในเรื่องได :</label>
</div> 
<div class="col-lg-8 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_TITLE}}" name="RISK_INCIDENCE_TITLE" id="RISK_INCIDENCE_TITLE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 
<div class="col-sm-2">
<button class="btn btn-sm btn-primary">รายละเอียด</button>
</div>
</div>

<div class="row push">
<div class="col-sm-2">
<label>เป็นอุบัติการณ์ความเสี่ยงย่อย :</label>
</div> 
<div class="col-lg-9 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_SUB}}" name="RISK_INCIDENCE_SUB" id="RISK_INCIDENCE_SUB" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 
</div>
<div class="row push">
<div class="col-sm-2">
<label>สรุปประเด็นปัญหา :</label>
</div> 
<div class="col-lg-9 ">
<small>บันทึกตามรูปแบบเพื่อบอกให้ทราบว่า เกิดอะไร อย่างไร(Free text ไม่เกิน 3 บรรทัด)</small>
<textarea name="RISK_INCIDENCE_INFER" id="RISK_INCIDENCE_INFER" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" rows="4">{{$incidences->RISK_INCIDENCE_INFER}}</textarea>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>ระดับความรุนแรง :</label>
</div> 
<div class="col-lg-2 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_LEVEL}}" name="RISK_INCIDENCE_LEVEL" id="RISK_INCIDENCE_LEVEL" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 
<div class="col-sm-2 text-left">
<button class="btn btn-sm btn-primary">รายละเอียด</button>
</div>
</div>

                                                                

<div class="row push">
<div class="col-sm-2">
<label>ผู้ที่ได้รับผลกระทบ :</label>
</div> 
<div class="col-lg-3 ">
<input value="{{$id_user}}" type="text" name = "RISK_INCIDENCE_USER"  id="RISK_INCIDENCE_USER" class="form-control input-lg"  > 

</div> 
<div class="col-sm-1">
<label>เพศ :</label>
</div> 
<div class="col-lg-1 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_SEX}}" name="RISK_INCIDENCE_SEX" id="RISK_INCIDENCE_SEX" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div> 
<div class="col-sm-0.5">
<label>อายุ :</label>
</div> 
<div class="col-lg-1 ">
<input value="{{$incidences->RISK_INCIDENCE_AGE}}" name="RISK_INCIDENCE_AGE" id="RISK_INCIDENCE_AGE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
</div> 
<div class="col-lg-3 text-left">
ปี&nbsp;&nbsp;&nbsp;&nbsp;<small> (&nbsp;เศษของปีน้อยกว่า 6 เดือนไห้นับเป็น 0 ปี ตั้งแต่ 6 เดือนขึ้นไปไห้นับเป็น 1 ปี&nbsp;)</small>
</div>
</div>
<div class="row push">
<div class="col-sm-2">
<label>วันที่เกิดอุบัติการณ์ความเสี่ยง:</label>
</div> 
<div class="col-lg-4 ">
<input value="{{formate($incidences->RISK_INCIDENCE_BEGET_DATE)}}" name="RISK_INCIDENCE_BEGET_DATE" id="RISK_INCIDENCE_BEGET_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family:'Kanit', sans-serif;" readonly>
</div> 
<div class="col-sm-2">
<label>วันที่ค้นพบ:</label>
</div> 
<div class="col-lg-4 ">
<input value="{{formate($incidences->RISK_INCIDENCE_DIG_DATE)}}" name="RISK_INCIDENCE_DIG_DATE" id="RISK_INCIDENCE_DIG_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family:'Kanit', sans-serif;" readonly>
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>ช่วงเวลาที่เกิดอุบัติการณ์ความเสี่ยง *เวร:</label>
</div> 
<div class="col-lg-4 ">
<input value="{{$incidences->RISK_INCIDENCE_PHASE_FATE}}" name="RISK_INCIDENCE_PHASE_FATE" id="RISK_INCIDENCE_PHASE_FATE" class="form-control input-lg "  style=" font-family:'Kanit', sans-serif;" >
</div> 
<div class="col-sm-2">
<label>หรือเวลา:</label>
</div> 
<div class="col-lg-4 ">
<input name="DONATE_PERSON_EMAIL" id="DONATE_PERSON_EMAIL" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" >
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>แหล่งที่มา/วิธีการค้นพบ :</label>
</div> 
<div class="col-lg-4 ">
<input type="text" value="{{$incidences->RISK_INCIDENCE_LOCATION}}" name="RISK_INCIDENCE_LOCATION" id="RISK_INCIDENCE_LOCATION" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;"> 

</div>
</div>

<div class="row push">
    <div class="col-sm-2">
        <label>รายละเอียดการเกิดเหตุ :</label>
    </div> 
    <div class="col-lg-10 ">
    <textarea name="RISK_INCIDENCE_DETAIL" id="myeditor" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" rows="3">{{$incidences->RISK_INCIDENCE_DETAIL}}</textarea>
    </div>
</div>

<div class="row push">
<div class="col-sm-2">

</div> 
<div class="col-lg-2 ">เอกสารประกอบ
<input type="file" name="picture" id="picture" class="form-control">
</div>
</div> 


<div class="row push">
<div class="col-sm-2">
<label>การจัดการเบื้องต้น :</label>
</div> 
<div class="col-lg-10 ">
<textarea name="RISK_INCIDENCE_BASICMANAGE" id="myeditor2" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" rows="3">{{$incidences->RISK_INCIDENCE_BASICMANAGE}}</textarea>
</div>
</div>



<div class="row push">
<div class="col-sm-2">

</div> 
<div class="col-lg-10 ">เอกสารประกอบ
<input type="file" name="picture" id="picture" class="col-md-3 mb-3 form-control input-sm">
<textarea name="DONATE_PERSON_EMAIL" id="myeditor2" class="form-control input-lg time"  style="color:#FE1219;font-family:'Kanit', sans-serif;" rows="4">
*** หมายถึง ข้อมูลที่บังคับกรอก
*** หมายถึง ข้อมูลตาม Standard Data set & Terminologies ที่ต้องส่งเข้าสู่ระบบ NRLS
[การแนบเอกสารประกอบสามารถแนบได้มากกว่า 1 ไฟล์ในแต่ละหัวข้อ แต่ขนาดของไฟล์รวมทั้งหมดต้องไม่เกิน 10 MB.ในแต่ละขั้นตอนตั้งแต่การรายงาน ยืนยัน แก้ไขระดับหัวหน้า จนถึงการแก้ไขในระดับกรรมการ]
</textarea>
</div>
</div>


</div>






<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-sm btn-info btn-lg" >บันทึกข้อมูล</button>
<a href="{{ url('manager_risk/incidence')  }}" class="btn btn-sm btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
</div>

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
 
  <!-- Page ckeditor -->
 <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

 <script>                                  
        CKEDITOR.replace( 'myeditor' , {           
        });
</script>
<script>                                  
        CKEDITOR.replace( 'myeditor2' , {           
        });
</script>

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
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection