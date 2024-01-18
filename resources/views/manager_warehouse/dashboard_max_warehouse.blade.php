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
            <h3 class="block-title text-center fs-20">ตารางคลังหลัก :: วัสดุสูงกว่ากำหนด</h3>
        </div>
        <hr>
        <div class="block-content my-3 shadow">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead class="bg-sl2-r3 text-white">
                    <tr>
                        <th>#</th>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>ประเภทคลัง</th>
                        <th>ประเภทวัสดุ</th>
                        <th>รับเข้า</th>
                        <th>จ่ายออก</th>
                        <th>คงเหลือ</th>
                        <th>ไม่ควรเกิน</th>
                        <th>สูงกว่ากำหนดจำนวน</th>
                        <th>หน่วย</th>
                    </tr>
                </thead>
                <tbody>
                @php $i = 1; @endphp
                @foreach($table_maxmin as $row)
                    <tr>
                        <td class="text-center py-1 fs-13" style="width: 20px;">{{$i++}}</td>
                        <td class="py-1 fs-13" style="">{{$row->SUP_FSN_NUM}}</td>
                        <td class="py-1 fs-13" style="">{{$row->SUP_NAME}}</td>
                        <td class="py-1 fs-13" style="">{{$row->STORE_TYPE_NAME}}</td>
                        <td class="py-1 fs-13" style="">{{$row->SUP_TYPE_NAME}}</td>
                        <td class="text-center py-1 fs-13" style="">{{$row->sum_recieve}}</td>
                        <td class="text-center py-1 fs-13" style="">{{$row->sum_export}}</td>
                        <td class="text-center py-1 fs-13" style="">{{$row->net_amount}}</td>
                        <td class="text-center py-1 fs-13" style="">{{number_format($row->MAX)}}</td>
                        <td class="text-center py-1 fs-13" style="">{{number_format($row->net_amount-$row->MAX)}}</td>
                        <td class="text-center py-1 fs-13" style="">{{$row->SUP_UNIT_NAME}}</td>
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
        "order":[[9,'desc']],
        "info":     false
    })
</script>
@endsection