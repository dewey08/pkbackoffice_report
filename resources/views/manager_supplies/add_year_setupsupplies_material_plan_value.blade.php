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
<div class="block mb-4" style="width: 95%;margin:auto">
    <br>
    <div class="col-12 text-left">
        <p style="font-size: 1.32rem ;font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มปีงบประมาณแผนวัสดุ
        </p>
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
        <div class="col-12 ">
            <form method="post" action="{{ route('msupplies.save_year_material_plan_value') }}">
                @csrf


<div class="col-12">
<center>
    @error('PLAN_SUPPLIES_YEAR')
    <div class="my-2"> <b style="font-size:20px;" class="text-danger">{{$message}}</b></div>

@enderror
</center>
</div>
                <br>
                <div class="row"><div class="col-1"></div>
                    <div class="col-1">
                        <label>ปีงบประมาณ :</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="PLAN_SUPPLIES_YEAR" id="PLAN_SUPPLIES_YEAR" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="">--เลือก--</option>
                            @foreach ($budgetyears as $budgetyear)
                            @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>
                                {{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                            @else
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>


                        </select>
                    </div>
                </div>


                <br>

        </div>
        <div class="modal-footer">
            <div align="right">
                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-save"></i> &nbsp; ยืนยัน</button>
                <a class="btn btn-sm btn-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"
                    href="{{ route('msupplies.material_year_plan_value') }}"><i class="fas fa-window-close"></i> &nbsp;
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



   



    $(document).ready(function () {
        $('select').select2();
    });
    //-------------------------------------------------------


   
   
   
   
   
   
   
   
   
   
   
   
   
   
</script>








<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>
    jQuery(function () {
        Dashmix.helpers(['masked-inputs']);
    });
</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

@endsection