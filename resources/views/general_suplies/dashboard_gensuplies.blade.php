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
body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;

      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;

      }

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
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




use App\Http\Controllers\SupliesController;
$checkapp = SupliesController::checkapp($user_id);
$checkallow = SupliesController::checkallow($user_id);

$countapp = SupliesController::countapp($user_id);
$countallow = SupliesController::countallow($user_id);

?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="block-header block-header-default">
        <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลสถานะพัสดุ</B></h3>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <div class="row">
                    <div>
                        <a href="{{ url('general_suplies/dashboard/'.$inforpersonuserid -> ID) }}"
                            class="btn btn-warning loadscreen">Dashboard</a>
                    </div>
                    <div>&nbsp;</div>


                    <div>
                        <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}"
                            class="btn loadscreen"
                            style="background-color:#DCDCDC;color:#696969;">ขอจัดซื้อ/จัดจ้าง</a>
                    </div>
                    <div>&nbsp;</div>


                    @if($checkapp != 0)
                    <div>
                        <a href="{{ url('general_suplies/inforequestapp/'.$inforpersonuserid -> ID)}}"
                            class="btn loadscreen"
                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เห็นชอบ

                            @if($countapp!=0)
                            <span class="badge badge-light">{{$countapp}}</span>
                            @endif
                        </a>
                    </div>
                    <div>&nbsp;</div>

                    @endif

                    @if($checkallow!=0)
                    <div>
                        <a href="{{ url('general_suplies/inforequestlastapp/'.$inforpersonuserid -> ID)}}"
                            class="btn loadscreen"
                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ

                            @if($countallow!=0)
                            <span class="badge badge-light">{{$countallow}}</span>
                            @endif
                        </a>
                    </div>
                    <div>&nbsp;</div>
                    @endif

            </ol>

        </nav>
    </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
    <div class="block-content">
        <form action="{{ route('supplies.dashboardsearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center fs-16">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg fs-16"
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID== $year_id)
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}
                            </option>
                            @else
                            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1">
                    <span>
                        <button type="submit" class="btn btn-hero-sm btn-hero-info mr-2 fs-16">แสดง</button>
                    </span>
                </div>
            </div>

        </form>
        <div class="block-content mt-3 mb-4 shadow">
            <div class="row">
                <div class="col-12">
                    <div class="block radius-5 bg-sl2-b3">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_1}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ขอซื้อ/ขอจ้าง ทั้งหมด</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="block radius-5 bg-sl2-y4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_2}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">หน. เห็นชอบ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="block radius-5 bg-sl2-yg4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_3}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">พัสดุตรวจสอบ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="block radius-5 bg-sl2-g4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_4}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ผอ.อนุมัติ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="block radius-5 bg-sl2-sb4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_5}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">รอเห็นชอบ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="block radius-5 bg-sl2-r3">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_6}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ไม่เห็นชอบ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="block radius-5 bg-sl2-r3">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_7}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ตรวจสอบไม่ผ่าน</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-6">
                    <div class="block radius-5 bg-sl2-r4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                {{$amount_8}} <span class="text-font">เรื่อง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ไม่อนุมัติ</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4"></i> <br>
                                <p class="mb-0 fs-20"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content mt-3 mb-4 shadow">
            <h3 class="block-title fs-18 fw-b">ข้อมูลแผนภูมิงานพัสดุ</h3>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <!-- รูปแบบแสดง chart -->
                    <div class="panel p-1 bg-sl2-sb3">
                        <div class="pane-heading py-2 px-3 text-white fs-16" style="text-align:left">จำนวนรายการแบ่งตามประเภทเงิน
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_material" class="f-kanit" style="width: 100%;height:500px;"></div>
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
            ['ประเภทเงิน', 'จำนวนรายการ'],
            ['งบประมาณ', <?php echo $budget_1; ?> ],
            ['เงิน UC', <?php echo $budget_2; ?> ],
            ['เงินบำรุง', <?php echo $budget_3; ?> ],
            ['เงินบริจาค', <?php echo $budget_4; ?> ],
            ['เงินอื่นๆ', <?php echo $budget_5; ?> ],
            ['เงินค่าบริการทางการแพทย์', <?php echo $budget_6; ?> ]
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
            // colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'จำนวน',
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
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
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
});

</script>


@endsection
