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
    <style>
        #rcorners2 {
            border-radius: 15px;
            /* background: #f3f3f3; */
            padding: 10px;
            width: 100%;
            height: 100%;
            /* font-size: 15px; */
        }

        .shoadow {
            width: 300px;
            height: 100px;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 5px 5px 3px rgb(190, 190, 190);
            border: 1px solid #e2e2e2;
        }

    </style>

    <style>
        #rcorners2 {
            border-radius: 15px;
            /* background: #f3f3f3; */
            padding: 10px;
            width: 100%;
            height: 100%;
            /* font-size: 15px; */
        }

        .shoadow {
            width: 300px;
            height: 100px;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 5px 5px 3px rgb(190, 190, 190);
            border: 1px solid #e2e2e2;
        }

    </style>
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
@endsection
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
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
                    <h3 class="block-title text-center fs-24 ">คำชื่นชม
                    </h3>
                </div>

          
                <div class="col-2"> <a class="btn btn-hero btn-info " style="float: right;"
                    href="{{ url('person_happynet/history_get_user_Happy_Net') }}"><i
                        class="fa fa-book fa-1x">&nbsp;&nbsp;</i>ประวัติคำชื่นชม</a></div>
            </div>
            <hr>
            <div class="block-content">
                <div class="row">
                    <div class="col-md-3 col-xl-6">
                        <a class="block block-rounded block-link-pop bg-sl-g3">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-white mb-0 fs-16" style="font-size: 2.25rem;">
                                                เรา...ชื่นชมเพื่อน
                                            </p>
                                        </div>
                                        <div class="col-6" align='right'>
                                            <i class="fa fa-handshake fa-3x  text-white"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6"></div>
                                        <div class="col-6" align='right'>

                                            <p class="text-white text-right mb-0" style="font-size: 2.25rem;">
                                                {{ $chomsum_s }}
                                                &nbsp;
                                                <i style="color: rgb(255, 149, 149);font-size: 1.95rem;"
                                                    class="fa fa-heart  fa-3x"></i>
                                            </p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-xl-6">
                        <a class="block block-rounded block-link-pop bg-sl-g2  ">
                            <div class="block-content block-content-full d-flex justify-content-between">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-white mb-0 fs-16" style="font-size: 2.25rem;">
                                                เพื่อน...ชื่นชมเรา
                                            </p>
                                        </div>
                                        <div class="col-6" align='right'>
                                            <i class="fa fa-handshake fa-3x  text-white"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6"></div>
                                        <div class="col-6" align='right'>

                                            <p class="text-white text-right mb-0" style="font-size: 2.25rem;">
                                                {{ $chomsum }}
                                                &nbsp;
                                                <i style="color: #e04f1a;font-size: 1.95rem;"
                                                    class="fa fa-heart  fa-3x"></i>
                                            </p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- endrow -->
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
                                   <p class="text-center"> คุณวันนี้สามารถชื่นชมเพื่อนได้ 0 ครั้ง</p>  
                                   @else
                                   <p class="text-center"> คุณวันนี้สามารถชื่นชมเพื่อนได้ {{$countview}} ครั้ง</p>    
                                   @endif
                              
                               </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
            
        </div>






        <br>
        <div class="" style=" background-color: #eeeeee;">
            <div class="col-12 row">
                <div class="col-md-6">


                    <div class="col-12">
                        <div class="block-content">
                            {{-- <hr> --}}
                            <div class="block-header block-header-default shoadowhead">
                                <h3 class="block-title text-center fs-24">
                                    คำชื่นชม-ขอบคุณ-กำลังใจ...ส่งให้เพื่อน
                                </h3>
                            </div>
                            {{-- </div> --}}
                            {{-- <div class="block-content"> --}}
                            <style>
                                #rcorners1 {
                                    border-radius: 25px;
                                    /* background: #f3f3f3; */
                                    padding: 1%;
                                    width: 100%;
                                    height: 100%;
                                    font: outline;
                                }

                                .rcorners1 {
                                    border-radius: 25px;
                                    /* background: #f3f3f3; */
                                    padding: 1%;
                                    width: 100%;
                                    height: 100%;
                                    font: outline;
                                }

                                .shoadow2s {
                                    width: 300px;
                                    height: 100px;
                                    padding: 15px;
                                    background-color: #ffffff;
                                    box-shadow: 5px 5px 3px rgb(190, 190, 190);
                                    border: 1px solid #4d662e;
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

                            </style><br>
                            @foreach ($chom_s as $row)
                                {{-- style="background-color: rgb(240, 240, 240)" --}}
                                <div class="card card-white post content shoadow2s" id="rcorners1">
                                    <div class="post-heading">

                                        <div class="float-left image">
                                            @if ($row->HR_IMAGE == null)
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="{{ asset('image/pers.png') }}" width="50">
                                            @else
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="data:image/png;base64,{{ chunk_split(base64_encode($row->HR_IMAGE)) }}"
                                                    width="50">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            {{-- ratting --}}
                                            <div class="js-rating" data-score="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                            </div>

                                        </div>
                                        <div class="float-left meta">
                                            <div class="title h5">
                                                <b>{{ $row->HAPPY_NET_COIMPLIMENT_FNAME }} &nbsp;
                                                    {{ $row->HAPPY_NET_COIMPLIMENT_LNAME }}</b>

                                            </div>
                                            <div class="">
                                                <h6 class="text-muted time">{{ Datethai($row->updated_at) }}</h6>
                                            </div>
                                        </div>

                                        <div class="text-right" style="color: rgb(255, 149, 149);"><i
                                                class="fa fa-heart  fa-3x"></i>
                                            &nbsp; &nbsp; </div>

                                    </div>

                                    <div class="post-description">
<<<<<<< HEAD
                                    <div class="col-11">
                                        <div class="row">
                                            <b>&nbsp;&nbsp;คำชื่นชม : </b> <span><p>&nbsp;&nbsp; {{ $row->HAPPY_NET_COIMPLIMENT }}
                                            </p></span>
                                        </div>
                                        <div class="row">
                                            <b>&nbsp;&nbsp;สอดคล้องกับค่านิยมองค์กรในหัวข้อ : </b> <span><p>&nbsp;&nbsp; {{ Happy_Net_Controller::ets_st($row->HAPPY_NET_SET_ID_ETHICS) }}
                                            </p></span>
                                        </div>
                                    </div>
=======
                                        <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->HAPPY_NET_COIMPLIMENT }}
                                        </p><br>
