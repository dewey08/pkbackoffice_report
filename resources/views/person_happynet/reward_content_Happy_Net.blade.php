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

    <div class="block mb-4" style="width: 95%;margin:auto">
    
        <div class="block-content">
            <div class="block-header block-header-default">
                       <div class="col-6"> <h3 class="block-title text-left fs-30">รายละเอียดของรางวัล</h3></div>
                        <div class="col-6"> <a class="btn btn-rounded btn-warning loadscreen" style="float: right;"
                            href="{{ url('person_happynet/reward_Happy_Net') }}"><i
                                class="far fa-arrow-alt-circle-left  fa-1x">&nbsp;&nbsp;</i>ย้อนกลับ</a></div>
                    </div>
            <hr>
        </div>
     
        <div class="col-xl-12 row ">
            <div class="col-6 content ">
                <center>
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox"
                        href="{{ asset($con1->HAPPY_NET_REWARD_IMAGE) }}">
                        <img class="" style="width: 400px; height: 100%;"
                        src="data:image/png;base64,{{ chunk_split(base64_encode($con1->HAPPY_NET_REWARD_IMAGE)) }}">
                    </a>
                </center>
                {{-- <img width="100%"  src="{{ asset($row->HAPPY_NET_REWARD_IMAGE) }}"> --}}
                <br>
            </div>
            <div class="col-6 content shadow">

                <h1 style="font-size: 2.1em;">
                    ชื่อของรางวัล : <span style="color: #454545;">{{ $con1->HAPPY_NET_REWARD_NAME }}</span>
                </h1>

                <h5 style="font-size: 17px">รายละเอียดของรางวัล</h5>
                <p style="font-size: 17px">{{ $con1->HAPPY_NET_REWARD_DETAILS }}</p>

                <button class="btn btn-hero-primary" style="background-color: #082f5a;" disabled>ราคา &nbsp;:
                    &nbsp;{{ $con1->HAPPY_NET_REWARD_PRICE }}
                    &nbsp;<i class="fab fa-bitcoin mr-1"></i></button><span> <button class="btn btn-hero-primary"
                        style="background-color: #868686;" disabled>จำนวน &nbsp;:
                        &nbsp;{{ $con1->HAPPY_NET_REWARD_QUANTITY }}
                        &nbsp;<i class="fa fa-shopping-basket mr-1"></i></button></span>
                <br><br>
                <p style="font-size: 17px">หมายเหตุ * {{ $con1->HAPPY_NET_REWARD_DETAILS2 }}</p><br>

                <button type="button" style="float: right;" class="btn btn-success btn-xl push" data-toggle="modal"
                    data-target="#modal-block-popin"><i
                        class="fa fa-shopping-cart fa-1x">&nbsp;&nbsp;</i>แลกของรางวัล</button>
                <!-- Pop In Block Modal -->
                <div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog"
                    aria-labelledby="modal-block-popin" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-popin" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">ยืนยันการแลกของรางวัล</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">

                                    <form action="{{ route('happy.send_reward') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12 text-center">
                                            <h1 style="font-size: 150%">" ท่านต้องการยืนยันการแลกของรางวัลชิ้นนี้"</h1><br>
                                        </div>
                                        <input type="hidden" id="HAPPY_NET_REWARD_ID" name="HAPPY_NET_REWARD_ID"
                                            value="{{ $con1->HAPPY_NET_REWARD_ID }}">


                                        <center> <input type="" style="font-size: 150%" id="HAPPY_NET_REWARD_NAME"
                                                class="form-control text-center" name="HAPPY_NET_REWARD_NAME" readonly
                                                value="{{ $con1->HAPPY_NET_REWARD_NAME }}">
                                        </center><br>
                                        <div class="form-group">
                                            <label for="QUANTITY" style="font-size: 130%"
                                                class="text-left">จำนวน</label>
                                            <input type="text" style="font-size: 150%" required class="form-control"
                                                id="QUANTITY" name="QUANTITY" placeholder="กรอกเฉพาะตัวเลข"
                                                onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข '); this.value='';}">
                                        </div>

                                        <input type="hidden" id="HAPPY_NET_ORDER_STATUS" name="HAPPY_NET_ORDER_STATUS"
                                            value="False">
                                        {{-- <input type="hidden" id="HAPPY_NET_SHOP_TYPE" name="HAPPY_NET_SHOP_TYPE" value="ซื้อของรางวัล"> --}}

                                        <div class="block-content block-content-full text-right bg-light">
                                            {{-- onclick="alert('แลกของรางวัลสำเหร็จ รายละเอียดการติดต่อขอรับของรางวัลดูที่หมายเหตุ')" --}}
                                            <button type="sumit" class="btn btn-md btn-primary"><i
                                                    class="far fa-check-circle fa-1x"></i><span>&nbsp;ยืนยัน</button>
                                            <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i
                                                    class="far fa-times-circle fa-1x"></i><span>&nbsp;ยกเลิก</button>

                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Pop In Block Modal -->

            </div>

        </div>











    @endsection

    @section('footer')




    @endsection
