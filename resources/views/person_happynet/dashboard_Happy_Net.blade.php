@extends('layouts.happy')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    use App\Http\Controllers\Happy_Net_Controller;
    ?>
    <?php
    function RemoveDateThai($strDate)
    {
        $strYear = date('Y', strtotime($strDate)) + 543;
        $strMonth = date('n', strtotime($strDate));
        $strDay = date('j', strtotime($strDate));
    
        $strMonthCut = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
    function RemovegetAge($birthday)
    {
        $then = strtotime($birthday);
        return floor((time() - $then) / 31556926);
    }
    ?>



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

        .card-white .card-heading {
            color: #333;
            background-color: #fff;
            border-color: #ddd;
            border: 1px solid #dddddd;
        }

        .card-white .card-footer {
            background-color: #fff;
            border-color: #ddd;
        }

        .card-white .h5 {
            font-size: 14px;
            //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        .card-white .time {
            font-size: 12px;
            //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        .post .post-heading {
            height: 95px;
            padding: 20px 15px;
        }

        .post .post-heading .avatar {
            width: 60px;
            height: 60px;
            display: block;
            margin-right: 15px;
        }

        .post .post-heading .meta .title {
            margin-bottom: 0;
        }

        .post .post-heading .meta .title a {
            color: black;
        }

        .post .post-heading .meta .title a:hover {
            color: #aaaaaa;
        }

        .post .post-heading .meta .time {
            margin-top: 8px;
            color: #999;
        }

        .post .post-image .image {
            width: 100%;
            height: auto;
        }

        .post .post-description {
            padding: 15px;
        }

        .post .post-description p {
            font-size: 14px;
        }

        .post .post-description .stats {
            margin-top: 20px;
        }

        .post .post-description .stats .stat-item {
            display: inline-block;
            margin-right: 15px;
        }

        .post .post-description .stats .stat-item .icon {
            margin-right: 8px;
        }

        .post .post-footer {
            border-top: 1px solid #ddd;
            padding: 15px;
        }

        .post .post-footer .input-group-addon a {
            color: #454545;
        }

        .post .post-footer .comments-list {
            padding: 0;
            margin-top: 20px;
            list-style-type: none;
        }

        .post .post-footer .comments-list .comment {
            display: block;
            width: 100%;
            margin: 20px 0;
        }

        .post .post-footer .comments-list .comment .avatar {
            width: 35px;
            height: 35px;
        }

        .post .post-footer .comments-list .comment .comment-heading {
            display: block;
            width: 100%;
        }

        .post .post-footer .comments-list .comment .comment-heading .user {
            font-size: 14px;
            font-weight: bold;
            display: inline;
            margin-top: 0;
            margin-right: 10px;
        }

        .post .post-footer .comments-list .comment .comment-heading .time {
            font-size: 12px;
            color: #aaa;
            margin-top: 0;
            display: inline;
        }

        .post .post-footer .comments-list .comment .comment-body {
            margin-left: 50px;
        }

        .post .post-footer .comments-list .comment>.comments-list {
            margin-left: 50px;
        }

    </style>
    <style>
        .bu1 {
            background-color: #3b9ae1;
        }

        .bu2 {
            background-color: #0e4b89;
        }

        .bu3 {
            background-color: #378fc7;
        }

        .bu4 {
            background-color: #5abcf4;
        }

        .bu5 {
            background-color: #082f5a;
        }

    </style>
@endsection 
@section('content')
@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif
@if (\Session::has('danger'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('danger') !!}</li>
    </ul>
</div>
@endif
    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content">
            <div class="block-header block-header-default">
                <div class="col-12">
                    <h3 class="block-title text-center fs-24">ระบบประเมินความสุขและเพิ่มความสุขในการทำงาน
                           </h3>
                </div>

            </div>
        </div>
        <hr>

        <form action="{{ route('happy.dashboardsearch') }}" method="post">
            @csrf
            <div class="col-12"><div class="col-md-1"></div>
                <div class="row">
                    <div style="font-size:1.2em;" class="col-md-1 d-flex justify-content-center align-items-center">
                       ข้อมูลประจำปี : 
                    </div>
                    <div class="col-md-3">
                        <span>
                            <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                    @if ($budget->LEAVE_YEAR_ID == $year_id)
                                        <option value="{{ $budget->LEAVE_YEAR_ID }}" selected>{{ $budget->LEAVE_YEAR_ID }}
                                        </option>
                                    @else
                                        <option value="{{ $budget->LEAVE_YEAR_ID }}">{{ $budget->LEAVE_YEAR_ID }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <div class="col-md-1 text-center">
                        <span>
                            <button type="submit" class="btn btn-info fw-5 f-kanit loadscreen">แสดง</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
        {{-- เนื้อหา --}}   <div class="modal fade"
        @foreach ($status_modal_set as $row)
            @if ($row->HAPPY_NET_MODAL_QUESTION == 'True')
                @foreach ($status_modal as $row)


                    @if ($row->HAPPY_NET_MODAL_QUESTION == 'True')
                        id="myModal"
                    @else


                    @endif
                @endforeach
            @endif
          @endforeach
       tabindex="-1" role="dialog" aria-labelledby="myModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-light">
                            <h1 class="block-title" style="color: black;">ระบบประเมินความสุขของบุคลากร
                            </h1>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="text-center">
                                <img width="auto" height="200px" src="{{ asset('image/happy_net_image_question/1.png') }}"
                                    alt="">
                            </div><br>
                            <h1 class="text-center" style="font-size: 1.8em">ตอบคำถามเพื่อรับ COIN</h1>
                            <div class="col-12">
                                <center>
                                    <a href="{{ route('happy.question_dashboard') }}" style="float: center;"
                                        class="btn btn-hero-warning ">เข้าสู่หน้าการตอบคำถาม</a>
                                </center><br>
                            </div>
                        </div>
                    </div>

                    <div class="block-content block-content-full text-right bg-light">
                        <!-- <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">ยกเลิก</button> -->
                        <a href="" data-dismiss="modal" class="btn btn-light ">ข้าม&nbsp; &nbsp;<i
                                class="fa fa-fast-forward fa-1x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Pop Out Block Modal -->

        {{-- เนื้อหา --}}   <div class="modal fade"
       
        @foreach ($status_modal_sets as $row)
        @if ($row->HAPPY_NET_MODAL_QUESTION == 'True')
          


                
                    id="myModal2"
       
        @endif
      @endforeach
                  
       tabindex="-1" role="dialog" aria-labelledby="myModal2"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-light">
                            <h1 class="block-title" style="color: black;"> <i style="color: #ffc94d;" class="fa fa-heartbeat fa-1.5x"></i> &nbsp;ระบบประเมินความสุขของบุคลากร :: ขอแสดงความยินดีกับ
                            </h1>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content ">
                            
                            <div class="row">
                                <div class="col-md-6 col-xl-4">
                                    <!-- TOP 1 # Plan -->
                                    @foreach ($rankcoin_get as $row)
                                    <a class="block block-link-pop block-rounded block-bordered text-center" href="javascript:void(0)">
                                        <div class="block-header">
                                            <i class="fa fa-medal fa-2x text-warning" ></i><h3 class="block-title">TOP 1 #</h3>
                                        </div>
                                        <div class="block-content">
                                            <img class="img-fluid img-responsive mr-2"
                                            src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID) }}"
                                            width="80%" height="200px">
                                        </div>
                                        <div class="block-content">
                                            <div class="py-2">
                                                <b style="font-size: 20px">
                                                    {{ Happy_Net_Controller::person_fname($row->ID) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID) }}</b>
        
                                                <br> {{ Happy_Net_Controller::person_work($row->ID) }}
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full">
                                            <span class="btn btn-hero-warning px-4">เป็นผู้ที่ได้รับคะแนนมากที่สุด</span>
                                        </div>
                                    </a>
                                    @endforeach
                                    <!-- END TOP 1 # Plan -->
                                </div>
                           <div class="col-md-6 col-xl-4">
                                    <!-- TOP 1 # Plan -->
                                    @foreach ($rankans_get as $row)
                                    <a class="block block-link-pop block-rounded block-bordered text-center" href="javascript:void(0)">
                                        <div class="block-header">
                                            <i class="fa fa-medal fa-2x text-success" ></i><h3 class="block-title">TOP 1 #</h3>
                                        </div>
                                        <div class="block-content">
                                            <img class="img-fluid img-responsive mr-2"
                                            src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER) }}"
                                            width="80%" height="200px">
                                        </div>
                                        <div class="block-content">
                                            <div class="py-2">
                                                <b style="font-size: 20px">
                                                    {{ Happy_Net_Controller::person_fname($row->ID_USER) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER) }}</b>
        
                                                <br> {{ Happy_Net_Controller::person_work($row->ID_USER) }}
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full">
                                            <span class="btn btn-hero-success px-4">เป็นผู้ที่ได้รับคำชื่นชมมากที่สุด</span>
                                        </div>
                                    </a>
                                    @endforeach
                                    <!-- END TOP 1 # Plan -->
                                </div>
                           <div class="col-md-6 col-xl-4">
                                    <!-- TOP 1 # Plan -->
                                    @foreach ($rankq_get as $row)
                                    <a class="block block-link-pop block-rounded block-bordered text-center" href="javascript:void(0)">
                                        <div class="block-header">
                                            <i class="fa fa-medal fa-2x text-primary" ></i>  <h3 class="block-title">TOP 1 # </h3>
                                        </div>
                                        <div class="block-content">
                                            <img class="img-fluid img-responsive mr-2"
                                            src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER) }}"
                                            width="80%" height="200px">
                                        </div>
                                        <div class="block-content">
                                            <div class="py-2">
                                                <b style="font-size: 20px">
                                                    {{ Happy_Net_Controller::person_fname($row->ID_USER) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER) }}</b>
        
                                                <br> {{ Happy_Net_Controller::person_work($row->ID_USER) }}
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full">
                                            <span class="btn btn-hero-primary px-4">เป็นผู้ที่ได้รับคำปรึกษามากที่สุด</span>
                                        </div>
                                    </a>
                                    @endforeach
                                    <!-- END TOP 1 # Plan -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <!-- <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">ยกเลิก</button> -->
                        <a href="" data-dismiss="modal" class="btn btn-light ">ข้าม&nbsp; &nbsp;<i
                                class="fa fa-fast-forward fa-1x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Pop Out Block Modal -->

        <style>
            .bg-1{
                background-color: #44a4b6
            }
        </style>
        <div Class="block-content my-3 shadow">
            <div class="col-xl-12 row">
                <div class="col-6 col-md-6">
                    <a class="block block-rounded block-link-pop bg-1">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p style="font-size: 1.25em" class="text-white mb-2 fs-16">
                                    ระดับการมีส่วนร่วมของ<br>การร่วมในการแก้ไขปัญหา
                                </p>
                                @if ($rank < 1)
                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " ไม่มี "
                                        <span class="fs-13"></span>
                                    </p>
                                @elseif ($rank < 5)

                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " น้อย "
                                        <span class="fs-13"></span>
                                    </p>
                                    @elseif ($rank < 15)

                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " มาก "
                                        <span class="fs-13"></span>
                                    </p>

                                    @elseif ($rank < 25)

                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " ดีมาก "
                                        <span class="fs-13"></span>
                                    </p>

                                    @elseif ($rank < 35)

                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " ยอดเยี่ยม "
                                        <span class="fs-13"></span>
                                    </p>

                                    @elseif ($rank<=40)

                                    <p class="text-white mb-2" style="font-size: 2em;">

                                        " พนักงานดีเด่น "
                                        <span class="fs-13"></span>
                                    </p>



                                @endif






                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-award fa-3x  text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6">
                    <a class="block block-rounded block-link-pop " style=" background-color: #f7d35f">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p style="font-size: 1.25em" class="text-white mb-2 fs-16">
                                    จำนวนคะแนน  <br>ทั้งหมด
                                </p>

                                <p class="text-white mb-2" style="font-size: 2.05em;">
                                    <span>{{ $sumcoin }}</span>&nbsp;<span class="fs-20">คะแนน </span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fab fa-bitcoin fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-xl-3">

                    <a class="block block-rounded block-link-pop bg-sl2-s3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    คำถาม/ความช่วยเหลือ<br>ที่มอบให้เพื่อนร่วมงานทั้งหมด
                                </p>

                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span>{{ $problem_idsum_get }}</span>&nbsp;<span class="fs-20 ">จำนวน</span>
                                </p>


                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class=" fa fa-sign-in-alt fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-xl-3">

                    <a class="block block-rounded block-link-pop bg-sl2-sb5">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left"  >
                                <p class="text-white mb-0 fs-16">
                                    คำถาม/ความช่วยเหลือ<br>ที่ได้รับทั้งหมด  
                                </p>

                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span>{{ $problem_idsum }}</span>&nbsp;<span class="fs-20 ">จำนวน</span>
                                </p>


                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-sign-out-alt fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-4 col-xl-3">

                    <a class="block block-rounded block-link-pop   " style=" background-color: #67a37e">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    คำชื่นชมที่มอบให้เพื่อนร่วมงาน<br>ทั้งหมด
                                </p>

                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span>{{ $chomsum_get }}</span>&nbsp;<span class="fs-20 ">จำนวน</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-handshake fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a class="block block-rounded block-link-pop  "  style=" background-color: #a0c586">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-16">
                                    คำชื่นชมที่ได้รับ<br>ทั้งหมด
                                </p>
                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                    <span>{{ $chomsum }}</span>&nbsp;<span class="fs-20 ">จำนวน</span>
                                </p>
                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-handshake fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12"><br>
            <div class="block-content  shadow ">
                <h1 style="font-size: 1.4em">แผนภาพข้อมูลความสุขของบุคลากร</h1>
                    <center>
                        <div id="chart_div" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                    </center>
            </div>
            <br>
            <div class="block-content  shadow ">
                <center>
                    <div id="chart_div2" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                </center>
            </div>
            <br>
        </div>

    </div>








