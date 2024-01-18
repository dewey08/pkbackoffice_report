@extends('layouts.warehouse')
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
            <h3 class="block-title text-center fs-24">ข้อมูลคลังวัสดุ</h3>
        </div>
        <hr>
        <form method="post">
        @csrf
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
                            <option value="{{$budget}}" selected>{{$budget}}</option>
                            @else
                            <option value="{{$budget}}">{{$budget}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1 text-center">
                    <span>
                        <button type="submit" class="btn btn-info fw-5">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-b3" href="{{url(route('mwarehouse.dashboard_request'))}}?budgetyear={{$budgetyear}}&status_req=all">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ขอเบิกวัสดุ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count1}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-hand-holding fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-y3" href="{{url(route('mwarehouse.dashboard_request'))}}?budgetyear={{$budgetyear}}&status_req=Approve">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    หน. เห็นชอบ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count2}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-yg3" href="{{url(route('mwarehouse.dashboard_request'))}}?budgetyear={{$budgetyear}}&status_req=Verify">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    ตรวจสอบผ่าน
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count3}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-check-square fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop bg-sl2-g4" href="{{url(route('mwarehouse.dashboard_request'))}}?budgetyear={{$budgetyear}}&status_req=Allow">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    อนุมัติ
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    {{$count4}} <span class="fs-13">เรื่อง</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-clipboard-check fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-content my-3 shadow position-relative">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <a class="block block-rounded block-link-pop bg-sl2-r4 position-relative" href="{{url(route('mwarehouse.dashboard_min'))}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    จำนวนวัสดุ <span class="fs-20">เหลือน้อย</span>
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span id="store_low"><img style="height:30px" src="{{url('image/loading_white.gif')}}" alt=""></span> <span class="fs-13">จำนวน</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-arrow-alt-circle-down fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <a class="block block-rounded block-link-pop bg-sl-r3" href="{{url(route('mwarehouse.dashboard_max'))}}">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                จำนวนวัสดุ <span class="fs-20">สูงกว่ากำหนด</span>
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span id="store_hight"><img style="height:30px" src="{{url('image/loading_white.gif')}}" alt=""></span> <span class="fs-13">จำนวน</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-arrow-alt-circle-up fs-30 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                        <div class="position-absolute fs-12" style="right:5px;bottom:5px">
                            *ข้อมูลทั้งหมด ไม่ได้แยกรายปี
                        </div>
        </div>
        <div class="block block-content my-3 shadow">
            <h3 class="fs-18 fw-5">ข้อมูลแผนภูมิระบบคลังวัสดุ</h3>
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <div class="panel p-1 bg-sl2-r3">
                        <div class="pane-heading py-2 px-3 text-white" style="text-align:left">จำนวนมูลค่าการเบิก และจ่ายวัสดุ
                        </div>
                        <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                            <div id="columnchart_01" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
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
        var data = google.visualization.arrayToDataTable([
          ['เดือน','มูลค่าการเบิกวัสดุ','มูลค่าการจ่ายวัสดุ'],
          ['ต.ค', <?php echo $warehousr_receive_M[10];?> , <?php echo $warehousr_export_M[10];?>],
          ['พ.ย', <?php echo $warehousr_receive_M[11]; ?> , <?php echo $warehousr_export_M[11]; ?>],
          ['ธ.ค', <?php echo  $warehousr_receive_M[12];?> , <?php echo  $warehousr_export_M[12];?>],
          ['ม.ค', <?php echo $warehousr_receive_M[1]; ?> , <?php echo $warehousr_export_M[1]; ?>],
          ['ก.พ', <?php echo $warehousr_receive_M[2]; ?> , <?php echo $warehousr_export_M[2]; ?>],
          ['มี.ค', <?php echo $warehousr_receive_M[3];?> , <?php echo $warehousr_export_M[3];?>],
          ['เม.ย', <?php echo $warehousr_receive_M[4];?> , <?php echo $warehousr_export_M[4];?>], 
          ['พ.ค', <?php echo $warehousr_receive_M[5];?> , <?php echo $warehousr_export_M[5];?>],
          ['มิ.ย', <?php echo $warehousr_receive_M[6];?> , <?php echo $warehousr_export_M[6];?>],
          ['ก.ค', <?php echo $warehousr_receive_M[7];?> , <?php echo $warehousr_export_M[7];?>],
          ['ส.ค', <?php echo $warehousr_receive_M[8];?> , <?php echo $warehousr_export_M[8];?>],
          ['ก.ย', <?php echo $warehousr_receive_M[9];?> , <?php echo $warehousr_export_M[9];?>]
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
            }
        ]);
        var options = {
            fontName: 'Kanit',
            fontSize: 16,
            width: "100%",
            height: '100%',
            // colors: ['#82b54b'],
            legend: {
                position: 'center'
            },
            bar: {
                groupWidth: "80%"
            },
            vAxis: {
                title: 'มูลค่า',
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
    $.ajax({
        url : "{{url('manager_warehouse/ajax_sum_waherehouse_store_receive_export')}}",
        method : "post",
        data : {'_token':'{{csrf_token()}}'},
        success:function(result){
            let result_ = JSON.parse(result);
            console.log(result_);
            $('#store_low').html(result_.low);
            $('#store_hight').html(result_.hight);
        },
        error:function(){
            $('#store_low').html('load over');
            $('#store_hight').html('load over');
        }
    })
</script>
@endsection