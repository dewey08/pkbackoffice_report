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
        <div class="block-title fs-18 fw-7">ตัดจ่าย</div>
        <div class="block-options fs-18 fw-7">
            <a class="btn btn-sm btn-success f-kanit" href="{{route('mpay.mpay_service_defective_add')}}"><i
                    class="fa fa-plus"></i> เพิ่มตัดจ่าย</a>
        </div>
    </div>
    <div class="block-content">
        <form action="{{route('mpay.mpay_service_defective')}}" method="post" class="row">
        @csrf
            <div class="col-auto d-flex align-items-center text-center">วันที่ตัดจ่าย</div>
            <div class="col-md-2">
                    <input  name="defective_date_start"  id="defective_date_start"  class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($defective_date_start)}}" readonly>
            </div>
            <div class="col-auto d-flex align-items-center text-center">ถึง</div>
            <div class="col-md-2">
                    <input  name="defective_date_end"  id="defective_date_end"  class="form-control input-lg datepicker f-kanit" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($defective_date_end)}}" readonly>
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
                    <th width="10%" class="text-center">#</th>
                    <th width="35%" class="text-center">ผู้ตัดจ่าย</th>
                    <th width="35%" class="text-center">วันที่ตัดจ่าย</th>
                    <th width="10%" class="text-center">รายละเอียด</th>
                    <th width="10%" class="text-center">คำสั่ง</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($cpay_defective as $row)
                <?php
                $cancel_class = '';
                $detail_class = 'text-primary';
                if($row->IS_CANCEL){
                    $cancel_class = 'bg-sl2-r1';
                    $detail_class = '';
                }
                ?>
                <tr class="{{$cancel_class}}" >
                    <td width="10%" class="text-center">{{$number++}}</td>
                    <td width="35%">{{$row->DESTROYER_PERSON_NAME}}</td>
                    <td width="35%" class="fs-15">วันที่ : {{$row->DEFECTIVE_DATE}} เวลา : {{$row->DEFECTIVE_TIME}}</td>
                    <td width="10%" class="text-center" style="cursor:pointer" onclick="check_detail_defective({{$row->DEFECTIVE_ID}})"><i class="fa fa-book {{$detail_class}}"></i></td>
                    <td width="10%" class="text-center">
                        @if($row->IS_CANCEL)
                            [{{$row->DEFECTIVE_CANCEL_BY}}] ยกเลิก
                        @else
                            @if($timecheck < strtotime($row->created_at))
                                        <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')" href="{{route('mpay.mpay_service_defective_cancel',$row->DEFECTIVE_ID)}}">ยกเลิก</a>
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


<div class="d-none" id="modal-detail-defective-click" data-target="#modal-detail-defective" data-toggle="modal"></div>
<!-- block data detail defective -->
<div class="modal fade" id="modal-detail-defective" tabindex="-1" role="dialog" aria-labelledby="modal-block-right" style="display: none;" aria-hidden="true">
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
                                <div class="col-md-3">ผู้ตัดจ่าย</div>
                                <div class="col-md-3">: <span id="person_destroyer">data</span></div>
                                <div class="col-md-3">วันที่ตัดจ่าย</div>
                                <div class="col-md-3">: <span id="date_defective">data</span> น.</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">ชุดอุปกรณ์</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center">บาร์โค้ด</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">หมายเหตุ</th>
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
    function check_detail_defective(defective_id) {
        $.ajax({
            url: '{{route("mpay.ajax_mpay_service_defective_detail")}}',
            method: 'POST',
            data: {
                defective_id:defective_id,
                _token:token
            },
            success: function (results) {
                let result = JSON.parse(results);
                if(result.status){
                    $('#person_destroyer').html(result.person_destroyer);
                    $('#date_defective').html(result.date_defective);
                    $('#data-modal').html(result.msg);
                    $('#modal-detail-defective-click').click();
                }else{
                    Swal.fire('เกิดข้อผิดพลาด','ไม่พบข้อมูลรายละเอียดของรายการตัดจ่าย','error');
                }
            }
        });
    }
</script>

@endsection