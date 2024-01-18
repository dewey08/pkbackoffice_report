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
   
   
    ?>
    <center>
        <div class="block shadow-lg mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <div class="row">
                    <div class="col-lg-12 " align="left">
                        <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">
                            <B>ข้อมูล รายงาน ปค.4</B></h2>   
                    </div>
                </div>
                    <div class="col-lg-2 "align="right">
                        <a href="{{ url('manager_risk/risk_report4')  }}" class="btn btn-success btn-lg"  style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">ย้อนกลับ</a> 
                            </div>
                        </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row push">
                        <div class="col-sm-2">
                        <label>ปีงบประมาณ</label>
                        </div> 
                        <div class="col-lg-2 ">
                           {{$infore4->RISK_NOTIFY_RE4_YEAR}}      
                        </div> 
                       
                        <div class="col-sm-2">
                            <label>วันที่ดำเนินการ</label>
                            </div> 
                            <div class="col-lg-2 "> 
                           {{Datethai($infore4->RISK_NOTIFY_RE4_BEGINDATE)}}
                            
                            </div> 
                            <div class="col-sm-1">
                                <label>ถึง </label>
                                </div> 
                                <div class="col-lg-3 "> 
                                   {{Datethai($infore4->RISK_NOTIFY_RE4_ENDDATE)}}    
                                </div> 
                            </div> 
            
            
            
                            <div class="row push">
                             
                                        <div class="col-sm-2">
                                            <label>หน่วยงาน</label>
                                        </div> 
                                        <div class="col-lg-2 ">
                                            {{$infore4->HR_DEPARTMENT_SUB_SUB_NAME}} 
                                        </div>
                                        <div class="col-sm-1">
                                            <label >ผู้จัดทำ</label>                          
                                        </div>
                                        <div class="col-lg-2 ">
                                            {{$infore4->HR_FNAME}}  {{$infore4->HR_LNAME}}         
                                        </div>
                              
                                  
                    </div>
                
                                     
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">สภาพแวดล้อมการควบคุม
                        </div> 
                        <div class="col-lg-10 ">
                           {{$infore4->RISK_NOTIFY_RE4_ENV}}      
                        </div>
                    </div>      
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>สภาพแวดล้อมการควบคุม
                        </div> 
                        <div class="col-lg-10 ">
                            {{$infore4->RISK_NOTIFY_RE4_RESULTENV}}
                        </div>
                    </div>  
                    
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">การประเมินความเสี่ยง
                        </div> 
                        <div class="col-lg-10 ">
                            {{$infore4->RISK_NOTIFY_RE4_RATE}}
                        </div>
                    </div>      
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>การประเมินความเสี่ยง
                        </div> 
                        <div class="col-lg-10 ">
                           {{$infore4->RISK_NOTIFY_RE4_RESULTRATE}}
                          
                        </div>
                    </div> 
            
            
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">กิจกรรมการควบคุม
                        </div> 
                        <div class="col-lg-10 ">
                            {{$infore4->RISK_NOTIFY_RE4_ACT}}
                        </div>
                    </div>      
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>กิจกรรมการควบคุม
                        </div> 
                        <div class="col-lg-10 ">
                           {{$infore4->RISK_NOTIFY_RE4_RESULTACT}}
                        </div>
                    </div> 
            
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">สารสนเทศและการสื่อสาร
                        </div> 
                        <div class="col-lg-10 ">
                           {{$infore4->RISK_NOTIFY_RE4_IT}}
                        </div>
                    </div>      
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>สารสนเทศและการสื่อสาร
                        </div> 
                        <div class="col-lg-10 ">
                           {{$infore4->RISK_NOTIFY_RE4_RESULTIT}}   
                        </div>
                    </div> 
            
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">กิจกรรมการติดตามผล
                        </div> 
                        <div class="col-lg-10 ">
                            {{$infore4->RISK_NOTIFY_RE4_TAG}}
                        </div>
                    </div>      
                    <div class="row push">
                        
                        <div class="col-sm-2">
                            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการประเมิน/ข้อสรุป <br>กิจกรรมการติดตามผล
                        </div> 
                        <div class="col-lg-10 ">
                            {{$infore4->RISK_NOTIFY_RE4_RESULTTAG}}
                        </div>
                    </div> 
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

     
    @endsection 