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
            <div class="row">
                <div class="col-md-2">
                    ปีงบประมาณ
                </div>
                <div class="col-md-2">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>2563</option>
                        <option>2562</option>
                    </select>
                </div>
                <div class="col-md-2">
                    ครั้งที่
                </div>
                <div class="col-md-2">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>

                    </select>
                </div>
                <div class="col-md-2">
                    ผู้ประเมิน
                </div>
                <div class="col-md-2">
                    นเดช หล่อมาก
                </div>

            </div>
            <div class="table-responsive">
               
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2"
                                width="5%">ลำดับ</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2"
                                width="8%"> รหัส</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2"
                                width="15%">ตัวชี้วัด (KPI)</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" colspan="3">
                                ผลย้อนหลัง</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">เป้าหมาย
                            </td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ผลงาน
                            </td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" colspan="5">
                                ค่าเป้าหมาย</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">คะแนน
                            </td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">น้ำหนัก
                            </td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ผลรวม
                            </td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">
                                ผู้รับผิดชอบ</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2"
                                width="8%">เปิดใช้</td>

                            <td class="text-font" style="border-color:#F0FFFF;text-align: center" rowspan="2"
                                width="7%">คำสั่ง</td>
                        </tr>
                        <tr height="40">
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;">60</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;">61</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;">62</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #FF0000;">1</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #FFFFE0;">2</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #FFA07A;">3</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #90EE90;">4</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center; background-color: #87CEFA;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr height="20">
                            <td class="text-font text-pedding" colspan="19" style="background-color: #FFF8DC;">
                                ตัวชี้วัดองค์กร</td>
                        </tr>
                        <?php $number= 0; ?>
                        @foreach ($infokpiorgs as $infokpiorg)
                        <?php $number++; ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font text-pedding">{{$infokpiorg->KPI_CODE}}</td>
                            <td class="text-font text-pedding">{{$infokpiorg->KPI_NAME}}</td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td align="center" width="5%">
                                <div class="custom-control custom-switch custom-control-lg ">
                                    <input type="checkbox" class="custom-control-input" id="" name=""
                                        onchange="switchactive();" checked>
                                    <label class="custom-control-label" for=""></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item"
                                            href="{{ url('person_work/personworkkpis_detail/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เพิ่มรายละเอียดตัวชี้วัด</a>
                                        <a class="dropdown-item" href=""
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดตัวชี้วัด</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr height="20">
                            <td class="text-font text-pedding" colspan="19" style="background-color: #FFF8DC;">
                                ตัวชี้วัดบุคคล</td>
                        </tr>
                        <?php $number2= 0; ?>
                        @foreach ($infokpipersons as $infokpiperson)

                        <?php $number2++; ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number2}}</td>
                            <td class="text-font text-pedding">{{$infokpiperson->KPIS_CODE}}</td>
                            <td class="text-font text-pedding">{{$infokpiperson->KPIS_NAME}}</td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td class="text-font text-pedding"></td>
                            <td align="center" width="5%">
                                <div class="custom-control custom-switch custom-control-lg ">
                                    <input type="checkbox" class="custom-control-input" id="" name=""
                                        onchange="switchactive();" checked>
                                    <label class="custom-control-label" for=""></label>
                                </div>
                            </td>

                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item"
                                            href="{{ url('person_work/personworkkpis_detail/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เพิ่มรายละเอียดตัวชี้วัด</a>
                                        <a class="dropdown-item" href=""
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดตัวชี้วัด</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_infowork')
<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>
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


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
