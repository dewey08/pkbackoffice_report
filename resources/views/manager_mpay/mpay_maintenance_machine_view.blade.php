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
        <div class="block-title fs-18 fw-7">ตรวจสภาพเครื่องอบ/นึ่ง</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_maintenance_machine_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มตรวจสภาพ</a>
        </div>
    </div>
    <div class="block-content py-3">
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="20%" class="text-center">ชื่อเครื่องนึ่ง/อบ</th>
                    <th width="10%" class="text-center">ผู้ตรวจสภาพเครื่อง</th>
                    <th width="10%" class="text-center">ผู้ตรวจสอบ</th>
                    <th width="10%" class="text-center">วันที่ตรวจเครื่อง</th>
                    <th width="10%" class="text-center">ผลการตรวจ</th>
                    <th width="25%" class="text-center">รายละเอียด</th>
                    <th width="10%" class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($maintenance as $row)
                <?php
                $cancel_class = '';
                if($row->IS_CANCEL){
                    $cancel_class = 'bg-sl2-r1';
                }
                ?>
                <tr class="{{$cancel_class}}">
                    <td width="5%" class="text-center">{{$number++}}</td>
                    <td width="20%">{{$row->CPAY_MACH_NAME}}</td>
                    <td width="10%">{{$row->CHECK_MACHINE_PERSON_NAME}}</td>
                    <td width="10%">{{$row->CHECK_PERSON_NAME}}</td>
                    <td width="10%">{{$row->MMAINTENANCE_TEST_DATE}} {{$row->MMAINTENANCE_TEST_TIME}}</td>
                    <td width="10%" class="text-center">
                        @if($row->MMAINTENANCE_RESULT === 1)
                            <i class="fa fa-check text-success"></i> ผ่าน
                        @else
                            <i class="fa fa-times text-danger"></i> ไม่ผ่าน
                        @endif    
                    </td>
                    <td width="25%">{{$row->MMAINTENANCE_DETAIL}}</td>
                    <td width="10%" class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle f-kanit fw-2"
                                id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">ทำรายการ</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-align-primary"
                                x-placement="bottom-end"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                <a class="dropdown-item" href="{{route('mpay.mpay_maintenance_machine_edit',$row->MMAINTENANCE_ID)}}">แก้ไข</a>
                                <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item" href="{{route('mpay.mpay_maintenance_machine_delete',$row->MMAINTENANCE_ID)}}">ลบ</a>
                            </div>
                        </div>
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

<script>

    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif
    $('#table').DataTable({
        "iDisplayLength": 10,
    });
</script>

@endsection