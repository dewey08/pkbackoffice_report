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




use App\Http\Controllers\LeaveController;

$checkapp = LeaveController::checkapp($user_id);
$checkver = LeaveController::checkver($user_id);
$checkallow = LeaveController::checkallow($user_id);

$countapp = LeaveController::countapp($user_id);
$countver = LeaveController::countver($user_id);
$countallow = LeaveController::countallow($user_id);

$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}




$balancerest = LeaveController::balancerest($user_id,$yearbudget);
$countsick = LeaveController::countsick($user_id,$yearbudget);
$countwork = LeaveController::countwork($user_id,$yearbudget);

?>
<?php
  
$color_a = 'background-color: #F0F8FF;';

$displaydate_bigen = '2019-10-01 00:00:00';
$displaydate_end = '2020-09-30 00:00:00';

?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div class="row">
                        <div>
                            <a href="{{ url('person_leave/personleaveindex/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero-warning loadscreen">
                                <span class="nav-main-link-name"><i
                                        class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_leave/personleavecalendar/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-calendar-day mr-2"></i> ปฏิทิน</a>
                        </div>
                        <div>&nbsp;</div>
                  
                        <div>
                            <a href="{{ url('person_leave/personleavetype/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-plus mr-1"></i> เพิ่มข้อมูลการลา</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_leave/personleaveinfo/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-calendar-day mr-2"></i>ข้อมูลการลา</a>
                        </div>
                        <div>&nbsp;</div>
                        @if($checkapp != 0)
                        <div>
                            <a href="{{ url('person_leave/personleaveinfoapp/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-clipboard-check mr-2"></i>เห็นชอบ
                                @if($countapp!=0)
                                <span class="badge badge-light">{{$countapp}}</span>
                                @endif
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif
                        @if($checkver != 0)
                        <div>
                            <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-clipboard-check mr-2"></i>ตรวจสอบ
                                @if($countver!=0)
                                <span class="badge badge-light">{{$countver}}</span>
                                @endif
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif
                        @if($checkallow!=0)
                        <div>
                            <a href="{{ url('person_leave/personleaveinfolastapp/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-clipboard-check mr-2"></i>อนุมัติ
                                @if($countallow!=0)
                                <span class="badge badge-light">{{$countallow}}</span>
                                @endif
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif

                        <div>
                            <a href="{{ url('person_leave/personleaveinfoaccept/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-hero-sm btn-hero loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                    class="fas fa-clipboard-check mr-2"></i>รับมอบงาน
                         
                            </a>
                        </div>
                        <div>&nbsp;</div>

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
                <div class="block block-rounded bg-sl2-yg3" href="javascript:void(0)"> <!--block-link-pop บล็อคเด้งสไตล์-->
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-coffee text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                                <span class="fs-30">{{ number_format($balancerest,1)}}</span> วัน
                            </p>
                            <p class="text-white mb-0">
                                ลาพักผ่อนคงเหลือ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded bg-sl2-r3" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-procedures text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                            <span class="fs-30">{{ number_format($countsick,1)}}</span> วัน
                            </p>
                            <p class="text-white mb-0">
                                ลาป่วยแล้วทั้งสิ้น
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded bg-sl2-b3" href="javascript:void(0)">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div class="item">
                            <i class="fa fa-2x fa fa-mail-bulk text-white"></i>
                        </div>
                        <div class="ml-3 text-right">
                            <p class="text-white font-size-lg font-w600 mb-0">
                            <span class="fs-30">{{ number_format($countwork,1) }}</span> วัน
                            </p>
                            <p class="text-white mb-0">
                                ลากิจแล้วทั้งสิ้น
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
        <h3 class="block-title fs-18 fw-b">สรุปข้อมูลการลาประจำปีงบประมาณ {{$yearbudget}}</h3>
        <div class="table-responsive my-3">
            <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <th width="20%" class="text-center text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            ปรเะเภทการลา</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ต.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">พ.ย.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ธ.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ม.ค.</th>
                         <th width="6%" class="text-center text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ก.พ.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มี.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เม.ย.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">พ.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มิ.ย.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ก.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ส.ค.</th>
                         <th width="6%" class="text-center  text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ก.ย.</th>
                        <th width="8%" class="text-center bg-sl2-y4 text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาป่วย</td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,01,$i),1) }}
                            </td>
                            @endfor
                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,01,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,01),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> ลากิจ</td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,03,$i),1) }}
                            </td>
                            @endfor
                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,03,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,03),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาคลอดบุตร
                        </td>

                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,02,$i),1) }}
                            </td>
                            @endfor



                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,02,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,02),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาพักผ่อน
                        </td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,04,$i),1) }}
                            </td>
                            @endfor
                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,04,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,04),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาอุปสมบท
                        </td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,05,$i),1) }}
                            </td>
                            @endfor


                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,05,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,05),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาช่วยคลอด
                        </td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,06,$i),1) }}
                            </td>
                            @endfor
                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,06,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,06),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาเกณฑ์ทหาร
                        </td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,07,$i),1) }}
                            </td>
                            @endfor

                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,07,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,07),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาศึกษา
                            ฝึกอบรม</td>
                        @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,8,$i),1) }}
                            </td>
                            @endfor


                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,8,$i),1) }}
                                </td>
                                @endfor
                                <td class="text-font bg-sl2-y1"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,8),1)}}
                                </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                            ลาทำงานต่างประเทศ</td>
                        @for ($i = 1; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">0.0</td>
                            @endfor
                            <td class="text-font bg-sl2-y1"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">0.0</td>
                            
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                            ลาติดตามคู่สมรส</td>
                            @for ($i = 10; $i <= 12; $i++) <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,10,$i),1) }}
                            </td>
                            @endfor
                            @for ($i = 1; $i <= 9; $i++) <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{  number_format(LeaveController::countleavemonth($user_id,$yearbudget,10,$i),1) }}
                                </td>
                            @endfor
                            <td class="text-font bg-sl2-y1"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                {{ number_format(LeaveController:: sumcountleavemonth($user_id,$yearbudget,10),1)}}
                            </td>
                    </tr>
                    <tr height="20">
                        <td class="text-font text-pedding"
                            style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลาฟื้นฟูอาชีพ
                        </td>
                        @for ($i = 1; $i <= 12; $i++) 
                            <td class="text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">0.0</td>
                        @endfor
                            <td class="text-font bg-sl2-y1"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">0.0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="block-content">
        <h3 class="block-title fs-18 fw-b">สรุปข้อมูลครั้งและวันการลาประจำปีงบประมาณ {{$yearbudget}}</h3>
        <div class="table-responsive my-3">
            <div class="text-font">ค = จำนวนครั้ง ,ว = จำนวนวัน </div>
            <table class="gwt-table table-striped table-vcenter" width="100%">
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาป่วย</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลากิจ</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาพักผ่อน</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาคลอดบุตร</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาช่วยคลอด</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาติดตามคู่สมรส</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาทำงานต่างประเทศ</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาฟื้นฟูอาชีพ</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาศึกษา ฝึกอบรม</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาอุปสมบท</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">ลาเกณฑ์ทหาร</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            width="4%" colspan="2">รวม</td>
                    </tr>
                    <tr>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            style="{{$color_a}}">ค</td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ค
                        </td>
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ว
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr height="20">
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,1,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,1,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,3,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,3,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,4,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,4,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,2,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,2,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,6,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,6,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,10,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,10,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,9,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,9,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,11,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,11,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,8,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,8,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                            class="text-pedding text-font">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,5,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,5,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="background-color: #E9FAFA;border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countamountdayleavemonth($user_id,$yearbudget,7,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::countdayleavemonth($user_id,$yearbudget,7,$displaydate_bigen,$displaydate_end),1) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="background-color: #FFF0F5;border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::sumcountamountdayleavemonth($user_id,$yearbudget,$displaydate_bigen,$displaydate_end)) }}
                        </td>
                        <td class="text-pedding text-font"
                            style="background-color: #FFF0F5;border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            {{  number_format(LeaveController::sumcountdayleavemonth($user_id,$yearbudget,$displaydate_bigen,$displaydate_end),1) }}
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
