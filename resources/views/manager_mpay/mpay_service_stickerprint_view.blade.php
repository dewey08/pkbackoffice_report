@extends('layouts.mpay')
@section('css_before')
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    #table td{
        padding-top:2px;
        padding-bottom:2px;
    }
    #table thead tr th{
        vertical-align:middle;
    }
</style>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <div class="block-title fs-18 fw-7">พิมพ์สติกเกอร์</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_service_stickerprint_add')}}"><i
                    class="fa fa-plus"></i> พิมพ์สติกเกอร์ใหม่</a>
        </div>
    </div>
    <div class="block-content py-3">
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">บาร์โค้ด</th>
                    <th class="text-center">ชื่อชุดอุปกรณ์</th>
                    <th class="text-center">หน่วยงาน</th>
                    <th class="text-center">เครื่อง (เครื่องที่)</th>
                    <th class="text-center">รอบ</th>
                    <th class="text-center">วันที่ผลิต</th>
                    <th class="text-center">วันหมดอายุ</th>
                    <th class="text-center">อายุ (วัน)</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">คงเหลือ</th>
                    <th class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($productions as $row)
                <?php
                $cancel_class = '';
                if($row->IS_CANCEL){
                    $cancel_class = 'bg-sl2-r1';
                }
                ?>
                <tr class="{{$cancel_class}}">
                    <td width="50px" class="text-center">{{$number++}}</td>
                    <td width="160px">{{$row->PRODUCT_BARCODE}}</td>
                    <td width="250px">[{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME}}</td>
                    <td width="200px">{{$row->CPAY_DEP_NAME}}</td>
                    <td width="150px">{{$row->CPAY_MACH_NAME_INSIDE}} ({{$row->CPAY_MACH_NUMBER}})</td>
                    <td width="65px" class="text-center">{{$row->PRODUCTION_AROUND}}</td>
                    <td width="130px" class="fs-15">วันที่ : {{$row->PRODUCTION_DATE}}<br> เวลา : {{$row->PRODUCTION_TIME}}</td>
                    <td width="130px" class="fs-15">วันที่ : {{$row->EXPIRATION_DATE}}<br> เวลา : {{$row->EXPIRATION_TIME}}</td>
                    <td width="85px" class="text-center">{{$row->CPAY_SET_STERILE_DAY}}</td>
                    <td width="85px" class="text-center">{{$row->PRODUCTION_QUANTITY}}</td>
                    <td width="100px" class="text-center">{{$row->PRODUCTION_QUANTITY_BALANCE}}</td>
                    <td width="75px" class="text-center">
                        @if($row->IS_CANCEL)
                            [{{$row->PRODUCTION_CANCEL_BY}}] ยกเลิก
                        @else

                        @if($timecheck < strtotime($row->created_at))
                                    <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')" href="{{route('mpay.mpay_service_stickerprint_cancel',$row->PRODUCT_ID)}}">ยกเลิก</a>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
@section('footer')
<!-- <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script> -->
<script>
    @if(session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
        @php(Session::forget('scc'));
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif
    $('#table').DataTable({
        "iDisplayLength": 50,
    });

//     datepick();
//    function datepick() {
//             $('.datepicker').datepicker({
//                 format: 'dd/mm/yyyy',
//                 todayBtn: true,
//                 language: 'th',
//                 todayHighlight: true,
//                 thaiyear: true,
//                 autoclose: true
//             });
//     }
</script>

@endsection