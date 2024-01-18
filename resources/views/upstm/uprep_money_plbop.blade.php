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

    <div class="tabs-animation mb-5">

        <div class="row text-center">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>
        </div>

        <form action="{{ url('uprep_money_plbop') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col"></div>
                <div class="col-md-2 text-end mt-2">วันที่</div>
                <div class="col-md-4 text-end">
                    <div class="input-daterange input-group" id="datepicker1" data-date-format="dd M, yyyy"
                        data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker1'>
                        <input type="text" class="form-control" name="startdate" id="datepicker" placeholder="Start Date"
                            data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                            data-date-language="th-th" value="{{ $startdate }}" required />
                        <input type="text" class="form-control" name="enddate" placeholder="End Date" id="datepicker2"
                            data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                            data-date-language="th-th" value="{{ $enddate }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary">
                        <i class="fa-solid fa-magnifying-glass text-primary me-2"></i>
                        ค้นหาข้อมูล
                    </button>
                    <a href="{{url('uprep_money_plbhn')}}" class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info" target="_blank">
                        <i class="fa-solid fa-magnifying-glass text-info me-2"></i>
                        ค้นหา HN
                    </a>
                </div>
                <div class="col"></div>
            </div>
        </form>

        <div class="row mt-2"> 
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        รายละเอียด 1102050102.602
                        <div class="btn-actions-pane-right">
                            {{-- <button type="button"
                                class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-danger PulldataAll">
                                <i class="fa-solid fa-arrows-rotate text-danger me-2"></i>
                                Sync Data All
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;"> --}}
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th> 
                                    <th class="text-center">vn</th>
                                    <th class="text-center" >hn</th>
                                    <th class="text-center" >cid</th>
                                    <th class="text-center">ptname</th>
                                    <th class="text-center">vstdate</th> 
                                    <th class="text-center">ลูกหนี้</th>
                                    <th class="text-center">nhso_ownright_pid</th>
                                    <th class="text-center">ยอดชดเชย</th>
                                    <th class="text-center" width="5%">ส่วนต่าง</th>
                                    <th class="text-center">เลขที่ใบเสร็จรับเงิน</th>  
                                    <th class="text-center">จัดการ STM</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 0; ?>
                                @foreach ($datashow as $item)
                                    <?php $number++; ?>
                                    <tr height="20" style="font-size: 13px;">
                                        <td class="text-font" style="text-align: center;" width="4%">{{ $number }}</td>  
                                        <td class="text-center" width="10%">{{ $item->vn }}</td> 
                                        <td class="text-center" width="10%">{{ $item->hn }}</td> 
                                        <td class="text-center" width="10%">{{ $item->cid }}</td>   
                                        <td class="p-2" >{{ $item->ptname }}</td>  
                                        <td class="text-center" width="10%">{{ $item->vstdate }}</td>    
                                        <td class="text-end" style="color:rgb(73, 147, 231)" width="7%">{{ number_format($item->debit_total,2)}}</td>
                                        <td class="text-end" width="10%" style="color:rgb(226, 63, 248)">{{ number_format($item->nhso_ownright_pid,2)}}</td>
                                        <td class="text-end" width="10%" style="color:rgb(14, 216, 165)">{{ number_format($item->recieve_true,2)}}</td>
                                        {{-- <td class="text-center" width="10%">{{ number_format(($item->debit_total-$item->payprice),2)}}</td>  --}}
                                        @if ($item->difference == '0')
                                        <td class="text-center" width="10%">{{ number_format(($item->difference),2)}}</td> 
                                        @else
                                        <td class="text-center" width="10%" style="color:rgb(248, 44, 7)">{{ number_format(($item->difference),2)}}</td> 
                                        @endif
                                       
                                        <td class="text-center" width="10%">{{ $item->recieve_no }}</td> 
                                        <td class="text-center" width="5%">
                                            <div class="dropdown d-inline-block">
                                                <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="me-2 dropdown-toggle btn btn-outline-secondary btn-sm">
                                                    ทำรายการ
                                                </button>
                                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-hover-link dropdown-menu"> 
                                                    {{-- @if ($item->money_billno == '') --}}
                                                        <button type="button"class="dropdown-item menu edit_data text-success" 
                                                            value="{{ $item->acc_1102050102_602_id }}" 
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="ตัด STM"> 
                                                            <i class="fa-solid fa-clipboard-check me-2 text-success" style="font-size:13px"></i>
                                                            <span>ตัด STM</span>
                                                        </button>
                                                    {{-- @else --}}
                                                        
                                                    {{-- @endif --}}
                                                    
                                                    
                                                </div>
                                            </div>
                                        </td> 
                                    </tr>

                                    {{-- <tr height="20" style="font-size: 14px;">
                                        <td class="text-font" style="text-align: center;" width="4%">{{ $number }}
                                        </td>
                                        <td class="text-center" width="10%">{{ $item->vn }}</td>
                                        <td class="text-center" width="10%">{{ $item->hn }}</td>
                                        <td class="text-center" width="10%">{{ $item->cid }}</td>
                                        <td class="p-2">{{ $item->ptname }}</td>
                                        <td class="text-center" width="10%">{{ $item->vstdate }}</td>
                                        <td class="text-end" style="color:rgb(73, 147, 231)" width="7%">
                                            {{ number_format($item->debit_total, 2) }}</td>
                                        <td class="text-end" width="10%" style="color:rgb(216, 95, 14)">
                                            {{ number_format($item->payprice, 2) }}</td>
                                        <td class="text-center" width="10%">{{ $item->req_no }}</td>
                                        <td class="text-center" width="10%">{{ $item->money_billno }}</td>
                                        <td class="text-center" width="5%">
                                            <div class="dropdown d-inline-block">
                                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                                    data-bs-toggle="dropdown"
                                                    class="me-2 dropdown-toggle btn btn-outline-secondary btn-sm">
                                                    ทำรายการ
                                                </button>
                                                <div tabindex="-1" role="menu" aria-hidden="true"
                                                    class="dropdown-menu-hover-link dropdown-menu"> 
                                                    <button
                                                        type="button"class="dropdown-item menu edit_data text-success"
                                                        value="{{ $item->acc_1102050102_602_id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="ตัด STM">
                                                        <i class="fa-solid fa-clipboard-check me-2 text-success"
                                                            style="font-size:13px"></i>
                                                        <span>ตัด STM</span>
                                                    </button>

                                                </div>
                                            </div>
                                        </td>
                                    </tr> --}}
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="main-card card">
                    <table id="example" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                            <th>hn</th>
                            <th>pname</th> 
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($patient as $itemp)
                            <?php $i++; ?>
                                <tr height="20" style="font-size: 13px;">
                                    <td>{{$itemp->hn}}</td>
                                    <td>{{$itemp->ptname}}</td> 
                                </tr>  
                            @endforeach 
                        </tbody>
                    </table>
                </div> 
            </div>  --}}

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

                    {{-- <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="">รับแจ้ง</label>
                            <div class="form-group">
                                <input id="req_no" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">เคลม</label>
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

                    </div> --}}

                    {{-- <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="">ครั้งที่</label>
                            <div class="form-group">
                                <input id="no" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">ประเภทการจ่าย</label>
                            <div class="form-group">
                                <input id="paytype" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">ผู้ประสบภัย</label>
                            <div class="form-group">
                                <input id="ptname" type="text" class="form-control form-control-sm" >
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mt-2">
                       
                        <div class="col-md-3">
                            <label for="" style="color: red">เลขที่ใบเสร็จรับเงิน</label>
                            <div class="form-group">
                                <input id="money_billno" type="text" class="form-control form-control-sm">
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
                            <label for="">วันที่บันทึก</label>
                            <div class="form-group">
                                <input id="savedate" type="date" class="form-control form-control-sm"
                                    value="{{ $datenow }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                       
                        <div class="col-md-12">
                            <label for="" style="color: red">หมายเหตุ</label>
                            <div class="form-group">
                                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                         
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

            $('#updateBtn').click(function() {
                var acc_1102050102_602_id = $('#editacc_1102050102_602_id').val();
                var vn = $('#editvn').val();
                var hn = $('#edithn').val();
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
                var comment = $('#comment').val();
                $.ajax({
                    url: "{{ route('acc.account_602_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        acc_1102050102_602_id,vn,hn,
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
                        savedate,
                        comment
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
                        $('#money_billno').val(data.acc602.recieve_no)
                        $('#comment').val(data.acc602.comment)
                        $('#payprice').val(data.acc602.recieve_true)
                        $('#paydate').val(data.acc602.recieve_date)
                        // $('#savedate').val(data.acc602.savedate)
                    },
                });
            });

        });
    </script>
@endsection
