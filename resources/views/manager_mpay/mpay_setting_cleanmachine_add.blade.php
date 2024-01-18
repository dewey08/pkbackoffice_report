@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">เพิ่มข้อมูลเครื่องนึ่ง/อบ</h3>
    </div>
    <div class="block-content">
                <form action="{{route('mpay.mpay_setting_cleanmachine_save')}}" method="POST">
                @csrf
                    <!-- Basic Elements -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ARTICLE_ID">ทะเบียนครุภัณฑ์</label> <span class="text-danger">*</span>
                                <select class="js-select2 form-control" id="ARTICLE_ID" name="ARTICLE_ID"
                                    style="width: 100%;" data-placeholder="ทะเบียนครุภัณฑ์" required>
                                    <option></option>
                                    @foreach($supply as $row)
                                    <?php
                                        $data_record = json_encode_u(array(
                                            'name' => $row->ARTICLE_NAME,
                                            'num' => $row->ARTICLE_NUM
                                        ));
                                    ?>
                                    <option value="{{$row->ARTICLE_ID}}" data-record="{{$data_record}}">{{$row->ARTICLE_NAME.' ('.$row->ARTICLE_NUM.')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ARTICLE_NUM">เลขครุภัณฑ์</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="ARTICLE_NUM" name="ARTICLE_NUM" placeholder="เลขครุภัณฑ์" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="CPAY_MACH_NUMBER">ลำดับเครื่อง</label> <span class="text-danger">*</span>
                                <input type="number" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_MACH_NUMBER" name="CPAY_MACH_NUMBER" min="1" value="{{$machinenumrun}}" required>
                            </div>
                            <div class="form-group">
                                <label for="example-select">ประเภทเครื่องมือ</label> <span class="text-danger">*</span>
                                <select class="form-control f-kanit" id="example-select" name="CPAY_TYPEMACH_ID" required>
                                    <option value="" disabled selected>เลือกประเภทเครื่องมือ</option>
                                    @foreach($typemachine as $row)
                                    <option value="{{$row->CPAY_TYPEMACH_ID}}">{{$row->CPAY_TYPEMACH_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CPAY_MACH_NAME_INSIDE">ชื่อภายใน</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_MACH_NAME_INSIDE" name="CPAY_MACH_NAME_INSIDE" required>
                            </div>
                            <div class="form-group">
                                <label for="CPAY_MACH_NAME_TH">ชื่อไทย</label> <span class="text-danger">*</span>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_MACH_NAME_TH" name="CPAY_MACH_NAME_TH" required>
                            </div>
                            <div class="form-group">
                                <label for="CPAY_MACH_NAME_EN">ชื่ออังกฤษ</label>
                                <input type="text" class="js-maxlength form-control js-maxlength-enabled f-kanit" id="CPAY_MACH_NAME_EN" name="CPAY_MACH_NAME_EN">
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="CPAY_MACH_DETAIL">รายละเอียด</label>
                                <textarea type="text" style="height:90px;"
                                    class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_MACH_DETAIL"
                                    name="CPAY_MACH_DETAIL" maxlength="255" placeholder="รายละเอียด..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">เพิ่มข้อมูล</button>
                            <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_cleanmachine')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
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