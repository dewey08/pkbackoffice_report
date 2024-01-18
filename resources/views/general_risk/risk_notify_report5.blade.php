@extends('layouts.backend')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
                <h1 style="font-family: 'Kanit', sans-serif; font-size:17px;font-weight:normal;">
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
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายงาน ปค.5 รายงานการประเมินผลการควบคุมภายใน</B></h3>
            
                    <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มรายงาน ปค.5</button>
            </div>
            <div class="block-content">
             
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                <th class="text-font" style="text-align: center;" width="5%">ปีงบประมาณ</th>
                                <th class="text-font" style="text-align: center;" >รอบ</th>
                                <th class="text-font" style="text-align: center;" >ระยะเวลาดำเนินงาน</th>
                                <th class="text-font" style="text-align: center;" >หน่วยงาน</th>
                                <th class="text-font" style="text-align: center;" >ผู้จัดทำ</th>
                                <th class="text-font" style="text-align: center;" >วันที่รายงาน</th>
                                {{-- <th class="text-font" style="text-align: center;" > ความเสี่ยง</th> --}}
                                <th class="text-font" style="text-align: center;" width="5%">คำสั่ง</th>
                            </tr >
                        </thead>
                        <tbody>

                            <?php $number = 0; ?>
                            @foreach ($infomationreport5s as $infomationreport5)
                            <?php
                            $number++;
                      ?>
                                <tr height="40">                       
                                    <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5->RISK_NOTIFY_RE5_YEAR}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5->RISK_NOTIFY_RE5_ROUND}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{DateThai($infomationreport5->RISK_NOTIFY_RE5_BEGINDATE)}} - {{DateThai($infomationreport5->RISK_NOTIFY_RE5_ENDDATE)}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5->HR_FNAME}} {{$infomationreport5->HR_LNAME}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{DateThai($infomationreport5->created_at)}}</td>
                                 
                                    <td align="center" width="5%">
                                        <div class="dropdown ">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                ทำรายการ                                           
                                            </button>                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  
                                            <a class="dropdown-item" href="#edit_modal{{$infomationreport5->RISK_NOTIFY_RE5_ID}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด/แก้ไข</a> 
                                                <a class="dropdown-item"  href="{{ url('general_risk/risk_notify_report5_sub/'.$infomationreport5->RISK_NOTIFY_RE5_ID.'/'.$inforpersonuserid->ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;"><i class="fas fa-info-circle text-info mr-2"></i>ประเมินควบคุมภายใน</a> 
                                             
                                                
                                            </div>
                                        </div>                                       
                                    </td> 
                                </tr>

                            <!--select2 modal form edit  -->
                            <script>
                              $(document).ready(function() {
                                $("#RISK_NOTIFY_RE5_YEAR{{$infomationreport5->RISK_NOTIFY_RE5_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{$infomationreport5->RISK_NOTIFY_RE5_ID}}") 
                                });
                                $("#RISK_NOTIFY_RE5_DEP{{$infomationreport5->RISK_NOTIFY_RE5_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{$infomationreport5->RISK_NOTIFY_RE5_ID}}") 
                                });
                                $("#RISK_NOTIFY_RE5_PERSON{{$infomationreport5->RISK_NOTIFY_RE5_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{$infomationreport5->RISK_NOTIFY_RE5_ID}}") 
                                });
                              });
                            </script>
                            <!--end select2 modal form edit  -->   
                                    
