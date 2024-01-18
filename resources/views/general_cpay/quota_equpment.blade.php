@extends('layouts.general.cpay')
@section('content_cpay')
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
    <div class="block-content">
        <h3 class="block-title fs-18 fw-b">ชุดอุปกรณ์คงเหลือ</h3>
        <hr>
        <div class="table-responsive mb-3">
            <table class="table table-sl-bordered">
                <thead class="bg-sl-header">
                    <tr>
                        <th width="5%">#</th>
                        <th width="40%">ชุดอุปกรณ์</th>
                        <th width="10%">หน่วย</th>
                        <th width="15%">จำนวนที่ต้องการ</th>
                        <th width="15%">จำนวนคงเหลือ</th>
                        <th width="15%">ขาด/เกิน</th>
                    </tr>
                </thead>
                <tbody>
                    @php($number = 1)
                    @foreach($quota_equpment as $row) 
                        <tr>
                            <td class="text-center">{{$number++}}</td>
                            <td>
                                @if($row->CPAY_SET_HAVE_LIST)
                                    <a id="" onclick="showdetailset({{json_encode_u($row)}})" href="#"><i class="fa fa-book"></i></a>
                                @else
                                    <a><i class="fa fa-book"></i></a>
                                @endif
                                {{$row->CPAY_SET_NAME_INSIDE}}
                            </td>
                            <td class="text-center">{{$row->CPAY_UNIT_NAME}}</td>
                            <td class="text-center">{{$row->DEP_QUOTA_QUANTITY}}</td>
                            <td class="text-center">{{$row->DEP_QUOTA_BALANCE}}</td>
                            <td class="text-center">{{-($row->DEP_QUOTA_QUANTITY-$row->DEP_QUOTA_BALANCE)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
@section('footer_cpay')
<script src="{{asset('asset/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    const token = $('meta[name=csrf-token]').attr('content');
    $('.table').dataTable({
        'info': false,
        'lengthChange': false,
        "pageLength": 20,
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
</script>

@endsection