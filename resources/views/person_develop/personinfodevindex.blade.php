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

.text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }

                  table, th, td {
    border: 1px solid #A9A9A9;
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



use App\Http\Controllers\PerdevController;
$checkapp = PerdevController::checkapp($user_id);
$checkver = PerdevController::checkver($user_id);

$countapp = PerdevController::countapp($user_id);
$countver = PerdevController::countver($user_id);





$m_budget = date("m");
        if($m_budget>9){
        $yearb = date("Y")+1;
        }else{
        $yearb = date("Y");
        }
        $yearbudget = date("Y");
          //echo  $yearbudget;

?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div class="row">
                        <div>
                            <a href="{{ url('person_dev/persondevindex/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-warning loadscreen">

                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_dev/personmeetinginside/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ประชุมภายใน</a>
                        </div>
                        <div>&nbsp;</div>

                        <div>
                            <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ประชุมอบรมภายนอก</a>
                        </div>
                        <div>&nbsp;</div>


                        @if($checkver != 0)
                        <div>
                            <a href="{{ url('person_dev/persondevver/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                @if($countver!=0)
                                <span class="badge badge-light">{{$countver}}</span>
                                @endif
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif

                        @if($checkapp!=0)
                        <div>
                            <a href="{{ url('person_dev/persondevapp/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ
                                @if($countapp!=0)
                                <span class="badge badge-light">{{$countapp}}</span>
                                @endif
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif

                    </div>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 10px;">
    <div class="block-content">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <!-- block-link-pop สำหรับเนื้อหาที่มีเพิ่มเติม "Block เด้งขึ้นมา" -->
                <div class="block block-rounded bg-success" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-taxi text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                                {{ $countout}} ครั้ง
                            </p>
                            <p class="text-white mb-0">
                                อบรมภายนอก
                            </p>
                        </div>
                    </div>
            </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded bg-info" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-hospital text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                                {{$countinsides}} ครั้ง
                            </p>
                            <p class="text-white mb-0">
                                อบรมภายใน
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded bg-warning" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-user-tie text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                                {{$counttype}} ครั้ง
                            </p>
                            <p class="text-white mb-0">
                                วิทยากร
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
  <div class="block-content">
    <h3 class="block-title fs-18 fw-b">สรุปข้อมูลการอบรมประจำปีงบประมาณ {{$yearb+543}}</h3>
    <div class="table-responsive my-3">
        <table class="table-striped table-vcenter" style="width:100%;">
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <th style="width: 5%;" class="text-center text-font">ลำดับ</th>
                    <th style="width: 16%;" class="text-center text-font">ประเภทการอบรม</th>
                    <th style="width: 6%;" class="text-center text-font">ต.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">พ.ย.</th>
                    <th style="width: 6%;" class="text-center text-font">ธ.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">ม.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">ก.พ.</th>
                    <th style="width: 6%;" class="text-center text-font">มี.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">เม.ย.</th>
                    <th style="width: 6%;" class="text-center text-font">พ.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">มิ.ย.</th>
                    <th style="width: 6%;" class="text-center text-font">ก.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">ส.ค.</th>
                    <th style="width: 6%;" class="text-center text-font">ก.ย.</th>

                    <th style="width: 7%" class="text-center text-font bg-sl2-y4">รวม</th>

                </tr>
            </thead>
            <tbody>
                <tr height="20">
                    <td align="center">1</td>
                    <td class="text-font text-pedding">ประชุมทั่วไป/ติดตามงาน/รับนโยบาย อื่นๆ</td>

                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,1,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,1,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,1,$id_user))}}
                            </td>
                </tr>

                <tr height="20">
                    <td align="center">2</td>
                    <td class="text-font text-pedding">ประชุมวิชาการ/สัมมนา/ฝีกอบรม</td>
                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,2,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,2,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,2,$id_user))}}
                            </td>


                </tr>

                <tr height="20">
                    <td align="center">3</td>
                    <td class="text-font text-pedding">เป็นวิทยากร</td>
                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,3,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,3,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,3,$id_user))}}
                            </td>


                </tr>

                <tr height="20">
                    <td align="center">4</td>
                    <td class="text-font text-pedding">นำเสนอผลงาน/จัดนิทรรศการ</td>
                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,4,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,4,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,4,$id_user))}}
                            </td>


                </tr>

                <tr height="20">
                    <td align="center">5</td>
                    <td class="text-font text-pedding">ศึกษาดูงาน</td>
                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,5,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,5,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,5,$id_user))}}
                            </td>
                </tr>



                <tr height="20">
                    <td align="center">6</td>
                    <td class="text-font text-pedding">อื่นๆ</td>
                    @for ($i = 10; $i <= 12; $i++) <td class="text-font" align="center">
                        {{  number_format(PerdevController::countgrecordmonth($yearbudget,6,$i,$id_user)) }}
                        </td>
                        @endfor

                        @for ($i = 1; $i <= 9; $i++) <td class="text-font" align="center">
                            {{  number_format(PerdevController::countgrecordmonth($yearbudget,6,$i,$id_user)) }}
                            </td>
                            @endfor

                            <td class="text-font bg-sl2-y1" align="center">
                                {{ number_format(PerdevController:: sumcountgrecordmonth($yearbudget,6,$id_user))}}
                            </td>
                </tr>
            </tbody>
        </table>
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
   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });



    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
