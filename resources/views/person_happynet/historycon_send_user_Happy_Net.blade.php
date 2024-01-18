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
                    <h3 class="block-title text-center fs-24 ">ประวัติการช่วยเหลือ
                    </h3>
                </div>


                <div class="col-2"> <a class="btn btn-hero btn-success " style="float: right;"
                        href="{{ url('person_happynet/history_send_user_Happy_Net') }}"><i
                            class="far fa-arrow-alt-circle-left  fa-1x">&nbsp;&nbsp;</i>ย้อนกลับ</a></div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="block-content">
                    <?php $number = -99999999999999; ?>
                    <?php $numbers = -9999999; ?>
                
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
                                border: 2px solid #e6e8eb;
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
                                                        {{-- <input type="hidden" name="HAPPY_NET_PROBLEM_ID"
                                                            id="HAPPY_NET_PROBLEM_ID"
                                                            value="{{ $row->HAPPY_NET_PROBLEM_ID }}"> --}}
                                                        <div class="d-flex flex-row user-info">
                                                            <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="data:image/png;base64, {{ Happy_Net_Controller::image_histrory($problem_id->ID_USER) }}"
                                                            width="50">

                                                            {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}

                                                            <div class="d-flex flex-column justify-content-start ml-2">
                                                                <span
                                                                    class="d-block font-weight-bold name"> {{ Happy_Net_Controller::dd_fname($problem_id->ID_USER) }}
                                                                    &nbsp;
                                                                    {{ Happy_Net_Controller::dd_lname($problem_id->ID_USER) }}</span><span
                                                                    class="date text-black-50">
                                                                    {{ Datethai($problem_id->updated_at) }}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                </div>

                                                <div class="mt-1"><br>
                                                    <div class=" col-12">
                                                        <div class="row col-6">
                                                            <h4 class="comment-text" style="font-size:17px">
                                                                <span><b>หัวเรื่อง :
                                                                    </b></span>{{ $problem_id->HAPPY_NET_PROBLEM_HEAD }}
                                                            </h4>


                                                        </div>
                                                        <div class="js-rating"
                                                            data-score="{{ $problem_id->HAPPY_NET_DIFFICULTY_ID }}">
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
                                                                        style="font-size:1.2em;">{{ $problem_id->HAPPY_NET_PROBLEM }}</span>
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
                                            
                                                ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $problem_id->HAPPY_NET_PROBLEM_ID)
                                                // ->whereNotNull('HAPPY_NET_PROBLEM_ID')
                                            
                                                ->count();
                                            
                                            // dd($anss);
                                            
                                            ?>
                                            <div class=" p-2">
                                                <div class="d-flex flex-row fs-12">
                                                    <div class="col-12">
                                                        <div class="row ">

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
                                                          
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
<hr>
                            <div class="col-12">
                                <div id="collapse-{{ $numbers }}" class=" p-2 collapse" data-parent="#myGroup">
                                
                                    <div class="mt-2">
                                        <?php
                                        $ans = DB::table('happy_net_problem')
                                            ->leftJoin('hrd_person', 'happy_net_problem.ID_USER', '=', 'hrd_person.ID')
                                            ->leftJoin('happy_net_problem_answer', 'happy_net_problem.HAPPY_NET_PROBLEM_ID', '=', 'happy_net_problem_answer.HAPPY_NET_PROBLEM_QUESTION_ID')
                                            ->orderBy('HAPPY_NET_PROBLEM_QUESTION_ID', 'desc')
                                            ->where('HAPPY_NET_PROBLEM_QUESTION_ID', '=', $problem_id->HAPPY_NET_PROBLEM_ID)
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
                                       
                                    </div>

                                </div>

                            </div>
                        </div>
                        <br>
                  



                </div>
            </div>





        </div>



    </div>
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
