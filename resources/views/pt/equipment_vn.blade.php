@extends('layouts.user')
@section('title', 'PK-BACKOFFice || งานจิตเวชและยาเสพติด')
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
    ?>
    <div class="container-fluid">
  
    <div class="row ">
        <div class="col-xl-12">
            <h5>รายงานจำนวนผู้ป่วย</h5>
            <div class="card">
                <div class="card-body py-0 px-2 mt-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap myTable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th class="text-center">HN</th>
                                    <th class="text-center">วันที่รับบริการ</th>
                                    <th class="text-center">เลขบัตร</th>
                                    <th class="text-center">ชื่อ-นามสกุล</th>
                           
                                    <th class="text-center">สิทธฺิ</th>
                                    <th class="text-center">รหัสกรมบัญชีกลาง</th> 
                                    <th class="text-center">รายการ</th> 
                                    <th class="text-center">จำนวน</th> 
                                    <th class="text-center">ราคา</th> 
                                    <th class="text-center">การเบิก</th> 
                                    <th class="text-center">หมายเหตุ</th>  
                                    <th class="text-center">ชดเชย</th> 
                                    <th class="text-center">HN การเบิกจริง</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($equipment_vn as $item)
                                    <tr>
                                        <td width="4%">{{ $i++ }}</td>
                                        <td class="text-center">{{ $item->hn}}</td>                                     
                                        <td width="10%" class="text-center">{{ $item->vstdate}}</td>
                                        <td class="text-center"> {{$item->cid}}</td>
                                        <td class="text-center">{{ $item->fullname}}</td>
                                        <td class="text-center">{{ $item->pttype}}</td>
                                        {{-- <td class="text-center">{{ $item->detail}}</td> --}}
                                        <td class="text-center">{{ $item->billcode}}</td>
                                        <td class="p-2">{{ $item->nname}}</td>
                                        <td class="text-center">{{ $item->qty}}</td>
                                        <td class="text-center">{{ $item->price}}</td>
                                        <td class="text-center">{{ $item->nhso_ownright_name}}</td>
                                        <td class="text-center">{{ $item->claim_code}}</td>
                                        @if ($item->pay_price == 'check')
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm position-relative">
                                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                    <span class="visually-hidden">{{ $item->pay_price }}</span>                                                            
                                                </span>
                                                {{ $item->pay_price }}
                                            </button>
                                        </td>
                                        @else
                                            <td class="text-center">{{ $item->pay_price }}</td>
                                        @endif
                                        <td class="text-center">{{ $item->truehn}}</td>
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





@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();

            $('select').select2();
            $('#ECLAIM_STATUS').select2({
                dropdownParent: $('#detailclaim')
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#checkBtn').click(function() {

                var pang_id = $('#pang_id').val();
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();
                // alert(enddate);
                $.ajax({
                    url: "{{ route('acc.checksit_admit_spsch') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        pang_id,
                        startdate,
                        enddate
                    },
                    success: function(data) {
                        // if (data.status == 200) { 
                        //     Swal.fire({
                        //         title: 'บันทึกข้อมูลสำเร็จ',
                        //         text: "You Insert data success",
                        //         icon: 'success',
                        //         showCancelButton: false,
                        //         confirmButtonColor: '#06D177',
                        //         confirmButtonText: 'เรียบร้อย'
                        //     }).then((result) => {
                        //         if (result
                        //             .isConfirmed) {
                        //             console.log(
                        //                 data);

                        //             window.location
                        //                 .reload();
                        //         }
                        //     })
                        // } else {

                        // }

                    },
                });
            });

        });
    </script>

@endsection
