@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
    font-size: 14px;
                  }   
</style>

@section('content')
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
?>         
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <div class="row">
                        <div>
                            <a href="{{ url('person_compensation/dashboard/'.$id_user)}}"
                                class="btn btn-warning loadscreen">

                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ข้อมูลเงินเดือน</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอใบรับรอง</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">สลิปเงินเดือน</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn loadscreen"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ยืม-คืน</a>
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
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center fs-16">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg fs-16"
                        style="font-family: 'Kanit', sans-serif;">
                        @foreach ($budgets as $budget)
                        @if($budget->LEAVE_YEAR_ID == $yearbudget)
                        <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                        @else
                        <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <span>
                        <button type="submit" class="btn btn-info">แสดง</button>
                    </span>
                </div>
            </div>

        </form>
        <div class="block-content mt-3 mb-4 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-4">
                    <!-- block-link-pop -->
                    <div class="block block-rounded bg-sl2-g4" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div class="item">
                                <i class="fa fa-2x fa fa-book text-white"></i>
                            </div>
                            <div class="ml-3 text-right">

                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{ number_format($count1,2)}}
                                </p>
                                <p class="text-white mb-0">
                                    รายการรับบุคคล (บาท)
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="block block-rounded bg-sl2-r4" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div class="item">
                                <i class="fa fa-2x fa fa-paper-plane text-white"></i>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($count2,2)}}
                                </p>
                                <p class="text-white mb-0">
                                    รายการจ่ายบุคคล (บาท)
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="block block-rounded bg-warning" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div class="item">
                                <i class="fa fa-2x fa fa-inbox text-white"></i>
                            </div>
                            <div class="ml-3 text-right">
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{number_format($count3,2)}}
                                </p>
                                <p class="text-white mb-0">
                                    รายการรับสุทธิบุคคล (บาท)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content mt-3 mb-4 shadow">
            <h3 class="block-title fs-18 fw-b">ข้อมูลแผนภูมิเงินเดือนค่าตอบแทน</h3>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-sb3">
                        <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">จำนวนมูลค่ารายรับบุคคล (บาท)
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_01" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-sb3">
                        <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">จำนวนมูลค่ารายจ่ายบุคคล (บาท)
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_02" style="font-family: 'Kanit', sans-serif;width: 100%;height: 500px;"></div>
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
        var data = google.visualization.arrayToDataTable([
            ['เดือน', 'บาท'],
            ['ม.ค', <?php echo $m1_1; ?>],
            ['ก.พ', <?php echo $m2_1; ?>],
            ['มี.ค', <?php echo $m3_1;?>],
            ['เม.ย', <?php echo $m4_1;?>],
            ['พ.ค', <?php echo $m5_1;?>],
            ['มิ.ย', <?php echo $m6_1;?>],
            ['ก.ค', <?php echo $m7_1;?>],
            ['ส.ค', <?php echo $m8_1;?>],
            ['ก.ย', <?php echo $m9_1;?>],
            ['ต.ค', <?php echo $m10_1;?>],
            ['พ.ย', <?php echo $m11_1; ?>],
            ['ธ.ค', <?php echo  $m12_1;?>]
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
            colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'บาท',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_01'));
        chart.draw(view, options);
    }
    
    google.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ['เดือน', 'บาท'],
            ['ม.ค', <?php echo $m1_2; ?>],
            ['ก.พ', <?php echo $m2_2; ?>],
            ['มี.ค', <?php echo $m3_2;?>],
            ['เม.ย', <?php echo $m4_2;?>],
            ['พ.ค', <?php echo $m5_2;?>],
            ['มิ.ย', <?php echo $m6_2;?>],
            ['ก.ค', <?php echo $m4_2;?>],
            ['ส.ค', <?php echo $m8_2;?>],
            ['ก.ย', <?php echo $m9_2;?>],
            ['ต.ค', <?php echo $m10_2;?>],
            ['พ.ย', <?php echo $m11_2; ?>],
            ['ธ.ค', <?php echo  $m12_2;?>]
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
            colors: ['#D96156'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'บาท',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_02'));
        chart.draw(view, options);
    }
    

//create trigger to resizeEnd event     
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
});
  
</script>

@endsection