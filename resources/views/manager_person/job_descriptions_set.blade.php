@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .td-padding td{
        padding:2px 10px;
    }
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title">
                กำหนด KPI : <span class="fw-b f-u"><?=$infowork_job_description->IWJD_NAME?></span>
            </div>
        </div>
        <div class="block-content mb-4">
            <form action="{{route('mperson.setinfo_jobdset_update')}}" method="post">
            <input type="hidden" name="jobdescription_id" value="{{$jobdescription_id}}">
                @csrf
                <div class="table-responsive">
                    <table class="table-striped table-vcenter table-sl-p-5px" style="width: 100%;">
                        <thead class="bg-sl-header">
                            <tr height="40">
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    <i class="fa fa-hand-point-up"></i></th>
                                <th width="20%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    KPI</th>
                                <th width="25%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    colspan="5">
                                    คะแนนตามระดับค่าเป้าหมาย</th>
                                <th width="8%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    คะแนน</th>
                                <th width="8%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    น้ำหนัก
                                </th>
                                <th width="8%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    ผลรวม</th>
                                <th width="8%" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                    เป้า</th>
                                <th width="8%"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">
                                            <button type="button" class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;font-size:12px"><i class="fa fa-plus"></i></button>
                                    </th>
                            </tr>
                            <tr>
                                <th width="5%">1</th>
                                <th width="5%">2</th>
                                <th width="5%">3</th>
                                <th width="5%">4</th>
                                <th width="5%">5</th>
                            </tr>
                        </thead>
                        <tbody class="td-padding tbody" id="boxkpi">
                            @foreach($infowork_job_descriptions_set as $row)
                            <tr draggable="true">
                                <td class="text-center">
                                    <span style="cursor:pointer">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>
                                </td>
                                <td class="text-left">
                                    <div class="form-group mb-0">
                                        <select class="form-control js-select2 select2" id="kpi_id"
                                            name="kpi_id[]" style="width: 100%;" data-placeholder="เลือก KPI"
                                            required onchange="selectedkpi($(this))">
                                            <option></option>
                                            @foreach($infowork_kpi as $row2)
                                            <?php
                                                $datakpi = json_encode_u([
                                                    'num1' => $row2->IWKPI_NUMBER_1,
                                                    'num2' => $row2->IWKPI_NUMBER_2,
                                                    'num3' => $row2->IWKPI_NUMBER_3,
                                                    'num4' => $row2->IWKPI_NUMBER_4,
                                                    'num5' => $row2->IWKPI_NUMBER_5,
                                                    'score_a' => $row2->IWKPI_SCORE_A,
                                                    'weight_b' => $row2->IWKPI_WEIGHT_B,
                                                    'mul_ab' => $row2->IWKPI_MULTIPLY_AB,
                                                    'target' => $row2->IWKPI_TARGET,
                                                ]);
                                            ?>
                                            @if($row2->IWKPI_ID == $row->IWKPI_ID )
                                            <option data-infowork_kpi='<?=$datakpi?>' value="{{$row2->IWKPI_ID}}" selected>
                                                {{$row2->IWKPI_NAME}}</option>
                                            @else
                                            <option data-infowork_kpi='<?=$datakpi?>' value="{{$row2->IWKPI_ID}}">
                                                {{$row2->IWKPI_NAME}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td id="num1" class="text-center">{{$row->IWKPI_NUMBER_1}}</td>
                                <td id="num2" class="text-center">{{$row->IWKPI_NUMBER_2}}</td>
                                <td id="num3" class="text-center">{{$row->IWKPI_NUMBER_3}}</td>
                                <td id="num4" class="text-center">{{$row->IWKPI_NUMBER_4}}</td>
                                <td id="num5" class="text-center">{{$row->IWKPI_NUMBER_5}}</td>
                                <td id="score_a" class="text-center">{{$row->IWKPI_SCORE_A}}</td>
                                <td id="weight_b" class="text-center">{{$row->IWKPI_WEIGHT_B}}</td>
                                <td id="mul_ab" class="text-center">{{$row->IWKPI_MULTIPLY_AB}}</td>
                                <td id="target" class="text-center">{{$row->IWKPI_TARGET}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-hero-sm btn-hero-danger remove"
                                        style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="text-right">
                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{route('mperson.setinfo_jobd')}}" onClick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')"
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

<script src="{{asset('asset/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
    $("#boxkpi").sortable();
    $("#boxkpi").disableSelection();

    $('.addRow').on('click', function () {
        addRow();
    });
    $('.js-select2').select2();
    function addRow() {
        var count = $('.tbody').children('tr').length;
        var tr =    '<tr draggable="true" width="100%">'+
                    `<td class="text-center">
                        <span style="cursor:pointer">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </span>
                    </td>`+
                    '<td class="text-left">'+
                        '<div class="form-group mb-0">'+
                        '<select class="form-control js-select2" id="kpi_id" name="kpi_id[]"'+
                        'style="width: 100%;" data-placeholder="เลือก KPI" required onchange="selectedkpi($(this))">'+
                        '<option></option>'+
                        @foreach($infowork_kpi as $row)
                        <?php
                            $datakpi = json_encode_u([
                                'num1' => $row->IWKPI_NUMBER_1,
                                'num2' => $row->IWKPI_NUMBER_2,
                                'num3' => $row->IWKPI_NUMBER_3,
                                'num4' => $row->IWKPI_NUMBER_4,
                                'num5' => $row->IWKPI_NUMBER_5,
                                'score_a' => $row->IWKPI_SCORE_A,
                                'weight_b' => $row->IWKPI_WEIGHT_B,
                                'mul_ab' => $row->IWKPI_MULTIPLY_AB,
                                'target' => $row->IWKPI_TARGET,
                            ]);
                        ?>
                        '<option data-infowork_kpi=\'<?=$datakpi?>\' value="{{$row->IWKPI_ID}}">{{$row->IWKPI_NAME}}</option>'+
                        @endforeach
                        '</select>'+
                        '</div>'+
                    '</td>'+
                    '<td id="num1" class="text-center">-</td>'+
                    '<td id="num2" class="text-center">-</td>'+
                    '<td id="num3" class="text-center">-</td>'+
                    '<td id="num4" class="text-center">-</td>'+
                    '<td id="num5" class="text-center">-</td>'+
                    '<td id="score_a" class="text-center">-</td>'+
                    '<td id="weight_b" class="text-center">-</td>'+
                    '<td id="mul_ab" class="text-center">-</td>'+
                    '<td id="target" class="text-center">-</td>'+
                    '<td class="text-center">'+
                    '<button type="button" class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>'+
                    '</td>'+
                    '</tr>';
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    function selectedkpi(e){
        let data = e.find(':selected').data('infowork_kpi');
        let tr = e.parent().parent().parent();
        tr.children('#num1').html(data.num1)
        tr.children('#num2').html(data.num2)
        tr.children('#num3').html(data.num3)
        tr.children('#num4').html(data.num4)
        tr.children('#num5').html(data.num5)
        tr.children('#score_a').html(data.score_a)
        tr.children('#weight_b').html(data.weight_b)
        tr.children('#mul_ab').html(data.mul_ab)
        tr.children('#target').html(data.target)
    }
</script>
<script>
    @if(Session::has('scc'))
        Swal.fire("{{session('scc')}}","<?=session('scc_msg')?>",'success')
    @endif
    @if(Session::has('err'))
        Swal.fire("{{session('err')}}","<?=session('err_msg')?>",'error')
    @endif
</script>
<script>
    let token = $('meta[name="csrf-token"]').attr('content')
    function show_kpi_of_job_description(id,name,status){
        $.ajax({
            url:"{{route('mperson.ajax_setinfo_jobd_list_kpi')}}",
            method:"post",
            data:{
                _token : token,
                id:id
            },
            success:(result)=>{
                $('#jobdescription_name').html(name);
                if(status == 1){
                    $('#jobdescription_status').html(`<div class="badge badge-success fs-14 fw-3">เปิดใช้งาน</div>`);
                }else{
                    $('#jobdescription_status').html(`<div class="badge badge-danger fs-14 fw-3">ปิดใช้งาน</div>`);
                }
                $('#jobdescription_kpi_list').html(result);
                
                $('#kpi_show_click').click();
            } 
        });
    }
</script>
<script>
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    })

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