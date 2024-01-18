@extends('layouts.backend')   
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


  <!-- Advanced Tables -->
  <div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <div class="row">
                    <div>
                        <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                            
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </div>
                <div>&nbsp;</div>
                <div >
               
                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero-info" >รายงานความเสี่ยง</a>
                </div>
                <div>&nbsp;</div>
                <div>
                    <a href="{{ url('general_risk/risk_refteam/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทบทวนความเสี่ยง</a>
                </div>
                <div>&nbsp;</div>
               
          
                </div>
                </ol>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="content">
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แจ้งยกเลิกรายงานความเสี่ยง</h2> 
<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('gen_risk.risk_notify_updatecancel') }}" enctype="multipart/form-data">
@csrf

<input value="{{$id_user}}" type="hidden" name = "USER_ID"  id="USER_ID" class="form-control input-lg"  >                                                                 
       
<input value="{{$rigreps->RISKREP_ID}}" type="hidden" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg"  >  

<div class="row push">
    <div class="col-sm-2">
    <label>Risk No :</label>
    </div> 
    <div class="col-lg-3 ">
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
<div class="col-sm-2">
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
<button type="submit" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>แจ้งยกเลิก</button>
<a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
</div>

</div>

 
  
@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
 
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