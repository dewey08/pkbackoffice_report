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

        /* comment */
        body {
            background: #eee
        }

        .bdge {
            height: 25px;
            width: 100%;
            background-color: orange;
            color: #fff;
            font-size: 14px;
            /* padding: 30px; */
            border-radius: 40px;
            /* line-height: 5px */
            text-align: center;




        }

        .comments {
            text-decoration: underline;
            text-underline-position: under;
            cursor: pointer
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-top: 3px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .hit-voting:hover {
            color: blue
        }

        .hit-voting {
            cursor: pointer
        }

        .servicedrop {
            transition-delay: 1s
        }

        .action-collapse {
            cursor: pointer
        }

    </style>

@endsection
@section('content')

    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24">การตอบกลับ</h3>
            </div>
            <hr>


        </div>
        <div class="block-content  shadow">
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row">
                            <h2><span>{{ $pr_id->HAPPY_NET_PROBLEM_HEAD }}</span></h2>
                        </div>
                        <div class="row"> ระดับ : <span>
                                <div class="js-rating" data-score="{{ $pr_id->HAPPY_NET_DIFFICULTY_ID }}"></div>
                            </span></div>
                        <br>

                        <span>{{ $pr_id->HAPPY_NET_PROBLEM }}</span>

                        <div class=" card-white post">
                            <div class="container mt-5 mb-5">
                                <div class="d-flex justify-content-center row">
                                    <div class="d-flex flex-column col-md-12">
                                        <div
                                            class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                                            @if ($pr_id->HR_IMAGE == null)
                                                <img src="{{ asset('image/pers.png') }}" height="auto" width="6%">
                                            @else
                                                <img src="data:image/png;base64,{{ chunk_split(base64_encode($pr_id->HR_IMAGE)) }}"
                                                    height="auto" width="6%">
                                            @endif
                                            <div
                                                class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                                                <i class="fa fa-sort-up fa-2x hit-voting"></i><span>1</span><i
                                                    class="fa fa-sort-down fa-2x hit-voting"></i>
                                            </div>
                                            <div class="d-flex flex-column ml-3">
                                                <div class="d-flex flex-row post-title">
                                                    <h5>{{ $pr_id->HAPPY_NET_PROBLEM_FNAME }}
                                                        &nbsp;
                                                        {{ $pr_id->HAPPY_NET_PROBLEM_LNAME }}</h5><span
                                                        class="ml-2"></span>
                                                </div>
                                                <div
                                                    class="d-flex flex-row align-items-center align-content-center post-title">
                                                    <span class=" mr-1" style="color: #8f8f8f">0
                                                        การตอบกลับ</span><span class="mr-2 comments"></span><span
                                                        class="mr-2 dot"></span><span>{{ Datethai($pr_id->updated_at) }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <span class=" mr-1"
                                                        style="color: #8f8f8f">เมื่อทำงานนี้สำเร็จจะได้คะแนน :
                                                        {{ $coins->HAPPY_NET_DIFFICULTY_COIN }} คะแนน</span>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('happy.respond_ans_gets') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        
                                        <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID"
                                        value="{{ $pr_id->HAPPY_NET_PROBLEM_ID}}">

                                        <input type="hidden" id="ID_USER" name="ID_USER"
                                            value="{{$pr_id->ID_USER }}">

                                  
                                        <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                            name="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                            value="{{ $inforperson->HR_FNAME }}">
                                        <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                            name="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                            value="{{ $inforperson->HR_LNAME }}">

                                        <div class="coment-bottom bg-white p-2 px-4">
                                            <div class="d-flex flex-row add-comment-section mt-4 mb-4">

                                                @if ($inforperson->HR_IMAGE == null)
                                                    <img src="{{ asset('image/pers.png') }}" height="auto"
                                                        width="5%">
                                                @else
                                                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforperson->HR_IMAGE)) }}"
                                                        height="auto" width="5%">
                                                @endif


                                                <input type="text" class="form-control mr-3" placeholder="ตอบกลับ"
                                                    id="HAPPY_NET_PROBLEM_ANSWER" name="HAPPY_NET_PROBLEM_ANSWER">

                                                <button class="btn btn-hero-success" type="sumbit">ตอบกลับ</button>
                                            </div>

                                    </form>

                                        @foreach ($ans as $row)
                                            <div class="commented-section mt-2">
                                                <input type="hidden" name="HAPPY_NET_PROBLEM_ANSWER_ID" id="HAPPY_NET_PROBLEM_ANSWER_ID"
                                                    value="{{ $row->HAPPY_NET_PROBLEM_ANSWER_ID }}">
                                                <div class="float-left image">
                                                    @if ($inforperson->HR_IMAGE == null)
                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="{{ asset('image/pers.png') }}" width="50">
                                                    @else
                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="data:image/png;base64,{{ chunk_split(base64_encode($inforperson->HR_IMAGE)) }}"
                                                            width="50">


                                                    @endif
                                                </div>

                                                <div class="d-flex flex-row align-items-center commented-user">
                                                    <h6 class="mr-2">{{ $row->HAPPY_NET_PROBLEM_ANSWER_FNAME }}
                                                        &nbsp;
                                                        {{ $row->HAPPY_NET_PROBLEM_ANSWER_LNAME }}</h6><span
                                                        class="dot mb-1"></span><span
                                                        class="mb-1 ml-2">{{ Datethai($row->updated_at) }}</span>
                                                </div>
                                                <div class="comment-text-sm">
                                                    <span>{{ $row->HAPPY_NET_PROBLEM_ANSWER }}</span>
                                                </div>
                                                <hr>
                                                {{-- <div class="reply-section">
                                                    <div class="d-flex flex-row align-items-center voting-icons"><i
                                                            class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i
                                                            class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span
                                                            class="ml-2"></span><span
                                                            class="dot ml-2"></span>
                                                        <h6 class="ml-2 mt-1"></h6>
                                                    </div>
                                                </div> --}}
                                            </div>

                                        @endforeach

                                    </div>



                                </div>
                            </div>
                        </div>



                    </div>

                </div>

            </div>
        </div>
        <br><br>







    </div>
@endsection

@section('footer')

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- comment -->
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

    <script>
        $(document).ready(function() {



            $('#collapse-1').on('shown.bs.collapse', function() {

                $(".servicedrop").addClass('fa-chevron-up').removeClass('fa-chevron-down');
            });

            $('#collapse-1').on('hidden.bs.collapse', function() {
                $(".servicedrop").addClass('fa-chevron-down').removeClass('fa-chevron-up');
            });

        });
    </script>
    {{-- test --}}

    {{-- <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script> --}}
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/raty-js/jquery.raty.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_comp_rating.min.js') }}"></script>
@endsection
