@extends('layouts.asset')

@section('css_before')

<?php
    $status  = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url     = Request::url();
    $pos     = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);


    $m_budget = date("m");

    if ($m_budget > 9) {
        $yearbudget = date("Y") + 544;
    } else {
        $yearbudget = date("Y") + 543;
    }
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
<!-- Advanced Tables -->
@endsection
@section('content')
<div class="d-flex justify-content-center">
    <div class="block" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title fs-24 text-center">มูลค่าทรัพย์สิน</h3>
            </div>
            <hr>
            <form action=" {{ route('massete.dashboard') }}" method="get">
                <div class="row">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        &nbsp;ประจำปีงบประมาณ : &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="budgetyear" id="budgetyear" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgetyear_dropdown as $key => $budget)
                                    @if($budget == $budgetyear)
                                    <option value="{{$key}}" selected>{{$budget}}</option>
                                    @else
                                    <option value="{{$key}}">{{$budget}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info fw-5">แสดง</button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="block-content shadow my-3">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-rounded block-link-pop bg-sl-o2 text-white" style="cursor:pointer" onclick="durable_search()">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-left">มูลค่าครุภัณฑ์ {{number_format($durable_data->amount)}} รายการ</p>
                                    <p class="m-0 fs-26">{{number_format($durable_data->total_price,2)}} <span class="fs-12">บาท</span></p>
                                </div>
                                <div class="right">
                                    <i class="fa fa-2x fa fa-laptop-medical text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-rounded block-link-pop bg-sl-g2 text-white" style="cursor:pointer" onclick="buiding_search()">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-left">มูลค่าสิ่งก่อสร้าง {{number_format($building_data->amount)}} รายการ</p>
                                    <p class="m-0 fs-26">{{number_format($building_data->total_price,2)}} <span class="fs-12">บาท</span></p>
                                </div>
                                <div class="right">
                                    <i class="fa fa-2x fa fa-hospital-alt text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-rounded block-link-pop bg-sl-gb2 text-white" style="cursor:pointer" onclick="buiding_durable_search()">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="left">
                                    <p class="m-0 fs-16 text-left">มูลค่าครุภัณฑ์และสิ่งก่อสร้างทั้งหมด {{number_format($building_data->amount+$durable_data->amount)}} รายการ</p>
                                    <p class="m-0 fs-26">{{number_format($building_data->total_price + $durable_data->total_price,2)}} <span class="fs-12">บาท</span></p>
                                </div>
                                <div class="right">
                                    <i class="fa fa-2x fa fa-money-bill-alt text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-centent my-3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block-content shadow row">
                            <div class="col-12">
                                <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิงานทรัพย์สิน</h3>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="card p-1 bg-sl-blue text-white">
                                    <div class="card-head px-3 py-2 fs-16">
                                        มูลค่าครุภัณฑ์ (ย้อนหลัง 5 ปี)
                                    </div>
                                    <div class="card-body bg-white" style="overflow-y:hidden">
                                        <div id="durable_column" style="width: 100%; height: 550px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="card p-1 bg-sl-blue text-white">
                                    <div class="card-head px-3 py-2 fs-16">
                                        ร้อยละของรายการครุภัณฑ์ และสิ่งก่อสร้าง (ย้อนหลัง 5 ปี)
                                    </div>
                                    <div class="card-body bg-white" style="overflow-y:hidden">
                                        <div id="perasset_curcle" style="width: 100%; height: 450px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="block-content shadow">
                        <?php 
                            $bgcolor = array(
                                0 => 'bg-sl-b2',
                                1 => 'bg-sl-g2',
                                2 => 'bg-sl-gb3',
                                3 => 'bg-sl-p2',
                                4 => 'bg-sl-y3',
                                5 => 'bg-sl-r2'
                            );

                            $i = 0;
                        ?>
                            @foreach($supplies_budget as $row)
                            <?php if($i == 6){$i = 0;} ?>
                            <a  style="cursor:pointer" onclick="durable_search_budget({{$row['budget_id']}})" class="block block-rounded block-link-pop {{$bgcolor[$i++]}}">
                                <div
                                    class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        <i class="fa fa-2x fa fa-hand-holding-usd text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                            {{number_format($row['total_price'],2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                            {{$row['budget_name']}}
                                        </p>
                                    </div>

                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content shadow my-3">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                ข้อมูลครุภัณฑ์ (ย้อนหลัง 10 ปี)
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="durable_line" class="p-5 py-2" style="width: 100%; height: 550px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="card p-1 bg-sl-blue text-white">
                            <div class="card-head px-3 py-2 fs-16">
                                ข้อมูลสิ่งก่อสร้าง (ย้อนหลัง 10 ปี)
                            </div>
                            <div class="card-body bg-white" style="overflow-y:hidden">
                                <div id="buiding_line" class="p-5 py-2" style="width: 100%; height: 550px;"></div>
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
<!-- ajax -->
<script>
    var year_ad = $('#budgetyear').val();
    function durable_search() {
        window.location="{{url('manager_asset/durable_search')}}?"+"year="+year_ad;
    }
    function durable_search_budget(id) {
        window.location="{{url('manager_asset/durable_search')}}?"+"year="+year_ad+"&budget="+id;
    }
    function buiding_search() {
        window.location="{{url('manager_asset/buiding_search')}}?"+"year="+year_ad;
    }
    function buiding_durable_search() {
        window.location="{{url('manager_asset/durable_buiding_search')}}?"+"year="+year_ad;
    }

</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    <?php 
            $str_5year  = '';
            foreach($asset_5year as $row){
                $str_5year .= "['".$row['year']."',".$row['total_durable']."],";
            }

    ?>
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['ปีงบประมาณ ','มูลค่าครุภัณฑ์'],
            <?=$str_5year?>
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
            width: "100%",
            height: '100%',
            colors: ['#F67A37','#9BD770'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "65%"
            },
            vAxis: {
                title: 'บาท'
            },
            hAxis: {
                title: 'ปีงบประมาณ',
                fontName: 'Kanit'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('durable_column'));
        chart.draw(view, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['ประเภททรัพย์สิน', 'จำนวนร้อยละ'],
            ['ครุภัณฑ์', <?php echo $total_durable; ?> ],
            ['สิ่งก่อสร้าง', <?php echo $total_building; ?> ],
        ]);
        
        var options = {
            // title: '......',   
            height: '500',
            colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('perasset_curcle'));
        chart.draw(data, options);
    }
</script>
<script>
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable(<?php echo $durable_10year;?>);
      var options = {
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
      var chart = new google.charts.Line(document.getElementById('durable_line'));
      chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<script>
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable(<?php echo $building_10year;?>);
      var options = {
            // title: '........',   
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
      var chart = new google.charts.Line(document.getElementById('buiding_line'));
      chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
@endsection