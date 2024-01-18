@extends('layouts.book')
@section('title', 'PK-BACKOFFice || งานสารบรรณ')
 
@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('index') }}';
        }

        function bookmake_sendretire(bookrep_id) {
            // alert(bookrep_id);
            Swal.fire({
                title: 'ต้องการเสนอหัวหน้าบริหารใช่ไหม?',
                text: "ข้อมูลนี้จะถูกส่งไปยังหัวหน้าบริหารเพื่อทำการเกษียณหนังสือ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ',
                cancelButtonText: 'ไม่'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('book/bookmake_sendretire') }}" + '/' + bookrep_id,
                        success: function(response) {
                            Swal.fire({
                                title: 'ส่งหนังสือสำเร็จ!',
                                text: "You Send data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    window.location.reload();
                                    // window.location = "/book/bookmake_index"; //   

                                }
                            })
                        }
                    })
                }
            })
        }

        function bookmake_sendpo(bookrep_id) {
            // alert(bookrep_id);
            Swal.fire({
                title: 'ต้องการเสนอผู้อำนวยการใช่ไหม?',
                text: "ข้อมูลนี้จะถูกส่งไปยังผู้อำนวยการเพื่อทำการอนุมติหนังสือ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ',
                cancelButtonText: 'ไม่'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('book/bookmake_sendpo') }}" + '/' + bookrep_id,
                        success: function(response) {
                            Swal.fire({
                                title: 'ส่งหนังสือสำเร็จ!',
                                text: "You Send data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    window.location.reload();
                                    // window.location = "/book/bookmake_index"; //   

                                }
                            })
                        }
                    })
                }
            })
        }

        function bookdepsub_destroy(senddepsub_id) {
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
                        url: "{{ url('book/bookmake_senddepsub_destroy') }}" + '/' + senddepsub_id,
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
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#sid" + senddepsub_id).remove();
                                    window.location.reload();
                                    // window.location = "/book/bookmake_index"; //     
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
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
    use App\Http\Controllers\BookController;
    $refnumber = BookController::refnumber();
    ?>
 <style>
    body {
        font-size: 14px;
    }

    .btn {
        font-size: 15px;
    }

    .xl {
        font-size: 15px;
    }

    .bgc {
        background-color: #264886;
    }

    .bga {
        background-color: #FCFF9A;
    }
 

    .boxpdf {
        /* height: 1150px; */
        height: auto;
    }

    .page {
        width: 90%;
        margin: 5px;
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

    .fpdf {
        width: auto;
        height: 800px;
        /* height:auto; */
        margin: 0;

        overflow: scroll;
        background-color: #FFFFFF;
    }

    @media (min-width: 950px) {
        .modal {
            --bs-modal-width: 950px;
        }
    }

    @media (min-width: 1500px) {
        .modal-xls {
            --bs-modal-width: 1500px;
        }
    }

    @media (min-width: 1500px) {
        .container-fluids {
            width: 1500px;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right
        }

        .dataTables_wrapper .dataTables_length {
            float: left
        }

        .dataTables_info {
            float: left;
        }

        .dataTables_paginate {
            float: right
        }

        .custom-tooltip {
            --bs-tooltip-bg: var(--bs-primary);
        }

        .table thead tr th {
            font-size: 14px;
        }

        .table tbody tr td {
            font-size: 13px;
        }

        .menu {
            font-size: 13px;
        }
    }

    .hrow {
        height: 2px;
        margin-bottom: 9px;
    }
</style>
 
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row invoice-card-row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header ">
                        <div class="d-flex">
                            <div class="p-2" style="font-size: 14px">{{ __('ส่งหนังสือ') }} </div>

                            <div class="ms-auto p-2">
                                @if ($bookcount == 0)
                                    <button type="button" class="btn btn-outline-primary btn-sm me-2"
                                        data-bs-toggle="modal" data-bs-target="#saexampleModal">
                                        <i class="fa-solid fa-paper-plane me-2"></i>
                                        ความคิดเห็น
                                    </button>
                                @endif

                                @if ($adcount == 0)
                                    <button type="button" class="btn btn-outline-primary btn-sm me-2"
                                        data-bs-toggle="modal" data-bs-target="#poModal">
                                        <i class="fa-solid fa-paper-plane me-2"></i>
                                        เสนอผู้อำนวยการ
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body shadow">
                        <!-- Pills navs -->
                        <ul class="nav nav-pills" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send/' . $dataedits->bookrep_id) }}">
                                    <i class="fa-solid fa-book me-1 text-white"></i>
                                    <label
                                        class="xl">รายละเอียด</label> </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1"  style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_deb/' . $dataedits->bookrep_id) }}"> 
                               <i class="fa-solid fa-address-book me-1 text-warning"></i>
                                    <label
                                        class="xl " >กลุ่มภารกิจ</label>  </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active shadow btn-sm me-1" 
                                    href="{{ url('book/bookmake_index_send_debsub/' . $dataedits->bookrep_id) }}"> 
                                    <i class="fa-solid fa-address-book me-1 text-info"></i>
                                    <label
                                        class="xl">กลุ่มงาน</label>&nbsp;</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_debsubsub/' . $dataedits->bookrep_id) }}"> 
                                    <i class="fa-solid fa-address-book me-1 text-info"></i>
                                    <label
                                        class="xl">หน่วยงาน</label>&nbsp;</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_person/' . $dataedits->bookrep_id) }}">
                                    <i class="fa-solid fa-address-book me-1 text-success"></i>
                                    <label
                                        class="xl">บุคคลากร</label> </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_team/' . $dataedits->bookrep_id) }}">
                                    <i class="fa-solid fa-address-book me-1 text-primary"></i>
                                    <label
                                        class="xl">ทีมนำองค์กร</label> </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_fileplus/' . $dataedits->bookrep_id) }}"> 
                                    <i class="fa-solid fa-swatchbook me-1 text-secondary"></i>
                                    <label
                                        class="xl">ไฟล์แนบ</label>  </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_open/' . $dataedits->bookrep_id) }}"> 
                                <i class="fa-solid fa-book-open me-1 text-info"></i>
                                    <label
                                        class="xl">การเปิดอ่าน</label>  </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                 <a class="nav-link btn-sm me-1" style="background-color: rgb(231, 227, 227)"
                                    href="{{ url('book/bookmake_index_send_file/' . $dataedits->bookrep_id) }}"> 
                                  <i class="fa-solid fa-swatchbook me-1 text-danger"></i>
                                    <label
                                        class="xl">ไฟล์ที่ส่ง</label>&nbsp;  </a>
                            </li>
                        </ul>
                        <!-- Pills navs -->
                        <!-- Pills content -->
                    <div class="tab-content" id="ex1-content">
                        <!-- ************ ส่งฝ่าย/แผนก ********************** -->
                        <div class="tab-pane fade show active" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                            {{-- <form action="{{ route('book.bookmake_index_senddepsub') }}" id="Save_senddepsub"
                                method="POST">
                                @csrf --}}
                                <div class="row text-center">
                                    <div class="col"></div>
                                    <input type="hidden" name="bookrep_id" id="bookrep_id"
                                        value=" {{ $dataedits->bookrep_id }}">
                                    <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                                    <div class="col-md-4 mt-5 mb-3">
                                        <div class="form-group">
                                            <select id="DEPARTMENT_SUB_ID" name="DEPARTMENT_SUB_ID" class="form-control"
                                                style="width: 100%" >
                                                <option value=""></option>
                                                @foreach ($department_sub as $depart_sub)
                                                    <option value="{{ $depart_sub->DEPARTMENT_SUB_ID }}">
                                                        {{ $depart_sub->DEPARTMENT_SUB_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5 mb-3">
                                        <div class="form-group">
                                            <select id="book_objective2" name="book_objective2" class="form-control"
                                                style="width: 100%" >
                                                <option value=""></option>
                                                @foreach ($book_objective as $book)
                                                    <option value="{{ $book->objective_id }}">{{ $book->objective_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-5 mb-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm" id="saveBtn">
                                                <i class="fa-solid fa-paper-plane me-2"></i>
                                                ส่ง
                                            </button>

                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            {{-- </form> --}}

                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-sm myTable"
                                            style="width: 100%;" id="example2">
                                            <thead>
                                                <tr height="10px">
                                                    <th width="5%" class="text-center">ลำดับ</th>
                                                    <th class="text-center">ชื่อฝ่าย/แผนก</th>
                                                    <th class="text-center">วัตถุประสงค์</th>
                                                    <th width="10%" class="text-center">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num = 1;
                                                $date = date('Y'); ?>
                                                @foreach ($book_senddep_sub as $item3)
                                                    <tr id="sid{{ $item3->senddepsub_id }}">
                                                        <td class="text-center" width="5%">{{ $num++ }}</td>
                                                        <td class="p-2">{{ $item3->senddep_depsub_name }}</td>
                                                        <td class="p-2">{{ $item3->objective_name }}</td>
                                                        <td class="text-center" width="10%">

                                                            <a class="text-danger" href="javascript:void(0)"
                                                                onclick="bookdepsub_destroy({{ $item3->senddepsub_id }})"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                data-bs-custom-class="custom-tooltip" title="ลบ">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>
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
                    <!-- Pills content -->
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="saexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">บันทึกความคิดเห็น หนังสือเลขที่
                    {{ $dataedits->bookrep_repbooknum }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action="{{ route('book.comment1_save') }}" method="POST"
                    id="comment1_saveForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="bookrep_id" id="bookrep_id" class="form-control"
                        value="{{ $dataedits->bookrep_id }}">

                    <div class="row">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ชื่อเรื่อง </label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="pcustomer_code">{{ $dataedits->bookrep_name }} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ผู้บันทึก </label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="pcustomer_code">{{ $dataedits->bookrep_usersend_name }} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ความเห็นที่ 1</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea name="bookrep_comment1" id="bookrep_comment1" rows="3" class="form-control"></textarea>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    บันทึกความคิดเห็น</button>
                <a href="javascript:void(0)" onclick="bookmake_sendretire({{ $dataedits->bookrep_id }})"
                    class="btn btn-primary btn-sm text-white">
                    <i class="fa-solid fa-user-tie me-2"></i>
                    เสนอหัวหน้าบริหาร</a>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="poModal" tabindex="-1" aria-labelledby="poModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="poModalLabel">บันทึกความคิดเห็น หนังสือเลขที่
                    {{ $dataedits->bookrep_repbooknum }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action="{{ route('book.comment1_save') }}" method="POST"
                    id="comment1po_saveForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="bookrep_id" id="bookrep_id" class="form-control"
                        value="{{ $dataedits->bookrep_id }}">

                    <div class="row">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ชื่อเรื่อง </label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="pcustomer_code">{{ $dataedits->bookrep_name }} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ผู้บันทึก </label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="pcustomer_code">{{ $dataedits->bookrep_usersend_name }} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="pcustomer_code">ความเห็นที่ 1</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea name="bookrep_comment1" id="bookrep_comment1" rows="3" class="form-control"></textarea>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    บันทึกความคิดเห็น</button>
                <a href="javascript:void(0)" onclick="bookmake_sendpo({{ $dataedits->bookrep_id }})"
                    class="btn btn-success btn-sm text-white">
                    <i class="fa-solid fa-user-tie me-2"></i>
                    เสนอผู้อำนวยการ</a>

            </div>
            </form>
        </div>
    </div>
</div>
 
@endsection
@section('footer')
<script>
    $(document).ready(function() {

        $('#saveBtn').click(function() {
                // alert('okkkkk');
                var DEPARTMENT_SUB_ID = $('#DEPARTMENT_SUB_ID').val(); // 
                var book_objective2 = $('#book_objective2').val(); // 
                var bookrep_id = $('#bookrep_id').val(); //  
                var user_id = $('#user_id').val(); // 

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('book.bookmake_index_senddepsub') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        DEPARTMENT_SUB_ID,
                        book_objective2,
                        bookrep_id,
                        user_id
                    },
                    success: function(data) {
                        if (data.status == 0) {

                            Swal.fire({
                                title: 'ฝ่าย/แผนกนี้เคยส่งแล้ว!',
                                text: "You Send data ever",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'Back '
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }else if(data.status == 10){
                            Swal.fire({
                                title: 'กรุณาเลือกฝ่าย/แผนก !!',
                                text: "You data empty",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'Back '
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // window.location.reload();
                                }
                            })                      

                        } else {
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
                                    window.location.reload();
                                }
                            })
                        }
                    },
                });
            });
 
            // $('#Save_senddepsub').on('submit', async function(e) {
            //     e.preventDefault();
            //     var form = $('#Save_senddepsub');
            //     //  console.log(form.serialize()) 
            //     await $.ajax({
            //         url: form.attr('action'),
            //         method: form.attr('method'),
            //         data: form.serialize(),
            //         dataType: 'json',
            //         success: function(data) {
            //             console.log(data)
            //             if (data.status == 200) {
            //                 Swal.fire({
            //                     title: 'บันทึกข้อมูลสำเร็จ',
            //                     text: "You Insert data success",
            //                     icon: 'success',
            //                     showCancelButton: false,
            //                     confirmButtonColor: '#06D177',
            //                     confirmButtonText: 'เรียบร้อย'
            //                 }).then((result) => {
            //                     if (result.isConfirmed) {
            //                         window.location.reload();
            //                     }
            //                 })
            //             } else {

            //                 // Swal.fire({
            //                 //     title: 'ฝ่าย/แผนกนี้เคยส่งแล้ว!',
            //                 //     text: "You Send data ever",
            //                 //     icon: 'warning',
            //                 //     showCancelButton: true,
            //                 //     confirmButtonColor: '#d33',
            //                 //     confirmButtonText: 'Back '
            //                 // }).then((result) => {
            //                 //     if (result.isConfirmed) {
            //                 //         window.location.reload();
            //                 //     }
            //                 // })

            //             }
            //         }
            //     });
            // });
    });
</script>

@endsection
