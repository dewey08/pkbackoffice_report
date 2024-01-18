@extends('layouts.backend')
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
            font-size: 13px;

        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;

        }

        @media only screen and (min-width: 1200px) {
            label {
               
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


    use App\Http\Controllers\RiskController;
    $refnumRiskacc = RiskController::refnumRiskacc();
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);
    

    use App\Http\Controllers\FectdataController;
    $checkleader_sub = FectdataController::checkleader_sub($id_user);

    $datenow = date('Y-m-d');
    ?>


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
                                <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero-info"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">บัญชีความเสี่ยง
                                </a>
                            </div>
                            <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify_reportsub/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงานหน่วยย่อย
                                </a>
                            </div>
                            <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
                            </div>
                            <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                </a>
                            </div>
                            <div>&nbsp;</div>

                            <div>
                                <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
                                <span class="badge badge-light"></span>
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>

                        </div>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <br>
    <div class="content">
        <div class="block block-rounded block-bordered">


            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลบัญชีความเสี่ยง</h2>
                <div class="block-content block-content-full" >

                    <form method="post" action="{{ route('gen_risk.risk_notify_account_save') }}" enctype="multipart/form-data">
                        @csrf

                        <input value="{{ $id_user }}" type="hidden" name="USER_ID" id="USER_ID" class="form-control input-lg">
                                          

                        <div class="row push">
                            <div class="col-sm-2">
                                <label>Account No. </label><label style="color: red;">** &nbsp;</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input type="text" name="RISK_ACCOUNT_NO" id="RISK_ACCOUNT_NO" class="form-control input-sm fo13 "
                                    value="{{ $refnumRiskacc }} ">
                            </div>

                            <div class="col-sm-2">
                                <label>วันที่บันทึก</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input name="RISK_ACCOUNT_DATESAVE" id="RISK_ACCOUNT_DATESAVE"
                                    class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;" value="{{ formate($datenow) }}"
                                    readonly>
                            </div>                                                      
                      
                            <div class="col-sm-2 ">
                                <label>หน่วยงานที่รายงาน </label>
                            </div>
                            <div class="col-lg-2 ">
                                @foreach ($departsubs as $departsub)
                                    <input type="text" class="form-control input-sm fo13" name="" id=""
                                        value="{{ $departsub->HR_DEPARTMENT_SUB_SUB_NAME }}" readonly>
                                    <input type="hidden" class="form-control input-sm fo13" name="RISK_ACCOUNT_DEBSUBSUB_ID"
                                        id="RISK_ACCOUNT_DEBSUBSUB_ID" value="{{ $departsub->HR_DEPARTMENT_SUB_SUB_ID }}">
                                @endforeach
                            </div>
                        </div>

                       
                        <div class="row push">
                            <div class="col-sm-2">
                                <label>ปีงบประมาณ </label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISK_ACCOUNT_YEAR" id="RISK_ACCOUNT_YEAR" class="form-control js-example-basic-single foo13" >
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
                            </div>                           
                             <div class="col-sm-2">
                                <label>หัวหน้าหน่วยงาน  :</label>                                
                            </div>
                            <div class="col-lg-2">
                                <select name="RISK_ACCOUNT_LEADERID" id="RISK_ACCOUNT_LEADERID" class="form-control input-lg fo13" required>                           
                                    @foreach ($leaders as $leader) 
                                      @if( $leader ->LEADER_ID  == $checkleader_sub)                                  
                                           <input value="{{ $leader ->LEADER_ID }}" name="LEADER_ID" id="LEADER_ID" selected>
                                      @else                                                    
                                            <option value="{{ $leader ->LEADER_ID  }}">{{ $leader->LEADER_NAME}}</option>
                                      @endif      
                                    @endforeach 
                                </select> 
                            </div>                            
                        </div>
                        <div class="row push">                          
                            <div class="col-sm-2">
                                <label>ความเสี่ยงด้าน </label><label style="color: red;">** &nbsp;</label>
                            </div>
                            <div class="col-lg-6 ">
                                <select name="RISK_ACCOUNT_RISK" id="RISK_ACCOUNT_RISK" class="form-control input-sm js-example-basic-single foo13" required>
                                   <option value="">--กรุณาเลือก--</option>
                                    @foreach ($risk_account_types as $risk_account_type)                                   
                                        <option value="{{ $risk_account_type->RISK_ACCOUNTTYPE_ID }}">{{ $risk_account_type->RISK_ACCOUNTTYPE_NAME }} </option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push">
                            <div class="col-sm-2">
                                <label>โอกาสที่จะเกิด </label><label style="color: red;">** &nbsp;</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISK_ACCOUNT_SCOPE" id="RISK_ACCOUNT_SCOPE" class="form-control input-sm js-example-basic-single scope fo13" required>
                                   <option value="">--กรุณาเลือก--</option>
                                        @foreach ($scopes as $scope)                                   
                                            <option value="{{ $scope->RISK_ACCOUNTSCOPE_ID }}">{{ $scope->RISK_ACCOUNTSCOPE_CODE }}  
                                        @endforeach                   
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>ผลกระทบ </label><label style="color: red;">** &nbsp;</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISK_ACCOUNT_RISK_EFFECT" id="RISK_ACCOUNT_RISK_EFFECT" class="form-control input-sm js-example-basic-single effect fo13">
                                    <option value="">--กรุณาเลือก--</option>
                                      
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>ระดับความเสี่ยง </label>
                            </div>
                            <div class="col-lg-2 ">
                               
                                <select name="RISK_ACCOUNT_RISK_LEVEL" id="RISK_ACCOUNT_RISK_LEVEL" class="form-control input-sm risklevel fo13">
                                    <option value="">--กรุณาเลือก--</option>
                                     
                                </select>
                            </div>
                        </div>

                        <div class="row push">
                            <div class="col-sm-12">
                                <label>ความเสี่ยง (รายละเอียด) </label>
                           
                                <textarea type="text" name="RISK_ACCOUNT_RISK_DETAIL" id="RISK_ACCOUNT_RISK_DETAIL" class="form-control input-sm fo13" rows ="3"></textarea>
                            </div>                         
                        </div>


                        </div>
                      

                                 

            <div class="modal-footer">
                <div align="right">
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                            class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                        onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger"
                       ><i
                            class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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
            <script src="{{ asset('select2/select2.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
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
                $('.budget').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.selectbudget') }}",
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

                $('.scope').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.fectscope') }}",
                            method: "GET",
                            data: {
                                select: select,
                                _token: _token
                            },
                            success: function(result) {
                                $('.effect').html(result);
                            }
                        })
                    }
                });

                $('.effect').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.fectriskeffect') }}",
                            method: "GET",
                            data: {
                                select: select,
                                _token: _token
                            },
                            success: function(result) {
                                $('.risklevel').html(result);
                            }
                        })
                    }
                });
               

            </script>

        @endsection
