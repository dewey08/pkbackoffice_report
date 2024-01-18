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

    ?>

    <center>
        <div class="block mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <div align="left">
                        <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายละเอียดรายงานความเสี่ยง</h2>
                    </div>
                    <div align="right">
                        <a class="btn btn-hero-sm btn-hero-success" href="{{ route('mrisk.detail') }}"
                            style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i
                                class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                    </div>
                </div>
                <div class="block-content block-content-full " align="left">


                    <div class="row push">
                        <div class="col-sm-2">
                            <label>Risk No :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISKREP_NO }}

                        </div>
                        <div class="col-sm-1">
                            <label>วันที่บันทึก :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ formate($rigreps->RISKREP_DATESAVE) }}

                        </div>
                        <div class="col-sm-2">
                            <label>หน่วยงานที่รายงาน :</label>
                        </div>
                        <div class="col-lg-3 ">
                            {{ $rigreps->HR_DEPARTMENT_SUB_SUB_NAME }}

                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>แหล่งที่มา/วิธีการค้นพบ :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->INCIDENCE_LOCATION_NAME }}

                        </div>
                        <div class="col-sm-1">
                            <label>สถานที่เกิดเหตุ :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->SETUP_TYPELOCATION_NAME }}

                        </div>
       
                    </div>


                    <div class="row push">
                        <div class="col-sm-2">
                            <label>รายละเอียดเหตุการณ์ :</label>
                        </div>
                        <div class="col-lg-10 ">
                            {{ $rigreps->RISKREP_DETAILRISK }}

                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>การจัดการเบื้องต้น :</label>
                        </div>
                        <div class="col-lg-10 ">
                            {{ $rigreps->RISKREP_BASICMANAGE }}
                        </div>
                    </div>

                    <hr>
                    <div class="row push">
                        <div class="col-sm-2 text-right">
                            <p style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">
                                <b>หัวหน้าหน่วยงานตรวจสอบ :</b></p>
                        </div>
                        <div class="col-lg-10 ">
                            <p style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">
                                <b>{{ $rigreps->LEADER_PERSON_NAME }}</b></p>
                        </div>
                    </div>

            
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>วันที่เกิดอุบัติการณ์ความเสี่ยง:</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ formate($rigreps->RISKREP_STARTDATE) }}
                        </div>
                        <div class="col-sm-2">
                            <label>วันที่ค้นพบ:</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ formate($rigreps->RISKREP_DIGDATE) }}
                        </div>
                        <div class="col-sm-2">
                            <label>ชนิดสถานที่:</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_LOCATION_CODE }} : {{ $rigreps->RISK_LOCATION_NAME }}
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ช่วงเวลา(เวร):</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->WORKING_TIME_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>หรือเวลา:</label>
                        </div>
                        <div class="col-lg-6 ">
                            {{ formatetime($rigreps->RISKREP_TIME) }}
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ลักษณะอุบัติการณ์ :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_REPPROGRAM_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>รายละเอียดย่อย 1 :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_REPTYPERESON_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>รายละเอียดย่อย 2 :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_REPTYPERESONSYS_NAME }}
                        </div>

                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>สาเหตุที่ชัดแจ้ง :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_REPTYPERESON_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>สาเหตุเชิงระบบ:</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->RISK_REPTYPERESONSYS_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>ระดับความรุนแรง :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{-- {{ $rigreps->RISK_REP_LEVEL_NAME }} --}}
                            @if ($rigreps->RISKREP_LEVEL == 1)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelA.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 2)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelB.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 3)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelC.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 4)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelD.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 5)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelE.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 6)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelF.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 7)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelG.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 8)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelH.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 9)
                            <img class="media-object rounded-circle" src="{{ asset('image/levelI.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 10)
                            <img class="media-object rounded-circle" src="{{ asset('image/level1.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 11)
                            <img class="media-object rounded-circle" src="{{ asset('image/level2.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 12)
                            <img class="media-object rounded-circle" src="{{ asset('image/level3.png') }}" alt="Avatar"  width="40" height="40">
                            @elseif ($rigreps->RISKREP_LEVEL == 13)
                            <img class="media-object rounded-circle" src="{{ asset('image/level4.png') }}" alt="Avatar"  width="40" height="40">
                            @else
                            <img class="media-object rounded-circle" src="{{ asset('image/level5.png') }}" alt="Avatar"  width="40" height="40">
                            @endif

                        </div>

                    </div>


                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ข้อเสนอแนะ/รายละเอียดเพิ่มเติม :</label>
                        </div>
                        <div class="col-lg-10 ">
                            {{ $rigreps->RISK_REP_FEEDBACK }}
                        </div>
                    </div>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>ผู้ได้รับผลกระทบ :</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->INCEDENCE_USEREFFECT_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>เพศ:</label>
                        </div>
                        <div class="col-lg-2 ">
                            {{ $rigreps->SEX_NAME }}

                        </div>
                        <div class="col-sm-2">
                            <label>อายุ :</label>
                        </div>
                        <div class="col-lg-1 ">
                            {{ $rigreps->RISKREP_AGE }}

                        </div>
                        <div class="col-sm-0.5">
                            <label>ปี :</label>
                        </div>

                    </div>

                    <hr>
                    <div class="row push">
                        <div class="col-sm-2 text-right">
                            <p style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">
                                <b>กรรมการบริหารความเสี่ยง :</b></p>
                        </div>
                        <div class="col-lg-10 ">
                            <p style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">
                                {{-- <b>{{ $rigreps->LEADER_PERSON_NAME }}</b></p> --}}
                        </div>
                    </div>
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>เป็นอุบัติการณ์ความเสี่ยงในเรื่องใด :</label>
                        </div>
                        <div class="col-lg-10 ">                         
                            {{ $rigreps->RISK_REPITEMS_CODE }} :: {{ $rigreps->RISK_REPITEMS_NAME }}
                        </div>                   
                    </div>
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>อุบัติการณ์ย่อย :</label>
                        </div>
                        <div class="col-lg-10 ">                         
                            {{ $rigreps->RISK_REPITEMSSUB_CODE }} :: {{ $rigreps->RISK_REPITEMSSUB_NAME }}
                        </div>                   
                    </div>
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>เป็นการแก้ไขปัญหาระดับ :</label>
                        </div>
                        <div class="col-lg-4 ">                         
                            {{ $rigreps->RISKREP_TYPEDEPART_NAME }}
                        </div>  
                        <div class="col-sm-2">
                            <label>วันที่แจ้งเหตุให้ผู้แก้ไขทราบ :</label>
                        </div>
                        <div class="col-lg-4 ">                         
                            {{ formate($rigreps->RISKREP_DATENOTIFY) }}
                        </div>                  
                    </div>
                    <div class="row push">
                        <div class="col-sm-2">
                            <label>กลุ่ม/หน่วยงานหลักที่แก้ไขปัญหา :</label>
                        </div>
                        <div class="col-lg-4 ">  
                                                           
                            @if ($rigreps->RISKREP_TYPEDEP == 1)
                                   {{ $rigreps->RISKREP_TYPEDEP_NAME }}

                            @elseif ($rigreps->RISKREP_TYPEDEP == 2)

                                  {{ $rigreps->RISKREP_TYPESUB_NAME }}

                            @elseif ($rigreps->RISKREP_TYPEDEP == 3)

                                   {{ $rigreps->RISKREP_TYPESUBSUB_NAME }}
                            @else
                                
                                   {{ $rigreps->HR_TEAM_NAME }} :{{ $rigreps->HR_TEAM_DETAIL }}

                            @endif                       
                            
                        </div>  
                        <div class="col-sm-2">
                            <label>วันที่ Login บันทึกการยืนยัน :</label>
                        </div>
                        <div class="col-lg-4 ">                         
                            {{ formate($rigreps->RISKREP_DATECONFIRM) }}
                        </div>                  
                    </div>

                    <div class="modal-footer">
                        <div align="right">
                          
                            <a href="{{ url('manager_risk/detail') }}" class="btn btn-hero-sm btn-hero-danger"><i
                                    class="fas fa-window-close mr-2"></i>Close</a>
                        </div>

                    </div>

                @endsection

                @section('footer')

                    <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
                    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
                    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8">
                    </script>

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

                    <!-- Page ckeditor -->
                    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

                    <script>
                        CKEDITOR.replace('myeditor', {});

                    </script>
                    <script>
                        CKEDITOR.replace('myeditor2', {});

                    </script>

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


                                    //alert("Hello! I am an alert box!!");
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

                    </script>

                @endsection
