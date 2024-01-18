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
        <div class="block-title fs-18 fw-7">ชุดอุปกรณ์</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_setting_medequipment_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มชุดอุปกรณ์</a>
        </div>
    </div>
    <div class="block-content py-3">
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ชื่อภายใน</th>
                    <th class="text-center d-none d-md-table-cell">ราคา</th>
                    <th class="text-center d-none d-md-table-cell">หน่วยนับ</th>
                    <th width="180px" class="text-center">ระยะเวลาปลอดเชื้อ</th>
                    <th class="text-center">ประเภทเครื่องมือ</th>
                    <th class="text-center">รายละเอียด</th>
                    <th class="text-center" width="120px">ใช้งาน</th>
                    <th class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($setequpment as $row)
                <tr>
                    <td width="65px" class="text-center">{{$number++}}</td>
                    <td>{{$row->CPAY_SET_NAME_INSIDE}}</td>
                    <td class="text-right d-none d-md-table-cell">{{(number_format($row->CPAY_SET_PRICE,2))}}</td>
                    <td class="text-center d-none d-md-table-cell">{{$row->CPAY_UNIT_NAME}}</td>
                    <td class="text-center">{{$row->CPAY_SET_STERILE_DAY}}</td>
                    <td class="text-center">{{$row->CPAY_TYPEMACH_NAME}}</td>
                    <td class="text-center">
                        @if($row->CPAY_SET_HAVE_LIST)
                            <a id="" onclick="showdetailset({{json_encode_u($row)}})" href="#"><i class="fa fa-book"></i></a>
                        @else
                            <a><i class="fa fa-book"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="custom-control custom-switch custom-control-success mb-1">
                            <input type="checkbox" class="custom-control-input" id="active{{$row->CPAY_SET_ID}}"
                                onclick="update_active('{{$row->CPAY_SET_ID}}')" <?=($row->ACTIVE)?'checked':'';?>>
                            <label class="custom-control-label" for="active{{$row->CPAY_SET_ID}}"></label>
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
                                <a class="dropdown-item" href="{{route('mpay.mpay_setting_medequipment_edit',$row->CPAY_SET_ID)}}">แก้ไข</a>
                                <a onclick="return confirm('ต้องการลบจริงหรือไม่?')" class="dropdown-item" href="{{route('mpay.mpay_setting_medequipment_delete',$row->CPAY_SET_ID)}}">ลบ</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<button id="modalclick" class="d-none" data-toggle="modal" data-target=".bd-modal-xl"></button>
<div class="modal fade bd-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">รายการย่อยชุดอุปกรณ์</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">  
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ชื่อภายใน : </label>
                        <span id="CPAY_SET_NAME_INSIDE">-</span>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ชื่อไทย : </label>
                        <span id="CPAY_SET_NAME_TH">-</span>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ชื่ออังกฤษ : </label>
                        <span id="CPAY_SET_NAME_EN">-</span>
                    </div> 
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ยี่ห้อ : </label>
                        <span id="CPAY_SET_BRAND">-</span>
                    </div>
                </div>
                <div class="col-md-6">   
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">หน่วยนับ : </label>
                        <span id="CPAY_UNIT_NAME">-</span>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ราคา : </label>
                        <span id="CPAY_SET_PRICE">-</span>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ระยะเวลาปลอดเชื้อ : </label>
                        <span id="CPAY_SET_STERILE_DAY">-</span>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 text-right">ประเภทเครื่องมือ : </label>
                        <span id="CPAY_TYPEMACH_NAME">-</span>
                    </div>
                </div>
                <div class="col px-5">
                    <div class="form-group">
                        <label>รายละเอียด : </label>
                        <textarea id="CPAY_SET_DETAIL" class="form-control" name="" id="" cols="30" rows="2" readonly>--</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-resonsive px-5">
                    <h3 class="mb-1 fs-16 fw-3">รายการชุดอุปกรณ์</h3>
                    <table class="table table-striped table-bordered">
                        <thead></thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ชื่อ</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">หน่วยนับ</th>
                                <th class="text-center">ราคา</th>
                            </tr>
                        <tbody id="data-model">
                            <tr>
                                <td class="text-center">1</td>
                                <td>..</td>
                                <td class="text-center">..</td>
                                <td class="text-center">..</td>
                                <td class="text-right">..</td>
                            </tr>
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
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
    });
    
    function showdetailset(values){
        $.ajax({
            url: "{{route('mpay.ajax_mpay_list_medequipment')}}",
            method: "POST",
            data: {
                id: parseInt(values.CPAY_SET_ID),
                _token: token
            },
            success:function name(results) {
                $('#CPAY_SET_NAME_INSIDE').html(values.CPAY_SET_NAME_INSIDE);
                $('#CPAY_SET_NAME_TH').html(values.CPAY_SET_NAME_TH);
                $('#CPAY_SET_NAME_EN').html(values.CPAY_SET_NAME_EN);
                $('#CPAY_UNIT_NAME').html(values.CPAY_UNIT_NAME);
                $('#CPAY_SET_PRICE').html(values.CPAY_SET_PRICE);
                $('#CPAY_SET_STERILE_DAY').html(values.CPAY_SET_STERILE_DAY);
                $('#CPAY_TYPEMACH_NAME').html(values.CPAY_TYPEMACH_NAME);
                $('#CPAY_SET_BRAND').html(values.CPAY_SET_BRAND);
                $('#CPAY_SET_DETAIL').html(values.CPAY_SET_DETAIL);
                $('#data-model').html(results);
                $('#modalclick').click();
            }
        })
    }
    function update_active(id){
        var check = document.getElementById('active' + id).checked;
        $.ajax({
            url: "{{route('mpay.ajax_mpay_setting_medequipment_update_active')}}",
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