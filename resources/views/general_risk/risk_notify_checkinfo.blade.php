@extends('layouts.backend')

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
            font-size: 13px;
        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;

        }

     

        .text-pedding {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
        }

        .text-font {
            font-size: 13px;
        }

        .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
        }

    </style>
    <style>
        .form-control {
            font-family: 'Kanit', sans-serif;
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


    use App\Http\Controllers\RiskController;
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);

    
    $check = RiskController::checkpermischeckinfo($user_id);

    ?>
    <?php
    function RemoveDateThai($strDate)
    {
    $strYear = date('Y', strtotime($strDate)) + 543;
    $strMonth = date('n', strtotime($strDate));
    $strDay = date('j', strtotime($strDate));
    $strMonthCut = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }
    function Removeformate($strDate)
    {
    $strYear = date('Y', strtotime($strDate));
    $strMonth = date('m', strtotime($strDate));
    $strDay = date('d', strtotime($strDate));
    return $strDay . '/' . $strMonth . '/' . $strYear;
    }
    function Removeformatetime($strtime)
    {
    $H = substr($strtime, 0, 5);
    return $H;
    }
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>


    <!-- Advanced Tables -->
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 style="font-family: 'Kanit', sans-serif; font-size:17px;font-weight:normal;">
                    {{ $inforpersonuser->HR_PREFIX_NAME }} {{ $inforpersonuser->HR_FNAME }}
                    {{ $inforpersonuser->HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      
                        <div class="row">
                            <div>
                                <a href="{{ url('general_risk/dashboard_risk/' . $inforpersonuserid->ID) }}" class="btn "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">

                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </div>
                            <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
                                </a>
                            </div>
                            <div>&nbsp;</div>
                            <div>
                                <a href="{{ url('general_risk/risk_notify_report4/'.$inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน ปค.4
                              </a>
                            </div>
                              <div>&nbsp;</div>

                              <div>
                                <a href="{{ url('general_risk/risk_notify_report5/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน ปค.5
                              </a>
                            </div>
                              <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
                                </a>
                            </div>
                            <div>&nbsp;</div>


                            <div>
                                <a href="{{ url('general_risk/risk_notify/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
                            </div>
                            <div>&nbsp;</div>
                        @if($check == 1)
                            <div>
                                <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero-info"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ตรวจสอบ
                                </a>
                            </div>
                            <div>&nbsp;</div>
                        @endif
                            <div>
                                <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
                                <span class="badge badge-light"></span>
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>

                       
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content mx-1 ml-3">

        <!-- Dynamic Table Simple -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>ตรวจสอบรายงานความเสี่ยง</B></h3>
              
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('gen_risk.risk_notify_checkinfo_search', ['iduser' => $inforpersonuserid->ID]) }}"
                    method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-0.5">
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ปีงบ &nbsp;&nbsp;&nbsp;
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
                                            <option value="{{ $budget->LEAVE_YEAR_ID }}">{{ $budget->LEAVE_YEAR_ID }}
                                            </option>
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
                                   <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                   <option value="">--ทั้งหมด--</option>                       
                                        @foreach ($statuss as $status)
                                                   @if ($status->RISK_STATUS_NAME == $status_check)
                                                       <option value="{{ $status->RISK_STATUS_NAME  }}" selected>{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                   @else
                                                       <option value="{{ $status->RISK_STATUS_NAME  }}" >{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                   @endif
                                               @endforeach     
                                   </select>
                                   </span>
                               </div>
                        <div class="col-sm-0.5">
                            &nbsp;คำค้นหา &nbsp;
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
                                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                        class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span>
                        </div>
                    </div>



                </form>
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">

                                <th class="text-font" style="text-align: center;" width="4">ลำดับ</th>
                                <th class="text-font" style="text-align: center;" width="8%">รหัสรายงาน</th>
                                <th class="text-font" style="text-align: center;" width="8%">สถานะ</th>
                                <th class="text-font" style="text-align: center;" width="9%">ทบทวน</th>
                                <th class="text-font" style="text-align: center;" width="9%">ความรุนแรง</th>
                                <th class="text-font" style="text-align: center;" width="10%">วันที่บันทึก</th>
                                <th class="text-font" style="text-align: center;" width="13%">ที่มา</th>
                                <th class="text-font" style="text-align: center;">รายละเอียดเหตุการณ์</th>
                                <th class="text-font" style="text-align: center;" width="20%">การจัดการเบื้องต้น</th>
                                <th class="text-font" style="text-align: center;" width="5%">คำสั่ง</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($rigreps as $rigrep)
                                <?php
                                $number++;
                                $status = $rigrep->RISKREP_STATUS;

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


                                $level = $rigrep->RISKREP_LEVEL;

                                if ($level === '1') {
                                        $statuslevel = 'badge badge-success';
                                        } elseif ($level === '2') {
                                        $statuslevel = 'badge badge-success';
                                        } elseif ($level === '3') {
                                        $statuslevel = 'badge badge-info';
                                        } elseif ($level === '4') {
                                        $statuslevel = 'badge badge-info';
                                        } elseif ($level === '5') {
                                        $statuslevel = 'badge badge-warning';
                                        } elseif ($level === '6') {
                                        $statuslevel = 'badge badge-warning';                                  
                                        } elseif ($level === '7') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '8') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '9') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '10') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '11') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '12') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '13') {
                                        $statuslevel = 'badge badge-danger';
                                        } elseif ($level === '14') {
                                        $statuslevel = 'badge badge-danger';
                                        } else {
                                        $statuslevel = '';
                                        }
                                ?>

                                <tr height="20">
                                    <td class="text-font" align="center" style="vertical-align: top;" width="4%">{{ $number }}</td>
                                    <td class="text-font" align="center" style="vertical-align: top;" width="4%">{{ $rigrep->RISKREP_NO }}</td>
                                    <td align="center" class="text-font text-pedding" style="vertical-align: top;"> <span class="{{ $statuscol }}"
                                            width="8%">{{ $rigrep->RISK_STATUS_NAME_TH }}</span></td>
                                    <td align="center" class="text-font text-pedding" style="vertical-align: top;" width="9%">
                                        <a href="{{route('gen_risk.risk_notify_checkinfo_recheck',[$rigrep->RISKREP_ID,$inforpersonuserid->ID])}}" class="btn btn-hero-sm btn-hero-warning"><i
                                                class="fa fa-file-signature"></i></a>
                                    </td>
                                    <td align="center" class="text-pedding" style="vertical-align: top;"> <span class="{{ $statuslevel }}" width="8%">{{ $rigrep->RISK_REP_LEVEL_NAME }}</span></td>
                                    <td class="text-font text-pedding" style="text-align: center;vertical-align: top;" width="10%">
                                        {{ DateThai($rigrep->RISKREP_DATESAVE) }}</td>
                                    <td class="text-font text-pedding" style="text-align: left;vertical-align: top;" width="13%">
                                        {{ $rigrep->INCIDENCE_LOCATION_NAME }}</td>
                                    <td class="text-font text-pedding" style="vertical-align: top;">{!! $rigrep->RISKREP_DETAILRISK !!}</td>
                                    <td class="text-font text-pedding" style="text-align: left;vertical-align: top;">{!! $rigrep->RISKREP_BASICMANAGE !!}
                                    </td>
                                    <td align="center" style="vertical-align: top;" width="5%">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle"
                                                id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"
                                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                {{-- @if ($checkrisknotify != 0) --}}
                                                    <a class="dropdown-item"
                                                    href="{{ url('general_risk/risk_notify_check/' . $rigrep->RISKREP_ID . '/' . $inforpersonuserid->ID) }}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ตรวจสอบ</a>
                                                {{-- @endif --}}

                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                        // console.log(select);
                    }
                });


                $(document).ready(function() {

                    $('.datepicker').datepicker({
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

            </script>



        @endsection
