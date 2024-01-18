@extends('layouts.warehouse')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')

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

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }
    }

    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
    }

    .text-font {
        font-size: 13px;
    }


    .form-control {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
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

    use App\Http\Controllers\ManagerwarehouseController;
  
?>

<!-- Advanced Tables -->
<center>
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">

            <div class="block-header block-header-default">

                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการตรวจรับ</B></h3>


                <div align="right">

                    <a href="{{ url('manager_warehouse/warehouseinfocheck_add') }}"
                        class="btn btn-hero-sm btn-hero-info"
                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ตรวจรับทั่วไป</a>
                    <?php if($status_check == ''){$statuscheck0 = 'null';}else{ $statuscheck0 = $status_check;}  if($search == ''){$search0 = 'null';}else{$search0 = $search;} if($invenstatus_check == ''){$invenstatus_check0 = 'null';}else{$invenstatus_check0 = $invenstatus_check;}  ?>
                    <a href="{{ url('manager_warehouse/detail_excel/'.$year_id.'/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$invenstatus_check0.'/'.$statuscheck0.'/'.$search0) }}"
                        class="btn btn-hero-sm btn-hero-success"
                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">EXCEL</a>
                </div>
            </div>
            <div class="block-content ">
                <form method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-1 col-form-label">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget"
                                    style=" font-family: 'Kanit', sans-serif;">
                                    @foreach ($budgets as $budget)
                                    @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}
                                    </option>
                                    @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>
                        <div class="col-sm-3 date_budget">
                            <div class="row">
                                <div class="col-sm-2 col-form-label">
                                    วันที่
                                </div>
                                <div class="col-sm-4">
                                    <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                        style=" font-family: 'Kanit', sans-serif;font-size: 13px;"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}"
                                        readonly>
                                </div>
                                <div class="col-sm-2 col-form-label">
                                    ถึง
                                </div>
                                <div class="col-sm-4">
                                    <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                        style=" font-family: 'Kanit', sans-serif;font-size: 13px;"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-1 col-form-label">
                                    สถานะ
                                </div>
                                <div class="col-md-2">
                                    <span>
                                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg"
                                            style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                                            <option value="">ทั้งหมด</option>
                                            @foreach ($statussends as $statussend)
                                            @if($statussend->ID_STATUS == $status_check)
                                            <option value="{{ $statussend->ID_STATUS }}" selected>
                                                {{ $statussend->STATUS_CHECK_NAME}}</option>
                                            @else
                                            <option value="{{ $statussend->ID_STATUS  }}">
                                                {{ $statussend->STATUS_CHECK_NAME}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                    </span>
                                </div>

                                <div class="col-sm-1 col-form-label">
                                    คลัง
                                </div>
                                <div class="col-sm-3 text-left">
                                    <select name="INVEN_STATUS" id="INVEN_STATUS" class="form-control input-lg"
                                        style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                                        <option value="">ทั้งหมด</option>

                                        @foreach ($infosuppliesinvens as $infosuppliesinven)
                                        @if($infosuppliesinven->INVEN_ID == $invenstatus_check)
                                        <option value="{{ $infosuppliesinven->INVEN_ID }}" selected>
                                            {{ $infosuppliesinven->INVEN_NAME}}</option>
                                        @else
                                        <option value="{{ $infosuppliesinven->INVEN_ID  }}">
                                            {{ $infosuppliesinven->INVEN_NAME}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-1 col-form-label">
                                    ค้นหา
                                </div>
                                <div class="col-sm-3 text-left">
                                    <input type="search" name="search" class="form-control"
                                        style="font-family: 'Kanit', sans-serif;font-weight:normal;font-size: 13px;"
                                        value="{{$search}}">
                                </div>
                                <div class="col-sm-1 col-form-label">
                                    <input type="checkbox" name="search_bugetyear" id="search_bugetyear" value="1">
                                    <label for="search_bugetyear" style="cursor:pointer">ค้นหาปีงบ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ค้นหา</button>
                        </div>

                    </div>
                </form>
                <div class="table-responsive">
                    <div align="right">มูลค่ารวม {{number_format($sumbudget,5)}} บาท</div>
                    <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                    ลำดับ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">
                                    สถานะ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">
                                    รหัส</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">
                                    เลขทะเบียนคุม</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">วันที่ตรวจรับ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">ประเภทการรับ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">ประเภทวัสดุ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">คลังที่รับเข้า</th>

                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">รับจาก</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">เจ้าหน้าที่</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    width="10%">มูลค่า</th>

                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                    คำสั่ง</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $count=1;?>
                            @foreach ($infocheckreceives as $infocheckreceive)

                            <?php 
                    
                    $status =  $infocheckreceive -> RECEIVE_CHECK_STATUS;

                    if( $status == 1){
                       $statuscol =  "badge badge-success";

                   }else if($status == 2){
                      $statuscol =  "badge badge-warning";

                   }else if($status == 3){
                    $statuscol =  "badge badge-info";

                 }else{
                       $statuscol =  "badge badge-secondary";
                   }
                    
                    ?>


                            <tr height="20">
                                <td class="text-font" align="center" width="5%">{{$count}}</td>
                                <td class="text-font text-pedding" width="6%">
                                    <span class="{{$statuscol}}">{{$infocheckreceive->STATUS_CHECK_NAME}}</span>

                                </td>
                                <td class="text-font text-pedding" width="7%">{{$infocheckreceive->RECEIVE_CODE}}</td>
                                <td class="text-font text-pedding" width="8%">{{$infocheckreceive->CON_NUM}}</td>
                                @if($infocheckreceive->RECEIVE_CHECK_DATE == '0000-00-00' ||
                                $infocheckreceive->RECEIVE_CHECK_DATE == null)
                                <td class="text-font text-pedding" width="8%"></td>
                                @else
                                <td class="text-font text-pedding" width="8%">
                                    {{DateThai($infocheckreceive->RECEIVE_CHECK_DATE)}}</td>
                                @endif

                                @if($infocheckreceive->TYPE_CHECK_NAME == 'รับจากพัสดุ')
                                <td class="text-font text-pedding" width="8%"><span
                                        class="badge badge-success">{{$infocheckreceive->TYPE_CHECK_NAME}}</span></td>
                                @else
                                <td class="text-font text-pedding" width="8%"><span
                                        class="badge badge-warning">{{$infocheckreceive->TYPE_CHECK_NAME}}</span></td>
                                @endif

                                @if($infocheckreceive->SUP_TYPE_NAME == '' || $infocheckreceive->SUP_TYPE_NAME == null)
                                <td class="text-font text-pedding" width="9%">
                                    {{ManagerwarehouseController::supdetailname($infocheckreceive->RECEIVE_SUP_TYPE)}}
                                </td>
                                @else
                                <td class="text-font text-pedding" width="9%">{{$infocheckreceive->SUP_TYPE_NAME}}</td>
                                @endif

                                <td class="text-font text-pedding" width="9%">{{$infocheckreceive->INVEN_NAME}}</td>

                                <td class="text-font text-pedding">{{$infocheckreceive->RECEIVE_ACCEPT_FROM}}</td>
                                <td class="text-font text-pedding" width="10%">
                                    {{$infocheckreceive->RECEIVE_PERSON_NAME}}</td>
                                <td class="text-font text-pedding" align="right" width="10%">
                                    {{number_format($infocheckreceive->RECEIVE_VALUE,5)}}</td>
                                <td class="text-font " align="center" width="5%">

                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item"
                                            href="{{ url('manager_warehouse/warehouseinfocheckdetali/'.$infocheckreceive->RECEIVE_ID) }}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                        @if( $status == 2)
                                        <a class="dropdown-item"
                                            href="{{ url('manager_warehouse/warehouseinfochecksup/'.$infocheckreceive->RECEIVE_ID) }}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ตรวจรับ</a>
                                        @endif
                                        @if( $status == 3)
                                        <a class="dropdown-item"
                                            href="{{url('manager_warehouse/detail_edit/'.$infocheckreceive->RECEIVE_ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขรายละเอียด</a>
                                        <a class="dropdown-item"
                                            href="{{ url('manager_warehouse/warehouseinfoconfirmdetali/'.$infocheckreceive->RECEIVE_ID) }}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ยืนยันรับเข้าคลัง</a>
                                        @endif
                                     


                                    </div>


                                </td>

                            </tr>



                            <?php  $count++;?>

                            @endforeach




                        </tbody>
                    </table>
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
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

    <script>
        function detail(id) {

            $.ajax({
                url: "{{route('suplies.detailapp')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#detail').html(result);


                    //alert("Hello! I am an alert box!!");
                }

            })

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
        datepick();

        function datepick() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                todayHighlight: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }); //กำหนดเป็นวันปัจุบัน
        };
    </script>

    @endsection