@extends('layouts.asset')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
<script>
function checklogin() {
    window.location.href = '{{route("index")}}';
}
</script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 



?>


<style>
body {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;

}

.text-pedding {
    padding-left: 10px;
}

.text-font {
    font-size: 14px;
}




#pages {
    text-align: center;
}

.page {
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}

@keyframes pageIn {
    0% {
        transform: translateX(-300px);
        opacity: 0;
    }

    100% {
        transform: translateX(0px);
        opacity: 1;
    }
}

#zoom-in {}

#zoom-percent {
    display: inline-block;
}

#zoom-percent::after {
    content: "%";
}

#zoom-out {}

.form-control {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;
}
</style>

<center>



    <!-- Dynamic Table Simple -->
    <div class="block" style="width: 95%;">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูล อาคาร/สิ่งปลูกสร้าง</B>
            </h3>

        </div>
        <form method="post" id="form_edit" action="{{ route('massete.updateassetinfobuilding') }}" enctype="multipart/form-data"
            class="needs-validation" novalidate>
            @csrf

            <input type="hidden" name="ID" id="ID" class="form-control input-sm"
                style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetbuilding->ID}}">

            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-7" style="text-align: center">


                        <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf"
                            style="width:75%;" />

                        <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>

                        <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
                        <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
                        <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search"></i></a>

                        <br>
                        <br>
                        <div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages">

                            @if($infoassetbuilding->FILE_NAME == '' || $infoassetbuilding->FILE_NAME == null)
                            <p style="color:#F0FFFF">ไม่มีข้อมูลไฟล์อัปโหลด </p>
                            @else
                            <?php list($a,$b,$c,$d) = explode('/',$url); ?>
                        

                                
                                <iframe src="{{ asset('storage/assetpdf/'.$infoassetbuilding->FILE_NAME ) }}" height="100%" width="100%"></iframe>

                            @endif
                        </div>

                    </div>


                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
                                <h5 style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
                            </div>
                            <div class="col">
                                วันที่บันทึก
                                 {{-- {{$datenow}} --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                  

                                       
                                        @if ( $infoassetbuilding->IMG == Null )
                                        <img id="image_upload_preview" src="{{asset('image/buil.jpg')}}" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="80%"/>
                                @else
                               
                                <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoassetbuilding->IMG)) }}"
                                id="image_upload_preview" height="300px" width="80%" />
                               
                               
                                @endif



                                </div>
                                <div class="form-group">
                                    <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture"
                                        id="picture" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">ปลูกบนที่ดิน</p>
                            </div>
                            <div class="col-md-9">
                                <select name="LAND_ID" id="LAND_ID"
                                    class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                    <option value="">--กรุณาเลือกเลขระวาง--</option>
                                    @foreach ($assetlands as $assetland)
                                    @if($assetland -> ID == $infoassetbuilding->LAND_ID)
                                    <option value=" {{ $assetland -> ID }}" selected>{{ $assetland -> LAND_RAWANG }}
                                    </option>
                                    @else
                                    <option value=" {{ $assetland -> ID }}">{{ $assetland -> LAND_RAWANG }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">อัตราเสื่อม</p>
                            </div>
                            <div class="col-md-9">
                                <select name="DECLINE_ID" id="DECLINE_ID"
                                    class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($suppliesdeclines as $suppliesdecline)
                                    @if($suppliesdecline -> DECLINE_ID == $infoassetbuilding->DECLINE_ID)
                                    <option value=" {{ $suppliesdecline -> DECLINE_ID }}" selected>
                                        {{ $suppliesdecline -> DECLINE_NAME }}</option>
                                    @else
                                    <option value=" {{ $suppliesdecline -> DECLINE_ID }}">
                                        {{ $suppliesdecline -> DECLINE_NAME }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">ชื่อสิ่งปลูกสร้าง</p>
                            </div>
                            <div class="col-md-9">
                                <input name="BUILD_NAME" id="BUILD_NAME" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;"
                                    value="{{$infoassetbuilding->BUILD_NAME}}">
                            </div>

                        </div>



                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">งบประมาณ</p>
                            </div>
                            <div class="col-md-9">

                                <select name="BUDGET_ID" id="BUDGET_ID"
                                    class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                    <option value="">--เลือกงบประมาณ--</option>
                                    @foreach ($suppliesbudgets as $suppliesbudget)
                                    @if($suppliesbudget ->BUDGET_ID == $infoassetbuilding->BUDGET_ID)
                                    <option value="{{ $suppliesbudget ->BUDGET_ID  }}" selected>
                                        {{ $suppliesbudget->BUDGET_NAME}}</option>
                                    @else
                                    <option value="{{ $suppliesbudget ->BUDGET_ID  }}">{{ $suppliesbudget->BUDGET_NAME}}
                                    </option>
                                    @endif

                                    @endforeach
                                </select>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">วิธีได้มา</p>
                            </div>
                            <div class="col-md-9">

                                <select name="METHOD_ID" id="METHOD_ID"
                                    class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                    <option value="">--เลือกวิธีได้มา--</option>
                                    @foreach ($methods as $method)
                                    @if($method ->METHOD_ID == $infoassetbuilding->METHOD_ID)
                                    <option value="{{ $method->METHOD_ID  }}" selected>{{ $method->METHOD_NAME}}
                                    </option>
                                    @else
                                    <option value="{{ $method->METHOD_ID  }}">{{ $method->METHOD_NAME}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">วิธีการซื้อ</p>
                            </div>
                            <div class="col-md-9">

                                <select name="BUY_ID" id="BUY_ID" class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                    <option value="">--เลือกวิธีการซื้อ--</option>
                                    @foreach ($buys as $buy)
                                    @if($buy->BUY_ID == $infoassetbuilding->BUY_ID)
                                    <option value="{{ $buy->BUY_ID  }}" selected>{{ $buy->BUY_NAME}}</option>
                                    @else
                                    <option value="{{ $buy->BUY_ID  }}">{{ $buy->BUY_NAME}}</option>
                                    @endif
                                    @endforeach
                                </select>


                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">ใช้งบประมาณ</p>
                            </div>
                            <div class="col-md-7">
                                <input name="BUILD_NGUD_MONEY" id="BUILD_NGUD_MONEY" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)"
                                    value="{{$infoassetbuilding->BUILD_NGUD_MONEY}}">


                            </div>
                            <div class="col-md-2">
                                บาท
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">จำนวน</p>
                            </div>
                            <div class="col-md-3">
                                <input name="TOTAL" id="TOTAL" class="form-control input-s"
                                    style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" value="{{$infoassetbuilding->TOTAL}}">
                            </div>
                            <div class="col">
                                <p style="text-align: left">อายุการใช้งาน</p>
                            </div>
                            <div class="col-md-3">
                                <input name="OLD_USE" id="OLD_USE" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" value="{{$infoassetbuilding->OLD_USE}}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">วันที่สร้าง</p>
                            </div>
                            <div class="col-md-3">
                                <input name="BUILD_CREATE" id="BUILD_CREATE" class="form-control input-lg datepicker"
                                    style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"
                                    value="{{formate($infoassetbuilding->BUILD_CREATE)}}" readonly>
                            </div>
                            <div class="col">
                                <p style="text-align: left">วันที่แล้วเสร็จ</p>
                            </div>
                            <div class="col-md-3">
                                <input name="BUILD_FINISH" id="BUILD_FINISH" class="form-control input-lg datepicker"
                                    style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"
                                    value="{{formate($infoassetbuilding->BUILD_FINISH)}}" readonly>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p style="text-align: left">วันที่ส่งมอบ</p>
                            </div>
                            <div class="col-md-3">
                                <input name="TRANSFER_DATE" id="TRANSFER_DATE" class="form-control input-lg datepicker"
                                    style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"
                                    value="{{formate($infoassetbuilding->TRANSFER_DATE)}}" readonly>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">ผู้รับผิดชอบ</p>
                            </div>
                            <div class="col-md-9">

                                <select name="BUILD_HR_ID" id="BUILD_HR_ID"
                                    class="form-control input-lg js-example-basic-single"
                                    style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                    <option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>
                                    @foreach ($persons as $person)
                                    @if($person -> ID == $infoassetbuilding->BUILD_HR_ID)
                                    <option value=" {{ $person -> ID }}" selected>{{ $person -> HR_FNAME }}
                                        {{ $person -> HR_LNAME }}</option>
                                    @else
                                    <option value=" {{ $person -> ID }}">{{ $person -> HR_FNAME }}
                                        {{ $person -> HR_LNAME }}</option>
                                    @endif

                                    @endforeach
                                </select>


                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">เบอร์ติดต่อ</p>
                            </div>
                            <div class="col-md-9">
                                <input name="BUILD_HR_TEL" id="BUILD_HR_TEL" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;"
                                    value="{{$infoassetbuilding->BUILD_HR_TEL}}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">วิศวกร</p>
                            </div>
                            <div class="col-md-9">
                                <input name="ENGINEER_NAME" id="ENGINEER_NAME" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;"
                                    value="{{$infoassetbuilding->ENGINEER_NAME}}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <p style="text-align: left">หมายเหตุ</p>
                            </div>
                            <div class="col-md-9">
                                <input name="COMMENT" id="COMMENT" class="form-control input-sm"
                                    style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetbuilding->COMMENT}}">
                            </div>

                        </div>


                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info"
                            ><i class="fas fa-save"></i>&nbsp;บันทึกแก้ไขข้อมูล</button>
                        <a href="{{ url('manager_asset/assetinfobuilding')  }}" class="btn btn-hero-sm btn-hero-danger"
                            onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')"
                            ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>
                    </div>

        </form>




        @endsection

        @section('footer')
        <script src="{{ asset('select2/select2.min.js') }}"></script>
        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

        <script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

        <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
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
        </script>

        <script>
        $('.provice').change(function() {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.fetch')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        $('.amphures').html(result);
                    }
                })
                // console.log(select);
            }
        });

        $('.amphures').change(function() {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.fetchsub')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        $('.tumbon').html(result);
                    }
                })
                // console.log(select);
            }
        });
        </script>


        <script>
        //---------------------------------------------------------------------------------
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "{{ asset('pdfupload/pdf_upwork.js') }}";

        document.querySelector("#pdfupload").addEventListener("change", function(e) {
            document.querySelector("#pages").innerHTML = "";

            var file = e.target.files[0]
            if (file.type != "application/pdf") {
                alert(file.name + " is not a pdf file.")
                return
            }

            var fileReader = new FileReader();

            fileReader.onload = function() {
                var typedarray = new Uint8Array(this.result);

                pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                    // you can now use *pdf* here
                    console.log("the pdf has", pdf.numPages, "page(s).");
                    for (var i = 0; i < pdf.numPages; i++) {
                        (function(pageNum) {
                            pdf.getPage(i + 1).then(function(page) {
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
                                document.querySelector("#pages").appendChild(canvas);
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;


                                page.render({
                                    canvasContext: canvas.getContext('2d'),
                                    viewport: viewport
                                }).promise.then(function() {
                                    console.log('Page rendered');
                                });
                                page.getTextContent().then(function(text) {
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
                document.querySelectorAll(".page").forEach(function(page) {

                    page.style.width = curWidth + "%";
                });
            }
        }

        function zoomOut() {
            if (curWidth > 20) {
                curWidth -= 10;
                document.querySelector("#zoom-percent").innerHTML = curWidth;
                document.querySelectorAll(".page").forEach(function(page) {

                    page.style.width = curWidth + "%";
                });
            }
        }

        function zoomReset() {

            curWidth = 90;
            document.querySelector("#zoom-percent").innerHTML = curWidth;

            document.querySelectorAll(".page").forEach(function(page) {
                page.style.width = curWidth + "%";
            });
        }
        document.querySelector("#zoom-in").onclick = zoomIn;
        document.querySelector("#zoom-out").onclick = zoomOut;
        document.querySelector("#zoom-reset").onclick = zoomReset;
        window.onkeypress = function(e) {
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
                success: function(result) {
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
                success: function(result) {
                    $('.max_re').html(result);
                }
            })

        }

        //======================================================================



        function readURL(input) {
            var fileInput = document.getElementById('picture');
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var numb = input.files[0].size / 1024;

            if (numb > 64) {
                alert('กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 64KB');
                fileInput.value = '';
                return false;
            }

            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            } else {

                alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                fileInput.value = '';
                return false;

            }




        }


        $("#picture").change(function() {
            readURL(this);
        });


        function checkcancel() {

            var r = confirm("ต้องการยกเลิกการเพิ่มข้อมูล");
            if (r == true) {
                window.location.href = "{{ url('person/personinfouserofficial')}}"
            } else {
                return false;
            }
        }

        function chkmunny(ele) {
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
            ele.onKeyPress = vchar;
        }
        //=====================================================================

        $('body').on('keydown', 'input, select, textarea', function(e) {
            var self = $(this),
                form = self.parents('form:eq(0)'),
                focusable, next;
            if (e.keyCode == 13) {
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit();
                }
                return false;
            }
        });


        $('.btn-submit-edit').click(function (e) { 

            var form = $('#form_edit');
            formSubmit(form)
                
            });

            function chkNumber(ele){
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar<'0' || vchar>'9')) return false;
            ele.onKeyPress=vchar;
            }

            function chkmunny(ele){
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
            ele.onKeyPress=vchar;
            }
        </script>
        @endsection