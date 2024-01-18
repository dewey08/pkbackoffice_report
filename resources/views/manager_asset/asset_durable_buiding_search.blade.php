@extends('layouts.asset')

@section('css_before')
<link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
<style>
    table.sl-border th {
        border: 1px #000 solid !important;
    }

    table.sl-border td {
        border: 1px #000 solid !important;
    }
        table tr th{
            vertical-align:middle !important;
        }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="block block-content pb-4" style="width:95%">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ตารางข้อมูลสิ่งก่อสร้าง และครุภัณฑ์</h3>
        </div>
        <hr>
        <form class="card">
            <div class="card-body row">
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    ปีงบประมาณ :
                </div>
                <div class="col-md-1">
                    <select name="year" class="form-control" id="">
                        @foreach($budgetyear_dropdown as $value)
                        @if($value == $budgetyear)
                        <option value="{{$value}}" selected>{{$value}}</option>
                        @else
                        <option value="{{$value}}">{{$value}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    ประเภทงบประมาณ :
                </div>
                <div class="col-md-3">
                    <select name="budget" class="form-control" id="">
                        @foreach($budget_dropdown_header as $row)
                        @if($row['BUDGET_ID'] == $budget)
                        <option value="{{$row['BUDGET_ID']}}" selected>{{$row['BUDGET_NAME']}}</option>
                        @else
                        <option value="{{$row['BUDGET_ID']}}">{{$row['BUDGET_NAME']}}</option>
                        @endif
                        @endforeach
                        @foreach($budget_dropdown as $row)
                        @if($row->BUDGET_ID == $budget)
                        <option value="{{$row->BUDGET_ID}}" selected>{{$row->BUDGET_NAME}}</option>
                        @else
                        <option value="{{$row->BUDGET_ID}}">{{$row->BUDGET_NAME}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-info py-1">ค้นหา</button>
                </div>
            </div>
        </form>
        <div class="block shadow">
            <hr>
            <h6 class="block-title text-center fs-18">ตารางสิ่งก่อสร้าง</h6>
            <hr>
            <div class="block-content" style="overflow-y:hidden">
                <table id="table_buiding" class="table table-striped sl-border" style="border:solid 1px #000;width:100%">
                    <thead class="bg-sl-blue text-white">
                        <tr>
                            <th width="10px">ลำดับ</th>
                            <th >ชื่ออาคาร</th>
                            <th width="10%">มูลค่า</th>
                            <th width="8%">วันที่สร้าง</th>
                            <th width="8%">วันที่สร้างเสร็จ</th>
                            <th width="8%">อายุการใช้งาน</th>
                            <th width="10%">ประเภทงบประมาณ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($buiding_table as $row)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>{{$row->BUILD_NAME}}</td>
                            <td class="text-right bg-sl-y1">{{number_format($row->BUILD_NGUD_MONEY,2)}}</td>
                            <td class="text-center">{{DateThai($row->BUILD_CREATE)}}</td>
                            <td class="text-center">{{DateThai($row->BUILD_FINISH)}}</td>
                            <td class="text-center">{{$row->OLD_USE}}</td>
                            <td class="text-center">{{$row->BUDGET_NAME}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                <p class="text-right mr-4 my-2">มูลค่ารวม <span class="fs-18 fw-b">{{number_format($buiding_count->total_price,2)}}</span>&nbsp;บาท</p>
                <p class="text-rightmr-4 my-2">จำนวน <span class="fs-18 fw-b">{{$buiding_count->amount}}</span>&nbsp;รายการ</p>
                </div>
            </div>
        </div>
        <div class="block shadow">
            <hr>
            <h6 class="block-title text-center fs-18">ตารางครุภัณฑ์</h6>
            <hr>
            <div class="block-content" style="overflow-y:hidden">
                <table id="table_durable" class="table table-striped sl-border" style="border:solid 1px #000;width:100%">
                    <thead class="bg-sl-blue text-white">
                        <tr>
                            <th width="20px">ลำดับ</th>
                            <th width="120px">เลขครุภัณฑ์</th>
                            <th width="15%">ชื่อครุภัณฑ์</th>
                            <th width="5%">มูลค่า</th>
                            <th width="8%">วันที่รับเข้า</th>
                            <th>ประเภทครุภัณฑ์</th>
                            <th>ประจำอยู่หน่วยงาน</th>
                            <th width="5%" >ประเภทงบ</th>
                            <th width="5%">ความเสี่ยง</th>
                            <th width="5%">การเบิกใช้</th>
                            <th width="5%">สถานะ</th>
                            <th>หน่วยงานขอยืม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($duration_table as $row)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td >{{$row->ARTICLE_NUM}}</td>
                            <td>{{$row->ARTICLE_NAME}}</td>
                            <td class="text-right bg-sl-y1">{{number_format($row->PRICE_PER_UNIT,2)}}</td>
                            <td class="text-center">{{DateThai($row->RECEIVE_DATE)}}</td>
                            <td>{{$row->DECLINE_NAME}}</td>
                            <td>{{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                            <td>{{$row->BUDGET_NAME}}</td>
                            @if( $row->RISK_TYPE_ID == '0')
                            <td class="text-center"><span class="badge badge-info fs-13">ต่ำ</span></td>
                            @elseif($row->RISK_TYPE_ID== '1')
                            <td class="text-center"><span class="badge badge-success fs-13">กลาง</span></td>
                            @elseif($row->RISK_TYPE_ID == '2')
                            <td class="text-center"><span class="badge badge-danger fs-13">สูง</span></td>
                            @else
                            <td class="text-center"></td>
                            @endif

                            @if( $row->OPENS == 'True')
                            <td class="text-font text-center"><span class="btn btn-success d-inline-flex py-1"><i
                                        class="fa-xs fa fa-check"></i></span></td>
                            @else
                            <td class="text-font text-center"></td>

                            @endif
                            <td class="text-center">{{$row->STATUS_NAME}}</td>
                            <td>{{$row->DEP_SUB_SUB_NAME}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                <p class="text-right mr-4 my-2">มูลค่ารวม <span class="fs-18 fw-b">{{number_format($duration_count->total_price,2)}}</span>&nbsp;บาท</p>
                <p class="text-rightmr-4 my-2">จำนวน <span class="fs-18 fw-b">{{$duration_count->amount}}</span>&nbsp;รายการ</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
<script type="text/javascript" charset="utf8" src="{{asset('js/1.10.24.js.jquery.dataTables.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#table_durable').DataTable({
            info: false,
            // "bPaginate": false,
            // "bLengthChange": false,
            "iDisplayLength": 50,
            // "bFilter": false,    
            // "bInfo": false,
            // "bAutoWidth": false
            // "paging": false,
        });
    });
    $(document).ready(function () {
        $('#table_buiding').DataTable({
            info: false,
            // "bPaginate": false,
            // "bLengthChange": false,
            "iDisplayLength": 10,
            // "bFilter": false,    
            // "bInfo": false,
            // "bAutoWidth": false
            // "paging": false,
        });
    });
</script>
@endsection