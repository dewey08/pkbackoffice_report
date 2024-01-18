@extends('layouts.elearning')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')
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



<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24"> ข้อมูลผลการทดสอบ</h3>
        </div>      
    <hr> <!-- -ขีด -->
    <div class="block-content my-3 shadow">
            <br>
            <div class="row">
                    <div class="col-md-6 col-xl-4">
                                <a class="block block-rounded block-link-pop bg-primary-light" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-book-open text-white"></i>
                                        </div>
                                        <div class="ml- text-right text-white">
                                            <p class=" mb-0 fs-20">
                                                หมวดหมู่บทเรียนทั้งหมด
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                               {{$count_lesson_group}}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                                <a class="block block-rounded block-link-pop bg-success" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-book-reader text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-20">
                                                บทเรียนทั้งหมด
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{$count_lesson}}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                                <a class="block block-rounded block-link-pop bg-warning" >
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-2x fa-grin-stars text-white"></i>
                                        </div>
                                        <div class="ml-3 text-right text-white">
                                            <p class=" mb-0 fs-20">
                                                บทเรียนที่เรียนเเล้ว
                                            </p>
                                            <p class="font-size-h3 font-w300 mb-0">
                                               {{$count_std}}
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
                     <div class="panel p-1" style="background:#E7E0C9  "> 
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">
                        ข้อมูลจำนวนบทเรียนของแต่ละหมวดหมู่
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_car"
                            style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-1" style="background:#F6D7A7">
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

        
        <div class="block-content my-3 shadow"><br><br>
        <form action="{{ route('information_report_search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2" align="right">
                    <label for="" class="fs-20">หมวดหมู่บทเรียน :</label>
                </div> 
                <div class="col-md-2 text-left" >
                    <select class="form-control" id="ID_LESSON_GROU"  name="ID_LESSON_GROU" style=" font-family: 'Kanit', sans-serif;">
                        <option> กรุณาเลือก </option>
                            @foreach ($id_lesson_group as $row)
                                @if(empty($id_lesson_group_search))
                                    <option value="{{$row->ID_LESSON_GROU}}"> {{$row->NAME_LESSON_GROUP}}</option>
                                @else
                                    @if( $row->ID_LESSON_GROU == $id_lesson_group_search)
                                        <option value="{{$row->ID_LESSON_GROU}}" selected> {{$row->NAME_LESSON_GROUP}}</option>
                                    @else
                                        <option value="{{$row->ID_LESSON_GROU}}"> {{$row->NAME_LESSON_GROUP}}</option>
                                    @endif
                                @endif
                            @endforeach
                    </select>
                </div> 
                <div class="col-md-1" align="left">
                    <button type="submit" class="btn btn-info fw-5 f-kanit loadscreen">แสดง</button>
                </div> 
            </div><br>
            </form>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full text-center">
                                <thead class=" table-warning">
                                        <tr>
                                            <th width="5%"><span style="font-size: 16px;">ลำดับ</span></th>
                                            <th><span style="font-size: 16px;">ชื่อผู้เรียน</span></th>
                                            <th><span style="font-size: 16px;">ชื่อบทเรียน</span></th>
                                            <th width="13%"><span style="font-size: 16px;">คะเเนนก่อนเรียน</span></th>
                                            <th width="13%"><span style="font-size: 16px;">คะเเนนหลังเรียน</span></th>
                                            <th class="d-none d-sm-table-cell" style="width: 5%;"><span style="font-size: 16px;">สถานะ</span></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0;$i = 0; $j = 0;?>
                                @foreach ($info_sum_score as $row)
                                <?php $number++; ?>
                                        <tr>
                                            <td class=""><span style="font-size: 16px;">{{$number}}</span></td>
                                            <td class="" align="left"><span style="font-size: 16px;">{{$row->name}}</span></td>
                                            <td class="" align="left"><span style="font-size: 16px;">{{$row->NAME_LESSON}}</span></td>
                                            <td><span style="font-size: 16px;">{{$data[$i]}}</span></td>
                                            <td><span style="font-size: 16px;">{{$data2[$j]}}</span></td>
                                            <td class="d-none d-md-table-cell ะำปะ" ><h5><span class="badge badge-success">ผ่าน</span></h5></td>
                                        </tr> 
                                        <?php $i++; $j++;?>
                                @endforeach
                                </tbody>
                </table><br>
                </div>
            </div>
        </div>    

    </div>
</div>

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
          ['บทเรียนทั้งหมด',   <?php echo  $count_lesson;?>]

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
            0: { color: '#71DFE7' },
            1: { color: '#009DAE' },

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
          ['ชื่อหมวดหมู่','จำนวนบทเรียน'],
          <?php $i=0;  $j=0; ?>
          @foreach($count_chart as $row_name)
          ['<?php echo $name[$i];?>',<?php echo $data_count[$i];?>],
          <?php $i++;  $j++; ?>   
            @endforeach 
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
            height: '100%',
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "40%"
            },
            vAxis: {
                title: 'จำนวนบทเรียน',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'ชื่อหมวดหมู่บทเรียน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            },
            colors: ['#C1CFC0'],
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_car'));
        chart.draw(view, options);
    }
</script>



@endsection


@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
 <script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>

@endsection