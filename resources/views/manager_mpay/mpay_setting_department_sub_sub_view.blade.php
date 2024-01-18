@extends('layouts.mpay')
@section('css_after')
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
        <div class="block-title fs-18 fw-7">หน่วยงาน <span class="fs-12 fw-3">( จำนวน : {{count($dep)}} รายการ)</span>
        </div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_setting_department_sub_sub_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มหน่วยงาน</a>
        </div>
    </div>
    <div class="block-content py-3">
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ชื่อภายใน</th>
                    <th class="text-center">อักษรย่อ</th>
                    <th class="text-center d-none d-md-table-cell">ชื่อไทย</th>
                    <th class="text-center d-none d-md-table-cell">ชื่ออังกฤษ</th>
                    <th class="text-center d-none d-md-table-cell">รายละเอียด</th>
                    <th class="text-center" style="width:120px">ใช้งาน</th>
                    <th class="text-center" style="width:120px">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $number = 1;
                ?>
                @foreach($dep as $row)
                <tr>
                    <td width="40px" class="text-center">{{$number++}}</td>
                    <td>{{$row->CPAY_DEP_NAME_INSIDE}}</td>
                    <td class="text-center">{{$row->DEP_CODE}}</td>
                    <td class="d-none d-md-table-cell">{{$row->CPAY_DEP_NAME_TH}}</td>
                    <td class="d-none d-md-table-cell">{{$row->CPAY_DEP_NAME_EN}}</td>
                    <td class="d-none d-md-table-cell">{{$row->CPAY_DEP_DETAIL}}</td>
                    <td class="text-center">
                        <div class="custom-control custom-switch custom-control-success mb-1">
                            <input type="checkbox" class="custom-control-input" id="active{{$row->CPAY_DEP_ID}}"
                                onclick="updateOpen({{$row->CPAY_DEP_ID}})" <?=($row->ACTIVE)?'checked':'';?>>
                            <label class="custom-control-label" for="active{{$row->CPAY_DEP_ID}}"></label>
                        </div>
                    </td>
                    <td width="10%" class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle f-kanit fw-2"
                                id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">ทำรายการ</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-align-primary"
                                x-placement="bottom-end"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                <a class="dropdown-item"
                                    href="{{route('mpay.mpay_setting_department_sub_sub_edit',$row->CPAY_DEP_ID)}}">แก้ไข</a>
                                <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item"
                                    href="{{route('mpay.mpay_setting_department_sub_sub_delete',$row->CPAY_DEP_ID)}}">ลบ</a>
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
<!-- Page JS Plugins -->
<script>
    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(Session('err'))
        Swal.fire("{{session('err')}}",'','error')
    @endif
    @if(session('err_detail'))
    <?php
        $err = explode('||',session('err_detail'));
    ?>
        Swal.fire("{{$err[0]}}", "{{$err[1]}}", "error")
    @endif
    $('#table').DataTable();
    const token = $('meta[name="csrf-token"]').attr('content');
    function updateOpen(id) {
        var check = document.getElementById('active' + id).checked;
        $.ajax({
            url: "{{route('mpay.ajax_mpay_setting_department_sub_sub_updateopen')}}",
            method: "POST",
            data: {
                onoff: check,
                id: id,
                _token: token
            },
            success:function name(result) {
                console.log(result);
            }
        })
    }
</script>
@endsection