@endsection

@section('footer')


    <script script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['เดือน', 'คำชื่นชมที่มอบให้บุคลากร', 'คำชื่นชมที่ได้รับจากบุคลากร'],
                ['ม.ค.', <?php echo $chom_send1; ?>, <?php echo $chom_get1; ?>],
                ['ก.พ.', <?php echo $chom_send2; ?>, <?php echo $chom_get2; ?>],
                ['มี.ค.', <?php echo $chom_send3; ?>, <?php echo $chom_get3; ?>],
                ['เม.ย.', <?php echo $chom_send4; ?>, <?php echo $chom_get4; ?>],
                ['พ.ค.', <?php echo $chom_send5; ?>, <?php echo $chom_get5; ?>],
                ['มิ.ย.', <?php echo $chom_send6; ?>, <?php echo $chom_get6; ?>],
                ['ก.ค.', <?php echo $chom_send7; ?>, <?php echo $chom_get7; ?>],
                ['ส.ค.', <?php echo $chom_send8; ?>, <?php echo $chom_get8; ?>],
                ['ก.ย.', <?php echo $chom_send9; ?>, <?php echo $chom_get9; ?>],
                ['ต.ค.', <?php echo $chom_send10; ?>, <?php echo $chom_get10; ?>],
                ['พ.ย.', <?php echo $chom_send11; ?>, <?php echo $chom_get11; ?>],
                ['ธ.ค.', <?php echo $chom_send12; ?>, <?php echo $chom_get12; ?>]

            ]);
            

            var options = {
                title: 'คำถาม',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'เดือน'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                },
                colors: ['#4dc9ff', '#0080ff'],
                width: "100%",
                height: '100%',
                legend: {
                    position: 'center'
                },
                bar: {
                    groupWidth: "65%"
                },
                
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

    <!--ให้บุลลากร -->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([

                ['เดือน', 'คำถาม/งานที่ได้รับจากบุคลากร', 'คำถาม/งานที่มอบให้บุคลากร'],
                ['ม.ค.', <?php echo $pro_send1; ?>, <?php echo $pro_get1; ?>],
                ['ก.พ.', <?php echo $pro_send2; ?>, <?php echo $pro_get2; ?>],
                ['มี.ค.', <?php echo $pro_send3; ?>, <?php echo $pro_get3; ?>],
                ['เม.ย.', <?php echo $pro_send4; ?>, <?php echo $pro_get4; ?>],
                ['พ.ค.', <?php echo $pro_send5; ?>, <?php echo $pro_get5; ?>],
                ['มิ.ย.', <?php echo $pro_send6; ?>, <?php echo $pro_get6; ?>],
                ['ก.ค.', <?php echo $pro_send7; ?>, <?php echo $pro_get7; ?>],
                ['	ส.ค.', <?php echo $pro_send8; ?>, <?php echo $pro_get8; ?>],
                ['	ก.ย.', <?php echo $pro_send9; ?>, <?php echo $pro_get9; ?>],
                ['ต.ค.', <?php echo $pro_send10; ?>, <?php echo $pro_get10; ?>],
                ['พ.ย.', <?php echo $pro_send11; ?>, <?php echo $pro_get11; ?>],
                ['ธ.ค.', <?php echo $pro_send12; ?>, <?php echo $pro_get12; ?>]






            ]);

            var options = {
                title: 'คำชม',
                vAxis: {
                    title: 'จำนวน'
                },
                hAxis: {
                    title: 'เดือน'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                },
                colors: ['#67a37e', '#a0c586'],
                width: "100%",
                height: '100%',
                legend: {
                    position: 'center'
                },
                bar: {
                    groupWidth: "65%"
                },
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }
    </script>

    <script>
        $(window).on('load', function() {
            var delayMs = 100; // delay in milliseconds

            setTimeout(function() {
                $('#myModal').modal('show');
            }, delayMs);
        });
    </script>
    <script>
        $(window).on('load', function() {
            var delayMs = 100; // delay in milliseconds

            setTimeout(function() {
                $('#myModal2').modal('show');
            }, delayMs);
        });
    </script>



    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>
    // <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>


    <script src="{{ asset('asset/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_forms_wizard.min.js') }}"></script>

    <script src="assets/js/dashmix.core.min.js"></script>


    

    
@endsection
