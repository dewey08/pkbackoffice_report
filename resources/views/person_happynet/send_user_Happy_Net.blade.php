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
    {{-- คอมเมนต์ --}}
    <style>
        body {
            background: #eee
        }

        .date {
            font-size: 11px
        }

        .comment-text {
            font-size: 12px
        }

        .fs-12 {
            font-size: 12px
        }

        .shadow-none {
            box-shadow: none
        }

        .name {
            color: #000000
        }

        .cursor:hover {
            color: blue
        }

        .cursor {
            cursor: pointer
        }

        .textarea {
            resize: none
        }

        .fa-facebook {
            color: #3b5999
        }

        .fa-twitter {
            color: #55acee
        }

        .fa-linkedin {
            color: #0077B5
        }

        .fa-instagram {
            color: #e4405f
        }

        .fa-dribbble {
            color: #ea4c89
        }

        .fa-pinterest {
            color: #bd081c
        }

        .fa {
            cursor: pointer
        }

    </style>


    {{-- กำหนดตาราง --}}
    <style>
        #table-wrapper {
            height: 100px;
            width: 400px;
            padding: 0px;
            margin: 0px auto 0px auto;
            overflow: auto;

        }

        table {
            width: 100%;
            max-height: 50px;
            padding: 15px;
            text-align: left;
            border-collapse: collapse;

        }

        table>tbody>tr {
            font-size: 14px;
        }

        table>tbody>tr:first-child {
            font-size: 16px;
        }

        table>tbody>tr>th {
            padding: 5px 10px;
        }

        table>tbody>tr>th:nth-child(1),
        table>tbody>tr>th:nth-child(2) {}

        table>tbody>tr>td {
            padding: 2px 5px 2px 10px;
        }

    </style>
    {{--  --}}



    {{-- ปุ่มกดไลค์ --}}

    <style>
        /* body {
                                                                                                                                        font-size: 16px;
                                                                                                                                    } */

        a {
            cursor: pointer;
        }

        .middle-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 95vh;
        }

        .like-wrapper {
            display: flex;
            justify-content: space-around;
            flex-flow: row wrap;
            width: 50%;
        }

        .like-button {
            /* border: 2px solid #c7c7c7;
                                                                                                                                        border-radius: 40px; */
            padding: 0.45rem 0.75rem;
            color: #878787;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: grayscale(100%);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .like-button.liked {
            color: #ff6e6f;
            border-color: currentColor;
            filter: grayscale(0);
        }

        .like-button:hover {
            border-color: currentColor;
        }

        .like-icon {
            width: 18px;
            height: 16px;
            display: inline-block;
            position: relative;
            margin-right: 0.25em;
            font-size: 1.5rem;
            background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAyMSAxOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTAuMTAxIDQuNDE3UzguODk1LjIwNyA1LjExMS4yMDdjLTQuNDY1IDAtMTAuOTY3IDYuODQ2IDUuMDgyIDE3LjU5MkMyNS4yMzcgNy4wMyAxOS42NjUuMjAyIDE1LjUwMS4yMDJjLTQuMTYyIDAtNS40IDQuMjE1LTUuNCA0LjIxNXoiIGZpbGw9IiNGRjZFNkYiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==") no-repeat center;
            background-size: 100%;
            -webkit-animation: heartUnlike 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartUnlike 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        .liked .like-icon {
            -webkit-animation: heartPulse 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartPulse 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        .liked .like-icon [class^=heart-animation-] {
            background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAyMSAxOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTAuMTAxIDQuNDE3UzguODk1LjIwNyA1LjExMS4yMDdjLTQuNDY1IDAtMTAuOTY3IDYuODQ2IDUuMDgyIDE3LjU5MkMyNS4yMzcgNy4wMyAxOS42NjUuMjAyIDE1LjUwMS4yMDJjLTQuMTYyIDAtNS40IDQuMjE1LTUuNCA0LjIxNXoiIGZpbGw9IiNGRjZFNkYiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPjwvc3ZnPg==") no-repeat center;
            background-size: 100%;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 16px;
            height: 14px;
            opacity: 0;
        }

        .liked .like-icon [class^=heart-animation-]::before,
        .liked .like-icon [class^=heart-animation-]::after {
            content: "";
            background: inherit;
            background-size: 100%;
            width: inherit;
            height: inherit;
            display: inherit;
            position: relative;
            top: inherit;
            left: inherit;
            opacity: 0;
        }

        .liked .like-icon .heart-animation-1 {
            -webkit-animation: heartFloatMain-1 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatMain-1 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        .liked .like-icon .heart-animation-1::before,
        .liked .like-icon .heart-animation-1::after {
            width: 12px;
            height: 10px;
            visibility: hidden;
        }

        .liked .like-icon .heart-animation-1::before {
            opacity: 0.6;
            -webkit-animation: heartFloatSub-1 1s 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatSub-1 1s 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        .liked .like-icon .heart-animation-1::after {
            -webkit-animation: heartFloatSub-2 1s 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatSub-2 1s 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            opacity: 0.75;
        }

        .liked .like-icon .heart-animation-2 {
            -webkit-animation: heartFloatMain-2 1s 0.1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatMain-2 1s 0.1s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        .liked .like-icon .heart-animation-2::before,
        .liked .like-icon .heart-animation-2::after {
            width: 10px;
            height: 8px;
            visibility: hidden;
        }

        .liked .like-icon .heart-animation-2::before {
            -webkit-animation: heartFloatSub-3 1s 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatSub-3 1s 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            opacity: 0.25;
        }

        .liked .like-icon .heart-animation-2::after {
            -webkit-animation: heartFloatSub-4 1s 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            animation: heartFloatSub-4 1s 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
            opacity: 0.4;
        }

        @-webkit-keyframes heartPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.5);
            }
        }

        @keyframes heartPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.5);
            }
        }

        @-webkit-keyframes heartUnlike {
            50% {
                transform: scale(0.75);
            }
        }

        @keyframes heartUnlike {
            50% {
                transform: scale(0.75);
            }
        }

        @-webkit-keyframes heartFloatMain-1 {
            0% {
                opacity: 0;
                transform: translate(0) rotate(0);
            }

            50% {
                opacity: 1;
                transform: translate(0, -25px) rotate(-20deg);
            }
        }

        @keyframes heartFloatMain-1 {
            0% {
                opacity: 0;
                transform: translate(0) rotate(0);
            }

            50% {
                opacity: 1;
                transform: translate(0, -25px) rotate(-20deg);
            }
        }

        @-webkit-keyframes heartFloatMain-2 {
            0% {
                opacity: 0;
                transform: translate(0) rotate(0) scale(0);
            }

            50% {
                opacity: 0.9;
                transform: translate(-10px, -38px) rotate(25deg) scale(1);
            }
        }

        @keyframes heartFloatMain-2 {
            0% {
                opacity: 0;
                transform: translate(0) rotate(0) scale(0);
            }

            50% {
                opacity: 0.9;
                transform: translate(-10px, -38px) rotate(25deg) scale(1);
            }
        }

        @-webkit-keyframes heartFloatSub-1 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(13px, -13px) rotate(30deg);
            }
        }

        @keyframes heartFloatSub-1 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(13px, -13px) rotate(30deg);
            }
        }

        @-webkit-keyframes heartFloatSub-2 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(18px, -10px) rotate(55deg);
            }
        }

        @keyframes heartFloatSub-2 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(18px, -10px) rotate(55deg);
            }
        }

        @-webkit-keyframes heartFloatSub-3 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(-10px, -10px) rotate(-40deg);
            }

            100% {
                transform: translate(-50px, 0);
            }
        }

        @keyframes heartFloatSub-3 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(-10px, -10px) rotate(-40deg);
            }

            100% {
                transform: translate(-50px, 0);
            }
        }

        @-webkit-keyframes heartFloatSub-4 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(2px, -18px) rotate(-25deg);
            }
        }

        @keyframes heartFloatSub-4 {
            0% {
                visibility: hidden;
                transform: translate(0) rotate(0);
            }

            50% {
                visibility: visible;
                transform: translate(2px, -18px) rotate(-25deg);
            }
        }

    </style>


    {{--  --}}
