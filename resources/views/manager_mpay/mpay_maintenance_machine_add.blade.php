@extends('layouts.mpay')
@section('css_after')
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .table td{
        padding-top:2px;
        padding-bottom:2px;
    }
    .table thead tr th{
        vertical-align:middle;
    }
    .table tbody tr td{
        vertical-align:middle;
    }
</style>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title text-center fw-8">เพิ่มข้อมูลการตรวจสอบเครื่องนึ่ง/อบ</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_maintenance_machine_save')}}" method="POST">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CPAY_MACH">เครื่องนึ่ง/อบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="CPAY_MACH" name="CPAY_MACH"
                                    style="width: 100%;" data-placeholder="เลือกเครื่องนึ่ง/อบ" required>
                                    <option></option>
                                    @foreach($machine as $row)
                                    <?php
                                        $data_machine_record = json_encode_u(array(
                                            'CPAY_MACH_ID'              => $row->CPAY_MACH_ID,
                                            'CPAY_MACH_NAME'     => $row->CPAY_MACH_NAME_INSIDE,
                                        ));
                                    ?>
                                    <option value="{{$data_machine_record}}" data-record="{{$data_machine_record}}">{{$row->CPAY_MACH_NAME_INSIDE}} ({{$row->CPAY_MACH_NUMBER}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="MMAINTENANCE_RESULT">ผลการตรวจสอบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="MMAINTENANCE_RESULT" name="MMAINTENANCE_RESULT"
                                    style="width: 100%;" data-placeholder="เลือกผลการตรวจสอบ" required>
                                    <option></option>
                                    <option value="1">ผ่าน</option>
                                    <option value="0">ไม่ผ่าน</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CHECK_MACHINE_PERSON">ผู้ตรวจเครื่องนึ่ง/อบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="CHECK_MACHINE_PERSON" name="CHECK_MACHINE_PERSON"
                                    style="width: 100%;" data-placeholder="เลือกผู้ตรวจเครื่องนึ่ง/อบ" required>
                                    <option></option>
                                    @foreach($inside_personal as $row)
                                    <?php
                                        $data_check_machine_record = json_encode_u(array(
                                            'person_id'     => $row->ID,
                                            'person_fname'  => $row->HR_FNAME,
                                        ));
                                    ?>
                                    <option value="{{$data_check_machine_record}}" data-record="{{$data_check_machine_record}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CHECK_PERSON">ผู้ตรวจสอบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="CHECK_PERSON" name="CHECK_PERSON"
                                    style="width: 100%;" data-placeholder="เลือกผู้ตรวจสอบ" required>
                                    <option></option>
                                    @foreach($inside_personal as $row)
                                    <?php
                                        $data_check_record = json_encode_u(array(
                                            'person_id'     => $row->ID,
                                            'person_fname'  => $row->HR_FNAME,
                                        ));
                                    ?>
                                    <option value="{{$data_check_record}}" data-record="{{$data_check_record}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="MMAINTENANCE_TEST_DATE">วันที่ตรวจเครื่องนึ่ง/อบ</label> <span class="text-danger">*</span>
                                <input  name="MMAINTENANCE_TEST_DATE"  id="MMAINTENANCE_TEST_DATE" class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{date('d/m/Y')}}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="MMAINTENANCE_TEST_TIME">เวลาตรวจเครื่องนึ่ง/อบ</label> <span class="text-danger">*</span>
                                <input  name="MMAINTENANCE_TEST_TIME"  id="MMAINTENANCE_TEST_TIME" type="time" class="form-control input-lg f-kanit" value="{{date('H:i:s')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="MMAINTENANCE_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="MMAINTENANCE_DETAIL"
                                    name="MMAINTENANCE_DETAIL" maxlength="400" placeholder="รายละเอียด..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_maintenance_machine')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
                        </div>
                    </div>
                </form>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
    let token = $('meta[name="csrf-token"]').attr('content');
    @if(Session::has('scc_notify'))
    jQuery(function () {
        Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{session("scc_notify")}}' });
    });
    @endif
    datepick();
   function datepick() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',
                todayHighlight: true,
                thaiyear: true,
                autoclose: true
            });
    }
    let data_setequpment     = '';
    let department_id        = '';
    let department_id_first  = '';
    let status_select        =
    {{-- 
                    @foreach($export_status as $row)
                    '<option value="{{$row->EXPORT_STATUS_ID}}">{{$row->EXPORT_STATUS_NAME}}</option>'+
                    @endforeach
--}}
                    '';
                    console.log(status_select);
    function export_update_select(department) {
        $.ajax({
            url:'',
            method:'POST',
            data:{
                depart:department,
                _token: token
            },
            success:function (result) {
                data_setequpment    = JSON.parse(result).setqupment;
                status_select       = JSON.parse(result).status_export;
            },
        });
    }
    function addRow() {
        var count = $('.tbody').children('tr').length;
        var tr =    '<tr>'+
                    '<td width="20%" class="text-center">'+
                        '<div class="form-group mb-0">'+
                        '<select class="js-select2 form-control select2" id="CPAY_SET_ID" name="CPAY_SET_ID[]"'+
                        'style="width: 100%;" data-placeholder="เลือกชุดอุปกรณ์" required>'+
                        '<option></option>'+
                        data_setequpment+
                        '</select>'+
                        '</div>'+
                    '</td>'+
                    '<td width="14%"><input class="form-control" type="text" name="PRODUCT_BARCODE[]"></td>'+
                    '<td width="8%"><input class="form-control" type="number" min="1" value="1" name="EXPORT_QUANTITY[]" required></td>'+
                    '<td width="15%">'+
                    '<select class="js-select2 form-control" id="EXPORT_STATUS_ID" name="EXPORT_STATUS_ID[]" style="width: 100%;" data-placeholder="เลือกสถานะรับเข้า" required>'+
                    status_select+
                    '</select></td>'+
                    '<td width="35%" class="text-center"><input class="form-control" name="EXPORT_LIST_DETAIL[]" type="text" max="255" name="EXPORT_LIST_DETAIL"></td>'+
                    '<td width="7%" class="text-center">'+
                    '<button type="button" class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>'+
                    '</td>'+
                    '</tr>';
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    $('.addRow').on('click',function(){
        if(department_id === ''){
            Swal.fire("กรุณาเลือกหน่วยงานส่งมอบก่อน",'','info')
            return;
        }
        if($('.tbody').html() === ''){
            department_id_first = department_id;
        }
        if(department_id !== department_id_first){
            department_id_first = department_id;
            $('.tbody').html('') ;
            addRow();
            return;
        }
        addRow();

    })

    $('#DELIVERY_DEP_SUB_SUB_ID').on('change',function () {
        $('.tbody').html('');
        department_id        = JSON.parse(this.value);
        export_update_select(this.value)
    });
    $('#form_export').submit(function(){
        if($('.tbody').html() === ''){
            Swal.fire("กรุณาเลือกรายละเอียดชุดอุปกรณ์",'คลิ๊กที่ปุ่ม + สีเขียว','info')
            return false;
        }
    })
</script>

<script>
    jQuery(function () {
        Dashmix.helpers('select2');
    });
    $('#ARTICLE_ID').change(function () {
        let data = JSON.parse($('#ARTICLE_ID').find(':selected').attr('data-record'));
        $('#ARTICLE_NUM').val(data['num']);
        $('#CPAY_MACH_NAME_INSIDE').val(data['name']);
        $('#CPAY_MACH_NAME_TH').val(data['name']);
    })
</script>
@endsection