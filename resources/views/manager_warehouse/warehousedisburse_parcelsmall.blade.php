@extends('layouts.warehouse')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

@section('content')

<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 




?>
<?php
  use App\Http\Controllers\ManagerwarehouseController;
?>
<style>
  body {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;

  }

  .form-control {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
  }
  }

  .text-pedding {
    padding-left: 10px;
  }

  table, td, th {
            border: 1px solid black;
            }  
</style>

<body onload="run01();">

  <center>
    <div class="block" style="width: 95%;">
      <div class="block-header block-header-default">
        <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>

            จัดสรรวัสดุจ่ายคลังย่อย รพสต.

          </B></h3>

      </div><br>

      <form method="post" action="{{ route('mwarehouse.updateinfopayparcel_small') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="YEAR_ID" id="YEAR_ID" value="{{$YEAR_ID}}">
        <input type="hidden" name="DATE_BIGIN" id="DATE_BIGIN" value="{{$DATE_BIGIN}}">
        <input type="hidden" name="DATE_END" id="DATE_END" value="{{$DATE_END}}">
        <input type="hidden" name="SEND_STATUS" id="SEND_STATUS" value="{{$SEND_STATUS}}">
        <input type="hidden" name="INVEN_STATUS" id="INVEN_STATUS" value="{{$INVEN_STATUS}}">
        <input type="hidden" name="search" id="search" value="{{$search}}">


    

        <input type="hidden" name="WAREHOUSE_INVEN_ID" id="WAREHOUSE_INVEN_ID" class="form-control input-sm"
        style=" font-family: 'Kanit', sans-serif;" value="{{$infowarehouserequest->WAREHOUSE_INVEN_ID}}">

        <input type="hidden" name="WAREHOUSE_ID" id="WAREHOUSE_ID" class="form-control input-sm"
          style=" font-family: 'Kanit', sans-serif;" value="{{$infowarehouserequest->WAREHOUSE_ID}}">
        <input type="hidden" name="WAREHOUSE_USER_CONFIRM_CHECK_ID" id="WAREHOUSE_USER_CONFIRM_CHECK_ID"
          class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">

        <div class="col-sm-12" style="text-align: left">
          <div class="row">
            <div class="col-lg-1" style="text-align: left">
              <label>
                รหัส :
              </label>
            </div>
            <div class="col-lg-2">
              {{$infowarehouserequest->WAREHOUSE_REQUEST_CODE}}
            </div>
            <div class="col-lg-1" style="text-align: left">
              <label>
                วันที่ต้องการ :
              </label>
            </div>
            <div class="col-lg-2">
              {{DateThai($infowarehouserequest->WAREHOUSE_DATE_WANT)}}
            </div>
            <div class="col-lg-1" style="text-align: left">
              <label>
                เหตุผล:
              </label>
            </div>
            <div class="col-lg-2">
              {{$infowarehouserequest->WAREHOUSE_REQUEST_BUY_COMMENT}}
            </div>
         

          <div class="col-lg-1" style="text-align: left">
              <label>วันที่จ่าย :</label>
            </div>
            <div class="col-lg-2">
            @if($infowarehouserequest->WAREHOUSE_PAYDAY <> '' && $infowarehouserequest->WAREHOUSE_PAYDAY <> null)
            <input name="WAREHOUSE_PAYDAY" id="WAREHOUSE_PAYDAY" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{ formate($infowarehouserequest->WAREHOUSE_PAYDAY) }}" readonly>
            @else
            <input name="WAREHOUSE_PAYDAY" id="WAREHOUSE_PAYDAY" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{ formate(date('Y-m-d')) }}" readonly>
            @endif
           

            </div>
            </div>
          <br>

          <div class="row">

            <div class="col-lg-1" style="text-align: left">
              <label>ผู้ขอเบิก :</label>
            </div>
            <div class="col-lg-2">
              {{$infowarehouserequest->WAREHOUSE_SAVE_HR_NAME}}
            </div>
            <div class="col-lg-1 " style="text-align: left">
              <label>หน่วยงานที่ขอ :</label>
            </div>
            <div class="col-lg-2">
              {{$infowarehouserequest->WAREHOUSE_SMALLHOS_NAME}}
            </div>
         
            <div class="col-lg-1" style="text-align: left">
              <label>ประเภทรอบ :</label>
            </div>
            <div class="col-lg-2">

              <select name="WAREHOUSE_TYPE_CYCLE" id="WAREHOUSE_TYPE_CYCLE" class="form-control input-sm "
                style=" font-family: 'Kanit', sans-serif;">

                @foreach ($warehousedisbursecycles as $warehousedisbursecycle)
                <option value="{{ $warehousedisbursecycle -> ID_CYCLE }}">
                  {{ $warehousedisbursecycle -> CYCLE_DISBURSE_NAME }}</option>
                @endforeach
              </select>

            </div>
          </div>
          <br>

          <div class="col-sm-12 row" align="right">
            <div class="col-sm-7"></div>
            <div class="col-sm-1"><label>รวมมูลค่า </div>
            <div class="col-sm-3 text-left"><input class="form-control input-sm "
                style="text-align: center;background-color:#E0FFFF ;font-size: 13px;" type="text" name="total"
                id="total" readonly></div>
            <div class="col-sm-1"><label> บาท</label></div>
          </div><br>

          <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
            <thead style="background-color: #FFEBCD;">

              <tr>
                <td style="text-align: center; font-size: 13px;">ลำดับ</td>
                <td style="text-align: center; font-size: 13px;" width="20%">รายการรับเข้า</td>
                <td style="text-align: center; font-size: 13px;">LOT</td>
                <td style="text-align: center; font-size: 13px;">ล็อตผลิต</td>
                <td style="text-align: center; font-size: 13px;">คงเหลือ</td>
                <td style="text-align: center; font-size: 13px;" width="5%">หน่วย</td>
                <td style="text-align: center; font-size: 13px;" width="8%">จำนวนขอเบิก</td>
                <td style="text-align: center; font-size: 13px;" width="8%">จำนวนจ่าย</td>
                <td style="text-align: center; font-size: 13px;">ราคาต่อหน่วย</td>
                <td style="text-align: center; font-size: 13px;" width="10%">มูลค่า</td>

                <td style="text-align: center; font-size: 13px;">วันที่ผลิต</td>
                <td style="text-align: center; font-size: 13px;">วันที่หมดอายุ</td>
                <td style="text-align: center; font-size: 13px;" width="5%"><a class="btn btn-success addRow"
                    style="color:#FFFFFF;"><i class=" fa fa-plus "></i></a></td>
              </tr>
            </thead>
            <tbody class="tbody1">

              @if($count == 0)
              <tr style="text-align: center; font-size: 13px;">
                <td style="text-align: center; font-size: 13px;">
                  1
                </td>

                <td style="text-align: left; font-size: 13px;  padding-left:10px;">

                </td>
                <td>

                  <button type="button" class="btn btn-info" data-toggle="modal" data-target=".addsup"
                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;"
                    onclick="detailsup(null,null,0,null)" ;>LOT</button>

                </td>
                <td class="infosupselectlot">
                  -
                </td>

                <td class="infosupselecttotal">

                </td>

                <td class="infosupselectunit">

                </td>
                <td style="text-align: center;">

                  <input type="hidden" name="WAREHOUSE_REQUEST_SUB_AMOUNT[]" id="WAREHOUSE_REQUEST_SUB_AMOUNT[]"
                    class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
                </td>
                <td>
                  <input style="text-align: center; " name="WAREHOUSE_REQUEST_SUB_AMOUNT_PAY[]" id="RECEIVE_SUB_AMOUNT"
                    class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
                </td>
                <td class="infosupselectpiceunit">

                </td>
                <td style="text-align: center; font-size: 13px;">
                  <div class="summoney"></div>
                </td>

                <td class="infosupselectdatget">

                </td>
                <td class="infosupselectdatexp">

                </td>

                <td style="text-align: center;"><a class="btn btn-danger remove"
                    style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
              </tr>

              @else

              <?php $count=1;?>
              @foreach ($infowarehouserequestsubs as $infowarehouserequestsub)
            
              <tr style="text-align: center; font-size: 13px;">
                <td style="text-align: center; font-size: 13px;">
                  {{$count}}
                </td>

                <td style="text-align: left; font-size: 13px;  padding-left:10px;" class="infosupselect{{$count}}">
                  {{ $infowarehouserequestsub->SUP_NAME }}
                  <input type="hidden" name="RECEIVE_SUB_ID[]" id="RECEIVE_SUB_ID" class="form-control input-sm"
                    value="{{$infowarehouserequestsub->RECEIVE_SUB_ID}}">
                  <input type="hidden" name="WAREHOUSE_REQUEST_SUB_DETAIL_ID[]" id="WAREHOUSE_REQUEST_SUB_DETAIL_ID"
                    class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_DETAIL_ID}}">

                </td>
                <td>

                  <button type="button" class="btn btn-info" data-toggle="modal" data-target=".addsup"
                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;"
                    onclick="detailsup({{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_ID}},{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_DETAIL_ID}},{{$count}},null);">LOT</button>

                </td>

                <td class="infosupselectlot{{$count}}">
                  {{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_LOT}}
                  <input type="hidden" name="WAREHOUSE_REQUEST_SUB_LOT[]" id="WAREHOUSE_REQUEST_SUB_LOT"
                    class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_LOT}}">
                </td>

                <td class="infosupselecttotal{{$count}}">
                    {{ManagerwarehouseController::selectsuptotal_edit($infowarehouserequestsub->RECEIVE_SUB_ID,$count)}}
                    <input type="hidden" name="EXPORT_SUB_VALUE[]" id="EXPORT_SUB_VALUE{{$count}}" class="form-control input-sm" value="{{ManagerwarehouseController::selectsuptotal_edit($infowarehouserequestsub->RECEIVE_SUB_ID,$count)}}">
                
                  </td>

                <td class="infosupselectunit{{$count}}">

                  {{$infowarehouserequestsub->SUP_UNIT_NAME}}
                  <input type="hidden" name="WAREHOUSE_REQUEST_SUB_UNIT[]" id="WAREHOUSE_REQUEST_SUB_UNIT"
                    class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_UNIT}}">

                </td>
                <td style="text-align: center;">
   
                  <input type="text" style="text-align: center;" name="WAREHOUSE_REQUEST_SUB_AMOUNT[]" id="WAREHOUSE_REQUEST_SUB_AMOUNT[]"
                    class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"
                    value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_AMOUNT}}">
                </td>
                <td>
                  <input style="text-align: center; " name="WAREHOUSE_REQUEST_SUB_AMOUNT_PAY[]"
                    id="RECEIVE_SUB_AMOUNT{{$count}}" class="form-control input-sm"
                    style=" font-family: 'Kanit', sans-serif;"
                    value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_AMOUNT_PAY}}"
                    onkeyup="checksummoney({{$count}}),checktotal({{$count}})">
                </td>
                <td class="infosupselectpiceunit{{$count}}">
                  {{number_format($infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_PRICE,5)}}
                  <input type="hidden" name="WAREHOUSE_REQUEST_SUB_PRICE[]" id="RECEIVE_SUB_PICE_UNIT{{$count}}" class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_PRICE}}">
                </td>
                <td style="text-align: center; font-size: 13px;">
                  <div class="summoney{{$count}}"></div>
                </td>

                <td class="infosupselectdatget{{$count}}">
                  {{DateThai($infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_GEN_DATE)}}<input type="hidden"
                    name="WAREHOUSE_REQUEST_SUB_GEN_DATE[]" id="WAREHOUSE_REQUEST_SUB_GEN_DATE"
                    class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_GEN_DATE}}">
                </td>
                <td class="infosupselectdatexp{{$count}}">
                  {{DateThai($infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_EXP_DATE)}}<input type="hidden"
                    name="WAREHOUSE_REQUEST_SUB_EXP_DATE[]" id="WAREHOUSE_REQUEST_SUB_EXP_DATE"
                    class="form-control input-sm" value="{{$infowarehouserequestsub->WAREHOUSE_REQUEST_SUB_EXP_DATE}}">
                </td>

                <td style="text-align: center;"><a class="btn btn-danger remove"
                    style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
              </tr>

        </div>
        <?php  $count++;?>

        @endforeach

        @endif
        </tbody>
        </table>

        <div class="modal-footer">
          <div align="right">
            <button type="submit" name="SUBMIT" class="btn btn-hero-sm btn-hero-info" value="approved"
            style="font-family: 'Kanit', sans-serif;font-weight:normal;">จัดสรร</button>
            <button type="submit" name="SUBMIT" class="btn btn-hero-sm btn-hero-danger" value="not_approved"
            style="font-family: 'Kanit', sans-serif;font-weight:normal;">ไม่ผ่าน</button>
            <a href="{{ url('manager_warehouse/disbursesmall')  }}" style="font-weight:normal;" class="btn btn-hero-sm btn-hero-secondary">ปิดหน้าต่าง</a>
          </div>

        </div>
      </form>

      <!--    เมนูเลือก   -->

      <div class="modal fade addsup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        id="modeladdsup">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title"
                style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                เลือกวัสดุที่ต้องการจ่าย</h2>
            </div>
            <div class="modal-body">

              <body>
                <div class="container mt-3">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>
                  <div style='overflow:scroll; height:300px;'>

                    <div id="detailsup"></div>

                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <div align="right">
                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"
                  >ปิดหน้าต่าง</button>
              </div>
            </div>
