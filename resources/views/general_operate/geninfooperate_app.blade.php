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

use App\Http\Controllers\OperateController;

        $checkver = OperateController::checkoperate_ver($user_id);
        $checkallow =  OperateController::checkoperate_allow($user_id);


?>
<?php

  function Monththai($strtime)
  {
    if($strtime == '1'){
        $month = 'มกราคม';
    }else if($strtime == '2'){
        $month = 'กุมภาพันธ์';
    }else if($strtime == '3'){
        $month = 'มีนาคม';
    }else if($strtime == '4'){
        $month = 'เมษายน';
    }else if($strtime == '5'){
        $month = 'พฤษภาคม';
    }else if($strtime == '6'){
        $month = 'มิถุนายน';
    }else if($strtime == '7'){
        $month = 'กรกฎาคม';
    }else if($strtime == '8'){
        $month = 'สิงหาคม';
    }else if($strtime == '9'){
        $month = 'กันยายน';
    }else if($strtime == '10'){
        $month = 'ตุลาคม';
    }else if($strtime == '11'){
        $month = 'พฤศจิกายน';
    }else if($strtime == '12'){
        $month = 'ธันวาคม';
    }else{
        $month = '';
    }

    return $month;
    }

    function Yearthai($strtime)
    {
      $year = $strtime+543;
      return $year;
    }

?>

