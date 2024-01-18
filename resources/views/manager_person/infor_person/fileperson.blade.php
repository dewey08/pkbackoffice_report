@extends('layouts.person')

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<style>
      .center {
    margin: auto;
    width: 100%;
    padding: 10px;
  }

  body {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;

  }

  .form-control {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
  }

  label {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;
  }

  th {
    text-align: center;
  }


  .text-pedding {
    padding-left: 10px;
  }

  .font-table-title{
    font-weight: bold;
    font-size: 14px;
    text-align: center;
  }

</style>

@section('content')

<div class="content">
    @if (session('success'))
        <div class="alert alert-success" align="left">
            <ul>
                <li>{{session('success')}}</li>
            </ul>
        </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ข้อมูลไฟล์แนบ</h2>
           <div class="row">
               <div class="col-sm-6" align="left">
                    <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#add_file">
                        <i class="fas fa-plus"></i>เพิ่มข้อมูลไฟล์แนบ
                    </button>
                </div>
                <div class="col-sm-6" align="right">
                    <a href="{{ url('manager_person/inforperson')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen"  ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                </div>
           </div>

            <div class="mt-3">
                <div class="panel-body" style="overflow-x:auto;">     
                    <div class="table-responsive">
                        <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                            <thead style="background-color: #FFEBCD;">
                              <tr height="40">
                                  <th class="text-font"width="5%">ลำดับ</th>
                                  <th class="text-font">ชื่อเรื่อง</th>
                                  <th class="text-font" width="10%">วันที่</th>
                                  <th class="text-font" width="10%">AttachFile</th>
                                  <th class="text-font" width="10%">คำสั่ง</th>
                              </tr>
                            </thead>
                            <?php $number = 0;  ?>
                              @foreach($infouserfile as $row)
                            <?php $number++;  ?>
                            <tbody>
                              <tr>
                              <td class="text-font text-pedding">{{$number}}</td>
                              <td class="text-font text-pedding" style="text-align: left;">{{$row->FILE_NAME}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{DateThai($row->DATE_SAVE)}}</td>
                                    @if($row->FILE_PERSON == '' || $row->FILE_PERSON == null)
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                    @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"> <a href="{{ asset('storage/filepreson/'.$row->FILE_PERSON) }}" target="_blank"><span class="btn fa fa-1.5x" style="background-color:#0000FF;color:#F0FFFF;"><i class="fa fa-paperclip"></i></span></a></td>
                                    @endif
                                <td>
                                    <div class="dropdown" align="center">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle"
                                            id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"
                                            style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                        <div class="dropdown-menu" style="width:10px">
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#edit_file{{$row->ID}}"
                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                data-toggle="modal">แก้ไขข้อมูล</a>
                                            <a class="dropdown-item"
                                                href="{{ url('manager_person/inforperson/view-fileperson_destroy/'.$row->ID.'/'.$row->PERSON_ID)  }}"
                                                onclick="return confirm('ต้องการที่จะลบข้อมูลไฟล์แนบ ?')"
                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                                        </div>
                                    </div>
                                </td> 
                              </tr>
                               <!-- The Modal edit-->
                            <div class="modal fade" id="edit_file{{$row->ID}}"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> แก้ไขข้อมูลไฟล์เเนบ</h2>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="post" id="form_edit{{$row->ID}}" action="{{ url('manager_person/inforperson/view-fileperson_update') }}" style=" font-family: 'Kanit', sans-serif;" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3 text">
                                                    <label >ชื่อเรื่อง</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="hidden" name="ID" id="ID" value="{{ $row->ID }}">
                                                    <input  type="text" required name = "FILE_NAME_EDIT"  id="FILE_NAME_EDIT" placeholder="กรุณากรอกชื่อเรื่อง..." class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" value="{{ $row->FILE_NAME }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3 text">
                                                    <label >ไฟล์เเนบ</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input  style="font-family: 'Kanit', sans-serif;" type="file" name="FILE_PERSON_EDIT" id="FILE_PERSON_EDIT" class="form-control" value="{{ $row->FILE_PERSON }}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name = "PERSON_ID_EDIT"  id="PERSON_ID_EDIT"  value="{{ $inforpersonuserid ->ID }} ">
                                    </div>
                                    <div class="modal-footer">
                                        <div align="right">
                                            <button type="sumbit"  class="btn btn-hero-sm btn-hero-info  btn-submit-edit" onclick="editnumber({{ $row->ID }});" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
                                            <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</button>
                                        </div>
                                    </div>              
                                    </form>  
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal add-->
<div class="modal fade" id="add_file"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่มข้อมูลไฟล์เเนบ</h2>
        </div>
        <div class="modal-body">
            <form  method="post"  id="form_add" action="{{ url('manager_person/inforperson/view-fileperson_save') }}" style=" font-family: 'Kanit', sans-serif;" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 text">
                        <label >ชื่อเรื่อง</label>
                    </div>
                    <div class="col-lg-9">
                        <input  type="text" required name ="FILE_NAME"  id="FILE_NAME" placeholder="กรุณากรอกชื่อเรื่อง..." class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 text">
                        <label >ไฟล์เเนบ</label>
                    </div>
                    <div class="col-lg-9">
                        <input  style="font-family: 'Kanit', sans-serif;" type="file" name="FILE_PERSON" id="FILE_PERSON" class="form-control">
                    </div>
                </div>
            </div>
            <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserid->ID }} ">
        </div>
        <div class="modal-footer">
            <div align="right">
                <button type="sumbit"  class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</button>
            </div>
        </div>              
        </form>  
</div>


@endsection
@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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

@endsection