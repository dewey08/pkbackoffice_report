@extends('layouts.supplies')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    use App\Http\Controllers\ManagersuppliesController;

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

        table,
        th,
        td {
            border: 1px solid rgb(0, 0, 0);
        }

        .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;

        }

        input::-webkit-calendar-picker-indicator {

            font-family: 'Kanit', sans-serif;
            font-size: 14px;

        }

    </style>



    <?php
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>
@endsection

@section('content')
    {{-- <center> --}}
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @if (\Session::has('success_save'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success_save') !!}</li>
            </ul>
        </div>
    @endif

    <div class="block " style="width: 95%;margin:auto">
        <div class="block-content">
        <div class="block-header block-header-default">
            <div class="col-12"> <h3 class="block-title text-center fs-20">แผนพัสดุ</h3></div>
            
         </div>
           
        <hr>
    </div>
        <div class="col-12" align="right">
            <a href="{{ url('manager_supplies/add_year_setupsupplies_material_plan_value') }}"
                class="btn btn-hero-sm btn-hero-info"
                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i>
                เพิ่มข้อมูล</a>&nbsp;&nbsp;

        </div> <br>
        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 14px;

            }

        </style> 
        <div class="col-12">
            <div class="grid-container">

                <div class="col-12 ">

                    {{-- <div class="table-responsive"> --}}
                    <table class="table-striped  table-hover table-bordered   js-dataTable-simple" width="100%"
                        height="100%">
                        {{-- <table class="table-striped  js-dataTable-simple" id="myTable" style="width: 100%;"> --}}
                        <thead style="background-color: #FFEBCD;text-align: center;border: 1px solid black; ">

                            <tr height="40" >
                                <th class="text-font" width="5%">ลำดับ</th>
                                <th class="text-font" width="30%">
                                    ปีงบประมาณ
                                </th>
                                <th class="text-font" align="center" width="15%">
                                    แผนจัดซื้อวัสดุ
                                </th>
                                <th class="text-font" align="center" width="15%">
                                    แผนจัดซื้อครุภัณฑ์
                                </th>
                                <th class="text-font"   align="center"width="15%">
                                    แผนจ้างเหมา
                                </th>



                                <th class="text-font" width="10%">ทำรายการ
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $count = 1; ?>

                            @foreach ($year_plan as $row)
                                <tr>
                                    <td class="text-center">
                                        {{ $count }}
                                    </td>
                                    <td>
                                        &nbsp; &nbsp; {{ $row->PLAN_SUPPLIES_YEAR }}
                                    </td>
                                    <td align="center">
                                        &nbsp; &nbsp;   {{ ManagersuppliesController::summaterialpurchasingplan($row->PLAN_SUPPLIES_YEAR_ID) }}
                                    </td>
                                    <td align="center">
                                        &nbsp; &nbsp; {{ ManagersuppliesController::sumprocurementplan($row->PLAN_SUPPLIES_YEAR_ID) }}
                                    </td>
                                    <td align="center">
                                        &nbsp; &nbsp; {{ ManagersuppliesController::sumcharteredplan($row->PLAN_SUPPLIES_YEAR_ID) }}
                                    </td>



                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" style="font-size: 14px;"
                                                class=" btn btn-outline-primary dropdown-toggle"
                                                id="dropdown-default-hero-primary" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"> 
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown-default-outline-primary">
                                                <a class="dropdown-item" href="{{ url('manager_supplies/setupsupplies_material_plan_value/'.$row ->PLAN_SUPPLIES_YEAR_ID) }}">รายละเอียด</a>
                                            </div>
                                        </div>


                                    </td>


                                </tr>

                                <?php $count++; ?>
                            @endforeach
                        </tbody>
                    </table>

                </div>


            </div>
            <br><br>
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
