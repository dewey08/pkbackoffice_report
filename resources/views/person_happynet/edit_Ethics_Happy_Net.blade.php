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
            <h3 class="block-title text-center fs-24">แก้ไขข้อมูลค่านิยม</h3>
        </div>
        <hr>

    </div>
    <div class="block-content  shadow">
        <form action="{{ route('happy.update_Ethics') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="HAPPY_NET_SET_ETHICS_ID" name="HAPPY_NET_SET_ETHICS_ID"
            value="{{ $update_ets->HAPPY_NET_SET_ETHICS_ID }}">
            <div class="block-content">
                <div class="form-group">
                    <label for="HAPPY_NET_SET_ETHICS">ค่านิยม</label>
                    <input type="text" class="form-control"required id="HAPPY_NET_SET_ETHICS" name="HAPPY_NET_SET_ETHICS" placeholder="ค่านิยม" value="{{ $update_ets->HAPPY_NET_SET_ETHICS }}">
                </div>
                <div class="form-group">
                    <label for="HAPPY_NET_SET_ETHICS_CONTENT">เนื้อหา/ความหมาย</label>
                    <textarea class="form-control" id="HAPPY_NET_SET_ETHICS_CONTENT" name="HAPPY_NET_SET_ETHICS_CONTENT" rows="4" placeholder="รายละเอียด" required>{{ $update_ets->HAPPY_NET_SET_ETHICS_CONTENT }}</textarea>

                </div>
            </div><br>
            <div class="block-content block-content-full text-right bg-light">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                <a  class="btn btn-sm btn-danger"  onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" href="{{ url('person_happynet/Ethics_Happy_Net') }}"><i class="fas fa-window-close"></i> &nbsp; ยกเลิก</a>
            </div>
        </form>
        <br><br>



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