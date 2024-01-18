@extends('layouts.general.person_work')
@section('css_after_infowork')
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


    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }

    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }
</style>
@endsection
@section('content_infowork')
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
    // date_default_timezone_set("Asia/Bangkok");
?>
<div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลตัวชี้วัด (KPIs)</B></h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default" style="text-align: left">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดตัวชี้วัด</B></h3>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="block-content block-content-full">
                        @csrf
                        <input type="hidden" name="KPI_ID" id="KPI_ID" class="form-control input-sm"
                            style=" font-family: 'Kanit', sans-serif;" value="">
                        <div class="col-sm-12">
                            <div class="row push">
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        ยุทธศาสตร์ :
                                    </label>
                                </div>
                                <div class="col-lg-3" style="text-align: left">
                                </div>
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        เป้าประสงค์ :
                                    </label>
                                </div>
                                <div class="col-lg-4" style="text-align: left">
                                </div>
                            </div>
                            <div class="row push">
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        ตัวชี้วัด :
                                    </label>
                                </div>
                                <div class="col-lg-3" style="text-align: left">
                                </div>
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        รายละเอียด :
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input name="KPI_DETAIL" id="KPI_DETAIL" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                            </div>
                            <div class="row push">
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        หน่วยวัด :
                                    </label>
                                </div>
                                <div class="col-lg-3" style="text-align: left">
                                    <input name="KPI_UNIT" id="KPI_UNIT" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        น้ำหนัก :
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input name="KPI_WEIGHT" id="KPI_WEIGHT" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                            </div>
                            <div class="row push">
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        เป้าหมาย :
                                    </label>
                                </div>
                                <div class="col-lg-3" style="text-align: left">
                                    <input name="KPI_GOAL" id="KPI_GOAL" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        ค่ายอมรับ :
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input name="KPI_ACCEP" id="KPI_ACCEP" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                            </div>
                            <div class="row push">
                                <div class="col-lg-2" style="text-align: left">
                                    <label>
                                        ค่าวิกฤติ :
                                    </label>
                                </div>
                                <div class="col-lg-3" style="text-align: left">
                                    <input name="KPI_CRITICAL" id="KPI_CRITICAL" class="form-control input-sm"
                                        style=" font-family: 'Kanit', sans-serif;" value="">
                                </div>
                            </div>
                            <div class="row push" style="text-align: center">
                                <div class="col-lg-6" style="text-align: left">
                                    <div class="row push">
                                        <div class="col-lg-6" style="text-align: left">
                                            <label>
                                                คะแนนระดับ
                                            </label>
                                        </div>
                                    </div>
                                    @for ($i = 1; $i <= 5; $i++) <div class="row push">
                                        <div class="col-lg-4" style="text-align: left">
                                            <label>
                                                ระดับ {{$i}} :
                                            </label>
                                        </div>
                                        <div class="col-lg-6" style="text-align: left">
                                            <input type="hidden" name="KPI_LEVEL_NUM[]" id="KPI_LEVEL_NUM[]"
                                                class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"
                                                value="{{$i}}">
                                            <input name="KPI_LEVEL[]" id="KPI_LEVEL[]" class="form-control input-sm"
                                                style=" font-family: 'Kanit', sans-serif;" value="">
                                        </div>
                                </div>
                                @endfor
                            </div>
                            <div class="col-lg-6" style="text-align: left">
                                <div class="row push">
                                    <div class="col-lg-6" style="text-align: left">
                                        <label>
                                            คะแนนย้อนหลัง 3 ปี
                                        </label>
                                    </div>
                                </div>
                                <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                        <label>
                                            ปี 2562 :
                                        </label>
                                    </div>
                                    <div class="col-lg-6" style="text-align: left">
                                        <input name="REYEAR_1" id="REYEAR_1" class="form-control input-sm"
                                            style=" font-family: 'Kanit', sans-serif;" value="">
                                    </div>
                                </div>
                                <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                        <label>
                                            ปี 2561 :
                                        </label>
                                    </div>
                                    <div class="col-lg-6" style="text-align: left">
                                        <input name="REYEAR_2" id="REYEAR_2" class="form-control input-sm"
                                            style=" font-family: 'Kanit', sans-serif;" value="">
                                    </div>
                                </div>
                                <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                        <label>
                                            ปี 2560 :
                                        </label>
                                    </div>
                                    <div class="col-lg-6" style="text-align: left">
                                        <input name="REYEAR_3" id="REYEAR_3" class="form-control input-sm"
                                            style=" font-family: 'Kanit', sans-serif;" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                                    style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1"
                                            style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">คะแนน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2"
                                            style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้รับผิดชอบ</a>
                                    </li>
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                        <div class="row push">
                                            <div class="col-lg-2" style="text-align: left">
                                                <label>
                                                    ผลงาน :
                                                </label>
                                            </div>
                                            <div class="col-lg-3" style="text-align: left">
                                                <input name="KPI_RESULTS" id="KPI_RESULTS" class="form-control input-sm"
                                                    style=" font-family: 'Kanit', sans-serif;" value="">
                                            </div>
                                            <div class="col-lg-2" style="text-align: left">
                                                <label>
                                                    คะแนน :
                                                </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input name="KPI_SCORE" id="KPI_SCORE" class="form-control input-sm"
                                                    style=" font-family: 'Kanit', sans-serif;" value="">
                                            </div>
                                        </div>
                                        <table width="90%">
                                            <tr>
                                                <td> <label> มกราคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M1" id="KPI_SCORE_M1"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> กุมภาพันธ์ : </label> </td>
                                                <td> <input name="KPI_SCORE_M2" id="KPI_SCORE_M2"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> มีนาคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M3" id="KPI_SCORE_M3"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> เมษายน : </label> </td>
                                                <td> <input name="KPI_SCORE_M4" id="KPI_SCORE_M4"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                            </tr>
                                            <tr>
                                                <td> <label> พฤษภาคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M5" id="KPI_SCORE_M5"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> มิถุนายน : </label> </td>
                                                <td> <input name="KPI_SCORE_M6" id="KPI_SCORE_M6"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> กรกฎาคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M7" id="KPI_SCORE_M7"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> สิงหาคม : </td>
                                                <td> <input name="KPI_SCORE_M8" id="KPI_SCORE_M8"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label> กันยายน : </label> </td>
                                                <td> <input name="KPI_SCORE_M9" id="KPI_SCORE_M9"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> ตุลาคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M10" id="KPI_SCORE_M10"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> พฤศจิกายน : </label> </td>
                                                <td> <input name="KPI_SCORE_M11" id="KPI_SCORE_M11"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                                <td> <label> ธันวาคม : </label> </td>
                                                <td> <input name="KPI_SCORE_M12" id="KPI_SCORE_M12"
                                                        class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;" value=""> </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">
                                        <table class="table gwt-table">
                                            <thead>
                                                <tr>
                                                    <td style="text-align: center;">ชื่อ สกุล</td>
                                                    <td style="text-align: center;" width="30%">ตำแหน่ง</td>
                                                    <td style="text-align: center;" width="15%">ระดับ</td>
                                                    <td style="text-align: center;" width="12%"><a
                                                            class="btn btn-success fa fa-plus addRow"
                                                            style="color:#FFFFFF;"></a></td>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody1"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div align="right">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info">บันทึก</button>
                            <a href="{{ url('person_work/personworkkpis/'.$inforpersonuserid -> ID)  }}"
                                class="btn btn-hero-sm btn-hero-danger"
                                onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('footer_infowork')
<script>
        function checklogin(){
            window.location.href = '{{route("index")}}';
        }
</script>
<script>
    jQuery(function () {
        Dashmix.helpers(['easy-pie-chart', 'sparkline']);
    });
</script>
<script>
    $(document).ready(function () {

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }); //กำหนดเป็นวันปัจุบัน
    });
    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
</script>
@endsection