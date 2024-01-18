@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขเครื่องมือวัสดุ</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_subset_medequipment_update')}}" method="POST">
            @csrf
            <input type="hidden" name="CPAY_SET_SUB_ID" value="{{$subsetequp->CPAY_SET_SUB_ID}}">
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="STORE_ID">เลือกชื่อจากทะเบียนวัสดุ</label>
                        <select class="js-select2 form-control" id="STORE_ID" name="STORE_ID" style="width: 100%;"
                            data-placeholder="เลือกทะเบียนวัสดุ">
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
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_SET_SUB_NAME_INSIDE">ชื่อภายใน</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_SET_SUB_NAME_INSIDE" name="CPAY_SET_SUB_NAME_INSIDE" maxlength="255"
                            placeholder="ชื่อภายใน" required value="{{$subsetequp->CPAY_SET_SUB_NAME_INSIDE}}">
                    </div>
                    <div class="form-group">
                        <label for="CPAY_SET_SUB_NAME_TH">ชื่อไทย</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_SET_SUB_NAME_TH" name="CPAY_SET_SUB_NAME_TH" maxlength="255" placeholder="ชื่อไทย"
                            required value="{{$subsetequp->CPAY_SET_SUB_NAME_TH}}">
                    </div>
                    <div class="form-group">
                        <label for="CPAY_SET_SUB_NAME_EN">ชื่ออังกฤษ</label>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_SET_SUB_NAME_EN" name="CPAY_SET_SUB_NAME_EN" maxlength="255"
                            placeholder="ชื่ออังกฤษ" value="{{$subsetequp->CPAY_SET_SUB_NAME_EN}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_SET_SUB_PRICE">ราคา (บาท)</label> <span class="text-danger">*</span>
                        <input type="number" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_SET_SUB_PRICE" name="CPAY_SET_SUB_PRICE" min="0" placeholder="ราคา" required
                            value="{{$subsetequp->CPAY_SET_SUB_PRICE}}">
                    </div>
                    <div class="form-group">
                        <label for="CPAY_UNIT_ID">หน่วยนับ</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="CPAY_UNIT_ID" name="CPAY_UNIT_ID"
                            style="width: 100%;" data-placeholder="เลือกหน่วยนับ" required>
                            <option></option>
                            @foreach($set_unit as $row)
                            @if($subsetequp->CPAY_UNIT_ID === $row->CPAY_UNIT_ID)
                            <option value="{{$row->CPAY_UNIT_ID}}" selected>
                                {{$row->CPAY_UNIT_NAME}}</option>
                            @else
                            <option value="{{$row->CPAY_UNIT_ID}}">
                                {{$row->CPAY_UNIT_NAME}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_SET_SUB_DETAIL">รายละเอียด</label>
                        <textarea type="text" style="height:90px;"
                            class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_SET_SUB_DETAIL"
                            name="CPAY_SET_SUB_DETAIL" maxlength="255"
                            placeholder="รายละเอียด...">{{$subsetequp->CPAY_SET_SUB_DETAIL}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')"
                        href="{{route('mpay.mpay_setting_subset_medequipment')}}" type="submit"
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
    $('#STORE_ID').change(function () {
        let data = JSON.parse($('#STORE_ID').find(':selected').attr('data-record'));
        $('#CPAY_SET_SUB_NAME_INSIDE').val(data['name']);
        $('#CPAY_SET_SUB_NAME_TH').val(data['name']);
    })
</script>

@endsection