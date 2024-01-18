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

    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
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
<?php

    use App\Http\Controllers\RiskController;
    $checkrisknotify = RiskController::checkrisknotify($iduser);
    $countrisknotify = RiskController::countrisknotify($iduser);
    $check = RiskController::checkpermischeckinfo($iduser);
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
                            <a href="{{ url('general_risk/dashboard_risk/' . $iduser) }}" class="btn "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_report4/'.$iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                                ปค.4
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_report5/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                                ปค.5
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify_account_detail/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('general_risk/risk_notify/' . $iduser) }}" class="btn btn-hero-sm btn-hero "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
                        </div>
                        <div>&nbsp;</div>
                        @if($check == 1)
                        <div>
                            <a href="{{ url('general_risk/risk_notify_checkinfo/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ตรวจสอบ
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        @endif
                        <div>
                            <a href="{{ url('general_risk/risk_notify_deal/' . $iduser) }}"
                                class="btn btn-hero-sm btn-hero "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
                            <span class="badge badge-light"></span>
                            </a>
                        </div>
                        <div>&nbsp;&nbsp;</div>
                
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content mx-1 ml-3" >
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title foo15 text-center" style="font-family: 'Kanit', sans-serif;">
                <B>แก้ไขข้อมูลทบทวนความเสี่ยง</B></h3>
        </div>
        <div class="block-content block-content-full">
            <form action="{{route('gen_risk.risk_notify_checkinfo_recheck_update')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="iduser" value="{{$iduser}}">
                <input type="hidden" name="RISK_RECHECK_RISKID" value="{{$riskrecheck->RISK_RECHECK_RISKID}}">
                <input type="hidden" name="RISK_RECHECK_ID" value="{{$riskrecheck->RISK_RECHECK_ID}}">
                <div class="row">
                    <div class="col-md-7" style="text-align: center">
                        <input class="fs-13" type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/>
                        <span style="text-align: right;background-color: #E6E6FA;"><span id="zoom-percent">90</span>%</span>
                        <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
                        <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
                        <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search"></i></a>
                        <br>
                        <br>
                        <div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages">
                        @if($riskrecheck->RISK_RECHECK_FILE == '' || $riskrecheck->RISK_RECHECK_FILE == null)
                            ไม่มีข้อมูลไฟล์อัปโหลด 
                        @else 
                        <iframe src="{{ asset('storage/riskpdf/'.$riskrecheck->RISK_RECHECKE_NAME) }}" height="100%" width="100%"></iframe>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
                                <h5 class="fw-b" style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
                            </div>
                            <div class="col">
                                วันที่แก้ไข {{date('d/m/'.(date('Y')+543).' H:i:s')}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">วันที่ทบทวน</p>
                            </div>
                            <div class="col-md-9">
                                <input name="RISK_RECHECK_DATE" id="RISK_RECHECK_DATE"
                                    class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;"
                                    required readonly value="<?=toDatePicker($riskrecheck->RISK_RECHECK_DATE)?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">หัวข้อทบทวน</p>
                            </div>
                            <div class="col-md-9">
                                <input name="RISK_RECHECK_HEAD" id="RISK_RECHECK_HEAD" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;" value="{{$riskrecheck->RISK_RECHECK_HEAD}}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">รายละเอียด</p>
                            </div>
                            <div class="col-md-9">
                                <textarea name="RISK_RECHECK_DETAIL" id="RISK_RECHECK_DETAIL" rows="3" cols="50"
                                    class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;" required>{{$riskrecheck->RISK_RECHECK_DETAIL}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">สรุปการทบทวน</p>
                            </div>
                            <div class="col-md-9">
                                <textarea name="RISK_RECHECK_TOTAL" id="RISK_RECHECK_TOTAL" rows="3" cols="50"
                                    class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;" required>{{$riskrecheck->RISK_RECHECK_TOTAL}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">ผู้บันทึก</p>
                            </div>
                            <div class="col-md-9" style="text-align: left">
                                <select name="RISK_RECHECK_PERSON" id="RISK_RECHECK_PERSON"
                                    class="form-control input-lg js-example-basic-single org_re"
                                    style=" font-family: 'Kanit', sans-serif;" required>
                                    <option value="" selected>--กรุณาเลือกผู้บันทึก--</option>
                                    @foreach ($person as $row)
                                    @if($riskrecheck->RISK_RECHECK_PERSON == $row->ID)
                                    <option value="{{$row->ID}}" selected>{{ $row->HR_FNAME}} {{ $row->HR_LNAME}}
                                    </option>
                                    @else
                                    <option value="{{$row->ID}}">{{ $row->HR_FNAME}} {{ $row->HR_LNAME}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">แนบไฟล์เพิ่ม</p>
                            </div>
                            <div class="col-md-9">
                                <input style="font-family: 'Kanit', sans-serif;" type="file" name="fileupload"
                                    id="fileupload" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info"
                            style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึกข้อมูล</button>
                        <a href="{{route('gen_risk.risk_notify_checkinfo_recheck',[$riskrecheck->RISK_RECHECK_RISKID,$iduser])}}"
                            class="btn btn-hero-sm btn-hero-danger"
                            style="font-family: 'Kanit', sans-serif;font-weight:normal;"
                            onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')">ยกเลิก</a>
                    </div>
                </div>
            </form>
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
    jQuery(function () {
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
<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        })
    });
