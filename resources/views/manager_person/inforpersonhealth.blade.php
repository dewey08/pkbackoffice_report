@extends('layouts.personhealth')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@section('css_before')

@endsection
@section('content')
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

  label {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;

  }

  .text-pedding {
    padding-left: 10px;
  }

  .form-control {
    font-size: 13px;
  }

  .text-font {
    font-size: 13px;
  }


  table,
  td,
  th {
    border: 1px solid black;
  }
</style>
<script>
  function checklogin() {
    window.location.href = '{{route("index")}}';
  }
</script>
<?php

if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{
    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 

$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>
<?php

use App\Http\Controllers\AbilityController;
?>

<body>
  <br>
  <br>
  <center>

    <div style="width:95%;">
      <div class="block block-rounded block-bordered">
        <div class="block-content">
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
            <div class="row">
              <div class="col-md-6" align="left">
                ข้อมูลผู้ตรวจสุขภาพประจำปี จำนวน {{$amount}} คน
              </div>
              <div class="col-md-6" align="right">
                <a href="{{ url('manager_person/excelinforpersonhealth')}}" class="btn btn-success btn-lg">
                  <li class="fa fa-file-excel"></li>&nbsp;Excel
                </a>
              </div>
            </div>
          </h2>


          <form action="{{ route('health.inforpersonhealth') }}" method="post">
            @csrf

            <div class="row">
              <div class="col-sm-0.5">
                &nbsp;&nbsp; ปีงบ &nbsp;
              </div>
              <div class="col-sm-1.5">
                <span>
                  <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget"
                    style=" font-family: 'Kanit', sans-serif;">
                    @foreach ($budgets as $budget)
                    @if($budget->LEAVE_YEAR_ID== $year_id)
                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                    @else
                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                    @endif
                    @endforeach
                  </select>
                </span>
              </div>

              <div class="col-sm-4 date_budget">
                <div class="row">
                  <div class="col-sm">
                    วันที่
                  </div>
                  <div class="col-md-4">

                    <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                      data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>

                  </div>
                  <div class="col-sm">
                    ถึง
                  </div>
                  <div class="col-md-4">

                    <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                      data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                  </div>
                </div>

              </div>

              <div class="col-sm-0.5">
                &nbsp;สถานะ &nbsp;
              </div>

              <div class="col-sm-2">
                <span>
                  <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg"
                    style=" font-family: 'Kanit', sans-serif;">
                    <option value="">--ทั้งหมด--</option>
                    @foreach ($infostatuss as $infostatus)
                    @if($infostatus->HEALTH_SCREEN_CODE == $status_check)
                    <option value="{{ $infostatus->HEALTH_SCREEN_CODE  }}" selected>{{ $infostatus->HEALTH_SCREEN_NAME}}
                    </option>
                    @else
                    <option value="{{ $infostatus->HEALTH_SCREEN_CODE  }}">{{ $infostatus->HEALTH_SCREEN_NAME}}</option>

                    @endif

                    @endforeach
                  </select>
                </span>
              </div>

              <div class="col-sm-0.5">
                &nbsp;ค้นหา &nbsp;
              </div>

              <div class="col-sm-2">
                <span>

                  <input type="search" name="search" class="form-control"
                    style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                </span>
              </div>

              <div class="col-sm-30">
                &nbsp;
              </div>
              <div class="col-sm-1">
                <span>
                  <button type="submit" class="btn btn-info f-kanit">ค้นหา</button>
                </span>
              </div>


            </div>
          </form>


<div class="panel-body ">
    <div class="container-fluid table-responsive">
      <table class="table-striped table-vcenter py-0" width="100%">
        <thead style="background-color: #FFEBCD;">
          <tr height="40">
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              ลำดับ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              สถานะ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              วันที่คัดกรอง</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              ชื่อ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              เพศ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              อายุ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              หน่วยงาน
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              BMI</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              ครอบครัว
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              การเจ็บป่วย</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              สูบบุรี่
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              ดื่มสุรา
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              ออกกำลังกาย</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              อาหาร</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              การขับขี่
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              เพศสัมพันธ์</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              วันที่นัด
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              เวลานัด
            </th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;">
              วันที่ตรวจ
            </th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">
              คำสั่ง</th>
          </tr>
        </thead>
        <tbody>
          <?php $number = 1; ?>
          @foreach ($infos as $info)
          <tr height="20">
            <td class="text-font" align="center"> {{ $number }}</td>
            <td align="center">
              @if($info->HEALTH_SCREEN_STATUS == 'SUCCESS')
              <span class="badge badge-success">ตรวจแล้ว</span>
              @elseif($info->HEALTH_SCREEN_STATUS == 'CONFIRM')
              <span class="badge badge-info">ยืนยันการตรวจ</span>
              @else
              <span class="badge badge-warning">คัดกรอง</span>
              @endif

            </td>

            <td class="text-font text-pedding">{{DateThai($info->HEALTH_SCREEN_DATE)}}</td>
            <td class="text-font text-pedding">{{$info->HR_PREFIX_NAME}}{{$info->HR_FNAME}}
              {{$info->HR_LNAME}}</td>

            <td class="text-font text-pedding">{{$info->SEX_NAME}}</td>
            <td class="text-font text-pedding">{{$info->HEALTH_SCREEN_AGE}}</td>
            <td class="text-font text-pedding">{{$info->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
            <td class="text-font text-pedding">{{AbilityController::checkbmi($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checkfamily($info->HEALTH_SCREEN_ID)}}
            </td>
            <td class="text-font text-pedding">{{AbilityController::checkillness($info->HEALTH_SCREEN_ID)}}
            </td>
            <td class="text-font text-pedding">{{AbilityController::checksmok($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checkdrink($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checkex($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checklike($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checkcar($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">{{AbilityController::checksex($info->HEALTH_SCREEN_ID)}}</td>
            <td class="text-font text-pedding">
              @if($info->HEALTH_SCREEN_CON_DATE != '' && $info->HEALTH_SCREEN_CON_DATE != null)
              {{DateThai($info->HEALTH_SCREEN_CON_DATE)}}

              @endif

            </td>

            <td class="text-font text-pedding">{{$info->HEALTH_SCREEN_CON_TIME}}</td>
            <td class="text-font text-pedding">


              @if($info->HEALTH_BODY_DATE != '' && $info->HEALTH_BODY_DATE != null)
              {{DateThai($info->HEALTH_BODY_DATE)}}

              @endif
            </td>

            <td align="center">
              <div class="dropdown">
                <!-- id="dropdown-align-primary" -->
                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-dropup-secondary"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                  ทำรายการ
                </button>
                <div class="dropdown-menu dropdown-menu-right aria-labelledby=" dropdown-dropup-secondary"
                  style="width:10px">

                  @if($info->HEALTH_SCREEN_STATUS == 'SCREEN')
                  <a class="dropdown-item"
                    href="{{ url('manager_person/healthConfirm/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ยืนยันแลป</a>
                  @endif
                  @if($info->HEALTH_SCREEN_STATUS == 'CONFIRM')
                  <a class="dropdown-item"
                    href="{{ url('manager_person/healthConfirm_edit/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขแลป</a>
                  <a class="dropdown-item"
                    href="{{ url('manager_person/healthBody/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ตรวจร่างกาย</a>
                  @endif
                  @if($info->HEALTH_SCREEN_STATUS == 'SUCCESS')
                  <a class="dropdown-item"
                    href="{{ url('manager_person/healthBody_edit/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขตรวจร่างกาย</a>
                  @endif
                  @if($info->HEALTH_SCREEN_STATUS == 'CONFIRM' || $info->HEALTH_SCREEN_STATUS == 'SUCCESS')
                  <a class="dropdown-item" href="{{ url('person_work/healthpdf/'.$info->HEALTH_SCREEN_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                    target="_blank">พิมพ์เอกสาร</a>
                  @endif
                  <hr class="m-0">
                  <a class="dropdown-item"
                    href="{{ url('manager_person/health_add/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดแก้ไข</a>
                  <a class="dropdown-item"
                    href="{{ url('manager_person/health_destroy/'.$info -> HEALTH_SCREEN_ID.'/'.$info -> HEALTH_SCREEN_PERSON_ID)}}"
                    onclick="return confirm('ยืนยันการลบข้อมูลลำดับที่ {{ $number }} ({{$info->HR_PREFIX_NAME}}{{$info->HR_FNAME}} {{$info->HR_LNAME}})  ?')"
                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                  <!--<a class="dropdown-item" href="{{ url('manager_person/capacity/'.$info -> HEALTH_SCREEN_PERSON_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >สมรรถภาพ</a>-->
                </div>
              </div>
            </td>

          </tr>
          <?php $number++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
</div>



@endsection
@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>
  jQuery(function () {
    Dashmix.helpers(['easy-pie-chart', 'sparkline']);
  });
</script>


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
            datepick()

            function datepick() {

              $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
              }); //กำหนดเป็นวันปัจุบัน
            }
            $('.budget').change(function () {
              if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url: "{{route('admin.selectbudget')}}",
                  method: "GET",
                  data: {
                    select: select,
                    _token: _token
                  },
                  success: function (result) {
                    $('.date_budget').html(result);
                    datepick();
                  }
                })
                // console.log(select);
              }
            });

            function chkmunny(ele) {
              var vchar = String.fromCharCode(event.keyCode);
              if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
              ele.onKeyPress = vchar;
            }
            $('table').dataTable({
              'bLengthChange': false,
              'searching': false,
            });
            /* วิธีแก้ dropdown menu หายภายใต้ table-responsive แบบ js */
            $('.table-responsive').on('show.bs.dropdown', function () {
              $('.table-responsive').css("overflow", "inherit");
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
              $('.table-responsive').css("overflow", "auto");
            })
          </script>

          @endsection