@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขกลุ่มอุปกรณ์</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_setting_typemedequipment_update')}}" method="POST">
                @csrf
                <input type="hidden" name="CPAY_GSET_ID" value="{{$typeequpment->CPAY_GSET_ID}}">
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CPAY_GSET_NAME">ชื่อกลุ่มอุปกรณ์</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_GSET_NAME" name="CPAY_GSET_NAME" placeholder="ชื่อกลุ่มอุปกรณ์" required value="{{$typeequpment->CPAY_GSET_NAME}}">
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="CPAY_GSET_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_GSET_DETAIL"
                                    name="CPAY_GSET_DETAIL" maxlength="255" placeholder="รายละเอียด...">{{$typeequpment->CPAY_GSET_DETAIL}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงหรือไม่?')" href="{{route('mpay.mpay_setting_typemedequipment')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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
    $('#ARTICLE_ID').change(function () {
        let data = JSON.parse($('#ARTICLE_ID').find(':selected').attr('data-record'));
        $('#ARTICLE_NUM').val(data['num']);
        $('#CPAY_MACH_NAME_INSIDE').val(data['name']);
        $('#CPAY_MACH_NAME_TH').val(data['name']);
    })
</script>
@endsection