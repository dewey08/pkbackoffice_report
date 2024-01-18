@extends('layouts.happy')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    use Illuminate\Support\Facades\DB;
    use App\Http\Controllers\Happy_Net_Controller;
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
        .time-container {
            /* display: flex;
                            align-items: center;
                            justify-content: center; */
            /* height: 10vh; */
            float: right;
            text-align: right;
        }

        .time-container #displayTime {
            /* display: flex;
                            align-self: center; */
            font-size: 1rem;

        }

    </style>
    <?php
    function RemoveDateThai($strDate)
    {
        $strYear = date('Y', strtotime($strDate)) + 543;
        $strMonth = date('n', strtotime($strDate));
        $strDay = date('j', strtotime($strDate));
    
        $strMonthCut = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิถุนายน', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
    
    function Removeformate($strDate)
    {
        $strYear = date('Y', strtotime($strDate));
        $strMonth = date('m', strtotime($strDate));
        $strDay = date('d', strtotime($strDate));
    
        return $strDay . '/' . $strMonth . '/' . $strYear;
    }
    
    function Datetime($time_a, $time_b)
    {
        $now_time1 = strtotime(date('Y-m-d ' . $time_a));
        $now_time2 = strtotime(date('Y-m-d ' . $time_b));
        $time_diff = abs($now_time2 - $now_time1);
        $time_diff_h = floor($time_diff / 3600); // จำนวนชั่วโมงที่ต่างกัน
        $time_diff_m = floor(($time_diff % 3600) / 60); // จำวนวนนาทีที่ต่างกัน
        $time_diff_s = ($time_diff % 3600) % 60; // จำนวนวินาทีที่ต่างกัน
    
        return $time_diff_h . ' ชม. ' . $time_diff_m . ' น. ';
    }
    
    $datenow = date('Y-m-d');
    ?>
@endsection
@section('content')

    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24"><span style="color:;">รายชื่อผู้ที่ได้รับคำถามมากที่สุด TOP 100
                </h3>
            </div>
            <hr>

            <body onload="startTime()">

                <div class="col-12">
                    <div class="row">

                        <div class="col-9">
                            <h1>ประจำวันที่ <b> {{ DateThai($datenow) }}</b></h1>
                        </div>
                        <div class="col-xl-3">
                            <div class="text-right">
                                &nbsp;&nbsp;<span><b id="displayTime"></b></span>
                            </div>
                        </div>
                    </div>
                </div>

            </body>
        </div>

        <div class="block-content">
            <style>
                .grid-container {
                    display: grid;
                    table-layout: auto;
                    font-size: 15px;

                }

            </style>
            



            <div class="col-xl-12">
                <?php $number = 0; ?>
                @foreach ($rankq_get as $row)
                    <?php $number++; ?>

                    @if ($number < 4)
                        <div class="col-md-12 col-xl-12">
                            <!-- Project Overview #1 -->
                            <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                                <div class="block-content p-0 progress" style="height: 2px;">
                                    {{-- <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div> --}}
                                </div>
                                <div
                                    class="block-content block-content-full ">
                                    <div class="row">
                                        <div class="col-1">
                                            <p class="font-size-lg font-w600 mb-0">
                                                # {{ $number }}   &nbsp;&nbsp; <span style="color: #ffba1a"><i class="fa fa-chess-queen fa-1x "></i></span>
                                            </p>
                                            <p class="text-muted mb-0">
                                                อันดับที่
                                            </p>
    
    
                                        </div>
                                        <div class="col-1">
                                            <img class="img-fluid img-responsive mr-2"
                                                src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER) }}"
                                                width="100px" height="200px">
                                        </div>
                                        <div class="col-8">
                                            <b style="font-size: 20px">
                                                {{ Happy_Net_Controller::person_fname($row->ID_USER) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER) }}</b>
    
                                            <br> {{ Happy_Net_Controller::person_work($row->ID_USER) }}
    
                                        </div>
                                        <div class="col-2 text-center">
                                            <b style="font-size:2rem ;">{{ $row->HAPPY_NET_ANSWER_ID }}</b>&nbsp;&nbsp;&nbsp;
                                            <b>คำถาม</b>
                                        </div>
                                        {{-- <div class="ml-3 item">
                                           
                                              
                                           
                                        </div> --}}
                                    </div>


                                  
                                </div>
                            </a>
                            <!-- END Project Overview #1 -->
                        </div>



                    @elseif ($number > 3)
                    <div class="col-md-12 col-xl-12">
                        <!-- Project Overview #1 -->
                        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                            <div class="block-content p-0 progress" style="height: 2px;">
                                {{-- <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div> --}}
                            </div>
                            <div
                                class="block-content block-content-full ">
                                <div class="row">
                                    <div class="col-1">
                                        <p class="font-size-lg font-w600 mb-0">
                                            # {{ $number }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            อันดับที่
                                        </p>


                                    </div>
                                    <div class="col-1">
                                        <img class="img-fluid img-responsive mr-2"
                                                src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER) }}"
                                                width="100px" height="200px">
                                    </div>
                                    <div class="col-8">
                                        <b style="font-size: 20px">
                                            {{ Happy_Net_Controller::person_fname($row->ID_USER) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER) }}</b>

                                        <br> {{ Happy_Net_Controller::person_work($row->ID_USER) }}

                                    </div>
                                    <div class="col-2 text-center">
                                        <b style="font-size:2rem ;">{{ $row->HAPPY_NET_ANSWER_ID }}</b>&nbsp;&nbsp;&nbsp;
                                        <b>คำถาม</b>
                                    </div>
                                    {{-- <div class="ml-3 item">
                                       
                                          
                                       
                                    </div> --}}
                                </div>


                              
                            </div>
                        </a>
                        <!-- END Project Overview #1 -->
                    </div>

                    @endif





                @endforeach


            



            </div>

        </div>









    </div>
@endsection

@section('footer')





    {{-- <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script> --}}
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        jQuery(function() {
            Dashmix.helpers('magnific-popup');
        });
    </script>


    {{-- test --}}

    {{-- <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script> --}}
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/raty-js/jquery.raty.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_comp_rating.min.js') }}"></script>

    {{-- test time --}}
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById("displayTime").innerHTML = h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }
                return i;
            }
        }
    </script>

@endsection
