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
                   <div class="col-6">            <h3 class="block-title text-left fs-24"><i class="fa fa-power-off "></i> &nbsp;เปิดใช้
                    สถานะการใช้งานเมนูคำถาม</h3>
    </div>
                    <div class="col-6"> <a class="btn btn-rounded btn-warning " style="float: right;"
                        href="{{ url('person_happynet/Equestion_group_Happy_Net') }}"><i
                            class="far fa-arrow-alt-circle-left  fa-1x">&nbsp;&nbsp;</i>ย้อนกลับ</a></div>
                </div>
        <hr>
    </div>
    <div class="block-content  shadow">
        <div class="col-xl-11 center ">
            <table class="table table-hover table-bordered" width="100%" height="100%">
                <thead style="background-color: #c1d8f0; color:black" ;>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">หมวดหมู่คำถาม</th>

                        <th class="text-font" width="5%" >เปิดใช้
                        </th>


                    </tr>
                </thead>
                <tbody >
                    <?php $num = 0 ?>
                    @foreach ($status_modals as $row)
                    <?php $num ++ ?>
                    <tr>
                       @if ($row->HAPPY_NET_MODAL_TYPE == 'คำถาม')
                       <td width="5%" class="text-center">{{ 1 }}</td>
                       <td width="45%" class="text-left"> เปิด-ปิดสถานะการใช้งานเมนูคำถาม </td>
                       <td align="center" width="10%">
                           <div class="custom-control custom-switch custom-control-lg ">
                               @if ($row->HAPPY_NET_MODAL_QUESTION == 'True')
                                   <input type="checkbox" class="custom-control-input"
                                       id="{{ $row->HAPPY_NET_MODAL_QUESTION_ID }}"
                                       name="{{ $row->HAPPY_NET_MODAL_QUESTION_ID }}"
                                       onchange="switchstatus_modal({{ $row->HAPPY_NET_MODAL_QUESTION_ID }});"
                                       checked>
                               @else
                                   <input type="checkbox" class="custom-control-input"
                                       id="{{ $row->HAPPY_NET_MODAL_QUESTION_ID }}"
                                       name="{{ $row->HAPPY_NET_MODAL_QUESTION_ID }}"
                                       onchange="switchstatus_modal({{ $row->HAPPY_NET_MODAL_QUESTION_ID }});">
                               @endif
                               <label class="custom-control-label"
                                   for="{{ $row->HAPPY_NET_MODAL_QUESTION_ID }}"></label>
                           </div>
                       </td>
                       @endif
                    </tr>
                    @endforeach
                </tbody>
        </div>

    </div>

  
</div>


@endsection

@section('footer')


<script>
    $(document).ready(function () {
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
    function switchstatus_modal(status_modals) {
        // alert(budget);
        var checkBox = document.getElementById(status_modals);
        var onoff;

        if (checkBox.checked == true) {
            onoff = "True";
        } else {
            onoff = "False";
        }
        //alert(onoff);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('status_modal') }}",
            method: "GET",
            data: {
                onoff: onoff,
                status_modals: status_modals,
                _token: _token
            }
        })
    }
</script>


<!-- on off -->


@endsection