>>>>>>> 62f266ce93539756531371e4df0de4462a6ca3d4
                                        {{-- <button class="btn btn-secondary">แก้ไข</button> --}}
                                        <a class="btn btn-rounded btn-outline-secondary loadscreen"
                                            href="{{ url('person_happynet/edit_send_user_id_Happy_Net/' . $row->HAPPY_NET_COIMPLIMENT_ID) }}">แก้ไข</a>
                                    </div>

                                </div>
                                <br>
                            @endforeach

                        </div>
                    </div>

                </div>

                <div class="col-md-6 ">
                    <div class="col-12">

                        <div class="block-content ">
                            {{-- <hr> --}}
                            <div class="block-header block-header-default shoadowhead">
                                <h3 class="block-title text-center fs-24">
                                    คำชื่นชม-ขอบคุณ-กำลังใจ...ส่งให้เรา
                                </h3>
                            </div>
                        </div>
                        <div class="block-content ">
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
                                    border: 1px solid #83ad4e;
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
                            @foreach ($chom_id as $row)
                                <div class="card card-white post shoadow2" id="rcorners1">
                                    {{-- <div class="post-heading">

                                        <div class="float-left image">
                                            @if ($row->HR_IMAGE == null)
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="{{ asset('image/pers.png') }}" width="50">
                                            @else
                                                <img class="img-fluid img-responsive rounded-circle mr-2"
                                                    src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER_INSERT) }}"
                                                    width="50">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                    
                                            <div class="js-rating" data-score="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                            </div>

                                        </div>
                                        <div class="float-left meta">
                                            <div class="title h5">
                                                <a><b>
                                                        {{ Happy_Net_Controller::person_fname($row->ID_USER_INSERT) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER_INSERT) }}</b></a>

                                            </div>
                                            <h6 class="text-muted time">{{ Datethai($row->updated_at) }}</h6>
                                        </div>
                                        <div class="text-right" style="color: red;"><i
                                                class="fa fa-heart text-danger fa-3x"></i> &nbsp; &nbsp; </div>

                                    </div>

                                    <div class="post-description">
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->HAPPY_NET_COIMPLIMENT }}
                                        </p><br>


                                    </div> --}}


                                    <br>

                                    <div class="col-12">
