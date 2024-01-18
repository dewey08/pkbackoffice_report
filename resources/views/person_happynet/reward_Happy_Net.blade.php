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
    @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('danger2'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger2') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24">แลกของรางวัล</h3>
            </div>
            <hr>
            <div class="block-content my-3 shadow">
                <div class="row">
                    <div class="col-md-3 col-md-6">
                        <a class="block block-rounded block-link-pop bu1">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="ml-2 left">
                                    <p class="text-white mb-0 fs-16" style="font-size: 1.7rem;">
                                        รางวัลวันนี้
                                    </p>
                                    <p class="text-white mb-0 fs-16">
                                        ทั้งหมด
                                    </p>

                                    <p class="text-white mb-0" style="font-size: 1.7rem;">
                                        <span>{{ $reward }}</span>&nbsp;<span class="fs-20 ">รายการ</span>
                                    </p>


                                </div>
                                <div class="mr-2 right d-flex justify-content-center align-items-top">
                                    <i class="fa fa-cubes fa-4x text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-md-6">
                        <a class="block block-rounded block-link-pop bu2 ">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="ml-2 left">
                                    <p class="text-white mb-0 fs-16" style="font-size: 1.7rem;">
                                        คงเหลือ
                                        : </p>
                                    <p class="text-white mb-0 fs-16">
                                        ทั้งหมด
                                    </p>
                                    <p class="text-white mb-0" style="font-size: 1.7rem;">
                                        <span>
                                            {{ $numreward }}
                                        </span>&nbsp;<span class="fs-20 ">จำนวน</span>

                                    </p>


                                </div>
                                <div class="mr-2 right d-flex justify-content-center align-items-top">
                                    <i class="fa fa-clipboard-list fa-4x text-white"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- endrow -->
        </div>
        <!-- content market -->
        <div class="block-content  shadow">
            <div class="container-sm">
                <div class="row col-12 ">
                    <?php $number = 0; ?>
                    @foreach ($rewards as $row)
                        <?php $number++; ?>
                        <div class="col-sm-3">
                            <!-- Story #7 -->
                            <style>

                            </style>
                            <a class="block block-rounded block-link-pop loadscreen"
                                href="{{ url('person_happynet/reward_content_Happy_Net/' . $row->HAPPY_NET_REWARD_ID) }}">
                                <br>&nbsp; &nbsp;<span class="badge badge-danger font-w700 p-2 text-uppercase">
                                    #{{ $number }}
                                </span>
                                {{-- style="background-image: url(''); " --}}
                                <div class="block-content text-center  ">
                                    <img width="200" height="150" src="data:image/png;base64,{{ chunk_split(base64_encode($row->HAPPY_NET_REWARD_IMAGE)) }}">

                                </div>
                                <style>
                                    .a {

                                         display: block;
                                        width: 100%;
                                        height: 20px;
                                        /* border: 1px solid #09C;
                                        background-color: #CFC; */
                                        word-wrap: break-word; 
                                        
                                    }

                                </style>

                                <div class="block-content text-center">
                                    <h1 class="font-w800 text-dark mb-1 a">
                                        <span style="color: #999"> ชื่อของรางวัล :</span>
                                        {{ $row->HAPPY_NET_REWARD_NAME }}
                                    </h1>

                                </div><br>
                                <div class="block-content block-content-full bg-body-light">
                                    <div class="row no-gutters font-size-sm text-center">
                                        <div class="col-6">
                                            <span class="text-muted font-w600">
                                                <i class="fab fa-bitcoin mr-1"></i> {{ $row->HAPPY_NET_REWARD_PRICE }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-muted font-w600">
                                                <i class="fa fa-shopping-basket mr-1"></i> คงเหลือ :
                                                {{ $row->HAPPY_NET_REWARD_QUANTITY }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- END Story #7 -->
                        </div>
                    @endforeach


                </div>
            </div> <br><br>
        </div>
    </div>

@endsection

@section('footer')




    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>


@endsection