</script>
<script>
    //---------------------------------------------------------------------------------
    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "{{ asset('pdfupload/pdf_upwork.js') }}";

    document.querySelector("#pdfupload").addEventListener("change", function (e) {
        document.querySelector("#pages").innerHTML = "";

        var file = e.target.files[0]
        if (file.type != "application/pdf") {
            alert(file.name + " is not a pdf file.")
            return
        }

        var fileReader = new FileReader();

        fileReader.onload = function () {
            var typedarray = new Uint8Array(this.result);

            pdfjsLib.getDocument(typedarray).promise.then(function (pdf) {
                // you can now use *pdf* here
                console.log("the pdf has", pdf.numPages, "page(s).");
                for (var i = 0; i < pdf.numPages; i++) {
                    (function (pageNum) {
                        pdf.getPage(i + 1).then(function (page) {
                            // you can now use *page* here
                            var viewport = page.getViewport(2.0);
                            var pageNumDiv = document.createElement("div");
                            pageNumDiv.className = "pageNumber";
                            pageNumDiv.innerHTML = "Page " + pageNum;
                            var canvas = document.createElement("canvas");
                            canvas.className = "page";
                            canvas.title = "Page " + pageNum;
                            document.querySelector("#pages").appendChild(
                                pageNumDiv);
                            document.querySelector("#pages").appendChild(
                                canvas);
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            page.render({
                                canvasContext: canvas.getContext('2d'),
                                viewport: viewport
                            }).promise.then(function () {
                                console.log('Page rendered');
                            });
                            page.getTextContent().then(function (text) {
                                console.log(text);
                            });
                        });
                    })(i + 1);
                }

            });
        };

        fileReader.readAsArrayBuffer(file);
    });

    var curWidth = 90;

    function zoomIn() {
        if (curWidth < 150) {
            curWidth += 10;
            document.querySelector("#zoom-percent").innerHTML = curWidth;
            document.querySelectorAll(".page").forEach(function (page) {

                page.style.width = curWidth + "%";
            });
        }
    }

    function zoomOut() {
        if (curWidth > 20) {
            curWidth -= 10;
            document.querySelector("#zoom-percent").innerHTML = curWidth;
            document.querySelectorAll(".page").forEach(function (page) {

                page.style.width = curWidth + "%";
            });
        }
    }

    function zoomReset() {

        curWidth = 90;
        document.querySelector("#zoom-percent").innerHTML = curWidth;

        document.querySelectorAll(".page").forEach(function (page) {
            page.style.width = curWidth + "%";
        });
    }
    document.querySelector("#zoom-in").onclick = zoomIn;
    document.querySelector("#zoom-out").onclick = zoomOut;
    document.querySelector("#zoom-reset").onclick = zoomReset;
    window.onkeypress = function (e) {
        if (e.code == "Equal") {
            zoomIn();
        }
        if (e.code == "Minus") {
            zoomOut();
        }
    };

    //===============================เพิ่มหน่วยงาน====================================
    function addorg() {

        var record_org = document.getElementById("ADD_RECORD_ORG").value;

        //alert(record_location);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('mbook.addorg')}}",
            method: "GET",
            data: {
                record_org: record_org,
                _token: _token
            },
            success: function (result) {
                $('.org_re').html(result);
            }
        })

    }

    //====================================================================

    function checkmax() {

        var year = document.getElementById("BOOK_YEAR_ID").value;

        //alert(record_location);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('mbook.checkmax')}}",
            method: "GET",
            data: {
                year: year,
                _token: _token
            },
            success: function (result) {
                $('.max_re').html(result);
            }
        })

    }
</script>
@endsection