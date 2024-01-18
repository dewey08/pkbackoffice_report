@extends('layouts.mpay')
@section('css_after')
<?php
use App\Http\Controllers\Web_meta_data_Controller;
?>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">กำหนดค่าหน่วยงานจ่ายกลาง</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_default_department_sub_sub_id_update')}}" method="POST">
        @csrf
            <!-- Basic Elements -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_DEFAULT_DEPARTMENT_SUB_SUB_ID">หน่วยงานปัจจุบัน</label> <span class="text-danger">*</span>
                        <select class="js-select2 form-control" id="CPAY_DEFAULT_DEPARTMENT_SUB_SUB_ID"
                            name="CPAY_DEFAULT_DEPARTMENT_SUB_SUB_ID" style="width: 100%;" data-placeholder="เลือกหน่วยงานจ่ายกลาง"
                            required>
                            <option></option>
                            @foreach($dep_subsub_all as $row)
                            @if($row->HR_DEPARTMENT_SUB_SUB_ID === (int)Web_meta_data_Controller::getValueByName('CPAY_DEFAULT_DEPARTMENT_SUB_SUB_ID'))
                            <option value="{{$row->HR_DEPARTMENT_SUB_SUB_ID}}" selected>
                                {{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                            @else
                            <option value="{{$row->HR_DEPARTMENT_SUB_SUB_ID}}">
                                {{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">อัปเดตข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
<script>
    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(Session('err'))
        Swal.fire("{{session('err')}}",'','error')
    @endif
    jQuery(function () {
        Dashmix.helpers('select2');
    });
</script>

@endsection