<<<<<<< HEAD
                                        <div class="row container">
                                        
                                            <div class="col col-lg-10"  >
                                                <div class="row">
                                                    <b>&nbsp;&nbsp;คำชื่นชม : </b> <span><p>&nbsp;&nbsp; {{ $row->HAPPY_NET_COIMPLIMENT }}
                                                    </p></span>
                                                </div>
                                                <div class="row">
                                                    <b>&nbsp;&nbsp;สอดคล้องกับค่านิยมองค์กรในหัวข้อ : </b> <span><p>&nbsp;&nbsp; {{ Happy_Net_Controller::ets_st($row->HAPPY_NET_SET_ID_ETHICS) }}
                                                    </p></span>
                                                </div>
=======
                                        <div class="row">
                                            <div class="col-10 "><br>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->HAPPY_NET_COIMPLIMENT }}
                                                </p>
>>>>>>> 62f266ce93539756531371e4df0de4462a6ca3d4
                                            </div>
                                            <div class="col-2 text-right" style="color: red;"><i
                                                    class="fa fa-heart text-danger fa-3x"></i> &nbsp; &nbsp; </div>

                                        </div>
                                    </div><br>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8"></div>
                                            <div class="col-4">
                                                <div class="float-left image">
                                                    @if ($row->HR_IMAGE == null)
                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="{{ asset('image/pers.png') }}" width="50">
                                                    @else
                                                        <img class="img-fluid img-responsive rounded-circle mr-2"
                                                            src="data:image/png;base64, {{ Happy_Net_Controller::person_image($row->ID_USER_INSERT) }}"
                                                            width="50">
                                                    @endif
                                                </div>
                                                <div class="col-md-12">

                                                    <div class="js-rating"
                                                        data-score="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                                    </div>

                                                </div>
                                                <div class="float-left meta">
                                                    <div class="title h5">
                                                        <a><b>
                                                                {{ Happy_Net_Controller::person_fname($row->ID_USER_INSERT) }}&nbsp;{{ Happy_Net_Controller::person_lname($row->ID_USER_INSERT) }}</b></a>
                                                        <h6 class="text-muted time">{{ Datethai($row->updated_at) }}</h6>

                                                    </div>
                                                    <br>
                                                </div>
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

        </div>






        <!-- Extra Large Block Modal -->
        <div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><span style="color: #ffc849"><i class="fas fa-search "></i></span>
                                &nbsp;
                                ค้นหาผู้ใช้                             
                            </h3>
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
                                                                    <a class="btn btn-rounded btn-hero-success"
                                                                        href="{{ url('person_happynet/send_user_id_Happy_Net/' . $infopermis->ID) }}">ชื่นชม</a>
                                                                    {{-- &nbsp;
                                                        <a class="btn btn-rounded btn-hero-warning"
                                                            href="{{ url('person_happynet/send_user_problem_Happy_Net/' . $infopermis->ID) }}">ช่วยเหลือ</a> --}}
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






    </div>
@endsection

@section('footer')
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
@endsection
