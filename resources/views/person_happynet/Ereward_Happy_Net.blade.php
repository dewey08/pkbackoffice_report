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
            <h3 class="block-title text-center fs-24">ตั้งค่า<span style="color: ;">ของรางวัล</span></h3>
        </div>
        <hr>

    </div>
    <div class="block-content  shadow">
        <div class="row col-12">
            <div class="col-9"></div>
            <div class="col-3">
                <!-- <button type="button" class="btn btn-primary " style="float: right;" data-toggle="modal" data-target="#modal-block-extra-large"><i class="fa fa-plus fa-1x">&nbsp;&nbsp;</i>เพิ่มข้อมูลของรางวัล</button> -->
                <a class="btn btn-hero-primary loadscreen" style="float: right;" href="{{ url('person_happynet/add_Ereward_Happy_Net') }}"><i class="fa fa-plus fa-1x">&nbsp;&nbsp;</i>เพิ่มข้อมูลของรางวัล</a>
            </div>
        </div>




        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 14px;

            }
        </style>
        <div class="grid-container">
            <div class="col-xl-11 center">
                <table class="table table-hover table-bordered" width="100%" height="100%" id="myTable">
                    <thead style="background-color: #c1d8f0; color:black" ;>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รายการ</th>
                            <th scope="col">รูปภาพ</th>
                            <th scope="col">รายละเอียดรางวัล</th>
                            <th scope="col">หมายเหตุ</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($REtable as $row)
                        <?php $number  ++; ?>
                        <tr>
                            <td width="5%" class="text-center"> {{$number}}</td>
                            <td width="20%" > {{$row->HAPPY_NET_REWARD_NAME}}</td>
                     
                            <td  width="10%" class="text-center"><img  width="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->HAPPY_NET_REWARD_IMAGE)) }}"></td>
                            {{--        เก็บแบบ strorage                    <td  width="10%" class="text-center"><img  width="200px" src="{{ asset('storage/happy_image_reward/'.$row->HAPPY_NET_REWARD_IMAGE) }}"></ --}}
                            <td width="40%" > {{$row->HAPPY_NET_REWARD_DETAILS}}</td>
                            <td width="20%" > {{$row->HAPPY_NET_REWARD_DETAILS2}}</td>
                            <td width="10%" class="text-center"> {{$row->HAPPY_NET_REWARD_PRICE}}</td>
                            <td width="10%" class="text-center"> {{$row->HAPPY_NET_REWARD_QUANTITY}}</td>
                            <td align="center" width="20%">
                                <div class="custom-control custom-switch custom-control-lg ">
                                    @if($row-> HAPPY_NET_REWARD_STATUS == 'True' )
                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> HAPPY_NET_REWARD_ID }}" name="{{ $row-> HAPPY_NET_REWARD_ID }}" onchange="switchstatus_Ereward({{ $row-> HAPPY_NET_REWARD_ID }});" checked>
                                    @else
                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> HAPPY_NET_REWARD_ID }}" name="{{ $row-> HAPPY_NET_REWARD_ID }}" onchange="switchstatus_Ereward({{ $row-> HAPPY_NET_REWARD_ID }});">
                                    @endif
                                    <label class="custom-control-label" for="{{ $row-> HAPPY_NET_REWARD_ID }}"></label>
                                </div>
                            </td>
                            <td width="20%" class="text-center">
                                <div class="dropdown">
                                    <button type="button" style="font-size: 14px;" class=" btn btn-outline-primary dropdown-toggle" id="dropdown-default-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-default-outline-primary">
                                        <a class="dropdown-item"
                                        href="{{ url('person_happynet/edit_Ereward_Happy_Net/'.$row -> HAPPY_NET_REWARD_ID) }}">แก้ไข</a>
                                        <a onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" class="dropdown-item" href="{{ url('person_happynet/destroy_Ereward_Happy_Net/'.$row -> HAPPY_NET_REWARD_ID) }}">ลบ</a>
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


   <!-- on off -->
   <script>
    function switchstatus_Ereward(status_Erewards) {
        // alert(budget);
        var checkBox = document.getElementById(status_Erewards);
        var onoff;

        if (checkBox.checked == true) {
            onoff = "True";
        } else {
            onoff = "False";
        }
        //alert(onoff);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('status_Ereward')}}",
            method: "GET",
            data: {
                onoff: onoff,
                status_Erewards: status_Erewards,
                _token: _token
            }
        })
    }
</script>
<!-- on off -->
    @endsection