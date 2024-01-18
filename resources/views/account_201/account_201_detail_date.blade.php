@extends('layouts.accountpk')
@section('title', 'PK-BACKOFFice || ACCOUNT')
@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('index') }}';
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
    $datenow = date('Y-m-d');
    $ynow = date('Y') + 543;
    $yb = date('Y') + 542;
    ?>
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

<div class="tabs-animation">
    <div class="row text-center">
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div> 
    </div> 
    <div id="preloader">
        <div id="status">
            <div class="spinner"> 
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Detail</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Detail</a></li>
                            <li class="breadcrumb-item active">1102050101.201</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- container-fluid -->

        {{-- <div class="row">
            <div class="col-md-4">
                <h5 class="card-title">Detail 1102050101.201</h5>
                <p class="card-title-desc">รายละเอียดข้อมูล ผัง 1102050101.201</p>
            </div>
            <div class="col"></div>
        </div>  --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card cardacc">
                   
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center" width="5%">vn</th>
                                        <th class="text-center">an</th>
                                        <th class="text-center" >hn</th>
                                        <th class="text-center" >cid</th>
                                        <th class="text-center">ptname</th>
                                        <th class="text-center">Adjrw</th> 
                                        <th class="text-center">Adjrw*8350</th>
                                        <th class="text-center">vstdate</th>
                                        <th class="text-center">dchdate</th>
                                        <th class="text-center">pttype</th>
                                        {{-- <th class="text-center">สปสช</th> --}}
                                        {{-- <th class="text-center">income</th> --}}
                                        <th class="text-center">ลูกหนี้</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 0; ?>
                                    @foreach ($data as $item)
                                        <?php $number++; ?>
                                        <tr height="20">
                                            <td class="text-font" style="text-align: center;" width="5%">{{ $number }}</td>
                                            <td class="text-center" width="10%">{{ $item->vn }}</td>
                                                    <td class="text-center" width="10%">{{ $item->an }}</td>
                                                    <td class="text-center" width="5%">
                                                    
                                                        <button type="button" class="btn btn-icon btn-shadow btn-dashed btn-outline-primary" data-bs-toggle="modal" data-bs-target="#DetailModal{{ $item->an }}" data-bs-placement="right" title="ค่าใช้จ่าย"> {{ $item->hn }}</button>
                                                    </td>
                                                    <td class="text-center" width="10%">{{ $item->cid }}</td>
                                                    <td class="p-2" >{{ $item->ptname }}</td>
                                                    <td class="text-center" width="7%">{{ $item->adjrw }}</td>
                                                    <td class="text-center" width="7%">{{ $item->total_adjrw_income }}</td>
                                                    <td class="text-center" width="7%">{{ $item->vstdate }}</td>
                                                    <td class="text-center" width="7%">{{ $item->dchdate }}</td>
                                                    <td class="text-center" style="color:rgb(73, 147, 231)" width="5%">{{ $item->pttype }}</td>
                                                    {{-- <td class="text-center" style="color:rgb(14, 108, 196)" width="5%">{{ $item->subinscl }}</td> --}}
                                                    {{-- <td class="text-center" style="color:rgb(216, 95, 14)" width="5%">{{ $item->income_group }}</td> --}}
                                                    <td class="text-end" width="10%">
                                                    
                                                            {{ number_format($item->debit_total,2)}} 
                        
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

    <!--  Modal content Updte -->
    <div class="modal fade" id="updteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invenModalLabel">ตัด STM พรบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="editacc_1102050102_602_id" type="hidden" class="form-control form-control-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">vn</label>
                            <div class="form-group">
                                <input id="editvn" type="text" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">hn</label>
                            <div class="form-group">
                                <input id="edithn" type="text" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">cid</label>
                            <div class="form-group">
                                <input id="editcid" type="text" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">ptname</label>
                            <div class="form-group">
                                <input id="editptname" type="text" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="" style="color: red">รับแจ้ง</label>
                            <div class="form-group">
                                <input id="req_no" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" style="color: red">เคลม</label>
                            <div class="form-group">
                                <input id="claim_no" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">บริษัทประกันภัย</label>
                            <div class="form-group">
                                <input id="vendor" type="text" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="" style="color: red">เลขที่ใบเสร็จรับเงิน</label>
                            <div class="form-group">
                                <input id="money_billno" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">ประเภทการจ่าย</label>
                            <div class="form-group">
                                <input id="paytype" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- <label for="">ผู้ประสบภัย</label>
                            <div class="form-group">
                                <input id="ptname" type="text" class="form-control form-control-sm" >
                            </div> --}}
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="">ครั้งที่</label>
                            <div class="form-group">
                                <input id="no" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" style="color: red">จำนวนเงิน</label>
                            <div class="form-group">
                                <input id="payprice" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" style="color: red">วันที่จ่าย</label>
                            <div class="form-group">
                                <input id="paydate" type="date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" style="color: red">วันที่บันทึก</label>
                            <div class="form-group">
                                <input id="savedate" type="date" class="form-control form-control-sm"
                                    value="{{ $datenow }}">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-end">
                        <div class="form-group">
                            <button type="button" id="updateBtn" class="btn btn-primary btn-sm">
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