@endsection
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('chomsuccess'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('chomsuccess') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('prosuccess'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('prosuccess') !!}</li>
            </ul>
        </div>
    @endif

    @if (\Session::has('Esuccess'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('Esuccess') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('Epsuccess'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('Epsuccess') !!}</li>
            </ul>
        </div>
    @endif

    <style>
        .shoadow_1 {
            width: 100%;
            height: 500%;
            /* padding: 15px; */
            background-color: #ffffff;
            box-shadow: 5px 6px 4px rgb(190, 190, 190);
            border: 1px solid #e2e2e2;
        }

    </style>
    <div class="" style="width: 95%;margin:auto">
        <div class="block-content shoadow_1">
            <div class="block-header block-header-default">
                <div class="col-2"></div>
                <div class="col-8">
                    <h3 class="block-title text-center fs-24 ">เพื่อนช่วยเพื่อน
                    </h3>
                </div>

          
                <div class="col-2"> <a class="btn btn-hero btn-info " style="float: right;"
                    href="{{ url('person_happynet/history_send_user_Happy_Net') }}"><i
                        class="fa fa-book fa-1x">&nbsp;&nbsp;</i>ประวัติงานทั้งหมด</a></div>
            </div>
            <hr>
            {{-- <div class="block-content my-3 shadow"> --}}
            <div class="row">
                <div class="col-md-3 col-xl-6">
                    <a class="block block-rounded block-link-pop  bg-sl2-s3">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-25" style="font-size: 2.15rem;">
                                    เพื่อน...ช่วยเรา
                                </p>

                                <p class="text-white mb-0" style="font-size: 2rem;">
                                    <span>{{ $problem_idsum }}</span>&nbsp;<span class="fs-20 ">ครั้ง</span>
                                </p>


                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-file-import fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xl-6">
                    <a class="block block-rounded block-link-pop   bg-sl2-sb5">
                        <div class="block-content block-content-full d-flex justify-content-between">
                            <div class="ml-2 left">
                                <p class="text-white mb-0 fs-25" style="font-size: 2.15rem;">
                                    เรา..ช่วยเพื่อน
                                </p>

                                <p class="text-white mb-0" style="font-size: 2rem;">
                                    <span>{{ $problem_idsum_get }}</span>&nbsp;<span class="fs-20 ">ครั้ง</span>
                                </p>


                            </div>
                            <div class="mr-2 right d-flex justify-content-center align-items-top">
                                <i class="fa fa-file-export fa-3x text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            {{-- <div class="container"><br> --}}
            <br>
            <div class="row">
                <div class="col-12">



                    <div class="row">
                        <div class="col-xl-2">
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-10">
                                        <input data-toggle="modal" readonly data-target="#modal-block-large"
                                            class="form-control form-control-alt" placeholder="ค้นหารายชื่อได้ที่นี่">

                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-sm btn-info " data-toggle="modal"
                                            data-target="#modal-block-large">
                                            <i class="fa fa-search "></i> ค้นหา
                                        </button>

                                    </div>

                                </div>
                                <div class="col-12">
                                    <br>
                                
                                              @if ($countview < 0)
                                              <p class="text-center"> คุณวันนี้สามารถขอความช่วยเหลือเพื่อนได้ 0 ครั้ง</p>  
                                              @else
                                              <p class="text-center"> คุณวันนี้สามารถขอความช่วยเหลือเพื่อนได้ {{$countview}} ครั้ง</p>    
                                              @endif
                                         
                                         </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
            
            {{-- </div> --}}
            {{-- </div> --}}
            <!-- endrow -->

        </div>
        {{-- <div class="block-content  shadow"> --}}



        <br>
        <div class="" style=" background-color: #eeeeee;">
            <div class="col-12 row">
                <div class="col-md-6">
                    <div class="block-content">
                        {{-- <hr> --}}
                        <div class="block-header block-header-default shoadowhead">
                            <h3 class="block-title text-center fs-24">
                                สอบถาม / ขอความช่วยเหลือ
                            </h3>
                        </div>
                    </div>
                    <div class="block-content">
                        <?php $number = -99999999999999; ?>
                        <?php $numbers = -9999999; ?>
                        @foreach ($problem_id as $row)
                            <?php $number++; ?>
                            <?php $numbers++; ?>
                            <style>
                                #rcorners2 {
                                    border-radius: 15px;
                                    /* background: #f3f3f3; */
                                    padding: 10px;
                                    width: 100%;
                                    height: 100%;
                                    /* font-size: 15px; */
                                }

                                .shoadows {
                                    width: 300px;
                                    height: 100px;
                                    padding: 15px;
                                    background-color: #ffffff;
                                    box-shadow: 5px 5px 3px rgb(190, 190, 190);
                                    border: 2px solid #4dc9ff;
                                }

                            </style>

                            <div class="col-12 content shoadows" id="rcorners2">
                                <div class="container mt-4">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column comment-section" id="myGroup">
                                                <div class="p-2">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="hidden" name="HAPPY_NET_PROBLEM_ID"
                                                                id="HAPPY_NET_PROBLEM_ID"
                                                                value="{{ $row->HAPPY_NET_PROBLEM_ID }}">
                                                            <div class="d-flex flex-row user-info">
                                                                @if ($row->HR_IMAGE == null)
                                                                    <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                        src="{{ asset('image/pers.png') }}" width="50px">
                                                                @else
                                                                    <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                        src="data:image/png;base64,{{ chunk_split(base64_encode($row->HR_IMAGE)) }}"
                                                                        width="50px">
                                                                @endif

                                                                {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}

                                                                <div class="d-flex flex-column justify-content-start ml-2">
                                                                    <span
                                                                        class="d-block font-weight-bold name">{{ $row->HAPPY_NET_PROBLEM_FNAME }}
                                                                        &nbsp;
                                                                        {{ $row->HAPPY_NET_PROBLEM_LNAME }}</span><span
                                                                        class="date text-black-50">
                                                                        {{ Datethai($row->updated_at) }}</span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 ">
                                                            @if ($row->HAPPY_NET_PROBLEM_STATUS == 'True')
                                                                <div class="text-right" style="color: green;"><i
                                                                        class="fa fa-fw fa-check-circle text-success fa-2x"></i>
                                                                </div>
                                                            @else
                                                                <div class="text-right">
                                                                    <a type="button"
                                                                        class="btn btn-rounded btn-outline-secondary text-right loadscreen"
                                                                        href="{{ url('person_happynet/edit_problem_Happy_Net/' . $row->HAPPY_NET_PROBLEM_ID) }}">แก้ไข</a>

                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>

                                                    <div class="mt-1"><br>
                                                        <div class=" col-12">
                                                            <div class="row col-6">
                                                                <h4 class="comment-text" style="font-size:17px">
                                                                    <span><b>หัวเรื่อง :
                                                                        </b></span>{{ $row->HAPPY_NET_PROBLEM_HEAD }}
                                                                </h4>


                                                            </div>
                                                            <div class="js-rating"
                                                                data-score="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                                            </div>
                                                            <div class="col-6 row ">
                                                                {{-- <div class="collapsable-comment comment-text"> --}}
                                                                <div class="text-right" data-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse-{{ $number }}"
                                                                    href="#collapse-{{ $number }}">
                                                                    รายละเอียด คลิกที่นี่ &nbsp;&nbsp;<i
                                                                        class="fa fa-chevron-down "></i>
                                                                </div>
                                                                {{-- </div> --}}




                                                            </div>



                                                            <div id="collapse-{{ $number }}" class="collapse">
                                                                <div class="commented-section mt-2">
                                                                    <div class="comment-text-sm">
                                                                        <span
                                                                            style="font-size:1.2em;">{{ $row->HAPPY_NET_PROBLEM }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <?php
                                                // $anss = DB::table('happy_net_problem')
                                                //     ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                                //     ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                                //     ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                                //     ->where('HAPPY_NET_PROBLEM_ID', '=', $row->HAPPY_NET_PROBLEM_ID)
                                                //     // ->first();
                                                //     ->count();
                                                //
                                                ?>

                                                <?php
                                                $anss = DB::table('happy_net_problem')
                                                    // ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                                    ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                                    // ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                                
                                                    ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $row->HAPPY_NET_PROBLEM_ID)
                                                    // ->whereNotNull('HAPPY_NET_PROBLEM_ID')
                                                
                                                    ->count();
                                                
                                                // dd($anss);
                                                
                                                ?>
                                                <div class=" p-2">
                                                    <div class="d-flex flex-row fs-12">
                                                        <div class="col-12">
                                                            <div class="row ">

                                                                @if ($row->HAPPY_NET_PROBLEM_STATUS == 'True')
                                                                    <a class="btn">
                                                                        <div class="like p-2 cursor action-collapse "
                                                                            data-toggle="collapse" aria-expanded="true"
                                                                            aria-controls="" href=""><i
                                                                                class="fa fa-comment fa-1x"></i>
                                                                            <span class="ml-1">
                                                                                &nbsp;แสดงความคิดเห็น</span>
                                                                        </div>
                                                                    </a>
                                                                    <a class="btn">
                                                                        <div class="like p-2 cursor action-collapse "
                                                                            data-toggle="collapse" aria-expanded="true"
                                                                            aria-controls="" href=""><span
                                                                                style="color: "><i
                                                                                    class="fa fa-eye fa-1x"></i></span><span
                                                                                class="ml-1">
                                                                                {{ $anss }}
                                                                                &nbsp;ความคิดเห็น</span>
                                                                        </div>
                                                                    </a>
                                                                @else
                                                                    <a class="btn">
                                                                        <div class="like p-2 cursor action-collapse "
                                                                            data-toggle="collapse" aria-expanded="true"
                                                                            aria-controls="collapse-{{ $numbers }}"
                                                                            href="#collapse-{{ $numbers }}"><i
                                                                                class="fa fa-comment fa-1x"></i><span
                                                                                class="ml-1">
                                                                                &nbsp;แสดงความคิดเห็น</span>
                                                                        </div>
                                                                    </a>
                                                                    <a class="btn">
                                                                        <div class="like p-2 cursor action-collapse "
                                                                            data-toggle="collapse" aria-expanded="true"
                                                                            aria-controls="collapse-{{ $numbers }}"
                                                                            href="#collapse-{{ $numbers }}"><i
                                                                                class="fa fa-eye fa-1x"></i><span
                                                                                class="ml-1">
                                                                                {{ $anss }}
                                                                                &nbsp;ความคิดเห็น</span>
                                                                        </div>
                                                                    </a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="collapse-{{ $numbers }}" class=" p-2 collapse" data-parent="#myGroup">
                                        <div class="d-flex flex-row align-items-start">
                                            @if ($inforpersons->HR_IMAGE == null)
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="{{ asset('image/pers.png') }}" width="50px">
                                            @else
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersons->HR_IMAGE)) }}"
                                                    width="50px">
                                            @endif
                                            &nbsp;&nbsp;

                                            <div class="col-12">
                                                <form action="{{ route('happy.respond_ans') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf


                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ID"
                                                        name="HAPPY_NET_PROBLEM_ID"
                                                        value="{{ $row->HAPPY_NET_PROBLEM_ID }}">

                                                    <input type="hidden" id="ID_USER" name="ID_USER"
                                                        value="{{ $id_user }}">


                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                                        name="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                                        value="{{ $inforpersons->HR_FNAME }}">
                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                                        name="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                                        value="{{ $inforpersons->HR_LNAME }}">


                                                    <div class="row">

                                                        <div class="col-8">
                                                            <input class="form-control mr-3  shadow-none "
                                                                name="HAPPY_NET_PROBLEM_ANSWER"
                                                                id="HAPPY_NET_PROBLEM_ANSWER">
                                                        </div>
                                                        <div class="col-4">
                                                            <span>
                                                                <button class="button shadow-none loadscreen"
                                                                    type="sumbit"><i
                                                                        class="fa fa-location-arrow "></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                                <br>
                                            </div>
                                            <style>
                                                .button {
                                                    background-color: #4CAF50;
                                                    border: none;
                                                    color: white;
                                                    padding: 10px 20px;
                                                    /* text-align: center; */
                                                    text-decoration: none;
                                                    display: inline-block;
                                                    /* font-size: 16px; */
                                                    margin: -2px 2px;
                                                    cursor: pointer;
                                                    border-radius: 10px;
                                                }

                                                .shoadowhead {
                                                    width: 100%;
                                                    height: 100px;
                                                    padding: 15px;
                                                    background-color: #ffffff;
                                                    box-shadow: 5px 5px 3px rgb(190, 190, 190);
                                                    border: 1px solid #e2e2e2;
                                                    border-radius: 5px;
                                                }

                                            </style>
                                        </div>
                                        <div class="mt-2">
                                            <?php
                                            $ans = DB::table('happy_net_problem')
                                                ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                                ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                                ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                                ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $row->HAPPY_NET_PROBLEM_ID)
                                                // ->first();
                                                ->get();
                                            // dd($ans);
                                            ?>
                                            @foreach ($ans as $rows)
                                                <div class="commented-section mt-2">
                                                    <input type="hidden" name="HAPPY_NET_PROBLEM_ANSWER_ID"
                                                        id="HAPPY_NET_PROBLEM_ANSWER_ID"
                                                        value="{{ $rows->HAPPY_NET_PROBLEM_ANSWER_ID }}">
                                                    <input type="hidden" name="HAPPY_NET_PROBLEM_QUESTION_ID"
                                                        id="HAPPY_NET_PROBLEM_QUESTION_ID"
                                                        value="{{ $rows->HAPPY_NET_PROBLEM_QUESTION_ID }}">



                                                    <div class="float-left image">
                                                        {{-- @if ($inforpersons->HR_IMAGE == null)
                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                            src="{{ asset('image/pers.png') }}" width="50">
                                            @else
                                            <img class="img-fluid img-responsive rounded-circle mr-2"
                                                src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersons->HR_IMAGE)) }}"
                                                width="50">


                                            @endif --}}


                                                        {{-- @if ($inforpersons->HR_IMAGE == null)
                                            <img class="img-fluid img-responsive rounded-circle mr-2"
                                                src="{{ asset('image/pers.png') }}" width="50px" height="50px">
                                            @else
                                            <img class="img-fluid img-responsive rounded-circle mr-2"
                                                src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER) }}"
                                                width="50px" height="50px">
                                            @endif --}}

                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="data:image/png;base64, {{ Happy_Net_Controller::person_image($rows->ID_USER) }}"
                                                            width="50">

                                                    </div>

                                                    <div class="d-flex flex-row align-items-center commented-user">
                                                        <B class="mr-2">
                                                            {{ $rows->HAPPY_NET_PROBLEM_ANSWER_FNAME }}
                                                            &nbsp;
                                                            {{ $rows->HAPPY_NET_PROBLEM_ANSWER_LNAME }}</B>


                                                    </div>
                                                    <div class="d-flex flex-row align-items-center commented-user">

                                                        <span style="color: #878787">
                                                            {{ Datethai($rows->updated_at) }}</span> <i
                                                            class="fab fa-vr-cardboard"></i><br>


                                                    </div>
                                                    <div class="comment-text-md">
                                                        <div class="col-12">
                                                            <br> &nbsp; &nbsp; &nbsp;
                                                            <span>{{ $rows->HAPPY_NET_PROBLEM_ANSWER }}</span>
                                                        </div>
                                                        <hr>
                                                    </div>



                                                </div>
                                            @endforeach
                                            <div class="col-12">
                                                <div class="row ">
                                                    @if ($row->HAPPY_NET_PROBLEM_STATUS == 'True')
                                                    @else
                                                        <a type="button" class="btn btn-sm btn-rounded btn-hero-success"
                                                            href="{{ url('person_happynet/submit_problem_view_Happy_Net/' . $row->HAPPY_NET_PROBLEM_ID) }}"><i
                                                                class="far fa-check-circle "></i>&nbsp;งานสำเร็จ</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <br>
                        @endforeach



                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-content">
                        {{-- <hr> --}}
                        <div class="block-header block-header-default shoadowhead">
                            <h3 class="block-title text-center fs-24">
                                ตอบคำถาม / ให้ความช่วยเหลือ
                            </h3>
                        </div>
                    </div>
                    <div class="block-content">
                        <?php $number = 3; ?>
                        <?php $numbers = 0; ?>
                        @foreach ($problem_s as $row)
                            <?php $number++; ?>
                            <?php $numbers++; ?>
                            <style>
                                #rcorners2 {
                                    border-radius: 15px;
                                    /* background: #f3f3f3; */
                                    padding: 10px;
                                    width: 100%;
                                    height: 100%;
                                    /* font-size: 15px; */
                                }

                                .shoadowes {
                                    width: 300px;
                                    height: 100px;
                                    padding: 15px;
                                    background-color: #ffffff;
                                    box-shadow: 5px 5px 3px rgb(190, 190, 190);
                                    border: 2px solid #0080ff;
                                }

                            </style>

                            <div class="col-12 content shoadowes" id="rcorners2">
                                <div class="container mt-4">
                                    <div class="d-flex justify-content-center row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column comment-section" id="myGroup">
                                                <div class="p-2">
                                                    <div class="row">

                                                        <div class="col-7 ">
                                                            @if ($row->HAPPY_NET_PROBLEM_STATUS == 'True')
                                                                <div class="text-left" style="color: green;"><i
                                                                        class="fa fa-fw fa-check-circle text-success fa-2x"></i>
                                                                </div>
                                                            @else
                                                                <div class="text-left">

                                                                    <h4 class="comment-text" style="font-size:17px">
                                                                        <span><b>หัวเรื่อง :
                                                                            </b></span>{{ $row->HAPPY_NET_PROBLEM_HEAD }}
                                                                    </h4>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <div class="col-5 " align='right'>
                                                            <input type="hidden" name="HAPPY_NET_PROBLEM_ID"
                                                                id="HAPPY_NET_PROBLEM_ID"
                                                                value="{{ $row->HAPPY_NET_PROBLEM_ID }}">


                                                            <div class="row">

                                                                <div class="col-8">
                                                                    <span
                                                                        class="d-block font-weight-bold name">{{ Happy_Net_Controller::person_fname($row->ID_USER_INSERT_PROBLEM) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER_INSERT_PROBLEM) }}</span><span
                                                                        class="date text-black-50">
                                                                        {{ Datethai($row->updated_at) }}</span>

                                                                </div>

                                                                &nbsp;&nbsp;
                                                                @if ($inforpersons->HR_IMAGE == null)
                                                                    <img class="img-fluid img-responsive rounded-circle mr-2 "
                                                                        src="{{ asset('image/pers.png') }}" width="50px"
                                                                        height="50px">
                                                                @else
                                                                    <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                        src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER_INSERT_PROBLEM) }}"
                                                                        width="50px" height="50px">
                                                                @endif


                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="mt-1"><br>
                                                        <div class=" col-12">
                                                            <div class="row col-6">

                                                            </div>
                                                            <div class="js-rating"
                                                                data-score="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                                            </div>
                                                            <div class="col-6 row ">
                                                                {{-- <div class="collapsable-comment comment-text"> --}}
                                                                <div class="text-right" data-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse-{{ $number }}"
                                                                    href="#collapse-{{ $number }}">
                                                                    รายละเอียด คลิกที่นี่ &nbsp;&nbsp;<i
                                                                        class="fa fa-chevron-down "></i>
                                                                </div>
                                                                {{-- </div> --}}




                                                            </div>



                                                            <div id="collapse-{{ $number }}" class="collapse">
                                                                <div class="commented-section mt-2">
                                                                    <div class="comment-text-sm">
                                                                        <span
                                                                            style="font-size:1.2em;">{{ $row->HAPPY_NET_PROBLEM }}</span>
                                                                        {{-- <br><br>
                                                        <SPAn style="color: red; font-size:2em;">*</SPAn>
                                                               <span style="font-size:1.5em;" class="">&nbsp;เมื่องานสำเร็จคุณจะได้รับ&nbsp;{{ $row->HAPPY_NET_DIFFICULTY_COIN }}&nbsp;คอย์น</span> --}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <?php
                                                $anss = DB::table('happy_net_problem')
                                                    // ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                                    ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                                    // ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                                
                                                    ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $row->HAPPY_NET_PROBLEM_ID)
                                                    // ->whereNotNull('HAPPY_NET_PROBLEM_ID')
                                                
                                                    ->count();
                                                
                                                // dd($anss);
                                                
                                                ?>
                                                <div class=" p-2">
                                                    <div class="d-flex flex-row fs-12">
                                                        <div class="col-12">
                                                            <div class="row ">
                                                                <!--<div class="like p-2 cursor">
                                                                                        <a type="sumbit" class="btn">
                                                                                            <i class="fa fa-thumbs-up fa-1x"></i><span
                                                                                                class="ml-1"> &nbsp;ถูกใจ</span>
                                                                                        </a>
                                                                                    </div> -->


                                                                <div class="col-auto mr-auto">
                                                                    @if ($row->HAPPY_NET_PROBLEM_STATUS == 'True')
                                                                        <a class="btn">
                                                                            <div class="like p-2 cursor action-collapse "
                                                                                data-toggle="collapse" aria-expanded="true"
                                                                                aria-controls="" href=""><i
                                                                                    class="fa fa-comment fa-1x"></i><span
                                                                                    class="ml-1">
                                                                                    &nbsp;แสดงความคิดเห็น</span>
                                                                            </div>
                                                                        </a>
                                                                        <a class="btn">
                                                                            <div class="like p-2 cursor action-collapse "
                                                                                data-toggle="collapse" aria-expanded="true"
                                                                                aria-controls="" href=""><i
                                                                                    class="fa fa-eye fa-1x"></i><span
                                                                                    class="ml-1">
                                                                                    {{-- {{ $anss }} --}}

                                                                                    {{ $anss }}
                                                                                    &nbsp;ความคิดเห็น
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    @else
                                                                        <a class="btn">
                                                                            <div class="like p-2 cursor action-collapse "
                                                                                data-toggle="collapse" aria-expanded="true"
                                                                                aria-controls="collapse-{{ $numbers }}"
                                                                                href="#collapse-{{ $numbers }}"><i
                                                                                    class="fa fa-comment fa-1x"></i><span
                                                                                    class="ml-1">
                                                                                    &nbsp;แสดงความคิดเห็น</span>
                                                                            </div>
                                                                        </a>
                                                                        <a class="btn">
                                                                            <div class="like p-2 cursor action-collapse "
                                                                                data-toggle="collapse" aria-expanded="true"
                                                                                aria-controls="collapse-{{ $numbers }}"
                                                                                href="#collapse-{{ $numbers }}"><i
                                                                                    class="fa fa-eye fa-1x"></i><span
                                                                                    class="ml-1">


                                                                                    {{ $anss }}



                                                                                    &nbsp;ความคิดเห็น</span>
                                                                            </div>
                                                                        </a>

                                                                        {{-- <a class="btn">
                                                                        <div  class="like p-2 cursor action-collapse "
                                                                        data-toggle="collapse" aria-expanded="true"
                                                                        aria-controls="collapse-{{ $numbers }}"
                                                                        href="#collapse-{{ $numbers }}"><i style="color: #9999" 
                                                                            class="fab fa-bitcoin fa-1x"></i><span class="ml-1">&nbsp;งานสำเร็จคุณจะได้รับ&nbsp;{{ $row->HAPPY_NET_DIFFICULTY_COIN }}&nbsp;คอย์น</span>
                                                                        </div>
                                                                        </a> --}}
                                                                    @endif
                                                                </div>
                                                                <div class="col-auto">
                                                                    <a class="btn">
                                                                        <div class="like p-2 cursor action-collapse "
                                                                            data-toggle="collapse" aria-expanded="true"
                                                                            aria-controls="collapse" href="#collapse">
                                                                        </div>

                                                                        <div class="col-lg-1"></div>
                                                                        <a class="btn">
                                                                            <div class="like p-2 cursor action-collapse "
                                                                                data-toggle="collapse" aria-expanded="true"
                                                                                aria-controls="collapse-{{ $numbers }}"
                                                                                href="#collapse-{{ $numbers }}">
                                                                                <i style="color: rgb(217, 255, 0);font-size:18px;"
                                                                                    class="fa fa-exclamation-circle  text-warning  "></i>

                                                                            </div>
                                                                        </a>
                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="collapse-{{ $numbers }}" class=" p-2 collapse" data-parent="#myGroup">



                                        <div class="d-flex flex-row align-items-start">
                                            @if ($inforpersons->HR_IMAGE == null)
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="{{ asset('image/pers.png') }}" width="50px">
                                            @else
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersons->HR_IMAGE)) }}"
                                                    width="50px">
                                            @endif
                                            &nbsp;&nbsp;

                                            <div class="col-12">
                                                <form action="{{ route('happy.respond_ans_gets') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" id="ID_USER" name="ID_USER"
                                                        value="{{ $id_user }}">


                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ID"
                                                        name="HAPPY_NET_PROBLEM_ID"
                                                        value="{{ $row->HAPPY_NET_PROBLEM_ID }}">


                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                                        name="HAPPY_NET_PROBLEM_ANSWER_FNAME"
                                                        value="{{ $inforpersons->HR_FNAME }}">
                                                    <input type="hidden" id="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                                        name="HAPPY_NET_PROBLEM_ANSWER_LNAME"
                                                        value="{{ $inforpersons->HR_LNAME }}">


                                                    <div class="row">

                                                        <div class="col-8">
                                                            <input class="form-control mr-3  shadow-none "
                                                                name="HAPPY_NET_PROBLEM_ANSWER"
                                                                id="HAPPY_NET_PROBLEM_ANSWER">
                                                        </div>
                                                        <div class="col-4">
                                                            <span>
                                                                <button class="button shadow-none loadscreen"
                                                                    type="sumbit"><i
                                                                        class="fa fa-location-arrow "></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                                <br>
                                            </div>
                                            <style>
                                                .button {
                                                    background-color: #4CAF50;
                                                    border: none;
                                                    color: white;
                                                    padding: 10px 20px;
                                                    /* text-align: center; */
                                                    text-decoration: none;
                                                    display: inline-block;
                                                    /* font-size: 16px; */
                                                    margin: -2px 2px;
                                                    cursor: pointer;
                                                    border-radius: 10px;
                                                }

                                            </style>
                                        </div>
                                        <div class="mt-2">
                                            <?php
                                            $ans = DB::table('happy_net_problem')
                                                ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                                ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                                ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                                ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $row->HAPPY_NET_PROBLEM_ID)
                                                // ->first();
                                                ->get();
                                            
                                            ?>
                                            @foreach ($ans as $rows)
                                                <div class="commented-section mt-2">
                                                    @if ($rows->HAPPY_NET_PROBLEM_ANSWER_ID == null)
                                                    @else
                                                        <input type="hidden" name="HAPPY_NET_PROBLEM_ANSWER_ID"
                                                            id="HAPPY_NET_PROBLEM_ANSWER_ID"
                                                            value="{{ $rows->HAPPY_NET_PROBLEM_ANSWER_ID }}">
                                                        <input type="hidden" name="HAPPY_NET_PROBLEM_QUESTION_ID"
                                                            id="HAPPY_NET_PROBLEM_QUESTION_ID"
                                                            value="{{ $rows->HAPPY_NET_PROBLEM_QUESTION_ID }}">

                                                        <div class="float-left image">


                                                            {{-- <img class="img-fluid img-responsive mr-2"
                                                src="data:image/png;base64, {{ Happy_Net_Controller::person_image($rows->ID_USER) }}"
                                                width="50"> --}}

                                                            @if ($inforpersons->HR_IMAGE == null)
                                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                    src="{{ asset('image/pers.png') }}" width="50px">
                                                            @else
                                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                    src="data:image/png;base64, {{ Happy_Net_Controller::person_image($rows->ID_USER) }}"
                                                                    width="50px">
                                                            @endif
                                                        </div>
                                                    @endif





                                                    <div class="d-flex flex-row align-items-center commented-user">
                                                        <B class="mr-2">
                                                            {{ $rows->HAPPY_NET_PROBLEM_ANSWER_FNAME }}
                                                            &nbsp;
                                                            {{ $rows->HAPPY_NET_PROBLEM_ANSWER_LNAME }}</B>


                                                    </div>
                                                    <div class="d-flex flex-row align-items-center commented-user">

                                                        <span style="color: #878787">
                                                            {{ Datethai($rows->updated_at) }}</span> <i
                                                            class="fab fa-vr-cardboard"></i><br>


                                                    </div>

                                                    <div class="comment-text-md">
                                                        <div class="col-12">
                                                            <br> &nbsp; &nbsp; &nbsp;
                                                            <span>{{ $rows->HAPPY_NET_PROBLEM_ANSWER }}</span>
                                                        </div>
                                                        <hr>
                                                    </div>



                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <br>
                        @endforeach



                    </div>
                </div>
            </div>

        </div>
        <style>
            #rcorners1 {
                border-radius: 25px;
                /* background: #f3f3f3; */
                padding: 1%;
                width: 100%;
                height: 100%;

            }

            .shoadow2 {
                width: 300px;
                height: 100px;
                padding: 15px;
                background-color: #ffffff;
                box-shadow: 5px 5px 3px rgb(190, 190, 190);
                border: 1px solid #e2e2e2;
            }

            .shoadowhead {
                width: 100%;
                height: 100px;
                padding: 15px;
                background-color: #ffffff;
                box-shadow: 5px 5px 3px rgb(190, 190, 190);
                border: 1px solid #e2e2e2;
                border-radius: 5px;
            }

        </style>

        <!-- Extra Large Block Modal -->
        <div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><span style="color: #ffc849"><i class="fas fa-search "></i></span>
                                &nbsp;
                                ค้นหาผู้ใช้ </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="col-11 content">
                                <div class="row">
                                    <div class="col-xl-8">
                                        <span>
                                            <input type="search" name="search" id="myInput"
                                                value="{{ isset($search) ? $search : null }}"
                                                placeholder="ค้นหารายชื่อได้ที่นี่" class="form-control">
                                        </span>
                                    </div>
                                    <div class="col-xl-3">
                                        <span>
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                                    class="fas fa-search"></i>&nbsp; ค้นหา</button>
                                        </span>
                                    </div>
                                </div><br>
                                <div id="myTable">
                                    <?php $number = 0; ?>
                                    @foreach ($inforperson as $infopermis)
                                        <?php $number++; ?>

                                        {{-- style="background-color: rgb(240, 240, 240)" --}}

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="card card-white post content shoadow2 " id="rcorners1">
                                                            <div class="post-heading">
                                                                <div class="float-left image">
                                                                    @if ($infopermis->HR_IMAGE == null)
                                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                            src="{{ asset('image/pers.png') }}"
                                                                            width="60">
                                                                    @else
                                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                                            src="data:image/png;base64,{{ chunk_split(base64_encode($infopermis->HR_IMAGE)) }}"
                                                                            width="60">
                                                                    @endif
                                                                </div>
                                                                <div class="float-left meta">
                                                                    <b>{{ $infopermis->HR_PREFIX_NAME }}{{ $infopermis->HR_FNAME }}
                                                                        &nbsp;
                                                                        {{ $infopermis->HR_LNAME }}
                                                                    </b>
                                                                    <h6 class="text-muted time">
                                                                        {{ $infopermis->POSITION_IN_WORK }}
                                                                    </h6>

                                                                </div>
                                                                <div class="text-right">
                                                                    {{-- <a class="btn btn-rounded btn-hero-success"
                                                            href="{{ url('person_happynet/send_user_id_Happy_Net/' . $infopermis->ID) }}">ชื่นชม</a>
                                                            &nbsp; --}}
                                                                    <a class="btn btn-rounded btn-hero-warning "
                                                                        href="{{ url('person_happynet/send_user_problem_Happy_Net/' . $infopermis->ID) }}">ขอความช่วยเหลือ</a>
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <br>

                                                    </td>


                                                </tr>

                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>








                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END Extra Large Block Modal -->
    @endsection

    @section('footer')
        <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
        <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                                                                                                                                                                                                                                                                                                                                                                                                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        {{-- <script>
            $(document).ready(function() {
                $("#myTable").DataTable();
            });
        </script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

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




        <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        {{-- ทดสอบถูกใจ --}}
        {{-- <script>
                $("a.like-button").on("click", function like(idpro, value) {

                    // $(this).toggleClass("liked");

                    // setTimeout(() => {
                    //     $(e.target).removeClass("liked");
                    // }, 1000);


                    $(this).toggleClass("liked");


                });
            </script> --}}


        {{--  --}}
    @endsection
