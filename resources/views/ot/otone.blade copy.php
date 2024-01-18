@extends('layouts.pkclaim')
@section('title', 'PK-BACKOFFice || OT Report')
@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('index') }}';
        }

        function otone_destroy(ot_one_id) {
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
                        url: "{{ url('otone_destroy') }}" + '/' + ot_one_id,
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
                                    $("#sid" + ot_one_id).remove();
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
    ?>
    <div class="container-fluid">
        {{-- <form action="{{url('export') }}" method="POST" enctype="multipart/form-data">
            @csrf --}}
        <div class="row">
            <div class="col-xl-12">
                {{-- <div class="row">                   
                    <div class="col">
                        <h5 class="mb-sm-0">รายการโอที </h5>
                    </div>
                    <div class="col-md-3 text-center"></div>
                    <div class="col-md-2 text-center"> 
                    </div>
                    <div class="col-md-1 text-center">  
                    </div>
                    <div class="col-md-4 text-center"></div>
                    <div class="col">                        
                        <a href="{{ url('otone_add') }}" class="btn btn-info btn-sm waves-effect waves-light"><i
                                class="fa-solid fa-folder-plus text-white me-2"></i>ลงโอที</a>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-xl-12">
                        <form action="{{ route('ot.otone') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-1 text-end">วันที่</div>
                                <div class="col-md-2 text-center">
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" name="startdate"
                                            id="startdate" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1'
                                            data-provide="datepicker" data-date-autoclose="true" value="{{ $start }}">
        
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">ถึงวันที่</div>
                                <div class="col-md-2 text-center">
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd" name="enddate"
                                            id="enddate" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1'
                                            data-provide="datepicker" data-date-autoclose="true" value="{{ $end }}">
        
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-gla
                                    ss me-2"></i>
                                        ค้นหา
                                    </button>
                                </div>
                                <div class="col"></div> 
                                <div class="col-md-2">                        
                                    <a href="{{ url('otone_add') }}" class="btn btn-info waves-effect waves-light" target="_blank"><i
                                            class="fa-solid fa-folder-plus text-white me-2"></i>ลงโอที</a>
                                            <button type="button"class="btn add_color" style="background-color: blueviolet" data-bs-toggle="tooltip" data-bs-placement="left" title="เลือกสี">
                                                <i class="fa-solid fa-folder-plus text-white me-2" style="font-size:13px"></i>
                                                <span style="color:rgb(253, 253, 253)">เลือกสี</span> 
                                            </button>
                                </div>
                                {{-- <div class="col-md-1">
                                   
                                </div> --}}
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </form>
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body py-0 px-2 mt-2">
                        <div class="table-responsive">
                            {{-- <table class="table table-hover table-bordered table-sm myTable" style="width: 100%;"
                                id="example"> --}}
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th width="5%" class="text-center">ลำดับ</th> --}}
                                        <th class="text-center" width="10%">วันที่</th>
                                        <th class="text-center" width="15%">ชื่อ-สกุล</th>
                                        <th class="text-center" width="10%">รายมือชื่อ</th>
                                        <th class="text-center" width="10%">เวลามา</th>
                                        <th class="text-center" width="10%">รายมือชื่อ</th>
                                        <th class="text-center" width="10%">เวลากลับ</th>
                                       
                                        <th class="text-center" width="10%">ขั่วโมง</th>
                                        <th class="p-2">หน้าที่ที่ปฏิบัติ</th>
                                        <th class="p-2">หน่วยงาน</th>
                                        <th class="text-center" width="7%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($ot_one as $item)
                                    <?php 
                                    $start = strtotime( $item->ot_one_starttime);
                                    $end = strtotime( $item->ot_one_endtime);
                                    $tot =  ($end - $start) /3600;
                                    // $tot =  ($end - $start) / 7200;
                                    // $total = date("H:i",$tot ) ;
                                    // $total = date("His" );
                                    $date1 = date_create($item->ot_one_starttime);
                                    $date2 = date_create($item->ot_one_endtime);

                                    $diff=date_diff($date1,$date2);
                                    $totalhr = $diff->format("%R%H ชม.")

                                    // $countdateold =   round(abs(strtotime(date('Y-m-d')) - strtotime($calculater->nextdate))/60/60/24)+1; 
                                    // $datestartss = strtotime($calculater->nextdate);

                                    // $datestart = date('Y-m-d');
                                    // $strNewDate1 = date ("Y-m-d", strtotime("+1 day", strtotime($datestart)));  // มากกว่า 1 วัน
                                    // $strNewDate2 = date ("Y-m-d", strtotime("+2 day", strtotime($datestart)));  // มากกว่า 2 วัน
                                    // $strNewDate3 = date ("Y-m-d", strtotime("+3 day", strtotime($datestart)));  // มากกว่า 3 วัน
                                    // echo 'วันที่ '.$strNewDate;
                                    //   echo 'วันที่ '.$datestartss;
                                    // $datestart=strtotime(date('Y-m-d'));   
                                    // $dateend= $calculater->nextdate;
                                    
                                    // $calculate =strtotime("$dateend")-strtotime("$datestart");
                                    // $summary=floor($calculate / 86400); // 86400 มาจาก 24*360 (1วัน = 24 ชม.)
                                    // echo "$summary วัน";
                                    
                                    // $DateResultNow=date("Y-m-d H:i:s", mktime(date("H")+7, date("i")+0, date("s")+0, date("m")+0 , date("d")+0, date("Y")+0));
                                    // $totaltime = $diff->format("%R%i minutes");
                                    // date("H")+0 // ชม.
                                    // date("H")+0 // ชม.
                                    // date("i")+0 // นาที
                                    // date("s")+0 // วินาที
                                    // date("d")+0 // วัน
                                    // date("m")+0 // เดือน
                                    // date("Y")+0 // ปี 
                                    ?>
                                        <tr id="sid{{ $item->ot_one_id }}">
                                            {{-- <td class="text-center">{{ $i++ }}</td> --}}
                                            <td class="p-2">{{ $item->ot_one_date }}</td>
                                            <td class="p-2">{{ $item->ot_one_fullname }}</td>
                                            <td class="p-2">{{ $item->ot_one_sign }} </td>
                                            <td class="p-2">{{ $item->ot_one_starttime }}</td>
                                            <td class="p-2">{{ $item->ot_one_sign2 }} </td>
                                            <td class="p-2">{{ $item->ot_one_endtime }} </td>
                                         
                                            <td class="p-2">{{ $tot }} </td>
                                            <td class="p-2">{{ $item->ot_one_detail }}</td>
                                            <td class="p-2">{{ $item->DEPARTMENT_SUB_SUB_NAME }}</td>
                                            {{-- <td class="p-2">{{ $totalhr }} </td> --}}
                                           
                                            <td class="text-center" width="7%">
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-info dropdown-toggle menu btn-sm"
                                                        type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">ทำรายการ</button>
                                                    <ul class="dropdown-menu">
                                                        <button type="button"class="dropdown-item menu edit_data"
                                                            value="{{ $item->ot_one_id }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="แก้ไข">
                                                            <i class="fa-solid fa-pen-to-square ms-2 me-2 text-warning" style="font-size:13px"></i>
                                                            <span style="color:orange">แก้ไข</span>
                                                            {{-- <label for=""
                                                                style="font-size:13px;color: rgb(255, 185, 34)">แก้ไข</label> --}}
                                                        </button>

                                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                            onclick="otone_destroy({{ $item->ot_one_id }})"
                                                            style="font-size:13px">
                                                            <i class="fa-solid fa-trash-can ms-2 me-2 text-danger"
                                                                style="font-size:13px"></i>
                                                            <span>ลบ</span>
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
    </div>
    <!--  Modal content for the above example -->
    <div class="modal fade" id="add_color" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">เพิ่มสีที่ต้องการ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">สีที่ต้องการ</label>
                            <div class="form-group">
                                <input type="color" class="form-control form-control-color" id="color_ot" name="color_ot" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-md-12 text-end">
                        <div class="form-group">
                            <button type="button" id="saveBtn" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                บันทึกข้อมูล
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-xmark me-2"></i>Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal content Updte -->
    <div class="modal fade" id="updteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invenModalLabel">แก้ไขลงเวลาโอที</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <div class="row">
                        <div class="col-md-2 mt-3">
                            <label for="editot_one_detail">เหตุผล </label>
                        </div>
                        <div class="col-md-10 mt-3">
                            <div class="form-outline">
                                <input id="editot_one_detail" type="text" class="form-control input-rounded" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mt-3">
                            <label for="editot_one_date">วันที่ </label>
                        </div>
                        <div class="col-md-10 mt-3">
                            <div class="form-outline">
                                <input id="editot_one_date" type="date" class="form-control input-rounded" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 mt-3">
                            <label for="editot_one_starttime">ตั้งแต่เวลา </label>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <input id="editot_one_starttime" type="time" class="form-control input-rounded"
                                   >
                            </div>
                        </div>
                        <div class="col-md-2 mt-3">
                            <label for="ot_one_endtime">ถึงเวลา </label>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <input id="editot_one_endtime" type="time" class="form-control input-rounded" >
                            </div>
                        </div>
                    </div>

                    <input id="editot_one_id" type="hidden" class="form-control form-control-sm">
                    <input type="hidden" id="edituser_id" name="user_id" value=" {{ Auth::user()->id }}">
                </div>

                <div class="modal-footer">
                    <div class="col-md-12 text-end">
                        <div class="form-group">
                            <button type="button" id="updateBtn" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                แก้ไขข้อมูล
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-xmark me-2"></i>Close</button>

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
            $('#example3').DataTable();

            $('select').select2();
            $('#ECLAIM_STATUS').select2({
                dropdownParent: $('#detailclaim')
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#printBtn', function() {
                var month_id = $(this).val();
                alert(month_id);
                // $('#updteModal').modal('show');
                // $.ajax({
                //     type: "GET",
                //     url: "{{ url('otone_edit') }}" + '/' + ot_one_id,
                //     success: function(data) { 
                //         $('#editot_one_starttime').val(data.ot.ot_one_starttime)
                //         $('#editot_one_endtime').val(data.ot.ot_one_endtime)
                //         $('#editot_one_date').val(data.ot.ot_one_date)
                //         $('#editot_one_detail').val(data.ot.ot_one_detail)
                //         // $('#edituser_id').val(data.ot.ot_one_nameid)
                //         $('#editot_one_id').val(data.ot.ot_one_id)
                //     },
                // });
            });

            $('#saveBtn').click(function() {

                var color_ot = $('#color_ot').val();
                alert(color_ot);
                $.ajax({
                    url: "{{ route('p.plan_save') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        color_ot
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            // alert('gggggg');
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

                                    window.location
                                        .reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });
            $(document).on('click', '.add_color', function() {
                var ot_one_id = $(this).val();
                // alert(ot_one_id);
                $('#add_color').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('otone_edit') }}" + '/' + ot_one_id,
                    success: function(data) { 
                        $('#editot_one_starttime').val(data.ot.ot_one_starttime)
                        $('#editot_one_endtime').val(data.ot.ot_one_endtime)
                        $('#editot_one_date').val(data.ot.ot_one_date)
                        $('#editot_one_detail').val(data.ot.ot_one_detail)
                        // $('#edituser_id').val(data.ot.ot_one_nameid)
                        $('#editot_one_id').val(data.ot.ot_one_id)
                    },
                });
            });

            $(document).on('click', '.edit_data', function() {
                var ot_one_id = $(this).val();
                // alert(ot_one_id);
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('otone_edit') }}" + '/' + ot_one_id,
                    success: function(data) { 
                        $('#editot_one_starttime').val(data.ot.ot_one_starttime)
                        $('#editot_one_endtime').val(data.ot.ot_one_endtime)
                        $('#editot_one_date').val(data.ot.ot_one_date)
                        $('#editot_one_detail').val(data.ot.ot_one_detail)
                        // $('#edituser_id').val(data.ot.ot_one_nameid)
                        $('#editot_one_id').val(data.ot.ot_one_id)
                    },
                });
            });

            $('#updateBtn').click(function() {
                var ot_one_starttime = $('#editot_one_starttime').val();
                var ot_one_endtime = $('#editot_one_endtime').val();
                var ot_one_date = $('#editot_one_date').val();
                var ot_one_detail = $('#editot_one_detail').val();
                var user_id = $('#edituser_id').val();
                var ot_one_id = $('#editot_one_id').val();
                // alert(ot_one_id);
                $.ajax({
                    url: "{{ route('ot.otone_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        ot_one_id,
                        ot_one_detail,
                        ot_one_date,
                        ot_one_starttime,
                        ot_one_endtime,
                        user_id
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'แก้ไขข้อมูลสำเร็จ',
                                text: "You edit data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);

                                    window.location
                                        .reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });

        });
    </script>

@endsection
