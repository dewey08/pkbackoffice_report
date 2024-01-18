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
                <h3 class="block-title text-center fs-24">ตารางข้อมูลครุภัณฑ์</h3>
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
                    <div class="col-md-1 d-flex justify-content-center center align-items-center">
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
                    <div class="col-md-5 pr-5 d-flex flex-column align-items-center ">
                        <p class="ml-auto mb-1">จำนวน <span
                                class="fs-20 fw-b">{{$duration_count->amount}}</span>&nbsp;รายการ</p>
                        <p class="ml-auto mb-1">มูลค่ารวม <span
                                class="fs-20 fw-b">{{number_format($duration_count->total_price,2)}}</span>&nbsp;บาท</p>

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
                        <div id="duration_M_column" class="d-flex justify-content-xl-center"
                            style="width:100%;height:500px"></div>
                    </div>
                </div>
            </div>
            <div class="block-content pt-0" style="overflow-y:hidden">
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
                            <th width="5%" >ประเภทงบประมาณ</th>
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
                            <td>{{$row->ARTICLE_NUM}}</td>
                            <td>{{$row->ARTICLE_NAME}}</td>
                            <td class="text-right bg-sl-y1">{{number_format($row->PRICE_PER_UNIT,2)}}</td>
                            <td class="text-center">{{DateThai($row->RECEIVE_DATE)}}</td>
                            <td>{{$row->DECLINE_NAME}}</td>
                            <td>{{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                            <td width="20px">{{$row->BUDGET_NAME}}</td>
                            @if( $row->RISK_TYPE_ID == '0')
                                        <td class="text-center" ><span class="badge badge-info fs-13" >ต่ำ</span></td>
                                         @elseif($row->RISK_TYPE_ID== '1')
                                        <td class="text-center" ><span class="badge badge-success fs-13" >กลาง</span></td>
                                        @elseif($row->RISK_TYPE_ID == '2')
                                        <td class="text-center" ><span class="badge badge-danger fs-13" >สูง</span></td>
                                        @else
                                        <td class="text-center"></td>
                                        @endif

                                        @if( $row->OPENS == 'True')
                                        <td class="text-font text-center"><span class="btn btn-success d-inline-flex py-1"><i class="fa-xs fa fa-check"></i></span></td>
                                        @else
                                        <td class="text-font text-center"></td>
                            
                                        @endif
                            <td class="text-center">{{$row->STATUS_NAME}}</td>
                            <td>{{$row->DEP_SUB_SUB_NAME}}</td>
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
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน ','มูลค่าครุภัณฑ์'],
            ['ต.ค.',{{$duration_M[10]}}],
            ['พ.ย.',{{$duration_M[11]}}],
            ['ธ.ค.',{{$duration_M[12]}}],
            ['ม.ค.',{{$duration_M[1]}}],
            ['ก.พ.',{{$duration_M[2]}}],
            ['มี.ค.',{{$duration_M[3]}}],
            ['เม.ย.',{{$duration_M[4]}}],
            ['พ.ค.',{{$duration_M[5]}}],
            ['มิ.ย.',{{$duration_M[6]}}],
            ['ก.ค.',{{$duration_M[7]}}],
            ['ส.ค.',{{$duration_M[8]}}],
            ['ก.ย.',{{$duration_M[9]}}]
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
        var chart = new google.visualization.ColumnChart(document.getElementById('duration_M_column'));
        chart.draw(view, options);
    }
</script>
@endsection