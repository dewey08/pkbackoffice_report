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
        <h3 class="block-title text-center fw-8">เพิ่มจ่ายออก</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_service_export_save')}}" method="POST" id="form_export">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="SEND_TO_DEP_SUB_SUB_ID">หน่วยงานที่เบิก</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="SEND_TO_DEP_SUB_SUB_ID" name="SEND_TO_DEP_SUB_SUB_ID"
                                    style="width: 100%;" data-placeholder="เลือกหน่วยงานที่เบิก" required>
                                    <option></option>
                                    @foreach($departments as $row)
                                    @if($dep_id_cpay != $row->HR_DEPARTMENT_SUB_SUB_ID)
                                    <?php
                                        $data_department_record = json_encode_u(array(
                                            'dep_id'            => $row->CPAY_DEP_ID,
                                            'depart_sub_sub_id' => $row->HR_DEPARTMENT_SUB_SUB_ID,
                                            'dep_name'          => $row->CPAY_DEP_NAME_INSIDE,
                                        ));
                                    ?>
                                    <option value="{{$data_department_record}}" data-record="{{$data_department_record}}">{{$row->CPAY_DEP_NAME_INSIDE}} ({{$row->DEP_CODE}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SEND_TO_PERSON_ID">ผู้เบิก</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="SEND_TO_PERSON_ID" name="SEND_TO_PERSON_ID"
                                    style="width: 100%;" data-placeholder="ผู้เบิก" required>
                                    @foreach($person_send_to as $row)
                                    <?php
                                        $data_send_to_record = json_encode_u(array(
                                            'person_id' => $row->ID,
                                            'person_fname' => $row->HR_FNAME,
                                        ));
                                    ?>
                                    <option value="{{$data_send_to_record}}" data-record="{{$data_send_to_record}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SENDER_PERSON_ID">ผู้จ่ายออก</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="SENDER_PERSON_ID" name="SENDER_PERSON_ID"
                                    style="width: 100%;" data-placeholder="ผู้จ่ายออก" required>
                                    @foreach($person_sender as $row)
                                    <?php
                                        $data_sender_record = json_encode_u(array(
                                            'person_id' => $row->ID,
                                            'person_fname' => $row->HR_FNAME,
                                        ));
                                    ?>
                                    <option value="{{$data_sender_record}}" data-record="{{$data_sender_record}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="EXPORT_DATE">วันที่จ่ายออก</label> <span class="text-danger">*</span>
                                <input  name="EXPORT_DATE"  id="EXPORT_DATE" class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{date('d/m/Y')}}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="EXPORT_TIME">เวลาจ่ายออก</label> <span class="text-danger">*</span>
                                <input  name="EXPORT_TIME"  id="EXPORT_TIME" type="time" class="form-control input-lg f-kanit" value="{{date('H:i:s')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="EXPORT_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="EXPORT_DETAIL"
                                    name="EXPORT_DETAIL" maxlength="255" placeholder="รายละเอียด..."></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row items d-none search_production">
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
                            <h3 class="fs-18 fw-5 mb-1">รายการจ่ายออก</h3>
                            <table class="table table-striped table-bordered">
                                <thead class="bg-sl2-b4 text-white">
                                    <tr>
                                        <th width="20%" class="text-center">บาร์โค้ด</th>
                                        <th width="35%" class="text-center">ชุดอุปกรณ์</th>
                                        <th width="10%" class="text-center">จำนวน</th>
                                        <th width="25%" class="text-center">หน่วยงาน</th>
                                        <th width="10%" class="text-center">*</th>
                                    </tr>
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
                                                <tr style="cursor:pointer" onclick="add_list_export({{$row->PRODUCT_BARCODE}})">
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
                    <hr>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_service_export')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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
    let data_production      = '';
    let department_id        = '';
    let department_id_first  = '';
    //ฟังก์ชันค้นหา
    function search_focus() {
        $('#search_production').focus();
    }
    //F9 เพื่อ Focus ช่องค้นหา
    $('body').keyup(function(){
        if(event.keyCode === 120){
            search_focus();
        }
    });
    
    $('#search_production').keydown(function () {
        if(event.keyCode === 13){
            search_focus();
            add_list_export($('#search_production').val());
            $('#search_production').val('');
            return false;
        }
    });
    
    function export_update_select(dep_id) {
        $.ajax({
            url:'{{route('mpay.export_update_list')}}',
            method:'POST',
            data:{
                department_id:dep_id,
                _token: token
            },
            success:function (result) {
                if(result === ''){
                    swal.fire('ไม่พบรายการชุดอุปกรณ์ที่พร้อมใช้','กรุณาตั้งค่าที่ <b>"ข้อมูลพื้นฐาน > โควตาแต่ละหน่วย"</b> <br>หรือ <b>"ตรวจว่ามีจำนวนการผลิตแล้ว"</b>','info');
                    $('#search_production').attr('disabled',true);
                }
                $('.production_equpments').html(result);
            },
        });
    }

    function add_list_export(barcode) {
        //เช็ค department id             => return ยังไม่ได้ดลือก หน่วยงาน
        if(department_id === ''){
            swal.fire('','กรุณา "เลือกหน่วยงานที่เบิก" ก่อนทำราย !!','info');
            $('#select2-SEND_TO_DEP_SUB_SUB_ID-container').css('border','red 1px solid');
            return false;
        }
            // เช็ค list tbody       => 
            // - มี   => return;
            // - ไม่มี => ajax set value and add row table.
        $.ajax({
            url:'{{route('mpay.add_list_export')}}',
            method:'POST',
            data:{
                department_id:department_id,
                barcode:barcode,
                _token: token
            },
            success:function (results) {
                let result = JSON.parse(results);
                let has_set_id = true;
                if(result.status === 'success'){
                    //ตรวจเช็ค set_id ว่าเพิ่มไปหรือยัง
                        // - เพิ่มแล้ว แจ้ง notify มีแล้ว
                        // - ยัง addrow
                    $('.product_row').each(function (index) {
                        console.log(result.barcode + ' = ' + $(this).attr('data-product_barcode'));
                        if ($(this).attr('data-product_barcode') == result.barcode) {
                            has_set_id = false;
                        }
                    })
                    if (has_set_id) {
                        addRow(result.msg)
                    }else{
                        jQuery(function () {Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-times mr-1', message: 'เพิ่มข้อมูลชุดอุปกรณ์นี้แล้ว : '+result.barcode });});
                        //แจ้งมีข้อมูลแล้ว notyfy info
                    }
                }else{
                    //ไม่พบข้อมูล notyfy error
                    jQuery(function () {Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-times mr-1', message: result.msg });});
                }
                $('#search_production').val('');
                search_focus();
            },
        });
    }

    $('#SEND_TO_DEP_SUB_SUB_ID').on('change',function () {
        $('.tbody').html('');
        $('.search_production').removeClass('d-none');
        $('#search_production').attr('disabled',false);
        $('#select2-SEND_TO_DEP_SUB_SUB_ID-container').css('border','');
        department_id        = JSON.parse(this.value).dep_id;
        $('.production_equpments').html('');
        export_update_select(department_id)
    });
    
    function addRow(tr) {
        var count = $('.tbody').children('tr').length;
        var tr = tr;
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    $('#form_export').submit(function(){
        if($('.tbody').html() === ''){
            Swal.fire("กรุณาเลือกรายการจ่ายออก",'คลิ๊กเลือกชุดอุปกรณ์ หรือสแกนบาร์โค้ดเพื่อเพิ่มรายการจ่ายออก','info')
            return false;
        }
    })
    jQuery(function () {
        Dashmix.helpers('select2');
    });
</script>
@endsection