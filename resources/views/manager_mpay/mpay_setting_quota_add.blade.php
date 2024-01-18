@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">เพิ่มโควตาแต่ละหน่วยงาน</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_quota_save')}}" method="POST">
        @csrf
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_DEP_ID">หน่วยงาน</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="CPAY_DEP_ID"
                            name="CPAY_DEP_ID" style="width: 100%;" data-placeholder="เลือกหน่วยงาน"
                            required>
                            <option></option>
                            @foreach($dep_sub_sub as $row)
                            <option value="{{$row->CPAY_DEP_ID}}">
                                {{$row->CPAY_DEP_NAME_INSIDE}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CPAY_SET_ID">ชุดอุปกรณ์</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="CPAY_SET_ID"
                            name="CPAY_SET_ID" style="width: 100%;" data-placeholder="เลือกชุดอุปกรณ์"
                            required>
                            <option></option>
                            @foreach($cpay_setequpment as $row)
                            <option value="{{$row->CPAY_SET_ID}}">
                            [{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME_INSIDE}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="DEP_QUOTA_QUANTITY">จำนวนโควตา</label> <span class="text-danger">*</span>
                        <input type="number" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="DEP_QUOTA_QUANTITY" min="0" name="DEP_QUOTA_QUANTITY" placeholder="จำนวนโควตา" required>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_quota')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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