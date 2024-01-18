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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;

    }

    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
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
<?php
    use App\Http\Controllers\RiskController;
    $checkrisknotify = RiskController::checkrisknotify($iduser);
    $countrisknotify = RiskController::countrisknotify($iduser);
    $check = RiskController::checkpermischeckinfo($iduser);
?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:17px;font-weight:normal;">
                {{ $inforpersonuser->HR_PREFIX_NAME }} {{ $inforpersonuser->HR_FNAME }}
                {{ $inforpersonuser->HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div class="row">
                        <div>
                            <a href="{{ url('general_risk/dashboard_risk/' . $iduser) }}" class="btn "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_report4/'.$iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                                ปค.4
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_report5/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                                ปค.5
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_account_detail/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify/' . $iduser) }}" class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">บันทึกความเสี่ยง</a>
                        </div>
                        <div>&nbsp;</div>
                        @if($check == 1)
                        <div>
                            <a href="{{ url('general_risk/risk_notify_checkinfo/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif
                        <div>
                            <a href="{{ url('general_risk/risk_notify_deal/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
                            <span class="badge badge-light"></span>
                            </a>
                        </div>
                        <div>&nbsp;&nbsp;</div>
                 
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content mx-1 ml-3">

    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการทบทวน</B></h3>
            <div class="block-details">
                <a href="{{route('gen_risk.risk_notify_recheck_add',[$riskid,$iduser])}}"
                    class="btn btn-info"
                    style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-plus"></i>
                    เพิ่มข้อมูล</a>
                <a class="btn btn-success" href="{{ route('gen_risk.risk_notify',$iduser) }}"><i
                        class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:#000000; text-align: center;">ครั้งที่</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">วันที่ทบทวน</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">ไฟล์เอกสาร</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">หัวข้อการทบทวน</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">รายละเอียด</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">วันที่บันทึก</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;">ผู้บันทึก</th>
                            <th class="text-font" style="border-color:#000000; text-align: center;" width="8%">คำสั่ง
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($inforechecks as $inforecheck)
                        <?php $number++;  ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font text-pedding">{{DateThai($inforecheck->RISK_RECHECK_DATE)}}</td>
                            @if($inforecheck->RISK_RECHECK_FILE == 'True')
                            <td class="text-font text-pedding" align="center"><span class="btn"
                                    style="background-color:#5a5655;color:#F0FFFF;"><i
                                        class="fa fa-1.5x fa-file-pdf"></i></span></td>
                            @else
                            <td align="center"></td>
                            @endif
                            <td class="text-font text-pedding">{{$inforecheck->RISK_RECHECK_HEAD}}</td>
                            <td class="text-font text-pedding">{{$inforecheck->RISK_RECHECK_DETAIL}}</td>
                            <td class="text-font text-pedding">{{DateThai($inforecheck->RISK_RECHECK_DATE_SAVE)}}</td>
                            <td class="text-font text-pedding">{{$inforecheck->HR_FNAME}} {{$inforecheck->HR_LNAME}}
                            </td>
                            <td class="text-font text-pedding">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item"
                                            href="{{route('gen_risk.risk_notify_recheck_edit',[$inforecheck->RISK_RECHECK_ID,$iduser])}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดแก้ไข</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
    jQuery(function () {
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
@endsection