@extends('layouts.risk')
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
            font-size: 10px;
            font-size: 1.0rem;
        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
        }

        @media only screen and (min-width: 1200px) {
            label {
                /* float: right; */
            }

        }

        .text-pedding {
            padding-left: 10px;
        }

        .text-font {
            font-size: 13px;
        }


        .form-control {
            font-size: 13px;
        }

    </style>

    <script>
        function checklogin() {
            window.location.href = '{{ route('index') }}';
        }

    </script>
    <?php
    if (Auth::check()) {
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    } else {
    echo "

    <body onload=\"checklogin()\"></body>";
    exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

    function timeformate($strtime)
    {
    [$a, $b] = explode(':', $strtime);
    return $a . ':' . $b;
    }
    ?>
    <center>
        <div class="block shadow-lg mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <div align="left">
                        <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">
                            <B>บัญชีความเสี่ยง</B></h2>
                    </div>
                    <div align="left">
                        <a class="btn btn-hero-sm btn-hero-info" href="{{url('manager_risk/risk_account_add')}}"
                            style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><i
                                class="fas fa-plus mr-2"></i>เพิ่มข้อมูล</a>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <form >
                        @csrf
                        <div class="row">
                            <div class="col-sm-0.5">
                                &nbsp;&nbsp; &nbsp;&nbsp; ปีงบ &nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="col-sm-1.5">
                                <span>
                                    <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget"
                                        style=" font-family: 'Kanit', sans-serif;">
                                        @foreach ($budgets as $budget)
                                            @if ($budget->LEAVE_YEAR_ID == $year_id)
                                                <option value="{{ $budget->LEAVE_YEAR_ID }}" selected>
                                                    {{ $budget->LEAVE_YEAR_ID }}</option>
                                            @else
                                                <option value="{{ $budget->LEAVE_YEAR_ID }}">
                                                    {{ $budget->LEAVE_YEAR_ID }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            <div class="col-sm-4 date_budget">
                                <div class="row">
                                    <div class="col-sm ml-2">
                                        วันที่
                                    </div>
                                    <div class="col-md-4 ml-0">
                                        <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                            data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}"
                                            readonly>
                                    </div>
                                    <div class="col-sm">
                                        ถึง
                                    </div>
                                    <div class="col-md-4">
                                        <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                            data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                สถานะ
                            </div>
                            <div class="col-sm-2">
                                <select name="STATUS" id="STATUS" class="form-control input-sm fo13">
                                    <option value="">--เลือก--</option>
                                    @foreach ($statuss as $status)
                                        <option value="{{ $status->RISK_STATUS_ID }}">
                                            {{ $status->RISK_STATUS_NAME_TH }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-0.5">
                                &nbsp;ค้นหา &nbsp;
                            </div>
                            <div class="col-sm-2">
                                <span>
                                    <input type="search" name="search" class="form-control"
                                        style="font-family: 'Kanit', sans-serif;font-weight:normal;"
                                        value="{{ $search }}">
                                </span>
                            </div>

                            <div class="col-sm-30">
                                &nbsp;
                            </div>
                            <div class="col-sm-1.5">
                                <span>
                                    <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                            class="fas fa-search mr-2"></i> ค้นหา</button>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #C39BD3;">
                                    <tr height="40">
                                        <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="text-align: center;" width="5%">สถานะ</th>
                                        <th class="text-font" style="text-align: center;" width="10%">ปีงบประมาณ</th>
                                        <th class="text-font" style="text-align: center;" width="10%">หน่วยงาน</th>
                                        <th class="text-font" style="text-align: center;" > ความเสี่ยง (รายละเอียด)</th>
                                        <th class="text-font" style="text-align: center;" width="10%"> ความเสี่ยง (ด้าน)</th>
                                        <th class="text-font" style="text-align: center;" width="10%"> โอกาสที่จะเกิด</th>
                                        <th class="text-font" style="text-align: center;" width="8%"> ผลกระทบ</th>
                                        <th class="text-font" style="text-align: center;" width="8%"> ระดับความเสี่ยง</th>
                                        <th class="text-font" style="text-align: center;" width="5%">คำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 0; ?>
                                    @foreach ($riskaccs as $todo)
                                    <?php
                                    $number++;
                                    $status = $todo->RISK_ACCOUNT_STATUS;
    
                                    if ($status === 'CONFIRM') {
                                    $statuscol = 'badge badge-primary';
                                    } elseif ($status === 'REPORT') {
                                    $statuscol = 'badge badge-warning';
                                    } elseif ($status === 'ACCEPT') {
                                    $statuscol = 'badge badge-danger';
                                    } elseif ($status === 'CHECK') {
                                    $statuscol = 'badge badge-info';
                                    } elseif ($status === 'SUCCESS') {
                                    $statuscol = 'badge badge-success';
                                    } else {
                                    $statuscol = 'badge badge-secondary';
                                    }                                
                                    ?>
                                        <tr id="todo_${todo.RISK_REPDETAIL_ID}">
                                            <td class="text-font" style="text-align: center;" width="5%"> {{ $number }}</td>
                                            <td align="center"> <span class="{{ $statuscol }}" width="5%">{{ $todo->RISK_STATUS_NAME_TH }}</span></td>
                                            <td class="text-font text-pedding" width="10%"> &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_YEAR }}</td>
                                            <td class="text-font text-pedding" width="10%">  &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_DEBSUBSUB_NAME }}</td>
                                            <td class="text-font text-pedding" > &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_RISK_DETAIL }}</td>
                                            <td class="text-font text-pedding" width="10%"> &nbsp;&nbsp;{{ $todo->RISK_ACCOUNTTYPE_NAME }}</td>
                                            <td class="text-font text-pedding" width="10%"> &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_SCOPE }}</td>
                                            <td class="text-font text-pedding" width="8%"> &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_RISK_EFFECT }}</td>
                                            <td class="text-font text-pedding" width="8%"> &nbsp;&nbsp;{{ $todo->RISK_ACCOUNT_RISK_LEVEL }}</td>
                                            <td align="center" width="5%">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                                        id="dropdown-align-outline-info" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu fo13" style="width:10px">
                                                        <a class="dropdown-item" href="{{ url('manager_risk/risk_account_detail/' . $todo->RISK_ACCOUNT_ID) }}"> <i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด</a>
                                                        <a class="dropdown-item" href="{{ url('manager_risk/risk_account_edit/' . $todo->RISK_ACCOUNT_ID) }}"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                        <a class="dropdown-item" href="{{ url('manager_risk/risk_account_delete/' . $todo->RISK_ACCOUNT_ID) }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')"><i class="fas fa-window-close text-danger mr-2"></i>ยกเลิกรายการ</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
            jQuery(function() {
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
                    url: "{{ route('suplies.detailapp') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        $('#detail').html(result);
                    }
                })
            }
            $(document).ready(function() {

                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: true,
                    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                    thaiyear: true,
                    autoclose: true //Set เป็นปี พ.ศ.
                }); //กำหนดเป็นวันปัจุบัน
            });
            $('.budget').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('admin.selectbudget') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.date_budget').html(result);
                            datepick();
                        }
                    })
                }
            });

            function chkmunny(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                ele.onKeyPress = vchar;
            }

        </script>

    @endsection
