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
    @error('PLAN_SUPPLIES_YEAR')
                <div class="alert alert-danger" align="left">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>

                @enderror
<br>
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มข้อมูลปีงบประมาณ</B></h3>
            </div>

                <div class="block-content block-content-full">
                <form method="post" action="{{ route('mplan.plansupplies_save_year') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-2">
                            <label>ปีงบประมาณ</label>
                        </div>
                        <div class="col-lg-6">
                            <select name="PLAN_SUPPLIES_YEAR" id="PLAN_SUPPLIES_YEAR" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                                <option value="" disable>--กรุณาเลือกปีงบประมาณ--</option>
                                @foreach ($budget as $row)
                                <option value="{{ $row->LEAVE_YEAR_ID  }}">{{ $row->LEAVE_YEAR_NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit" class="btn btn-hero-sm btn-hero-info f-kanit"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('manager_plan/plansupplies')  }}" class="btn btn-hero-sm btn-hero-danger" style=" font-family: 'Kanit', sans-serif;font-weight: normal;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a> 
                </div>
            </div>
            </form>

        </div>
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