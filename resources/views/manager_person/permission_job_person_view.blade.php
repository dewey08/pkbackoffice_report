@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
  .center {
    margin: auto;
    width: 100%;
    padding: 10px;
  }

  body {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;

  }

  label {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;

  }

  .text-pedding {
    padding-left: 10px;
  }

  .text-font {
    font-size: 13px;
  }
  .p-5px td{
    padding:5px;
  }
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto">
  <div class="block block-rounded block-bordered">
    <div class="block-header">
      <div class="block-title">
        กำหนดผู้ถูกประเมิน KPI โดย {{$permission_person->HR_FNAME}}  {{$permission_person->HR_LNAME}}
      </div>
      <div class="block-options">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCenter">
          <i class="fas fa-plus mr-2"></i>เพิ่มผู้ถูกประเมิน
        </button>
        <a href="{{route('mperson.permission_job')}}" class="btn btn-info">ย้อนกลับ</a>
      </div>
    </div>
    <div class="block-content mb-2">
      <div class="table-responsive">
        <table class="gwt-table table-striped table-vcenter" width="100%">
          <thead style="background-color: #FFEBCD;">
            <tr height="40">
              <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
              <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อ นามสกุล</th>
              <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
              <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">ลบ</th>
            </tr>
          </thead>
          <tbody>
            @php($number = 1)
            @foreach($person as $row)
            <tr class="p-5px">
              <td class="text-center">{{$number++}}</td>
              <td>{{$row->HR_FNAME}}   {{$row->HR_LNAME}}</td>
              <td>{{$row->POSITION_IN_WORK}}</td>
              <td class="text-center">
                <a href="{{route('mperson.permission_job_person.delete',$row->IWJOB_PERMIS_LIST_ID)}}" class="btn btn-danger" onclick="return confirm('ต้องการที่จะลบข้อมูล {{$row->HR_FNAME}}   {{$row->HR_LNAME}}?')"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalCenter" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{route('mperson.permission_job_person_save')}}" method="post">
        @csrf
        <input type="hidden" name="permis_id" value="{{$permission_person->IWJOB_PERMIS_ID}}">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalCenterTitle">เพิ่มข้อมูลผู้ประเมิน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-lg-2">
                <label>ชื่อ นามสกุล</label>
              </div>
              <div class="col-lg-8">
                <select name="person_id" id="person_id" class="select2 form-control"
                  data-placeholder="--กรุณาเลือกชื่อเจ้าหน้าที่--">
                  @foreach($personel as $row)
                  <option value="{{$row->ID}}">{{$row-> HR_FNAME}} {{$row->HR_LNAME}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>บันทึก</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i
              class="fas fa-window-close mr-2"></i>ยกเลิก</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
@section('footer')
<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
<script>
    @if(Session::has('scc'))
    Swal.fire("{{Session('scc')}}",'','success')
    @endif
    @if(Session::has('err'))
    Swal.fire("{{Session('err')}}",'','error')
    @endif
</script>
@endsection