@extends('layouts.asset')

@section('css_before')
    <link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
    <style>
        table.sl-border th{
            border:1px #000 solid !important;
        }table.sl-border td{
            border:1px #000 solid !important;
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
                <h3 class="block-title text-center fs-24">ตารางข้อมูลสิ่งก่อสร้าง</h3>
            </div>
            <hr>
            <form class="card">
                <div class="card-body row">
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        ปีงบประมาณ : 
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <select name="year" class="form-control" id="">
                            @foreach($budgetyear_dropdown as $key => $value)
                            @if($key == $budgetyear)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        ประเภทงบประมาณ : 
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
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
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-info py-1">ค้นหา</button>
                    </div>
                    <div class="col-md-2 offset-md-3 pr-5 d-flex flex-column  align-items-center">
                        <p class="ml-auto mb-1">จำนวน <span class="fs-20 fw-b">{{$buiding_count->amount}}</span>&nbsp;รายการ</p>
                        <p class="ml-auto mb-1">มูลค่ารวม <span class="fs-20 fw-b">{{number_format($buiding_count->total_price,2)}}</span>&nbsp;บาท</p>
                    </div>
                </div>
            </form>
            
            <div class="block">
                <div class="d-flex justify-content-between block-content">
                    <p></p>
                    <div>
                        <input type="checkbox" id="change-display" <?=($status_graph == 'y')?'checked':'';?>>
                        <label for="change-display">แสดงกราฟ</label>
                    </div>
                </div>
                <div class="block-content cartshow  <?=($status_graph != 'y')?'d-none':'';?>" style="overflow-y:hidden">
                    <div class="shadow mb-3">
                        <div id="buiding_M_column" class="d-flex justify-content-xl-center"
                            style="width:100%;height:500px"></div>
                    </div>
                </div>
            </div>

            <div class="block-content" style="overflow-y:hidden">
                <table id="table_durable" class="table table-striped sl-border" style="border:solid 1px #000;width:100%">
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
            </div>
        </div>
    </div>


@endsection


@section('footer')
<script type="text/javascript" charset="utf8" src="{{asset('js/1.10.24.js.jquery.dataTables.js')}}"></script>
<script src="{{asset('google/Charts.js')}}"></script>
<script>
let token = '<?=csrf_token()?>'
$('#change-display').click(function () {
    let text = '';
    if($('#change-display').is(':checked')){
        text = 'y'
    }else{
        text = 'n'
    }
    $('.cartshow').toggleClass("d-none");
    $.ajax({
        url:'<?=url('web_meta_data/update_value_by_name')?>',
        data:{
            _token:token,
            value:text,
            name:'displaygraph_class'
        },
        method:'post',
        success:function(result){
            console.log(result);
        }
    })
});
    ;
</script>

<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน ','มูลค่าครุภัณฑ์'],
            ['ต.ค.',{{$buiding_M[10]}}],
            ['พ.ย.',{{$buiding_M[11]}}],
            ['ธ.ค.',{{$buiding_M[12]}}],
            ['ม.ค.',{{$buiding_M[1]}}],
            ['ก.พ.',{{$buiding_M[2]}}],
            ['มี.ค.',{{$buiding_M[3]}}],
            ['เม.ย.',{{$buiding_M[4]}}],
            ['พ.ค.',{{$buiding_M[5]}}],
            ['มิ.ย.',{{$buiding_M[6]}}],
            ['ก.ค.',{{$buiding_M[7]}}],
            ['ส.ค.',{{$buiding_M[8]}}],
            ['ก.ย.',{{$buiding_M[9]}}]
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0,1,
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
            width: "1200",
            height: '500',
            colors: ['#F67A37','#9BD770'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'บาท'
            },
            hAxis: {
                title: 'ปีงบประมาณ',
                fontName: 'Kanit'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('buiding_M_column'));
        chart.draw(view, options);
    }
</script>
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
</script>
@endsection