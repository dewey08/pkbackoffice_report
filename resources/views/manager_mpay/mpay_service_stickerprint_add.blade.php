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
        <h3 class="block-title text-center fw-8">พิมพ์สติ๊กเกอร์ใหม่</h3>
        <h3 class="block-options text-center fw-8"><a target="_bank" href="{{route('mpay.mpay_show_quota')}}" class="btn btn-sm btn-primary f-kanit">โควตาชุดอุปรกรณ์แต่ละหน่วย</a></h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_service_stickerprint_save')}}" method="POST" id="form_stickerprint">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CPAY_DEP_ID">หน่วยงานปลายทาง</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="CPAY_DEP_ID" name="CPAY_DEP_ID"
                                    style="width: 100%;" data-placeholder="เลือกหน่วยงานปลายทาง" required>
                                    <option></option>
                                    @foreach($departments as $row)
                                        <?php
                                            $data_department = json_encode_u(array(
                                                'CPAY_DEP_ID'    => $row->CPAY_DEP_ID,
                                                'CPAY_DEP_NAME'  => $row->CPAY_DEP_NAME_INSIDE,
                                            ));
                                        ?>
                                        <option value="{{$data_department}}">{{$row->CPAY_DEP_NAME_INSIDE}} ({{$row->DEP_CODE}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="MANUFACTURER_PERSON_ID">ผู้ผลิต</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="MANUFACTURER_PERSON_ID" name="MANUFACTURER_PERSON_ID"
                                    style="width: 100%;" data-placeholder="เลือกผู้ผลิต" required>
                                    @foreach($persons as $row)
                                        <?php
                                            $MANUFACTURER_PERSON = json_encode_u(array(
                                                'MANUFACTURER_PERSON_ID'    => $row->ID,
                                                'MANUFACTURER_PERSON_NAME'  => $row->HR_FNAME,
                                            ));
                                        ?>
                                        <option value="{{$MANUFACTURER_PERSON}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CHECK_PERSON_ID">ผู้ตรวจสอบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="CHECK_PERSON_ID" name="CHECK_PERSON_ID"
                                    style="width: 100%;" data-placeholder="เลือกผู้ตรวจสอบ" required>
                                    @foreach($persons as $row)
                                        <?php
                                            $CHECK_PERSON = json_encode_u(array(
                                                'CHECK_PERSON_ID'    => $row->ID,
                                                'CHECK_PERSON_NAME'  => $row->HR_FNAME,
                                            ));
                                        ?>
                                        <option value="{{$CHECK_PERSON}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                    @endforeach
                                </select>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="STERLIZE_PERSON_ID">ผู้นึ่ง/อบ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="STERLIZE_PERSON_ID" name="STERLIZE_PERSON_ID"
                                    style="width: 100%;" data-placeholder="เลือกผู้นึ่ง/อบ" required>
                                    @foreach($persons as $row)
                                        <?php
                                            $STERLIZE_PERSON = json_encode_u(array(
                                                'STERLIZE_PERSON_ID'    => $row->ID,
                                                'STERLIZE_PERSON_NAME'  => $row->HR_FNAME,
                                            ));
                                        ?>
                                        @if($row->ID === $person_login_id)
                                            <option value="{{$STERLIZE_PERSON}}" selected>{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                        @else
                                            <option value="{{$STERLIZE_PERSON}}">{{$row->HR_FNAME}} {{$row->HR_LNAME}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="PRODUCTION_DATE">วันที่ผลิต</label> <span class="text-danger">*</span>
                                <input  name="PRODUCTION_DATE"  id="PRODUCTION_DATE" class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{date('d/m/Y')}}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="PRODUCTION_TIME">เวลาผลิต</label> <span class="text-danger">*</span>
                                <input  name="PRODUCTION_TIME"  id="PRODUCTION_TIME" type="time" class="form-control input-lg f-kanit" value="{{date('H:i:s')}}" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row items d-none search_setequpment">
                        <div class="col-lg-3 text-right">
                             <label for="search_set" class="btn btn-sm btn-success d-flex align-items-center justify-content-center">ค้นหาชุดอุปกรณ์ &nbsp;&nbsp;<em class="fa fa-barcode fs-26"></em> &nbsp;&nbsp;[F9]</label> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input  name="search_set"  id="search_set" type="text" class="form-control f-kanit" value="" placeholder="รหัส หรือ บาร์โค้ดชุดอุปกรณ์">
                            </div>
                        </div>
                    </div>
                    <div class="row items">
                        <div class="col-lg-6">
                            <h3 class="fs-18 fw-5 mb-1">รายการจำนวนคงเหลือที่ยังไม่ปลอดเชื้อ <span class="fs-14 f-i">(คลิ๊กเลือก)</span></h3>
                            <div class="row items">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead class="bg-sl2-sb4 text-white">
                                            <tr>
                                                <th width="20%" class="text-center">ชุดอุปกรณ์</th>
                                                <th width="8%" class="text-center">ยังไม่ปลอดเชื้อ</th>
                                                <th width="15%" class="text-center">หน่วยนับ</th>
                                        </thead>
                                        <tbody class="set_equpments">
                                        @foreach($stock as $row)
                                            <tr style="cursor:pointer" onclick="add_list_production({{$row->CPAY_SET_ID}})">
                                                <td width="60%">[{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME_INSIDE}}</td>
                                                <td width="20%" class="text-center">{{$row->CPAY_SET_NOT_STERILE_QUANTITY}}</td>
                                                <td width="20%" class="text-center">{{$row->CPAY_UNIT_NAME}}</td>
                                            </tr>    
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="fs-18 fw-5 mb-1">รายการผลิต</h3>
                            <table class="table table-striped table-bordered">
                                <thead class="bg-sl2-b4 text-white">
                                    <tr>
                                        <th width="35%" class="text-center">ชุดอุปกรณ์</th>
                                        <th width="13%" class="text-center">จำนวน</th>
                                        <th width="25%" class="text-center">เครื่องอบ/นึ่ง</th>
                                        <th width="15%" class="text-center">รอบผลิต</th>
                                        <th width="5%" class="text-center">*</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" id="submit_click" class="submit_click btn btn-sm btn-primary f-kanit mr-1">พิมพ์สติ๊กเกอร์</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_service_stickerprint')}}" class="btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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
    @if(session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
        @php(Session::forget('scc'));
    @endif
    
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif
    datepick();


    $('body').keyup(function(){
        if(event.keyCode === 120){
            search_focus();
        }
    })
    
    $('#submit_click').on('click',function(){
        // console.log(111111111);
    })

    // $('#submit_click').on('doubleclick',function{
    //     return false;
    // })

    $('#search_set').keydown(function () {
        if(event.keyCode === 13){
            search_focus();
            add_list_production($('#search_set').val());
            $('#search_set').val('');
            return false;
        }
    });
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
    let department_id        = '';
    let data_setequpment     = '';
    let department_id_first  = '';
    
    //อัพเดต department_id ในตัวแปร
    $('#CPAY_DEP_ID').on('change',function () {
        search_focus();
        $('.tbody').html('');
        department_id        = JSON.parse(this.value);
        $('.search_setequpment').removeClass('d-none');
        $('#search_set').attr('disabled',false);
        $('#select2-CPAY_DEP_ID-container').css('border','');
        $('.set_equpments').html('');
        equpment_update_list(department_id);
    });
    function equpment_update_list(dep_id) {
        $.ajax({
            url:'{{route('mpay.equpment_update_list')}}',
            method:'POST',
            data:{
                department_id:dep_id,
                _token: token
            },
            success:function (result) {
                if(result === ''){
                    swal.fire('ไม่พบรายการชุดอุปกรณ์ไม่ปลอดเชื้อ','กรุณาตั้งค่าที่ <b>"ข้อมูลพื้นฐาน > โควตาแต่ละหน่วย"</b> <br>หรือ <b>"ตรวจว่ามีจำนวนรับเข้าใหม่"</b>แล้ว','info');
                    $('#search_set').attr('disabled',true);
                }
                $('.set_equpments').html(result);
            },
        });

    }
    function add_list_production(set_id) {
        //เช็ค department id             => return ยังไม่ได้ดลือก หน่วยงาน
        if(department_id === ''){
            swal.fire('','กรุณา "เลือกหน่วยงานปลายทาง" ก่อนทำราย !!','info');
            $('#select2-CPAY_DEP_ID-container').css('border','red 1px solid');
            return false;
        }
        //เช็ค list tbody       => 
            //- มี   => return;
            //- ไม่มี => ajax set value and add row table.
        $.ajax({
            url:'{{route('mpay.add_list_production')}}',
            method:'POST',
            data:{
                department_id:department_id,
                CPAY_SET_ID:set_id,
                _token: token
            },
            success:function (results) {
                let result = JSON.parse(results);
                // console.log(result);
                // console.log(result.set_id);
                // console.log(result.html);
                let has_set_id = true;
                if(result.status === 'success'){
                    //ตรวจเช็ค set_id ว่าเพิ่มไปหรือยัง
                        // - เพิ่มแล้ว แจ้ง notify มีแล้ว
                        // - ยัง addrow
                    $('.set_id_row').each(function (index) {
                        if ($(this).attr('data-set_id') == result.set_id) {
                            has_set_id = false;
                        }
                    })
                    if (has_set_id) {
                        addRow(result.msg)
                    }else{
                        jQuery(function () {Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-times mr-1', message: 'เพิ่มข้อมูลชุดอุปกรณ์นี้แล้ว : '+result.set_name });});
                        //แจ้งมีข้อมูลแล้ว notyfy info
                    }
                }else{
                    //ไม่พบข้อมูล notyfy error
                    jQuery(function () {Dashmix.helpers('notify', {type: 'info', icon: 'fa fa-times mr-1', message: result.msg });});
                }
                $('#search_set').val('');
                search_focus();
            },
        });
    }

    function addRow(tr) {
        var count = $('.tbody').children('tr').length;
        var tr = tr;
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    $('.addRow').on('click',function(){
        if(department_id === ''){
            Swal.fire("กรุณาเลือกหน่วยงานส่งมอบก่อน",'','info')
            return false;;
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

    $('#form_stickerprint').submit(function(){
        if($('.tbody').html() === ''){
            Swal.fire("กรุณาเลือกรายการชุดอุปกรณ์ไม่ปลอดเชื้อ",'เลือกหน่วยงานปลายทางที่มีรายการไม่ปลอดเชื้อ','info')
            return false;
        }
        $('#submit_click').attr('disabled',true);
        return true;
        // return confirm('ต้องการพิมพ์จริงหรือไม่ ?');
    })

    function search_focus() {
        $('#search_set').focus();
    }
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