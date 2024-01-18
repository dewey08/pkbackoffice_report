@extends('layouts.supplies')
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


?>
<?php
    $date = date('Y-m-d');
?>
<!-- Advanced Tables -->

<center>
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการจัดซื้อจัดจ้างพัสดุ</B></h3>
                <div align="right">
                    <a href="{{ url('manager_supplies/purchaseregister/null')  }}"
                        class="btn btn-hero-sm btn-hero-info"><i class="fas fa-swatchbook mr-2"></i>ออกทะเบียนคุม</a>
                    <?php if($status_check == ''){$statuscheck0 = 'null';}else{ $statuscheck0 = $status_check;}  if($search == ''){$search0 = 'null';}else{$search0 = $search;} ?>
                    <a href="{{ url('manager_supplies/purchase_excel/'.$year_id.'/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$statuscheck0.'/'.$search0)  }}"
                        class="btn btn-hero-sm btn-hero-success"><i class="fas fa-file-excel mr-2"></i>Excel</a>
                    <a href="{{ url('manager_supplies/purchase_excel_5000/'.$year_id.'/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$statuscheck0.'/'.$search0)  }}"
                        class="btn btn-hero-sm btn-hero-warning"><i class="fas fa-file-excel mr-2"></i>
                        < 5000</a> </div> </div> <div class="block-content block-content-full">
                            <form method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-0.5">
                                        &nbsp;ปีงบ &nbsp;
                                    </div>
                                    <div class="col-md-1">
                                        <span>
                                            <select name="BUDGET_YEAR" id="BUDGET_YEAR"
                                                class="form-control input-lg budget"
                                                style=" font-family: 'Kanit', sans-serif;">

                                                @foreach ($budgetyears as $budgetyear)
                                                @if($budgetyear->LEAVE_YEAR_ID == $year_id)
                                                <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>
                                                    {{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @else
                                                <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">
                                                    {{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @endif

                                                @endforeach


                                            </select>
                                    </div>
                                    <div class="col-md-0.5">
                                        &nbsp;ค้นจาก &nbsp;
                                    </div>
                                    <div class="col-md-0.5">
                                        <span>
                                            <select name="DATE_SELECT" id="DATE_SELECT"
                                                class="form-control input-lg budget"
                                                style=" font-family: 'Kanit', sans-serif;">


                                                @if($dateselect == 'd2')
                                                <option value="d1">วันที่จัดซื้อ</option>
                                                <option value="d2" selected>วันที่ตรวจรับ</option>
                                                @else
                                                <option value="d1" selected>วันที่จัดซื้อ</option>
                                                <option value="d2">วันที่ตรวจรับ</option>

                                                @endif




                                            </select>
                                    </div>

                                    <div class="col-sm-4 date_budget">
                                        <div class="row">
                                            <div class="col-sm">
                                                วันที่
                                            </div>

                                            <div class="col-sm-4">

                                                <input name="DATE_BIGIN" id="DATE_BIGIN"
                                                    class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy"
                                                    value="{{ formate($displaydate_bigen) }}" readonly>

                                            </div>
                                            <div class="col-sm">
                                                ถึง
                                            </div>
                                            <div class="col-sm-4">

                                                <input name="DATE_END" id="DATE_END"
                                                    class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy"
                                                    value="{{ formate($displaydate_end) }}" readonly>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-0.5">
                                        &nbsp;สถานะ &nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-1.5">
                                        <span>
                                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg"
                                                style=" font-family: 'Kanit', sans-serif;">
                                                <option value="">ทั้งหมด</option>
                                                @foreach ($suppliesstatuss as $suppliesstatus)
                                                    @if($suppliesstatus->REGIS_STATUS_ID == $status_check)
                                                    <option value="{{ $suppliesstatus ->REGIS_STATUS_ID  }}" selected>
                                                        {{ $suppliesstatus->REGIS_STATUS_NAME}}</option>
                                                    @else
                                                    <option value="{{ $suppliesstatus ->REGIS_STATUS_ID  }}">
                                                        {{ $suppliesstatus->REGIS_STATUS_NAME}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>


                                    <div class="col-md-0.5">
                                        &nbsp;&nbsp;&nbsp;ค้นหา &nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-0.5">
                                        <span>
                                            <input type="search" name="search" class="form-control"
                                                style="font-family: 'Kanit', sans-serif; font-weight:normal;"
                                                value="{{$search}}">
                                        </span>
                                    </div>
                                    <div class="col-md-30">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-1.5 text-left">
                                        <span>
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                                    class="fas fa-search mr-2"></i>ค้นหา</button>

                                        </span>
                                    </div>

                                </div>
                            </form>

                            <div class="table-responsive" style="min-height: 450px;">
                                <div style="text-align: right;">มูลค่ารวม {{ number_format($budgetsum,5)}} บาท</div>
                                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="5%">ลำดับ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="5%">ปีงบ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="8%">ทะเบียนคุม</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="8%">เลขขอซื้อ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="8%">สถานะ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="5%">ส่งข้อมูล</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">วันที่</th>

                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                แผนงานโครงการ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">ประเภท</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                บริษัท</th>

                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">งบประมาณ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">ประเภทงบประมาณ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">วิธีการจัดซื้อ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="10%">วันที่ตรวจรับ</th>
                                            <th class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                                width="12%">คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $number = 0; ?>
                                    @foreach($infosupcons as $inforequest)
                                        <?php 
                                            $number++;
                                            $status =  $inforequest->REGIS_STATUS_ID;
                                            if( $status === 1){
                                                $statuscol =  "badge badge-danger";
                                            }else if($status === 2){
                                                $statuscol =  "badge badge-warning";

                                            }else if($status === 3){
                                                $statuscol =  "badge badge-info";
                                            }else if($status === 4 || $status === 5 || $status === 7){
                                                $statuscol =  "badge badge-success";
                                            }else{
                                                $statuscol =  "badge badge-secondary";
                                            }
                                        ?>
                                        <tr height="20">
                                            <td class="text-font" align="center">{{$number}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->CON_YEAR_ID}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->CON_NUM}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->REQUEST_ID}}</td>
                                            <td class="text-font text-pedding">
                                                <span class="{{$statuscol}}">{{$inforequest->REGIS_STATUS_NAME}}</span>
                                            </td>
                                            <td class="text-font" align="center">-</td>
                                            <td class="text-font" align="center">{{DateThai($inforequest->DATE_REGIS)}}
                                            </td>
                                            <td class="text-font text-pedding">{{$inforequest->EGP_PLAN_NAME}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->SUP_TYPE_NAME}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->VENDOR_NAME}}</td>
                                            <td class="text-font text-pedding" align="right">
                                                {{number_format($inforequest->BUDGET_SUM,5)}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->BUDGET_NAME}}</td>
                                            <td class="text-font text-pedding">{{$inforequest->BUY_NAME}}</td>
                                            @if($inforequest->CHECK_DATE !== '' && $inforequest->CHECK_DATE !== null)
                                            <td class="text-font text-pedding">{{DateThai($inforequest->CHECK_DATE)}}
                                            </td>
                                            @else
                                            <td class="text-font text-pedding"> </td>
                                            @endif
                                            <td align="center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                                        id="dropdown-align-outline-info" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                        <?php 
                                                        if($status !== 8){?>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchaseregisteredit/'.$inforequest -> ID)}}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i
                                                                class="fas fa-edit text-warning mr-2"></i>
                                                            แก้ไขทะเบียนคุม</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchasecancel/'.$inforequest -> ID)}}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i
                                                                class="fas fa-window-close text-danger mr-2"></i>
                                                            ยกเลิกทะเบียนคุม</a>
                                                        -----------------------
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchasequotation_add/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i
                                                                class="fas fa-folder-plus text-primary mr-2"></i>
                                                            เพิ่มใบเสนอราคา</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchaselist_add/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i
                                                                class="fas fa-folder-plus text-primary mr-2"></i>
                                                            เพิ่มรายการพัสดุ</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchaseorders_add/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i
                                                                class="far fa-file-alt text-info mr-2"></i>ออกใบสั่งซื้อ/สั่งจ้าง</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchascheck/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">
                                                            @if($inforequest->REGIS_STATUS_ID == 5)
                                                            <i class="fas fa-edit text-warning mr-2"></i>แก้ไขตรวจรับ
                                                            @else
                                                            <i class="fas fa-clipboard-check text-success mr-2"></i>ตรวจรับ
                                                            @endif
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/purchasequotation_confirm/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                            onclick="return confirm('ต้องการที่ยืนยันตรวจรับรายการ {{$inforequest->CON_NUM}} หรือไม่? ')"><i
                                                                class="fas fa-clipboard-check text-success mr-2"></i>ยืนยันตรวจรับ</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('manager_supplies/send_infomation/'.$inforequest->ID)  }}"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                            onclick="return confirm('ต้องการที่ยืนยันส่งข้อมูลรายการ {{$inforequest->CON_NUM}} หรือไม่? ')"><i
                                                                class="fas fa-chevron-circle-right text-success mr-2"></i>ส่งข้อมูลไปคลัง</a>
                                                        <?php } ?>

                                                        <a class="dropdown-item" href="#detail_print"
                                                            data-toggle="modal"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                            onclick="print({{$inforequest->ID}});"><i
                                                                class="fas fa-print text-info mr-2"></i>พิมพ์เอกสาร</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div>จำนวน {{$count}} รายการ</div>


                                <div id="detail_print" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <div class="row">
                                                    <div>
                                                        <h3 style="font-family: 'Kanit', sans-serif;">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการการสั่งพิมพ์&nbsp;&nbsp;
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <body>


                                                    <div id="detailprint"></div>


                                            </div>
                                            <div class="modal-footer">
                                                <div align="right">

                                                    <button type="button" class="btn btn-hero-sm btn-hero-secondary"
                                                        data-dismiss="modal"><i
                                                            class="fas fa-sign-out-alt mr-2"></i>ปิดหน้าต่าง</button>
                                                </div>
                                            </div>
                                            </form>
                                            </body>


                                        </div>
                                    </div>
                                </div>



                                <div class="modal fade print" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h2 class="modal-title"
                                                    style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                                    พิมพ์เอกสาร</h2>
                                            </div>
                                            <div class="modal-body">

                                                <body>

                                                    <div class="row">
                                                        <div class="col-sm-6" align="left">

                                                            <a class="dropdown-item"
                                                                href="{{ url('manager_supplies/pdfmemo/export_pdfmemo')}}"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">[1] บันทึกข้อความรายงานการขอซื้อ</a>
                                                        </div>
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">คำสั่งแต่งตั้งคณะกรรมการตรวจรับ</a>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">ประกาศผู้ชนะการเสนอราคา</a>
                                                        </div>
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">บันทึกข้อความรายงานผลการพิจารณา</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">ใบสั่งซื้อ</a>
                                                        </div>
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">ใบตรวจรับ</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">ใบแสดงความบริสุทธิ์ใจ</a>
                                                        </div>
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">รายการคุณลักษณะพัสดุ</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">รายการขออนุมัติบัญชีแนบท้าย</a>
                                                        </div>
                                                        <div class="col-sm-6" align="center">
                                                            <a class="dropdown-item" href=""
                                                                style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                                                target="_blank">บันทึกข้อความจ่ายเงิน</a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div align="right">

                                                            <button type="button"
                                                                class="btn btn-hero-sm btn-hero-danger"
                                                                data-dismiss="modal"><i
                                                                    class="fas fa-sign-out-alt mr-2"></i>ปิดหน้าต่าง</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </body>


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
            <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8">
            </script>

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
                function print(id) {


                    $.ajax({
                        url: "{{route('msupplies.detailprint')}}",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function (result) {
                            $('#detailprint').html(result);
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
                }
            </script>

            @endsection