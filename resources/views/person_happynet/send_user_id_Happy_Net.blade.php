@extends('layouts.happy')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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
                <h3 class="block-title text-center fs-24">ชื่นชม
                </h3>
            </div>
            <hr>

        </div>
        <div class="block-content  shadow">



            <div class="col-12">
                <div class="block-content">


                    <form action="{{ route('happy.save_send_user') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" id="ID_USER" name="ID_USER" value="{{ $userid->ID }}">

                        <input type="hidden" id="ID_USER_INSERT" name="ID_USER_INSERT" value="{{ $id_user }}">





                        <div class="col-12 row">
                            <div class="col-3">
                                <center>
                                    @if ($userid->HR_IMAGE == null)
                                        <img src="{{ asset('image/pers.png') }}" height="100%" width="60%">
                                    @else
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($userid->HR_IMAGE)) }}"
                                            height="50%" width="60%">
                                    @endif
                                </center>


                            </div>
                            <div class="col-9">
                                <div class="col-12 row">
                                    <div class="col-6">
                                        <label for="HAPPY_NET_COIMPLIMENT">ชื่อ : </label>
                                        <input type="text" class="form-control " id="HAPPY_NET_COIMPLIMENT_FNAME"
                                            name="HAPPY_NET_COIMPLIMENT_FNAME" value="{{ $userid->HR_FNAME }}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="HAPPY_NET_COIMPLIMENT">นามสกุล : </label><span> <input type="text"
                                                class="form-control " id="HAPPY_NET_COIMPLIMENT_LNAME"
                                                name="HAPPY_NET_COIMPLIMENT_LNAME" value="{{ $userid->HR_LNAME }}"
                                                readonly></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="HAPPY_NET_COIMPLIMENT">ข้อความ</label>
                                        <textarea class="form-control" id="HAPPY_NET_COIMPLIMENT"
                                            name="HAPPY_NET_COIMPLIMENT" rows="8" placeholder="คำชื่นชม"
                                            required></textarea>
                                    </div>
                                    <br>

                                </div>
                              <div class="col-12"><label>สอดคล้องกับค่านิยมองค์กรในหัวข้อ :</label>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            
    
    
                                            <select name="HAPPY_NET_SET_ID_ETHICS" id="HAPPY_NET_SET_ID_ETHICS"
                                                class="form-control input-lg typekind_sub show "
                                                style=" font-family: 'Kanit', sans-serif;" required>
                                                <option value="" disable>--กรุณาเลือกหัวข้อที่สอดคล้อง--</option>
                                                @foreach ($ets as $row)
                                                    <option value="{{ $row->HAPPY_NET_SET_ETHICS_ID }}">
                                                        {{ $row->HAPPY_NET_SET_ETHICS }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                  
                                    <div class="col-9">
                                        <div class="form-group">
                                            <p class="show2"></p>
                                        </div>
                                    </div>
                                </div>
                              </div>
                                <br>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="d-block">ระดับ</label>
                                        <?php $number = 0; ?>
                                        @foreach ($SEtable as $row)
                                            <?php $number++; ?>
                                            <div
                                                class="custom-control custom-radio custom-control-inline custom-control-warning">
                                                <input type="radio" required class="custom-control-input"
                                                    id="{{ $row->HAPPY_NET_DIFFICULTY_ID }}"
                                                    name="HAPPY_NET_DIFFICULTY_ID"
                                                    value="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">
                                                <label class="custom-control-label"
                                                    for="{{ $row->HAPPY_NET_DIFFICULTY_ID }}">{{ $row->HAPPY_NET_DIFFICULTY }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>

            </div>
            <div class="block-content block-content-full text-right bg-light">

                @if ($checkhappy_re == 0)
                    @if ($chom_id_if < 0)
                        <h1 style="color: red">คุณได้ชื่นชมเพื่อนไปแล้วสำหรับวันนี้</h1>
                        <button type="button" disabled class="btn btn-sm btn-secondary"><i class="fa fa-save"></i>
                            &nbsp;
                            ยืนยัน</button>

                        {{-- @elseif ($chom_id_if == 1)
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> &nbsp;
                                    ยืนยัน</button> --}}
                    @elseif ($chom_id_if > $set_compliment)
                        <h1 style="color: red">คุณได้ชื่นชมเพื่อนไปแล้วสำหรับวันนี้</h1>
                        <button type="button" disabled class="btn btn-sm btn-secondary"><i class="fa fa-save"></i>
                            &nbsp;
                            ยืนยัน</button>
                    @else
                        <button type="submit" class="btn btn-sm btn-primary loadscreen"><i class="fa fa-save"></i>
                            &nbsp;
                            ยืนยัน</button>
                    @endif
                @else
                    <button type="submit" class="btn btn-sm btn-primary loadscreen"><i class="fa fa-save"></i>
                        &nbsp;
                        ยืนยัน</button>
                @endif

                <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการที่จะยกเลิก ?')"
                    href="{{ route('happy.get_user') }}"><i class="fas fa-window-close"></i> &nbsp; ยกเลิก</a>

            </div>
        </div>
        </form>
    </div>
    </div>







    </div>
@endsection

@section('footer')
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                                                                            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('select').select2();
        });

        $('.show').change(function() {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('happy.ets_show') }}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        $('.show2').html(result);
                    }
                })

            }
        });
    </script>

    <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>
        jQuery(function() {
            Dashmix.helpers(['easy-pie-chart', 'sparkline']);
        });
    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
@endsection
