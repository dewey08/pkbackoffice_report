@extends('layouts.backend')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')



<script>
    function checklogin() {
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

  list($a,$b,$c,$d) = explode('/',$url);

?>


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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }

    }


    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    .form-control {
        font-size: 13px;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
</style>


<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div class="row">
                        <div>
                            <a href="{{ url('general_car/gencarindex/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ปฏิทินยานพาหนะ</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>

                            <a href="{{ url('general_car/gencartype/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เพิ่มข้อมูลขอใช้รถ</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_car/gencarinfonomal/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-success loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ทะเบียนใช้รถทั่วไป</a>

                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_car/gencarinforefer/'.$inforpersonuserid -> ID)}}"
                                class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถพยาบาล</a>
                        </div>

                        <div>&nbsp;</div>

                    </div>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">

    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนใช้รถทั่วไป</B></h3>

        </div>
        <div class="block-content block-content-full">



            <form action="{{ route('car.infonomal',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-0.5">
                        &nbsp;&nbsp; ปีงบ &nbsp;
                    </div>
                    <div class="col-sm-1.5">
                        <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget"
                                style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}
                                </option>
                                @else
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif
                                @endforeach
                            </select>
                        </span>
                    </div>

                    <div class="col-sm-4 date_budget">
                        <div class="row">
                            <div class="col-sm">
                                วันที่
                            </div>
                            <div class="col-md-4">

                                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>

                            </div>
                            <div class="col-sm">
                                ถึง
                            </div>
                            <div class="col-md-4">

                                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                            </div>
                        </div>

                    </div>

                    <div class="col-sm-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>

                    <div class="col-sm-2">
                        <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>
                                @foreach ($infocar_sendstatuss as $infocar_sendstatus)
                                @if($infocar_sendstatus->STATUS_ID == $status_check)
                                <option value="{{ $infocar_sendstatus->STATUS_ID  }}" selected>
                                    {{ $infocar_sendstatus->STATUS_NAME}}</option>
                                @else
                                <option value="{{ $infocar_sendstatus->STATUS_ID  }}">
                                    {{ $infocar_sendstatus->STATUS_NAME}}</option>
                                @endif


                                @endforeach

                            </select>
                        </span>
                    </div>

                    <div class="col-sm-0.5">
                        &nbsp;ค้นหา &nbsp;
                    </div>

                    <div class="col-sm-2">
                        <span>

                            <input type="search" name="search" class="form-control"
                                style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                        </span>
                    </div>

                    <div class="col-sm-30">
                        &nbsp;
                    </div>
                    <div class="col-sm-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                    class="fas fa-search mr-2"></i>ค้นหา</button>
                        </span>
                    </div>


                </div>
            </form>

            <div class="row">
                <div class="col-md-12" style=" font-size: 15px;">
                    ความเร่งด่วน ::
                    <p class="fa fa-circle" style="color:#008000;  font-size: 15px;"></p> ปกติ


                    <p class="fa fa-circle" style="color:#87CEFA;  font-size: 15px;"></p> ด่วน


                    <p class="fa fa-circle" style="color:#FFA500;  font-size: 15px;"></p> ด่วนมาก

                    <p class="fa fa-circle" style="color:#FF4500;  font-size: 15px;"></p> ด่วนที่สุด
                    &nbsp;&nbsp;&nbsp;&nbsp;


                    คะแนน ::
                    <img src="{{ asset('storage/images/1.png') }}" width="15" height="15" /> ต้องปรับปรุง


                    <img src="{{ asset('storage/images/2.png') }}" width="15" height="15" /> พอใช้


                    <img src="{{ asset('storage/images/3.png') }}" width="15" height="15" /> ปานกลาง

                    <img src="{{ asset('storage/images/4.png') }}" width="15" height="15" /> ดี


                    <img src="{{ asset('storage/images/5.png') }}" width="15" height="15" /> ดีมาก
                </div>
            </div>
            <div class="table-responsive">
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">ลำดับ</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">สถานะ</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ความเร่งด่วน</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" >ความพึงพอใจ</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%" >ทะเบียน</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" >วดป./เวลา</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%" >สถานที่ไป</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">เหตุผลการขอรถ</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%" >ผู้ร้องขอ</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">พขร.ที่จัดสรร</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานที่นัดหมาย</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($infonomals as $infonomal)
                        <?php $number++; ?>

                        <tr height="20">
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;">{{$number}}
                            </td>


                            @if($infonomal->STATUS == 'CANCEL')
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "><span
                                    class="badge badge-danger">ยกเลิก</span></td>
                            @elseif($infonomal->STATUS == 'RECERVE')
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "><span
                                    class="badge badge-warning">ร้องขอ</span></td>
                            @elseif($infonomal->STATUS == 'REGROUP')
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "><span
                                    class="badge badge-info">จัดสรรร่วม</span></td>
                            @elseif($infonomal->STATUS == 'SUCCESS')
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "><span
                                    class="badge badge-info">จัดสรร</span></td>
                            @elseif($infonomal->STATUS == 'LASTAPP')
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "><span
                                    class="badge badge-success">ผอ.อนุมัติ</span></td>
                            @else
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top; "></td>
                            @endif

                            @if($infonomal->PRIORITY_ID == 1)
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><span
                                    class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                            @elseif($infonomal->PRIORITY_ID == 2)
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><span
                                    class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                            @elseif($infonomal->PRIORITY_ID == 3)
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><span
                                    class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                            @elseif($infonomal->PRIORITY_ID == 4)
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><span
                                    class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                            @else
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"></td>
                            @endif





                            @if($infonomal->FANCINESS_SCORE == 1)
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><img
                                    src="{{ asset('storage/images/1.png') }}" width="30" height="30" /></td>
                            @elseif($infonomal->FANCINESS_SCORE == 2)
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><img
                                    src="{{ asset('storage/images/2.png') }}" width="30" height="30" /></td>
                            @elseif($infonomal->FANCINESS_SCORE == 3)
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><img
                                    src="{{ asset('storage/images/3.png') }}" width="30" height="30" /></td>
                            @elseif($infonomal->FANCINESS_SCORE == 4)
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><img
                                    src="{{ asset('storage/images/4.png') }}" width="30" height="30" /></td>
                            @elseif($infonomal->FANCINESS_SCORE == 5)
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"><img
                                    src="{{ asset('storage/images/5.png') }}" width="30" height="30" /></td>
                            @else
                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;"></td>
                            @endif



                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->CAR_REG }}</td>
                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ DateThai($infonomal->RESERVE_BEGIN_DATE) }}
                                {{ formatetime($infonomal->RESERVE_BEGIN_TIME) }}<br>{{ DateThai($infonomal->RESERVE_END_DATE) }}
                                {{ formatetime($infonomal->RESERVE_END_TIME) }}</td>

                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->LOCATION_ORG_NAME }}
                            </td>
                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->RESERVE_NAME }}</td>
                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->RESERVE_PERSON_NAME }}</td>

                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->HR_PREFIX_NAME }}{{ $infonomal->HR_FNAME }} {{ $infonomal->HR_LNAME }}
                            </td>
                            <td class="text-font text-pedding"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black; vertical-align:top;">
                                {{ $infonomal->APPOINT_LOCATE_NAME }}</td>

                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black; vertical-align:top;">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal; vertical-align:top;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">

                                        <a class="dropdown-item" href="#detail_usecar" data-toggle="modal"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;" 
                                            onclick="detail({{$infonomal->RESERVE_ID}});">รายละเอียด</a>

                                        <a class="dropdown-item" href="#fan_modal{{ $infonomal -> RESERVE_ID }}"
                                            data-toggle="modal"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;">ความพึงพอใจ</a>

                                        <a class="dropdown-item"
                                            href="{{ url('general_car/gencarnomaledit/'.$infonomal -> RESERVE_ID.'/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;">แก้ไขข้อมูล</a>

                                        <a class="dropdown-item"
                                            href="{{ url('general_car/gencarnomalcancel/'.$infonomal -> RESERVE_ID.'/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;">แจ้งยกเลิก</a>



                                        @if ( $codes == '10999' )
                                        <a class="dropdown-item"
                                            href="{{ url('formpdf/pdf3_general_10999/'.$infonomal->RESERVE_ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;"
                                            target="_blank">พิมพ์ใบขอใช้รถยนต์</a>
                                        @else
                                        <a class="dropdown-item"
                                            href="{{ url('general_car/gencarnomallocation/export_pdf3/'.$infonomal -> RESERVE_ID.'/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal; vertical-align:top;"
                                            target="_blank">พิมพ์ใบขอใช้รถยนต์</a>
                                        @endif


                                    </div>
                                </div>
                            </td>

                        </tr>



                        <div id="fan_modal{{ $infonomal -> RESERVE_ID }}" class="modal fade edit" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <div class="row">
                                            <div>
                                                <h3 style="font-family: 'Kanit', sans-serif;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;แบบประเมินความพึงพอใจ&nbsp;&nbsp;เลขที่&nbsp;&nbsp;{{ $infonomal -> RESERVE_ID}}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">


                                        <div id="fan_modal{{ $infonomal -> RESERVE_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แบบประเมินความพึงพอใจ&nbsp;&nbsp;เลขที่&nbsp;&nbsp;{{ $infonomal -> RESERVE_ID}}</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body">
                                                <body>
                                                <form  method="post" action="{{ route('car.savefan') }}" >
                                                @csrf

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">

                                                            <label>การประเมิน</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            &nbsp;&nbsp; &nbsp; &nbsp;

                                                            @if($infonomal ->FANCINESS_SCORE == 1)
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="1"
                                                                checked>ต้องปรับปรุง&nbsp;&nbsp; &nbsp; &nbsp;
                                                            @else
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE"
                                                                value="1">ต้องปรับปรุง&nbsp;&nbsp; &nbsp; &nbsp;
                                                            @endif


                                                            @if($infonomal ->FANCINESS_SCORE == 2)
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="2"
                                                                checked>พอใช้&nbsp;&nbsp; &nbsp; &nbsp;; &nbsp;
                                                            @else
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="2">พอใช้&nbsp;&nbsp;
                                                            &nbsp; &nbsp;
                                                            @endif

                                                            @if($infonomal ->FANCINESS_SCORE == 3)
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="3"
                                                                checked>ปานกลาง&nbsp;&nbsp; &nbsp; &nbsp;
                                                            @else
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="3">ปานกลาง&nbsp;&nbsp;
                                                            &nbsp; &nbsp;
                                                            @endif


                                                            @if($infonomal ->FANCINESS_SCORE == 4)
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="4" checked>ดี&nbsp;&nbsp;
                                                            &nbsp; &nbsp;
                                                            @else
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="4">ดี&nbsp;&nbsp; &nbsp;
                                                            &nbsp;
                                                            @endif

                                                            @if($infonomal ->FANCINESS_SCORE == 5)
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="5" checked>ดีมาก
                                                            @else
                                                            <input type="radio" class="form-check-input"
                                                                name="FANCINESS_SCORE" value="5">ดีมาก
                                                            @endif




                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label>คำแนะนำ</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" rows="5"
                                                                name="FANCINESS_REMARK" id="FANCINESS_REMARK"
                                                                style=" font-family: 'Kanit', sans-serif;">{{$infonomal->FANCINESS_REMARK}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label>ผู้ประเมิน</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            {{ $inforpersonuser -> HR_PREFIX_NAME }}
                                                            {{ $inforpersonuser -> HR_FNAME }}
                                                            {{ $inforpersonuser -> HR_LNAME }}
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>วันที่ประเมิน</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            {{DateThai(date('Y-m-d'))}}
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label>เวลา</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            {{date('H:i')}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="FANCINESS_RESERRVE_ID"
                                                    id="FANCINESS_RESERRVE_ID" value="{{ $infonomal -> RESERVE_ID  }} ">
                                                <input type="hidden" name="FANCINESS_PERSON_ID" id="FANCINESS_PERSON_ID"
                                                    value="{{ $inforpersonuserid -> ID  }} ">

                                    </div>
                                    <div class="modal-footer">
                                        <div align="right">
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                                    class="fas fa-save mr-2"></i>ส่งผล</button>
                                            <button type="button" class="btn btn-hero-sm btn-hero-danger"
                                                data-dismiss="modal"><i
                                                    class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                        </div>
                                    </div>
                                    </form>
                                    </body>


                                </div>
                            </div>
                        </div>


                        @endforeach



                        <div id="detail_usecar" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <div class="row">
                                            <div>
                                                <h3 style="font-family: 'Kanit', sans-serif;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการขอใช้รถทั่วไป&nbsp;&nbsp;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">



                                        <div id="detail"></div>


                                    </div>
                                    <div class="modal-footer">
                                        <div align="right">

                                            <button type="button" class="btn btn-hero-sm btn-hero-secondary"
                                                data-dismiss="modal"><i
                                                    class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                                        </div>
                                    </div>
                                    </form>
                                    </body>


                                </div>
                            </div>
                        </div>



                    </tbody>
                </table>




            </div>
        </div>
    </div>



</div>







@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>




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
        $('select').select2({
            width: '100%'
        });
    });
</script>
<script>
    function detail(id) {

        var type = 'nomal';

   $.ajax({
              url:"{{route('car.detailcar')}}",
             method:"GET",
              data:{type:type,id:id},
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
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }); //กำหนดเป็นวันปัจุบัน
    });

    $('.budget').change(function () {
        if ($(this).val() != '') {
            var select = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('admin.selectbudget')}}",
                method: "GET",
                data: {
                    select: select,
                    _token: _token
                },
                success: function (result) {
                    $('.date_budget').html(result);
                    datepick();
                }
            })
            // console.log(select);
        }
    });
</script>



@endsection