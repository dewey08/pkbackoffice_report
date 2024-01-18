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
                                    class="btn btn-hero-sm btn-hero-info"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">รายงาน ปค.5
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
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>เพิ่ม/แก้ไข รายงานประเมินผลควบคุมภายใน ปค.5</B></h3>
              
            </div>
            <div class="block-content">
             
                <form  method="post" id="form_add" action="" >
                    @csrf
               
                  <div class="form-group">
                  <div class="row">

                  <div class="col-sm-1 text-left">
                  <label >ปีงบประมาณ</label>
                  </div>
                  <div class="col-sm-2">
                  <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                  </div>
                
                  <div class="col-sm-1 text-left">
                    <label >รอบประเมิน</label>
                    </div>
                    <div class="col-sm-3">
                    <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                   
                    <div class="col-sm-2 text-left">
                        <label >ระยะเวลาดำเนินการ</label>
                        </div>
                        <div class="col-sm-3">
                        <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                        </div>
                        </div>

                  </div>
                  <div class="form-group">
                    <div class="row">
  
                    <div class="col-sm-1 text-left">
                    <label >ผู้จัดทำ</label>
                    </div>
                    <div class="col-sm-2">
                    <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                  
                    <div class="col-sm-1 text-left">
                      <label >หัวหน้าหน่วย</label>
                      </div>
                      <div class="col-sm-3">
                      <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                      </div>
                     
                      <div class="col-sm-2 text-left">
                          <label >วันที่รายงาน</label>
                          </div>
                          <div class="col-sm-3">
                          <input  name = "UNIVER_NAME"  id="UNIVER_NAME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                          </div>
                          </div>
  
                    </div>
              
                  </div>
                    <div class="modal-footer">
                    <div align="right">
                    <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save"></i> &nbsp; บันทึกข้อมูล</span>
                    <a href="{{ url('general_risk/risk_notify_report5/' . $inforpersonuserid->ID) }}" type="button" class="btn btn-hero-sm btn-hero-danger"><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>
                    </div>
                    </div>
                    </form>  
           

                </div>
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
