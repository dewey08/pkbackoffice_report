@extends('layouts.mpay')
@section('css_before')
<style>
    /* table.table-bordered > thead > tr > th{
        border-top:1px solid black;
        border-right:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border-top:1px solid black;
        border-right:1px solid black;
    } */
    table.table-bordered{
        border-left:1px solid black;
        border-bottom:1px solid black;
    }
    table.table-bordered > tbody{
        border-left:1px solid black;
        border-bottom:1px solid black;
    }
    table#used th{
        padding-top:2px;
        padding-bottom:2px;
    }
</style>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <div class="block-title fs-18 fw-7">สติกเกอร์</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_setting_defaultsticker_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มสติกเกอร์</a>
            <a class="d-none"href="{{route('mpay.test_print')}}" target="_blank" rel="noopener noreferrer">menu testprint</a>
        </div>
    </div>
    <div class="block-content py-3">  
    <h3 class="fs-16 mb-0">สติ๊กเกอร์หลายรายการที่ใช้ปัจจุบัน</h3>
    <table id="used" class="table table-striped table-vcenter table-bordered">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th colspan="2">รายละเอียด</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">กว้าง</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">สูง</th>
                    <th class="text-center" style="width: 120px;">รูปแบบ</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($stickerbig))
                <tr>
                    <td class="text-center" style="width: 65px;">
                        <i class="fa fa-barcode text-success fa-2x"></i>
                    </td>
                    <td>
                        <a class="font-size-h5 font-w500" target="_bank" href="{{route('mpay.mpay_setting_defaultsticker_example',$stickerbig->CPAY_STICK_ID)}}">{{$stickerbig->CAPY_STICK_NAME}}</a>
                        <div class="text-muted mt-2 mb-1 font-size-h6 m-0">{{$stickerbig->CAPY_STICK_DETAIL}}</div>
                    </td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$stickerbig->CAPY_STICK_WIDTH}}</span> มม.</td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$stickerbig->CAPY_STICK_HEIGHT}}</span> มม.</td>
                    <td class="text-center">
                        @if($stickerbig->CAPY_STICK_FOR_LIST)
                            หลายรายการ
                        @else
                            รายการเดียว
                        @endif
                    </td>
                </tr>
                @else
                    <tr><td colspan="5" >ไม่พบรูปแบบสติ๊กเกอร์หลายรายการ</td></tr>
                @endif
            </tbody>
        </table>
        <h3 class="fs-16 mb-0">สติ๊กเกอร์รายการเดียวที่ใช้ปัจจุบัน</h3>
    <table id="used" class="table table-striped table-vcenter table-bordered">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th colspan="2">รายละเอียด</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">กว้าง</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">สูง</th>
                    <th class="text-center" style="width: 120px;">รูปแบบ</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($stickersmall))
                <tr>
                    <td class="text-center" style="width: 65px;">
                        <i class="fa fa-barcode text-success fa-2x"></i>
                    </td>
                    <td>
                        <a class="font-size-h5 font-w500" target="_bank" href="{{route('mpay.mpay_setting_defaultsticker_example',$stickersmall->CPAY_STICK_ID)}}">{{$stickersmall->CAPY_STICK_NAME}}</a>
                        <div class="text-muted mt-2 mb-1 font-size-h6 m-0">{{$stickersmall->CAPY_STICK_DETAIL}}</div>
                    </td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$stickersmall->CAPY_STICK_WIDTH}}</span> มม.</td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$stickersmall->CAPY_STICK_HEIGHT}}</span> มม.</td>
                    <td class="text-center">
                        @if($stickersmall->CAPY_STICK_FOR_LIST)
                            หลายรายการ
                        @else
                            รายการเดียว
                        @endif
                    </td>
                </tr>
                @else
                    <tr><td colspan="5" >ไม่พบรูปแบบสติ๊กเกอร์รายการเดียว</td></tr>
                @endif
            </tbody>
        </table>
        <hr>
        <h3 class="fs-16 mb-0">รูปแบบสติ๊กเกอร์ทั้งหมด</h3>
        <table class="table table-striped table-vcenter table-bordered">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th colspan="2">รายละเอียด</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">กว้าง</th>
                    <th class="d-none d-md-table-cell text-center" style="width: 90px;">สูง</th>
                    <th class="text-center" style="width: 120px;">รูปแบบ</th>
                    <th class="text-center" style="width: 90px;">ใช้งาน</th>
                    <th class="text-center" style="width: 10%;">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stickers as $row)
                <tr>
                    <td class="text-center" style="width: 65px;">
                        <i class="fa fa-barcode text-success fa-2x"></i>
                    </td>
                    <td>
                        <a class="font-size-h5 font-w500" target="_bank" href="{{route('mpay.mpay_setting_defaultsticker_example',$row->CPAY_STICK_ID)}}">{{$row->CAPY_STICK_NAME}}</a>
                        <div class="text-muted mt-2 mb-1 font-size-h6">{{$row->CAPY_STICK_DETAIL}}</div>
                        <div><strong class="font-size-sm">อัพเดต : </strong><span class="font-size-sm">{{$row->updated_at}} ({{$row->UPDATED_BY}})</span></div>
                        <!-- <em><a class="" href="#">ดูรายละเอียด</a></em> -->
                    </td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$row->CAPY_STICK_WIDTH}}</span> มม.</td>
                    <td class="d-none d-md-table-cell text-center"><span>{{$row->CAPY_STICK_HEIGHT}}</span> มม.</td>
                    <td class="text-center">
                        @if($row->CAPY_STICK_FOR_LIST)
                            หลายรายการ
                        @else
                            รายการเดียว
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-switch custom-control-success mb-1">
                            <input type="checkbox" class="custom-control-input" id="active{{$row->CPAY_STICK_ID}}" onclick="updateOpen({{$row->CPAY_STICK_ID}})" <?=($row->ACTIVE)?'checked':'';?>>
                            <label class="custom-control-label" for="active{{$row->CPAY_STICK_ID}}"></label>
                        </div>
                    </td>
                    <td style="width:10%" class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle f-kanit fw-2"
                                id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">ทำรายการ</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-align-primary"
                                x-placement="bottom-end"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                <a class="dropdown-item" href="{{route('mpay.mpay_setting_defaultsticker_edit',$row->CPAY_STICK_ID)}}">แก้ไข</a>
                                <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item" href="{{route('mpay.mpay_setting_defaultsticker_delete',$row->CPAY_STICK_ID)}}">ลบ</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('footer')
    <script>
    @if(session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
        @php(Session::forget('scc'));
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif
    
    const token = $('meta[name="csrf-token"]').attr('content');
        function updateOpen(id){
            var check = document.getElementById('active'+id).checked;
            $.ajax({
               url:"{{route('mpay.ajax_mpay_setting_defaultsticker_updateopen')}}",
               method:"POST",
               data:{onoff:check,id:id,_token:token},
               success:function (result) {
                   console.log(result);
                window.location = '{{route("mpay.mpay_setting_defaultsticker")}}';
               }
            })
        }
    </script>
@endsection