</body>
</div>
</div>
</div>

@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>
  jQuery(function() {
    Dashmix.helpers(['masked-inputs']);
  });
</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>

  
function run01() {
    var count = $('.tbody1').children('tr').length;
   
    var number;
    for (number = 1; number < count + 1; number++) {
      checksummoney(number);
    
    }
  }


  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }); //กำหนดเป็นวันปัจุบัน
  });

  function datepicker(number) {
    $('.datepicker' + number).datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
  }


  function detailsup(id, idsup, count, store_id) {
    $.ajax({
      url: "{{route('mwarehouse.detailsup')}}",
      method: "GET",
      data: {
        id: id,
        idsup: idsup,
        count: count,
        store_id: store_id,
      },
      success: function(result) {
        $('#detailsup').html(result);
      }
    })
  }

  function selectsup(idsup, count) {
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url: "{{route('mwarehouse.selectsup')}}",
      method: "GET",
      data: {
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselect' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsuplot')}}",
      method: "GET",
      data: {
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselectlot' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsuptotal')}}",
      method: "GET",
      data: {
        count: count,
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselecttotal' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsupunit')}}",
      method: "GET",
      data: {
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselectunit' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsuppiceunit')}}",
      method: "GET",
      data: {
        idsup: idsup,
        count: count,
        _token: _token
      },
      success: function(result) {
        $('.infosupselectpiceunit' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsupdatget')}}",
      method: "GET",
      data: {
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselectdatget' + count).html(result);
      }
    })
    $.ajax({
      url: "{{route('mwarehouse.selectsupdatexp')}}",
      method: "GET",
      data: {
        idsup: idsup,
        _token: _token
      },
      success: function(result) {
        $('.infosupselectdatexp' + count).html(result);
      }
    })
    $('#modeladdsup').modal('hide');
  }
  $('.addRow').on('click', function() {
    addRow();
    var count = $('.tbody1').children('tr').length;
    var number = (count).valueOf();
    datepicker(number);
  });

  function addRow() {


    var INVEN_ID = document.getElementById("WAREHOUSE_INVEN_ID").value;
    
    var count = $('.tbody1').children('tr').length;
    var number = (count + 1).valueOf();
    var tr = '<tr style="text-align: center;">' +
      '<td style="text-align: center;">' +
      +number +
      '</td>' +
      '<td  style="text-align: left; font-size: 13px;  padding-left:10px;" class="infosupselect' + number + '">' +
      '</td>' +
      '<td> ' +
      '<button type="button" class="btn btn-info" data-toggle="modal" data-target=".addsup" style="font-family: \'Kanit\', sans-serif; font-size: 10px;font-weight:normal;" onclick="detailsup(null,null,' +
      number + ','+INVEN_ID+');" >LOT</button>' +
      '</td>' +
      '<td class="infosupselectlot' + number + '">' +
      '-' +
      '</td>' +
      '<td class="infosupselecttotal' + number + '">' +
      '</td>' +
      '<td class="infosupselectunit' + number + '">' +
      '</td>' +
      '<td style="text-align: center;" >' +
      '<input style="text-align: center; type="text" name="WAREHOUSE_REQUEST_SUB_AMOUNT[]" id="WAREHOUSE_REQUEST_SUB_AMOUNT' +
      number + '" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >' +
      '</td>' +
      '<td >' +
      '<input style="text-align: center; " name="WAREHOUSE_REQUEST_SUB_AMOUNT_PAY[]" id="RECEIVE_SUB_AMOUNT' +
      number +
      '" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  onkeyup="checksummoney(' +
      number + '),checktotal(' + number + ')">' +
      '</td>' +
      ' <td class="infosupselectpiceunit' + number + '">' +
      '</td>' +
      '<td style="text-align: center; font-size: 13px;">' +
      '<div class="summoney' + number + '"></div>' +
      '</td>' +
      '<td class="infosupselectdatget' + number + '">' +
      ' </td>' +
      '<td class="infosupselectdatexp' + number + '">' +
      ' </td>' +
      '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
      '</tr>';
    $('.tbody1').append(tr);
  };
  $('.tbody1').on('click', '.remove', function() {
    $(this).parent().parent().remove();
  });
  $('body').on('keydown', 'input, select, textarea', function(e) {
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
  //-----------------------------------------------------
  function checktotal(number) {
    var SUP_TOTAL = Number(document.getElementById("RECEIVE_SUB_AMOUNT" + number).value);
    var EXPORT_SUB_VALUE = Number(document.getElementById("EXPORT_SUB_VALUE" + number).value);
    if (EXPORT_SUB_VALUE < SUP_TOTAL) {
      alert("ของในคลังมีไม่เพียงพอในการจ่าย !!");
      document.getElementById('RECEIVE_SUB_AMOUNT' + number).value = EXPORT_SUB_VALUE;
    }
  }

  function checksummoney(number) {
    var SUP_TOTAL = document.getElementById("RECEIVE_SUB_AMOUNT" + number).value;
    var PRICE_PER_UNIT = document.getElementById("RECEIVE_SUB_PICE_UNIT" + number).value;
    //alert(PERSON_ID);
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url: "{{route('msupplies.checksummoney')}}",
      method: "GET",
      data: {
        SUP_TOTAL: SUP_TOTAL,
        PRICE_PER_UNIT: PRICE_PER_UNIT,
        _token: _token
      },
      success: function(result) {
        $('.summoney' + number).html(result);
        findTotal();
      }
    })
  }

  function findTotal() {
    var arr = document.getElementsByName('sum');
    var tot = 0;
    count = $('.tbody1').children('tr').length;
    for (var i = 0; i < count; i++) {
      tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value = tot.toFixed(5);
  }
</script>

@endsection