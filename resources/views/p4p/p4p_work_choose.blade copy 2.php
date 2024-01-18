@extends('layouts.p4pnew')
@section('title', 'PK-BACKOFFice || P4P')

     <?php
     use App\Http\Controllers\P4pController;
     use Illuminate\Support\Facades\DB;   
     $refnumberwork = P4pController::refnumberwork();
     $refwork = P4pController::refwork();
 ?>


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
    <style>
        body {
           font-size: 13px;
       }
       .btn {
           font-size: 13px;
       }
       .bgc {
           background-color: #264886;
       }
       .bga {
           background-color: #fbff7d;
       }
       .boxpdf {
           /* height: 1150px; */
           height: auto;
       }
       .page {
           width: 90%;
           margin: 10px;
           box-shadow: 0px 0px 5px #000;
           animation: pageIn 1s ease;
           transition: all 1s ease, width 0.2s ease;
       }
       
       @media (min-width: 1500px) {
           .modal-xls {
               --modal-width: 1500px;
           }
       }
        
       
   </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>บันทึกรายการภาระงาน P4P </h5>
                            </div> 
                            <div class="col"></div> 
                            <div class="col-md-2 text-end">
                                <a href="{{ url('p4p_work') }}"
                                    class="btn btn-warning btn-sm"> 
                                    <i class="fa-regular fa-circle-left me-2"></i>
                                    ย้อนกลับ
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h6 style="color: rgb(163, 162, 162)"> เดือน {{$monthth}} ปี {{$year}}</h6>
                            </div> 
                            <div class="col"></div> 
                           
                        </div>
                    </div>
                    <div class="card-body shadow-lg">
                         {{-- <div class="row mb-3 mt-2"> 
                            <div class="col"></div>
                            
                            <div class="col-md-3 text-end">
                                <label for="p4p_work_position" style="font-family: sans-serif;font-size: 13px">เลือกรายการภาระงานตามสายงาน </label>
                            </div>
                            <div class="col-md-6">  
                                <select id="p4p_work_position" name="p4p_work_position"
                                        class="form-select form-select-sm" style="width: 100%" >
                                        <option value=""> </option>
                                        @foreach ($p4p_work_po as $its)   
                                        <option value="{{ $its->p4p_work_position_id }}"> {{ $its->p4p_work_position_code }}::{{ $its->p4p_work_position_name }} </option> 
                                        @endforeach
                                    </select>
                            </div>   
                             
                            <input type="hidden" id="p4p_work_id" value="{{$data_->p4p_work_id}}"> 

                            <div class="col-md-2"> 
                                <button type="button" class="btn btn-success btn-sm" id="Savebtn">
                                    <i class="fa-solid fa-circle-plus me-2"></i>
                                    เพิ่มตามสายงาน
                                </button>

                            </div>
                            <div class="col"></div>
                        </div> 
                        <div class="row mb-3 mt-2"> 
                            <div class="col"></div>
                                                       
                            <div class="col-md-3 text-end">
                                <label for="p4p_workset_id" style="font-family: sans-serif;font-size: 13px">ภาระงาน </label>
                            </div>
                            <div class="col-md-6">  
                                <select id="p4p_workset_id" name="p4p_workset_id"
                                        class="form-select form-select-sm" style="width: 100%" >
                                        <option value=""> </option>
                                        @foreach ($p4p_workset as $its)   
                                        <option value="{{ $its->p4p_workset_id }}"> {{ $its->p4p_workset_code }}::{{ $its->p4p_workset_name }} </option> 
                                        @endforeach
                                    </select>
                            </div>  
                             
                            <input type="hidden" id="p4p_workgroupset_user" value="{{$iduser}}"> 

                            <div class="col-md-2"> 
                                <button type="button" class="btn btn-success btn-sm" id="Saveonebtn">
                                    <i class="fa-solid fa-circle-plus me-2"></i>
                                    เพิ่มทีละรายการ
                                </button>

                            </div>
                            <div class="col"></div>
                        </div> 
                        <hr> --}}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="mb-0">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="text-center">ลำดับ</th>  
                                                    {{-- <th width="10%" class="text-center">สายงาน</th> --}}
                                                    <th class="text-center">ชื่อรายการภาระงาน</th>
                                                    <th width="5%" class="text-center">ระยะเวลาที่ใช้จริง</th>
                                                    <th width="5%" class="text-center">คะแนน/นาที</th>
                                                    <th width="5%" class="text-center">รวมคะแนน/นาที</th>
                                                    <th width="5%" class="text-center">หน่วยนับ</th>
                                                    <th width="5%" class="text-center">สถานะ</th>
                                                    {{-- <th width="5%" class="text-center">จัดการ</th>  --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($p4p_workset as $item) 
                                                    <tr id="sid{{ $item->p4p_workset_id }}">   
                                                        <td class="text-center" width="5%">{{ $i++ }}</td>    
                                                        {{-- <td class="text-center" width="10%" style="font-size: 13px">{{ $item->p4p_work_position_name }}</td>  --}}
                                                        <td class="p-2" style="font-size: 13px">
                                                            <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{$item->p4p_workset_id}}" aria-expanded="false" aria-controls="collapse{{$item->p4p_workset_id}}">
                                                                <i class="fa-solid fa-circle-info text-info me-2"></i>
                                                                {{ $item->p4p_workset_name }}
                                                            </button>                                                           
                                                            <div class="collapse mt-1 mb-2" id="collapse{{$item->p4p_workset_id}}">
                                                                <div class="row">
                                                                    <div class="col-md-2 mt-3">
                                                                        <label for="ot_one_detail">เหตุผล </label>
                                                                    </div>
                                                                    <div class="col-md-10 mt-3">
                                                                        <div class="form-outline">
                                                                            <input id="ot_one_detail" type="text" class="form-control input-rounded"
                                                                                name="ot_one_detail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" width="5%" style="font-size: 13px">{{ $item->p4p_workset_time }}</td> 
                                                        <td class="text-center" width="5%" style="font-size: 13px">{{ $item->p4p_workset_score }}</td> 
                                                        <td class="text-center" width="5%" style="font-size: 13px">{{ $item->p4p_workset_wp }}</td> 
                                                        <td class="text-center" width="5%" style="font-size: 13px">{{ $item->p4p_workgroupset_unit_name }}</td> 
                                                        <td width="5%">
                                                            @if($item-> p4p_workset_active == 'TRUE' )
                                                            <input type="checkbox" id="{{ $item-> p4p_workset_id }}" name="{{ $item-> p4p_workset_id }}" switch="none" onchange="switchactive({{ $item-> p4p_workset_id }});" checked />
                                                            @else
                                                            <input type="checkbox" id="{{ $item-> p4p_workset_id }}" name="{{ $item-> p4p_workset_id }}" switch="none" onchange="switchactive({{ $item-> p4p_workset_id }});" />
                                                            @endif
                                                            <label for="{{ $item-> p4p_workset_id }}" data-on-label="On" data-off-label="Off"></label>
 
                                                        </td>
                                                        {{-- <td class="text-center" width="5%">
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-primary dropdown-toggle menu btn-sm"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">ทำรายการ</button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item menu btn btn-outline-warning btn-sm"
                                                                       href="{{url('p4p_workset_edit/'.$item->p4p_workset_id)}}"
                                                                        data-bs-toggle="tooltip" data-bs-placement="left" title="แก้ไข">
                                                                        <i class="fa-solid fa-file-pen me-2"
                                                                            style="color: rgb(252, 153, 23)"></i>
                                                                        <label for=""
                                                                            style="color: rgb(252, 153, 23)">แก้ไข</label>
                                                                    </a>
                                                                    <a class="dropdown-item menu btn btn-outline-warning btn-sm" 
                                                                        data-bs-toggle="tooltip" data-bs-placement="left" title="บันทึกคะแนน">
                                                                        <i class="fa-solid fa-circle-plus me-2"
                                                                            style="color: rgb(23, 168, 252)"></i>
                                                                        <label for=""
                                                                            style="color: rgb(23, 168, 252)">บันทึกคะแนน</label>
                                                                    </a>
                                                                </ul>
                                                            </div>
                                                        </td>  --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </p>     

                            </div>
                        </div>
                       
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12 text-end">
                            <div class="form-group"> 
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--  Modal content for the above example -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">บันทึกรายการภาระงาน P4P</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum.
                        Cras justo odio, dapibus ac facilisis in,
                        egestas eget quam. Morbi leo risus, porta ac
                        consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque
                        nisl consectetur et. Vivamus sagittis lacus vel
                        augue laoreet rutrum faucibus dolor auctor.</p>
                    
                </div>
            </div> 
        </div> 
    </div> 
    
@endsection
@section('footer')
<script>
    
    function switchactive(idfunc){
            // var nameVar = document.getElementById("name").value;
            var checkBox = document.getElementById(idfunc);
            var onoff;
            
            if (checkBox.checked == true){
                onoff = "TRUE";
            } else {
                onoff = "FALSE";
            }
 
            var _token=$('input[name="_token"]').val();
                $.ajax({
                        url:"{{route('p4.p4p_workset_switchactive')}}",
                        method:"GET",
                        data:{onoff:onoff,idfunc:idfunc,_token:_token}
                })
       }
       function addunitwork() {
          var unitnew = document.getElementById("UNIT_INSERT").value;
        //   alert(unitnew);
          var _token = $('input[name="_token"]').val();
          $.ajax({
              url: "{{url('addunitwork')}}",
              method: "GET",
              data: {
                unitnew: unitnew,
                  _token: _token
              },
              success: function (result) {
                  $('.show_unit').html(result);
              }
          })
      }
</script>
{{-- <script>
     $(document).on('click', '.detail', function() {
            var id = $(this).val(); 
            $('#detailModal').modal('show');
            $('#Savebtn').click(function() {
                var p4p_workset_code = $('#p4p_workset_code').val(); 
                var p4p_workset_name = $('#p4p_workset_name').val(); 
                var p4p_workset_user = $('#p4p_workset_user').val(); 
                var p4p_workset_time = $('#p4p_workset_time').val();
                var p4p_workset_score = $('#p4p_workset_score').val();
                var p4p_workset_unit = $('#p4p_workset_unit').val();
                var p4p_workset_group = $('#p4p_workset_group').val();
                $.ajax({
                    url: "{{ route('p4.p4p_workset_save') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        p4p_workset_code,
                        p4p_workset_name,
                        p4p_workset_user,
                        p4p_workset_time,
                        p4p_workset_score,
                        p4p_workset_unit,
                        p4p_workset_group
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
                                    // window.location="{{url('warehouse/warehouse_index')}}";
                                }
                            })
                        } else {

                        }

                    },
                });
            });
        });
