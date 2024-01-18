@extends('layouts.person')

@section('css_before')
<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<?php
    if (Auth::check()) {
        $status  = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;
    } else {
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }
?>
<link rel="stylesheet" type="text/css" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
<style>
    
    .hoverwhite:hover {
        color: white !important;
    }

    table.dataTable td {
        padding: 0px !important;
        padding-left: 5px !important;
        padding-right: 5px !important;
        vertical-align: middle;
    }
    table.dataTable th {
    vertical-align: middle;
}

</style>
@endsection

@section('content')
<div class="container-fluid shadow mb-5">
    <div class="row">
        <div class="col-12">
            <br>
            <div class="card">
                <div class="card-header text-center bg-sl-r3 py-3">
                    <h3 class="fs-24 m-0 text-white fw-3">ข้อมูลบุคลากรให้ออก</h3>
                </div>
                <div class="card-body py-3">
                    <div class="card">
                        <div class="card-header row">

                        </div>
                        <div class="card-body">
                            <div class="container-fluit">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link fs-18 active" data-toggle="tab" href="#graph">กราฟ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fs-18" data-toggle="tab" href="#table">ตาราง</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content d-flex justify-content-center">
                                    <div id="graph" class="container-fluit w-95 tab-pane active"><br>
                                        <div class="panel p-1 bg-sl-r3">
                                            <div class="panel-heading py-3 text-left text-white pl-3 ">ข้อมูลบุคลากร
                                            </div>
                                            <div class="panel-body bg-white" style="overflow-y:hidden">
                                                <div id="GiveOut_chart"
                                                    style="font-family: 'Kanit', sans-serif;width: 100%; height:500px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="table" class="container-fluit w-100 tab-pane fade table-responsive"><br>
                                        <table id="GiveOut_table" class="table-striped">
                                            <thead class="bg-sl-r3 text-white">
                                            <tr class="">
                                                <th width="5px">ลำดับ</th>
                                                <th width="50px">รหัสพนักงาน</th>
                                                <th>ชื่อ - นามสกุล</th>
                                                <th width="5px">เพศ</th>
                                                <th>วันเกิด</th>
                                                <th width="5px">อายุ</th>
                                                <th>วันสิ้นสุดการทำงาน</th>
                                                <th>ตำแหน่ง</th>
                                                <th>หน่วยงาน</th>
                                                <th>ฝ่ายแผนก</th>
                                                <th>กลุ่มบุคลากร</th>
                                                <th>คำสั่ง</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1;?>
                                            @foreach($person as $person)
                                            <tr>
                                                <td class="text-center">{{$i}}</td>
                                                <td class="text-center" >{{$person->HR_CID}}</td>
                                                <td>{{ $person->HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>
                                                <td class="text-center" >{{$person->SEX_NAME}}</td>
                                                <td class="text-center" >{{ DateThai($person -> HR_BIRTHDAY) }}</td>
                                                <td class="text-center" >{{ getAge($person -> HR_BIRTHDAY) }}</td>
                                                <td class="text-center" >{{ DateThai($person -> HR_WORK_END_DATE) }}</td>
                                                <td>{{ $person -> POSITION_IN_WORK }}</td>
                                                <td>{{ $person -> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                                <td>{{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>
                                                <td>{{ $person -> HR_PERSON_TYPE_NAME }}</td>
                                                <td class="text-center">
                                                
                                                
                                                        <div class="btn btn-outline-info text-info hoverwhite"
                                                            data-toggle="modal" 
                                                            data-id="{{$person->ID}}" onclick="showuser_detail(this)"
                                                            style="cursor:pointer;font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            รายละเอียด</div>
                                                <?php $i++;?>
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
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_show_userdetail" tabindex="-1" aria-labelledby="addModalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info shadow-lg">
                <h5 class="modal-title text-white" id="addModalModalLabel"
                    style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">รายละเอียดข้อมูลบุคคล</h5>
            </div>
            <div class="modal-body" id="show_userdetail">
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    var _token = '<?=csrf_token()?>'
    console.log(_token);

    function showuser_detail(e) {
        var id = e.getAttribute('data-id');
        $.ajax({
            url: "{{url('manager_person/detail_ajax/')}}/" + id,
            method: 'post',
            data: {
                '_token': _token
            },
            success: function (result) {
                $("#show_userdetail").html(result);
                $("#modal_show_userdetail").modal();
               
            }
        });
    }
</script>
<script>
    $(document).ready( function () {
    $('#GiveOut_table').DataTable({
        info : false,
        "iDisplayLength": 25,
    });
} );
</script>

<!-- กลุ่มงาน -->
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'กลุ่มบุคลากร');
        data.addColumn('number', 'จำนวน');
        data.addRows([
            ['ข้าราชการ', {{$pernw_type_count[1]}}],
            ['ลูกจ้างประจำ', {{$pernw_type_count[2]}} ],
            ['พนักงานราชการ',{{$pernw_type_count[3]}} ],
            ['พนักงานกระทรวงสาธารณสุข', {{$pernw_type_count[4]}}],
            ['ลูกจ้างชั่วคราว', {{$pernw_type_count[5]}}],
            ['ลูกจ้างรายวัน', {{$pernw_type_count[6]}}]

        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);

        var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            colors: ['#F67A37'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "40%"
            },
            height: '90%',
            vAxis: {
                title: 'จำนวน'
            },
            hAxis: {
                title: 'กลุ่มบุคลากร',
                fontName: 'Kanit'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('GiveOut_chart'));
        chart.draw(view, options);
    }
</script>
<script>
    var year_ = document.getElementById('year_');
    function search_year() {
        window.location="{{url('manager_person/dashboard/nw?year_select=')}}" + year_.value;
    }
</script>
@endsection