@extends('layouts.general.person_work')
@section('css_after_infowork')
    <style>
        .padding-custom td{
            padding-top:4px;
            padding-right:4px;
            padding-bottom:4px;
            padding-left:4px;
        }
        .bg-sl-header{
            background:#fee599;
        }
    </style>
    
<style>
    .t-content td{
        padding : 5px;
    }
    .padding-custom td{
        padding-top:4px;
        padding-right:4px;
        padding-bottom:4px;
        padding-left:4px;
    }
    .bg-sl-header{
        background:#fee599;
    }
    .customfooter td{
        font-size:16px !important;
        font-weight:bolder;
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

    .border-none{
        border:none;
    }

    .outline-none{
        outline: none;
    };
    .input-yellow{
        
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
            <form class="block-title form-group row" action="" method="post">
                <div class="col-sm-2"><b>ตัวชี้วัดรายบุคคล</b></div>
                <div class="col-sm-3">
                    <select type="text" class="form-control fs-16 f-kanit" name="budgetyear" id="budgetyear">
                        @foreach(getBudgetYearAmount() as $value)
                        <option value="{{$value}}">ปีงบประมาณ {{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary fs-16">แสดง</button>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <form action="{{route('pwork.user_update_kpi',Auth::user()->PERSON_ID)}}" method="post">
            @csrf
                <table width="100%" border="1px" >
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
                            use App\Http\Controllers\AbilityController;
                            $number = 1;
                            $score_a_total      = 0;
                            $weight_b_total     = 0;
                            $multiply_ab_total  = 0;
                            $result_10_to_3     = 0;
                            $result_4_to_9      = 0;
                            $result             = 0;
                            $multiply_10_3_total  = 0;
                            $multiply_4_9_total   = 0;
                            $multiply_all_total   = 0;
                        ?>
                        @foreach($job as $job_h)
                            <?php 
                                $kpi = AbilityController::getKpi($job_h->IWJOB_PERSON_ID);
                            ?>
                            @foreach($kpi as $kpi_list) 
                            <?php
                                $score_a_total      += $kpi_list->IWJPL_SCORE_A;
                                $weight_b_total     += $kpi_list->IWJPL_WEIGHT_B;
                                $multiply_ab_total  += $kpi_list->IWJPL_MULTIPLY_AB;
                                $result_10_to_3 +=  $kpi_list->IWJPL_PERFORMANCE_AVG_10_TO_3;
                                $result_4_to_9  +=  $kpi_list->IWJPL_PERFORMANCE_AVG_4_TO_9;
                                $result         +=  $kpi_list->IWJPL_PERFORMANCE_AVG;
                                $multiply_10_3_total  += $kpi_list->IWJPL_WEIGHT_B * $kpi_list->IWJPL_SCORE_RESULT_10_TO_3;
                                $multiply_4_9_total   += $kpi_list->IWJPL_WEIGHT_B * $kpi_list->IWJPL_SCORE_RESULT_4_TO_9;
                                $multiply_all_total   += $kpi_list->IWJPL_WEIGHT_B * $kpi_list->IWJPL_SCORE_RESULT_ALL;
                            ?>
                            <tr>
                                <td>{{$number++}}</td>
                                <td class="text-left fs-12">{{$kpi_list->IWKPI_NAME}}</td>
                                <td >{{$kpi_list->IWJPL_NUMBER_1}}</td>
                                <td >{{$kpi_list->IWJPL_NUMBER_2}}</td>
                                <td >{{$kpi_list->IWJPL_NUMBER_3}}</td>
                                <td >{{$kpi_list->IWJPL_NUMBER_4}}</td>
                                <td >{{$kpi_list->IWJPL_NUMBER_5}}</td>
                                <td style="background:#fff8e4;">{{$kpi_list->IWJPL_SCORE_RESULT_10_TO_3}}</td>
                                <td style="background:#fff8e4;">{{$kpi_list->IWJPL_SCORE_RESULT_4_TO_9}}</td>
                                <td style="background:#fff8e4;">{{$kpi_list->IWJPL_SCORE_RESULT_ALL}}</td>
                                <td >{{$kpi_list->IWJPL_SCORE_A}}</td>
                                <td >{{$kpi_list->IWJPL_WEIGHT_B}}</td>
                                <td>{{$kpi_list->IWJPL_MULTIPLY_AB}}</td>
                                <td>{{$kpi_list->IWJPL_TARGET}}</td>
                                <input type="hidden" name="id_kpi[]" value="{{$kpi_list->IWJOB_PERSON_LIST_ID}}">
                                <?php
                                    $bgwhite1     = '';
                                    $readonly1  = 'readonly';
                                    $bgyellow1   = 'background:#fee599 !important;outline: none;'; 
                                    if(empty($job_h->IWJP_ASSESSOR_ID_1)){
                                        $bgwhite1 = 'bg-white';
                                        $readonly1 = '';
                                        $bgyellow1 = '';
                                    }
                                ?>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_10[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_10}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_11[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_11}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_12[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_12}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_1[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_1}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_2[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_2}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite1}} p-0"><input name="performance_3[]" {{$readonly1}} class="fs-12 text-center border-none " type="number" style="width:100%;{{$bgyellow1}}" value="{{$kpi_list->IWJPL_PERFORMANCE_3}}" step="0.01" min="0" max="100"></td>
                                <?php
                                    $bgwhite2     = '';
                                    $readonly2  = 'readonly';
                                    $bgyellow2   = 'background:#fee599 !important;outline: none;'; 
                                    if(empty($job_h->IWJP_ASSESSOR_ID_2)){
                                        $bgwhite2 = 'bg-white';
                                        $readonly2 = '';
                                        $bgyellow2 = '';
                                    }
                                ?>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_4[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_4}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_5[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_5}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_6[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_6}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_7[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_7}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_8[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_8}}" step="0.01" min="0" max="100"></td>
                                <td class="{{$bgwhite2}} p-0"><input name="performance_9[]" {{$readonly2}} class="fs-12 text-center border-none" type="number" style="width:100%;{{$bgyellow2}}" value="{{$kpi_list->IWJPL_PERFORMANCE_9}}" step="0.01" min="0" max="100"></td>
                                <td class="text-right" style="background:#fff8e4;">{{$kpi_list->IWJPL_PERFORMANCE_AVG_10_TO_3}}</td>
                                <td class="text-right" style="background:#fff8e4;">{{$kpi_list->IWJPL_PERFORMANCE_AVG_4_TO_9}}</td>
                                <td class="text-right" style="background:#fff8e4;">{{$kpi_list->IWJPL_PERFORMANCE_AVG}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot class="bg-sl-header customfooter">
                        <tr>
                            <td class="text-center" colspan="10">รวม</td>
                            <td class="text-center" style="background:#ffbf4b;" id="_score_sum">{{$score_a_total}}</td>
                            <td class="text-center" style="background:#ffbf4b;" id="_weight_sum">{{$weight_b_total}}</td>
                            <td class="text-center" style="background:#ffbf4b;">{{$multiply_ab_total}}</td>
                            <td class="text-center" colspan="13">รวม</td>
                            <td class="text-center p-1" id="_score_sum" style="background:#ffbf4b;">{{number_format($result_10_to_3,2)}}</td>
                            <td class="text-center p-1" id="_score_sum" style="background:#ffbf4b;">{{number_format($result_4_to_9,2)}}</td>
                            <td class="text-center p-1" id="_score_sum" style="background:#ffbf4b;">{{number_format($result,2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">6 เดือนแรก : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center" style="background:#ffbf4b;">{{number_format(($multiply_10_3_total/$multiply_ab_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">6 เดือนหลัง : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center" style="background:#ffbf4b;">{{number_format(($multiply_4_9_total/$multiply_ab_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="padding:5px;" colspan="12">12 เดือน : ผลสัมฤทธิ์ของงาน คิดเป็นร้อยละ</td>
                            <td class="text-center" style="background:#ffbf4b;">{{number_format(($multiply_all_total/$multiply_ab_total)*100,2)}}</td>
                            <td class="text-center" colspan="16"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row mt-2">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success">อัปเดตข้อมูล</button>
                    </div>
                </div> 
            </form>
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