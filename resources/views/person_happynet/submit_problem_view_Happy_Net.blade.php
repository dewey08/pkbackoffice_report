@extends('layouts.happy')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    use App\Http\Controllers\DashboardController;
    $checkhappy_ed = DashboardController::checkhappy_ed($id_user);
    $checkhappy_re = DashboardController::checkhappy_re($id_user);
    $checkhappy_re = DashboardController::checkhappy_ps($id_user);
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
                <h3 class="block-title text-center fs-24">งานสำเร็จแล้ว
                </h3>
            </div>
            <hr>

        </div>
        <div class="block-content  shadow">
            <div class="col-12">
                <div class="block-content">


<<<<<<< HEAD
=======
                      

                        <div class="col-12 row">
                            <div class="col-3">
                                <center>
                                    @if ($pr_id->HR_IMAGE == null)
                                        <img src="{{ asset('image/pers.png') }}" height="100%" width="60%">
                                    @else
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($pr_id->HR_IMAGE)) }}"
                                            height="100%" width="60%">
                                    @endif
                                </center>
>>>>>>> 62f266ce93539756531371e4df0de4462a6ca3d4



                    <div class="col-12 row">
                        <div class="col-3">
                            <center>
                                @if ($pr_id->HR_IMAGE == null)
                                    <img src="{{ asset('image/pers.png') }}" height="100%" width="60%">
                                @else
                                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($pr_id->HR_IMAGE)) }}"
                                        height="100%" width="60%">
                                @endif
                            </center>


                        </div>
                        <div class="col-9">
                            <div class="col-12 row">
                                <div class="col-6">
                                    <label for="HAPPY_NET_COIMPLIMENT">ชื่อ : </label>
                                    <input type="text" class="form-control " id="HAPPY_NET_PROBLEM_FNAME"
                                        name="HAPPY_NET_PROBLEM_FNAME" value="{{ $pr_id->HAPPY_NET_PROBLEM_FNAME }}"
                                        readonly>
                                </div>
                                <div class="col-6">
                                    <label for="HAPPY_NET_COIMPLIMENT">นามสกุล : </label><span> <input type="text"
                                            class="form-control " id="HAPPY_NET_PROBLEM_LNAME"
                                            name="HAPPY_NET_PROBLEM_LNAME" value="{{ $pr_id->HAPPY_NET_PROBLEM_LNAME }}"
                                            readonly></span>
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="HAPPY_NET_PROBLEM">ข้อความ</label>
                                    <textarea class="form-control" id="HAPPY_NET_PROBLEM" name="HAPPY_NET_PROBLEM"
                                        rows="8" placeholder="คำถาม/ปัญหา/งานที่มอบหมาย" required
                                        readonly>{{ $pr_id->HAPPY_NET_PROBLEM }} </textarea>
                                </div>
                                <br>
<<<<<<< HEAD
                                <div class="form-group">
                                    <label class="d-block"> <span style="color:rgb(90, 90, 90) ">ระดับ
                                            :
                                            {{ $pr_id->HAPPY_NET_DIFFICULTY_ID }}</span></label>

                                    <div readonly class="js-rating"
                                        data-score="{{ $pr_id->HAPPY_NET_DIFFICULTY_ID }}"></div>

                                    <h1 style="color: rgb(92, 92, 92);">เมื่องานสำเร็จเพื่อนจะได้ :
                                        {{ $pr_id->HAPPY_NET_COIN }} COIN</h1>



                                    @if ($checkhappy_re != 0)
                               
                                    @else
                                        @if ($coin)

                                            @if ($coins > $set_coin)
                                                <h1 style="color: red;">เนื่องจากวันนี้คุณให้ COIN เพื่อนเกินจำนวน
                                                    งานนี้จะสำเร็จแต่เพื่อนร่วมงานจะไม่ได้ COIN</h1>
                                            @else
                                                @if ($A < 0)
                                                    <h1 style="color: red;">คุณสามารถให้ COIN เพื่อนวันนี้ ได้ไม่เกิน
                                                        :&nbsp;0
                                                        &nbsp;COIN</h1>
                                                @else
                                                    <h1 style="color: red;">คุณสามารถให้ COIN เพื่อนวันนี้ ได้ไม่เกิน
                                                        :&nbsp;{{ $A }}
                                                        &nbsp;COIN</h1>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
