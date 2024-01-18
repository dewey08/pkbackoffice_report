@extends('layouts.backend_admin')
@section('css_after')
<link rel="stylesheet" href="{{asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.css')}}">
<style>
  td {
    font-size: 16px !important;
  }
</style>
@endsection
@section('content')
<!-- Advanced Tables -->
<div class="content mb-5">
  <div class="block block-rounded block-bordered">
    <div class="block-content mb-3">
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าลิงค์ประชาสัมพันธ์</h2>
      <a href="{{ route('admin.setupinfo.publicize_add') }}" class="btn btn-hero-sm btn-hero-info"><i
          class="fas fa-plus"></i> เพิ่มลิงก์ประชาสัมพันธ์</a>
      <div class="block-content">
        <div class="table-responsive">
          <table class="gwt-table table-striped table-vcenter" id="table" style="width:100%">
            <colgroup>
              <col width="5%">
              <col width="10%">
              <col width="15%">
              <col width="36%">
              <col width="8%">
              <col width="8%">
              <col width="8%">
              <col width="10%">
            </colgroup>
            <thead style="background-color: #FFEBCD;" class="fw-b fs-20">
              <tr height="40">
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ภาพปก</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อ</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียด</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">วันที่เผยแพร่</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">วันที่แก้ไขล่าสุด</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">สถานะเผยแพร่</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>
              </tr>
              </tr>
            </thead>
            <tbody>
              @foreach($publicize as $row)
              <tr>
                <td class="text-center">{{$row->IPUB_ID}}</td>
                <td class="text-center p-2">
                  @if(!empty($row->IPUB_IMG))
                  <img width="100%" src="data:image/jpeg;base64,{{base64_encode($row->IPUB_IMG)}}" />
                  @else
                  <img width="100%" src="{{asset('image/information_publicize.png')}}" />
                  @endif
                </td>
                <td class="p-1" style="vertical-align:top">
                  <a href="{{$row->IPUB_LINK}}" class="text-info f-u fw-b fs-20" target="_blank"
                    rel="noopener noreferrer">{{$row->IPUB_NAME}}</a>
                </td>
                <td class="p-1" style="vertical-align:top;">{{$row->IPUB_DETAIL}}</td>
                <td class="p-1" style="vertical-align:top">
                  วันที่ {{$row->IPUB_DATE}}<br>
                  เวลา {{$row->IPUB_TIME}} น.
                </td>
                <td class="p-1" style="vertical-align:top">
                  วันที่ {{date('Y-m-d',strtotime($row->updated_at))}}<br>
                  เวลา {{date('H:i:s',strtotime($row->updated_at))}} น.
                </td>
                <td class="p-1 text-center">
                  <div class="custom-control custom-switch custom-control-success">
                    <input type="checkbox" class="custom-control-input bg-success" id="IPUB_ACTIVE"
                      {{$row->IPUB_ACTIVE?'checked':''}} readonly>
                    <label class="custom-control-label"></label>
                  </div>
                </td>
                <td width="10%" class="text-center p-1">
                  <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ทำรายการ
                    </button>
                    <div class="dropdown-menu" style="width:10px">
                      <a class="dropdown-item" href="{{route('admin.setupinfo.publicize_edit',$row->IPUB_ID)}}">แก้ไขข้อมูล</a>
                      <a class="dropdown-item" href="{{route('admin.setupinfo.publicize_delete',$row->IPUB_ID)}}"
                        onclick="return confirm('ต้องการลบรหัส {{$row->IPUB_ID}} จริงหรือไม่ ?')">ลบข้อมูล</a>
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
  </div>
</div>
@endsection
@section('footer')
<script src="{{asset('asset/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<!-- Page JS Code -->
<script src="{{asset('asset/js/plugins/es6-promise/es6-promise.auto.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  @if(Session::has('scc'))
  Swal.fire("{{Session('scc')}}", '', 'success')
  @endif
  // Swal.fire("ข้อมูล",'','success')

  $('#table').DataTable({
    "info": false,
    // scrollY: 400, 
    "lengthChange": false,
    paging: true,
    searching: false,
    "order": [
      [4, "desc"]
    ],
    ordering: true,
    select: true,
  });
</script>
@endsection