@extends('layouts.supplies')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    ?>


    <script>
        function checklogin() {
            window.location.href = '{{ route('index') }}';
        }
    </script>
    <?php
    
    if (Auth::check()) {
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;
    } else {
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }
    
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    
    ?>
    <style>
        .center {
            margin: auto;
            width: 100%;
            padding: 10px;
        }

        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            /* font-size: 1.0rem; */
        }

        .text-pedding {
            padding-left: 10px;
        }

        .text-font {
            font-size: 13px;
        }

        .table,
        th,
        td {
            border: 1px solid rgb(0, 0, 0);
        }

    </style>

    <?php  
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>
@endsection

@section('content')
    {{-- <center> --}}
    <div class="block " style="width: 95%;margin:auto">
        <br>
        <div class="col-12 text-center">
            <p style="font-size: 1.32rem ;font-family: 'Kanit', sans-serif;">กำหนดมูลค่าแผนวัสดุ</p>
        </div>
        <hr>
        <div class="col-12" align="right">
            <a href="{{ url('manager_supplies/add_setupsupplies_material_plan_value') }}"
                class="btn btn-hero-sm btn-hero-info"
                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i>
                เพิ่มมูลค่าแผนวัสดุ</a>
            <a href="{{ url('manager_compensation/infolistpay_excel/') }}" class="btn btn-hero-sm btn-hero-success"
                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                <li class="fa fa-file-excel"></li>&nbsp;Excel
            </a>
        </div>
        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 14px;

            }

        </style>
        <div class="col-12  grid-container">
            <div class="col-sm-12 ">

                {{-- <div class="table-responsive"> --}}
                <table class="table-striped  table-hover table-bordered  js-dataTable-simple" width="100%" height="100%"
                    id="myTable">
                    {{-- <table class="table-striped  js-dataTable-simple" id="myTable" style="width: 100%;"> --}}
                    <thead style="background-color: #FFEBCD;text-align: center;border: 1px solid black; ">

                        <tr height="40">
                            <th class="text-font" width="5%">ลำดับ</th>
                            <th class="text-font" width="30%">
                                ประเภทวัสดุ
                            </th>
                            <th class="text-font" width="30%"> แผนจัดซื้อ
                                (บาท)
                            </th>
                            <th class="text-font" width="12%">ปี
                            </th>

                            <th class="text-font" width="12%">ลบข้อมูล
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $count = 1; ?>

                        @foreach ($mp_e as $row)


                            <tr>
                                <td class="text-center">
                                    {{ $count }}
                                </td>
                                <td>
                                    {{ $row->SUP_TYPE_NAME }}
                                </td>
                                <td class="text-font text-pedding">
                                    <input id="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        name="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        class="form-control input-sm inputs{{ $count }}"
                                        style=" font-family: 'Kanit', sans-serif;"
                                        onkeyup="SUP_MV({{ $row->SUP_MATERIAL_ID }},{{ $row->SUP_MATERIAL_ID }},{{ $count }});"
                                        value="{{ $row->SUP_MATERIAL_VALUE }}">



                                </td>
                                <td align="center">
                                    {{ RemoveDateThai($row->DATE_SAVE) }}
                                </td>
                                <td align="center">
                                 

                                        <a href="{{ url('manager_compensation/infolistreceipt_infopersondestroy/'.$row->SUP_MATERIAL_ID) }}"
                                            onclick="return confirm('ต้องการที่จะลบข้อมูล {{$row->SUP_TYPE_NAME}} ?')"
                                            class="btn btn-sm btn-danger "><i class="fa fa-window-close fa-1.6x"></i></a>

                                </td>


                            </tr>

                            <?php $count++; ?>
                        @endforeach
                    </tbody>
                </table>

            </div>


        </div>
    </div>









@endsection

@section('footer')

    <script>
        function SUP_MV(idreceipt, idlist, count) {


            var x = event.which || event.keyCode;
            // alert(x);
            // var next = event.srcElement || event.target;
            if (x == 13) {
                var value = document.getElementById('receipt' + idreceipt).value;
                var number = count + 1;

                var value = document.getElementById('receipt' + idreceipt).value;

                // alert(value+"::"+iddep);

                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('msupplies.up_material_plan_value') }}",
                    method: "GET",
                    data: {
                        value: value,
                        idreceipt: idreceipt,
                        _token: _token
                    },
                    success: function(result) {
                        // alert("ikjlf");

                        $(".inputs" + number).focus();


                    }

                })



            }

        }

        
    </script>




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
    <!-- Page JS Plugins -->






@endsection
