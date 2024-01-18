@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title">
                แก้ไขข้อมูล KPI
            </div>
        </div>
        <div class="block-content mb-4">
            <form action="{{route('mperson.setinfo_kpi_update')}}" method="post" id="form">
                @csrf
                <input type="hidden" name="id" value="{{$infowork_kpi->IWKPI_ID}}">
                <div class="form-group row push">
                    <label for="IWKPI_NAME" class="col-sm-2 col-form-label">ชื่อ KPI <span
                            style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input class="form-control" value="{{$infowork_kpi->IWKPI_NAME}}" name="IWKPI_NAME" id="IWKPI_NAME" required>
                    </div>
                </div>
                <h5 style="border-bottom:solid #dcdcdc 1px" class="mb-1">คะแนนตามระดับค่าเป้าหมาย (ระดับ 1-5)</h5>
                <div class="form-group row push">
                    <label for="IWKPI_NUMBER_1" class="col-xl-1 col-lg-2 col-sm-3 text-center col-form-label">คะแนนระดับ
                        1 <span style="color:red">*</span></label>
                    <div class="col-xl-1 col-lg-2 col-sm-9">
                        <input class="form-control text-right number" name="IWKPI_NUMBER_1" id="IWKPI_NUMBER_1" type="number"
                            step="0.01" min="0" max="100" required placeholder="0.00" value="{{$infowork_kpi->IWKPI_NUMBER_1}}">
                    </div>
                    <label for="IWKPI_NUMBER_2" class="col-xl-1 col-lg-2 col-sm-3 text-center col-form-label">คะแนนระดับ
                        2 <span style="color:red">*</span></label>
                    <div class="col-xl-1 col-lg-2 col-sm-9">
                        <input class="form-control text-right number" name="IWKPI_NUMBER_2" id="IWKPI_NUMBER_2" type="number"
                            step="0.01" min="0" max="100" required placeholder="0.00" value="{{$infowork_kpi->IWKPI_NUMBER_2}}">
                    </div>
                    <label for="IWKPI_NUMBER_3" class="col-xl-1 col-lg-2 col-sm-3 text-center col-form-label">คะแนนระดับ
                        3 <span style="color:red">*</span></label>
                    <div class="col-xl-1 col-lg-2 col-sm-9">
                        <input class="form-control text-right number" name="IWKPI_NUMBER_3" id="IWKPI_NUMBER_3" type="number"
                            step="0.01" min="0" max="100" required placeholder="0.00" value="{{$infowork_kpi->IWKPI_NUMBER_3}}">
                    </div>
                    <label for="IWKPI_NUMBER_4" class="col-xl-1 col-lg-2 col-sm-3 text-center col-form-label">คะแนนระดับ
                        4</label>
                    <div class="col-xl-1 col-lg-2 col-sm-9">
                        <input class="form-control text-right number" name="IWKPI_NUMBER_4" id="IWKPI_NUMBER_4" type="number"
                            step="0.01" min="0" max="100"  placeholder="0.00" value="{{$infowork_kpi->IWKPI_NUMBER_4}}">
                    </div>
                    <label for="IWKPI_NUMBER_5" class="col-xl-1 col-lg-2 col-sm-3 text-center col-form-label">คะแนนระดับ
                        5</label>
                    <div class="col-xl-1 col-lg-2 col-sm-9">
                        <input class="form-control text-right number" name="IWKPI_NUMBER_5" id="IWKPI_NUMBER_5" type="number"
                            step="0.01" min="0" max="100"  placeholder="0.00" value="{{$infowork_kpi->IWKPI_NUMBER_5}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IWKPI_SCORE_A" class="col-sm-2 col-form-label">คะแนน (ก) <span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input class="form-control text-right" name="IWKPI_SCORE_A" id="IWKPI_SCORE_A" type="number"
                            step="0.01" min="0" max="100" required readonly placeholder="0.00" value="{{$infowork_kpi->IWKPI_SCORE_A}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IWKPI_WEIGHT_B" class="col-sm-2 col-form-label">น้ำหนัก (ข) <span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input class="form-control text-right" name="IWKPI_WEIGHT_B" id="IWKPI_WEIGHT_B" type="number"
                            step="0.01" min="0" max="100" required placeholder="0.00" value="{{$infowork_kpi->IWKPI_WEIGHT_B}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IWKPI_MULTIPLY_AB" class="col-sm-2 col-form-label">ผลรวม (ค) = กxข <span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input class="form-control text-right" name="IWKPI_MULTIPLY_AB" id="IWKPI_MULTIPLY_AB"
                            type="number" step="0.01" required readonly placeholder="0.00" value="{{$infowork_kpi->IWKPI_MULTIPLY_AB}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IWKPI_TARGET" class="col-sm-2 col-form-label">เป้า <span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input class="form-control text-right" name="IWKPI_TARGET" id="IWKPI_TARGET" type="number"
                            step="0.01" min="0" max="100" required placeholder="0.00" value="{{$infowork_kpi->IWKPI_TARGET}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">วิธีคำนวณผลคะแนนรายเดือน KPI <span
                            style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <?php
                                $avg = '';
                                $max = '';
                                $last = '';
                                $sum = '';
                                if($infowork_kpi->IWKPI_TYPE_CALCULATE == 'calc_avg'){
                                    $avg = 'checked';
                                }else if($infowork_kpi->IWKPI_TYPE_CALCULATE == 'calc_max'){
                                    $max = 'checked';
                                }else if($infowork_kpi->IWKPI_TYPE_CALCULATE == 'calc_last'){
                                    $last = 'checked';
                                }else if($infowork_kpi->IWKPI_TYPE_CALCULATE == 'calc_sum'){
                                    $sum = 'checked';
                                }
                            ?>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="IWKPI_TYPE_CALCULATE_1" required name="IWKPI_TYPE_CALCULATE" class="custom-control-input" value="calc_avg" {{$avg}}>
                                <label class="custom-control-label" for="IWKPI_TYPE_CALCULATE_1">ค่าเฉลี่ย</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="IWKPI_TYPE_CALCULATE_2" required name="IWKPI_TYPE_CALCULATE" class="custom-control-input" value="calc_max" {{$max}}>
                                <label class="custom-control-label" for="IWKPI_TYPE_CALCULATE_2">ค่าสูงสุด</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="IWKPI_TYPE_CALCULATE_3" required name="IWKPI_TYPE_CALCULATE" class="custom-control-input" value="calc_last" {{$last}}>
                                <label class="custom-control-label" for="IWKPI_TYPE_CALCULATE_3">ค่าล่าสุด</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="IWKPI_TYPE_CALCULATE_4" required name="IWKPI_TYPE_CALCULATE" class="custom-control-input" value="calc_sum" {{$sum}}>
                                <label class="custom-control-label" for="IWKPI_TYPE_CALCULATE_4">ค่ารวม</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row push">
                    <label for="IWKPI_TARGET" class="col-sm-2 col-form-label">การใช้งาน kpi <span
                            style="color:red">*</span></label>
                    <div class="col-form-label custom-control custom-switch mb-1 col-sm-5">
                        <input type="checkbox" class="custom-control-input" id="IWKPI_ACTIVE" name="IWKPI_ACTIVE" value="1" <?=$infowork_kpi->IWKPI_ACTIVE?'checked':''?>>
                        <label class="custom-control-label" for="IWKPI_ACTIVE">เปิด-ปิด</label>
                    </div>
                </div>
                <hr>
                <div class="text-right">
                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-save mr-2"></i>แก้ไขข้อมูล</button>
                    <a href="{{route('mperson.setinfo_kpi')}}" onClick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')"
                        class="btn btn-danger"><i class="fa fa-window-close mr-2"></i>ยกเลิก</a>
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
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
    let form = $('#form');
    let score_a = $('#IWKPI_SCORE_A');
    let number_1 = $('#IWKPI_NUMBER_1');
    let number_2 = $('#IWKPI_NUMBER_2');
    let number_3 = $('#IWKPI_NUMBER_3');
    let number_4 = $('#IWKPI_NUMBER_4');
    let number_5 = $('#IWKPI_NUMBER_5');
    let weight_b = $('#IWKPI_WEIGHT_B');
    let multiply_ab = $('#IWKPI_MULTIPLY_AB');
    let number = $('.number');
    number.each((index,ele) => {
        $(ele).on('change',function () {
            number.each((index,ele) => {
                if($(ele).val() != 0){
                    score_a.val(index+1);
                }else{
                    return false;
                }
                calc_multiply_ab();
            })
        })
    });
    score_a.on('change', function () {
        calc_multiply_ab();
    })
    weight_b.on('change', function () {
        calc_multiply_ab();
    })
    number_1.on('change', function () {

    })

    function calc_multiply_ab() {
        multiply_ab.val(score_a.val() * weight_b.val());
    }
    

    
</script>
@endsection