@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขหน่วยนับ</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_unit_update')}}" method="POST">
            @csrf
            <input type="hidden" name="CPAY_UNIT_ID" value="{{$set_unit->CPAY_UNIT_ID}}">
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="SUP_UNIT_NAME">เลือกหน่วยนับจากตารางหลัก</label>
                        <select class="js-select2 form-control" id="SUP_UNIT_NAME" name="SUP_UNIT_NAME"
                            style="width: 100%;" data-placeholder="หน่วยนับ">
                            <option></option>
                            @foreach($sup_unit as $row)
                            <?php
                                        $data_record = json_encode_u(array(
                                            'name' => $row->SUP_UNIT_NAME,
                                        ));
                                    ?>
                            <option value="{{$row->SUP_UNIT_NAME}}" data-record="{{$data_record}}">
                                {{$row->SUP_UNIT_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr style="border:solid #dcdcdc 1px">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="CPAY_UNIT_NAME">ชื่อหน่วยนับ</label> <span class="text-danger">*</span> <span class="fs-12">(สามารถกำหนดหน่วยนับได้)</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_UNIT_NAME" name="CPAY_UNIT_NAME" maxlength="255" placeholder="ชื่อหน่วยนับ"
                            required value="{{$set_unit->CPAY_UNIT_NAME}}">
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_UNIT_DETAIL">รายละเอียด</label>
                        <textarea type="text" style="height:90px;"
                            class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_UNIT_DETAIL"
                            name="CPAY_UNIT_DETAIL" maxlength="255" placeholder="รายละเอียด...">{{$set_unit->CPAY_UNIT_DETAIL}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')"
                        href="{{route('mpay.mpay_setting_unit')}}" type="submit"
                        class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
<script>
    jQuery(function () {
        Dashmix.helpers('select2');
    });
    $('#SUP_UNIT_NAME').change(function () {
        let data = JSON.parse($('#SUP_UNIT_NAME').find(':selected').attr('data-record'));
        $('#CPAY_UNIT_NAME').val(data['name']);
    })
</script>

@endsection