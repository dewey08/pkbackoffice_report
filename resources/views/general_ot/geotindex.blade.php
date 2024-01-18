@extends('layouts.backend')

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
        padding-right: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    .form-control {
        font-size: 13px;
    }


    table,
    td,
    th {
        border: 1px solid black;
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

use Illuminate\Support\Facades\DB;



?>
<?php

  function Monththai($strtime)
  {
    if($strtime == '1'){
        $month = 'มกราคม';
    }else if($strtime == '2'){
        $month = 'กุมภาพันธ์';
    }else if($strtime == '3'){
        $month = 'มีนาคม';
    }else if($strtime == '4'){
        $month = 'เมษายน';
    }else if($strtime == '5'){
        $month = 'พฤษภาคม';
    }else if($strtime == '6'){
        $month = 'มิถุนายน';
    }else if($strtime == '7'){
        $month = 'กรกฎาคม';
    }else if($strtime == '8'){
        $month = 'สิงหาคม';
    }else if($strtime == '9'){
        $month = 'กันยายน';
    }else if($strtime == '10'){
        $month = 'ตุลาคม';
    }else if($strtime == '11'){
        $month = 'พฤศจิกายน';
    }else if($strtime == '12'){
        $month = 'ธันวาคม';
    }else{
        $month = '';
    }

    return $month;
    }

    function Yearthai($strtime)
    {
      $year = $strtime+543;
      return $year;
    }

?>

<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
            
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">

    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการจัดสรร OT</B></h3>
            <a href="{{ url('general_ot/geotsetdetail_add/'.$inforpersonuserid -> ID)}}" class="btn btn-info"
                ><i class="fas fa-plus"></i> เพิ่มข้อมูล OT</a>
        </div>
        <div class="block-content block-content-full">
          
            <div class="table-responsive">
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">ลำดับ</th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="8%">สถานะ</th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">เดือน</th>

                            <th class="text-font" style="border-color:black;text-align: center;" width="5%">หน่วยงาน</th>
                           
                            <th class="text-font" style="border-color:black;text-align: center;" width="8%">ประเภทงาน
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="10%">จำนวนคน
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="15%">มูลค่า
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center;" width="8%">ผู้บันทึก
                            </th>
                            <th class="text-font" style="border-color:black;text-align: center" width="8%">คำสั่ง</th>

                        </tr>
                    </thead>
                    <tbody>

                        
                        <?php $number = 0; ?>
                        @foreach ($infomationots as $infomationot)
                        <?php $number++;  

                        $personcount_count = DB::table('ot_index_sub')
                        ->select('OT_PERSON_ID', DB::raw('count(*) as total'))
                        ->where('OT_INDEX_ID','=',$infomationot->OT_INDEX_ID)  
                        ->groupBy('OT_PERSON_ID')
                        ->get();
                      
                        $personcount = count($personcount_count);
                        
                        ?>

                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font" align="center">

                                @if($infomationot->OT_STATUS == 'Wait')
                                <span class="badge badge-info"> รอพิจารณา </span>
                                @elseif($infomationot->OT_STATUS == 'APP')
                                      <span class="badge badge-success"> อนุมัติ </span>
                                @else
                                   
                                @endif
                            
                            </td>

                            <td class="text-font text-pedding">{{Monththai($infomationot->OT_MONTH)}}</td>
                            <td class="text-font text-pedding">{{$infomationot->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                            <td class="text-font text-pedding">
                              @if($infomationot->OT_TYPE == 1)
                              งานประจำ
                              @elseif($infomationot->OT_TYPE == 2)
                              งานเสริมฉุกเฉิน
                              @elseif($infomationot->OT_TYPE == 3)
                              งาน REFER
                              @elseif($infomationot->OT_TYPE == 4)
                              งานตรวจการ
                              @else
                                     -
                              @endif    
                            
                            </td>
                            <td class="text-font text-pedding" align="center">{{$personcount}}</td>
                            <td class="text-font text-pedding" align="right">{{number_format($infomationot->OT_BUGGET_SUM,'2')}}</td>
                            <td class="text-font text-pedding">{{$infomationot->OT_PERSON_NAME}}</td>
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle"
                                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">

                                        <a class="dropdown-item"
                                            href="{{ url('general_ot/geotsetdetail_edit/'.$infomationot -> OT_INDEX_ID.'/'.$inforpersonuserid -> ID)}}"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">จัดการข้อมูล</a>
                                        @if($infomationot->OT_STATUS == 'Wait')  
                                        <a class="dropdown-item"
                                            href="{{ url('general_ot/geotsetdetail_app/'.$infomationot -> OT_INDEX_ID.'/'.$inforpersonuserid -> ID)}}" onclick="return confirm('ต้องการที่อนุมัตข้อมูล OT ลำดับ  {{$number}} ?')"
                                            style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">อนุมัติ</a>
                                         @endif
                                    
                                         <a class="dropdown-item"
                                         href="{{ url('general_ot/otexcel/'.$infomationot -> OT_INDEX_ID.'/'.$inforpersonuserid -> ID) }}"
                                         style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบสำคัญการจ่ายเงิน</a>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br><br><br><br><br>
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
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
</script>

@endsection