@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
        padding-right:10px;
        }

    .text-font {
    font-size: 13px;
        }
    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
            }
</style>
<style>
       
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
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
<?php
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');    
?>   

           
                    <!-- Advanced Tables -->
                <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                    <div>
                                        <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                            
                                            <span class="nav-main-link-name">Dashboard</span>
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >ความเสี่ยง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refteam/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงทีม</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refdep/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงกลุ่มงาน</a>
                                </div>
                                <div>&nbsp;</div>

                                <div>
                                <a href="{{ url('general_risk/risk_refdepsub/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงฝ่าย</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refdepsubsub/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงหน่วยงาน</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refperson/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงบุคคล</a>
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
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดรายงานอุบัติการณ์ความเสี่ยง</B></h3>
                           
                        </div>
                        <div class="block-content block-content-full">
                    
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">รหัสความเสี่ยง :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->RISKREP_CODE}}
                                </div>
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">สถานะความเสี่ยง :</label>
                                </div>
                                <div class="col-md-2">
                                        @if ($rigreps->RISKREP_STATUS == 'CONFIRM')
                                                <button class="btn btn-sm btn-warning" style=" font-family: 'Kanit', sans-serif;font-size:12px;color:#F0FFFF;"> รอยืนยัน </button>
                                        @elseif ($rigreps->RISKREP_STATUS == 'REPEAT')   
                                                <button class="btn btn-sm btn-info" style=" font-family: 'Kanit', sans-serif;font-size:12px;color:#F0FFFF;"> รอตอบรับ </button>                             
                                        @elseif ($rigreps->RISKREP_STATUS == 'SUCCESS')
                                        <button class="btn btn-sm btn-success" style=" font-family: 'Kanit', sans-serif;font-size:12px;color:#F0FFFF;"> เรียบร้อย </button>
                                        @else
                                        @endif
                                </div>

                                <div class="col-md-1">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">วันที่ :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{DateThai($rigreps->RISKREP_DATESAVE)}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">หน่วยงานที่รายงาน :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->HR_DEPARTMENT_SUB_SUB_NAME}}
                                </div>
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">ประเภทสถานที่ :</label>
                                </div>
                                <div class="col-md-3" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->SETUP_TYPELOCATION_NAME}}
                                </div>
                                <div class="col-md-1">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">ชนิดสถานที่:</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->SETUP_GROUPLOCATION_NAME}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">อุบัติการณ์ความเสี่ยงเรื่อง :</label>
                                </div>
                                <div class="col-md-10" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->INCIDENCE_SETTING_NAME}}
                                </div>                               
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">อุบัติการณ์ความเสี่ยงย่อย :</label>
                                </div>
                                <div class="col-md-10" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->INCIDENCE_SUB_NAME}}
                                </div>                               
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">สรุปประเด็นปัญหา :</label>
                                </div>
                                <div class="col-md-10" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->RISKREP_INFER}}
                                </div>                               
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">ระดับความรุนแรง :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->RISKREP_LEVEL}}
                                </div>                               
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">ผู้ที่ได้รับผลกระทบ :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->RISKREP_USEREFFECT_FULLNAME}}
                                </div>
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">เพศ :</label>
                                </div>
                                <div class="col-md-3" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->SEX_NAME}}
                                </div>
                                <div class="col-md-1">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">อายุ:</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->RISKREP_AGE}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">วันที่เกิดอุบัติการณ์ความเสี่ยง</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{DateThai($rigreps->RISKREP_STARTDATE)}}
                                </div>
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">วันที่ค้นพบ :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{DateThai($rigreps->RISKREP_DIGDATE)}}
                                </div>
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">แหล่งที่มา/วิธีการค้นพบ :</label>
                                </div>
                                <div class="col-md-2" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {{$rigreps->INCIDENCE_LOCATION_NAME}}
                                </div>                               
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">รายละเอียดการเกิดเหตุ</label>
                                </div>
                                <div class="col-md-10" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {!!$rigreps->RISKREP_DETAILRISK!!}
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" style=" font-family: 'Kanit', sans-serif;font-size:14px;">การจัดการเบื้องต้น</label>
                                </div>
                                <div class="col-md-10" style=" font-family: 'Kanit', sans-serif;font-size:14px;">
                                    {!!$rigreps->RISKREP_BASICMANAGE!!}
                                </div> 
                            </div>

                            <hr>
                            <div class="block-footer">
                                <div align="right">
                                   
                                        
                                    {{-- @if($rigreps->RISKREP_STATUS != 'REPEAT') --}}
                                        <a href="{{ url('general_risk/risk_notify_repeat_sub_u/'.$rigreps->RISKREP_ID.'/'.$inforpersonuserid -> ID) }}" class="btn btn-success btn-lg" > &nbsp; ทบทวน &nbsp;</a>
                                    {{-- @endif
                                    @if($rigreps->RISKREP_STATUS == 'REPEAT') --}}
                                        <a href="{{ url('general_risk/risk_notify_accept_sub_u/'.$rigreps->RISKREP_ID.'/'.$inforpersonuserid -> ID) }}" class="btn btn-hero-sm btn-hero-info" > &nbsp; ตอบรับ &nbsp;</a>
                                    {{-- @endif --}}
                                        <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID) }}" class="btn btn-hero-sm btn-hero-danger" > &nbsp; ปิด  &nbsp;</a>
                               
                                    </div>                    
                            </div>
                            <hr>
                            



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
             }        
     });

     
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection