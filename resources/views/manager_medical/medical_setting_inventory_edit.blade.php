@extends('layouts.medical')
@section('css_before')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="block" style="width: 95%;margin:10px auto 20px">
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขประเภทคลังสำหรับยาและเวชภัณฑ์</h2>
            <div class="block-content block-content-full" align="left">
                <form method="post" action="{{ route('mmedical.setting_inventory_update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="SETINVEN_ID" value="{{$setinven->SETINVEN_ID}}">
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ประเภทคลัง :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="inventory" id="YEAR_ID" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="" disable>--กรุณาเลือกประเภทคลัง--</option>
                            @foreach($supplies_inven as $supinven)
                            @php
                                $data = json_encode_u([
                                    'id' => $supinven->INVEN_ID,
                                    'name' => $supinven->INVEN_NAME,
                                    ]);
                            @endphp
                            @if($setinven->INVEN_ID == $supinven->INVEN_ID)
                            <option value="{{$data}}" selected>{{$supinven->INVEN_NAME}}</option>
                            @else
                            <option value="{{$data}}">{{$supinven->INVEN_NAME}}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div align="right">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info">แก้ไขข้อมูล</button>
                            <a href="{{route('mmedical.setting_inventory')}}"
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