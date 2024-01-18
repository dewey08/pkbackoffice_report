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
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>ภาระกิจ {{$infomationcon->INTERNALCONTROL_MISSION}}</B></h3>
                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                &nbsp;
                <a href="{{ url('general_risk/risk_notify_internalcontrol/'.$id_user)  }}"  type="button" class="btn btn-hero-sm btn-hero-success" >ย้อนกลับ</a>



            </div>
            <div class="block-content">
              

                 
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="5%">ลำดับ</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ขั้นตอน/กระบวนการ</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >เพื่อลดความเสี่ยงอะไร</th> 
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >กิจกรรมที่ปฎิบัติ</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >จากการประเมินผลพบว่า</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ความเสี่ยงที่มี</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >คำสั่ง</th>

                            </tr >
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($infoanalyzes as $infoanalyze)
                            <?php
                            $number++;
                      ?>
                   
                                <tr height="20">                       
                                    <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{ $number}}</td>
                                 
                                    <td class="text-font text-pedding" style="text-align: left;font-size: 13px;" >{{$infoanalyze->ANALYZE_STEP}}</td>
                                    <td class="text-font text-pedding" style="text-align: left;font-size: 13px;" >{{$infoanalyze->ANALYZE_REDUCE}}</td>
                                    <td class="text-font text-pedding" style="text-align: left;font-size: 13px;" >{{$infoanalyze->ANALYZE_ACTIVITY}}</td>
                                    <td class="text-font text-pedding" style="text-align: left;font-size: 13px;" >{{$infoanalyze->ANALYZE_RESULTS}}</td>
                                    <td class="text-font text-pedding" style="text-align: left;font-size: 13px;" >{{$infoanalyze->ANALYZE_RISK}}</td>

                                    <td align="center" width="5%">
                                        <div class="dropdown ">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                ทำรายการ                                           
                                            </button>                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">   
                                                <a class="dropdown-item" href="#edit_modal{{ $infoanalyze->ANALYZE_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('general_risk/risk_notify_analysis_destroy/'.$infoanalyze->ANALYZE_ID.'/'.$id_user)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                                             
                                                
                                            </div>
                                        </div>                                       
                                    </td> 
                                </tr>





                                 
    <div id="edit_modal{{ $infoanalyze->ANALYZE_ID }}"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      
          <div class="modal-header">
                
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> แก้ไข ขั้นตอนกระบวนการ</h2>
              </div>
              <div class="modal-body">
              <body>

                <form method="post" action="{{ route('gen_risk.risk_notify_analysis_update') }}" enctype="multipart/form-data">
                    @csrf

              <input type="hidden" name="ANALYZE_ID" id="ANALYZE_ID" value="{{$infoanalyze->ANALYZE_ID}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
              <input type="hidden" name="USER_ID" id="USER_ID" value="{{$id_user}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
              <input type="hidden" name="INTERNALCONTROL_ID" id="INTERNALCONTROL_ID" value="{{$idref}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
              

            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ขั้นตอนกระบวนการ</label>
            </div>
            <div class="col-sm-9"> 
            
            
            <select name="ANALYZE_STEP" id="ANALYZE_STEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                <option value="">--เลือก--</option>
                    @foreach ($infomationcon_steps as $infomationcon_step)
                        @if($infomationcon_step->INTERNALCONTROL_SUBSUB_NAME == $infoanalyze->ANALYZE_STEP)
                            <option value="{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME }}" selected>{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME}}</option>
                        @else
                            <option value="{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME }}">{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME}}</option>
                        @endif
                       

                    @endforeach 
            </select>
        
        
             </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >เพื่อลดความเสี่ยงอะไร</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_REDUCE"  id="ANALYZE_REDUCE"  value="{{$infoanalyze->ANALYZE_REDUCE}}"  class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >กิจกรรมที่ปฎิบัติ</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_ACTIVITY"  id="ANALYZE_ACTIVITY"  value="{{$infoanalyze->ANALYZE_ACTIVITY}}"  class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >จากการประเมินผลพบว่า</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_RESULTS"  id="ANALYZE_RESULTS" value="{{$infoanalyze->ANALYZE_RESULTS}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ความเสี่ยงที่มี</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_RISK"  id="ANALYZE_RISK" value="{{$infoanalyze->ANALYZE_RISK}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
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

                                @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      
          <div class="modal-header">
                
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม ขั้นตอนกระบวนการ</h2>
              </div>
              <div class="modal-body">
              <body>

                <form method="post" action="{{ route('gen_risk.risk_notify_analysis_save') }}" enctype="multipart/form-data">
                    @csrf

              <input type="hidden" name="USER_ID" id="USER_ID" value="{{$id_user}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
              <input type="hidden" name="INTERNALCONTROL_ID" id="INTERNALCONTROL_ID" value="{{$idref}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
              

            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ขั้นตอนกระบวนการ</label>
            </div>
            <div class="col-sm-9">
                <select name="ANALYZE_STEP" id="ANALYZE_STEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--เลือก--</option>
                        @foreach ($infomationcon_steps as $infomationcon_step)
                      
                            <option value="{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME }}">{{ $infomationcon_step->INTERNALCONTROL_SUBSUB_NAME}}</option>
    
                        @endforeach 
                </select>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >เพื่อลดความเสี่ยงอะไร</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_REDUCE"  id="ANALYZE_REDUCE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >กิจกรรมที่ปฎิบัติ</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_ACTIVITY"  id="ANALYZE_ACTIVITY" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >จากการประเมินผลพบว่า</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_RESULTS"  id="ANALYZE_RESULTS" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ความเสี่ยงที่มี</label>
            </div>
            <div class="col-sm-9">
                <input  name = "ANALYZE_RISK"  id="ANALYZE_RISK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
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

        @endsection

        @section('footer')

            <!-- Page JS Plugins -->
            <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
            <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
            <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
         
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
