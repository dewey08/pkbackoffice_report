@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขสติกเกอร์</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_setting_defaultsticker_update')}}" method="POST">
                @csrf
                <input type="hidden" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CAPY_STICK_NAME" name="CAPY_STICK_ID" value="{{$sticker->CPAY_STICK_ID}}" placeholder="ชื่อสติ๊กเกอร์" required>
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CAPY_STICK_NAME">ชื่อสติกเกอร์</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CAPY_STICK_NAME" value="{{$sticker->CAPY_STICK_NAME}}" name="CAPY_STICK_NAME" placeholder="ชื่อสติ๊กเกอร์" required>
                            </div>
                            <div class="form-group">
                                <label for="CAPY_STICK_WIDTH">ความกว้าง (มม.)</label> <span class="text-danger">*</span>
                                <input type="number" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CAPY_STICK_WIDTH" min="0" value="{{$sticker->CAPY_STICK_WIDTH}}" name="CAPY_STICK_WIDTH" required placeholder="ความกว้าง">
                            </div>
                            <div class="form-group">
                                <label for="CAPY_STICK_HEIGHT">ความสูง (มม.)</label> <span class="text-danger">*</span>
                                <input type="number" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CAPY_STICK_HEIGHT" min="0" value="{{$sticker->CAPY_STICK_HEIGHT}}" name="CAPY_STICK_HEIGHT" required placeholder="ความสูง">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CAPY_STICK_BRAND_PRINTER">ยี่ห้อเครื่องปริ้น</label>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CAPY_STICK_BRAND_PRINTER" value="{{$sticker->CAPY_STICK_BRAND_PRINTER}}" name="CAPY_STICK_BRAND_PRINTER" placeholder="ยี่ห้อเครื่องปริ้น">
                            </div>
                            <div class="form-group">
                                <label for="CAPY_STICK_MODEL_PRINTER">โมเดลเครื่องปริ้น</label>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CAPY_STICK_MODEL_PRINTER" value="{{$sticker->CAPY_STICK_MODEL_PRINTER}}" name="CAPY_STICK_MODEL_PRINTER" placeholder="โมเดลเครื่องปริ้น">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="CAPY_STICK_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CAPY_STICK_DETAIL"
                                    name="CAPY_STICK_DETAIL" maxlength="255" placeholder="รายละเอียด...">{{$sticker->CAPY_STICK_DETAIL}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="CAPY_STICK_HTML_FORMAT">รูปแบบสติ๊กเกอร์</label>
                                <textarea type="text" style="height:300px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CAPY_STICK_HTML_FORMAT"
                                    name="CAPY_STICK_HTML_FORMAT" placeholder="HTML Format" required>{{$sticker->CAPY_STICK_HTML_FORMAT}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="custom-control custom-switch custom-control-success mb-1">
                                <input type="checkbox" name="CAPY_STICK_FOR_LIST" class="custom-control-input" id="CAPY_STICK_FOR_LIST" <?=($sticker->CAPY_STICK_FOR_LIST)?'checked':''?>>
                                <label class="custom-control-label" for="CAPY_STICK_FOR_LIST">หลายรายการ</label>
                            </div>
                            <div class="form-group">
                                <label for="CPAY_STICKER_HTML_FORMAT_LIST">รูปแบบหลายรายการ</label>
                                <textarea type="text" style="height:200px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_STICKER_HTML_FORMAT_LIST"
                                    name="CPAY_STICKER_HTML_FORMAT_LIST" placeholder="HTML Format">{{$sticker->CPAY_STICKER_HTML_FORMAT_LIST}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_defaultsticker')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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