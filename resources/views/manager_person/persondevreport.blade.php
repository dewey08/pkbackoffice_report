@extends('layouts.person')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .center {
        
        width: 100%;
        padding: 10px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;

    }

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    .text-pedding {
        padding-top: 3px;
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
</style>

@section('content')
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
use App\Http\Controllers\ManagerpersonController;
?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
?>


<center>

    <div style="width:95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                        <div class="col-md-10" align="left">
                            รายงานข้อมูลการประชุมอบรม
                        </div>
                        <div class="col-md-2">
                            <?php 
          if($person_check == ''){
            $person_0 = 'null';
          }else{
            $person_0 = $person_check ;
          } 

          if($search == ''){
            $search_0 = 'null';
          }else{
            $search_0 = $search;
          }  
          
          ?>
                            <a href="{{ url('manager_person/persondevreport_excel/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$person_0.'/'.$search_0)}}"
                                class="btn btn-hero-sm btn-hero-success">
                                <li class="fa fa-file-excel mr-2"></li>&nbsp;Export Excel
                            </a>

                        </div>
                    </div>
                </h2>

                <form method="post">
                @csrf
                    <div class="row" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">


                        <div class="row col-md-12">
                            <div class="col-sm text-right">
                                วันที่
                            </div>
                            <div class="col-md-2">
                                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>
                            </div>
                            <div class="col-sm text-right">
                                ถึง
                            </div>
                            <div class="col-md-2">

                                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                            </div>

                            <div class="col-md-0.5">
                                &nbsp;ผูัเข้าร่วม &nbsp;
                            </div>
                            <div class="col-md-3">
                                <span>
                                    <select name="ID_PERSON" id="ID_PERSON" class="form-control input-lg"
                                        style=" font-family: 'Kanit', sans-serif;font-size: 12px;">
                                        <option value="">--ทั้งหมด--</option>
                                        @foreach ($infopersons as $infoperson)
                                        @if($infoperson->ID == $person_check)
                                        <option value="{{ $infoperson->ID }}" selected>{{ $infoperson->HR_FNAME}}
                                            {{ $infoperson->HR_LNAME}}</option>
                                        @else
                                        <option value="{{ $infoperson->ID  }}">{{ $infoperson->HR_FNAME}}
                                            {{ $infoperson->HR_LNAME}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </span>
                            </div>

                            <div class="col-md-0.5">
                                &nbsp;ค้นหา &nbsp;
                            </div>
                            <div class="col-md-2">
                                <span>
                                    <input type="search" name="search" class="form-control"
                                        style="font-family: 'Kanit', sans-serif;font-weight:normal;"
                                        value="{{$search}}">

                                </span>
                            </div>



                            <div class="col-sm-1.5">
                                <span>
                                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                                            class="fas fa-search mr-2"></i>ค้นหา</button>
                                </span>
                            </div>
                        </div>



                </form><br><br><br>
                <div class="table-responsive">

                    <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;" >
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;" 
                                    width="4%">
                                    ลำดับ</th>

                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="4%">สถานะ</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;" 
                                    width="4%">
                                    สรุป</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="5%">วันที่ไป</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="23%">ประเภทการไป
                                </th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="23%">เรื่อง</th>
                                <th class="text-font" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="10%">สถานที่</th>
                                <th class="text-font" class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="10%">ผู้ร่วมประชุม</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="10%">ชื่อผู้บันทึก</th>
                                <th class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;padding-right: 1px;"
                                    width="7%">คำสั่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($inforrecordindexs as $inforrecordindex)
                            <?php $number++;

                                $status =  $inforrecordindex -> STATUS;
                                if( $status === 'APPLY'){
                                    $statuscol =  "badge badge-warning";

                                }else if($status === 'EDIT'){
                                   $statuscol =  "badge badge-danger";

                                }else if($status === 'RECEIVE'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'SUCCESS'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }
                                ?>

                            <tr height="20" >
                                <td width="4%" align="center" style="vertical-align: text-top; text-padding: ">{{$number}}</td>

                                <td width="4%" align="center" style="vertical-align: text-top;"><span
                                        class="{{$statuscol}}">{{ $inforrecordindex->STATUS_NAME}}</span></td>
                                @if($inforrecordindex->SAVE_BACK == True)

                                <td width="4%" align="center" style="vertical-align: text-top;">
                                    <p class="btn btn btn-success"><i class="fa fa-check"></i></p>
                                </td>
                                @elseif($inforrecordindex->STATUS == 'SUCCESS')
                                <td width="4%" align="center" style="vertical-align: text-top;">
                                    <p class="btn btn-warning"><i class="fa fa-edit"></i></p>
                                </td>

                                @else
                                <td width="4%" align="center" style="vertical-align: text-top;"><i class="fa fa-sync-alt"> </i></td>
                                @endif
                                <td width="5%" class="text-font text-pedding" align="center" style="vertical-align: text-top;">
                                    {{ DateThai($inforrecordindex->DATE_GO)}}<br>{{ DateThai($inforrecordindex->DATE_BACK)}}
                                </td>
                                <td width="23%" class="text-font text-pedding" style="vertical-align: text-top;">{{ $inforrecordindex->RECORD_TYPE_NAME}} </td>

                                <td width="23%" class="text-font text-pedding" style="vertical-align: text-top;">{{ $inforrecordindex->RECORD_HEAD_USE}}</td>
                                <td width="10%" class="text-font text-pedding" style="vertical-align: text-top;">{{ $inforrecordindex->LOCATION_ORG_NAME}}</td>

                                <td width="10%" class="text-font text-pedding" style="vertical-align: text-top;">
                                    <?php
                                                        $query= DB::table('grecord_index_person')->where('RECORD_ID','=',$inforrecordindex->ID)->get();
                                                                                    
                                                                                    
                                                        $num = 1;
                                                        foreach ($query as $row){
                                                            if($num == 1){
                                                                echo $row->HR_FULLNAME."<br>";
                                                            }else{
                                                                echo $row->HR_FULLNAME."<br>";
                                                            }
                                                            
                                                                $num++;
                                                        }
                                            ?>

                                </td>
                                <td width="10%" class="text-font text-pedding" style="vertical-align: text-top;">{{ $inforrecordindex->USER_POST_NAME}}</td>


                                <td width="7%" align="center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle"
                                            id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"
                                            style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                        <div class="dropdown-menu" style="width:10px">
                                            <a class="dropdown-item" href="#detail_modal{{ $inforrecordindex -> ID }}"
                                                data-toggle="modal"
                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>


                                                @if ($codes == '10999')
                                                <a class="dropdown-item" href="{{ url('formpdf/personperdev_10999/'.$inforrecordindex -> ID.'/'.$inforrecordindex -> RECORD_USER_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขอไปราชการ</a>
                                                @elseif ($codes == '10978')
                                                <a class="dropdown-item" href="{{ url('formpdf/10978/persondev_outside_10978/'.$inforrecordindex -> ID.'/'.$inforrecordindex -> RECORD_USER_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขอไปราชการ</a>
                                                @else
                                                <a class="dropdown-item" href="{{ url('person_dev/persondevpdfgovernment_outside/'.$inforrecordindex -> ID.'/'.$inforrecordindex -> RECORD_USER_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบขอไปราชการ</a>
                                                @endif

                                           
                                            @if($inforrecordindex->RECORD_TYPE_ID == 3)
                                            -------------------
                                           
                                            <a class="dropdown-item"
                                                href="{{ url('person_dev/persondevpdfallow/'.$inforrecordindex -> ID.'/'.$inforrecordindex -> RECORD_USER_ID)}}"
                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                target="_blank">พิมพ์ใบขออนญาต</a>
                                            <a class="dropdown-item"
                                                href="{{ url('person_dev/persondevpdfaccept/'.$inforrecordindex -> ID.'/'.$inforrecordindex -> RECORD_USER_ID)}}"
                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                target="_blank">พิมพ์ใบตอบรับวิทยากร</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                            </tr>

                            <div id="detail_modal{{ $inforrecordindex -> ID }}" class="modal fade edit" tabindex="-1"
                                role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <div class="row col-sm-12">
                                                <div class="text-center" style="font-size:15px;">รายละเอียดคำขอเลขที่
                                                    {{ $inforrecordindex -> ID }}</div>
                                                <div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-body">


                                            <div class="row">

                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>หัวข้อประชุม :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_HEAD_USE }}</h1>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>สถานที่จัดประชุม :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> LOCATION_ORG_NAME }}</h1>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>ระดับ :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_LEVEL_NAME}}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>หน่วยงานที่จัด :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_ORG_NAME }}</h1>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>ประเภทสถานที่ประชุม :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> LOCATION_NAME }}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>ระหว่างวันที่ :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ DateThai($inforrecordindex -> DATE_GO) }} ถึง
                                                            {{ DateThai($inforrecordindex -> DATE_BACK) }}</h1>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>หมายเหตุ :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_COMMENT }}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>ลักษณะ :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_GO_NAME }}</h1>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label> พาหนะเดินทาง :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> RECORD_VEHICLE_NAME }}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>การเบิกเงิน :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> WITHDRAW_NAME }}</h1>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>หัวหน้าฝ่าย :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> LEADER_HR_NAME }}</h1>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="form-group">
                                                        <label>มอบหมายงานให้ :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                        <h1
                                                            style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                            {{ $inforrecordindex -> OFFER_WORK_HR_NAME }}</h1>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <div align="right">
                                                <button type="button" class="btn btn-secondary btn-lg"
                                                    data-dismiss="modal">ปิดหน้าต่าง</button>
                                            </div>
                                        </div>
                                        </form>
                                        </body>


                                    </div>
                                </div>
                            </div>
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
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('select').select2();
        });

        $('.budget').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('admin.selectbudget')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.date_budget').html(result);
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            todayHighlight: true,
                            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            autoclose: true //Set เป็นปี พ.ศ.
                        }); //กำหนดเป็นวันปัจุบัน
                    }
                })
                // console.log(select);
            }
        });


        $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                todayHighlight: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }); //กำหนดเป็นวันปัจุบัน
        });


        function chkmunny(ele) {
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
            ele.onKeyPress = vchar;
        }
    </script>
    @endsection
