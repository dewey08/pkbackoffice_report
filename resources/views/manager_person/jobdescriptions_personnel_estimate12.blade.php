@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.css')}}">

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
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title fw-5">
                ประเมิน 6 เดือนหลัง
            </div>
            <div class="block-options">
                <a href="{{route('mperson.jobdescriptions_personnel')}}" class="btn btn-info">ย้อนกลับ</a>
            </div>
        </div>
        <div class="block-content mb-3">
            <form action="{{route('mperson.jobdescriptions_personnel_estimate12_update')}}" method="post" autocomplete="false">
            @csrf()
            <input type="hidden" name="id" value="{{$job_person_list[0]->IWJOB_PERSON_ID}}">
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
                            <hr>
                            <div class="d-flex">
                                <div style="width:100px">ผู้ประเมิน รอบที่ 1</div>
                                <div style="150px">: {{$job_person_list[0]->p_a1_fname}} {{$job_person_list[0]->p_a1_lname}}</div>
                            </div>
                            <div class="d-flex">
                                <div style="width:100px">ผู้ประเมิน รอบที่ 2</div>
                                <div style="150px">: {{$job_person_list[0]->p_a2_fname}} {{$job_person_list[0]->p_a2_lname}}</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex">
                                <div style="width:140px">ผู้สร้าง job description</div>
                                <div style="150px">: {{$job_person_list[0]->p_c_fname}} {{$job_person_list[0]->p_c_lname}}</div>
                            </div>
                            <div class="d-flex">
                                <div style="width:140px">วันที่สร้าง</div>
                                <div style="150px">: {{DateThai($job_person_list[0]->created_at)}} เวลา {{date('H:i:s',strtotime($job_person_list[0]->created_at))}} น.</div>
                            </div>
                            <div class="d-flex">
                                <div style="width:140px">อัปเดตล่าสุด</div>
                                <div style="150px">: {{DateThai($job_person_list[0]->updated_at)}} เวลา {{date('H:i:s',strtotime($job_person_list[0]->updated_at))}} น.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table width="100%" border="1px" >
                        <thead class="bg-sl-header" style="border-bottom:2px solid;border-top:5px solid;">
                            <tr>
                                <th width="5%" rowspan="2">ลำดับ</th>
                                <th width="25%" rowspan="2">ตัวชี้วัดผลงาน</th>
                                <th width="10%" colspan="5">ลำดับ</th>
                                <th width="5%" rowspan="2">คะแนน<br>(ก)</th>
                                <th width="5%" rowspan="2">น้ำหนัก<br>(ข)</th>
                                <th width="7%" rowspan="2">ผลรวม<br>(ค)=กxข</th>
                                <th width="5%" rowspan="2">เป้า</th>
                                <th width="15%" colspan="6">ผลงานรอบ 6 เดือนหลัง.</th>
                              
                            </tr>
                            <tr>
                                <th width="2%" style="background:red;">1</th>
                                <th width="2%" style="background:#fefe00;">2</th>
                                <th width="2%" style="background:#fe9900;">3</th>
                                <th width="2%" style="background:#00fe00;">4</th>
                                <th width="2%" style="background:#00fefe;">5</th>
                                <th style="background:#6d9eeb;">เม.ย.</th>
                                <th style="background:#6d9eeb;">พ.ค.</th>
                                <th style="background:#6d9eeb;">ม.ย.</th>
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
                            ?>

                            @foreach($job_person_list as $row)
                            <tr>
                                <td>{{++$number}} <input type="hidden" name="list_id[]" value="{{$row->IWJOB_PERSON_LIST_ID}}"></td>
                                <td class="text-left fs-12">{{$row->IWKPI_NAME}}</td>
                                <td class="bg-white p-0">
                                    <input name="number1[]" id="number1_{{$number}}" onchange="update_number('{{$number}}')" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_NUMBER_1}}" step="0.01" min="0" max="100" required="true">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="number2[]" id="number2_{{$number}}" onchange="update_number('{{$number}}')" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_NUMBER_2}}" step="0.01" min="0" max="100" required="true">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="number3[]" id="number3_{{$number}}" onchange="update_number('{{$number}}')" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_NUMBER_3}}" step="0.01" min="0" max="100" required="true">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="number4[]" id="number4_{{$number}}" onchange="update_number('{{$number}}')" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_NUMBER_4}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="number5[]" id="number5_{{$number}}" onchange="update_number('{{$number}}')" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_NUMBER_5}}" step="0.01" min="0" max="100">
                                </td>
                                <td id="score_{{$number}}" class="_score">{{$row->IWJPL_SCORE_A}}</td>
                                <td class="bg-white p-0">
                                    <input name="weight[]" id="weight_{{$number}}" onchange="update_total('{{$number}}')" class="fs-12 text-center border-none _weight" type="number" style="width:100%" value="{{$row->IWJPL_WEIGHT_B}}" step="0.01" min="0" max="100" required="true">
                                </td>
                                <td id="multiply_ab_{{$number}}" class="_multiply_ab">{{$row->IWJPL_MULTIPLY_AB}}</td>
                                <td class="bg-white p-0">
                                    <input name="target[]" id="target_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_TARGET}}" step="0.01" min="0" max="100" required="true">
                                </td>
                               
                                <td class="bg-white p-0">
                                    <input name="performance_4[]" id="performance_4_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_4}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="performance_5[]" id="performance_5_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_5}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="performance_6[]" id="performance_6_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_6}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="performance_7[]" id="performance_7_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_7}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="performance_8[]" id="performance_8_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_8}}" step="0.01" min="0" max="100">
                                </td>
                                <td class="bg-white p-0">
                                    <input name="performance_9[]" id="performance_9_{{$number}}" class="fs-12 text-center border-none" type="number" style="width:100%" value="{{$row->IWJPL_PERFORMANCE_9}}" step="0.01" min="0" max="100">
                                </td>
                               
                            </tr>
                            <?php
                                $score_total    += $row->IWJPL_SCORE_A;
                                $weight_total   += $row->IWJPL_WEIGHT_B;
                                $multiply_total += $row->IWJPL_MULTIPLY_AB;
                            ?>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-sl-header customfooter">
                            <tr>
                                <td class="text-center" colspan="7">รวม</td>
                                <td class="text-center" id="_score_sum">{{$score_total}}</td>
                                <td class="text-center" id="_weight_sum">{{$weight_total}}</td>
                                <td class="text-center" id="_multiply_ab_sum">{{$multiply_total}}</td>
                                <td class="text-center" colspan="13"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{route('mperson.jobdescriptions_personnel')}}" onclick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')" class="btn btn-danger"><i class="fa fa-window-close mr-2"></i>ยกเลิก</a>
                </div>
            </form>
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
    function update_score_sum(row){
        update_score(row);
        let sum = 0;
        $('._score').each((index,ele)=>{
            console.log(ele.innerHTML);
            sum += parseFloat(ele.innerHTML);
        })
        sum_score.html(sum);
    }

    function update_score(row){
        let num1 = parseFloat($('#number1_'+row).val());
        let num2 = parseFloat($('#number2_'+row).val());
        let num3 = parseFloat($('#number3_'+row).val());
        let num4 = parseFloat($('#number4_'+row).val());
        let num5 = parseFloat($('#number5_'+row).val());
        let score = $('#score_'+row);
        if(!isNaN(num1) && num1 != 0){
            score.html(1);
        }else{
            return false;
        }
        if(!isNaN(num2) && num2 != 0){
            score.html(2);
        }else{
            return false;
        }
        if(!isNaN(num3) && num3 != 0){
            score.html(3);
        }else{
            return false;
        }
        if(!isNaN(num4) && num4 != 0){
            score.html(4);
        }else{
            return false;
        }
        if(!isNaN(num5) && num5 != 0){
            score.html(5);
        }else{
            return false;
        }
    }

    // อัพเดตผลรวม กข รายแถว และผลรวมน้ำหนัก และผลรวมก*ข ทั้งหมด
    function update_total(row) {
        $('#multiply_ab_'+row).html($('#score_'+row).html() * $('#weight_'+row).val())
        let sum = 0;
        $('._weight').each((index,ele)=>{
            console.log(ele.value);
            sum += parseFloat(ele.value);
        })
        sum_weight.html(sum);

        sum = 0;
        $('._multiply_ab').each((index,ele)=>{
            console.log(ele.innerHTML);
            sum += parseFloat(ele.innerHTML);
        })
        sum_multiply_ab.html(sum);
    }

    @if(Session::has('scc_notify'))
        jQuery(function () {
            Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{session("scc_notify")}}'})
        });
    @endif

    @if(Session::has('scc'))
        Swal.fire("{{session('scc')}}","<?=session('scc_msg')?>",'success')
    @endif
    @if(Session::has('err'))
        Swal.fire("{{session('err')}}","<?=session('err_msg')?>",'error')
    @endif
</script>
@endsection