</script> --}}
<script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#p4p_work_month').select2({
                placeholder:"--เลือก--",
                allowClear:true
            });
            $('#p4p_workset_id').select2({
                placeholder:"--เลือก--",
                allowClear:true
            });
            $('#p4p_work_position').select2({
                placeholder:"--เลือก--",
                allowClear:true
            });
            $('#Saveonebtn').click(function() {
                var p4p_workset_id = $('#p4p_workset_id').val(); 
                var p4p_work_id = $('#p4p_work_id').val(); 
               
                $.ajax({
                    url: "{{ route('p4.p4p_work_choose_save') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        p4p_workset_id,
                        p4p_work_id                        
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
                                    // window.location="{{url('warehouse/warehouse_index')}}";
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'มีข้อมูลแล้ว',
                                text: "You have data success",
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
                                    // window.location="{{url('warehouse/warehouse_index')}}";
                                }
                            })
                        }

                    },
                });
            });

            $('#Savebtn').click(function() {
                // var p4p_workset_id = $('#p4p_workset_id').val(); 
                var p4p_work_id = $('#p4p_work_id').val(); 
                var p4p_work_position = $('#p4p_work_position').val(); 
                var p4p_workgroupset_user = $('#p4p_workgroupset_user').val(); 
                // alert(p4p_workgroupset_user);
                $.ajax({
                    url: "{{ route('p4.p4p_work_choose_worksetsave') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        p4p_work_id,
                        p4p_workgroupset_user,
                        p4p_work_position
                        // p4p_work_code 
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
                                    // window.location="{{url('warehouse/warehouse_index')}}";
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'มีข้อมูลแล้ว',
                                text: "You have data success",
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
                                    // window.location="{{url('warehouse/warehouse_index')}}";
                                }
                            })
                        }

                    },
                });
            });
        });
        
</script>

@endsection
