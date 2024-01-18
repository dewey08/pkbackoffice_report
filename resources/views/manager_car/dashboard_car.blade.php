@extends('layouts.car')

@section('css_before')
<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 
?>
@endsection
@section('content')
<div class="block mb-4" style="width: 95%;margin:auto">
  <div class="block-content">
    <div class="block-header block-header-default">
      <h3 class="block-title text-center fs-24 f-kanit">ข้อมูลการใช้ยานพาหนะ</h3>
    </div>
    <hr>
    <form action="{{ url('manager_car/dashboard') }}" method="get">
      <div class="row">
        <div class="col-md-2 d-flex justify-content-center align-items-center">
          &nbsp;ประจำปีงบประมาณ : &nbsp;
        </div>
        <div class="col-md-2">
          <span>
            <select name="budgetyear" id="budgetyear" class="form-control input-lg"
              style=" font-family: 'Kanit', sans-serif;">
              @foreach ($budgetyear_dropdown as $budget)
              @if($budget == $budgetyear)
              <option value="{{$budget}}" selected>{{ $budget}}
              </option>
              @else
              <option value="{{$budget}}">{{$budget}}</option>
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
    <div class="block-content shadow my-3">
      <div class="row">
        <div class="col-md-4 col-xl-3">
          <div class="block block-rounded block-link-pop- bg-sl2-sb3">
            <div class="block-content block-content-full d-flex justify-content-between">
              <div class="ml-2 left">
                <p class="text-white mb-0 fs-16">
                  ทั่วไป
                </p>
                <p class="text-white mb-0" style="font-size: 2.25rem;">
                  {{$amount_carreserve}} <span class="fs-13">ครั้ง</span>
                </p>
              </div>
              <div class="mr-2 right d-flex justify-content-center align-items-top">
                <i class="fa fa-truck fs-30 text-white"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xl-3">
          <div class="block block-rounded block-link-pop- bg-sl2-r4">
            <div class="block-content block-content-full d-flex justify-content-between">
              <div class="ml-2 left">
                <p class="text-white mb-0 fs-16">
                  REFER
                </p>
                <p class="text-white mb-0" style="font-size: 2.25rem;">
                  {{$amount_refer}} <span class="fs-13">ครั้ง</span>
                </p>
              </div>
              <div class="mr-2 right d-flex justify-content-center align-items-top">
                <i class="fa fa-truck fs-30 text-white"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xl-3">
          <div class="block block-rounded block-link-pop- bg-sl2-y4">
            <div class="block-content block-content-full d-flex justify-content-between">
              <div class="ml-2 left">
                <p class="text-white mb-0 fs-16">
                  EMS
                </p>
                <p class="text-white mb-0" style="font-size: 2.25rem;">
                  {{$amount_ems}} <span class="fs-13">ครั้ง</span>
                </p>
              </div>
              <div class="mr-2 right d-flex justify-content-center align-items-top">
                <i class="fa fa-truck fs-30 text-white"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xl-3">
          <div class="block block-rounded block-link-pop- bg-sl2-g4">
            <div class="block-content block-content-full d-flex justify-content-between">
              <div class="ml-2 left">
                <p class="text-white mb-0 fs-16">
                  รับ-ส่ง
                </p>
                <p class="text-white mb-0" style="font-size: 2.25rem;">
                  {{$amount_transfer}} <span class="fs-13">ครั้ง</span>
                </p>
              </div>
              <div class="mr-2 right d-flex justify-content-center align-items-top">
                <i class="fa fa-truck fs-30 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="block-content shadow my-3">
    <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิข้อมูลการใช้ยานพาหนะ</h3>
    <hr>
      <div class="row">
        <div class="col-md-12 mb-2">
          <div class="panel p-1 bg-sl-b2">
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการใช้งานรถทั่วไป</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="columnchart_car" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-2">
          <div class="panel p-1 bg-sl-r2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนการใช้งานรถฉุกเฉิน</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="columnchart_refer" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-2">
          <div class="panel p-1 bg-sl-b2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการทำงานของพนักงานขับรถทั่วไป</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="piechart_3d_1" style="width: 100%; height: 500px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-2">
          <div class="panel p-1 bg-sl-r2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">อัตราการทำงานของพนักงานขับรถฉุกเฉิน</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="piechart_3d_2" style="width: 100%; height: 500px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-2">
          <div class="panel p-1 bg-sl-b2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">การขอใช้งานรถทั่วไปของหน่วยงานต่าง ๆ 10 อันดับ</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="barchart_unit" style="font-family: 'Kanit', sans-serif;width: 100%; height: 550px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-2">
          <div class="panel p-1 bg-sl-b2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">รถที่มีการใช้งานบ่อย</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="ReserveUseTop_column" style="font-family: 'Kanit', sans-serif;width: 100%; height: 550px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-2">
          <div class="panel p-1 bg-sl-b2" >
            <div class="pane-heading py-2 px-3 text-white" style="text-align:left">ค่าใช้จ่ายยานพาหนะแยกรายเดือน</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
              <div id="money_M_column" style="font-family: 'Kanit', sans-serif;width: 100%; height: 550px;"></div>
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
<script src="{{ asset('google/Charts.js?v='.time()) }}"></script>
<script type="text/javascript">
    google.load("visualization", "current", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($ReserveUseTop)?>);
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
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนการใช้งาน',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'ทะเบียน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('ReserveUseTop_column'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เดือน','ค่าใช้จ่าย'],
          ['ต.ค', <?php echo $money_M[10];?>],
          ['พ.ย', <?php echo $money_M[11]; ?>],
          ['ธ.ค', <?php echo  $money_M[12];?>],
          ['ม.ค', <?php echo $money_M[1]; ?>],
          ['ก.พ', <?php echo $money_M[2]; ?>],
          ['มี.ค', <?php echo $money_M[3];?>],
          ['เม.ย', <?php echo $money_M[4];?>],
          ['พ.ค', <?php echo $money_M[5];?>],
          ['มิ.ย', <?php echo $money_M[6];?>],
          ['ก.ค', <?php echo $money_M[7];?>],
          ['ส.ค', <?php echo $money_M[8];?>],
          ['ก.ย', <?php echo $money_M[9];?>],
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
                groupWidth: "80%"
            },
            vAxis: {
                title: 'ค่าใช้จ่าย',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('money_M_column'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เดือน','จำนวนครั้ง'],
          ['ต.ค', <?php echo $carreserv_M[10];?>],
          ['พ.ย', <?php echo $carreserv_M[11]; ?>],
          ['ธ.ค', <?php echo  $carreserv_M[12];?>],
          ['ม.ค', <?php echo $carreserv_M[1]; ?>],
          ['ก.พ', <?php echo $carreserv_M[2]; ?>],
          ['มี.ค', <?php echo $carreserv_M[3];?>],
          ['เม.ย', <?php echo $carreserv_M[4];?>],
          ['พ.ค', <?php echo $carreserv_M[5];?>],
          ['มิ.ย', <?php echo $carreserv_M[6];?>],
          ['ก.ค', <?php echo $carreserv_M[7];?>],
          ['ส.ค', <?php echo $carreserv_M[8];?>],
          ['ก.ย', <?php echo $carreserv_M[9];?>],
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
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_car'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เดือน','REFER','EMS','รับ-ส่ง'],
          ['ต.ค', {{$refer_M[10]}},{{$ems_M[10]}},{{$transfer_M[10]}}],
          ['พ.ย', {{$refer_M[11]}},{{$ems_M[11]}},{{$transfer_M[11]}}],
          ['ธ.ค', {{$refer_M[12]}},{{$ems_M[12]}},{{$transfer_M[12]}}],
          ['ม.ค', {{$refer_M[1]}},{{$ems_M[1]}},{{$transfer_M[1]}}],
          ['ก.พ', {{$refer_M[2]}},{{$ems_M[2]}},{{$transfer_M[2]}}],
          ['มี.ค', {{$refer_M[3]}},{{$ems_M[3]}},{{$transfer_M[3]}}],
          ['เม.ย', {{$refer_M[4]}},{{$ems_M[4]}},{{$transfer_M[4]}}],
          ['พ.ค', {{$refer_M[5]}},{{$ems_M[5]}},{{$transfer_M[5]}}],
          ['มิ.ย', {{$refer_M[6]}},{{$ems_M[6]}},{{$transfer_M[6]}}],
          ['ก.ค', {{$refer_M[7]}},{{$ems_M[7]}},{{$transfer_M[7]}}],
          ['ส.ค', {{$refer_M[8]}},{{$ems_M[8]}},{{$transfer_M[8]}}],
          ['ก.ย', {{$refer_M[9]}},{{$ems_M[9]}},{{$transfer_M[9]}}],
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }, 2,
            {
                calc: "stringify",
                sourceColumn: 2,
                type: "string",
                role: "annotation"
            }, 3,
            {
                calc: "stringify",
                sourceColumn: 3,
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
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนครั้ง',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_refer'));
        chart.draw(view, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($Workdriver)?>);
        var options = {
            height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($WorkdriverRefer)?>);
        var options = {
            height: '500',
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($RequestReserveCar)?>);
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
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวนการใช้งาน',
                titleTextStyle: {
                    italic: false
                }
            },
            hAxis: {
                title: 'หน่วยงาน',
                fontName: 'Kanit',
                titleTextStyle: {
                    italic: false
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('barchart_unit'));
        chart.draw(view, options);
    }
</script>
@endsection