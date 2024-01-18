@extends('layouts.medical')
@section('css_before')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="block" style="width: 95%;margin:10px auto 20px">
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มประเภทหมวดสำหรับยาและเวชภัณฑ์</h2>
            <div class="block-content block-content-full" align="left">
                <form method="post" action="{{ route('mmedical.setting_category_save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ประเภทหมวด :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="category" id="YEAR_ID" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="" disable>--กรุณาเลือกประเภทหมวด--</option>
                            @foreach($supplies_category as $supcate)
                            @php
                                $data = json_encode_u([
                                    'id' => $supcate->SUP_TYPE_ID,
                                    'name' => $supcate->SUP_TYPE_NAME,
                                    ]);
                            @endphp
                            <option value="{{$data}}">{{$supcate->SUP_TYPE_NAME}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div align="right">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info">บันทึกข้อมูล</button>
                            <a href="{{route('mmedical.setting_category')}}"
                                class="btn btn-hero-sm btn-hero-danger"
                                onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
@endsection