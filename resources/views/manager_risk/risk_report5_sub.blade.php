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




    ?>
    <center>
        <div class="block shadow-lg mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <div align="left">
                        <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">
                            <B>รายงาน ปค.5 </B></h2>
                    </div>
                    <div class="col-lg-2 "align="right">
                        <a href="{{ url('manager_risk/risk_report5')  }}" class="btn btn-success btn-lg"  style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">ย้อนกลับ</a> 
                            </div>
                </div>

                
                <div class="block-content block-content-full">
     
                    <div class="table-responsive">
                        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" width="5%">ลำดับ</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >ความเสี่ยง</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >การควบคุมภายในที่มี</th> 
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >การประเมินผลควบคุมภายใน</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >ความเสี่ยงที่ยังมีอยู่</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >การปรับปรุงควบคุมภายใน</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >หน่วยงานรับผิดชอบ</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >ระยะเวลา</th>
                                    <th  class="text-font" style="text-align: center;font-size: 13px;" >ติดตาม</th>
                                 
    
                                </tr >
                            </thead>
                            <tbody>
    
                                <?php $number = 0; ?>
                                @foreach ($infomationreport5subs as $infomationreport5sub)
                                <?php
                                $number++;
                          ?>
                       
                                    <tr height="20">                       
                                        <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                     
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_RISK}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_CONTROL}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_RATE}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_HAVE}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_IMPROVE}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TIME}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TAG}}</td>
    
                                        
    
                                     
                                    </tr>
                                 
    
                  @endforeach              
                            </tbody>
                        </table>
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

    @endsection
