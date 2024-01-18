@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">เพิ่มหน่วยงาน</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_department_sub_sub_save')}}" method="POST">
        @csrf
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="HR_DEPARTMENT_SUB_SUB_ID">หน่วยงาน</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="HR_DEPARTMENT_SUB_SUB_ID"
                            name="HR_DEPARTMENT_SUB_SUB_ID" style="width: 100%;" data-placeholder="เลือกหน่วยงาน"
                            required>
                            <option></option>
                            @foreach($departments_sub_sub as $row)
                            <!-- สร้าง array data -->
                            @php
                            $data = array(
                            'name' => $row->HR_DEPARTMENT_SUB_SUB_NAME,
                            'code_name' => $row->DEP_CODE
                            );
                            @endphp
                            <option value="{{$row->HR_DEPARTMENT_SUB_SUB_ID}}" data-record="{{json_encode_u($data)}}">
                                {{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_INSIDE">ชื่อภายใน</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_INSIDE" name="CPAY_DEP_NAME_INSIDE" maxlength="255"
                            placeholder="ชื่อภายใน" required>
                    </div>
                    <div class="form-group">
                        <label for="DEP_CODE">อักษรย่อ</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="DEP_CODE"
                            name="DEP_CODE" maxlength="10" placeholder="อักษรย่อ" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_TH">ชื่อไทย</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_TH" name="CPAY_DEP_NAME_TH" maxlength="255" placeholder="ชื่อไทย"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_EN">ชื่ออังกฤษ</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_EN" name="CPAY_DEP_NAME_EN" maxlength="255" placeholder="ชื่ออังกฤษ">
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_DEP_DETAIL">รายละเอียด</label>
                        <textarea type="text" style="height:90px;"
                            class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_DEP_DETAIL"
                            name="CPAY_DEP_DETAIL" maxlength="255" placeholder="รายละเอียด..."></textarea>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_department_sub_sub')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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
    $('#HR_DEPARTMENT_SUB_SUB_ID').change(function () {
        let data = JSON.parse($('#HR_DEPARTMENT_SUB_SUB_ID').find(':selected').attr('data-record'));
        $('#DEP_CODE').val(data['code_name']);
        $('#CPAY_DEP_NAME_INSIDE').val(data['name']);
        $('#CPAY_DEP_NAME_TH').val(data['name']);
    })
</script>

@endsection