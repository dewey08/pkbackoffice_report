@extends('layouts.supplies')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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
@endsection




@section('content')
@if (session ('danger'))
<div class="alert alert-danger">
    <ul>
        <li>{{session ('danger')}}</li>
    </ul>
</div>
@endif

    {{-- <center> --}}
    <div class="block mb-4" style="width: 95%;margin:auto">

        <div class="block-content">
            <div class="block-header block-header-default">
                <div class="col-6">
                    <h3 class="block-title text-left fs-20">เพิ่มมูลค่าแผนพัสดุ <span >ประจำปี {{$ids->PLAN_SUPPLIES_YEAR}}</span></h3>
                </div>
            </div>

        </div>

        <hr>

        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 14px;

            }

        </style>
        <div class="grid-container">
            <div class="col-xl-12 ">
                <form method="post" action="{{ route('msupplies.save_material_plan_value') }}">
                    @csrf

                    <input type="hidden" id="PLAN_SUPPLIES_ID_YEAR" name="PLAN_SUPPLIES_ID_YEAR" value="{{$ids->PLAN_SUPPLIES_YEAR_ID}}">

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>พัสดุ :</label>
                        </div>
                        <div class="col-lg-4">
                            <select name="SUP_TYPE_ID" id="SUP_TYPE_ID"
                                class="form-control input-lg typekind_sub js-example-basic-single {{ $errors->has('SUP_TYPE_ID') ? 'is-invalid' : '' }}"
                                style=" font-family: 'Kanit', sans-serif;" required>
                                <option value="" disable>--กรุณาเลือกพัสดุ--</option>
                                @foreach ($select_data as $row)
                                    <option value="{{ $row->SUP_TYPE_ID }}">{{ $row->SUP_TYPE_NAME }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>
                    <br>

                    <div class="row push">
                        <div class="col-sm-2">
                            <label>แผนจัดซื้อ (บาท)</label>
                        </div>
                        <div class="col-sm-7">

                            <input name="SUP_MATERIAL_VALUE" id="SUP_MATERIAL_VALUE" type="number"
                                class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"
                                placeholder="กรอกตัวเลข (จำนวนเต็ม/ไม่มีจุด คอมม่า ตัวหนังาสือ หรือ เครื่อหมายต่างๆ)"
                                onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>


                        </div>
                    </div>
                    <br>
            

                    <br>

            </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"
                        href="{{ url('manager_supplies/setupsupplies_material_plan_value/'.$ids ->PLAN_SUPPLIES_YEAR_ID) }}"><i class="fas fa-window-close"></i> &nbsp;
                        ยกเลิก</a>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>
@endsection

@section('footer')
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        //-------------------------------------------------------
    </script>








    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script>
        jQuery(function() {
            Dashmix.helpers(['masked-inputs']);
        });
    </script>

    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
@endsection
