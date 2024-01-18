@extends('layouts.asset')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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


    .form-control {
        font-size: 13px;
    }


    table {
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
    .font-table-title{
        border-color:#F0FFFF;
        text-align: center;
        font-family: 'Kanit', sans-serif;
        border: 1px solid black;
        font-size: 13px;
    }
    .font-table-content{
        font-family: 'kanit', sans-serif;
        font-size: 12px;
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
<center>
    <div class="block" style="width: 95%;">

        <!-- Dynamic Table Simple -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนครุภัณฑ์</B></h3>
                <div align="right">
                    <a href="{{ url('manager_asset/assetinfoexcel')}}" class="btn btn-hero-sm btn-hero-success">
                        <li class="fa fa-file-excel"></li>&nbsp;&nbsp;Export Excel&nbsp;&nbsp;
                    </a>

                </div>
            </div>
            <div class="block-content block-content-full">
                {{-- <form action="{{ route('massete.assetinfosearch') }}" method="post"> --}}
                <form method="post">
                    @csrf

                    {{-- <div class="switch_search"> --}}


                    <div class="row">

                        {{-- <div class="col-sm">
                                                วันที่
                                                </div>
                                            <div class="col-md-2">
                                     
                                            <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}"
                        readonly>

                    </div>
                    <div class="col-sm">
                        ถึง
                    </div>
                    <div class="col-md-2">

                        <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                            data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>

                    </div> --}}
                    <div class="col-sm-0.5"
                        style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">
                        &nbsp;ประเภทครุภัณฑ์ &nbsp;
                    </div>
                    <div class="col-sm-2">
                        <span>
                            <select name="SEND_TYPE" id="SEND_TYPE" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                                <option value="">--เลือกประเภทครุภัณฑ์--</option>
                                @foreach ($infodeclines as $infodecline)
                                @if($infodecline->DECLINE_ID == $type_check)
                                <option value="{{ $infodecline ->DECLINE_ID  }}" selected>
                                    {{ $infodecline->DECLINE_NAME}}</option>
                                @else
                                <option value="{{ $infodecline ->DECLINE_ID  }}">{{ $infodecline->DECLINE_NAME}}
                                </option>
                                @endif

                                @endforeach
                            </select>
                        </span>
                    </div>

                    <div class="col-md-2">
                        <span>

                            <input type="search" name="search" class="form-control"
                                style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;"
                                value="{{$search}}">

                        </span>
                    </div>


                    <div class="col-md-2 text-left">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info"
                                style="font-family: 'Kanit', sans-serif;;font-weight:normal;"><i
                                    class="fas fa-search"></i> &nbsp;ค้นหา</button>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <!--<button type="button" class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" onclick="switchsearch('searchhight');">ค้นหาขั้นสูง</button>-->

                    </div>


            </div>

        </div>

        </form>
        <div class="table-responsive">
            <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <th class="font-table-title" width="5%">ลำดับ</th>
                        <th class="font-table-title" width="5%">ปีงบ</th>
                        <th class="font-table-title" width="10%">เลขครุภัณฑ์</th>
                        <th class="font-table-title" width="8%">วันที่รับเข้า</th>
                        <th class="font-table-title" width="15%">ประเภทครุภัณฑ์</th>
                        <th class="font-table-title" width="12%">ชื่อ</th>
                        <th class="font-table-title" width="11%"> ประจำอยู่หน่วยงาน</th>
                        <th class="font-table-title" width="8%">ความเสี่ยง</th>
                        <th class="font-table-title" width="8%">การเบิกใช้</th>
                        <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">สถานที่ตั้ง</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่อยู่ชั้น</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่ตั้งห้อง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="6%">อายุใช้</th>-->
                        <th class="font-table-title" width="8%">สถานะ</th>
                        <th class="font-table-title" width="10%">หน่วยงานขอยืม</th>
                        <!--<th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">วันหมดสภาพ</th>-->
                        <th class="font-table-title" width="8%">คำสั่ง</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- @php($sl = ($infoassets->perPage() * $infoassets->currentPage()) - ($infoassets->perPage() - 1)) -->
                    @php($sl = ($infoassets->perPage() * ($infoassets->currentPage()-1)+1) )
                    <?php $number = 0; ?>
                    @foreach ($infoassets as $infoasset)
                    <?php $number++;                             
                                $calculater = DB::table('asset_article')->where('ARTICLE_ID','=',$infoasset->ARTICLE_ID)->first();
                                if($calculater->EXPIRE_DATE == ''){
                                    $infobgcoloer = "background-color:#D6EAF8";
                                }elseif($calculater->EXPIRE_DATE !== ''){
                                    $countdateold =   round(abs(strtotime(date('Y-m-d')) - strtotime($calculater->EXPIRE_DATE))/60/60/24)+1;
                                        if(strtotime($calculater->EXPIRE_DATE) > strtotime(date('Y-m-d'))){
                                        $infobgcoloer = "background-color:#90EE90";
                                        }elseif($countdateold <= 30 && $countdateold >= 0){
                                        $infobgcoloer = "background-color:#FCF3CF";
                                        }else{
                                        $infobgcoloer = "";
                                        }
                                }else{
                                    $infobgcoloer = "";
 
                                }
                                ?>

                    <tr height="20" style="{{$infobgcoloer}}">
                        <td class="font-table-content" align="center">{{ $sl}}</td>
                        <td class="font-table-content" align="center">{{ $infoasset->YEAR_ID }}</td>
                        <td class="font-table-content" align="center">{{ $infoasset->ARTICLE_NUM }}</td>
                        <td class="font-table-content" align="center">{{ DateThai($infoasset->RECEIVE_DATE) }}</td>
                        <td class="font-table-content text-center">{{ $infoasset->DECLINE_NAME }}</td>
                        <td class="font-table-content">{{ $infoasset->ARTICLE_NAME }}</td>
                        <td class="font-table-content text-center">{{ $infoasset->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                        @if( $infoasset->RISK_TYPE_ID == '0')
                        <td align="center"><span class="badge badge-info">ต่ำ</span></td>
                        @elseif($infoasset->RISK_TYPE_ID== '1')
                        <td align="center"><span class="badge badge-success">กลาง</span></td>
                        @elseif($infoasset->RISK_TYPE_ID == '2')
                        <td align="center"><span class="badge badge-danger">สูง</span></td>
                        @else
                        <td align="center"></td>
                        @endif
                        @if( $infoasset->OPENS == 'True')
                        <td class="font-table-content" align="center"><span class="btn btn-success"><i class="fa-xs fa fa-check"></i></span></td>
                        @else
                        <td class="font-table-content" align="center"></td>
                        @endif

                        <!--<td class="text-font text-pedding">{{ $infoasset->LOCATION_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->LOCATION_LEVEL_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->LEVEL_ROOM_NAME }}</td>
                                        <td class="text-font" align="center">{{ getAge($infoasset->RECEIVE_DATE) }}</td>
                                            <td class="text-font " align="center">{{ DateThai($infoasset->EXPIRE_DATE)  }}</td>-->

                        @if($infoasset->STATUS_ID == 4)
                        <td class="font-table-content" align="center">ถูกยืม</td>
                        @elseif($infoasset->STATUS_ID == 3)
                        <td class="font-table-content" align="center">รอจำหน่าย</td>
                        @elseif($infoasset->STATUS_ID == 2)
                        <td class="font-table-content" align="center">จำหน่ายแล้ว</td>
                        @else
                        <td class="font-table-content" align="center">ปกติ</td>
                        @endif


                        <td class="font-table-content" align="left">{{ $infoasset->DEP_SUB_SUB_NAME }}</td>

                        <td class="font-table-content" align="center">

                            <button type="button" class="btn btn-outline-info dropdown-toggle"
                                id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                ทำรายการ
                            </button>
                            <div class="dropdown-menu" style="width:10px">
                                <a class="dropdown-item"
                                    href="{{ url('manager_asset/assetbarcode/'.$infoasset->ARTICLE_ID ) }}"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                    target="_blank">พิมพ์ Barcode</a>
                                <a class="dropdown-item"
                                    href="{{ url('manager_asset/assetqrcode/'.$infoasset->ARTICLE_ID ) }}"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                    target="_blank">พิมพ์ QRcode</a>
                                <a class="dropdown-item"
                                    href="{{ url('manager_asset/assetinfo/edit/'.$infoasset->ARTICLE_ID) }}"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด/แก้ไข</a>
                                <a class="dropdown-item" href="#detail_depreciate" data-toggle="modal"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                    onclick="depreciate({{$infoasset->ARTICLE_ID}});">ค่าความเสื่อม</a>
                                <a class="dropdown-item"
                                    href="{{ url('manager_asset/infoasset/'.$infoasset->ARTICLE_ID) }}"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">การบำรุงรักษา</a>
                                <a class="dropdown-item"
                                    href="{{ url('manager_asset/infoasset_excel/'.$infoasset->ARTICLE_ID) }}"
                                    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"
                                    target="_blank">พิมพ์ทะเบียนคุมทรัพย์สิน</a>
                            </div>

                        </td>

                    </tr>

                    @php($sl++)

                    @endforeach
                </tbody>
            </table>

            <a href="{{$infoassets->previousPageUrl()}}">
                << </a> @for($i=1;$i<=$infoassets->lastPage();$i++)
                    <!-- a Tag for another page -->
                    <a href="{{$infoassets->url($i)}}">{{$i}}</a>
                    @endfor
                    <!-- a Tag for next page -->
                    <a href="{{$infoassets->nextPageUrl()}}">
                        >>
                    </a>
        </div>
        <br>
        <div style="font-family: 'Kanit', sans-serif; font-size: 15px;font-size: 1.0rem;font-weight:normal;">จำนวน
            {{$countarticle}} รายการ</div>
    </div>
    </div>
    </div>







    <!--------------------------------------->

    <div id="detail_depreciate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="row">
                        <div>
                            <h3 style="font-family: 'Kanit', sans-serif;">
                                &nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดค่าเสื่อม&nbsp;&nbsp;</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-body">



                    <div id="depreciate"></div>


                </div>
                <div class="modal-footer">
                    <div align="right">

                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"
                            style="font-family: 'Kanit', sans-serif;;font-weight:normal;">ปิดหน้าต่าง</button>
                    </div>
                </div>




            </div>
        </div>
    </div>






    @endsection

    @section('footer')




<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

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
        document.getElementById("det").onclick = function () {
            detailasset()
        };

        function detailasset(id) {


            $.ajax({
                url: "{{route('massete.detail')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#detailasset').html(result);

                    //alert("Hello! I am an alert box!!");
                }

            })

        }
    </script>

    <script>
        $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                todayHighlight: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }); //กำหนดเป็นวันปัจุบัน
        });



        function depreciate(id) {


            $.ajax({
                url: "{{route('massete.depreciate')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (result) {
                    $('#depreciate').html(result);


                    //alert("Hello! I am an alert box!!");
                }

            })

        }



        function switchsearch(code) {

            //alert(code);

            var _token = $('input[name="_token"]').val();


            $.ajax({
                url: "{{route('massete.switchsearchassetinfo')}}",
                method: "GET",
                data: {
                    code: code,
                    _token: _token
                },
                success: function (result) {
                    $('.switch_search').html(result);
                    rundatepicker1();
                    rundatepicker2();
                    locationselect();
                }

            })




        }

        //====================================================================================


        function rundatepicker1() {

            $('.datepicker1').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }); //กำหนดเป็นวันปัจุบัน
        }


        function rundatepicker2() {

            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            }); //กำหนดเป็นวันปัจุบัน
        }


        //++++++++++++++++++++++++

        function locationselect() {


            $('.location').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{route('dropdown.repairnomal')}}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function (result) {
                            $('.locationlevel').html(result);
                        }
                    })
                    // console.log(select);
                }
            });

            $('.locationlevel').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{route('dropdown.repairnomalsub')}}",
                        method: "GET",
                        data: {
                            select: select,
                            _token: _token
                        },
                        success: function (result) {
                            $('.locationlevelroom').html(result);
                        }
                    })
                    // console.log(select);
                }
            });

        }
    </script>





    @endsection