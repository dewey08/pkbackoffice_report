@extends('layouts.plan')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

    input::-webkit-calendar-picker-indicator{ 
  
  font-family: 'Kanit', sans-serif;
          font-size: 14px;
         
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
    @if (session('success'))
        <div class="alert alert-success" align="left">
            <ul>
                <li>{{session('success')}}</li>
            </ul>
        </div>
    @endif
    @if (session('success_destroy'))
        <div class="alert alert-success" align="left">
            <ul>
                <li>{{session('success_destroy')}}</li>
            </ul>
        </div>
    @endif
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>กำหนดมูลค่าแผนพัสดุประจำปีงบประมาณ {{$plan_year->PLAN_SUPPLIES_YEAR}}</B></h3>
            </div>
           <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-6" align="left">
                            <a href="{{ url('manager_plan/plansupplies') }}"
                                class="btn btn-hero-sm btn-hero-success"
                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-arrow-circle-left"></i>
                                ย้อนกลับ</a>
                    </div> 
                    <div class="col-md-6" align="right">
                        <a href="{{ url('manager_plan/plansupplies_add_plan/'.$plan_year->PLAN_SUPPLIES_YEAR_ID) }}"
                            class="btn btn-hero-sm btn-hero-info"
                            style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i>
                            เพิ่มข้อมูลแผนจัดซื้อ</a>
                    </div> 
                </div>
           </div>
            <div class="block-content block-content-full">
            <table class="table-striped  table-hover table-bordered " width="100%" >
                    <thead style="background-color: #FFEBCD;text-align: center;border: 1px solid black; ">
                        <tr height="40">
                            <th class="text-font" width="5%">ลำดับ</th>
                            <th class="text-font" width="30%"> ประเภทพัสดุ</th>
                            <th class="text-font" width="30%"> แผนจัดซื้อ  (บาท)</th>
                            <th class="text-font" width="12%">ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody style= "text-align: left;">
                        <?php $count = 1; ?>
                        @foreach ($plansupplies_detail as $row)
                            <tr>
                                <td class="text-center">{{ $count }}</td>
                                <td class="text-left" >{{ $row->SUP_TYPE_NAME }}</td>
                                <td class="text-font text-pedding">
                                    <input pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" type="number" id="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        name="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        class="form-control input-sm inputs{{ $count }}"
                                        style=" font-family: 'Kanit', sans-serif;"
                                        onkeyup="SUP_MV({{ $row->SUP_MATERIAL_ID }},{{ $row->SUP_MATERIAL_ID }},{{ $count }});"
                                        value="{{ $row->SUP_MATERIAL_VALUE }}" placeholder="กรอกตัวเลข (จำนวนเต็ม/ไม่มีจุด อักขระพิเศษ ตัวหนังสือ หรือ เครื่องหมายต่างๆ)" >
                                </td>
                                <td align="center">
                                        <a href="{{ url('manager_plan/plansupplies_destroy_plan/'.$row->SUP_MATERIAL_ID.'/'.$plan_year->PLAN_SUPPLIES_YEAR_ID) }}"
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
    </div>








    @endsection

    @section('footer')

    <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>

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

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
        });
    </script>

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