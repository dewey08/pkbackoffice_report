@extends('layouts.mpay')
@section('css_after')
<style>
    .table td{
        padding-top:2px;
        padding-bottom:2px;
    }
    .table thead tr th{
        vertical-align:middle;
    }
</style>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <div class="block-title fs-18 fw-7">โควตาแต่ละหน่วยงาน</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_setting_quota_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มโควตาแต่ละหน่วยงาน</a>
        </div>
    </div>
    <div class="block-content py-3">
        
        <form action="{{route('mpay.mpay_setting_quota')}}" method="post">
        @csrf
            <div class="row mb-2">
                <div class="col-md-1">
                    หน่วยงาน
                </div>
                <div class="col-md-4">
                    <span>
                        <select name="dep_sub_sub_id" id="dep_sub_sub_id" class="form-control input-lg f-kanit">
                            <option value="all">--ทั้งหมด--</option>
                            @foreach($dep_sub_sub as $dep)
                                @if($dep->CPAY_DEP_ID == $dep_sub_sub_id)
                                <option value="{{$dep->CPAY_DEP_ID}}" selected>{{$dep->CPAY_DEP_NAME_INSIDE}} ({{$dep->DEP_CODE}})</option>
                                @else
                                <option value="{{$dep->CPAY_DEP_ID}}">{{$dep->CPAY_DEP_NAME_INSIDE}} ({{$dep->DEP_CODE}})</option>
                                @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-2">
                    <span>
                        <button type="submit" class="btn btn-sm btn-primary js-click-ripple-enabled"><i class="fas fa-search"></i>&nbsp;ค้นหา</button>
                    </span>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ชื่อชุดอุปกรณ์</th>
                    <th class="text-center">ชื่อหน่วยงาน</th>
                    <th class="text-center" width="150px">จำนวนโควตา</th>
                    <th class="text-center" width="150px">จำนวนคงเหลือ</th>
                    <th class="text-center" width="120px">ใช้งาน</th>
                    <th class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($dep_quota as $row)
                <tr>
                    <td width="65px" class="text-center">{{$number++}}</td>
                    <td>[{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME_INSIDE}}</td>
                    <td>{{$row->CPAY_DEP_NAME_INSIDE}}</td>
                    <td class="text-center"><input id="quota_{{$row->DEP_QUOTA_ID}}" class="m-0 form-control" type="number" onblur="update_quota_quantity({{$row->DEP_QUOTA_ID}})" value="{{$row->DEP_QUOTA_QUANTITY}}"></td>
                    <td class="text-center">{{$row->DEP_QUOTA_BALANCE}}</td>
                    <td class="text-center">
                        <div class="custom-control custom-switch custom-control-success mb-1">
                            <input type="checkbox" class="custom-control-input" id="active{{$row->DEP_QUOTA_ID}}"
                                onclick="update_active('{{$row->DEP_QUOTA_ID}}')" <?=($row->ACTIVE)?'checked':'';?>>
                            <label class="custom-control-label" for="active{{$row->DEP_QUOTA_ID}}"></label>
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
                                <a class="dropdown-item" href="{{route('mpay.mpay_setting_quota_edit',$row->DEP_QUOTA_ID)}}">แก้ไข</a>
                                <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item" href="{{route('mpay.mpay_setting_quota_delete',$row->DEP_QUOTA_ID)}}">ลบ</a>
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
    // $('#modalclick').click();
    const token = $('meta[name=csrf-token]').attr('content');
    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif

    $('#table').DataTable({
            "pageLength": 50
        }
    );
    function update_quota_quantity(quota_id) {
        var quota_quantity = document.getElementById('quota_' + quota_id).value;
        $.ajax({
            url: "{{route('mpay.ajax_mpay_setting_quota_update_quantity')}}",
            method: "POST",
            data: {
                id: quota_id,
                quota: quota_quantity,
                _token: token
            },
            success:function(results) {
                let result = JSON.parse(results);
                if(result.status === 'success'){
                    Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: result.msg });
                }else{
                    Dashmix.helpers('notify', {type: 'error', icon: 'fa fa-times mr-1', message: result.msg });
                }
            }
        })
    }

    function update_active(id){
        var check = document.getElementById('active' + id).checked;
        $.ajax({
            url: "{{route('mpay.ajax_mpay_setting_quota_update_active')}}",
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