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
            <div class="col-12 row">
                
                    <h3 class="block-title text-center fs-28"><i class="fa fa-cog "></i> &nbsp;ตั้งค่าการกำหนดการจ่ายขอความช่วยเหลือในแต่ละวัน</h3>
          
               
            </div>
        </div>
        <hr>
    </div>
    <div class="block-content  shadow">
     
        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 15px;

            }
        </style>
        <div class="grid-container">
            @if ($set_check == 0)
            <form action="{{ route('happy.update_Eset_problem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-content">
                    <div class="form-group">
                      
                        <label for="HAPPY_NET_SET_PROBLEM">กำหนดขอความช่วยเหลือในแต่ละวัน</label>
                  
                        <input type="number" class="form-control" id="HAPPY_NET_SET_PROBLEM" name="HAPPY_NET_SET_PROBLEM"  placeholder="กรอกตัวเลข" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
                      
                    </div>
                    {{-- <div class="form-group">
                        <label for="HAPPY_NET_DIFFICULTY_COIN">ขอความช่วยเหลือต่อระดับ</label>
                        <input type="text" class="form-control" id="HAPPY_NET_DIFFICULTY_COIN" name="HAPPY_NET_DIFFICULTY_COIN" value="{{ $edit_setcoin->HAPPY_NET_DIFFICULTY_COIN }}" placeholder="กรอกตัวเลข" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
                    </div> --}}
                </div><br>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                    <a  class="btn btn-sm btn-danger"  onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" href="{{ url('person_happynet/Ecoin_Happy_Net') }}"><i class="fas fa-window-close"></i> &nbsp; ยกเลิก</a>
                </div>
            </form>

            @elseif ($set_check == 1)
            <form action="{{ route('happy.update_Eset_problems') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-content">
                    <div class="form-group">
                      
                        <label for="HAPPY_NET_SET_PROBLEM">กำหนดขอความช่วยเหลือในแต่ละวัน</label>
              
                        <input type="hidden" id="HAPPY_NET_SET_PROBLEM_ID" name="HAPPY_NET_SET_PROBLEM_ID" value="1">
                        <input type="number" class="form-control" id="HAPPY_NET_SET_PROBLEM" name="HAPPY_NET_SET_PROBLEM" value="{{ $edit_setproblems->HAPPY_NET_SET_PROBLEM }}" placeholder="กรอกตัวเลข" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">

                    
                    </div>
                    {{-- <div class="form-group">
                        <label for="HAPPY_NET_DIFFICULTY_COIN">ขอความช่วยเหลือต่อระดับ</label>
                        <input type="text" class="form-control" id="HAPPY_NET_DIFFICULTY_COIN" name="HAPPY_NET_DIFFICULTY_COIN" value="{{ $edit_setcoin->HAPPY_NET_DIFFICULTY_COIN }}" placeholder="กรอกตัวเลข" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}">
                    </div> --}}
                </div><br>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                    <a  class="btn btn-sm btn-danger"  onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" href="{{ url('person_happynet/Ecoin_Happy_Net') }}"><i class="fas fa-window-close"></i> &nbsp; ยกเลิก</a>
                </div>
            </form>
           
            @endif
                
        </div>

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




    <!-- on off -->
    <script>
        function switchstatus_ecoins(status_ecoins) {
            // alert(budget);
            var checkBox = document.getElementById(status_ecoins);
            var onoff;

            if (checkBox.checked == true) {
                onoff = "True";
            } else {
                onoff = "False";
            }
            //alert(onoff);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('status_ecoin')}}",
                method: "GET",
                data: {
                    onoff: onoff,
                    status_ecoins: status_ecoins,
                    _token: _token
                }
            })
        }
    </script>
    <!-- on off -->

    
    @endsection