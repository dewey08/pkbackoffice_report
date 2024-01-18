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
        <div class="block-title fs-18 fw-7">จ่ายออก</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_service_export_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มจ่ายออก</a>
        </div>
    </div>
    
    <div class="block-content">
        <form action="{{route('mpay.mpay_service_export')}}" method="post" class="row">
        @csrf
            <div class="col-auto d-flex align-items-center text-center">วันที่จ่ายออก</div>
            <div class="col-md-2">
                    <input  name="export_date_start"  id="export_date_start"  class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($export_date_start)}}" readonly>
            </div>
            <div class="col-auto d-flex align-items-center text-center">ถึง</div>
            <div class="col-md-2">
                    <input  name="export_date_end"  id="export_date_end"  class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($export_date_end)}}" readonly>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button class="px-3 btn btn-sm btn-primary f-kanit">ค้นหา</button>
            </div>
        </form>
    </div>
    <div class="block-content py-3">
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-vcenter" id="table">
            <thead class="bg-sl2-b2 text-white">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">หน่วยงานที่เบิก</th>
                    <th class="text-center">ผู้เบิก</th>
                    <th class="text-center">ผู้จ่ายออก</th>
                    <th class="text-center" width="180px">วันที่จ่ายออก</th>
                    <th class="text-center">รายละเอียด</th>
                    <th class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($cpay_export as $row)
                <?php 
                $cancel_class = '';
                $detail_class = 'text-primary';
                if($row->IS_CANCEL){
                    $cancel_class = 'bg-sl2-r1';
                    $detail_class = '';
                }
                ?>
                <tr class="{{$cancel_class}}" style="cursor:pointer">
                    <td class="text-center">{{$number++}}</td>
                    <td class="">{{$row->SEND_TO_DEP_SUB_SUB_NAME}}</td>
                    <td class="">{{$row->SEND_TO_PERSON_NAME}}</td>
                    <td class="">{{$row->SENDER_PERSON_NAME}}</td>
                    <td class="">{{$row->EXPORT_DATE}} {{$row->EXPORT_TIME}}</td>
                    <td class="text-center" onclick="check_detail_export({{$row->EXPORT_ID}})"><i class="fa fa-book {{$detail_class}}"></i></td>
                    <td width="10%" class="text-center">
                        @if($row->IS_CANCEL)
                            [{{$row->EXPORT_CANCEL_BY}}] ยกเลิก
                        @else
                        @if($timecheck < strtotime($row->created_at))
                                    <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')" href="{{route('mpay.mpay_service_export_cancel',$row->EXPORT_ID)}}">ยกเลิก</a>
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


<div class="d-none" id="modal-detail-export-click" data-target="#modal-detail-export" data-toggle="modal"></div>
<!-- block data detail export -->
<div class="modal fade" id="modal-detail-export" tabindex="-1" role="dialog" aria-labelledby="modal-block-right" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-slideleft" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">รายละเอียด</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row items-push fw-b">
                                <div class="col-md-3">หน่วยงานที่เบิก</div>
                                <div class="col-md-3">: <span id="dep_send_to">data</span></div>
                                <div class="col-md-3">ผู้เบิก</div>
                                <div class="col-md-3">: <span id="person_send_to">data</span></div>
                                <div class="col-md-3">ผู้จ่ายออก</div>
                                <div class="col-md-3">: <span id="person_sender">data</span></div>
                                <div class="col-md-3">วันที่จ่ายออก</div>
                                <div class="col-md-3">: <span id="date_export">data</span> น.</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">ชุดอุปกรณ์</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center">บาร์โค้ด</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-modal"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif
    $('#table').DataTable({
        "iDisplayLength": 50,
    });
    let token = $('meta[name="csrf-token"]').attr('content');
    datepick();
   function datepick() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',
                todayHighlight: true,
                thaiyear: true,
                autoclose: true
            });
    }
    
    function check_detail_export(export_id) {
        $.ajax({
            url: '{{route("mpay.ajax_mpay_service_export_detail")}}',
            method: 'POST',
            data: {
                export_id:export_id,
                _token:token
            },
            success: function (results) {
                let result = JSON.parse(results);
                if(result.status){
                    console.log(result);
                    $('#dep_send_to').html(result.dep_send_to);
                    $('#person_send_to').html(result.person_send_to);
                    $('#person_sender').html(result.person_sender);
                    $('#date_export').html(result.date_export);
                    $('#data-modal').html(result.msg);
                    $('#modal-detail-export-click').click();
                }else{
                    Swal.fire('เกิดข้อผิดพลาด','ไม่พบข้อมูลรายละเอียดของรายการจ่ายออก','error');
                }
            }
        });
    }
</script>

@endsection