<div id="edit_modal{{$infomationreport5->RISK_NOTIFY_RE5_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> แก้ไขการประเมินความเสี่ยง</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('gen_risk.risk_notify_report5_update') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">
          <input type="hidden" name="RISK_NOTIFY_RE5_ID" id="RISK_NOTIFY_RE5_ID" value="{{$infomationreport5->RISK_NOTIFY_RE5_ID}}">
   
          <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ปีงบประมาณ</label>
            </div>
            <div class="col-sm-4">
                <select name = "RISK_NOTIFY_RE5_YEAR"  id="RISK_NOTIFY_RE5_YEAR{{$infomationreport5->RISK_NOTIFY_RE5_ID}}"  class="form-control input-lg" style="width: 100%;">
                    @foreach ($infobudgets as $infobudget)
                        @if($infobudget->LEAVE_YEAR_ID  = $infomationreport5->RISK_NOTIFY_RE5_YEAR)
                        <option value="{{ $infobudget -> LEAVE_YEAR_ID }}" selected>{{ $infobudget -> LEAVE_YEAR_ID }}</option>
                        @else
                        <option value="{{ $infobudget -> LEAVE_YEAR_ID }}" >{{ $infobudget -> LEAVE_YEAR_ID }}</option>
                        @endif
                    @endforeach 
                </select>
            </div>
            <div class="col-sm-2 text-left">
                <label >รอบ</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_NOTIFY_RE5_ROUND"  id="RISK_NOTIFY_RE5_ROUND" value="{{$infomationreport5->RISK_NOTIFY_RE5_ROUND}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>
     
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ระยะเวลาดำเนิน</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_NOTIFY_RE5_BEGINDATE"  id="RISK_NOTIFY_RE5_BEGINDATE"  value="{{formate($infomationreport5->RISK_NOTIFY_RE5_BEGINDATE)}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
            </div>
            <div class="col-sm-2 text-left">
                <label >ถึง</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_NOTIFY_RE5_ENDDATE"  id="RISK_NOTIFY_RE5_ENDDATE" value="{{formate($infomationreport5->RISK_NOTIFY_RE5_ENDDATE)}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                </div>
            </div>
            </div>


            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >หน่วยงาน</label>
                </div>
                <div class="col-sm-4">
                    <select name = "RISK_NOTIFY_RE5_DEP"  id="RISK_NOTIFY_RE5_DEP{{$infomationreport5->RISK_NOTIFY_RE5_ID}}"  class="form-control input-lg" style="width: 100%;">
                         @foreach ($infodeps as $infodep)
                              @if($infodep->HR_DEPARTMENT_SUB_SUB_ID == $infomationreport5->RISK_NOTIFY_RE5_DEP)
                              <option value=" {{ $infodep -> HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                              @else
                            <option value=" {{ $infodep -> HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @endif
                        @endforeach 
                    </select>
                </div>
                <div class="col-sm-2 text-left">
                    <label >ผู้จัดทำ</label>
                    </div>
                    <div class="col-sm-4">
                        <select name = "RISK_NOTIFY_RE5_PERSON"  id="RISK_NOTIFY_RE5_PERSON{{$infomationreport5->RISK_NOTIFY_RE5_ID}}"  class="form-control input-lg" style="width: 100%;">
                            @foreach ($infopersons as $infoperson) 
                                @if( $infoperson->ID == $infomationreport5->RISK_NOTIFY_RE5_PERSON)
                                <option value="{{ $infoperson -> ID }}" selected>{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>

                                 @else
                                <option value="{{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                               
                                @endif
                            
                                @endforeach 
                        </select>
                    </div>
                </div>
                </div>      
    
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
            </div>

                        
           @endforeach                        
                        </tbody>
                    </table>
                    <br><br><br><br>
                    <br><br><br><br>
                </div>
            </div>
        </div>
        
    </div>







    
<div class="modal fade add" id="add_risk" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม การประเมินความเสี่ยง</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('gen_risk.risk_notify_report5_save') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">
          

          <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ปีงบประมาณ</label>
            </div>
            <div class="col-sm-4">
                <select name = "RISK_NOTIFY_RE5_YEAR"  id="RISK_NOTIFY_RE5_YEAR"  class="js-select2 form-control input-lg" style="width: 100%;">
                    @foreach ($infobudgets as $infobudget)
                        <option value="{{ $infobudget -> LEAVE_YEAR_ID }}" >{{ $infobudget -> LEAVE_YEAR_ID }}</option>
                    @endforeach 
                </select>
            </div>
            <div class="col-sm-2 text-left">
                <label >รอบ</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_NOTIFY_RE5_ROUND"  id="RISK_NOTIFY_RE5_ROUND" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>
     
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ระยะเวลาดำเนิน</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_NOTIFY_RE5_BEGINDATE"  id="RISK_NOTIFY_RE5_BEGINDATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
            </div>
            <div class="col-sm-2 text-left">
                <label >ถึง</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_NOTIFY_RE5_ENDDATE"  id="RISK_NOTIFY_RE5_ENDDATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                </div>
            </div>
            </div>


            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >หน่วยงาน</label>
                </div>
                <div class="col-sm-4">
                    <select name = "RISK_NOTIFY_RE5_DEP"  id="RISK_NOTIFY_RE5_DEP"  class="js-select2 form-control input-lg" style="width: 100%;">
                         @foreach ($infodeps as $infodep)
                            <option value=" {{ $infodep -> HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                         @endforeach 
                    </select>
                </div>
                <div class="col-sm-2 text-left">
                    <label >ผู้จัดทำ</label>
                    </div>
                    <div class="col-sm-4">
                        <select name = "RISK_NOTIFY_RE5_PERSON"  id="RISK_NOTIFY_RE5_PERSON"  class="js-select2 form-control input-lg" style="width: 100%;">
                            @foreach ($infopersons as $infoperson) 
                                <option value=" {{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                </div>
       
     
    
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
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

    $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
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

            <script src="{{ asset('select2/select2.min.js') }}"></script>
            <script>
            $(document).ready(function() {
            $(".js-select2 ").select2({ 
                dropdownParent: $("#add_risk") 
                
                });
            });
            </script>

        @endsection
