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
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>KPI รายบุคคล</B>
            </h3>
            <a href="" class="btn btn-info">ผลประเมินรวม</a>
        </div>
        <div class="block-content block-content-full">
            <form class="mb-2" action="{{route('person.infowork.jobdes_estimate',auth::user()->PERSON_ID)}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-1 col-form-label">ปีงบประมาณ</div>
                    <div class="col-md-2">
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg budget"
                            style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                            @foreach($drop_budgetyear as $value)
                            @if($budgetyear == $value)
                            <option value="{{$value}}" selected>{{$value}}</option>
                            @else
                            <option value="{{$value}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-sm btn-info">ค้นหา</button>
                    </div>
                </div>
            </form>
            <table class="gwt-table table-striped table-vcenter" width="100%">
                <colgroup>
                    <col width="5%">
                    <col width="70%">
                    <col width="25%">
                </colgroup>
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <th class="text-font" width="5%" style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">รายชื่อ</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">ประเมิน kpi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number= 0; ?>
                    @foreach ($person as $row)
                    <?php $number++;  ?>
                    <tr height="20">
                        <td class="text-font text-pedding text-center">{{$number}}</td>
                        <td class="text-font text-pedding">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</td>
                        @if($row->IS_KPI)
                        <td class="text-font text-pedding text-center">
                            <a href="{{route('person.infowork.personwork_estimate_kpi_person',[$budgetyear,$row->ID,Auth::user()->PERSON_ID])}}"><i class="fa fa-id-badge"></i></a>
                        </td>
                        @else
                        <td class="text-font text-pedding text-center">
                            <i class="fa fa-id-badge">
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
