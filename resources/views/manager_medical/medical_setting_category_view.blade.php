@extends('layouts.medical')
@section('css_before')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<style>
    .table-responsive > .table-bordered {
    border: 0;
    }
    .table-bordered, .table-bordered th, .table-bordered td {
        border-color: #1a1a1a;
    }
    .table-bordered {
        border: 1px solid #1a1a1a;
    }
    .table thead th {
        border-bottom-color: #1a1a1a;
    }
    .table tbody td {
        padding: 1px 1rem;
    }
</style>
@endsection
@section('content')
<div class="block" style="width: 95%;margin:10px auto 20px">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><b>รายการประเภทหมวดสำหรับยาและเวชภัณฑ์
                </b></h3>
                    <div align="right">
                          <a href="{{route('mmedical.setting_category_add')}}" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-plus"></i> เพิ่มประเภทหมวด</a> 
                    </div>
            </div>
            <div class="block-content block-content-full">
            <div class="table-responsive"> 
               <table class="table table-striped table-bordered table-vcenter" style="width: 100%;" id="table" style="border-color:black !important;">
                    <thead style="background-color: #FFEBCD;" class="text-center">
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">ไอดีหมวด</th>
                            <th width="40%">ชื่อประเภทหมวดยาและเวชภัณฑ์</th>
                            <th width="15%">คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($number = 1)
                        @foreach($category as $categ)
                        <tr>
                            <td class="text-center">{{$number++}}</td>
                            <td>{{$categ->SUP_TYPE_ID}}</td>
                            <td>{{$categ->SETCATEGORY_NAME}}</td>
                            <td style="border: 1px solid black;" align="center">
                                <button type="button" class="btn btn-outline-info dropdown-toggle fs-13" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    ทำรายการ
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item fs-16" href="{{route('mmedical.setting_category_edit',$categ->SETCATEGORY_ID)}}">แก้ไข</a>
                                    <a class="dropdown-item fs-16" href="{{route('mmedical.setting_category_delete',$categ->SETCATEGORY_ID)}}" onclick="return confirm('ต้องการลบจริงหรือไม่')">ลบ</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
<script src="http://localhost/gtwbackoffice/asset/js/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    @if(Session::has('scc'))
    Swal.fire("{{Session('scc')}}",'','success')
    @endif
    @if(Session::has('err'))
    Swal.fire("{{Session('err')}}",'','error')
    @endif
</script>
@endsection