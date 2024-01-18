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
        <h3 class="block-title text-center fw-8">เพิ่มตัดจ่าย</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_service_defective_save')}}" method="POST" id="form_defective">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="DESTROYER_PERSON">ผู้ตัดจ่าย</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="DESTROYER_PERSON" name="DESTROYER_PERSON"
                                    style="width: 100%;" data-placeholder="เลือกผู้ตัดจ่าย" required>
                                    <option></option>
                                    @foreach($destroyer as $row)
                                    <?php
                                        $data_destroyer_record = json_encode_u(array(
                                            'DESTROYER_PERSON_ID' => $row->ID,
                                            'DESTROYER_PERSON_NAME' => $row->HR_FNAME,
                                        ));
                                    ?>
                                    <option value="{{$data_destroyer_record}}" data-record="{{$data_destroyer_record}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="DEFECTIVE_DATE">วันที่ตัดจ่าย</label> <span class="text-danger">*</span>
                                <input  name="DEFECTIVE_DATE"  id="DEFECTIVE_DATE" class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{date('d/m/Y')}}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="DEFECTIVE_TIME">เวลาตัดจ่าย</label> <span class="text-danger">*</span>
                                <input  name="DEFECTIVE_TIME"  id="DEFECTIVE_TIME" type="time" class="form-control input-lg f-kanit" value="{{date('H:i:s')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="RECEIVE_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="DEFECTIVE_DETAILS"
                                    name="DEFECTIVE_DETAILS" maxlength="255" placeholder="รายละเอียด..."></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row items">
                        <div class="col-lg-3 text-right">
                             <label for="search_production" class="btn btn-sm btn-success d-flex align-items-center justify-content-center">ค้นหาชุดอุปกรณ์พร้อมใช้งาน &nbsp;&nbsp;<em class="fa fa-barcode fs-26"></em> &nbsp;&nbsp;[F9]</label> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input  name="search_production"  id="search_production" type="text" class="form-control f-kanit" value="" placeholder="เลขบาร์โค้ด หรือสแกนบาร์โค้ดชุดอุปกรณ์ที่พร้อมใช้">
                            </div>
                        </div>
                    </div>
                    <div class="row items">
                        <div class="col-lg-12">
                            <h3 class="fs-18 fw-5 mb-1">รายการตัดจ่าย</h3>
                            <table class="table table-striped table-bordered">
                                <thead class="bg-sl2-b4 text-white">
                                    <tr>
                                        <th width="20%" class="text-center">ชุดอุปกรณ์</th>
                                        <th width="14%" class="text-center">บาร์โค้ด</th>
                                        <th width="8%" class="text-center">จำนวน</th>
                                        <th width="15%" class="text-center">สถานะ</th>
                                        <th width="35%" class="text-center">หมายเหตุ</th>
                                        <th width="7%" class="text-center">*</th>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <h3 class="fs-18 fw-5 mb-1">รายการจำนวนคงเหลือที่พร้อมใช้<span class="fs-14 f-i">(คลิ๊กเลือก)</span></h3>
                            <div class="row items">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead class="bg-sl2-sb4 text-white">
                                                <tr>
                                                    <th width="10%" class="text-center"><i class="fa fa-barcode"></i></th>
                                                    <th width="15%" class="text-center">ชุดอุปกรณ์</th>
                                                    <th width="15%" class="text-center">หน่วยงาน</th>
                                                    <th width="5%" class="text-center">รอบ</th>
                                                    <th width="8%" class="text-center">วันที่ผลิต</th>
                                                    <th width="7%" class="text-center">วันหมดอายุ</th>
                                                    <th width="5%" class="text-center">อายุ (วัน)</th>
                                                    <th width="5%" class="text-center">จำนวนผลิต</th>
                                                    <th width="10%" class="text-center">พร้อมใช้คงเหลือ</th>
                                                    <th width="5%" class="text-center">หน่วยนับ</th>
                                            </thead>
                                            <tbody class="production_equpments">
                                            @foreach($stock as $row)
                                                <?php
                                                    $data_production = json_encode_u(array(
                                                        'PRODUCT_ID'            => $row->PRODUCT_ID,
                                                        'CPAY_SET_NAME'         => $row->CPAY_SET_NAME,
                                                        'PRODUCT_BARCODE'       => $row->PRODUCT_BARCODE,
                                                        'DEFECTIVE_QUANTITY'    => $row->PRODUCTION_QUANTITY_BALANCE,
                                                    ));
                                                ?>
                                                <tr style="cursor:pointer" id="{{$row->PRODUCT_BARCODE}}" onclick="add_list_defective('{{$data_production}}')" data-production="{{$data_production}}">
                                                    <td width="10%">{{$row->PRODUCT_BARCODE}}</td>
                                                    <td width="15%">[{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME}}</td>
                                                    <td width="15%">{{$row->CPAY_DEP_NAME_INSIDE}}</td>
                                                    <td width="10%" class="text-center">{{$row->PRODUCTION_AROUND}}</td>
                                                    <td width="10%" style="background-color:#edffed">{{$row->PRODUCTION_DATE}} {{$row->PRODUCTION_TIME}}</td>
                                                    <td width="10%" style="background-color:#ffefef">{{$row->EXPIRATION_DATE}} {{$row->EXPIRATION_TIME}}</td>
                                                    <td width="5%" class="text-center">{{$row->CPAY_SET_STERILE_DAY}}</td>
                                                    <td width="10%" class="text-center">{{$row->PRODUCTION_QUANTITY}}</td>
                                                    <td width="10%" class="text-center bg-sl2-g1">{{$row->PRODUCTION_QUANTITY_BALANCE}}</td>
                                                    <td width="5%" class="text-center">{{$row->CPAY_UNIT_NAME}}</td>
                                                </tr>    
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_service_defective')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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
    let status_select        = 
                    @foreach($defective_status as $row)
                    '<option value="{{$row->DEFECTIVE_STATUS_ID}}">{{$row->DEFECTIVE_STATUS_NAME}}</option>'+
                    @endforeach
                    '';
    function addRow(product_id,set_name,barcode,number) {
        let has_row = false;
        $('.defective-list').each(function (index) {
            if ($(this).attr('data-product_barcode') == barcode) {
                jQuery(function () {Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-times mr-1', message: 'เพิ่มข้อมูลชุดอุปกรณ์นี้แล้ว : '+barcode });});
                has_row = true;
            }
        })
        if (!has_row) {
            var count = $('.tbody').children('tr').length;
            var tr =    '<tr class="defective-list" data-product_barcode="'+barcode+'">'+
                        '<td width="20%" class="text-center">'+
                            '<input class="form-control" type="hidden" readonly name="PRODUCT_ID[]" value="'+product_id+'">'+
                            '<input class="form-control f-kanit" type="text" readonly name="CPAY_SET_NAME[]" value="'+set_name+'">'+
                        '</td>'+
                        '<td width="14%">'+
                            '<input class="form-control f-kanit" type="text" readonly name="PRODUCT_BARCODE[]" value="'+barcode+'">'+
                        '</td>'+
                        '<td width="8%">'+
                            '<input class="form-control f-kanit" type="number" min="1" max="'+number+'" value="1" name="DEFECTIVE_QUANTITY[]" required>'+
                        '</td>'+
                        '<td width="15%">'+
                            '<select class="js-select2 form-control" id="DEFECTIVE_STATUS_ID" name="DEFECTIVE_STATUS_ID[]" style="width: 100%;" data-placeholder="เลือกสถานะ" required>'+
                            status_select+
                            '</select></td>'+
                        '<td width="35%" class="text-center"><input class="form-control f-kanit" name="DEFECTIVE_DETAIL[]" type="text" max="255" name="DEFECTIVE_DETAIL"></td>'+
                        '<td width="7%" class="text-center">'+
                        '<button type="button" class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>'+
                        '</td>'+
                        '</tr>';
            $('.tbody').append(tr);
            $('.js-select2').select2();
        }
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    function add_list_defective(row){
        let data_production = JSON.parse(row);
        let product_id  = data_production.PRODUCT_ID;
        let set_name    = data_production.CPAY_SET_NAME;
        let barcode     = data_production.PRODUCT_BARCODE;
        let number      = data_production.DEFECTIVE_QUANTITY;
        addRow(product_id,set_name,barcode,number);
    }

    $('#form_defective').submit(function(){
        if($('.tbody').html() === ''){
            Swal.fire("กรุณาเลือกรายการที่ต้องการตัดจ่าย",'เลือกที่รายการจำนวนคงเหลือที่พร้อมใช้ หรือสแกนบาร์โค้ดชุดอุปกรณ์ที่ต้องการตัดจ่าย','error')
            return false;
        }
    })
    $('#search_production').keydown(function () {
        if(event.keyCode === 13){
            $('#search_production').focus();
            let reuslt = "#"+$('#search_production').val();
            let value = $(reuslt).attr('data-production');
            if(value){
                console.log(1);
                add_list_defective(value);
            }else{
                console.log(2);
            }
            $('#search_production').val('');
            return false;
        }
    });
    //F9 เพื่อ Focus ช่องค้นหา
    $('body').keyup(function(){
        if(event.keyCode === 120){
            $('#search_production').focus();
        }
    });
    jQuery(function () {
        Dashmix.helpers('select2');
    });
</script>
@endsection