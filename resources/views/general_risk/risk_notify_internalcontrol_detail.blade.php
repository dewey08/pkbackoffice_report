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
    
    use App\Http\Controllers\FectdataController;
    $checkleader_sub = FectdataController::checkleader_sub($id_user);
    ?>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>


    <!-- Advanced Tables -->
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                    {{ $inforpersonuser->HR_PREFIX_NAME }} {{ $inforpersonuser->HR_FNAME }}
                    {{ $inforpersonuser->HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="row">
                            <div>
                                <a href="{{ url('general_risk/dashboard_risk/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            
                            <div>
                                <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero-info"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">กระบวนการทำงาน
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

                                <div >
                                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
                              </div>
                                <div>&nbsp;</div>
                                @if($check == 1)
                                <div>
                                <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                              </a>
                            </div>
                              <div>&nbsp;</div>
                              @endif
                            <div>
                                <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>                              
                                        <span class="badge badge-light" ></span>                                      
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>

                        </div>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content mx-1 ml-3">

        <!-- Dynamic Table Simple -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;">
                    <B>รายละเอียดแบบประเมินการควบคุมภายในด้วยตนเอง (Control self Assessment : CSA)</B>
                </h3>
            </div>
            <div class="block-content">
                <input type="hidden" value="{{ $internalcontrol->INTERNALCONTROL_ID }}" name="INTERNALCONTROL_ID"
                    id="INTERNALCONTROL_ID" class="form-control input-sm">

                <div class="row push">
                    <div class="col-sm-1">
                        <label>Risk no. </label><label style="color: red;">** &nbsp;</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" name="INTERNALCONTROL_NO" id="INTERNALCONTROL_NO"
                            class="form-control input-sm fo13" value="{{ $internalcontrol->INTERNALCONTROL_NO }} "
                            readonly>
                    </div>

                    <div class="col-sm-1">
                        <label>วันที่บันทึก</label>
                    </div>
                    <div class="col-lg-3 ">
                        <input name="INTERNALCONTROL_DATE" id="INTERNALCONTROL_DATE"
                            class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"
                            style="font-family:'Kanit',sans-serif;font-size:13px;"
                            value="{{ formate($internalcontrol->INTERNALCONTROL_DATE) }}" readonly>

                    </div>
                    <div class="col-sm-2">
                        <label>หน่วยงานที่รายงาน </label>
                    </div>
                    <div class="col-lg-3 ">
                        @foreach ($departsubs as $departsub)
                            <input type="text" class="form-control input-sm fo13" name="" id=""
                                value="{{ $departsub->HR_DEPARTMENT_SUB_SUB_NAME }}" readonly>
                            <input type="hidden" class="form-control input-sm fo13" name="INTERNALCONTROL_DEP_SUBSUB"
                                id="INTERNALCONTROL_DEP_SUBSUB" value="{{ $departsub->HR_DEPARTMENT_SUB_SUB_ID }}">
                        @endforeach
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-1 text-right"
                        style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
                        ระยะเวลา :
                    </div>
                    <div class="col-sm-2">
                        <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-sm foo13 budget"
                                style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
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
                        <div class="row push">
                            <div class="col-sm-3 text-right" style="font-family:'Kanit',sans-serif;">
                                <label>วันที่</label>
                            </div>
                            <div class="col-md-4">

                                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}"
                                    style="font-family:'Kanit',sans-serif;" readonly>

                            </div>
                            <div class="col-sm-1">
                                <label>ถึง</label>
                            </div>
                            <div class="col-md-4">
                                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}"
                                    style="font-family:'Kanit',sans-serif;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หัวหน้าหน่วยงาน :</label>
                    </div>
                    <div class="col-sm-3">
                        <select name="LEADER_ID" id="LEADER_ID" class="form-control input-lg fo13" required>
                            @foreach ($leaders as $leader)
                                @if ($leader->LEADER_ID == $checkleader_sub)
                                    <input value="{{ $leader->LEADER_ID }}" type="hidden" name="LEADER_ID"
                                        id="LEADER_ID" selected>
                                @else
                                    <option value="{{ $leader->LEADER_ID }}">{{ $leader->LEADER_NAME }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>




                <div class="row push">
                    <div class="col-sm-2 text-right">
                        <label>1 :</label>
                    </div>
                    <div class="col-lg-10 ">
                        <div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">
                            ให้วิเคราะและเลือกภารกิจงาน/กิจกรรมที่มีความเสี่ยงสูงมา ๑
                            เรื่องพร้อมระบุวัตถุประสงค์ของภารกิจงาน/กิจกรรมนั้น
                        </div>
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label></label>
                    </div>

                    <div align="left" class="col-sm-1 " style="font-family:'Kanit',sans-serif;font-size:13px;">ภารกิจ :
                    </div>

                    <div class="col-lg-9 " style="font-family:'Kanit',sans-serif;font-size:13px;">
                        {{ $internalcontrol->INTERNALCONTROL_MISSION }}

                    </div>
                </div>

                <div class="row push">
                    <div class="col-md-2 ">
                    </div>

                    <div class="col-md-9  ">

                        <div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">วัตถุประสงค์ :</div>
                        <br>
                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <td style="text-align: center;font-size: 13px;" width="5%">ลำดับ</td>
                                    <td style="text-align: center;font-size: 13px;">รายละเอียด</td>


                                </tr>
                            </thead>
                            <tbody class="tbody1">

                                <tr height="20">
                                    <?php $number = 0; ?>
                                    @foreach ($internalcontrol_subs as $internalcontrol_sub)
                                        <?php $number++; ?>
                                        <td height="30" style="text-align: center;font-size: 13px;"> {{ $number }}
                                        </td>
                                        <td height="30" style="text-align: left;font-size: 13px;">&nbsp;
                                            {{ $internalcontrol_sub->INTERNALCONTROL_OBJECTIVE }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="row push">
                    <div class="col-sm-2 text-right">
                        <label>2 :</label>
                    </div>
                    <div class="col-lg-10 ">
                        <div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">
                            ภารกิจงาน/กิจกรรมนั้น มีขั้นตอนหรือกระบวนการปฎิบัติอะไรบ้าง
                            หรือทำอย่างไรที่จะทำไห้บรรลุตามวัตถุประสงค์
                        </div>
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label></label>
                    </div>
                    <div class="col-lg-9 ">
                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <td style="text-align: center;font-size:13px;" width="5%">ลำดับ</td>
                                    <td style="text-align: center;font-size:13px;">รายละเอียด</td>


                                </tr>
                            </thead>
                            <tbody class="tbody2">
                                <tr height="20">
                                    <?php $number = 0; ?>
                                    @foreach ($internalcontrol_subsubs as $internalcontrol_subsub)
                                        <?php $number++; ?>

                                        <td height="30" style="text-align: center;font-size: 13px;"> {{ $number }}
                                        </td>
                                        <td height="30" style="text-align: left;font-size: 13px;">
                                            &nbsp;{{ $internalcontrol_subsub->INTERNALCONTROL_SUBSUB_NAME }}</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div align="right">
                    <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                        class="btn btn-hero-sm btn-hero-danger"><i class="fas fa-window-close mr-2"></i>Close</a>
                </div>
            </div>

        </div>
    @endsection

    @section('footer')

        <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
        <!-- Page JS Code -->
        {{-- <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script> --}}
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
