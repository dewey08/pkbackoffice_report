@extends('layouts.mpay')
@section('css_after')
<style>
    .table td{
        padding-top:2px;
        padding-bottom:2px;
    }
    .table thead tr th{
        vertical-align:middle;
    }
    .hover-pop::hover{
        background:red;
    }
</style>
@endsection
@section('content')
<div class="block block-rounded block-bordered" style="width: 95%;margin:auto">
    <div class="block-header block-header-default">
        <div class="block-title fs-18 fw-7">โควตาแต่ละหน่วยงาน</div>
    </div>
    <div class="block-content py-3">
        <div class="row">
            <div class="col-md-4">
                <table class="table table-striped table-bordered table-vcenter" id="table0">
                    <thead class="bg-sl2-b2 text-white">
                        <tr>
                            <th class="text-center">หน่วยงาน (คลิ๊กเพื่อเลือกดู)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="cursor:pointer" class="clickable-row hover-pop" data-id="">
                            <td class="text-center fw-b fs-18">ทั้งหมด</td>
                        </tr>
                        @foreach($dep_list as $row)
                        <tr style="cursor:pointer" class="clickable-row" data-id="{{$row->CPAY_DEP_ID}}">
                            <td>{{$row->CPAY_DEP_NAME_INSIDE}} ({{$row->DEP_CODE}})</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-8">
                <table class="table table-striped table-bordered table-vcenter" id="table">
                    <thead class="bg-sl2-b2 text-white">
                        <tr>
                            <!-- <th class="text-center">#</th> -->
                            <th class="text-center">ชื่อหน่วยงาน</th>
                            <th class="text-center">ชื่อชุดอุปกรณ์</th>
                            <th class="text-center" width="150px">จำนวนโควตา</th>
                            <th class="text-center" width="150px">จำนวนคงเหลือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach($dep_quota as $row)
                        <tr>
                            <!-- <td width="65px" class="text-center">{{$number++}}</td> -->
                            <td>{{$row->CPAY_DEP_NAME_INSIDE}} ({{$row->DEP_CODE}})</td>
                            <td>[{{$row->CPAY_SET_ID}}] {{$row->CPAY_SET_NAME_INSIDE}}</td>
                            <td class="text-center">{{$row->DEP_QUOTA_QUANTITY}}</td>
                            <td class="text-center" style="background:#f6edbd">{{$row->DEP_QUOTA_BALANCE}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>
    // $('#modalclick').click();
    const token = $('meta[name=csrf-token]').attr('content');
    @if(Session('scc'))
        Swal.fire("{{session('scc')}}",'','success')
    @endif
    @if(session('err'))
        Swal.fire("{{session('err')}}", '', "error")
    @endif

    $('#table0').DataTable({
            "pageLength": 25,
            "searching": false,
            // "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "ordering": false
        }
    );
    $('#table').DataTable({
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "pageLength": 50,
            "order": [[ 0, "desc" ]],
        }
    );

    $(".clickable-row").click(function() {
        let id = $(this).data("id");
        window.location = '{{route("mpay.mpay_show_quota")}}?dep_id='+id;
    });

</script>

@endsection