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
                float: left;
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
                        <a class="btn btn-hero-sm btn-hero-success" href="{{url('manager_risk/risk_account')}}"
                            style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ </a>
                    </div>
                </div>
                <div class="block-content block-content-full">                        
                            <input value="{{ $id_user }}" type="hidden" name="USER_ID" id="USER_ID" class="form-control input-lg">
                            <input value="{{ $riskaccs->RISK_ACCOUNT_ID }}" type="hidden" name="RISK_ACCOUNT_ID" id="RISK_ACCOUNT_ID" class="form-control input-lg">                
    
                            <div class="row push">
                                <div class="col-sm-2">
                                    <label>Account No. </label>
                                </div>
                                <div class="col-lg-2 text-left">
                                   {{ $riskaccs->RISK_ACCOUNT_NO }}
                                </div>
    
                                <div class="col-sm-2">
                                    <label>วันที่บันทึก</label>
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{formate($riskaccs->RISK_ACCOUNT_DATESAVE )}}                                
                                </div>                                                     
                                <div class="col-sm-2 ">
                                    <label>หน่วยงานที่รายงาน </label>
                                </div>
                                <div class="col-lg-2 ">
                                  
                                </div>
                            </div>                       
                            <div class="row push">
                                <div class="col-sm-2">
                                    <label>ปีงบประมาณ </label>
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{$year_id}}
                                   
                                </div>                           
                                 <div class="col-sm-2">
                                    <label>หัวหน้าหน่วยงาน  :</label>                                
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{$riskaccs->RISK_ACCOUNT_LEADERNAME}}
                                   
                                </div>
                               
                            </div>
                            <div class="row push">                          
                                <div class="col-sm-2">
                                    <label>ความเสี่ยงด้าน </label><label style="color: red;">** &nbsp;</label>
                                </div>
                                <div class="col-lg-6 text-left">
                                    {{ $riskaccs->RISK_ACCOUNTTYPE_NAME }}
                                   
                                </div>
                            </div>
                            <div class="row push">
                                <div class="col-sm-2">
                                    <label>โอกาสที่จะเกิด </label>
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{$riskaccs->RISK_ACCOUNT_SCOPE}}
                                  
                                </div>
                                <div class="col-sm-2">
                                    <label>ผลกระทบ </label>
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{$riskaccs->RISK_ACCOUNT_RISK_EFFECT}}
                                  
                                </div>
                                <div class="col-sm-2">
                                    <label>ระดับความเสี่ยง </label>
                                </div>
                                <div class="col-lg-2 text-left">
                                    {{$riskaccs->RISK_ACCOUNT_RISK_LEVEL}}
                                  
                                </div>
                            </div>
    
                            <div class="row push">
                                <div class="col-sm-2">
                                    <label>ความเสี่ยง (รายละเอียด) </label>
                                </div> 
                                    <div class="col-sm-10 text-left">
                                    {{ $riskaccs->RISK_ACCOUNT_RISK_DETAIL }}
                                </div>                         
                            </div>
    
    
                            </div>
                          
    
                                     
    
                <div class="modal-footer">
                    <div align="right">
                       
                                <a href="{{ url('manager_risk/risk_account') }}"
                                     class="btn btn-hero-sm btn-hero-danger"
                                   ><i
                                        class="fas fa-window-close mr-2"></i>ปิด</a>
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
