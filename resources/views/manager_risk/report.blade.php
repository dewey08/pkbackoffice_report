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
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายงานควบคุมภายในและความเสี่ยง</h2>   
               
                </div>
            <div class="block-content block-content-full">
                       
            <hr>
               <div class="card-body shadow lg"> 
               
                        <div class="row">
                            <div class="col-md-6 text-left">
                
                                <a href="{{url('manager_risk/report_riskincedentsprofile')}}"  class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;">รายงานการบริหารจัดการความเสี่ยงขององค์กร/หน่วยงาน(Risk Incidents Profile)</a><br><br>
                                <a href="{{url('manager_risk/report_riskincidencelevel')}}" class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานการเกิด/แก้ไขอุบัติการณ์ความเสี่ยงแยกตามระดับความรุนแรง</a><br><br>
                                <a href="{{url('manager_risk/report_riskdepartment')}}" class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;" ><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานอันดับการเกิดอุบัติการณ์ความเสี่ยงขององค์กร</a><br><br>
                                <a href="{{url('manager_risk/report_riskdepartment_subsub')}}" class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;" ><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานหน่วยงานที่มีการรายงานอุบัติการณ์ความเสี่ยง</a><br><br>


                                <a href="#"  class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานอันดับการเกิดอุบัติการณ์ความเสี่ยงของกลุ่ม/หน่วยงาน</a><br><br>
                                <a href="#"  class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานอุบัติการณ์ความเสี่ยงที่ได้รับการแก้ไขแล้ว</a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานเหตุการณ์ที่ถูกยืนยันว่าไม่ใช่อุบัติการณ์ความเสี่ยง</a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานระบบที่มีการปรับปรุง/พัฒนา</a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานกลุ่ม/หน่วยงานที่แก้ไขอุบัติการณ์ความเสี่ยง </a><br><br>
                            
                                <a href="{{url('manager_risk/report_riskNRLS')}}"  class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;">รายงาน EXPORT NRLS </a><br><br>
                            </div>
                            <div class="col-md-6 text-left">
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>รายงานประเภท/ชนิด/สถานที่เกิดอุบัติการณ์ความเสี่ยง  </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> แหล่งที่มา/วิธีการค้นพบอุบัติการณ์ความเสี่ยง </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานช่วงเวลา/เวร ที่เกิดอุบัติการณ์ความเสี่ยง </a><br><br>
                                <a href="{{url('manager_risk/report_riskdepartment_self_subsub')}}" class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานหน่วยงานที่รายงานอุบัติการณ์ความเสี่ยงของตนเอง </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานความเสี่ยงย่อยที่เกิดอุบัติการณ์ความเสี่ยง </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i>  รายงานจำนวนข้อมูล Data set ที่มีการบันทึกแบบรายวันขององค์กร/หน่วยงาน</a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานจำนวนข้อมูล Data set ที่มีการบันทึกแบบรายเดือนขององค์กร/หน่วยงาน </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> รายงานจำนวนข้อมูล Data set รายปีขององค์กร/หน่วยงาน </a><br><br>
                                <a href="#" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;width: 100%;text-align: left;"><i class="nav-main-link-icon fa fa-bar-chart"></i> วิธีการ/แนวทางการแก้ไขความเสี่ยงเชิงระบบองค์กร </a><br><br>
                            </div>
                        </div>                        
                    </div>
                    <hr style="color:#F80434 ">
                </div>
        </div>
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