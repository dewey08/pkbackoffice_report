@extends('layouts.meet')
@section('css_before')

<?php
  use App\Http\Controllers\Report\MeetReportController;
  $status = Auth::user()->status; 
  $id_user = Auth::user()->PERSON_ID; 
  $url = Request::url();
  $pos = strrpos($url, '/') + 1;
  $user_id = substr($url, $pos); 
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
<div class="d-flex justify-content-center ">
  <div class="block shadow" style="width: 95%;">
    <div class="block-content">
      <div class="block-header block-header-default">
        <h3 class="block-title text-center text fs-24"><B>ข้อมูลห้องประชุม</B></h3>
      </div>
      <hr>
      <div class="block-content shadow mb-2">
        <div class="row mb-3 ">
          <div class="col-12">
            <h3 class="fs-18 fw-1 f-kanit">ข้อมูลการขอใช้งานห้องประชุมโดยรวม</h3>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="block bg-sl2-s3 text-white px-4 py-2 radius-5">
              <div class="block-content p-2 d-flex justify-content-between">
                <div class="left">
                  <p class="m-0 fs-16">จำนวนการใช้บริการรวม <span class="fs-24 fw-8">วันนี้</span></p>
                  <p class="m-0 fs-26">{{$serviceroom_today}} <span class="fs-12">ครั้ง</span></p>
                </div>
                <div class="right">
                  <div class="fs-30 fa fa-calendar-day"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="block bg-sl2-g3 text-white px-4 py-2 radius-5">
              <div class="block-content p-2 d-flex justify-content-between">
                <div class="left">
                  <p class="m-0 fs-16">จำนวนการใช้บริการรวม <span class="fs-24 fw-8">เดือนนี้</span></p>
                  <p class="m-0 fs-26">{{$serviceroom_month}} <span class="fs-12">ครั้ง</span></p>
                </div>
                <div class="right">
                  <div class="fs-30 fa fa-calendar-alt"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="block bg-sl2-r3 text-white px-4 py-2 radius-5">
              <div class="block-content p-2 d-flex justify-content-between">
                <div class="left">
                  <p class="m-0 fs-16">จำนวนการใช้บริการรวม <span class="fs-24 fw-8">ปีนี้</span></p>
                  <p class="m-0 fs-26">{{$serviceroom_year}} <span class="fs-12">ครั้ง</span></p>
                </div>
                <div class="right">
                  <div class="fs-30 far fa-calendar-alt"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="block bg-sl2-y3 text-white px-4 py-2 radius-5">
              <div class="block-content p-2 d-flex justify-content-between">
                <div class="left">
                  <p class="m-0 fs-16">อัตราการอนุมัติต่อการขอใช้ทั้งหมด <span class="fs-24 fw-8"></span></p>
                  <p class="m-0 fs-26">{{$serviceroom_percent}} %</p>
                </div>
                <div class="right">
                  <div class="fs-30 fa fa-percentage"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <h3 class="fs-18 fw-1 f-kanit">ข้อมูลการใช้งานห้องประชุม</h3>
          </div>
          <div class="col-xl-6 mb-2">
            <div class="card p-1 bg-sl2-s3 text-white">
              <div class="card-header px-3 py-2">
                รายการประชุมวันนี้ ( วันที่ {{DateThai(date('Y-m-d'))}} )
              </div>
              <div class="card-body bg-white">
                <table class="table table-striped table-bordered mb-0">
                  <tr class="text-center" style="background:#dcdcdc;">
                    <th width="110px">ห้องประชุม</th>
                    <th>รายการ</th>
                    <th width="150px">วันที่ และเวลา</th>
                    <th width="80px">สถานะ</th>
                  </tr>
                  @foreach($service_day as $row)
                  <?php
                    if($row->STATUS == 'SUCCESS'){
                    $color = 'info'; 
                    $text = "จัดสรร";
                    }elseif ($row->STATUS == 'REQUEST') {
                        $color = 'warning';
                        $text = "ร้องขอ";
                    }elseif ($row->STATUS == 'LASTAPP') {
                        $color = 'success';
                        $text = "อนุมัติ";
                    }
                  ?>
                  <tr>
                    <td>{{$row->ROOM_NAME}}</td>
                    <td>{{$row->SERVICE_STORY}}</td>
                    <td class="text-center p-1">{{DateThai(date('Y-m-d',strtotime($row->DATE_BEGIN)))}} <br>
                    {{date('H:i',strtotime($row->TIME_BEGIN))}}-{{date('H:i',strtotime($row->TIME_END))}} น.</td>
                    <td class="text-center"><span class="badge badge-{{$color}}">{{$text}}</span></td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mb-2">
            <div class="card p-1 bg-sl2-b3 text-white">
              <div class="card-header px-3 py-2">
              รายการประชุมวันพรุ่งนี้ ( วันที่ {{DateThai(date('Y-m-d',strtotime('1 Day')))}}  )
              </div>
              <div class="card-body bg-white">
                <table class="table table-striped table-bordered mb-0">
                  <tr class="text-center" style="background:#dcdcdc;">
                    <th width="110px">ห้องประชุม</th>
                    <th>รายการ</th>
                    <th width="150px">วันที่ และเวลา</th>
                    <th width="80px">สถานะ</th>
                  </tr>
                  @foreach($service_tomorrow as $row)
                  <?php
                    if($row->STATUS == 'SUCCESS'){
                    $color = 'info'; 
                    $text = "จัดสรร";
                    }elseif ($row->STATUS == 'REQUEST') {
                        $color = 'warning';
                        $text = "ร้องขอ";
                    }elseif ($row->STATUS == 'LASTAPP') {
                        $color = 'success';
                        $text = "อนุมัติ";
                    }
                  ?>
                  <tr>
                    <td>{{$row->ROOM_NAME}}</td>
                    <td>{{$row->SERVICE_STORY}}</td>
                    <td class="text-center p-1">{{DateThai(date('Y-m-d',strtotime($row->DATE_BEGIN)))}} <br>
                    {{date('H:i',strtotime($row->TIME_BEGIN))}}-{{date('H:i',strtotime($row->TIME_END))}} น.</td>
                    <td class="text-center"><span class="badge badge-{{$color}}">{{$text}}</span></td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <form action="{{ url('manager_meet/dashboard_meet') }}" method="get">
        <!-- @csrf -->
        <div class="row">
          <div class="col-md-2 d-flex justify-content-center align-items-center">
            &nbsp;ประจำปีงบประมาณ : &nbsp;
          </div>
          <div class="col-md-2">
            <select name="yearbudget_select" id="STATUS_CODE" class="form-control input-lg"
              style=" font-family: 'Kanit', sans-serif;">
              @foreach($year_ as $year)
              @if($year == $yearbudget_select )
              <option value="{{$year}}" selected>พ.ศ. {{$year}}</option>
              @else
              <option value="{{$year}}">พ.ศ. {{$year}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-1">
            <span>
              <button type="submit" class="f-kanit btn btn-hero-sm btn-hero-info">แสดง</button>
            </span>
          </div>
        </div>
      </form>
      <br>
      <div class="block-content shadow mb-4">
        <h3 class="f-kanit fw-1 fs-18">ข้อมูลการใช้บริการแยกรายห้อง (เฉพาะมีการอนุมัติ และดำเนินการเสร็จสิ้นแล้วเท่านั้น)</h3>
        <div class="row  mb-3">
          @foreach ($roomservices as $roomservice)
          <div class="col-xl-3 col-md-6">
            <a class="block block-rounded block-link-pop bg-win8-teal" style="background:{{$roomservice->ROOM_COLOR}}" href="{{url('manager_meet/meetcalendar?meetroom=').$roomservice->ROOM_ID.'&meetname='.$roomservice->ROOM_NAME}}">
              <div
                class="block-content block-content-full d-flex align-items-top justify-content-between p-2 pb-3 pt-0 ">
                <div class="ml-3 text-left">
                  <p class="text-white mb-0 fs-30">
                    {{$roomservice->ROOM_NAME}}
                  </p>
                  <p class="text-white m-0">ใช้บริการ
                    {{MeetReportController::count_meeting($yearbudget_select,$roomservice->ROOM_ID)}} ครั้ง</p>
                </div>
                <div class="text-white text-center">
                  <i class="fa fa-2x fa fa-calendar-plus text-white pt-3 pb-4 pr-2"></i><br>
                  <p class="m-0 fs-13">อ่านเพิ่มเติม <i class="fa fa-angle-double-right"></i></p>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      <hr>
      <div class="block-content mb-2">
        <h6 class="f-kanit fs-18 fw-1">ข้อมูลแผนภูมิภาพการใช้บริการห้องประชุม</h6>
        <div class="row mb-4">
          <div class="col-xl-6 table-responsive mb-2">
            <div class="panel p-1 bg-sl-blue">
              <div class="panel-header py-2 pl-3 text-white">
                การใช้บริการห้องประชุมแยกเป็นรายเดือน (จำแนกตามวันอนุมัติ)
              </div>
              <div class="panel-body bg-white">
                <div id="roomservice_column_chart" style="width: 100%; height: 550px;"></div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 table-responsive mb-2">
            <div class="panel p-1 bg-sl-blue">
              <div class="panel-header py-2 pl-3 text-white">
                การใช้บริการห้องประชุมแยกเป็นห้อง (จำแนกตามวันอนุมัติ)
              </div>
              <div class="panel-body bg-white">
                <div id="roomservice2_pie_chart" style="width: 100%; height: 550px;"></div>
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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ประเภทบุคคล', 'จำนวน'],
          <?php 
          if(!empty($rooms)){  ?>
            @foreach($rooms as $value)
              ['{{$value['name']}}', {{$value['amount']}}],
            @endforeach
            <?php } ?>
        ]);
        var options = {
                // title: 'บุคลากรจำแนกตามประเภท',
                // colors:['#3783D9','#E47119'],
                fontSize:16,
                legend: { position: "top" , alignment:"center" },
                fontName: 'Kanit',
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('roomservice2_pie_chart'));
            chart.draw(data, options);
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
                ['ต.ค.',<?php echo $meetingservice_m[10] ; ?>],
                ['พ.ย.',<?php echo $meetingservice_m[11] ; ?>],
                ['ธ.ค.',<?php echo $meetingservice_m[12] ; ?>],
                ['ม.ค.',<?php echo $meetingservice_m[1] ; ?>],
                ['ก.พ.',<?php echo $meetingservice_m[2] ;?>],
                ['มี.ค.',<?php echo $meetingservice_m[3] ; ?>],
                ['เม.ย.',<?php echo $meetingservice_m[4] ; ?>],
                ['พ.ค.',<?php echo $meetingservice_m[5] ; ?>],
                ['มิ.ย.',<?php echo $meetingservice_m[6] ; ?>],
                ['ก.ค.',<?php echo $meetingservice_m[7] ; ?>],
                ['ส.ค.',<?php echo $meetingservice_m[8] ; ?>],
                ['ก.ย.',<?php echo $meetingservice_m[9] ; ?>],
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
                    groupWidth: "80%"
                },
                height: '100%',
                vAxis: {
                    title: 'ครั้ง'
                },
                hAxis: {
                    title: 'เดือน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('roomservice_column_chart'));
            chart.draw(view, options);
        }
    </script>

@endsection