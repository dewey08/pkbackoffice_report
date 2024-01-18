@extends('layouts.medicalslide')
@section('title', 'PK-BACKOFFice || เครื่องมือแพทย์')
@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('index') }}';
        }

        function med_borrowupdate_status(medical_borrow_id) {
            Swal.fire({
                title: 'ต้องการจัดสรรให้ยืมใช่ไหม?',
                text: "จัดสรรให้ยืมได้ !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, จัดสรรเดี๋ยวนี้ !',
                cancelButtonText: 'ไม่, ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('medical/med_borrowupdate_status') }}" + '/' + medical_borrow_id,
                        type: 'POST',
                        data: {
                            _token: $("input[name=_token]").val()
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'จัดสรรสำเร็จ!',
                                text: "You Update data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#sid" + medical_borrow_id).remove();
                                    window.location.reload();
                                }
                            })
                        }
                    })
                }
            })
        }

        function med_borrowdestroy(medical_borrow_id) {
            Swal.fire({
                title: 'ต้องการลบใช่ไหม?',
                text: "ข้อมูลนี้จะถูกลบไปเลย !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเดี๋ยวนี้ !',
                cancelButtonText: 'ไม่, ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('med_borrowdestroy') }}" + '/' + medical_borrow_id,
                        type: 'DELETE',
                        data: {
                            _token: $("input[name=_token]").val()
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'ลบข้อมูล!',
                                text: "You Delet data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#sid" + medical_borrow_id).remove();
                                    window.location.reload();
                                    //   window.location = "/person/person_index"; //     
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
    <style>
        #button {
            display: block;
            margin: 20px auto;
            padding: 30px 30px;
            background-color: #eee;
            border: solid #ccc 1px;
            cursor: pointer;
        }

        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 250px;
            height: 250px;
            border: 10px #ddd solid;
            border-top: 10px #1fdab1 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(390deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
    <style>
        .table th {
            font-family: sans-serif;
            font-size: 12px;
        }

        .table td {
            font-family: sans-serif;
            font-size: 11px;
        }
    </style>
    <?php
    if (Auth::check()) {
        $type = Auth::user()->type;
        $iduser = Auth::user()->id;
    } else {
        echo "<body onload=\"TypeAdmin()\"></body>";
        exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $date = date('Y-m-d');
    ?>
 <div class="container-fluid">
    {{-- <div class="tabs-animation"> --}}
        <div class="row text-center">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="main-card mb-3 card">
                <div class="card-header ">
                    <form action="{{ url('medical/med_borrow_search') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-1 text-end">วันที่</div>
                            <div class="col-md-3 text-center">
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control" name="startdate" id="datepicker"
                                        data-date-container='#datepicker1' data-provide="datepicker"
                                        data-date-language="th-th" data-date-autoclose="true"
                                        value="{{ $startdate }} ">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-1 text-center">ถึง</div>
                            <div class="col-md-3 text-center">
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control" name="enddate" id="datepicker2"
                                        data-date-container='#datepicker1' data-provide="datepicker"
                                        data-date-language="th-th" data-date-autoclose="true"
                                        value="{{ $enddate }} ">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i>
                                    ค้นหา
                                </button> 
                                <button type="button"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary"
                                    data-bs-toggle="modal" data-bs-target="#insertborrowdata">
                                    <i class="fa-solid fa-file-waveform me-2"></i>
                                    ยืม-คืน
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table style="width: 100%;" id="example"
                            class="table table-hover table-striped table-bordered myTable">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center">วันที่ยืม</th>
                                    <th class="text-center">วันที่คืน</th>
                                    <th width="15%" class="text-center">รหัสครุภัณฑ์</th>
                                    <th class="text-center">รายการ</th>
                                    <th class="text-center">หน่วยงานที่ยืม</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($medical_borrow as $item)
                                    <?php
                                    
                                    $colorstatus = $item->medical_borrow_active;
                                    if ($colorstatus == 'REQUEST') {
                                        $color_new = 'background-color: rgb(181, 236, 234)';
                                    } elseif ($colorstatus == 'APPROVE') {
                                        $color_new = 'background-color: rgb(6, 206, 143)';
                                    } else {
                                        $color_new = 'background-color: rgb(107, 180, 248)';
                                    }
                                    
                                    ?>
                                    <tr id="sid{{ $item->medical_borrow_id }}">
                                        <td width="5%">{{ $i++ }}</td>
                                        <td class="text-center" width="5%">
                                            @if ($item->medical_borrow_active == 'REQUEST')
                                                <span class="badge text-bg-danger">ร้องขอ</span>
                                            @elseif ($item->medical_borrow_active == 'SENDEB')
                                                <span
                                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary">ส่งคืน</span>
                                            @elseif ($item->medical_borrow_active == 'APPROVE')
                                                <span
                                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success">จัดสรร</span>
                                            @else
                                            @endif
                                        </td>
                                        <td width="10%" class="text-center" style="font-size: 13px">
                                            {{ DateThai($item->medical_borrow_date) }}</td>
                                        <td width="10%" class="text-center" style="font-size: 13px">
                                            {{ DateThai($item->medical_borrow_backdate) }}</td>
                                        <td width="20%" class="p-2" style="font-size: 13px">
                                            {{ $item->article_num }}
                                        </td>
                                        <td class="p-2" style="font-size: 13px;">{{ $item->article_name }}</td>
                                        <td class="p-2" style="font-size: 13px;">
                                            {{ $item->DEPARTMENT_SUB_SUB_NAME }}
                                        </td>
                                        <td class="text-center" width="7%">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle menu btn-sm"
                                                    type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">ทำรายการ</button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item menu btn btn-outline-warning btn-sm"
                                                        href="{{ url('medical/med_borroweditpage/' . $item->medical_borrow_id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="แก้ไข">
                                                        <i class="fa-solid fa-file-pen me-2"
                                                            style="color: rgb(252, 153, 23)"></i>
                                                        <label for=""
                                                            style="color: rgb(252, 153, 23)">แก้ไข</label>
                                                    </a>
                                                    {{-- <button type="button"
                                                            class="dropdown-item menu btn btn-outline-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".editborrowdata{{ $item->medical_borrow_id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left" title="แก้ไข">
                                                            <i class="fa-solid fa-file-pen me-2"
                                                                style="color: rgb(252, 153, 23)"></i>
                                                            <label for=""
                                                                style="color: rgb(252, 153, 23)">แก้ไข</label>
                                                        </button> --}}
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <button type="button"
                                                        class="dropdown-item menu btn btn-outline-warning btn-sm editData2"
                                                        value="{{ $item->medical_borrow_id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="รายละเอียด">
                                                        <i class="fa-solid fa-file-pen me-2"
                                                            style="color: rgb(135, 19, 202)"></i>
                                                        <label for=""
                                                            style="color: rgb(135, 19, 202)">รายละเอียด</label>
                                                    </button>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <a class="dropdown-item menu btn btn-outline-success btn-sm"
                                                        href="javascript:void(0)"
                                                        onclick="med_borrowupdate_status({{ $item->medical_borrow_id }})"
                                                        data-bs-toggle="tooltip" data-bs-toggle="custom-tooltip"
                                                        data-bs-placement="left" title="จัดสรร">
                                                        <i class="fa-solid fa-file-pen text-success me-2"></i>
                                                        <label for=""
                                                            style="color: rgb(3, 94, 212)">จัดสรร</label>
                                                    </a>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <button type="button"
                                                        class="dropdown-item menu btn btn-outline-primary btn-sm sendData"
                                                        value="{{ $item->medical_borrow_id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="ส่งคืน">
                                                        <i class="fa-solid fa-file-pen text-primary me-2"></i>
                                                        <label for=""
                                                            style="color: rgb(3, 94, 212)">ส่งคืน</label>
                                                    </button>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <a class="dropdown-item menu btn btn-outline-success btn-sm"
                                                        href="javascript:void(0)"
                                                        onclick="med_borrowdestroy({{ $item->medical_borrow_id }})"
                                                        data-bs-toggle="tooltip" data-bs-toggle="custom-tooltip"
                                                        data-bs-placement="left" title="ลบ">
                                                        <i class="fa-solid fa-trash-can text-danger me-2"></i>
                                                        <label for=""
                                                            style="color: rgb(212, 10, 3)">ลบ</label>
                                                    </a>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        
    </div>


        <!--  Modal content for the insertborrowdata example -->
        <div class="modal fade" id="insertborrowdata" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">บันทึกทะเบียนยืม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-2">
                                <label for="">วันที่ยืม</label>
                                <div class="form-group mt-2">
                                    <input type="date" name="medical_borrow_date" id="medical_borrow_date"
                                        class="form-control form-control-sm" value="{{ $date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">รายการ</label>
                                <div class="form-group mt-2">
                                    <select name="medical_borrow_article_id" id="medical_borrow_article_id"
                                        class="form-control form-control-sm" style="width: 100%" required>
                                        <option value="">=เลือก=</option>
                                        @foreach ($article_data as $ar)
                                            <option value="{{ $ar->article_id }}">{{ $ar->article_num }}
                                                {{ $ar->article_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="">จำนวน</label>
                                <div class="form-group mt-2">
                                    <input type="number" name="medical_borrow_qty" id="medical_borrow_qty"
                                        class="form-control form-control-sm text-end">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">หน่วยงานที่ยืม</label>
                                <div class="form-group mt-2">
                                    <select name="medical_borrow_debsubsub_id" id="medical_borrow_debsubsub_id"
                                        class="form-control form-control-sm" style="width: 100%" required>
                                        <option value="">=เลือก=</option>
                                        @foreach ($department_sub_sub as $deb)
                                            <option value="{{ $deb->DEPARTMENT_SUB_SUB_ID }}">
                                                {{ $deb->DEPARTMENT_SUB_SUB_NAME }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" id="medical_borrow_users_id" name="medical_borrow_users_id"
                        value="{{ $iduser }}">
                    <div class="modal-footer">
                        <div class="col-md-12 text-end">
                            <div class="form-group">
                                <button type="button" id="Savebtn"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    บันทึกข้อมูล
                                </button>
                                <button type="button"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-danger"
                                    data-bs-dismiss="modal"><i class="fa-solid fa-xmark me-2"></i>Close</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--  Modal content for the updateborrowdata example -->
        <div class="modal fade" id="updateborrowdata" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">ส่งคืน
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="">วันที่ยืม :</label>
                                <div class="form-group mt-2">
                                    <input type="date" name="medical_borrow_date" id="editmedical_borrow_date"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">วันที่ส่งคืน</label>
                                <div class="form-group mt-2">
                                    <input type="date" name="medical_borrow_backdate" id="editmedical_borrow_backdate"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="">ผู้ส่งคืน</label>
                                <div class="form-group mt-2">
                                    <select name="medical_borrow_backusers_id" id="editmedical_borrow_backusers_id"
                                        class="form-control form-control-sm" style="width: 100%" required>
                                        <option value="">=เลือก=</option>
                                        @foreach ($users as $ut)
                                            <option value="{{ $ut->id }}">
                                                {{ $ut->fname }} {{ $ut->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" id="medical_borrow_users_id" name="editmedical_borrow_users_id"
                        value="{{ $iduser }}">

                    <input type="hidden" id="editmedical_borrow_id" name="medical_borrow_id">


                    <div class="modal-footer">
                        <div class="col-md-12 text-end">
                            <div class="form-group">
                                <button type="button" id="Updatebtn"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    บันทึกข้อมูล
                                </button>
                                <button type="button"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-danger"
                                    data-bs-dismiss="modal"><i class="fa-solid fa-xmark me-2"></i>Close</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--  Modal content for the detailborrowdata example -->
        <div class="modal fade" id="detailborrowdata" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">รายละเอียดทะเบียนยืม-คืน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">วันที่ยืม</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_date" id="detailmedical_borrow_date"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">รายการ</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_article_id"
                                        id="detailmedical_borrow_article_id" class="form-control form-control-sm"
                                        readonly>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="">จำนวน</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_qty" id="detailmedical_borrow_qty"
                                        class="form-control form-control-sm text-end" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">หน่วยงานที่ยืม</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_debsubsub_id"
                                        id="detailmedical_borrow_debsubsub_id" class="form-control form-control-sm"
                                        readonly>

                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="">วันที่คืน</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_backdate"
                                        id="detailmedical_borrow_backdate" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">ผู้ส่งคืน</label>
                                <div class="form-group mt-2">
                                    <input type="text" name="medical_borrow_backusers_id"
                                        id="detailmedical_borrow_backusers_id" class="form-control form-control-sm"
                                        readonly>

                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" id="medical_borrow_users_id" name="detailmedical_borrow_users_id"
                        value="{{ $iduser }}">
                    <div class="modal-footer">
                        <div class="col-md-12 text-end">
                            <div class="form-group">

                                <button type="button"
                                    class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-danger"
                                    data-bs-dismiss="modal"><i class="fa-solid fa-xmark me-2"></i>Close</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    @endsection
    @section('footer')
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example2').DataTable();
                // $('.js-example-basic-single').select2();

                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('#datepicker2').datepicker({
                    format: 'yyyy-mm-dd'
                });

                // datepicker(number);
                $('.js-example-basic-single').select2();

                $('#edit_medical_borrow_article_id').select2({
                    dropdownParent: $('#editborrowdata')
                });
                $('#edit_medical_borrow_debsubsub_id').select2({
                    dropdownParent: $('#editborrowdata')
                });

                $('#medical_borrow_article_id').select2({
                    dropdownParent: $('#insertborrowdata')
                });

                $('#medical_borrow_debsubsub_id').select2({
                    dropdownParent: $('#insertborrowdata')
                });

                $('#editmedical_borrow_backusers_id').select2({
                    dropdownParent: $('#updateborrowdata')
                });

                $('#Savebtn').click(function() {
                    var medical_borrow_date = $('#medical_borrow_date').val();
                    var medical_borrow_article_id = $('#medical_borrow_article_id').val();
                    var medical_borrow_qty = $('#medical_borrow_qty').val();
                    var medical_borrow_debsubsub_id = $('#medical_borrow_debsubsub_id').val();
                    var medical_borrow_users_id = $('#medical_borrow_users_id').val();
                    $.ajax({
                        url: "{{ route('med.med_borrowsave') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            medical_borrow_date,
                            medical_borrow_article_id,
                            medical_borrow_qty,
                            medical_borrow_debsubsub_id,
                            medical_borrow_users_id
                        },
                        success: function(data) {
                            if (data.status == 200) {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result
                                        .isConfirmed) {
                                        console.log(
                                            data);
                                        window.location.reload();
                                    }
                                })
                            } else {

                            }

                        },
                    });
                });

                $(document).on('click', '.editData2', function() {
                    var medical_borrow_id = $(this).val();
                    // alert(medical_borrow_id);
                    $('#detailborrowdata').modal('show');
                    $.ajax({
                        type: "GET",
                        url: "{{ url('medical/med_borrowedit') }}" + '/' + medical_borrow_id,
                        success: function(data) {
                            $('#detailmedical_borrow_date').val(data.borrow.medical_borrow_date)
                            $('#detailmedical_borrow_backdate').val(data.borrow
                                .medical_borrow_backdate)
                            $('#detailmedical_borrow_backusers_id').val(data.borrow.fname)
                            $('#detailmedical_borrow_id').val(data.borrow.medical_borrow_id)
                            $('#detailmedical_borrow_article_id').val(data.borrow.article_name)
                            $('#detailmedical_borrow_qty').val(data.borrow.medical_borrow_qty)
                            $('#detailmedical_borrow_debsubsub_id').val(data.borrow
                                .DEPARTMENT_SUB_SUB_NAME)
                        },
                    });
                });


            });
        </script>
        <script>
            $(document).on('click', '.sendData', function() {
                var medical_borrow_id = $(this).val();
                $('#updateborrowdata').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('medical/med_borrowedit2') }}" + '/' + medical_borrow_id,
                    success: function(res) {
                        $('#editmedical_borrow_date').val(res.borrow.medical_borrow_date)
                        $('#editmedical_borrow_backdate').val(res.borrow
                            .medical_borrow_backdate)
                        $('#editmedical_borrow_backusers_id').val(res.borrow
                            .medical_borrow_backusers_id)
                        $('#editmedical_borrow_id').val(res.borrow.medical_borrow_id)
                    },
                });
            });
            $('#Updatebtn').click(function() {
                var medical_borrow_date = $('#editmedical_borrow_date').val();
                var medical_borrow_backdate = $('#editmedical_borrow_backdate').val();
                var medical_borrow_backusers_id = $('#editmedical_borrow_backusers_id').val();
                var medical_borrow_id = $('#editmedical_borrow_id').val();
                // alert(medical_borrow_date);
                $.ajax({
                    url: "{{ route('med.med_borrowupdate') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        medical_borrow_date,
                        medical_borrow_backdate,
                        medical_borrow_backusers_id,
                        medical_borrow_id
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'บันทึกข้อมูลสำเร็จ',
                                text: "You Insert data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);
                                    window.location.reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });
        </script>
        <script>
            $('#UpdateDatabtn').click(function() {
                var medical_borrow_date = $('#edit_medical_borrow_date').val();
                var medical_borrow_article_id = $('#edit_medical_borrow_article_id').val();
                var medical_borrow_qty = $('#edit_medical_borrow_qty').val();
                var medical_borrow_debsubsub_id = $('#edit_medical_borrow_debsubsub_id').val();
                var medical_borrow_id = $('#edit_medical_borrow_id').val();
                // alert(medical_borrow_date);
                $.ajax({
                    url: "{{ route('med.med_borrowDataupdate') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        medical_borrow_date,
                        medical_borrow_article_id,
                        medical_borrow_qty,
                        medical_borrow_debsubsub_id,
                        medical_borrow_id
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'แก้ไขข้อมูลสำเร็จ',
                                text: "You Edit data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);
                                    $("#sid" + medical_borrow_id).remove();
                                    window.location.reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });
        </script>

    @endsection
