@extends('layouts.mpay')
@section('css_after')
<link rel="stylesheet" href="{{asset('asset/js/plugins/select2/css/select2.min.css')}}">
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขข้อมูลหน่วยงาน</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_department_sub_sub_update')}}" method="POST">
        @csrf
        <input type="hidden" name="CPAY_DEP_ID" value="{{$dep->CPAY_DEP_ID}}">
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="HR_DEPARTMENT_SUB_SUB_ID">หน่วยงาน</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="HR_DEPARTMENT_SUB_SUB_ID"
                            name="HR_DEPARTMENT_SUB_SUB_ID" style="width: 100%;" data-placeholder="เลือกหน่วยงาน"
                            required>
                            <option></option>
                            <?php
                            foreach($departments_sub_sub as $row){
                                // <!-- สร้าง array data -->
                                $data = array(
                                'name' => $row->HR_DEPARTMENT_SUB_SUB_NAME,
                                'code_name' => $row->DEP_CODE
                                );
                                if($row->HR_DEPARTMENT_SUB_SUB_ID === $dep->HR_DEPARTMENT_SUB_SUB_ID){?>
                                    <option value='<?=$row->HR_DEPARTMENT_SUB_SUB_ID?>' data-record='<?=json_encode_u($data)?>' selected>
                                    <?=$row->HR_DEPARTMENT_SUB_SUB_NAME?></option>';
                                <?php }else{?>
                                    <option value="<?=$row->HR_DEPARTMENT_SUB_SUB_ID?>" data-record='<?=json_encode_u($data)?>'><?=$row->HR_DEPARTMENT_SUB_SUB_NAME?></option>;
                                <?php }         
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_INSIDE">ชื่อภายใน</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_INSIDE" name="CPAY_DEP_NAME_INSIDE" maxlength="255"
                            placeholder="ชื่อภายใน" required value="{{$dep->CPAY_DEP_NAME_INSIDE}}">
                    </div>
                    <div class="form-group">
                        <label for="DEP_CODE">อักษรย่อ</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled" id="DEP_CODE"
                            name="DEP_CODE" maxlength="10" placeholder="อักษรย่อ" value="{{$dep->DEP_CODE}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_TH">ชื่อไทย</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_TH" name="CPAY_DEP_NAME_TH" maxlength="255" placeholder="ชื่อไทย"
                            required value="{{$dep->CPAY_DEP_NAME_TH}}">
                    </div>
                    <div class="form-group">
                        <label for="CPAY_DEP_NAME_EN">ชื่ออังกฤษ</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_DEP_NAME_EN" name="CPAY_DEP_NAME_EN" maxlength="191" placeholder="ชื่ออังกฤษ" value="{{$dep->CPAY_DEP_NAME_EN}}">
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_DEP_DETAIL">รายละเอียด</label>
                        <textarea type="text" style="height:90px;"
                            class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_DEP_DETAIL"
                            name="CPAY_DEP_DETAIL" maxlength="191" placeholder="รายละเอียด...">{{$dep->CPAY_DEP_DETAIL}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_department_sub_sub')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('footer')
<script src="{{asset('asset/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    const token = $('meta[name="csrf-token"]').attr('content')
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