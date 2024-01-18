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
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">แจ้งยกเลิกรายงานความเสี่ยง</h2>   
                <div align="right">
                   
                    <a class="btn btn-hero-sm btn-hero-success" href="{{ route('mrisk.detail')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a> 
                    </div>
                </div> 
            <div class="block-content block-content-full " align="left">


<form  method="post" action="{{ route('mrisk.detail_updatecancel') }}" enctype="multipart/form-data">
@csrf

<input value="{{$rigreps->RISKREP_ID}}" type="hidden" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg"  >                                                               
<div class="row push">
    <div class="col-sm-2">
    <label>Risk No :</label>
    </div> 
    <div class="col-lg-2 ">
        {{$rigreps->RISKREP_NO}}
       
    </div> 
    <div class="col-sm-1">
        <label>วันที่บันทึก :</label>
        </div> 
        <div class="col-lg-2 ">
            {{formate($rigreps->RISKREP_DATESAVE)}} 
           
        </div> 
    <div class="col-sm-1">
    <label>ชนิดสถานที่:</label>
    </div> 
    <div class="col-lg-3 ">
        {{ $rigreps-> ORIGIN_DEPART_CODE}} :: {{ $rigreps-> ORIGIN_DEPART_NAME}}
             
    </div> 
    </div>

<div class="row push">
<div class="col-sm-2">
<label>หน่วยงานที่รายงาน :</label>
</div> 
<div class="col-lg-2 "> 
    {{ $rigreps-> HR_DEPARTMENT_SUB_SUB_NAME}}

</div> 
<div class="col-sm-1">
    <label>สถานที่เกิดเหตุ :</label>
    </div> 
    <div class="col-lg-2 "> 
        {{ $rigreps-> SETUP_TYPELOCATION_NAME}}
    
    </div> 
<div class="col-sm-1">
<label>ชนิดสถานที่ :</label>
</div> 
<div class="col-lg-3 "> 
    {{ $rigreps-> ORIGIN_DEPART_NAME}}       

</div> 
</div> 


<div class="row push">
<div class="col-sm-2">
<label>ความเสี่ยงในเรื่อง :</label>
</div> 
<div class="col-lg-10 ">
    {{ $rigreps-> INCIDENCE_SETTING_NAME}}

</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>การจัดการเบื้องต้น :</label>
</div> 
<div class="col-lg-10 ">
    {{ $rigreps-> RISKREP_BASICMANAGE}}
</div> 
</div>


<div class="row push">
<div class="col-sm-2">
<label>ผู้ที่ได้รับผลกระทบ :</label>
</div> 
<div class="col-lg-5 ">
 {{ $rigreps-> HR_FNAME}}&nbsp;&nbsp; {{ $rigreps-> HR_LNAME}}
</div> 
<div class="col-sm-1">
<label>เพศ :</label>
</div> 
<div class="col-lg-1 ">
    {{ $rigreps-> SEX_NAME}}

</div> 
<div class="col-sm-1">
   <label>อายุ :</label>
</div> 
<div class="col-lg-2 ">
    {{$rigreps-> RISKREP_AGE}}
</div> 

</div>
<div class="row push">
<div class="col-sm-2">
<label>วันที่เกิดอุบัติการณ์ความเสี่ยง:</label>
</div> 
<div class="col-lg-4 ">
    {{formate($rigreps-> RISKREP_STARTDATE)}}
</div> 
<div class="col-sm-2">
<label>วันที่ค้นพบ:</label>
</div> 
<div class="col-lg-4 ">
    {{formate($rigreps-> RISKREP_DIGDATE)}}
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>ช่วงเวลา(เวร):</label>
</div> 
<div class="col-lg-4 ">
    {{$rigreps-> WORKING_TIME_NAME}}

</div> 
<div class="col-sm-2">
<label>หรือเวลา:</label>
</div> 
<div class="col-lg-4 ">
    {{formatetime($rigreps-> RISKREP_TIME)}}
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>แหล่งที่มา/วิธีการค้นพบ :</label>
</div> 
<div class="col-lg-10 ">
    {{$rigreps->INCIDENCE_LOCATION_NAME}}

</div>

</div>

<div class="row push">
    <div class="col-sm-2">
        <label>รายละเอียดการเกิดเหตุ :</label>
    </div> 
    <div class="col-lg-10 ">
        {{ $rigreps-> RISKREP_DETAILRISK}}
    </div>
</div>


<div class="row push">
<div class="col-sm-2">
<label>การจัดการเบื้องต้น :</label>
</div> 
<div class="col-lg-10 ">
    {{ $rigreps-> RISKREP_BASICMANAGE}}

</div>
</div>


<div class="modal-footer">
    <div align="right">
    <button type="submit" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-save mr-2"></i>แจ้งยกเลิก</button>
    <a href="{{ url('manager_risk/detail')  }}" class="btn btn-hero-sm btn-hero-secondary" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>Close</a>
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