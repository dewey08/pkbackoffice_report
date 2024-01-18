@extends('layouts.warehouse')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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

    table,
    td,
    th {
        border: 1px solid black;
    }
</style>
<!-- Advanced Tables -->
    <div class="block" style="width:95%;margin:auto">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานวัสดุคงคลังตามประเภทสิ่งของ
                        คลังหลัก</B></h3>


                <?php if($type_check == ''){ $type_check0 = 'null';}else{$type_check0 = $type_check; } ?>

                <a href="{{ url('manager_warehouse/reportvaluestoreexcel/'.$year_id.'/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$type_check0)}}"
                    class="btn btn-hero-sm btn-hero-success">
                    <li class="fa fa-file-excel mr-2"></li>&nbsp;Excel
                </a>

            </div>
            <div class="block-content ">
                <form action="{{ route('mwarehouse.reportvaluestoresearch') }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
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

                        <div class="col-sm-4 date_budget">
                            <div class="row">
                                <div class="col-sm">
                                    วันที่
                                </div>

                                <div class="col-sm-4">

                                    <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}"
                                        readonly>

                                </div>
                                <div class="col-sm">
                                    ถึง
                                </div>
                                <div class="col-sm-4">

                                    <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                        data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                                </div>
                            </div>

                        </div>
                        <div class="col-sm-0.5">
                            &nbsp;ประเภท &nbsp;
                        </div>
                        <div class="col-sm-2">
                            <span>
                                <select name="TYPE_CODE" id="TYPE_CODE" class="form-control input-lg"
                                    style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">--ทั้งหมด--</option>
                                    @foreach ($infotypes as $infotype)
                                    @if($infotype->SUP_TYPE_NAME == $type_check)
                                    <option value="{{ $infotype->SUP_TYPE_NAME  }}" selected>
                                        {{ $infotype->SUP_TYPE_NAME}}</option>
                                    @else
                                    <option value="{{ $infotype->SUP_TYPE_NAME  }}">{{ $infotype->SUP_TYPE_NAME}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>


                        <div class="col-md-30">
                            &nbsp;
                        </div>
                        <div class="col-md-1.5">
                            <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                        class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span>
                        </div>
                    </div>
                </form>


                <div class="table-responsive">
                    <table class="table-striped table-vcenter" id="table" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                    ลำดับ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">คลัง</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัส</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    รายการสินค้า</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ประเภท</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วย</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จำนวนยกมา
                                </th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มูลค่ายกมา
                                </th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    จำนวนรับใหม่</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    มูลค่ารับใหม่</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จำนวนจ่าย
                                </th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    มูลค่าการจ่าย</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    จำนวนคงเหลือ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    มูลค่าคงเหลือ</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                 $number                = 1;  
                 $sum_quote_amount      = 0;
                 $sum_quote_value       = 0;
                 $sum_receive_amount    = 0;
                 $sum_receive_value     = 0;
                 $sum_export_amount     = 0;
                 $sum_export_value      = 0;
                 $sum_balance_amount    = 0;
                 $sum_balance_value     = 0;
                 ?>
                            @foreach ($conclude_store as $con_store)
                            <?php
                        $quote_amount   = $con_store['receive_before_amount'] - $con_store['export_before_amount'] ;
                        $quote_value    = $con_store['receive_before_value'] - $con_store['export_before_value'] ;
                        $balance_amount = $con_store['all_receive_amount'] - $con_store['all_export_amount'] ;
                        $balance_value  = $con_store['all_receive_value'] - $con_store['all_export_value'] ;
                        
                        $sum_quote_amount      += $quote_amount;
                        $sum_quote_value       += $quote_value;
                        $sum_receive_amount    += (double)$con_store['receive_amount'];
                        $sum_receive_value     += (double)$con_store['receive_value'];
                        $sum_export_amount     += (double)$con_store['export_amount'];
                        $sum_export_value      += (double)$con_store['export_value'];
                        $sum_balance_amount    += $balance_amount;
                        $sum_balance_value     += $balance_value;
                    ?>
                            <tr height="20">
                                <td class="text-font" align="center">{{$number++}}</td>
                                <td class="text-font text-pedding">{{$con_store['STORE_TYPE_NAME']}}</td>
                                <td class="text-font text-pedding">{{$con_store['STORE_CODE']}}</td>
                                <td class="text-font text-pedding">{{$con_store['STORE_NAME']}}</td>
                                <td class="text-font text-pedding">{{$con_store['SUP_TYPE_NAME']}}</td>
                                <td class="text-font text-pedding">{{$con_store['SUP_UNIT_NAME']}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{$quote_amount}}</td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($quote_value,2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">
                                    {{$con_store['receive_amount']}}</td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($con_store['receive_value'],2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">
                                    {{$con_store['export_amount']}}</td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($con_store['export_value'],2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">
                                    {{($quote_amount + $con_store['receive_amount'])- $con_store['export_amount']}}</td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format(($quote_value + $con_store['receive_value']) - $con_store['export_value'],2)}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr bgcolor="#FFEBCD">
                                <td class="text-center" colspan="6">รวม</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{$sum_quote_amount}}
                                </td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($sum_quote_value,2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{$sum_receive_amount}}
                                </td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($sum_receive_value,2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{$sum_export_amount}}
                                </td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format($sum_export_value,2)}}</td>

                                <td class="text-font text-pedding" style="text-align: center;">
                                    {{($sum_quote_amount+$sum_receive_amount) - $sum_export_amount}}</td>
                                <td class="text-font text-pedding" style="text-align: right;">
                                    {{number_format(($sum_quote_value+$sum_receive_value)-$sum_export_value,2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('footer')
    <script src="{{ asset('select2/select2.min.js') }}"></script>

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
        $(document).ready(function () {
            $('#TYPE_CODE').select2({
                width: '100%'
            });

        });

        function detail(id) {
            $.ajax({
                url: "{{route('warehouse.detailappall')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#detail').html(result);
                   
                }
            })

        }

        function detaillast(id) {
            $.ajax({
                url: "{{route('warehouse.detailappall')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#detaillastappall' + id).html(result);
                 
                }
            })

        }
        datepick();

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
        $('#table').DataTable({
            "pageLength": 50,
            // "paging":   false,
            // "ordering": false,
            "info": false
        });
    </script>

    @endsection