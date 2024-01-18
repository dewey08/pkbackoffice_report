@extends('layouts.person')
@section('css_before')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }

    .text {
        font-family: 'Kanit', sans-serif;
    }
    .google-visualization-table-tr-head{
        background:#FDDC22;
    }
    .google-visualization-table-tr-even:hover ,.google-visualization-table-tr-odd:hover{
        background:#FFF9DC !important;
    }
    .table-cont {
        /**make table can scroll**/
        max-height: 300px;
        overflow: auto;
        /** add some style**/
        /*padding: 2px;*/
        background: #ddd;
        margin: 20px 10px;
        box-shadow: 0 0 1px 3px #ddd;
    }

    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }
    thead.header-group th{
        border:1px solid #000;
    }
    .group-row:hover{
        background:#E2E6FD !important;
    }
    .department_sub_row:hover{
        background:#FFFFDB !important;
    }
    .department_sub_sub_row:hover{
        background:#FFE2DC !important;
    }
</style>
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

    function Removeformatetime($strtime)
    {
        $H = substr($strtime, 0, 5);
        return $H;
    }
?>
<center>
    <div class="block shadow" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title fs-24">ข้อมูลบุคลากร</h3>
            </div>
            <hr>
            <div class="block-content shadow mb-4 mt-2">       
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-left fs-18 fw-5">ข้อมูลบุคลากรแยกจำนวนตามสถานะการทำงาน</h6>
                    </div>
                    <div class="col-12">
                        <div class="block radius-5 bg-sl-b3">
                            <div
                                class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-4 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count_total}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0 pt-2">รวมทั้งหมด (ทำงาน , ลาศึกษา , ช่วยราชการ , พักราชการ)</p>
                                </div>
                                <div class="text-white mr-3">
                                    <i class="m-0 fa fa-2x fa fa-users text-white pt-3 pb-4" ></i> <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <a class="block block-rounded block-link-pop bg-sl-g2"
                        href="{{route('mperson-dash-nw')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[1]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ทำงานปกติ</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-friends text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-6 col-md-4 col-lg-6 col-xl-3">
                        <a class="block block-rounded block-link-pop bg-sl-o2" 
                        href="{{route('mperson-dash-sl')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[2]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ลาศึกษาต่อ</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-graduate text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-3">
                        <a class="block block-rounded block-link-pop bg-sl-gb3"
                        href="{{route('mperson-dash-hgo')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[3]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ช่วยราชการ</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-tie text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a class="block block-rounded block-link-pop bg-sl-r4"
                        href="{{route('mperson-dash-sis')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[4]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">พักราชการ</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-lock text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a class="block block-rounded block-link-pop bg-sl-r2"
                        href="{{route('mperson-dash-res')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[5]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ลาออกแล้ว</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-minus text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a class="block block-rounded block-link-pop bg-sl-r3"
                        href="{{route('mperson-dash-go')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[6]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ให้ออก</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-times text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a class="block block-rounded block-link-pop bg-sl-y3"
                        href="{{route('mperson-dash-mo')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[7]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">ย้าย</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-tag text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <a class="block block-rounded block-link-pop bg-sl-p3"
                        href="{{route('mperson-dash-ret')}}">
                            <div
                                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                                <div class="ml-3 text-left">
                                    <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$person_status_count[8]}} <span class="text-font">คน</span>
                                    </p>
                                    <p class="text-white m-0">เกษียณ</p>
                                </div>
                                <div class="text-white">
                                    <i class="fa fa-2x fa fa-user-shield text-white pt-3 pb-4"></i><br>
                                    <p class="m-0">อ่านเพิ่มเติม  <i class="fa fa-angle-double-right"></i></p> 
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <hr>
                <h6 class="text-left mb-2">แผนภาพบุคลากรจำแนกตามลักษณะต่าง ๆ</h6>
                <div class="row mb-3">
                    <div class="col-xl-12 mb-4" style="overflow-y:hidden">
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading py-3 text-left text-white pl-5 ">จำนวนบุคลากรตามวิชาชีพ</div>
                            <div class="panel-body bg-white">
                                <div id="departments_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height:500px">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6 mb-2 text-white" >
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading py-2 text-left pl-5">บุคลากรจำแนกตามประเภท</div>
                            <div class="panel-body bg-white" style="overflow-y:hidden">
                                <div id="kind_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height:400px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading text-white py-2 text-left pl-5">บุคลากรจำแนกตามเพศ</div>
                            <div class="panel-body bg-white" style="overflow-y:hidden">
                                <div id="sex_chart" style="font-family: 'Kanit', sans-serif;width: 100%; height:400px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content shadow mb-4">
            <div class="row">
            <div class="col-md-12 mb-4">
                <h6 class="f-u fs-16 fw-5 text-left mb-2">กลุ่มงาน</h6>
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading text-white py-2 text-left pl-5">ข้อมูลจำนวนบุคลากร แยกตามกลุ่มงาน และประเภทบุคลากร</div>
                            <div class="panel-body bg-white" style="overflow-y:hidden">
                            <table class="table table-striped mb-0">
                            <thead class="header-group bg-sl-b1" >
                                <tr>
                                    @foreach($person_Bydepartment['header'] as $value)
                                    <th class="py-2">{{$value}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                    <?php //unset($person_Bydepartment['header']);?>
                                    @foreach($person_Bydepartment as $key => $row)
                                    <?php 
                                    if($key == 'header'){
                                        continue;
                                    }
                                    $i = 1;
                                    ?>
                                    <tr class="group-row " data-id="{{$row['type_id']}}" onclick="showdepartment_sub(this)" style="cursor:pointer">
                                        @foreach($row as $key => $col)
                                        <?php 
                                        if($key == 'type_id'){
                                            continue;
                                        }
                                        if($i == 1){?>
                                            <td class="py-1">{{$col}}</td>
                                        <?php    $i++;
                                        }else{ ?>
                                            <td class="py-1 text-center">{{$col}}</td>
                                        <?php } ?>
                                        @endforeach
                                    </tr>
                                    @endforeach
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
            <div class="col-md-12 mb-4">
                <h6 class="f-u fs-16 fw-5 text-left mb-2">ฝ่าย/แผนก</h6>
                <div class="content-department">
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading text-white py-2 text-left pl-5">ข้อมูลจำนวนบุคลากร แยกตามฝ่าย/แผนก และประเภทบุคลากร</div>
                            <div class="panel-body bg-white" id="department-sub" style="overflow-y:hidden">
                            <div class="text-center">
                                ไม่มีข้อมูล
                            </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <h6 class="f-u fs-16 fw-5 text-left mb-2">หน่วยงาน</h6>
                <div class="content-department_sub">
                        <div class="panel p-1 bg-sl-blue">
                            <div class="panel-heading text-white py-2 text-left pl-5">ข้อมูลจำนวนบุคลากร แยกตามหน่วยงาน และประเภทบุคลากร</div>
                            <div class="panel-body bg-white" id="department-sub-sub" style="overflow-y:hidden">
                            <div class="text-center">
                                ไม่มีข้อมูล
                            </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    </div>
    <!-- END Page Container -->

    @endsection

@section('footer')

<script type="text/javascript">
    var token = "{{csrf_token()}}"
    function showdepartment_sub(department_id){
        $.ajax({
            url: "{{url('manager_person/dashboard/ajax_getdepartment_sub_by_emptype')}}", 
            method :"post",
            data :{
                department_id : department_id.getAttribute("data-id"),
                _token : token
            },
            success: function(result){
                // console.log(result);
                $('#department-sub').html(result);
            },
            error: function(result){
                console.log('error');
            }
        });
    }
    function showdepartment_sub_sub(department_sub_id){
        $.ajax({
            url: "{{url('manager_person/dashboard/ajax_getdepartment_sub_sub_by_emptype')}}", 
            method :"post",
            data :{
                department_sub_id : department_sub_id.getAttribute("data-id"),
                _token : token
            },
            success: function(result){
                $('#department-sub-sub').html(result);
            },
            error: function(result){
                console.log('error');
            }
        });
    }

</script>
    <!-- กลุ่มงาน -->
<script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'ตำแหน่ง');
            data.addColumn('number', 'จำนวน');
            data.addRows([
                ['นายแพทย์', {{$person_position_count[24]}}], //24
                ['ทันตแพทย์', {{$person_position_count[21]}}],  //21
                ['เภสัชกร', {{$person_position_count[26]}}],  //26
                ['พยาบาลวิชาชีพ', {{$person_position_count[23]}}], //23
                ['นักเทคนิคการแพทย์', {{$person_position_count[22]}}],  //22
                ['นักกายภาพบำบัด', {{$person_position_count[17]}}], //17
                ['นักวิชาการสาธารณสุข', {{$person_position_count[30]}}], //30
                ['นักวิชาการคอมพิวเตอร์', {{$person_position_count[7]}}], //7
                ['นักรังสีการแพทย์', {{$person_position_count[28]}}], //28
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
                fontName:'Kanit',
                fontSize:16,
                width: "100%",
                colors:['#F67A37'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "40%"
                },
                height: '90%',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'ตำแหน่ง',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('departments_chart'));
            chart.draw(view, options);
        }
    </script>
