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
                /* float: right; */
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
                    
                    <div class="col-sm-10">
                        <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดอุบัติการณ์ความเสี่ยง :: {{$inforisk->RISK_ACC_ISSUE}}</B>
                        </h3> 
                    </div>              
                       <div class="col-sm-2">
                        &nbsp;&nbsp;
                        &nbsp;
                        <a href="{{ url('manager_risk/risk_account')  }}"  type="button" class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif;">ย้อนกลับ</a>
                       </div>
                    </div>

                    
                </div>
                <div class="block-content block-content-full">
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
