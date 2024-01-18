@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<!-- <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" /> -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.css')}}">

<style>
    .t-content td {
        padding: 5px;
    }

    .padding-custom td {
        padding-top: 4px;
        padding-right: 4px;
        padding-bottom: 4px;
        padding-left: 4px;
    }

    .bg-sl-header {
        background: #fee599;
    }

    .customfooter td {
        font-size: 16px !important;
        font-weight: bolder;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .border-none {
        border: none;
    }

    .outline-none {
        outline: none;
    }

    ;
</style>
@endsection
@section('content')
<?php
?>
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title fw-5">
                ผลการประเมิน
            </div>
            <div class="block-options fw-5">
                <a class="btn btn-info" href="{{route('mperson.jobdescriptions_personnel')}}">ย้อนกลับ</a>
            </div>
        </div>
        <div class="block-content mb-3">

            <form action="{{ route('mperson.jobdescriptions_personnel_estimate',$id) }}" method="post" class="mb-2 ">
                @csrf
                <div class="row" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                    <div class="col-md-2 text-center col-form-label">กำหนดช่วงประเมิน</div>
                    <div class="col-md-2 d-flex">
                        <select name="estimate_type" id="estimate_type" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;font-size: 12px;">
                            @foreach($estimate_type_dropdown as $key => $value)
                            @if($key == $estimate_type)
                            <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                            <option value="{{$key}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-sm btn-info"><i
                                class="fas fa-search mr-2"></i>ค้นหา</button>
                    </div>
                </div>
            </form>
            <div class="container-fluid fs-14 mb-4">
                <div class="row">
                    <div class="col-md-12 fs-16 mb-2">
                        การทำงาน &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; {{$job_person_list[0]->IWJD_NAME}}
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="d-flex">
                            <div style="width:140px">ปีงบประมาณ</div>
                            <div style="150px">: {{$job_person_list[0]->IWJP_BUDGETYEAR}}</div>
                        </div>
                        <div class="d-flex mb-2">
                            <div style="width:140px">ผู้รับ job description</div>
                            <div style="150px">: {{$job_person_list[0]->p_fname}} {{$job_person_list[0]->p_lname}}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="d-flex">
                            <div style="width:140px">ผู้สร้าง job description</div>
                            <div style="150px">: {{$job_person_list[0]->p_c_fname}} {{$job_person_list[0]->p_c_lname}}
                            </div>
                        </div>
                        <div class="d-flex">
                            <div style="width:140px">วันที่สร้าง</div>
                            <div style="150px">: {{DateThai($job_person_list[0]->created_at)}} เวลา
                                {{date('H:i:s',strtotime($job_person_list[0]->created_at))}} น.</div>
                        </div>
                        <div class="d-flex">
                            <div style="width:140px">อัปเดตล่าสุด</div>
                            <div style="150px">: {{DateThai($job_person_list[0]->updated_at)}} เวลา
                                {{date('H:i:s',strtotime($job_person_list[0]->updated_at))}} น.</div>
                        </div>
                    </div>
                </div>
            </div>
            




            @if($estimate_type == "estimate_all")
            <div class="table-responsive">
                <table width="100%" border="1px">
                    <thead class="bg-sl-header" style="border-bottom:2px solid;border-top:5px solid;">
                        <tr>
                            <th width="5%" rowspan="2">ลำดับ</th>
                            <th width="25%" rowspan="2">ตัวชี้วัดผลงาน</th>
                            <th width="10%" colspan="5">ลำดับ</th>
                            <th width="5%" rowspan="2">คะแนน<br>(10-3)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(4-9)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(12m)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(ก)</th>
                            <th width="5%" rowspan="2">น้ำหนัก<br>(ข)</th>
                            <th width="7%" rowspan="2">ผลรวม<br>(ค)=กxข</th>
                            <th width="5%" rowspan="2">เป้า</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนแรก</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนหลัง</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(10-3)</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(4-9)</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(12m)</th>
                        </tr>
                        <tr>
                            <th width="2%" style="background:red;">1</th>
                            <th width="2%" style="background:#fefe00;">2</th>
                            <th width="2%" style="background:#fe9900;">3</th>
                            <th width="2%" style="background:#00fe00;">4</th>
                            <th width="2%" style="background:#00fefe;">5</th>
                            <th style="background:#6d9eeb;">ต.ค.</th>
                            <th style="background:#6d9eeb;">พ.ย.</th>
                            <th style="background:#6d9eeb;">ธ.ค.</th>
                            <th style="background:#6d9eeb;">ม.ค.</th>
                            <th style="background:#6d9eeb;">ก.พ.</th>
                            <th style="background:#6d9eeb;">มี.ค.</th>
                            <th style="background:#6d9eeb;">เม.ย.</th>
                            <th style="background:#6d9eeb;">พ.ค.</th>
                            <th style="background:#6d9eeb;">มิ.ย</th>
                            <th style="background:#6d9eeb;">ก.ค.</th>
                            <th style="background:#6d9eeb;">ส.ค.</th>
                            <th style="background:#6d9eeb;">ก.ย.</th>
                        </tr>
                    </thead>
                    <tbody class="bg-sl-header text-center fs-10 padding-custom">
                        <?php
                                $number = 0;
                                $score_total = 0;
                                $weight_total = 0;
                                $multiply_total = 0;
                                $result_before_total  = 0;
                                $result_after_total   = 0;
                                $result_12month_total = 0;
                                $score_before_total   = 0;
                                $score_after_total    = 0;
                                $score_12month_total  = 0;
                                $multiply_before      = 0;
                                $multiply_after       = 0;
                                $multiply_12month     = 0;
                            ?>
                        @foreach($job_person_list as $row)
                        <?php
                                $before    =   [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3];
                                $after      =   [$row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];  
                                $_12month   =  [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3,
                                                $row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];
                                if($row->IWJPL_TYPE_CALCULATE == "calc_avg"){
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_max"){
                                    $result_before  = max($before);
                                    $result_after   = max($after);
                                    $result_12month = max($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_last"){
                                    $result_before  = $before[count($before)-1];
                                    $result_after   = $after[count($after)-1];
                                    $result_12month = $_12month[count($_12month)-1];
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_sum"){
                                    $result_before  = array_sum($before);
                                    $result_after   = array_sum($after);
                                    $result_12month = array_sum($_12month);
                                }else{
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }

                                // คำนวณคะแนน
                                $number1 = $row->IWJPL_NUMBER_1;
                                $number2 = $row->IWJPL_NUMBER_2;
                                $number3 = $row->IWJPL_NUMBER_3;
                                $number4 = $row->IWJPL_NUMBER_4;
                                $number5 = $row->IWJPL_NUMBER_5;
                                if($number1 < $number2){
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before <= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before < $number2){
                                        $score_before = 1 + (($result_before-$number1)/($number2 - $number1));
                                    }elseif($result_before < $number3){
                                        $score_before = 2 + (($result_before-$number2)/($number3 - $number2));
                                    }elseif($result_before < $number4){
                                        $score_before = 3 + (($result_before-$number3)/($number4 - $number3));
                                    }elseif($result_before < $number5){
                                        $score_before = 4 + (($result_before-$number4)/($number5 - $number4));
                                    }elseif($result_before >= $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after <= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after < $number2){
                                        $score_after = 1 + (($result_after-$number1)/($number2 - $number1));
                                    }elseif($result_after < $number3){
                                        $score_after = 2 + (($result_after-$number2)/($number3 - $number2));
                                    }elseif($result_after < $number4){
                                        $score_after = 3 + (($result_after-$number3)/($number4 - $number3));
                                    }elseif($result_after < $number5){
                                        $score_after = 4 + (($result_after-$number4)/($number5 - $number4));
                                    }elseif($result_after >= $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month < $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month < $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month < $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month < $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month >= $number5){
                                        $score_12month = 5;
                                    }
                                }else{
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before >= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before > $number2){
                                        $score_before = 1 + (($number1-$result_before)/($number1 - $number2));
                                    }elseif($result_before > $number3){
                                        $score_before = 2 + (($number2-$result_before)/($number2 - $number3));
                                    }elseif($result_before > $number4){
                                        $score_before = 3 + (($number3-$result_before)/($number3 - $number4));
                                    }elseif($result_before > $number5){
                                        $score_before = 4 + (($number4-$result_before)/($number4 - $number5));
                                    }elseif($result_before <= $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after >= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after > $number2){
                                        $score_after = 1 + (($number1-$result_after)/($number1 - $number2));
                                    }elseif($result_after > $number3){
                                        $score_after = 2 + (($number2-$result_after)/($number2 - $number3));
                                    }elseif($result_after > $number4){
                                        $score_after = 3 + (($number3-$result_after)/($number3 - $number4));
                                    }elseif($result_after > $number5){
                                        $score_after = 4 + (($number4-$result_after)/($number4 - $number5));
                                    }elseif($result_after <= $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month >= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month > $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month > $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month > $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 5;
                                    }
                                }
                                
                                $score_total    += $row->IWJPL_SCORE_A;
                                $weight_total   += $row->IWJPL_WEIGHT_B;
                                $multiply_total += $row->IWJPL_MULTIPLY_AB;

                                $score_before_total   += $score_before;
                                $score_after_total    += $score_after;
                                $score_12month_total  += $score_12month;
                                $result_before_total  += $result_before;
                                $result_after_total   += $result_after;
                                $result_12month_total += $result_12month;
                                $multiply_before    += $score_before * $row->IWJPL_WEIGHT_B;
                                $multiply_after     += $score_after * $row->IWJPL_WEIGHT_B;
                                $multiply_12month   += $score_12month * $row->IWJPL_WEIGHT_B;

                        ?>
                        <tr>
                            <td>{{++$number}} <input type="hidden" name="list_id[]"
                                    value="{{$row->IWJOB_PERSON_LIST_ID}}"></td>
                            <td class="text-left fs-12">{{$row->IWKPI_NAME}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_1}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_2}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_3}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_4}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_5}}</td>
                            <td class="bg-white">{{number_format($score_before,2)}}</td>
                            <td class="bg-white">{{number_format($score_after,2)}}</td>
                            <td class="bg-white">{{number_format($score_12month,2)}}</td>
                            <td >{{$row->IWJPL_SCORE_A}}</td>
                            <td class=" p-0">{{$row->IWJPL_WEIGHT_B}}</td>
                            <td >{{$row->IWJPL_MULTIPLY_AB}}</td>
                            <td class=" p-0">{{$row->IWJPL_TARGET}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_10}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_11}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_12}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_1}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_2}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_3}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_4}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_5}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_6}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_7}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_8}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_9}}</td>
                            <td class="bg-white">{{number_format($result_before,2)}}</td>
                            <td class="bg-white">{{number_format($result_after,2)}}</td>
                            <td class="bg-white">{{number_format($result_12month,2)}}</td>
                        </tr>
                        @endforeach
                        <?php
                            // สูตร (((คะแนนได้ * น้ำหนัก) + (คะแนนได้ n * น้ำหนัก n) + n) / ((คะแนนเต็ม * น้ำหนัก) + (คะแนนเต็ม n * น้ำหนัก n) + n))*100

                        ?>
                    </tbody>
                    <tfoot class="bg-sl-header customfooter">
                        <tr>
                            <td class="text-center" colspan="10">รวม</td>
                            <td class="text-center" id="_score_sum">{{$score_total}}</td>
                            <td class="text-center" id="_weight_sum">{{$weight_total}}</td>
                            <td class="text-center">{{$multiply_total}}</td>
                            <td class="text-center" colspan="13">รวม</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_before_total,2)}}</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_after_total,2)}}</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_12month_total,2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">6 เดือนแรก : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_before/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">6 เดือนหลัง : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_after/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">12 เดือน : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_12month/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>





            @elseif($estimate_type == "estimate_6_month_before")
            <div class="table-responsive">
                <table width="100%" border="1px">
                    <thead class="bg-sl-header" style="border-bottom:2px solid;border-top:5px solid;">
                        <tr>
                            <th width="5%" rowspan="2">ลำดับ</th>
                            <th width="25%" rowspan="2">ตัวขี้วัดผลงาน</th>
                            <th width="10%" colspan="5">ลำดับ</th>
                            <th width="5%" rowspan="2">คะแนน<br>(10-3)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(ก)</th>
                            <th width="5%" rowspan="2">น้ำหนัก<br>(ข)</th>
                            <th width="7%" rowspan="2">ผลรวม<br>(ค)=กxข</th>
                            <th width="5%" rowspan="2">เป้า</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนแรก</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(10-3)</th>
                        </tr>
                        <tr>
                            <th width="2%" style="background:red;">1</th>
                            <th width="2%" style="background:#fefe00;">2</th>
                            <th width="2%" style="background:#fe9900;">3</th>
                            <th width="2%" style="background:#00fe00;">4</th>
                            <th width="2%" style="background:#00fefe;">5</th>
                            <th style="background:#6d9eeb;">ต.ค.</th>
                            <th style="background:#6d9eeb;">พ.ย.</th>
                            <th style="background:#6d9eeb;">ธ.ค.</th>
                            <th style="background:#6d9eeb;">ม.ค.</th>
                            <th style="background:#6d9eeb;">ก.พ.</th>
                            <th style="background:#6d9eeb;">มี.ค.</th>
                        </tr>
                    </thead>
                    <tbody class="bg-sl-header text-center fs-10 padding-custom">
                        <?php
                                $number = 0;
                                $score_total = 0;
                                $weight_total = 0;
                                $multiply_total = 0;
                                $result_before_total  = 0;
                                $result_after_total   = 0;
                                $result_12month_total = 0;
                                $score_before_total   = 0;
                                $score_after_total    = 0;
                                $score_12month_total  = 0;
                                $multiply_before      = 0;
                                $multiply_after       = 0;
                                $multiply_12month     = 0;
                            ?>
                        @foreach($job_person_list as $row)
                        <?php
                                $before    =   [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3];
                                $after      =   [$row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];  
                                $_12month   =  [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3,
                                                $row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];
                                if($row->IWJPL_TYPE_CALCULATE == "calc_avg"){
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_max"){
                                    $result_before  = max($before);
                                    $result_after   = max($after);
                                    $result_12month = max($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_last"){
                                    $result_before  = $before[count($before)-1];
                                    $result_after   = $after[count($after)-1];
                                    $result_12month = $_12month[count($_12month)-1];
                                }else{
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }
                                // คำนวณคะแนน
                                $number1 = $row->IWJPL_NUMBER_1;
                                $number2 = $row->IWJPL_NUMBER_2;
                                $number3 = $row->IWJPL_NUMBER_3;
                                $number4 = $row->IWJPL_NUMBER_4;
                                $number5 = $row->IWJPL_NUMBER_5;
                                if($number1 < $number2){
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before <= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before <= $number2){
                                        $score_before = 1 + (($result_before-$number1)/($number2 - $number1));
                                    }elseif($result_before <= $number3){
                                        $score_before = 2 + (($result_before-$number2)/($number3 - $number2));
                                    }elseif($result_before <= $number4){
                                        $score_before = 3 + (($result_before-$number3)/($number4 - $number3));
                                    }elseif($result_before <= $number5){
                                        $score_before = 4 + (($result_before-$number4)/($number5 - $number4));
                                    }elseif($result_before > $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after <= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after <= $number2){
                                        $score_after = 1 + (($result_after-$number1)/($number2 - $number1));
                                    }elseif($result_after <= $number3){
                                        $score_after = 2 + (($result_after-$number2)/($number3 - $number2));
                                    }elseif($result_after <= $number4){
                                        $score_after = 3 + (($result_after-$number3)/($number4 - $number3));
                                    }elseif($result_after <= $number5){
                                        $score_after = 4 + (($result_after-$number4)/($number5 - $number4));
                                    }elseif($result_after > $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }else{
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before >= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before >= $number2){
                                        $score_before = 1 + (($number1-$result_before)/($number1 - $number2));
                                    }elseif($result_before >= $number3){
                                        $score_before = 2 + (($number2-$result_before)/($number2 - $number3));
                                    }elseif($result_before >= $number4){
                                        $score_before = 3 + (($number3-$result_before)/($number3 - $number4));
                                    }elseif($result_before >= $number5){
                                        $score_before = 4 + (($number4-$result_before)/($number4 - $number5));
                                    }elseif($result_before < $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after >= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after >= $number2){
                                        $score_after = 1 + (($number1-$result_after)/($number1 - $number2));
                                    }elseif($result_after >= $number3){
                                        $score_after = 2 + (($number2-$result_after)/($number2 - $number3));
                                    }elseif($result_after >= $number4){
                                        $score_after = 3 + (($number3-$result_after)/($number3 - $number4));
                                    }elseif($result_after >= $number5){
                                        $score_after = 4 + (($number4-$result_after)/($number4 - $number5));
                                    }elseif($result_after < $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }
                                
                                $score_total    += $row->IWJPL_SCORE_A;
                                $weight_total   += $row->IWJPL_WEIGHT_B;
                                $multiply_total += $row->IWJPL_MULTIPLY_AB;

                                $score_before_total   += $score_before;
                                $score_after_total    += $score_after;
                                $score_12month_total  += $score_12month;
                                $result_before_total  += $result_before;
                                $result_after_total   += $result_after;
                                $result_12month_total += $result_12month;
                                $multiply_before    += $score_before * $row->IWJPL_WEIGHT_B;
                                $multiply_after     += $score_after * $row->IWJPL_WEIGHT_B;
                                $multiply_12month   += $score_12month * $row->IWJPL_WEIGHT_B;

                        ?>
                        <tr>
                            <td>{{++$number}} <input type="hidden" name="list_id[]"
                                    value="{{$row->IWJOB_PERSON_LIST_ID}}"></td>
                            <td class="text-left fs-12">{{$row->IWKPI_NAME}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_1}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_2}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_3}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_4}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_5}}</td>
                            <td class="bg-white">{{number_format($score_before,2)}}</td>
                            <td >{{$row->IWJPL_SCORE_A}}</td>
                            <td class=" p-0">{{$row->IWJPL_WEIGHT_B}}</td>
                            <td >{{$row->IWJPL_MULTIPLY_AB}}</td>
                            <td class=" p-0">{{$row->IWJPL_TARGET}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_10}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_11}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_12}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_1}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_2}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_3}}</td>
                            <td class="bg-white">{{number_format($result_before,2)}}</td>
                        </tr>
                        @endforeach
                        <?php
                            // สูตร (((คะแนนได้ * น้ำหนัก) + (คะแนนได้ n * น้ำหนัก n) + ...) / ((คะแนนเต็ม * น้ำหนัก) + (คะแนนเต็ม n * น้ำหนัก n) + n))*100

                        ?>
                    </tbody>
                    <tfoot class="bg-sl-header customfooter">
                        <tr>
                            <td class="text-center" colspan="8">รวม</td>
                            <td class="text-center" id="_score_sum">{{$score_total}}</td>
                            <td class="text-center" id="_weight_sum">{{$weight_total}}</td>
                            <td class="text-center">{{$multiply_total}}</td>
                            <td class="text-center" colspan="7">รวม</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_before_total,2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="10">6 เดือนแรก : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_before/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>




            @elseif($estimate_type == "estimate_6_month_after")
            <div class="table-responsive">
                <table width="100%" border="1px">
                    <thead class="bg-sl-header" style="border-bottom:2px solid;border-top:5px solid;">
                        <tr>
                            <th width="5%" rowspan="2">ลำดับ</th>
                            <th width="25%" rowspan="2">ตัวขี้วัดผลงาน</th>
                            <th width="10%" colspan="5">ลำดับ</th>
                            <th width="5%" rowspan="2">คะแนน<br>(4-9)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(ก)</th>
                            <th width="5%" rowspan="2">น้ำหนัก<br>(ข)</th>
                            <th width="7%" rowspan="2">ผลรวม<br>(ค)=กxข</th>
                            <th width="5%" rowspan="2">เป้า</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนหลัง</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(4-9)</th>
                        </tr>
                        <tr>
                            <th width="2%" style="background:red;">1</th>
                            <th width="2%" style="background:#fefe00;">2</th>
                            <th width="2%" style="background:#fe9900;">3</th>
                            <th width="2%" style="background:#00fe00;">4</th>
                            <th width="2%" style="background:#00fefe;">5</th>
                            <th style="background:#6d9eeb;">เม.ย.</th>
                            <th style="background:#6d9eeb;">พ.ค.</th>
                            <th style="background:#6d9eeb;">มิ.ย</th>
                            <th style="background:#6d9eeb;">ก.ค.</th>
                            <th style="background:#6d9eeb;">ส.ค.</th>
                            <th style="background:#6d9eeb;">ก.ย.</th>
                        </tr>
                    </thead>
                    <tbody class="bg-sl-header text-center fs-10 padding-custom">
                        <?php
                                $number = 0;
                                $score_total = 0;
                                $weight_total = 0;
                                $multiply_total = 0;
                                $result_before_total  = 0;
                                $result_after_total   = 0;
                                $result_12month_total = 0;
                                $score_before_total   = 0;
                                $score_after_total    = 0;
                                $score_12month_total  = 0;
                                $multiply_before      = 0;
                                $multiply_after       = 0;
                                $multiply_12month     = 0;
                            ?>
                        @foreach($job_person_list as $row)
                        <?php
                                $before    =   [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3];
                                $after      =   [$row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];  
                                $_12month   =  [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3,
                                                $row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];
                                if($row->IWJPL_TYPE_CALCULATE == "calc_avg"){
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_max"){
                                    $result_before  = max($before);
                                    $result_after   = max($after);
                                    $result_12month = max($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_last"){
                                    $result_before  = $before[count($before)-1];
                                    $result_after   = $after[count($after)-1];
                                    $result_12month = $_12month[count($_12month)-1];
                                }else{
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }
                                // คำนวณคะแนน
                                $number1 = $row->IWJPL_NUMBER_1;
                                $number2 = $row->IWJPL_NUMBER_2;
                                $number3 = $row->IWJPL_NUMBER_3;
                                $number4 = $row->IWJPL_NUMBER_4;
                                $number5 = $row->IWJPL_NUMBER_5;
                                if($number1 < $number2){
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before <= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before <= $number2){
                                        $score_before = 1 + (($result_before-$number1)/($number2 - $number1));
                                    }elseif($result_before <= $number3){
                                        $score_before = 2 + (($result_before-$number2)/($number3 - $number2));
                                    }elseif($result_before <= $number4){
                                        $score_before = 3 + (($result_before-$number3)/($number4 - $number3));
                                    }elseif($result_before <= $number5){
                                        $score_before = 4 + (($result_before-$number4)/($number5 - $number4));
                                    }elseif($result_before > $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after <= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after <= $number2){
                                        $score_after = 1 + (($result_after-$number1)/($number2 - $number1));
                                    }elseif($result_after <= $number3){
                                        $score_after = 2 + (($result_after-$number2)/($number3 - $number2));
                                    }elseif($result_after <= $number4){
                                        $score_after = 3 + (($result_after-$number3)/($number4 - $number3));
                                    }elseif($result_after <= $number5){
                                        $score_after = 4 + (($result_after-$number4)/($number5 - $number4));
                                    }elseif($result_after > $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }else{
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before >= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before >= $number2){
                                        $score_before = 1 + (($number1-$result_before)/($number1 - $number2));
                                    }elseif($result_before >= $number3){
                                        $score_before = 2 + (($number2-$result_before)/($number2 - $number3));
                                    }elseif($result_before >= $number4){
                                        $score_before = 3 + (($number3-$result_before)/($number3 - $number4));
                                    }elseif($result_before >= $number5){
                                        $score_before = 4 + (($number4-$result_before)/($number4 - $number5));
                                    }elseif($result_before < $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after >= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after >= $number2){
                                        $score_after = 1 + (($number1-$result_after)/($number1 - $number2));
                                    }elseif($result_after >= $number3){
                                        $score_after = 2 + (($number2-$result_after)/($number2 - $number3));
                                    }elseif($result_after >= $number4){
                                        $score_after = 3 + (($number3-$result_after)/($number3 - $number4));
                                    }elseif($result_after >= $number5){
                                        $score_after = 4 + (($number4-$result_after)/($number4 - $number5));
                                    }elseif($result_after < $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }
                                
                                $score_total    += $row->IWJPL_SCORE_A;
                                $weight_total   += $row->IWJPL_WEIGHT_B;
                                $multiply_total += $row->IWJPL_MULTIPLY_AB;

                                $score_before_total   += $score_before;
                                $score_after_total    += $score_after;
                                $score_12month_total  += $score_12month;
                                $result_before_total  += $result_before;
                                $result_after_total   += $result_after;
                                $result_12month_total += $result_12month;
                                $multiply_before    += $score_before * $row->IWJPL_WEIGHT_B;
                                $multiply_after     += $score_after * $row->IWJPL_WEIGHT_B;
                                $multiply_12month   += $score_12month * $row->IWJPL_WEIGHT_B;

                        ?>
                        <tr>
                            <td>{{++$number}} <input type="hidden" name="list_id[]"
                                    value="{{$row->IWJOB_PERSON_LIST_ID}}"></td>
                            <td class="text-left fs-12">{{$row->IWKPI_NAME}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_1}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_2}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_3}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_4}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_5}}</td>
                            <td class="bg-white">{{number_format($score_after,2)}}</td>
                            <td >{{$row->IWJPL_SCORE_A}}</td>
                            <td class=" p-0">{{$row->IWJPL_WEIGHT_B}}</td>
                            <td >{{$row->IWJPL_MULTIPLY_AB}}</td>
                            <td class=" p-0">{{$row->IWJPL_TARGET}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_4}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_5}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_6}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_7}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_8}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_9}}</td>
                            <td class="bg-white">{{number_format($result_after,2)}}</td>
                        </tr>
                        @endforeach
                        <?php
                            // สูตร (((คะแนนได้ * น้ำหนัก) + (คะแนนได้ n * น้ำหนัก n) + n) / ((คะแนนเต็ม * น้ำหนัก) + (คะแนนเต็ม n * น้ำหนัก n) + n))*100

                        ?>
                    </tbody>
                    <tfoot class="bg-sl-header customfooter">
                        <tr>
                            <td class="text-center" colspan="8">รวม</td>
                            <td class="text-center" id="_score_sum">{{$score_total}}</td>
                            <td class="text-center" id="_weight_sum">{{$weight_total}}</td>
                            <td class="text-center">{{$multiply_total}}</td>
                            <td class="text-center" colspan="7">รวม</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_after_total,2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="10">6 เดือนหลัง : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_after/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="14"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>




            @elseif($estimate_type == "estimate_12_month")
            <div class="table-responsive">
                <table width="100%" border="1px">
                    <thead class="bg-sl-header" style="border-bottom:2px solid;border-top:5px solid;">
                        <tr>
                            <th width="5%" rowspan="2">ลำดับ</th>
                            <th width="25%" rowspan="2">ตัวขี้วัดผลงาน</th>
                            <th width="10%" colspan="5">ลำดับ</th>
                            <th width="5%" rowspan="2">คะแนน<br>(12m)</th>
                            <th width="5%" rowspan="2">คะแนน<br>(ก)</th>
                            <th width="5%" rowspan="2">น้ำหนัก<br>(ข)</th>
                            <th width="7%" rowspan="2">ผลรวม<br>(ค)=กxข</th>
                            <th width="5%" rowspan="2">เป้า</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนแรก</th>
                            <th width="15%" colspan="6">ผลงานรอบ 6 เดือนหลัง</th>
                            <th width="5%" rowspan="2">สรุปผลงาน<br>(12m)</th>
                        </tr>
                        <tr>
                            <th width="2%" style="background:red;">1</th>
                            <th width="2%" style="background:#fefe00;">2</th>
                            <th width="2%" style="background:#fe9900;">3</th>
                            <th width="2%" style="background:#00fe00;">4</th>
                            <th width="2%" style="background:#00fefe;">5</th>
                            <th style="background:#6d9eeb;">ต.ค.</th>
                            <th style="background:#6d9eeb;">พ.ย.</th>
                            <th style="background:#6d9eeb;">ธ.ค.</th>
                            <th style="background:#6d9eeb;">ม.ค.</th>
                            <th style="background:#6d9eeb;">ก.พ.</th>
                            <th style="background:#6d9eeb;">มี.ค.</th>
                            <th style="background:#6d9eeb;">เม.ย.</th>
                            <th style="background:#6d9eeb;">พ.ค.</th>
                            <th style="background:#6d9eeb;">มิ.ย</th>
                            <th style="background:#6d9eeb;">ก.ค.</th>
                            <th style="background:#6d9eeb;">ส.ค.</th>
                            <th style="background:#6d9eeb;">ก.ย.</th>
                        </tr>
                    </thead>
                    <tbody class="bg-sl-header text-center fs-10 padding-custom">
                        <?php
                                $number = 0;
                                $score_total = 0;
                                $weight_total = 0;
                                $multiply_total = 0;
                                $result_before_total  = 0;
                                $result_after_total   = 0;
                                $result_12month_total = 0;
                                $score_before_total   = 0;
                                $score_after_total    = 0;
                                $score_12month_total  = 0;
                                $multiply_before      = 0;
                                $multiply_after       = 0;
                                $multiply_12month     = 0;
                            ?>
                        @foreach($job_person_list as $row)
                        <?php
                                $before    =   [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3];
                                $after      =   [$row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];  
                                $_12month   =  [$row->IWJPL_PERFORMANCE_10, 
                                                $row->IWJPL_PERFORMANCE_11,
                                                $row->IWJPL_PERFORMANCE_12,
                                                $row->IWJPL_PERFORMANCE_1,
                                                $row->IWJPL_PERFORMANCE_2,
                                                $row->IWJPL_PERFORMANCE_3,
                                                $row->IWJPL_PERFORMANCE_4,
                                                $row->IWJPL_PERFORMANCE_5,
                                                $row->IWJPL_PERFORMANCE_6,
                                                $row->IWJPL_PERFORMANCE_7,
                                                $row->IWJPL_PERFORMANCE_8,
                                                $row->IWJPL_PERFORMANCE_9];
                                if($row->IWJPL_TYPE_CALCULATE == "calc_avg"){
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_max"){
                                    $result_before  = max($before);
                                    $result_after   = max($after);
                                    $result_12month = max($_12month);
                                }else if($row->IWJPL_TYPE_CALCULATE == "calc_last"){
                                    $result_before  = $before[count($before)-1];
                                    $result_after   = $after[count($after)-1];
                                    $result_12month = $_12month[count($_12month)-1];
                                }else{
                                    $result_before  = array_sum($before)/count($before);
                                    $result_after   = array_sum($after)/count($after);
                                    $result_12month = array_sum($_12month)/count($_12month);
                                }
                                // คำนวณคะแนน
                                $number1 = $row->IWJPL_NUMBER_1;
                                $number2 = $row->IWJPL_NUMBER_2;
                                $number3 = $row->IWJPL_NUMBER_3;
                                $number4 = $row->IWJPL_NUMBER_4;
                                $number5 = $row->IWJPL_NUMBER_5;
                                if($number1 < $number2){
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before <= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before <= $number2){
                                        $score_before = 1 + (($result_before-$number1)/($number2 - $number1));
                                    }elseif($result_before <= $number3){
                                        $score_before = 2 + (($result_before-$number2)/($number3 - $number2));
                                    }elseif($result_before <= $number4){
                                        $score_before = 3 + (($result_before-$number3)/($number4 - $number3));
                                    }elseif($result_before <= $number5){
                                        $score_before = 4 + (($result_before-$number4)/($number5 - $number4));
                                    }elseif($result_before > $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after <= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after <= $number2){
                                        $score_after = 1 + (($result_after-$number1)/($number2 - $number1));
                                    }elseif($result_after <= $number3){
                                        $score_after = 2 + (($result_after-$number2)/($number3 - $number2));
                                    }elseif($result_after <= $number4){
                                        $score_after = 3 + (($result_after-$number3)/($number4 - $number3));
                                    }elseif($result_after <= $number5){
                                        $score_after = 4 + (($result_after-$number4)/($number5 - $number4));
                                    }elseif($result_after > $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }else{
                                    // คำนวณ 6 เดือนแรก
                                    if($result_before >= $number1){
                                        $score_before = 1 ;
                                    }elseif($result_before >= $number2){
                                        $score_before = 1 + (($number1-$result_before)/($number1 - $number2));
                                    }elseif($result_before >= $number3){
                                        $score_before = 2 + (($number2-$result_before)/($number2 - $number3));
                                    }elseif($result_before >= $number4){
                                        $score_before = 3 + (($number3-$result_before)/($number3 - $number4));
                                    }elseif($result_before >= $number5){
                                        $score_before = 4 + (($number4-$result_before)/($number4 - $number5));
                                    }elseif($result_before < $number5){
                                        $score_before = 5;
                                    }
                                    // คำนวณ 6 เดือนหลัง
                                    if($result_after >= $number1){
                                        $score_after = 1 ;
                                    }elseif($result_after >= $number2){
                                        $score_after = 1 + (($number1-$result_after)/($number1 - $number2));
                                    }elseif($result_after >= $number3){
                                        $score_after = 2 + (($number2-$result_after)/($number2 - $number3));
                                    }elseif($result_after >= $number4){
                                        $score_after = 3 + (($number3-$result_after)/($number3 - $number4));
                                    }elseif($result_after >= $number5){
                                        $score_after = 4 + (($number4-$result_after)/($number4 - $number5));
                                    }elseif($result_after < $number5){
                                        $score_after = 5;
                                    }
                                    // คำนวณ 12 เดือน
                                    if($result_12month <= $number1){
                                        $score_12month = 1 ;
                                    }elseif($result_12month <= $number2){
                                        $score_12month = 1 + (($result_12month-$number1)/($number2 - $number1));
                                    }elseif($result_12month <= $number3){
                                        $score_12month = 2 + (($result_12month-$number2)/($number3 - $number2));
                                    }elseif($result_12month <= $number4){
                                        $score_12month = 3 + (($result_12month-$number3)/($number4 - $number3));
                                    }elseif($result_12month <= $number5){
                                        $score_12month = 4 + (($result_12month-$number4)/($number5 - $number4));
                                    }elseif($result_12month > $number5){
                                        $score_12month = 5;
                                    }
                                }
                                
                                $score_total    += $row->IWJPL_SCORE_A;
                                $weight_total   += $row->IWJPL_WEIGHT_B;
                                $multiply_total += $row->IWJPL_MULTIPLY_AB;

                                $score_before_total   += $score_before;
                                $score_after_total    += $score_after;
                                $score_12month_total  += $score_12month;
                                $result_before_total  += $result_before;
                                $result_after_total   += $result_after;
                                $result_12month_total += $result_12month;
                                $multiply_before    += $score_before * $row->IWJPL_WEIGHT_B;
                                $multiply_after     += $score_after * $row->IWJPL_WEIGHT_B;
                                $multiply_12month   += $score_12month * $row->IWJPL_WEIGHT_B;

                        ?>
                        <tr>
                            <td>{{++$number}} <input type="hidden" name="list_id[]"
                                    value="{{$row->IWJOB_PERSON_LIST_ID}}"></td>
                            <td class="text-left fs-12">{{$row->IWKPI_NAME}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_1}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_2}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_3}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_4}}</td>
                            <td class=" p-0">{{$row->IWJPL_NUMBER_5}}</td>
                            <td class="bg-white">{{number_format($score_12month,2)}}</td>
                            <td >{{$row->IWJPL_SCORE_A}}</td>
                            <td class=" p-0">{{$row->IWJPL_WEIGHT_B}}</td>
                            <td >{{$row->IWJPL_MULTIPLY_AB}}</td>
                            <td class=" p-0">{{$row->IWJPL_TARGET}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_10}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_11}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_12}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_1}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_2}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_3}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_4}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_5}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_6}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_7}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_8}}</td>
                            <td class="bg-white p-0">{{$row->IWJPL_PERFORMANCE_9}}</td>
                            <td class="bg-white">{{number_format($result_12month,2)}}</td>
                        </tr>
                        @endforeach
                        <?php
                            // สูตร (((คะแนนได้ * น้ำหนัก) + (คะแนนได้ n * น้ำหนัก n) + n) / ((คะแนนเต็ม * น้ำหนัก) + (คะแนนเต็ม n * น้ำหนัก n) + n))*100
                        ?>
                    </tbody>
                    <tfoot class="bg-sl-header customfooter">
                        <tr>
                            <td class="text-center" colspan="8">รวม</td>
                            <td class="text-center" id="_score_sum">{{$score_total}}</td>
                            <td class="text-center" id="_weight_sum">{{$weight_total}}</td>
                            <td class="text-center">{{$multiply_total}}</td>
                            <td class="text-center" colspan="13">รวม</td>
                            <td class="text-center bg-white" id="_score_sum">{{number_format($result_12month_total,2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="10">12 เดือน : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center bg-white">{{number_format(($multiply_12month/$multiply_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>




            @endif
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
<!-- <script src="{{ asset('select2/select2.min.js') }}"></script> -->
<!-- sweet alert2 -->
<script src="{{asset('asset/js/plugins/es6-promise/es6-promise.auto.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- notify -->
<script src="{{asset('asset/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script>
    let sum_score = $('#_score_sum');
    let sum_weight = $('#_weight_sum');
    let sum_multiply_ab = $('#_multiply_ab_sum');

    function update_number(row) {
        update_score_sum(row);
        update_total(row);
    }

    //อัพเดตสกอแต่ละแถวโดย และอัพเดตผลรวมคะแนน
    function update_score_sum(row) {
        update_score(row);
        let sum = 0;
        $('._score').each((index, ele) => {
            console.log(ele.innerHTML);
            sum += parseFloat(ele.innerHTML);
        })
        sum_score.html(sum);
    }

    function update_score(row) {
        let num1 = parseFloat($('#number1_' + row).val());
        let num2 = parseFloat($('#number2_' + row).val());
        let num3 = parseFloat($('#number3_' + row).val());
        let num4 = parseFloat($('#number4_' + row).val());
        let num5 = parseFloat($('#number5_' + row).val());
        let score = $('#score_' + row);
        if (!isNaN(num1) && num1 != 0) {
            score.html(1);
        } else {
            return false;
        }
        if (!isNaN(num2) && num2 != 0) {
            score.html(2);
        } else {
            return false;
        }
        if (!isNaN(num3) && num3 != 0) {
            score.html(3);
        } else {
            return false;
        }
        if (!isNaN(num4) && num4 != 0) {
            score.html(4);
        } else {
            return false;
        }
        if (!isNaN(num5) && num5 != 0) {
            score.html(5);
        } else {
            return false;
        }
    }

    // อัพเดตผลรวม กข รายแถว และผลรวมน้ำหนัก และผลรวมก*ข ทั้งหมด
    function update_total(row) {
        $('#multiply_ab_' + row).html($('#score_' + row).html() * $('#weight_' + row).val())
        let sum = 0;
        $('._weight').each((index, ele) => {
            console.log(ele.value);
            sum += parseFloat(ele.value);
        })
        sum_weight.html(sum);

        sum = 0;
        $('._multiply_ab').each((index, ele) => {
            console.log(ele.innerHTML);
            sum += parseFloat(ele.innerHTML);
        })
        sum_multiply_ab.html(sum);
    }

    @if(Session::has('scc_notify'))
    jQuery(function () {
        Dashmix.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: '{{session("scc_notify")}}'
        })
    });
    @endif

    @if(Session::has('scc'))
    Swal.fire("{{session('scc')}}", "<?=session('scc_msg')?>", 'success')
    @endif
    @if(Session::has('err'))
    Swal.fire("{{session('err')}}", "<?=session('err_msg')?>", 'error')
    @endif
</script>
@endsection