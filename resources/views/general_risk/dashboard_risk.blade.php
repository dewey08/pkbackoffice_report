@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}


.text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
</style>
<script>
    function checklogin(){
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




$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}



?>
<?php
  use App\Http\Controllers\RiskController;
    $refnumber = RiskController::refnumberRisk();
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);
    
    $check = RiskController::checkpermischeckinfo($user_id);

    use App\Http\Controllers\FectdataController;
    $checkleader_sub = FectdataController::checkleader_sub($id_user);
?>

<!-- Advanced Tables -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 style="font-family: 'Kanit', sans-serif; font-size:17px;font-weight:normal;">
        {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }} {{ $inforpersonuser -> HR_LNAME }}
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <div class="row">
            <div>
              <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}"
                class="btn btn-hero-sm btn-hero-warning">

                <span class="nav-main-link-name">Dashboard</span>
              </a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
              </a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_risk/risk_notify_report4/'.$inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero-info"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                ปค.4
              </a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_risk/risk_notify_report5/' . $inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน
                ปค.5
              </a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
              </a>
            </div>
            <div>&nbsp;</div>
            <?php /* 
            <div>
              <a href="{{ url('general_risk/risk_notify_reportsub/' . $inforpersonuserid->ID) }}" class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงานหน่วยย่อย </a> 
            </div>
            <div>&nbsp;</div> */?>
            <div>
              <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero "
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
            </div>
            <div>&nbsp;</div>

            @if($check == 1)
            <div>
              <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
              </a>
            </div>
            <div>&nbsp;</div>
            @endif
            <?php /* @if ($checkrisknotify != 0)
            <div>
              <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
              class="btn btn-hero-sm btn-hero" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size:1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
              @if ($countrisknotify != 0)
              <span class="badge badge-light">{{$countrisknotify}}</span>
              @endif
              </a>
            </div>
            <div>&nbsp;</div> 
            @endif */?>
            <div>
              <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                class="btn btn-hero-sm btn-hero "
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
              <span class="badge badge-light"></span>
              </a>
            </div>
            <div>&nbsp;</div>
          </div>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
  <div class="block-content">
    <h3 class="block-title fs-18 fw-b">ข้อมูลแผนภูมิรายงานความเสี่ยง</h3>
    <hr>
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="panel p-1 bg-sl2-sb3">
            <?php 
              $data_levelAI[] = array('อัตราการเกิดความเสี่ยง ','ระดับความรุนแรง'); 
              foreach ($levelAI_piecharts as $levelAI_piechart){
                $data_levelAI[] = array($levelAI_piechart->RISKREP_LEVEL,$levelAI_piechart->level_count);
              } 
            ?>
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยง ระดับความรุนแรงทั้งหมด
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                <div id="piechart_levelAI" class="f-kanit" style="width: 100%;height:500px;"></div>
            </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="panel p-1 bg-sl2-sb3">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยง ระดับความรุนแรง C,D,E,H
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                <div id="piechart_levAI" class="f-kanit" style="width: 100%;height:500px;"></div>
            </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="panel p-1 bg-sl2-sb3">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยง ระดับความรุนแรง 1,2
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                <div id="piechart_12" class="f-kanit" style="width: 100%;height:500px;"></div>
            </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="panel p-1 bg-sl2-sb3">
            <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยง ระดับความรุนแรง A,B,C,D,E
            </div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                <div id="piechart_levABCDE" class="f-kanit" style="width: 100%;height:500px;"></div>
            </div>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="panel p-1 bg-sl2-sb3">
          <?php 
            $data_type[] = array('ประเภทรายงาน','จำนวนประเภทรายงาน');
            foreach ($sexpiechart as $sex_piechart){
              $data_type[] = array($sex_piechart->RISKREP_SEX,$sex_piechart->sex_count); 
            }
          ?>
          <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยง ชาย & หญิง
          </div>
          <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
            <div id="donutchart" class="f-kanit" style="width: 100%;height:500px;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="panel p-1 bg-sl2-sb3">
          <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">อัตรการเกิดความเสี่ยงช่วงอายุ
          </div>
          <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
            <div id="piechart_age" class="f-kanit" style="width: 100%;height:500px;"></div>
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

<script>
  $(document).ready(function () {

    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true //Set เป็นปี พ.ศ.
    }); //กำหนดเป็นวันปัจุบัน
  });
</script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($data_levelAI); ?>);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_levelAI'));
        chart.draw(data, options);
    }
    
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['C', <?php echo $lev_C; ?> ],
          ['D', <?php echo $lev_D; ?> ],
          ['E', <?php echo $lev_E; ?> ],
          ['H', <?php echo $lev_H; ?> ],]);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_levAI'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['1', <?php echo $levels_1; ?> ],
          ['2', <?php echo $levels_2; ?> ],
        ]);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_12'));
        chart.draw(data, options);
    }
  google.charts.setOnLoadCallback(drawChart4);

  function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['A', <?php echo $lec_A; ?> ],
          ['B', <?php echo $lec_B; ?> ],
          ['C', <?php echo $lec_C; ?> ],
          ['D', <?php echo $lec_D; ?> ],
          ['E', <?php echo $lec_E; ?> ],
        ]);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_levABCDE'));
        chart.draw(data, options);
    }

  google.charts.setOnLoadCallback(drawChart5);
  function drawChart5() {
        var data = google.visualization.arrayToDataTable([
          ['อายุ', 'Speakers (in millions)'],
          ['อายุระหว่าง 1-15 ปี', <?php echo $AGE_1; ?> ],
          ['อายุระหว่าง 16-35 ปี', <?php echo $AGE_2; ?> ],
          ['อายุระหว่าง 36-55 ปี', <?php echo $AGE_3; ?> ],
          ['อายุระหว่าง 56-75 ปี', <?php echo $AGE_4; ?> ],
          ['อายุระหว่าง 76 ปีขึ้นไป', <?php echo $AGE_5; ?> ]
        ]);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_age'));
        chart.draw(data, options);
    }

  google.charts.setOnLoadCallback(drawChart6);
  function drawChart6() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['ชาย', <?php echo $SEX_1; ?> ],
          ['หญิง', <?php echo $SEX_2; ?> ],
        ]);
        
        var options = {
            // colors: ['#F67A37','#9BD770'],
            fontSize: 16,
            legend: {
                position: "top",
                alignment: "center"
            },
            fontName: 'Kanit',
            pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
    
    $(window).resize(function() {
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 0);
    });

    //redraw graph when window resize is completed  
    $(window).on('resizeEnd', function() {
      drawChart();
      drawChart2();
      drawChart3();
      drawChart4();
      drawChart5();
      drawChart6();
    });
</script>

@endsection
