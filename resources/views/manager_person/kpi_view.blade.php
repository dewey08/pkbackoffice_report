@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .td-padding td{
        padding:0px 10px;
    }
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title">
                ข้อมูล KPI
            </div>
            <div class="block-options">
                <a href="{{route('mperson.setinfo_kpi_add')}}" class="btn btn-info"><i class="fa fa-plus mr-2"></i>เพิ่ม
                    KPI</a>
            </div>
        </div>
        <div class="block-content mb-4">
            <div class="table-responsive">
                <table class="table-striped table-vcenter table-sl-p-5px" style="width: 100%;">
                    <thead class="bg-sl-header">
                        <tr height="40">
                            <th width="5%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                ลำดับ</th>
                            <th width="20%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                ชื่อ</th>
                            <th width="25%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" colspan="5">
                                คะแนนตามระดับค่าเป้าหมาย</th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                คะแนน</th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                น้ำหนัก
                            </th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                ผลรวม</th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                เป้า</th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                วิธีคำนวณ</th>
                            <th width="8%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                สถานะ</th>
                            <th width="10%" class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                คำสั่ง</th>
                        </tr>
                        <tr>
                            <th width="5%">1</th>
                            <th width="5%">2</th>
                            <th width="5%">3</th>
                            <th width="5%">4</th>
                            <th width="5%">5</th>
                        </tr>
                    </thead>
                    <tbody class="td-padding">
                        @php($number = 1)
                        @foreach($infowork_kpi as $row)
                        <tr>
                            <td class="text-center">{{$number++}}</td>
                            <td>{{$row->IWKPI_NAME}}</td>
                            <td class="text-center">{{$row->IWKPI_NUMBER_1}}</td>
                            <td class="text-center">{{$row->IWKPI_NUMBER_2}}</td>
                            <td class="text-center">{{$row->IWKPI_NUMBER_3}}</td>
                            <td class="text-center">{{$row->IWKPI_NUMBER_4}}</td>
                            <td class="text-center">{{$row->IWKPI_NUMBER_5}}</td>
                            <td class="text-center">{{$row->IWKPI_SCORE_A}}</td>
                            <td class="text-center">{{$row->IWKPI_WEIGHT_B}}</td>
                            <td class="text-center">{{$row->IWKPI_MULTIPLY_AB}}</td>
                            <td class="text-center">{{$row->IWKPI_TARGET}}</td>
                            <td class="text-center">
                                <?php
                                    if($row->IWKPI_TYPE_CALCULATE == 'calc_avg'){
                                        echo 'ค่าเฉลี่ย';
                                    }else if($row->IWKPI_TYPE_CALCULATE == 'calc_max'){
                                        echo 'ค่ามากสุด';
                                    }else if($row->IWKPI_TYPE_CALCULATE == 'calc_last'){
                                        echo 'ค่าล่าสุด';
                                    }else if($row->IWKPI_TYPE_CALCULATE == 'calc_sum'){
                                        echo 'ค่ารวม';
                                    }
                                ?>
                            <td class="text-center">
                                @if($row->IWKPI_ACTIVE)
                                <div class="badge badge-success fs-14 fw-3">เปิดใช้งาน</div>
                                @else
                                <div class="badge badge-danger fs-14 fw-3">ปิดใช้งาน</div>
                                @endif
                            </td>
                            <td class="text-center" style="padding-top:2px;padding-bottom:2px">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle f-kanit fw-2 fs-12" id="dropdown-align-primary"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ทำรายการ</button>
                                    <div class="dropdown-menu dropdown-menu-right fs-15" aria-labelledby="dropdown-align-primary"
                                        x-placement="bottom-end"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                        <a class="dropdown-item" href="{{route('mperson.setinfo_kpi_edit',$row->IWKPI_ID)}}">แก้ไข</a>
                                        <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item" href="{{route('mperson.setinfo_kpi_delete',$row->IWKPI_ID)}}">ลบ</a>
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
    @if(Session::has('scc'))
        Swal.fire("{{session('scc')}}","<?=session('scc_msg')?>",'success')
    @endif
    @if(Session::has('err'))
        Swal.fire("{{session('err')}}","<?=session('err_msg')?>",'error')
    @endif
</script>

<script>
    $('.select2').select2();
    $('.budget').change(function () {
        if ($(this).val() != '') {
            var select = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('admin.selectbudget')}}",
                method: "GET",
                data: {
                    select: select,
                    _token: _token
                },
                success: function (result) {
                    $('.date_budget').html(result);
                    datepick();
                }
            })
        }
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        todayHighlight: true,
        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย
        thaiyear: true,
        autoclose: true //Set เป็นปี พ.ศ.
    }); //กำหนดเป็นวันปัจุบัน
</script>
@endsection