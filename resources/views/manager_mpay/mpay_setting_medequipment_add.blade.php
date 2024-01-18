@extends('layouts.mpay')
@section('css_after')
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
<div class="block block-rounded block-bordered mb-4" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">เพิ่มชุดอุปกรณ์</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_setting_medequipment_save')}}" method="POST">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="store_select">เลือกค้นหาชื่อจากทะเบียนวัสดุจากตารางหลัก</label> 
                                <select class="js-select2 form-control" id="store_select" name="store_select"
                                    style="width: 100%;" data-placeholder="ทะเบียนวัสดุ">
                                    <option></option>
                                    @foreach($warehouse as $row)
                                    <?php
                                                $data_record = json_encode_u(array(
                                                    'name' => $row->SUP_NAME,
                                                ));
                                            ?>
                                    <option value="{{$row->ID}}" data-record="{{$data_record}}">
                                        {{$row->SUP_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid #dcdcdc 1px">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_NAME_INSIDE">ชื่อภายใน</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_NAME_INSIDE" name="CPAY_SET_NAME_INSIDE" placeholder="ชื่อภายใน" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_NAME_TH">ชื่อไทย</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_NAME_TH" name="CPAY_SET_NAME_TH" placeholder="ชื่อไทย" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_NAME_EN">ชื่ออังกฤษ</label>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_NAME_EN" name="CPAY_SET_NAME_EN" placeholder="ชื่ออังกฤษ">
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_BRAND">ชื่อยี่ห้อ</label>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_BRAND" name="CPAY_SET_BRAND" placeholder="ชื่อยี่ห้อ">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-1">
                                <label for="CPAY_UNIT_ID">หน่วยนับ</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control f-kanit" id="CPAY_UNIT_ID" name="CPAY_UNIT_ID" data-placeholder="หน่วยนับ" required>
                                    <option></option>
                                    @foreach($unit as $row)
                                        <option value="{{$row->CPAY_UNIT_ID}}">{{$row->CPAY_UNIT_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_PRICE">ราคา</label> <span class="text-danger">*</span>
                                <input type="number" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_PRICE" name="CPAY_SET_PRICE" min="0" value="0" required >
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_STERILE_DAY">ระยะเวลาปลอดเชื้อ (วัน)</label> <span class="text-danger">*</span>
                                <input type="number" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_SET_STERILE_DAY" name="CPAY_SET_STERILE_DAY" min="1" value="1" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_TYPEMACH_ID">ประเภทเครื่องมือ</label> <span class="text-danger">*</span>
                                <select class="form-control f-kanit" id="CPAY_TYPEMACH_ID" name="CPAY_TYPEMACH_ID" required>
                                    <option value="" disabled selected>เลือกประเภทเครื่องมือ</option>
                                    @foreach($typemach as $row)
                                    <option value="{{$row->CPAY_TYPEMACH_ID}}">{{$row->CPAY_TYPEMACH_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="CPAY_GSET_ID">กลุ่มชุดอุปกรณ์</label> <span class="text-danger">*</span>
                                <select class="form-control f-kanit" id="CPAY_GSET_ID" name="CPAY_GSET_ID" required>
                                    <option value="" disabled selected>เลือกกลุ่มชุดอุปกรณ์</option>
                                    @foreach($gset_equp as $row)
                                    <option value="{{$row->CPAY_GSET_ID}}">{{$row->CPAY_GSET_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="CPAY_SET_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_SET_DETAIL"
                                    name="CPAY_SET_DETAIL" maxlength="255" placeholder="รายละเอียด..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-1">
                                <div class="form-check form-check-inline mb-1">
                                                <input class="form-check-input" type="checkbox" value="1" id="CPAY_SET_HAVE_LIST" name="CPAY_SET_HAVE_LIST">
                                                <label class="form-check-label" for="CPAY_SET_HAVE_LIST" style="user-select:none!important" id="CPAY_SET_HAVE_LIST">มีรายการย่อย</label>
                                </div>
                        </div>
                    </div>
                    <div class="row items">
                        <div class="col-lg-12">
                            <table class="table table-striped table-bordered d-none">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%"><i class="fa fa-hand-point-up"></i></th>
                                        <th class="text-center">เลือกเครื่องมือวัสดุ</th>
                                        <th class="text-center">จำนวน</th>
                                        <th class="text-center">
                                            <button type="button" class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></button>
                                        </th>
                                </thead>
                                <tbody class="tbody">
                                    <!-- add row form js -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_medequipment')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
                        </div>
                    </div>
                </form>
    </div>
</div>
@endsection
@section('footer')
<script src="{{asset('asset/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $('.tbody').sortable();
    jQuery(function () {
        Dashmix.helpers('select2');
    });
    $('#store_select').change(function () {
        let data = JSON.parse($('#store_select').find(':selected').attr('data-record'));
        $('#CPAY_SET_NAME_INSIDE').val(data['name']);
        $('#CPAY_SET_NAME_TH').val(data['name']);
    })

    $('.addRow').on('click', function () {
        addRow();
    });

    function addRow() {
        var count = $('.tbody').children('tr').length;
        var tr =    '<tr>'+
                    `<td class="text-center">
                        <span style="cursor:pointer">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </span>
                    </td>`+
                    '<td width="50%" class="text-center">'+
                        '<div class="form-group mb-0">'+
                        '<select class="js-select2 form-control select2" id="CPAY_SET_SUB_ID" name="CPAY_SET_SUB_ID[]"'+
                        'style="width: 100%;" data-placeholder="เลือกทะเบียนวัสดุ" required>'+
                        '<option></option>'+
                        @foreach($setequp_sub as $row)
                        '<option value="{{$row->CPAY_SET_SUB_ID}}">{{$row->CPAY_SET_SUB_NAME_INSIDE}}</option>'+
                        @endforeach
                        '</select>'+
                        '</div>'+
                    '</td>'+
                    '<td class="text-center" width="100px"><input class="form-control text-center" name="CPAY_SETLIST_QUANTITY[]" type="number" min="1" value="1"></td>'+
                    '<td width="50px" class="text-center">'+
                    '<button type="button" class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>'+
                    '</td>'+
                    '</tr>';
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });

    //-------------------------------------------------------------------
    $('#CPAY_SET_HAVE_LIST').on('click',function(){
        const havelist = document.getElementById('CPAY_SET_HAVE_LIST');
        if(!havelist.checked){
            let confirm = Swal.fire({title:'ต้องการปิดรายการย่อยจริงหรือไม่?',text:'หากปิดการใช้งานรายการย่อย ข้อมูลรายละเอียดที่เพิ่มไว้จะหายทั้งหมด',confirmButtonText:'ยืนยัน',showCancelButton:true,type:'warning'}).then((result) =>{
                if(!result.value){
                    havelist.checked = true;
                    $('.table').removeClass('d-none')
                    return true;
                }else{
                    toggleList();
                }
            })
        }else{
            toggleList();
        }
    });

    function toggleList() {
        $('.table').toggleClass('d-none')
        if($('.table').hasClass('d-none')){
            $('.tbody').html('');
        }else{
            addRow();
        }
    }
</script>
@endsection