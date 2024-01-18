@extends('layouts.happy')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
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

        .gradiant-bg {
            font-size: 25px;
            /* font-weight: bold; */
            background: linear-gradient(45deg, #f0a30a, #DB7C49, #f0a30a, #DB7C49, #f0a30a);
            background-size: 40%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            animation: gradient 5s infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

    </style>

@endsection
@section('content')

    <div class="block mb-4" style="width: 95%;margin:auto">
 
  

        <div class="block-content">
            <div class="block-header block-header-default">
                       <div class="col-6"> <h3 class="block-title text-left fs-30">รายละเอียดของรางวัล</h3></div>
                        <div class="col-6"> <a class="btn btn-rounded btn-warning loadscreen" style="float: right;"
                            href="{{ url('person_happynet/order_Happy_Net') }}"><i
                                class="far fa-arrow-alt-circle-left  fa-1x">&nbsp;&nbsp;</i>ย้อนกลับ</a></div>
                    </div>
            <hr>
        </div>
        <div class="block-content  shadow"><br>
            <div class="col-xl-12 row ">
                <div class="col-6 content ">
                    <center>
                        <a class="img-link img-link-zoom-in img-thumb img-lightbox"
                            href="">
                            {{-- <img class="" style="width: 100%; height: 100%;"
                                src="{{ asset($rewards->HAPPY_NET_REWARD_IMAGE) }}" alt=""> --}}
                                <img  width="300px" src="data:image/png;base64,{{ chunk_split(base64_encode($rewards->HAPPY_NET_REWARD_IMAGE)) }}">
                        </a>
                    </center>
                    {{-- <img width="100%"  src="{{ asset($row->HAPPY_NET_REWARD_IMAGE) }}"> --}}
                    <br>
                </div>
                <div class="col-6  content shadow">
                    <div class="row col-12">
                        <div class="col-12">
                            <h1 style="font-size: 1.3em;">
                                @if ($con_order->HAPPY_NET_ORDER_STATUS == 'True')

                                    <span style="color: #00b953;"> ชื่อผู้ขอแลกของรางวัล :</span> <span
                                        style="color: #454545;">{{ $con_order->HAPPY_NET_NAME_USER }}</span>
                                    <br><br>
                                @else
                                    <span style="color: #ff0000 ;"> ชื่อผู้ขอแลกของรางวัล :</span> <span
                                        style="color: #454545;">{{ $con_order->HAPPY_NET_NAME_USER }}</span>
                                    <br><br>
                                @endif

                                ชื่อของรางวัล : <span
                                    style="color: #454545;">{{ $con_order->HAPPY_NET_REWARD_NAME }}</span>
                            </h1>
                        </div>
                       
                    </div>
                    <div class="col-12 ">
                        <h5>รายละเอียดของรางวัล</h5>
                        <h5>{{ $rewards->HAPPY_NET_REWARD_DETAILS }}</h5>

                        <br><br>


                        <div class="row">
                            <span>
                                @if ($con_order->HAPPY_NET_ORDER_STATUS == 'True')
                                    <button class="btn btn-hero-primary" style="background-color: #0c9e2b; float: left; "
                                        disabled>สถานะ
                                        &nbsp;: &nbsp;&nbsp;<i class="far fa-check-circle fa-1x"></i>
                                        &nbsp;จำหน่ายแล้ว
                                      
                                    </button>  &nbsp;
                                     <span> <button class="btn btn-hero-primary" style="background-color: #082f5a;"
                                            disabled>ราคา
                                           
                                            &nbsp;{{ $rewards->HAPPY_NET_REWARD_PRICE }}
                                            &nbsp;
                                            <i class="fab fa-bitcoin mr-1"></i></button></span>  
    
                                    <span> <button class="btn btn-hero-primary" style="background-color: #868686;"
                                            disabled>จำนวน &nbsp;:
                                            &nbsp;{{ $con_order->HAPPY_NET_ORDER_QUANTITY }}
                                            &nbsp;&nbsp;<i class="fa fa-shopping-basket mr-1"></i>
                                        </button></span>
                                    <br><br>
                                   
                                @else
                                    <button class="btn btn-hero-primary " style="background-color: #ff0000; float: left;"
                                        disabled>สถานะ
                                        &nbsp;: &nbsp; &nbsp;&nbsp;<i class="far fa-times-circle fa-1x"></i>
                                        &nbsp;ยังไม่ได้จำหน่าย
                                        &nbsp;
                                    </button>
    
                                    &nbsp;
                                    </button>     <span> <button class="btn btn-hero-primary" style="background-color: #082f5a;" disabled>ราคา
                                        &nbsp;:
                                        &nbsp;{{ $rewards->HAPPY_NET_REWARD_PRICE }}
                                        &nbsp;
                                        <i class="fab fa-bitcoin mr-1"></i></button></span>
    
                                        <span> <button class="btn btn-hero-primary" style="background-color: #868686;" disabled>จำนวน &nbsp;:
                                            &nbsp;{{ $con_order->HAPPY_NET_ORDER_QUANTITY }}
                                            &nbsp;&nbsp;<i class="fa fa-shopping-basket mr-1"></i>
                                        </button></span>
                               
                                <br><br><br>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>




@endsection

@section('footer')

    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>









@endsection
