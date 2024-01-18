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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Core competency</B></h3>
            <a href="{{ url('person_work/personworkcorecompetency_setup/'.$inforpersonuserid -> ID)}}"
                class="btn btn-primary">ตั้งระดับ</a>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                ลำดับ</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ปีงบประมาณ</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ครั้งที่</td>
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่</td>
                         
                            <td class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">
                                คำสั่ง</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number= 0; ?>
                        @foreach ($corecompetencys as $corecompetency)
                        <?php $number++; ?>

                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font text-pedding">{{$corecompetency->COR_RESULT_YEAR}}</td>
                            <td class="text-font text-pedding">{{$corecompetency->COR_RESULT_NO}}</td>
                            <td class="text-font text-pedding">{{DateThai($corecompetency->created_at)}}</td>
                         
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
                                            href="{{ url('person_work/personworkcorecompetency_detail_sub/'.$corecompetency->COR_RESULT_ID.'/'.$user_id )}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_infowork')
    <script>
        function checklogin(){
            window.location.href = '{{route("index")}}';
        }
    </script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>
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