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
                float: right;
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
    $refnumberRiskuser = RiskController::refnumberRiskuser();
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);

    $check = RiskController::checkpermischeckinfo($user_id);

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
    <br>
    <div class="content">
        <div class="block block-rounded block-bordered">


            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                    <div class="col-lg-8 ">
                    แก้ไขแบบประเมินการควบคุมภายในด้วยตนเอง (Control self Assessment : CSA)
                    </div>
                     <div class="col-lg-4" align="right">
                
                    </div>
                </div>
                </h2>
               
            
            
                </a>
               
                <div class="block-content block-content-full" align="left">

                    <form method="post" action="{{ route('gen_risk.risk_notify_internalcontrol_update') }}" enctype="multipart/form-data">
                        @csrf

                        <input value="{{ $id_user }}" type="hidden" name="USER_ID" id="USER_ID" class="form-control input-lg">

                        <input type="hidden" value="{{ $internalcontrol->INTERNALCONTROL_ID }}"
                        name="INTERNALCONTROL_ID" id="INTERNALCONTROL_ID" class="form-control input-sm">

                         


                        <div class="row push">
                            <div class="col-sm-1">
                                <label>Risk no. </label><label style="color: red;">** &nbsp;</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input type="text" name="INTERNALCONTROL_NO" id="INTERNALCONTROL_NO" class="form-control input-sm fo13"
                                    value="{{ $internalcontrol->INTERNALCONTROL_NO }} " readonly>
                            </div>

                            <div class="col-sm-1">
                                <label>วันที่บันทึก</label>
                            </div>
                            <div class="col-lg-3 ">
                                <input name="INTERNALCONTROL_DATE" id="INTERNALCONTROL_DATE"
                                    class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;" value="{{ formate($internalcontrol->INTERNALCONTROL_DATE) }}"
                                    readonly>

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

                      
                            <div class="col-sm-2 text-right">
                                <label>หัวหน้าหน่วยงาน  :</label>                                
                            </div>
                            <div class="col-sm-2">
                                <select name="LEADER_ID" id="LEADER_ID" class="form-control input-lg fo13" required>                           
                              
                                    @foreach ($leaders as $leader) 
                                    @if( $leader ->LEADER_ID  == $checkleader_sub)
                                         <option value="{{ $leader ->LEADER_ID  }}" selected>{{ $leader->LEADER_NAME}}</option>
                                    @else                                                    
                                          <option value="{{ $leader ->LEADER_ID  }}">{{ $leader->LEADER_NAME}}</option>
                                    @endif      
                                  @endforeach 
                                </select> 
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>Link Flow Chart  :</label>                                
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control input-sm fo13" name="INTERNALCONTROL_LINK" id="INTERNALCONTROL_LINK"
                                value="{{ $internalcontrol->INTERNALCONTROL_LINK }}" >
                            </div>

                        </div>

                   
                        <div class="row push">
                            <div class="col-sm-1 text-right">
                                <label>1 :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <div align="left"
                                    style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;">
                                    วิเคราะห์ภารกิจงาน/กิจกรรมที่มีความเสี่ยงสูงมา ๑
                                    เรื่องพร้อมระบุวัตถุประสงค์ของภารกิจงาน/กิจกรรมนั้น
                                </div>
                            </div>
                        </div>

                        <div class="row push">
                            <div class="col-sm-1">
                                <label></label>
                            </div>

                            <div align="left" class="col-sm-1 "
                                style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;">ภารกิจ :
                            </div>

                            <div class="col-lg-9 ">
                                <input type="text" value="{{ $internalcontrol->INTERNALCONTROL_MISSION }}"
                                    name="INTERNALCONTROL_MISSION" id="INTERNALCONTROL_MISSION"
                                    class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;">
                            </div>
                        </div>

                        <div class="row push">
                            <div class="col-md-1 ">
                            </div>

                            <div class="col-md-10  ">

                                <div align="left"
                                    style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;">
                                    วัตถุประสงค์ :</div>
                                <br>
                                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                            <td style="text-align: center;font-size: 14px;font-weight:normal;"
                                                width="5%">ลำดับ</td>
                                            <td style="text-align: center;font-size: 14px;font-weight:normal;">
                                                รายละเอียด</td>

                                            <td style="text-align: center;" width="8%">
                                                <a class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody1">

                                        <tr height="20">
                                            <?php $number = 0; ?>
                                            @foreach ($internalcontrol_subs as $internalcontrol_sub)
                                                <?php $number++; ?>
                                                <td style="text-align: center;font-size: 14px;font-weight:normal;">
                                                    {{ $number }}</td>
                                                <td>
                                                    <input name="INTERNALCONTROL_OBJECTIVE[]"
                                                        id="INTERNALCONTROL_OBJECTIVE[]" class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;"
                                                        value="{{ $internalcontrol_sub->INTERNALCONTROL_OBJECTIVE }}">
                                                </td>

                                                <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row push">
                            <div class="col-sm-1 text-right">
                                <label>2 :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <div align="left"
                                    style=" font-family:'Kanit', sans-serif;font-size:14px;font-weight:normal;">
                                    ภารกิจงาน/กิจกรรมนั้น มีขั้นตอนหรือกระบวนการปฎิบัติอะไรบ้าง
                                    หรือทำอย่างไรที่จะทำไห้บรรลุตามวัตถุประสงค์
                                </div>
                            </div>
                        </div>

                        <div class="row push">
                            <div class="col-sm-1">
                                <label></label>
                            </div>
                            <div class="col-lg-10 ">
                                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                            <td style="text-align: center;font-size:14px;font-weight:normal;"
                                                width="5%">ลำดับ</td>
                                            <td style="text-align: center;font-size:14px;font-weight:normal;">รายละเอียด
                                            </td>

                                            <td style="text-align: center;font-size:14px;font-weight:normal;"
                                                width="8%">
                                                <a class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody2">
                                        <tr height="20">
                                            <?php $number = 0; ?>
                                            @foreach ($internalcontrol_subsubs as $internalcontrol_subsub)
                                                <?php $number++; ?>
                                                <td style="text-align: center;font-size:14px;font-weight:normal;">
                                                    {{ $number }} </td>
                                                <td>
                                                    <input name="INTERNALCONTROL_SUBSUB_NAME[]"
                                                        id="INTERNALCONTROL_SUBSUB_NAME[]" class="form-control input-sm"
                                                        style=" font-family: 'Kanit', sans-serif;font-size:14px;font-weight:normal;"
                                                        value="{{ $internalcontrol_subsub->INTERNALCONTROL_SUBSUB_NAME }}">
                                                </td>

                                                <td style="text-align: center;">
                                                    <a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>              

            <div class="modal-footer">
                <div align="right">
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                            class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
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
                        // console.log(select);
                    }
                });
                $('.addRow').on('click', function() {
                            addRow();
                        });

                        function addRow() {
                            var count = $('.tbody1').children('tr').length;
                            var tr = '<tr>' +
                                '<td style="text-align: center;font-size:14px;font-weight:normal;">' +
                                (count + 1) +
                                '</td>' +
                                '<td>' +
                                '<input name="INTERNALCONTROL_OBJECTIVE[]" id="INTERNALCONTROL_OBJECTIVE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size:14px;font-weight:normal;" >' +
                                '</td>' +

                                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
                                '</tr>';
                            $('.tbody1').append(tr);
                        };

                        $('.tbody1').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
                        });

                        $('.addRow2').on('click', function() {
                            addRow2();
                        });

                        function addRow2() {
                            var count = $('.tbody2').children('tr').length;
                            var tr = '<tr>' +
                                '<td style="text-align: center;font-size:14px;font-weight:normal;">' +
                                (count + 1) +
                                '</td>' +
                                '<td>' +
                                '<input name="INTERNALCONTROL_SUBSUB_NAME[]" id="INTERNALCONTROL_SUBSUB_NAME[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size:14px;font-weight:normal;">' +
                                '</td>' +

                                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>' +
                                '</tr>';
                            $('.tbody2').append(tr);
                        };

                        $('.tbody2').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
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

            </script>

        @endsection