=======
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="HAPPY_NET_PROBLEM">ข้อความ</label>
                                        <textarea class="form-control" id="HAPPY_NET_PROBLEM"
                                            name="HAPPY_NET_PROBLEM" rows="8"
                                            placeholder="คำถาม/ปัญหา/งานที่มอบหมาย"
                                            required readonly>{{ $pr_id->HAPPY_NET_PROBLEM }} </textarea>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="d-block"> <span style="color:rgb(90, 90, 90) ">ระดับ
                                                :
                                                {{ $pr_id->HAPPY_NET_DIFFICULTY_ID }}</span></label>
                           
                                                <div readonly class="js-rating"
                                                data-score="{{ $pr_id->HAPPY_NET_DIFFICULTY_ID }}"></div>
                                                
                                                <h1 style="color: rgb(92, 92, 92);">เมื่องานสำเร็จเพื่อนจะได้  : {{ $pr_id->HAPPY_NET_COIN }}  COIN</h1>
                                                
                                
                                               

                                                @if ($coin)

                                                    @if ($coins > $set_coin)
                                                    <h1 style="color: red;">เนื่องจากวันนี้คุณให้ COIN เพื่อนเกินจำนวน งานนี้จะสำเร็จแต่เพื่อนร่วมงานจะไม่ได้ COIN</h1>
                                                        @else
                                                            @if ($A < 0)
                                                            <h1 style="color: red;">คุณสามารถให้ COIN เพื่อนวันนี้ ได้ไม่เกิน :&nbsp;0 
                                                                &nbsp;COIN</h1>
                                                                @else
                                                                <h1 style="color: red;">คุณสามารถให้ COIN เพื่อนวันนี้ ได้ไม่เกิน :&nbsp;{{$A}} 
                                                                    &nbsp;COIN</h1>
                                                            @endif
                                                       
                                                    @endif
                                                @endif
                                              
>>>>>>> 62f266ce93539756531371e4df0de4462a6ca3d4

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="block-content block-content-full text-right bg-light">


                </div>
            </div>

        </div>
        @if ($checkhappy_re != 0)

        <form action="{{ route('happy.submit_problems') }}" method="post">
            @csrf
<<<<<<< HEAD
            <input type="hidden" id="receive" name="receive" value="{{ $pr_id->ID_USER }}">
            <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID"
                value="{{ $pr_id->HAPPY_NET_PROBLEM_ID }}">
            <input type="hidden" id="HAPPY_NET_PROBLEM_STATUS" name="HAPPY_NET_PROBLEM_STATUS" value="False">
            <input type="hidden" name="HAPPY_NET_COIN" id="HAPPY_NET_COIN"
                value="{{ $pp1->HAPPY_NET_DIFFICULTY_COIN }}">
=======
            <input type="hidden" id="receive" name="receive" value="{{$pr_id->ID_USER }}">
                        <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID" value="{{ $pr_id->HAPPY_NET_PROBLEM_ID }}">
                        <input type="hidden" id="HAPPY_NET_PROBLEM_STATUS" name="HAPPY_NET_PROBLEM_STATUS" value="False">
            <input type="hidden" name="HAPPY_NET_COIN" id="HAPPY_NET_COIN" value="{{ $pp1->HAPPY_NET_DIFFICULTY_COIN }}">
>>>>>>> 62f266ce93539756531371e4df0de4462a6ca3d4
            <input type="hidden" name="HAPPY_NET_COIN_TYPE" id="HAPPY_NET_COIN_TYPE" value="ช่วยปัญหาจากบุคลากร">


            <div class="block-content block-content-full text-right bg-light">
                <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID"
                    value="{{ $pr_id->HAPPY_NET_PROBLEM_ID }}">
                <input type="hidden" id="HAPPY_NET_PROBLEM_STATUS" name="HAPPY_NET_PROBLEM_STATUS" value="True">
                <button type="sumit" class="btn btn-md btn-primary loadscreen"><i
                        class="far fa-check-circle fa-1x"></i><span>&nbsp;ยืนยัน</button>
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i
                        class="far fa-times-circle fa-1x"></i><span>&nbsp;ยกเลิก</button>

            </div>
        </form>
           
        @else

        <form action="{{ route('happy.submit_problem') }}" method="post">
            @csrf
            <input type="hidden" id="receive" name="receive" value="{{ $pr_id->ID_USER }}">
            <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID"
                value="{{ $pr_id->HAPPY_NET_PROBLEM_ID }}">
            <input type="hidden" id="HAPPY_NET_PROBLEM_STATUS" name="HAPPY_NET_PROBLEM_STATUS" value="False">
            <input type="hidden" name="HAPPY_NET_COIN" id="HAPPY_NET_COIN"
                value="{{ $pp1->HAPPY_NET_DIFFICULTY_COIN }}">
            <input type="hidden" name="HAPPY_NET_COIN_TYPE" id="HAPPY_NET_COIN_TYPE" value="ช่วยปัญหาจากบุคลากร">


            <div class="block-content block-content-full text-right bg-light">
                <input type="hidden" id="HAPPY_NET_PROBLEM_ID" name="HAPPY_NET_PROBLEM_ID"
                    value="{{ $pr_id->HAPPY_NET_PROBLEM_ID }}">
                <input type="hidden" id="HAPPY_NET_PROBLEM_STATUS" name="HAPPY_NET_PROBLEM_STATUS" value="True">
                <button type="sumit" class="btn btn-md btn-primary loadscreen"><i
                        class="far fa-check-circle fa-1x"></i><span>&nbsp;ยืนยัน</button>
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal"><i
                        class="far fa-times-circle fa-1x"></i><span>&nbsp;ยกเลิก</button>

            </div>
        </form>
        @endif





    @endsection

    @section('footer')
        <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
        <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                                                                                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

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




        {{-- test --}}

        {{-- <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script> --}}
        <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/raty-js/jquery.raty.js') }}"></script>
        <script src="{{ asset('asset/js/pages/be_comp_rating.min.js') }}"></script>
    @endsection
