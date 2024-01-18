@extends('layouts.medical')
@section('css_before')
<link rel="stylesheet" href="http://localhost/gtwbackoffice/asset/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<style>
    #datatable th , #datatable td {
        border-top:1px solid #000;
        border-left:1px solid #000 !important;
    } 
    #datatable{
        border-right:1px solid #000 !important;
        border-bottom:1px solid #000 !important;
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
            <h3 class="block-title text-center fs-20">ตารางการร้องขอเบิกยาและเวชภัณฑ์</h3>
        </div>
        <hr>
        <form method="get">
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
                    &nbsp;สถานะการดำเนินการ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="status_request" id="status_request" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="all">ร้องขอเบิกทั้งหมด</option>
                            @foreach ($list_status as $status_d)
                            @if($status_d->STATUS_CODE == $status)
                            <option value="{{$status_d->STATUS_CODE}}" selected>{{$status_d->STATUS_NAME}}</option>
                            @else
                            <option value="{{$status_d->STATUS_CODE}}">{{$status_d->STATUS_NAME}}</option>
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
           <table id="datatable" class="table table-bordered table-striped">
                <thead class="bg-sl2-g4 text-white">
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
                @foreach($list_request as $row)
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
                </tbody>
            </table>
        </div>
    </div>  
</div>
@endsection
@section('footer')
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="http://localhost/gtwbackoffice/asset/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
<script>
    $('#datatable').DataTable({
        "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
        "info":     false,
        "order":[4,'desc'],
    })
</script>
@endsection