@endsection
@section('footer')

    <script>
        $(document).ready(function() {

            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#example').DataTable();
            $('#hospcode').select2({
                placeholder: "--เลือก--",
                allowClear: true
            });

            $('#editwarehouse_inven_userid').select2({
                dropdownParent: $('#updteModal')
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.PulldataAll').click(function() {  
                var months = $('#months').val();
                var year = $('#year').val();
                // alert(months);
                Swal.fire({
                        title: 'ต้องการซิ้งค์ข้อมูลใช่ไหม ?',
                        text: "You Sync Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Sync it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#overlay").fadeIn(300);　
                                $("#spinner").show();  
                                
                                $.ajax({
                                    url: "{{ url('account_602_syncall') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    data: {months,year},
                                    success: function(data) {
                                        if (data.status == 200) { 
                                            Swal.fire({
                                                title: 'ซิ้งค์ข้อมูลสำเร็จ',
                                                text: "You Sync data success",
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
                                                    $('#spinner').hide();//Request is complete so hide spinner
                                                        setTimeout(function(){
                                                            $("#overlay").fadeOut(300);
                                                        },500);
                                                }
                                            })

                                        } else if (data.status == 100) { 
                                            Swal.fire({
                                                title: 'ยังไม่ได้ลงเลขที่หนังสือ',
                                                text: "Please enter the number of the book.",
                                                icon: 'warning',
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
                                
                            }
                })
            });

            $('#updateBtn').click(function() {
                var acc_1102050102_602_id = $('#editacc_1102050102_602_id').val();
                var cid = $('#editcid').val();
                var ptname = $('#editptname').val();
                var req_no = $('#req_no').val();
                var claim_no = $('#claim_no').val();
                var vendor = $('#vendor').val();
                var money_billno = $('#money_billno').val();
                var paytype = $('#paytype').val();
                var no = $('#no').val();
                var payprice = $('#payprice').val();
                var paydate = $('#paydate').val();
                var savedate = $('#savedate').val();
                $.ajax({
                    url: "{{ route('acc.account_602_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        acc_1102050102_602_id,
                        cid,
                        ptname,
                        req_no,
                        claim_no,
                        vendor,
                        money_billno,
                        paytype,
                        no,
                        payprice,
                        paydate,
                        savedate
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'ตัด STM สำเร็จ',
                                text: "You Update STM success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(data);
                                    window.location.reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });

            $(document).on('click', '.edit_data', function() {
                var acc_1102050102_602_id = $(this).val();
                // alert(acc_1102050102_602_id);
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('account_602_edit') }}" + '/' + acc_1102050102_602_id,
                    success: function(data) {
                        $('#editvn').val(data.acc602.vn)
                        $('#edithn').val(data.acc602.hn)
                        $('#editcid').val(data.acc602.cid)
                        $('#editptname').val(data.acc602.ptname)
                        $('#editacc_1102050102_602_id').val(data.acc602.acc_1102050102_602_id)

                        $('#no').val(data.acc602.no)
                        $('#req_no').val(data.acc602.req_no)
                        $('#vendor').val(data.acc602.vendor)
                        $('#money_billno').val(data.acc602.money_billno)
                        $('#paytype').val(data.acc602.paytype)
                        $('#payprice').val(data.acc602.payprice)
                        $('#paydate').val(data.acc602.paydate)
                        // $('#savedate').val(data.acc602.savedate)
                    },
                });
            });

        });
    </script>
@endsection
