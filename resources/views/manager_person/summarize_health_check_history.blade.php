@extends('layouts.personhealth')
@section('css_before0')
  <link rel="stylesheet" href="{{asset('asset/js/plugins/select2/css/select2.min.css')}}">
@endsection
@section('content')
<?php
  use App\Http\Controllers\AbilityController;
?>
<div style="width:95%; margin:4rem auto">
  <div class="block block-rounded block-bordered">
    <div class="block-content">
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
        <div class="row">
          <div class="col-md-6" align="left">
            ข้อมูลประวัติการตรวจสุขภาพรายบุคคล
          </div>
        </div>
      </h2>
      <form action="{{ route('health.summarize_health_check_history') }}" method="post">
        @csrf
        <div class="row fs-16">
          <div class="col-sm-1 d-flex justify-content-center align-items-center">
              รายชื่อ
          </div>
          <div class="col-sm-2" style="font-size:16px !important">
              <select name="person_id" id="person_id" class="select2 form-control f-kanit" data-placeholder="--กรุณาเลือกราชื่อ--" style="font-size:16px !important">
                <option></option>
                @foreach ($person_list as $person)
                @if($person->ID == $person_id)
                <option value="{{$person->ID}}" selected>{{$person->HR_FNAME.' '.$person->HR_LNAME}}
                </option>
                @else
                <option value="{{$person->ID}}">{{$person->HR_FNAME.' '.$person->HR_LNAME}}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="col-sm-1">
            <span>
              <button type="submit" class="btn btn-info f-kanit">ค้นหา</button>
            </span>
          </div>


        </div>
      </form>
      <div class="panel-body mt-3 fs-14">
        <div class="container-fluid table-responsive">
          <table class="table-striped table-vcenter py-0 table-sl-bordered" width="100%">
            <thead style="background-color: #FFEBCD;">
              <tr height="40" >
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ลำดับ</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  สถานะ</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  วันที่คัดกรอง</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ชื่อ</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  เพศ</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  อายุ</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  หน่วยงาน
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  BMI</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ครอบครัว
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  การเจ็บป่วย</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  สูบบุรี่
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ดื่มสุรา
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ออกกำลังกาย</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  อาหาร</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  การขับขี่
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  เพศสัมพันธ์</th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  วันที่นัด
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  เวลานัด
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  วันที่ตรวจ
                </th>
                <th class="text-font p-0" style="border-color:#F0FFFF; text-align: center;border: 1px solid black;padding:5px;vertical-align: middle;">
                  ปีงบ
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $number = 1; ?>
              @foreach ($screen_body as $info)
              <tr height="20">
                <td class="text-font" align="center"> {{ $number }}</td>
                <td align="center" class="fs-16">
                  @if($info->HEALTH_SCREEN_STATUS == 'SUCCESS')
                  <span class="badge badge-success">ตรวจแล้ว</span>
                  @elseif($info->HEALTH_SCREEN_STATUS == 'CONFIRM')
                  <span class="badge badge-info">ยืนยันการตรวจ</span>
                  @else
                  <span class="badge badge-warning">คัดกรอง</span>
                  @endif

                </td>

                <td class="text-font p-1">{{DateThai($info->HEALTH_SCREEN_DATE)}}</td>
                <td class="text-font p-1">{{$info->HR_PREFIX_NAME}}{{$info->HR_FNAME}}
                  {{$info->HR_LNAME}}</td>

                <td class="text-font p-1">{{$info->SEX_NAME}}</td>
                <td class="text-font p-1">{{$info->HEALTH_SCREEN_AGE}}</td>
                <td class="text-font p-1">{{$info->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checkbmi($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checkfamily($info->HEALTH_SCREEN_ID)}}
                </td>
                <td class="text-font p-1 text-center">{{AbilityController::checkillness($info->HEALTH_SCREEN_ID)}}
                </td>
                <td class="text-font p-1 text-center">{{AbilityController::checksmok($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checkdrink($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checkex($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checklike($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checkcar($info->HEALTH_SCREEN_ID)}}</td>
                <td class="text-font p-1 text-center">{{AbilityController::checksex($info->HEALTH_SCREEN_ID)}}</td>

                <td class="text-font p-1">
                  @if($info->HEALTH_SCREEN_CON_DATE != '' && $info->HEALTH_SCREEN_CON_DATE != null)
                  {{DateThai($info->HEALTH_SCREEN_CON_DATE)}}

                  @endif

                </td>

                <td class="text-font p-1">{{$info->HEALTH_SCREEN_CON_TIME}}</td>
                <td class="text-font p-1">


                  @if($info->HEALTH_BODY_DATE != '' && $info->HEALTH_BODY_DATE != null)
                  {{DateThai($info->HEALTH_BODY_DATE)}}

                  @endif
                </td>
                <td class="text-font p-1">{{$info->HEALTH_SCREEN_YEAR}}</td>
              </tr>
              <?php $number++; ?>
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
<script src="{{ asset('asset/js/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
<script>
  $('.select2').select2();
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