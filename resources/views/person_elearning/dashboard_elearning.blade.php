@extends('layouts.elearning')
<style>
    body * {
        font-family: 'Kanit', sans-serif;
    }
    p {
        word-wrap: break-word;
    }
    .text {
        font-family: 'Kanit', sans-serif;
    }
</style>
@section('content')
<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">ข้อมูล E-Learning</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow">
            <br>
            <div class="row">
                    <div class="col-md-6 col-xl-3">
                                <a class="block block-rounded block-link-pop bg-primary-light" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-book-open text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-16">
                                                บทเรียนทั้งหมด
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                               {{$id_lesson}}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                                <a class="block block-rounded block-link-pop bg-success" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-book-reader text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-16">
                                                บทเรียนที่เรียนเเล้ว
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{$count_std}}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                                <a class="block block-rounded block-link-pop bg-warning" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-grin-stars text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-16">
                                                บทเรียนที่สอบผ่าน
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                                0
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-6 col-xl-3">
                                <a class="block block-rounded block-link-pop bg-danger" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-frown text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-16">
                                                บทเรียนที่สอบไม่ผ่าน
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                                0
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
            </div>
        </div>    

        <div class="block block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิบทเรียน</h3>
            <div class="row mb-2">
            <div class="col-md-6 mb-2">
                    <div class="panel p-1" style="background:#F3C892">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                        ข้อมูลคะเเนนของแต่ละบทเรียน
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_car"
                            style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1" style="background:#C7B198">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                        ข้อมูลการเข้าเรียน
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="piechart"
                            style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>








<!-- chart -->

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>
<script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_piechart);

      function drawChart_piechart() {

        var data_piechart = google.visualization.arrayToDataTable([
          ['บทเรียน', 'สถานะ'],
          ['บทเรียนที่เรียนเเล้ว',    <?php echo  $count_std;?>],
          ['บทเรียนทั้งหมด',   <?php echo  $id_lesson;?>]

        ]);

        var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            legend: {
                position: 'center'
            },
            slices: {
            0: { color: '#F9D371' },
            1: { color: '#F47340' },

          },
          title: ''
        };

        var chart_piechart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart_piechart.draw(data_piechart, options);
      }

</script>
<script src="{{ asset('google/Charts.js') }}"></script>
<script>
  google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['บทเรียน','คะแนนที่ได้'],
            <?php $i=0;  $j=0; ?>
            @foreach($info_sum_score as $row_name)

            ['<?php echo $name[$i];?>',<?php echo $data[$j];?>],
            
            <?php $i++;  $j++; ?>   
            @endforeach 
        ]);


        console.log(data);
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
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "50%"
            },
            vAxis: {
                title: 'คะเเนนที่ได้',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'หมวดหมู่บทเรียน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            },
            colors: ['#B05E27'],
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_car'));
        chart.draw(view, options);
    }
</script>



       


@endsection

@section('footer')

@endsection