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
    $check = RiskController::checkpermischeckinfo($user_id);



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
                                class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">บัญชีความเสี่ยง
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
            <div class="block-header block-header-default">
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดอุบัติการณ์ความเสี่ยง :: {{$inforisk->RISK_ACC_ISSUE}}</B>
                </h3>               

                &nbsp;&nbsp;
                &nbsp;
                <a href="{{ url('general_risk/risk_notify_account_detail/'.$id_user)  }}"  type="button" class="btn btn-hero-sm btn-hero-success" >ย้อนกลับ</a>
            
            </div>

            <div class="block-content">
     
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                <th class="text-font" style="text-align: center;" >สถานะ</th>
   
                                <th class="text-font" style="text-align: center;" >ความรุนแรง</th>
                                <th class="text-font" style="text-align: center;" >วันที่บันทึก</th>
                                <th class="text-font" style="text-align: center;" > ที่มา</th>
                                <th class="text-font" style="text-align: center;" > รายละเอียดเหตุการณ์</th>
                                <th class="text-font" style="text-align: center;" > การจัดการเบื้องต้น</th>
                               
                           
                            </tr >
                        </thead>
                        <tbody>

                            <?php $number = 0; ?>
                            @foreach ($infoincidences as $rigrep)
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
                                $statuslevel = 'badge badge-danger';
                                } elseif ($level === '2') {
                                $statuslevel = 'badge badge-warning';
                                } elseif ($level === '3') {
                                $statuslevel = 'badge badge-danger';
                                } elseif ($level === '4') {
                                $statuslevel = 'badge badge-info';
                                } elseif ($level === '5') {
                                $statuslevel = 'badge badge-success';
                                } elseif ($level === '6') {
                                $statuslevel = 'badge badge-secondary';                                  
                                } elseif ($level === '7') {
                                $statuslevel = 'badge badge-info';
                                } elseif ($level === '8') {
                                $statuslevel = 'badge badge-success';
                                } elseif ($level === '9') {
                                $statuslevel = 'badge badge-secondary';
                                } elseif ($level === '10') {
                                $statuslevel = 'badge badge-primary';
                                } elseif ($level === '11') {
                                $statuslevel = 'badge badge-secondary';
                                } elseif ($level === '12') {
                                $statuslevel = 'badge badge-info';
                                } elseif ($level === '13') {
                                $statuslevel = 'badge badge-success';
                                } elseif ($level === '14') {
                                $statuslevel = 'badge badge-secondary';
                                } else {
                                $statuslevel = '';
                                }
                      ?>

                            
                                <tr height="40">                       
                                    <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                
                                    <td align="center"> <span class="{{ $statuscol }}"
                                        width="8%">{{ $rigrep->RISK_STATUS_NAME_TH }}</span></td>
                               
                              
                                </td>
                                <td align="center"> <span class="{{ $statuslevel }}" width="8%">{{ $rigrep->RISK_REP_LEVEL_NAME }}</span></td>
                                <td class="text-font text-pedding" style="text-align: center;" width="10%">
                                    {{ DateThai($rigrep->RISKREP_DATESAVE) }}</td>
                                <td class="text-font text-pedding" style="text-align: left;" width="13%">
                                    {{ $rigrep->INCIDENCE_LOCATION_NAME }}</td>
                                <td class="text-font text-pedding">{!! $rigrep->RISKREP_DETAILRISK !!}</td>
                                <td class="text-font text-pedding" style="text-align: left;">{!! $rigrep->RISKREP_BASICMANAGE !!}
                                </td>
                                  
                             
                                </tr>
                             
                             @endforeach      
                           
                        </tbody>
                    </table>
                                 
<br><br><br>





    
<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม การประเมินความเสี่ยง</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('gen_risk.risk_account_detail_level_save') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="RISK_ACC_ID" id="RISK_ACC_ID" value="{{$idref}}">
          <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">

          <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ปี</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_YEAR"  id="RISK_ACCDE_LE_YEAR" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ระดับประเมิน</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_RATE"  id="RISK_ACCDE_LE_RATE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>
     
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >โอกาส</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_CHANCE"  id="RISK_ACCDE_LE_CHANCE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ผลกระทบ</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_EFFECT"  id="RISK_ACCDE_LE_EFFECT" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>


            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >คะแนน</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_SCORE"  id="RISK_ACCDE_LE_SCORE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                <div class="col-sm-2 text-left">
                    <label >ค่าที่ยอมรับได้</label>
                    </div>
                    <div class="col-sm-4">
                        <input  name = "RISK_ACCDE_LE_ACCEPTABLE"  id="RISK_ACCDE_LE_ACCEPTABLE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
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
