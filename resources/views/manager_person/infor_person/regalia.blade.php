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

if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{
    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 

?>
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
            ข้อมูลเครื่องราชอิสริยาภรณ์ 
            </div>
            <div class="col-lg-2">
              <a href="{{ url('manager_person/inforperson') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
            </div>
          </div>
            </h2>
            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add"><i
                    class="fas fa-plus"></i>เพิ่มข้อมูลเครื่องราชอิสริยาภรณ์
                </button>
                <div class="col-md-12" style="margin-top: 30px;">
                    <div class="panel-body" style="overflow-x:auto;">     
                        <div class="table-responsive">
                            <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ปีที่รับ</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">วันที่รับ</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">วันที่ประกาศ</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ชั้นตราเครื่องราช</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">รก.ล.</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">รก.ด.</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ยศ/ตำแหน่ง</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">เล่มที่</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">หน้าที่</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">ลำดับที่</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">หน่วยงาน</th>
                                        <th class="text-font text-pedding"
                                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">คำสั่ง</th>
                                    </tr>
                                </thead>
                            
                            <tbody class="tbody1">
                              <?php $number=0; ?>
                              @foreach ($inforegalias as $inforegalia)
                           
                              <tr height="40">
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ $inforegalia -> YEAR_OF_RECEIPT }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ DateThai($inforegalia -> DAY_OF_RECEIPT) }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ DateThai($inforegalia -> ANNOUNCEMENT_DATE) }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> BADGE }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ $inforegalia -> POSITION }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                  {{ $inforegalia -> AGENCY }}</td>
                                <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> VOLUME }}</td>
                                  <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> DUTY }}</td>
                                  <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> NO }}</td>
                                  <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> BADGE_R_G_L }}</td>
                                  <td class="text-font text-pedding"
                                  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> 
                                  {{ $inforegalia -> BADGE_R_G_D }}</td>
                
                                <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                  <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                      style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                      ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                      <a class="dropdown-item" href="#edit_modal{{ $inforegalia -> ID }}" data-toggle="modal"
                                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                      <a class="dropdown-item"
                                        href="{{ url('manager_person/desregalia/'.$inforegalia->id.'/'.$inforegalia->HRD_REGALIA_ID)}}"
                                        onclick="return confirm('ต้องการที่จะลบข้อมูลการศึกษา ?')"
                                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                
                                    </div>
                                  </div>
                                </td>
                
                
                              </tr>
                
                
                
                
                              <div id="edit_modal{{ $inforegalia -> ID }}" class="modal fade edit" tabindex="-1" role="dialog"
                                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                
                                      <h2 class="modal-title"
                                        style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                        แก้ไขข้อมูลเครื่องราชอิสริยาภรณ์</h2>
                                    </div>
                                    <div class="modal-body">
                
                                      <body>
                                        <form method="post"  action="{{ route('mperson.edit_regalia') }}">
                                          @csrf
                                          <input type="hidden" name="ID" id ="ID"  value="{{ $inforegalia->id }}" >

                                          <div class="row">
                                              <div class="col-md-4">
                                                    <labal>ปีที่ได้รับ</labal><br>
                                                    <span>
                                                    <select class="form-control" name="YEAR_OF_RECEIPT_EDIT" id="YEAR_OF_RECEIPT_EDIT" style="width: 100%;">
                                                        <option value="$inforegalia->YEAR_OF_RECEIPT" disable>--กรุณาเลือกปีปีที่ได้รับ--</option>
                                                        @foreach ($budget as $row)
                                                        @if( $row ->LEAVE_YEAR_ID == $inforegalia->YEAR_OF_RECEIPT)
                                                        <option value="{{ $row->LEAVE_YEAR_ID  }}" selected>{{$row->LEAVE_YEAR_ID}}</option>
                                                        @else
                                                        <option value="{{ $row->LEAVE_YEAR_ID  }}">{{ $row->LEAVE_YEAR_ID}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    </span>
                                                </div>

                                              <div class="col-md-4">
                                                <span>วันที่ได้รับ</span>
                                              <span>
                                                <input name="DAY_OF_RECEIPT_EDIT" id="DAY_OF_RECEIPT_EDIT"
                                                  class="form-control input-lg datepicker3"
                                                  data-date-format="mm/dd/yyyy"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ formate($inforegalia -> DAY_OF_RECEIPT) }}" readonly>
                                              </span>
                                              </div>

                                              <div class="col-md-4">
                                                <span>วันที่ประกาศ</span>
                                              <span>
                                                <input name="ANNOUNCEMENT_DATE_EDIT" id="ANNOUNCEMENT_DATE_EDIT"
                                                  class="form-control input-lg datepicker4"
                                                  data-date-format="mm/dd/yyyy"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ formate($inforegalia -> ANNOUNCEMENT_DATE) }}" readonly>
                                              </span>
                                              </div>
                                            

                                          <div class="col-md-4" style="margin-top:20px;">
                                            <labal><b>ชั้นตราเครื่องราช</b></labal><br>
                                            <span>
                                                <select class="form-control" name="BADGE_EDIT" id="BADGE_EDIT" style="width: 100%;">
                                                @if($inforegalia->BADGE=='ร.ง.ม.')<option value="ร.ง.ม." selected>ร.ง.ม.</option>@else<option value="ร.ง.ม.">ร.ง.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ร.ง.ช.')<option value="ร.ง.ช." selected>ร.ง.ช.</option>@else<option value="ร.ง.ช.">ร.ง.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ร.ท.ม.')<option value="ร.ท.ม." selected>ร.ท.ม.</option>@else<option value="ร.ท.ม.">ร.ท.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ร.ท.ช.')<option value="ร.ท.ช." selected>ร.ท.ช.</option>@else<option value="ร.ท.ช.">ร.ท.ช.</option>@endif
                                                @if($inforegalia->BADGE=='บ.ม.')<option value="บ.ม." selected>บ.ม.</option>@else<option value="บ.ม.">บ.ม.</option>@endif
                                                @if($inforegalia->BADGE=='บ.ช.')<option value="บ.ช." selected>บ.ช.</option>@else<option value="บ.ช.">บ.ช.</option>@endif
                                                @if($inforegalia->BADGE=='จ.ม.')<option value="จ.ม." selected>จ.ม.</option>@else<option value="จ.ม.">จ.ม.</option>@endif
                                                @if($inforegalia->BADGE=='จ.ช.')<option value="จ.ช." selected>จ.ช.</option>@else<option value="จ.ช.">จ.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ต.ม.')<option value="ต.ม." selected>ต.ม.</option>@else<option value="ต.ม.">ต.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ต.ช.')<option value="ต.ช." selected>ต.ช.</option>@else<option value="ต.ช.">ต.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ท.ม.')<option value="ท.ม." selected>ท.ม.</option>@else<option value="ท.ม.">ท.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ท.ช.')<option value="ท.ช." selected>ท.ช.</option>@else<option value="ท.ช.">ท.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ป.ม.')<option value="ป.ม." selected>ป.ม.</option>@else<option value="ป.ม.">ป.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ป.ช.')<option value="ป.ช." selected>ป.ช.</option>@else<option value="ป.ช.">ป.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ม.ว.ม.')<option value="ม.ว.ม." selected>ม.ว.ม.</option>@else<option value="ม.ว.ม.">ม.ว.ม.</option>@endif
                                                @if($inforegalia->BADGE=='ม.ป.ช.')<option value="ม.ป.ช." selected>ม.ป.ช.</option>@else<option value="ม.ป.ช.">ม.ป.ช.</option>@endif
                                                @if($inforegalia->BADGE=='ร.จ.พ.')<option value="ร.จ.พ." selected>ร.จ.พ.</option>@else<option value="ร.จ.พ.">ร.จ.พ.</option>@endif
                                                </select>
                                            </span>
                                        </div>

                                            <div class="col-md-4" style="margin-top:20px;">
                                                <span>ยศ/ตำแหน่ง</span>

                                              <span>
                                                <input name="POSITION_edit" id="POSITION_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> POSITION }}">
                                                  </span>
                                                  </div>

                                          
                                            <div class="col-md-4" style="margin-top:20px;">
                                                <span>หน่วยงาน</span>
                                              <span>
                                                <input name="AGENCY_edit" id="AGENCY_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> AGENCY }}">
                                                  </span>
                                              </div>


                                          <div class="col-md-4" style="margin-top:20px;">
                                                <span>เล่มที่</span>
                                              <span>
                                                <input name="VOLUME_edit" id="VOLUME_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> VOLUME }}">
                                              </span>
                                              </div>

                                          <div class="col-md-4" style="margin-top:20px;">
                                                <span>หน้าที่</span>
                                              <span>
                                                <input name="DUTY_edit" id="DUTY_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> DUTY }}">
                                              </span>
                                              </div>

                                          <div class="col-md-4" style="margin-top:20px;">
                                                <span>ลำดับที่</span>
                                              <span>
                                                <input name="NO_edit" id="NO_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> NO }}">
                                                  </span>
                                              </div>

                                         

                                          <div class="col-md-4" style="margin-top:20px;">
                                                <span>รก.ล.</span>
                                              <span>
                                                <input name="BADGE_R_G_L_edit" id="BADGE_R_G_L_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> BADGE_R_G_L }}">
                                                  </span>
                                              </div>

                                          <div class="col-md-4" style="margin-top:20px;">
                                                <span>รก.ต.</span>
                                              <span>
                                                <input name="BADGE_R_G_D_edit" id="BADGE_R_G_D_edit"
                                                  class="form-control input-lg"
                                                  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                                  value="{{ $inforegalia -> BADGE_R_G_D }}">
                                                  </span>
                                              </div>
                                  






                
                                          <input type="hidden" name="PERSON_ID" id="PERSON_ID"
                                            value="{{ $user_id }} ">
                                          <input type="hidden" name="USER_EDIT_ID" id="USER_EDIT_ID" value="{{ $id_user }} ">
                
                
                                    </div>
                                    <div class="modal-footer">
                                      <div align="right">
                                        <button type="submit" class="btn btn-hero-sm btn-hero-info btn btn-submit-edit"
                                         ><i class="fas fa-save"></i>
                                          &nbsp;บันทึกแก้ไขข้อมูล</button>
                                        <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i
                                            class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                                      </div>
                                    </div>
                                    </form>
                                    </body>
                
                
                                  </div>
                                </div>
                              </div>
                              <?php $number++; ?>
                
                              @endforeach
                            </tbody>
                          </table>

                        <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
            
                            <div class="modal-header">
            
                              <h2 class="modal-title"
                                style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                เพิ่มข้อมูลเครื่องราชอิสริยาภรณ์</h2>
                            </div>
                            <div class="modal-body">
            
                    <body>
                        <form method="post" id="form_add" action="{{ route('mperson.save_regalia') }}">
                                  @csrf
                                  
                                <div class="row">
                                  <div class="col-md-4">
                                        <labal>ปีที่ได้รับ</labal><br>
                                        <span>
                                        <select class="form-control" name="YEAR_OF_RECEIPT" id="YEAR_OF_RECEIPT" style="width: 100%;">
                                            <option value="" disable>--กรุณาเลือกปีปีที่ได้รับ--</option>
                                            @foreach ($budget as $row)
                                            <option value="{{ $row->LEAVE_YEAR_ID  }}">{{ $row->LEAVE_YEAR_ID}}</option>
                                            @endforeach
                                        </select>
                                        </span>
                                    </div>

                                    <div class="col-md-4">
                                        <span>วันที่ได้รับ</span>
                                        <span><input type="text" class="form-control datepicker" name="DAY_OF_RECEIPT" id="DAY_OF_RECEIPT" readonly></span>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <span>วันที่ประกาศ</span>
                                        <span><input type="text" class="form-control datepicker" name="ANNOUNCEMENT_DATE" id="ANNOUNCEMENT_DATE" readonly></span>
                                    </div>
                                </div>
           
                                    

                                  
                                <div class="row">
                                        <div class="col-md-4" style="margin-top:30px;">
                                            <labal><b>ชั้นตราเครื่องราช</b></labal><br>
                                            <span>
                                                <select class="form-control" name="BADGE" id="BADGE" style="width: 100%;">
                                                <option value="" disable>--กรุณาเลือกชั้นตราเครื่องราช--</option>
                                                <option value="ร.ง.ม.">ร.ง.ม.</option>
                                                <option value="ร.ง.ช.">ร.ง.ช.</option>
                                                <option value="ร.ท.ม.">ร.ท.ม.</option>
                                                <option value="ร.ท.ช.">ร.ท.ช.</option>
                                                <option value="บ.ม.">บ.ม.</option>
                                                <option value="บ.ช.">บ.ช.</option>
                                                <option value="จ.ม.">จ.ม.</option>
                                                <option value="จ.ช.">จ.ช.</option>
                                                <option value="ต.ม.">ต.ม.</option>
                                                <option value="ต.ช.">ต.ช.</option>
                                                <option value="ท.ม.">ท.ม.</option>
                                                <option value="ท.ช.">ท.ช.</option>
                                                <option value="ป.ม.">ป.ม.</option>
                                                <option value="ป.ช.">ป.ช.</option>
                                                <option value="ม.ว.ม.">ม.ว.ม.</option>
                                                <option value="ม.ป.ช.">ม.ป.ช.</option>
                                                <option value="ร.จ.พ.">ร.จ.พ.</option>
                                                </select>
                                            </span>
                                        </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>ยศ/ตำแหน่ง</b></span>
                                        <span><input type="text" class="form-control" name="POSITION" id="POSITION"></span>
                                    </div>
                                        
                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>หน่วยงาน</b></span>
                                        <span><input type="text" class="form-control" name="AGENCY" id="AGENCY"></span>
                                    </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>เล่มที่</b></span>
                                        <span><input type="text" class="form-control" name="VOLUME" id="VOLUME"></span>
                                    </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>หน้าที่</b></span>
                                        <span><input type="text" class="form-control" name="DUTY" id="DUTY"></span>
                                    </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>ลำดับที่</b></span>
                                        <span><input type="text" class="form-control" name="NO" id="NO"></span>
                                    </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>รก.ล.</b></span>
                                        <span><input type="text" class="form-control" name="BADGE_R_G_L" id="BADGE_R_G_L"></span>
                                    </div>

                                    <div class="col-md-4" style="margin-top:30px;">
                                        <span><b>รก.ต.</b></span>
                                        <span><input type="text" class="form-control" name="BADGE_R_G_D" id="BADGE_R_G_D"></span>
                                    </div>

                                </div>



                                  <input type="hidden" name="PERSON_ID" id="PERSON_ID" value="{{ $user_id }} ">
                                  <input type="hidden" name="USER_EDIT_ID" id="USER_EDIT_ID" value="{{ $id_user }} ">

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
                    </body>
            
            
                          </div>
                        </div>
                      </div>
                      <br>
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

  $(document).ready(function () {

    $('.datepicker4').datepicker({
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

  function editnumber(number) {
    var form = $('#form_edit' + number);
    formSubmit(form)
  }


  $('.btn-submit-add').click(function (e) {


    // เมื่อไม่มีค่าว่าง.o9kik'
    var form = $('#form_add');
    formSubmit(form)

  });



  // $('.btn-submit-edit').click(function (e) { 
  //             var form = $('#form_edit');
  //             formSubmit(form)      
  //             });
</script>



@endsection