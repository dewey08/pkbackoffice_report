@extends('layouts.backend_person')

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


<?php

// ตรวจจับว่าใครเข้ามา โดยผ่านการ Login
if(Auth::check()){
  $status = Auth::user()->status;
  $id_user = Auth::user()->PERSON_ID;   
}else{
  
  echo "<body onload=\"checklogin()\"></body>";
  exit();
} 

// <!-- การดึงค่าจาก URL ดึงเฉพาะตัวสุดท้าย โดยอันนี้คือข้อมูลของเจ้าของ-->
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
?>

@section('content')

<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                    <div class="col-lg-10"> 
                ข้อมูลการได้รับรางวัล
            </div>
            <div class="col-lg-2">
              <a href="{{ url('manager_person/inforperson') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
            </div>
          </div>
            </h2>
            
            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add"><i
                    class="fas fa-plus"></i>เพิ่มข้อมูลรางวัล
                </button>
            <div class="mt-3">
                <div class="panel-body" style="overflow-x:auto;">     
                    <div class="table-responsive">
                        <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <th width="30%">
                                        <span class="font-table-title">รางวัลที่ได้รับ/ตรา</span>
                                    </th>
                                    <th width="10%">
                                        <span class="font-table-title">วันที่ได้รับ</span>
                                    </th>
                                    <th width="10%">
                                        <span class="font-table-title">วันเริ่ม</span>
                                    </th>
                                    <th width="10%">
                                        <span class="font-table-title">วันสิ้นสุด</span>
                                    </th>
                                    <th width="30%">
                                        <span class="font-table-title">หมายเหตุ</span>
                                    </th>
                                    <th width="8%">
                                        <span class="font-table-title">คำสั่ง</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              <!-- การดึงข้อมูลขึ้นมาโชว์หน้า views -->
                            @foreach ($inforewards as $inforeward)
                              <tr height="20">
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforeward-> REWARD_NAME }}
                                </td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ DateThai($inforeward-> DATE_RECEIVE)}} </td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ DateThai($inforeward-> START_DATE)}} </td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ DateThai($inforeward-> END_DATE)}} </td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforeward-> COMMENTS }}
                                </td>

                                <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    <div class="dropdown">
                                      <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                        ทำรายการ
                                      </button>
                                      <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item" href="#edit_modal{{ $inforeward -> ID }}" data-toggle="modal"
                                          style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                          <!-- delete -->
                                        <a class="dropdown-item"
                                          href="{{ url('manager_person/desawardy/'.$inforeward->ID.'/'.$inforeward->PERSON_ID)  }}"
                                          onclick="return confirm('ต้องการที่จะลบข้อมูลการได้รับรางวัล ?')"
                                          style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                                      </div>
                                    </div>
                                  </td>
                              </tr>
                                <!-- การแก้ไขข้อมูล -->
                                <div id="edit_modal{{ $inforeward -> ID }}" class="modal fade edit" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">

                                          <h2 class="modal-title"
                                            style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                            แก้ไขข้อมูลการได้รับรางวัล</h2>
                                </div>


                                <div class="modal-body">
                                  <body>
                                    <form method="post" id="form_edit{{ $inforeward -> ID }}"
                                      action="{{ route('mperson.editawardy') }}">
                                      @csrf
                                      <input type="hidden" name="ID" value="{{ $inforeward -> ID }}" />

                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-3 text-left">
                                            <label>รางวัลที่ได้รับ/ตรา</label>
                                          </div>
                                          <div class="col-sm-9">
                                            <input name="REWARD_NAME_edit" id="REWARD_NAME_edit"
                                              class="form-control input-lg "
                                              value="{{ $inforeward -> REWARD_NAME }}"
                                              style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-3 text-left">
                                            <label>วันที่ได้รับ</label>
                                          </div>
                                          <div class="col-sm-9">
                                            <input name="DATE_RECEIVE_edit" id="DATE_RECEIVE_edit"
                                              class="form-control input-lg datepicker3 "
                                              data-date-format="mm/dd/yyyy" value="{{ formate($inforeward -> DATE_RECEIVE) }}"
                                              style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-3 text-left">
                                            <label>วันเริ่มต้น</label>
                                          </div>
                                          <div class="col-sm-9">
                                            <input name="START_DATE_edit" id="START_DATE_edit"
                                              class="form-control input-lg datepicker3 "
                                              data-date-format="mm/dd/yyyy" value="{{ formate($inforeward -> START_DATE) }}"
                                              style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-3 text-left">
                                            <label>วันสิ้นสุด</label>
                                          </div>
                                          <div class="col-sm-9">
                                            <input name="END_DATE_edit" id="END_DATE_edit"
                                              class="form-control input-lg datepicker3 "
                                              data-date-format="mm/dd/yyyy" value="{{ formate($inforeward -> END_DATE) }}"
                                              style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-3 text-left">
                                            <label>หมายเหตุ</label>
                                          </div>
                                          <div class="col-sm-9">
                                            <input name="COMMENTS" id="COMMENTS" class="form-control input-lg "
                                              value="{{ $inforeward -> COMMENTS }}"
                                              style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                          </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="PERSON_ID" id="PERSON_ID"
                                        value="{{ $user_id }}">
                                      <input type="hidden" name="USER_EDIT_ID" id="USER_EDIT_ID" value="{{ $id_user }}">
                                </div>


                                <div class="modal-footer">
                                  <div align="right">
                                    <!-- <span type="button" class="btn btn-hero-sm btn-hero-info btn-submit-edit"
                                      onclick="editnumber({{ $inforeward -> ID }});"><i class="fas fa-save"></i>
                                      &nbsp;บันทึกแก้ไขข้อมูล</span> -->

                                      <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save"></i>
                                            &nbsp; บันทึกข้อมูล</button>
                                    <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i
                                        class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                                  </div>
                                </div>
                                </form>
                                </body>
                              </div>
                            </div>
                          </div>

                          @endforeach
                           

                            </tbody>
                        </table>

                            <!--การเพิ่มข้อมูล Modal -->
                            <div class="modal fade add" id="exampleModal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mySmallModalLabel">เพิ่มข้อมูลรางวัล</h5>
                                    </div>
                                        <div class="modal-body">
                                        <form  method="post" id="form_add" action="{{ route('mperson.saveawardy') }}" >
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-3 text-left">
                                                    <label>รางวัลที่ได้รับ/ตรา</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input name="REWARD_NAME" id="REWARD_NAME"
                                                    class="form-control input-lg "
                                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;" request>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-sm-3 text-left">
                                                        <label>วันที่ได้รับ</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input name="DATE_RECEIVE" id="DATE_RECEIVE"
                                                        class="form-control input-lg datepicker "
                                                        data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                        value=" " request readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-3 text-left">
                                                    <label>วันเริ่ม</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input name="START_DATE" id="START_DATE"
                                                    class="form-control input-lg datepicker "
                                                    data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                    value=" " request readonly>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-3 text-left">
                                                    <label>วันสิ้นสุด</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input name="END_DATE" id="END_DATE"
                                                    class="form-control input-lg datepicker "
                                                    data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                    value=" " request readonly>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-3 text-left">
                                                    <label>หมายเหตุ</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input name="COMMENTS" id="COMMENTS"
                                                    class="form-control input-lg "
                                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;" request>
                                                </div>
                                                <input type="hidden" name="PERSON_ID" id="PERSON_ID" value="{{ $user_id }}">
                                                <input type="hidden" name="USER_EDIT_ID" id="USER_EDIT_ID" value="{{ $id_user }} ">
                                                
                                            </div>
                                            <div class="modal-footer">
                                            <div align="right">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save"></i>
                                                &nbsp; บันทึกข้อมูล</button>
                                                <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i
                                                    class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                                            </div>
                                            </div>
                                            </div>
                                        </form>
                            </div>
                          </div>
                        
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
  $('#edit_modal').on('show.bs.modal', function (e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

  });
</script>

<script>



  $(document).ready(function () {
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
  });

  $(document).ready(function () {
    $('.datepicker2').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
  });

  $(document).ready(function () {
    $('.datepicker3').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }); //กำหนดเป็นวันปัจุบัน
  });

  function chkmunny(ele) {
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
    ele.onKeyPress = vchar;
  }

  $('body').on('keydown', 'input, select, textarea', function (e) {
    var self = $(this),
      form = self.parents('form:eq(0)'),
      focusable, next;
    if (e.keyCode == 13) {
      focusable = form.find('input,a,select,button,textarea').filter(':visible');
      next = focusable.eq(focusable.index(this) + 1);
      if (next.length) {
        next.focus();
      } else {
        form.submit();
      }
      return false;
    }
  });

  $('.btn-submit-add').click(function (e) {
    var form = $('#form_add');
    formSubmit(form)
  });

  function editnumber(number) {
    var form = $('#form_edit' + number);
    formSubmit(form)
  }

</script>




@endsection