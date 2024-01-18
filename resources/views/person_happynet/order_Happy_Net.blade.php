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
            <h3 class="block-title text-center fs-24">รายงานการแลกของรางวัล</h3>
        </div>
        <hr>

    </div>
    <div class="block-content  shadow"><br>
        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 15px;
            }

            .fontsize {
                font-size: 17px;
            }
        </style>
        <div class="grid-container">
            <div class="col-xl-11 center">
                <table class="table table-hover table-bordered" width="100%" height="100%" id="myTable">
                    <thead  style="background-color: #c1d8f0; color:black";>
                        <tr>
                            <th  scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">วันที่</th>
                            <th scope="col">ของรางวัล</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">ผู้มอบของรางวัล</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($orderall as $row)
                        <?php $number  ++; ?>
                        <tr>
                            <td width="5%" class="text-center"> {{$number}}</td>
                            <td width="30%" > {{$row->HAPPY_NET_NAME_USER}} </td>
                            <td width="12%" > {{Datethai($row->updated_at)}}</td>
                            <td width="20%" > {{$row->HAPPY_NET_REWARD_NAME}}</td>
                            <td width="5%" class="text-right"> {{$row->HAPPY_NET_ORDER_QUANTITY}}</td>
                            
                            <td width="30%" > {{$row->HAPPY_NET_NAME_PAY}}</td>
                            <td width="10%" class="text-center d-none d-md-table-cell fontsize">
                                @if($row-> HAPPY_NET_ORDER_STATUS == 'True' )
                                <span class="badge badge-success">จำหน่ายแล้ว</span>
                                @else
                                <span class="badge badge-danger">ยังไม่ได้จำหน่าย</span>
                                @endif
                            </td>
                            <td width="10%" class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" id="dropdown-default-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-default-outline-primary">
                                        <a class="dropdown-item loadscreen" href="{{ url('person_happynet/content_order_Happy_Net/'.$row -> HAPPY_NET_ORDER_ID) }}">รายละเอียด</a>
                                        @if($row-> HAPPY_NET_ORDER_STATUS == 'False' )
                                        <a class="dropdown-item loadscreen" href="{{ url('person_happynet/con_order_Happy_Net/'.$row -> HAPPY_NET_ORDER_ID) }}">จำหน่ายของรางวัล</a>
                                        @else
                                        

                                        @endif
                                        @if($row-> HAPPY_NET_ORDER_STATUS == 'True' )
                                        <a class="dropdown-item loadscreen" href="{{ url('person_happynet/Econ_order_Happy_Net/'.$row -> HAPPY_NET_ORDER_ID) }}">แก้ไข</a>
                                        @else
                                     
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><br><br><br><br>
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