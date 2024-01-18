@extends('layouts.book')

@section('css_before')
<style>
    .header-group tr th , tr td{
        border:1px solid #000000;
    }
</style>
<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
use App\Http\Controllers\DashboardController;
$checkbook = DashboardController::checkbook($id_user);
?>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }

    p {
        word-wrap: break-word;
    }

    .text {
        font-family: 'Kanit', sans-serif;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="block shadow" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24">ข้อมูลสารบรรณอิเล็กทรอนิกส์</h3>
            </div>
            <hr>
            <form action="{{ url('manager_book/dashboard') }}" method="post">
            @csrf()
                <div class="row">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        &nbsp;ประจำปี พ.ศ. : &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="year" id="year" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($year_dropdown as $value)
                                @if($value == $year)
                                <option value="{{$value}}" selected>{{$value}}
                                </option>
                                @else
                                <option value="{{$value}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info"
                                style="font-family: 'Kanit', sans-serif;font-weight:normal;">แสดง</button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="block-content  my-3 shadow">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fs-18 fw-5">ข้อมูลการดำเนินการทะเบียน</h3>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-rounded bg-sl-g2 text-white">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-right">ทะเบียนรับ</p>
                                    <p class="m-0 fs-26">
                                        @if($amount_receive == '' || $amount_receive == null)
                                                0
                                        @else
                                                {{$amount_receive}} 
                                        @endif 
                                        <span class="fs-12">ฉบับ</span></p>
                                </div>
                                <div class="right">
                                    <i class="fs-30 fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-rounded bg-sl-r2 text-white">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-right">ทะเบียนส่ง</p>
                                    <p class="m-0 fs-26">
                                    @if($amount_sent == '' || $amount_sent == null)
                                        0
                                    @else
                                        {{$amount_sent}}
                                    @endif    
                                        
                                        
                                        <span class="fs-12">ฉบับ</span></p>
                                </div>
                                <div class="right">
                                    <i class="fs-30 fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-rounded bg-sl-y3 text-white">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-right">ทะเบียนคำสั่ง</p>
                                    <p class="m-0 fs-26">
                                     @if($amount_command == '' || $amount_command == null)
                                        0
                                     @else
                                        {{$amount_command}} 
                                     @endif
                                        
                                        <span class="fs-12">ฉบับ</span></p>
                                </div>
                                <div class="right">
                                    <i class="fs-30 fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-rounded block-link-pop shadow bg-sl-b2 text-white">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-right">ประกาศ/นโยบาย</p>
                                    <p class="m-0 fs-26">
                                    @if($amount_announce == '' || $amount_announce == null)
                                        0
                                    @else
                                        {{$amount_announce}} 
                                    @endif    
                                        
                                    <span class="fs-12">ฉบับ</span></p>
                                </div>
                                <div class="right">
                                    <i class="fs-30 fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบสารบรรณ</h3>
                    </div>
                    <div class="col-xl-6 mb-2">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                หนังสือรับแยกรายเดือน (จำแนกตามวันที่รับ)
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="receiveBook_M_column" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-2">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                จำนวนหนังสือ (จำแนกตามวันที่ส่ง)
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="amountBook_column" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-2">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                ขั้นความเร่งด่วนทะเบียนรับ
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="urgentRegister_pie" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-2">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                ประเภทหนังสือรับ
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="typebook_pie" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 mb-2">
                        <div class="card p-1 bg-sl-blue">
                            <div class="card-head px-3 py-2 fs-16 text-white">
                                <p class="m-0">ตารางประเภทหนังสือแยกตามหน่วยงานที่ส่งมา 10 อันดับ</p>
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                    <table class="table table-striped mb-0">
                                        <thead class="header-group bg-sl-b1">
                                            <tr>
                                                <th class="py-2">#</th>
                                            @foreach($countTypeebookreceive_byORG['header'] as $fild)
                                                <th class="py-2">{{$fild}}</th>
                                            @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($countTypeebookreceive_byORG['content']))
                                            @php $num = 1; @endphp
                                            @foreach($countTypeebookreceive_byORG['content'] as $row)
                                            <tr class="text-center">
                                                <td class="py-2">{{$num++}}</td>
                                                <td class="py-1 text-left">{{$row[1]}}</td>
                                                <td class="py-1">{{$row[2]}}</td>
                                                <td class="py-1">{{$row[3]}}</td>
                                                <td class="py-1">{{$row[4]}}</td>
                                                <td class="py-1">{{$row[5]}}</td>
                                                <td class="py-1">{{$row[6]}}</td>
                                                <td class="py-1">{{$row[7]}}</td>
                                                <td class="py-1">{{$row[8]}}</td>
                                                <td class="py-1">{{$row[9]}}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>

