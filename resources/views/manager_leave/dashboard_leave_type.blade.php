@extends('layouts.leave')
@section('css_before')
<link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
<?php
  $status = Auth::user()->status; 
  $id_user = Auth::user()->PERSON_ID; 
  $url = Request::url();
  $pos = strrpos($url, '/') + 1;
  $user_id = substr($url, $pos); 
use App\Http\Controllers\ManagerleaveController;
    $m_budget = date("m");
    if($m_budget>9){
    $yearbudget = date("Y")+544;
    }else{
    $yearbudget = date("Y")+543;
    }
    function daystr_foramt($day)
    {
        $arr = explode('.',$day);
        if($arr[1] == '00'){
        return $arr[0] .' วัน';
        }elseif(count($arr) == 2 && $arr[1] == '50'){
            return $arr[0].' วันครึ่ง';
        }else{
            return $arr[0].'.'.number_format($arr[1]).' วัน';
        }
    }

?>
<style>
</style>
@endsection
@section('content')
<div class="block block-content pb-4" style="width:95%">
    <div class="block-header block-header-default">
        <h3 class="block-title text-center fs-20">ตารางข้อมูลการลา</h3>
    </div>
    <hr>
    <forms class="card" id="search_leave_type" action="#" method="head">
        <div class="card-body row">
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                ปีงบประมาณ :
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <select name="year" class="form-control" id="year">
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
                ประเภทการลา :
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <select name="leavetype" class="form-control" id="leavetype">
                    @foreach($leavetype_dropdown as $row)
                    @if($row->LEAVE_TYPE_ID == $LEAVE_TYPE)
                    <option value="{{$row->LEAVE_TYPE_ID}}" selected>{{$row->LEAVE_TYPE_NAME}}</option>
                    @else
                    <option value="{{$row->LEAVE_TYPE_ID}}">{{$row->LEAVE_TYPE_NAME}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info py-1" onclick="opensearch()">ค้นหา</button>
            </div>
            <div class="col-md-5 d-flex flex-column align-items-center">
                <p class="pr-3 ml-auto mb-1">จำนวนลารวม <span class="fs-20 fw-b">{{$countLeave['count']}}</span>&nbsp;ครั้ง</p>
                <p class="pr-3 ml-auto mb-1">จำนวนคน <span class="fs-20 fw-b">{{count($tableleave)}}</span>&nbsp;คน</p>
            </div>
        </div>
    </forms>
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
                <div id="countleave_M_column" class="d-flex justify-content-xl-center" style="width:100%;height:500px">
                </div>
            </div>
        </div>
    </div>
    <div class="block-content pt-0" style="overflow-y:hidden">
        <table id="table" class="table table-striped table-sl-border table-sl-header-center"
            style="border:solid 1px #000;width:100%">
            <thead class="bg-sl2-b3 text-white text-center">
                <tr class="">
                    <th width="5px" class="px-2">#</th>
                    <th width="150px">ชื่อ - นามสกุล</th>
                    <th width="5px">เพศ</th>
                    <th>ตำแหน่ง</th>
                    <th>หน่วยงาน</th>
                    <th>ฝ่ายแผนก</th>
                    <th>กลุ่มบุคลากร</th>
                    <th>จำนวนลา</th>
                    <th>จำนวนวันลา</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($tableleave as $person)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{$person[0]}}</td>
                    <td class="text-center">{{$person[1]}}</td>
                    <td>{{ $person[2] }}</td>
                    <td>{{ $person[3] }}</td>
                    <td>{{ $person[4] }}</td>
                    <td>{{ $person[5] }}</td>
                    <td class="text-center">{{ $person[6] }} ครั้ง</td>
                    <td width="30" class="text-center bg-sl2-y2 fw-8">{{ daystr_foramt($person[7])}}</td>
                </tr>
                @php $i++; @endphp
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
            if ($('#change-display').is(':checked')) {
                text = 'y'
            } else {
                text = 'n'
            }
            $('.cartshow').toggleClass("d-none");
            $.ajax({
                url: '<?=url('web_meta_data/update_value_by_name')?>',
                data: {
                    _token: token,
                    value: text,
                    name: 'displaygraph_class'
                },
                method: 'post',
                success: function (result) {
                }
            })
        });;

    function opensearch() {
        window.location.href = "<?=url('manager_leave/dashboard_leave_type')?>" + '/' + $('#leavetype').val() + '/' + $(
            '#year').val();
    }
</script><script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน', 'ครั้ง'],
            ['ต.ค', {{$countleave_M[10]}} ],
            ['พ.ย', {{$countleave_M[11]}} ],
            ['ธ.ค', {{$countleave_M[12]}} ],
            ['ม.ค', {{$countleave_M[1]}} ],
            ['ก.พ', {{$countleave_M[2]}} ],
            ['มี.ค', {{$countleave_M[3]}} ],
            ['เม.ย', {{$countleave_M[4]}} ],
            ['พ.ค', {{$countleave_M[5]}} ],
            ['มิ.ย', {{$countleave_M[6]}} ],
            ['ก.ค', {{$countleave_M[7]}} ],
            ['ส.ค', {{$countleave_M[8]}} ],
            ['ก.ย', {{$countleave_M[9]}} ]
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
            width: "1000",
            height: '500',
            colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนการลา',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('countleave_M_column'));
        chart.draw(view, options);
    }
</script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            info: false,

            "iDisplayLength": 25,

        });
    });
</script>
@endsection