<!-- กลุ่มข้าราชการ วงกลม-->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ประเภทบุคคล', 'จำนวน'],
          ['ข้าราชการ', {{$person_type_count[1]}}],
          ['อื่น ๆ', {{$person_type_count[2]}}]
        ]);
        var options = {
                // title: 'บุคลากรจำแนกตามประเภท',
                height:'400',
                colors:['#3783D9','#E47119'],
                fontSize:16,
                legend: { position: "top" , alignment:"center" },
                fontName: 'Kanit',
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('kind_chart'));
            chart.draw(data, options);
      }
    </script>
<!-- เพศ -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เพศ', 'จำนวน'],
          ['ชาย', {{$person_sex_count['M']}}],
          ['หญิง', {{$person_sex_count['F']}}],
        ]);
        var options = {
                // title: 'บุคลากรจำแนกตามเพศ',   
                height:'400',
                // colors:['#417EF0','#DF119E'],
                fontSize:16,
                legend: { position: "top" , alignment:"center"},
                fontName: 'Kanit',
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('sex_chart'));
            chart.draw(data, options);
      }
</script>
<!-- ตารางข้อมูลบุคลากร -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      function drawTable() {
          
        var data = new google.visualization.DataTable();
        <?php foreach($person_Bydepartment['header'] as $value){
            echo "data.addColumn('string', '".$value."');";
        }
        $result = '';
        foreach($person_Bydepartment as $key => $row) {
            if($key == 'header'){
                continue;
            }
            $result .= '["'.implode('","',$row).'"],';

        
        }
        ?>
        data.addRows([<?=$result?>])
        var option = {
            showRowNumber: true,  
            width: '100%', 
            height: '100%',
        }
        var table = new google.visualization.Table(document.getElementById('person_Bydepartment_table'));
        table.draw(data, option);
      }
    </script>
@endsection
