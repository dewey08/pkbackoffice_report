@extends('layouts.warehouse')
@section('css_before')
<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
?>
<link rel="stylesheet" href="{{asset('asset/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
<style>
    #datatable th , #datatable td {
        border-top:1px solid #000;
        border-left:1px solid #000;
    } 
    #datatable{
        border-bottom:1px solid #000;
        border-right:1px solid #000;
    }
    #datatable thead th{
        text-align:center;
        vertical-align:middle;
    }
 
</style>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-20">ตารางร้องขอวัสดุ</h3>
        </div>
        <hr>
        <form method="post" action="{{route('mwarehouse.dashboard_request')}}">
        @csrf
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach ($budgetyear_dropdown as $budget)
                            @if($budget == $budgetyear)
                            <option value="{{$budget}}" selected>{{$budget}}</option>
                            @else
                            <option value="{{$budget}}">{{$budget}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;สถานะ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="status_req" id="budgetyear" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="all">ทั้งหมด</option>
                            @foreach ($status_request as $value)
                                @if($value->STATUS_CODE == $status_req)
                                <option value="{{$value->STATUS_CODE}}" selected> 
                                {{$value->STATUS_NAME}}</option>
                                @else
                                <option value="{{$value->STATUS_CODE}}" >{{$value->STATUS_NAME}}</option>
                                @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1 text-center">
                    <span>
                        <button type="submit" class="btn btn-info fw-5">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <div class="block-content my-3" style="overflow-y:hidden">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead class="bg-sl2-r3 text-white">
                    <tr>
                        <th>#</th>
                        <th>สถานะ</th>
                        <th>รหัส</th>
                        <th>วันที่ร้องขอ</th>
                        <th>วันที่ต้องการ</th>
                        <th>ผู้ร้องขอ</th>
                        <th>ตำแหน่ง</th>
                        <th>ผู้เห็นชอบ</th>
                        <th>ตำแหน่ง</th>
                    </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach($table_request as $row)
                    @php
                    if($row->STATUS_CODE === 'Allow' || $row->STATUS_CODE === 'Approve'){
                        $style_bedge = 'badge badge-success'; //ผ่าน
                    }else if($row->STATUS_CODE === 'Disapprove' || $row->STATUS_CODE === 'Disverify'){
                        $style_bedge = 'badge badge-warning'; //เตือน
                    }else if($row->STATUS_CODE === 'Cancel' || $row->STATUS_CODE === 'Disallow'){
                        $style_bedge = 'badge badge-danger'; //อันตราย
                    }else{
                        $style_bedge = 'badge badge-info'; //ทั่วไป Pending Verify
                    }
                    @endphp
                    <tr>
                        <td class="text-center py-1 fs-13" style="width: 20px;">{{$i++}}</td>
                        <td class="text-center py-1 fs-13" style=""><span class="{{$style_bedge}}">{{$row->STATUS_NAME}}</span></td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_REQUEST_CODE}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_DATE_TIME_SAVE}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_DATE_WANT}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_SAVE_HR_NAME}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_SAVE_HR_POSITION}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_AGREE_HR_NAME}}</td>
                        <td class="py-1 fs-13" style="">{{$row->WAREHOUSE_AGREE_HR_POSITION}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
    
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>
<!-- Page JS Plugins -->
<script src="{{asset('asset/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<script>
    $('#datatable').DataTable({
        "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
        "info":     false
    })
</script>
@endsection