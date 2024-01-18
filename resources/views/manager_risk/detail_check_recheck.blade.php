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
            padding-top: 5px;
            padding-bottom: 5px;
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
                        <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายละเอียดการทบทวน</h2>
                    </div>
                    <div align="right">
                        <a  href="{{ url('manager_risk/detail_check_recheck_add/'.$riskid)}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"   ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                        <a class="btn btn-hero-sm btn-hero-success" href="{{ route('mrisk.detail') }}"
                            style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i
                                class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                    </div>
                </div>
                <div class="block-content block-content-full " align="left">
                 

                    <table class="gwt-table table-striped table-vcenter" width="100%">
                        <thead style="background-color: #FFEBCD;">
                        
                         <tr height="40">
                        
                           
                              <th class="text-font"  style="border-color:#000000; text-align: center;">ครั้งที่</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">วันที่ทบทวน</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">ไฟล์เอกสาร</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">หัวข้อการทบทวน</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">รายละเอียด</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">วันที่บันทึก</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;">ผู้บันทึก</th>
                              <th class="text-font"  style="border-color:#000000; text-align: center;" width="8%">คำสั่ง</th>
              
              
                          </tr>
                  
                         </thead>
                         <tbody>
                            <?php $number = 0; ?>
                            @foreach ($inforechecks as $inforecheck)
                            <?php $number++;  ?>
                            <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{DateThai($inforecheck->RISK_RECHECK_DATE)}}</td>
                                        @if($inforecheck->RISK_RECHECK_FILE == 'True')
                                                <td class="text-font text-pedding" align="center" ><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>      
                                        @else
                                        <td  align="center" ></td>
                                        @endif
                                <td class="text-font text-pedding" >{{$inforecheck->RISK_RECHECK_HEAD}}</td>
                                <td class="text-font text-pedding" >{{$inforecheck->RISK_RECHECK_DETAIL}}</td>
                                <td class="text-font text-pedding" >{{DateThai($inforecheck->RISK_RECHECK_DATE_SAVE)}}</td>
                                <td class="text-font text-pedding" >{{$inforecheck->HR_FNAME}} {{$inforecheck->HR_LNAME}}</td>
                                <td class="text-font text-pedding" >


                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="{{ url('manager_risk/detail_check_recheck_edit/'.$riskid.'/'.$inforecheck->RISK_RECHECK_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดแก้ไข</a>
                                   
                                                </div>
                                        </div>


                                </td>

                            </tr>
                            @endforeach  
                         </tbody>
                        </table>


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