<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เดือน');
        data.addColumn('number', 'ครั้ง');
        data.addRows([
            ['ต.ค.', {{$amount_recievebook_M[10]}}],
            ['พ.ย.', {{$amount_recievebook_M[11]}}],
            ['ธ.ค.', {{$amount_recievebook_M[12]}}],
            ['ม.ค.', {{$amount_recievebook_M[1]}}],
            ['ก.พ.', {{$amount_recievebook_M[2]}}],
            ['มี.ค.', {{$amount_recievebook_M[3]}}],
            ['เม.ย.', {{$amount_recievebook_M[4]}}],
            ['พ.ค.', {{$amount_recievebook_M[5]}}],
            ['มิ.ย.', {{$amount_recievebook_M[6]}}],
            ['ก.ค.', {{$amount_recievebook_M[7]}}],
            ['ส.ค.', {{$amount_recievebook_M[8]}}],
            ['ก.ย.', {{$amount_recievebook_M[9]}}],
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
                groupWidth: "80%"
            },
            height: '100%',
            vAxis: {
                title: 'ครั้ง'
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('receiveBook_M_column'));
        chart.draw(view, options);
    }
</script>

<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'เดือน');
        data.addColumn('number', 'ครั้ง');
        data.addRows([
            ['ต.ค.', {{$amount_ebooksend_M[10]}}],
            ['พ.ย.', {{$amount_ebooksend_M[11]}}],
            ['ธ.ค.', {{$amount_ebooksend_M[12]}}],
            ['ม.ค.', {{$amount_ebooksend_M[1]}}],
            ['ก.พ.', {{$amount_ebooksend_M[2]}}],
            ['มี.ค.', {{$amount_ebooksend_M[3]}}],
            ['เม.ย.', {{$amount_ebooksend_M[4]}}],
            ['พ.ค.', {{$amount_ebooksend_M[5]}}],
            ['มิ.ย.', {{$amount_ebooksend_M[6]}}],
            ['ก.ค.', {{$amount_ebooksend_M[7]}}],
            ['ส.ค.', {{$amount_ebooksend_M[8]}}],
            ['ก.ย.', {{$amount_ebooksend_M[9]}}],
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
            colors: ['#67A63A'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            height: '100%',
            vAxis: {
                title: 'ครั้ง'
            },
            hAxis: {
                title: 'เดือน',
                fontName: 'Kanit'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('amountBook_column'));
        chart.draw(view, options);
    }
</script>


<?php
        $str = "";
        foreach ($amount_ReceiveebookUrgent_M as $value) {
            $str .= "['".implode("',",$value)."],";
        }
        ?>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เพศ', 'จำนวน'], <?php echo $str; ?>
        ]);
        var options = {
            // title: 'บุคลากรจำแนกตามเพศ',   
            height: '400',
            // colors:['#417EF0','#DF119E'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('urgentRegister_pie'));
        chart.draw(data, options);
    }
</script>
<?php
        $str = "";
        foreach ($countTypeebookreceive as $value) {
            $str .= "['".implode("',",$value)."],";
        }
        ?>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['เพศ', 'จำนวน'], <?php echo $str; ?>
        ]);
        var options = {
            // title: 'บุคลากรจำแนกตามเพศ',   
            height: '400',
            // colors:['#417EF0','#DF119E'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('typebook_pie'));
        chart.draw(data, options);
    }
</script>
@endsection