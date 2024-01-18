@extends('layouts.risk')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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
        <div class="block mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">

                    <div align="left">
                        <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">
                            <B>เพิ่มข้อมูลบัญชีความเสี่ยง</B>
                        </h2>
                    </div>

                </div>
                <div class="block-content block-content-full">
                    <form method="post" action="{{ route('mrisk.risk_account_save') }}" enctype="multipart/form-data">
                        @csrf

                        <input value="" type="hidden" name="RISKREP_ID" id="RISKREP_ID" class="form-control input-lg">

                        <div class="row push text-left">
                            <div class="col-sm-2 fo14">
                                <label for="RISKREP_NO ">Risk Account no. :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input type="text" name="RISKREP_NO" id="RISKREP_NO" class="form-control input-sm fo13"
                                    value="" >
                            </div>

                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่บันทึก:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input name="RISKREP_DATESAVE" id="RISKREP_DATESAVE"
                                    class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy" value=""
                                    readonly>

                            </div>
                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;"> ผู้รายงาน
                                    :</label>
                            </div>
                            <div class="col-lg-4 ">
                                <select name="RISKREP_SEARCHLOCATE" id="RISKREP_SEARCHLOCATE"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>


                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISKREP_DEPARTMENT_SUB"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ขั้นตอนการทำงาน/หน่วยงาน :</label>
                            </div>
                            <div class="col-lg-4 ">

                                <select name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>

                                </select>
                            </div>
                           
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">หน่วยงานที่รายงาน :</label>
                            </div>
                            <div class="col-lg-4 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISKREP_DEPARTMENT_SUB"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">วัตถุประสงค์ :</label>
                            </div>
                            <div class="col-lg-4 ">

                                <select name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>

                                </select>
                            </div>
                           
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ความเสี่ยง :</label>
                            </div>
                            <div class="col-lg-4 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                        </div>
                        <div class="row push text-left">  
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดความเสี่ยง :</label>
                            </div>
                            <div class="col-lg-9 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ปัจจัยเสี่ยง :</label>
                            </div>
                            <div class="col-lg-9 ">
                                <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK"
                                    class="form-control input-lg time fo13" rows="2" required> </textarea>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดความสูญเสีย / ผลกระทบที่อาจเกิดขึ้น :</label>
                            </div>
                            <div class="col-lg-9 ">
                                <textarea name="RISKREP_BASICMANAGE" id="RISKREP_BASICMANAGE"
                                    class="form-control input-lg time"
                                    style=" font-family:'Kanit', sans-serif;font-size:13px;" rows="2" required>  </textarea>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISKREP_DEPARTMENT_SUB"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">โอกาสที่จะเกิดขึ้น :</label>
                            </div>
                            <div class="col-lg-2 ">

                                <select name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>

                                </select>
                            </div>
                           
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ผลกระทบ / ความรุนแรง :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                            <div class="col-sm-1">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ระดับความเสี่ยง:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                        </div>

                        <div class="row push text-left">                                                    
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ลำดับความเสี่ยง:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">วิธีจัดการความเสี่ยง:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียด/แนวทางการจัดการความเสี่ยง :</label>
                            </div>
                            <div class="col-lg-9 ">
                                <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK"
                                    class="form-control input-lg time fo13" rows="2" required> </textarea>
                            </div>
                        </div>

                        <div class="row push text-left">                                                    
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">การควบคุม:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ผลการควบคุม:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                </select>

                            </div>
                            <div class="col-sm-1">
                                <label for="RISKREP_USEREFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ค่าใช้จ่าย:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control text-right" placeholder="00.00">

                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">กำหนดเสร็จ / ผู้รับผิดชอบ :</label>
                            </div>
                            <div class="col-lg-9 ">
                                <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK"
                                    class="form-control input-lg time fo13" rows="2" required> </textarea>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <div align="right">
                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                <a href="" class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i
                                        class="fas fa-window-close mr-2"></i>Close</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>



    @endsection

    @section('footer')


        <script src="{{ asset('select2/select2.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
        <script>
            jQuery(function() {
                Dashmix.helpers(['masked-inputs']);
            });

        </script>

        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

        </script>


        <script>
            function run01() {
                var count = $('.tbody1').children('tr').length;
                //alert(count);
                var number;
                for (number = 0; number < count; number++) {
                    checkunitref(number);
                    checksummoney(number);
                }

            }

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
            $('.program').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fectprogram') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.programsub').html(result);
                        }
                    })
                }
            });

            $('.programsub').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fectprogramsub') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.programsubsub').html(result);
                        }
                    })
                }
            });
            $('.fectteam').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fectteam') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.teamdetial').html(result);
                        }
                    })
                }
            });
            $('.typelocation').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fecttypelocation') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.typelocationdetail').html(result);
                        }
                    })
                }
            });
            $('.items').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fectitems') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.itemsub').html(result);
                        }
                    })
                }
            });
            $('.depsub').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('mrisk.fectriskdepsub') }}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function(result) {
                            $('.team').html(result);
                        }
                    })

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

            function datepicker(number) {

                $('.datepicker' + number).datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: true,
                    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                    thaiyear: true,
                    autoclose: true //Set เป็นปี พ.ศ.
                }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
            }

        </script>

    @endsection
