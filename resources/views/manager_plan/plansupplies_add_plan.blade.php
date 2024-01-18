@extends('layouts.plan')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')

<style>
    .center {
        margin: auto;
        width: 100%;
        padding: 10px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }
    }

    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }
</style>

<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<?php
    if(Auth::check()){
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;   
    }else{
        
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    } 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

?>
<!-- Advanced Tables -->
<br>
<br>
<center>
    <div class="block" style="width: 95%;">
    @if (session('danger'))
        <div class="alert alert-danger" align="left">
            <ul>
                <li>{{session('danger')}}</li>
            </ul>
        </div>
    @endif

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> เพิ่มมูลค่าแผนพัสดุ</B></h3>
            </div>
            <div class="block-content block-content-full">
            <form method="post" action="{{ route('mplan.plansupplies_save_plan') }}">
                @csrf

                <input type="hidden" value="{{$plan_year_id->PLAN_SUPPLIES_YEAR_ID}}"  name="PLAN_SUPPLIES_YEAR_ID" id="PLAN_SUPPLIES_YEAR_ID">
                <div class="row push">
                    <div class="col-sm-2">
                        <label>พัสดุ :</label>
                    </div>
                    <div class="col-lg-4">
                        <select name="SUP_TYPE_ID" id="SUP_TYPE_ID"
                            class="form-control input-lg typekind_sub js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="" disable>--กรุณาเลือกพัสดุ--</option>
                            @foreach($select_data as $row)
                                <option value="{{$row->SUP_TYPE_ID}}">{{$row->SUP_TYPE_NAME}}</option>
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

                        <input name="SUP_MATERIAL_VALUE" id="SUP_MATERIAL_VALUE" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;"
                            placeholder="กรอกตัวเลข (จำนวนเต็ม/ไม่มีจุด อักขระพิเศษ ตัวหนังสือ หรือ เครื่องหมายต่างๆ)"
                            onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>


                    </div>
                </div>
                <br>

        </div>
        <div class="modal-footer">
            <div align="right">
                <button type="submit" class="btn btn-sm btn-info"  style=" font-family: 'Kanit', sans-serif;"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                <a class="btn btn-sm btn-danger"  style=" font-family: 'Kanit', sans-serif;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"
                    href="{{ url('manager_plan/plansupplies_detail/'.$plan_year_id->PLAN_SUPPLIES_YEAR_ID) }}"><i class="fas fa-window-close"></i> &nbsp;
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
        jQuery(function () {
            Dashmix.helpers(['easy-pie-chart', 'sparkline']);
        });
    </script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('select').select2();
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
        function detail(id) {

            $.ajax({
                url: "{{route('suplies.detailapp')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#detail').html(result);


                    //alert("Hello! I am an alert box!!");
                }

            })

        }


        $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
        });
    </script>

    @endsection