<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div>
                        <a href="{{ url('general_operate/genoperateindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตารางเวรปฏิบัติงาน
                        </a>
                    </div>
                    <div>&nbsp;</div>

                    <div>
                        <a href="{{ url('general_operate/genoperateindexset/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จัดเวร

                        </a>
                    </div>
                    <div>&nbsp;</div>
                    <div>
                    <a href="{{ url('general_operate/genoperateswap/'.$inforpersonuserid->ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แลกเวร
                    </a>
                    </div>
                    <div>&nbsp;</div>

                    @if($checkver > 0)
                        <div>
                            <a href="{{ url('general_operate/genoperateindexver/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                            </a>
                        </div>
                        <div>&nbsp;</div>
                    @endif
                    @if($checkallow > 0)
                        <div>
                            <a href="{{ url('general_operate/genoperateindexapp/'.$inforpersonuserid -> ID)}}"
                                class="btn btn-success loadscreen"
                                >อนุมัติ
                            </a>
                        </div>
                        <div>&nbsp;</div>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">

    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติข้อมูลการจัดสรรเวร</B></h3>

        </div>
        <div class="block-content block-content-full">
            <form action="{{ route('operate.operateappsearch',['iduser'=>  $inforpersonuserid -> ID]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-0.5">
                        &nbsp;&nbsp; เดือน &nbsp;
                    </div>
                    <div class="col-md-2">
                        <select name="OPERATE_MONTH" id="OPERATE_MONTH" class="form-control input-lg "
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">-กรุณาเลือกเดือน-</option>
                            @foreach ($leavemonths as $leavemonth)
                            @if($leavemonth-> MONTH_ID == $searchmonth_check)
                            <option value="{{ $leavemonth->MONTH_ID  }}" selected>{{ $leavemonth->MONTH_NAME}}</option>
                            @else
                            <option value="{{ $leavemonth->MONTH_ID  }}">{{ $leavemonth->MONTH_NAME}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-0.5">
                        &nbsp;ปี &nbsp;
                    </div>
                    <div class="col-md-2">
                        <select name="OPERATE_INDEX_YEAR" id="OPERATE_INDEX_YEAR" class="form-control input-lg "
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach ($budgetyears as $budgetyear)
                            @if($budgetyear-> LEAVE_YEAR_ID == $searchyear_check)
                            <option value="{{ $budgetyear->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID}}
                            </option>
                            @else
                            <option value="{{ $budgetyear->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg "
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">-กรุณาเลือกสถานะ-</option>
                            @foreach ($operatestatuss as $operatestatus)
                            @if($operatestatus-> OPERATE_STATUS_CODE == $status_check)
                            <option value="{{ $operatestatus->OPERATE_STATUS_CODE  }}" selected>
                                {{ $operatestatus->OPERATE_STATUS_NAME}}</option>
                            @else
                            <option value="{{ $operatestatus->OPERATE_STATUS_CODE  }}">
                                {{ $operatestatus->OPERATE_STATUS_NAME}}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="search" name="search" class="form-control"
                                style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                        </span>
                    </div>
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info"
                                >ค้นหา</button>
                        </span>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">ลำดับ</th>

                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">สถานะ</th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="10%">
                                ประจำเดือน</th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="8%">ประจำปี
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="10%">หน่วยงาน
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="15%">ผู้จัดเวร
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="15%">ประเภท
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">จัดสรร
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">อนุมัติ
                            </th>
                         

                        </tr>
                    </thead>
                    <tbody>

                        <?php $number = 0; ?>
                        @foreach ($operateindexs as $operateindex)
                        <?php $number++;
                                 $status =  $operateindex->OPERATE_STATUS;

                                 if( $status === 'Pending'){
                                    $statuscol =  "badge badge-danger";

                                }else if($status === 'Approve'){
                                   $statuscol =  "badge badge-warning";

                                }else if($status === 'Verify'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'Allow'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }
                                ?>

                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>

                            <td align="center"><span
                                    class="{{$statuscol}}">{{ $operateindex->OPERATE_STATUS_NAME}}</span></td>
                            <td class="text-font" style="text-align: center;">
                                {{ Monththai($operateindex->OPERATE_INDEX_MONTH)}}</td>
                            <td class="text-font" style="text-align: center;">
                                {{ Yearthai($operateindex->OPERATE_INDEX_YEAR)}}</td>
                            <td class="text-font text-pedding">{{ $operateindex->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                            <td class="text-font text-pedding">{{ $operateindex->OPERATE_ORGANIZER_NAME}}</td>
                            <td class="text-font text-pedding">{{ $operateindex->OPERATE_TYPE_NAME}}</td>
                            
                            <td align="center">
                                <a href="{{ url('general_operate/genoperateindexsetactivity/'.$operateindex -> OPERATE_INDEX_ID.'/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-success"><i class="fa fa-file-signature"></i></a>
                            </td>

                            <td align="center">
                                @if($status === 'Verify')
                                <a href="{{ url('general_operate/genoperateindexappcheck/'.$operateindex -> OPERATE_INDEX_ID.'/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-primary "><i class="fa fa-edit"></i></a>
                                @else
                                <a href="#detail_modal{{ $operateindex -> OPERATE_INDEX_ID }}" data-toggle="modal"
                                    class="btn btn-info "><i class="fa fa-list"></i></a>
                                @endif
                            </td>


                        </tr>

                        <div id="detail_modal{{ $operateindex -> OPERATE_INDEX_ID }}" class="modal fade edit"
                            tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <div class="row">
                                            <div>&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดเวรลำดับที่ {{$number}}
                                                &nbsp;&nbsp;&nbsp;&nbsp;</div>
                                            <div>
                                                <a href="{{ url('general_operate/genoperateindexexcelactivity/'.$operateindex -> OPERATE_INDEX_ID.'/'.$inforpersonuserid -> ID)}}"
                                                    class="btn btn-info"
                                                    >
                                                    <li class="fa fa-file-excel"></li>&nbsp;ตารางเวรฏิบัติงาน
                                                </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div>
                                                <a href="{{ url('general_operate/genoperateindexexcelactivityot/'.$operateindex -> OPERATE_INDEX_ID.'/'.$inforpersonuserid -> ID)}}"
                                                    class="btn btn-success "
                                                    >
                                                    <li class="fa fa-file-excel"></li>&nbsp;ตาราง OT
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>ประจำเดือน :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ Monththai($operateindex -> OPERATE_INDEX_MONTH) }}</h1>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>ปีพุทธศักราช :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ Yearthai($operateindex -> OPERATE_INDEX_YEAR) }}</h1>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>หน่วยงาน :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ $operateindex -> HR_DEPARTMENT_SUB_SUB_NAME}}</h1>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>ผู้จัดเวร :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ $operateindex -> OPERATE_ORGANIZER_NAME }}</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>ผู้ตรวจสอบคนที่1 :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ $operateindex -> OPERATE_VERIFY_1_NAME }}</h1>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>ผู้ตรวจสอบคนที่2 :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <h1
                                                        style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                        {{ $operateindex -> OPERATE_VERIFY_2_NAME}}</h1>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div align="right">
                                            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"
                                                >ปิดหน้าต่าง</button>
                                        </div>
                                    </div>
                                    </form>
                                    </body>

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </tbody>
                </table>

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
<script>
    jQuery(function() {
        Dashmix.helpers(['easy-pie-chart', 'sparkline']);
    });
</script>

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
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
</script>

@endsection