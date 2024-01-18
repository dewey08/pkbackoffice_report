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


    ?>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');

    use App\Http\Controllers\RiskController;
    $check = RiskController::checkpermischeckinfo($user_id);
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
                                    class="btn btn-hero-sm btn-hero-info"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">รายงาน ปค.4
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
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มข้อมูล รายงาน ปค.4</B></h3>
            

            </div>
            <div class="block-content">
             
               
                <form method="post" action="{{ route('gen_risk.risk_notify_report4_save') }}" enctype="multipart/form-data">
                    @csrf
    
  
           <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">

        <div class="row push">
            <div class="col-sm-2">
            <label>ปีงบประมาณ</label>
            </div> 
            <div class="col-lg-2 ">
                <input type="text" name="RISK_NOTIFY_RE4_YEAR" id="RISK_NOTIFY_RE4_YEAR" class="form-control input-sm " >               
            </div> 
           
            <div class="col-sm-2">
                <label>วันที่ดำเนินการ</label>
                </div> 
                <div class="col-lg-2 "> 
                <input name="RISK_NOTIFY_RE4_BEGINDATE" id="RISK_NOTIFY_RE4_BEGINDATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style="font-family:'Kanit',sans-serif;font-size:13px;" readonly>          
                
                </div> 
                <div class="col-sm-1">
                    <label>ถึง </label>
                    </div> 
                    <div class="col-lg-3 "> 
                        <input name="RISK_NOTIFY_RE4_ENDDATE" id="RISK_NOTIFY_RE4_ENDDATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style="font-family:'Kanit',sans-serif;font-size:13px;"  readonly>          
                    </div> 
                </div> 



                <div class="row push">
                 
                            <div class="col-sm-2">
                                <label>หน่วยงาน</label>
                            </div> 
                            <div class="col-lg-2 ">
                                <select name="RISK_NOTIFY_RE4_DEP" id="RISK_NOTIFY_RE4_DEP" class="form-control input-sm js-example-basic-single fo13" >
                                <option value="">--เลือก--</option>
                                @foreach($infomationdeps as $infomationdep)
                                        <option value="{{ $infomationdep->HR_DEPARTMENT_SUB_SUB_ID}}">{{ $infomationdep->HR_DEPARTMENT_SUB_SUB_NAME}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <label >ผู้จัดทำ</label>                          
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISK_NOTIFY_RE4_PERSON" id="RISK_NOTIFY_RE4_PERSON" class="form-control input-lg fo13" required>
                                    <option value="">--เลือก--</option>
                                    @foreach ($infomationpersons as $infomationperson) 
                                                                                  
                                            <option value="{{ $infomationperson ->ID  }}">{{ $infomationperson->HR_FNAME}} {{ $infomationperson->HR_LNAME}}</option>
                                       
                                    @endforeach 
                                </select>                            
                            </div>
                  
                      
        </div>
    
                         
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">สภาพแวดล้อมการควบคุม
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_ENV" id="RISK_NOTIFY_RE4_ENV" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>      
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>สภาพแวดล้อมการควบคุม
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RESULTENV" id="RISK_NOTIFY_RE4_RESULTENV" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>  
        
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">การประเมินความเสี่ยง
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RATE" id="RISK_NOTIFY_RE4_RATE" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>      
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>การประเมินความเสี่ยง
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RESULTRATE" id="RISK_NOTIFY_RE4_RESULTRATE" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div> 


        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">กิจกรรมการควบคุม
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_ACT" id="RISK_NOTIFY_RE4_ACT" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>      
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>กิจกรรมการควบคุม
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RESULTACT" id="RISK_NOTIFY_RE4_RESULTACT" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div> 

        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">สารสนเทศและการสื่อสาร
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_IT" id="RISK_NOTIFY_RE4_IT" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>      
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>สารสนเทศและการสื่อสาร
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RESULTIT" id="RISK_NOTIFY_RE4_RESULTIT" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div> 

        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">กิจกรรมการติดตามผล
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_TAG" id="RISK_NOTIFY_RE4_TAG" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div>      
        <div class="row push">
            
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>กิจกรรมการติดตามผล
            </div> 
            <div class="col-lg-10 ">
                <textarea name="RISK_NOTIFY_RE4_RESULTTAG" id="RISK_NOTIFY_RE4_RESULTTAG" class="form-control input-lg" rows="10" ></textarea>
              
            </div>
        </div> 
    

    
 
        
          
        </div>  
    
    <div class="modal-footer">
    <div align="right">
    <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
    <a href="{{ url('general_risk/risk_notify_report4/'.$inforpersonuserid -> ID)  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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

            <script src="{{ asset('select2/select2.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $("select").select2();
                });

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



        @endsection
