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
<div class="block" style="width: 95%;">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประเมิน CORE COMPETENCY
                    {{$inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}</B></h3>
            <a href="{{ url('person_work/personworkcorecompetency_detail/'.$id_user)}}"
                class="btn btn-success">ย้อนกลับ</a>
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
<script>
    function checkscore(idhead, number, count) {
        var SCORE = document.getElementById("SCORE" + idhead + number).value;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('mperson.checkscore')}}",
            method: "GET",
            data: {
                SCORE: SCORE,
                idhead: idhead,
                _token: _token
            },
            success: function (result) {
                $('.showscore' + idhead + number).html(result);
                scoreTotal(idhead, count);
            }
        })
    }

    function scoreTotal(idhead, count) {
        var arr = document.getElementsByName('sum' + idhead);
        var tot = 0;
        for (var i = 0; i < count; i++) {
            tot += parseFloat(arr[i].value);
        }
        document.getElementById('showscoresum' + idhead).value = tot;
    }
</script>
@endsection
