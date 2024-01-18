@extends('layouts.mpay')
@section('css_after')
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">แก้ไขข้อมูลประเภทเครื่องมือ</h3>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_setting_typecleanmachine_update')}}" method="POST">
        @csrf
            <!-- Basic Elements -->
            <input type="hidden" name="CPAY_TYPEMACH_ID" value="{{$typemachine->CPAY_TYPEMACH_ID}}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="CPAY_TYPEMACH_NAME">ชื่อประเภทเครื่องมือ</label> <span class="text-danger">*</span>
                        <input type="text" class="js-maxlength form-control f-kanit js-maxlength-enabled"
                            id="CPAY_TYPEMACH_NAME" name="CPAY_TYPEMACH_NAME" maxlength="255"
                            placeholder="ชื่อประเภทเครื่องมือ" required value="{{$typemachine->CPAY_TYPEMACH_NAME}}">
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="CPAY_TYPEMACH_DETAIL">รายละเอียด</label>
                        <textarea type="text" style="height:90px;"
                            class="js-maxlength form-control f-kanit js-maxlength-enabled" id="CPAY_TYPEMACH_DETAIL"
                            name="CPAY_TYPEMACH_DETAIL" maxlength="255" placeholder="รายละเอียด...">{{$typemachine->CPAY_TYPEMACH_DETAIL}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row items-push">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="submit_click btn btn-sm btn-primary f-kanit mr-1">แก้ไขข้อมูล</button>
                    <a onclick="return confirm('ต้องการยกเลิกจริงใช่หรือไม่?')" href="{{route('mpay.mpay_setting_typecleanmachine')}}" type="submit" class="submit_click btn btn-sm btn-danger f-kanit">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
<script>
    const token = $('meta[name="csrf-token"]').attr('content')
</script>

@endsection