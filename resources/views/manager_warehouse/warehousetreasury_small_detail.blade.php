@extends('layouts.warehouse')   
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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
                    table, td, th {
            border: 1px solid black;
            }  

  
</style>

<script>
    function checklogin(){
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

 
    use App\Http\Controllers\ManagerwarehouseController;

?>       
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default" style="text-align: left;">


                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย >> {{"{$warehousetreasury->TREASURY_SMALL_CODE} {$warehousetreasury->TREASURY_SMALL_NAME}"}}</B></h3>
                <div align="right">

                    <a href="{{ route('mwarehouse.treasury_small') }}" class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
                </div>
            </div>
                  
            <div class="block-content ">    
                
                <div class="block block-rounded block-bordered">
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                        style="background-color: #E6E6FA;">
                        <li class="nav-item">
                            <a class="nav-link active" href="#object1"
                                style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการรับเข้าพัสดุ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2"
                                style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการเบิกจ่ายวัสดุ</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="object1" role="tabpanel">

                            <div style="text-align: right;">
                                มูลค่าคงเหลือรวม {{ number_format($balance,5)}} บาท
                            </div>

                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple"
                                style="width: 100%;">
                                <thead style="background-color: #FFF0F5;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                            width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">วันที่รับ
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ประเภท
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รายการ
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ล็อต</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รับเข้า
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">จ่ายออก
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                            จำนวนคงเหลือ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วย
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                            ราคาต่อหน่วย</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                            มูลค่าคงเหลือ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">Exp</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ผู้รับ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $number=1; ?>
                                    @foreach ($storereceivesubs as $storereceivesub)

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding">
                                            {{DateThai($storereceivesub->TREASURY_RECEIVE_SMALL_GEN_DATE)}}</td>
                                        <td class="text-font text-pedding">{{$storereceivesub->CYCLE_DISBURSE_NAME}}
                                        </td>
                                        <td class="text-font text-pedding">
                                            {{$storereceivesub->TREASURY_RECEIVE_SMALL_NAME}}</td>
                                        <td class="text-font text-pedding">
                                            {{$storereceivesub->TREASURY_RECEIVE_SMALL_LOT}}</td>
                                        <td class="text-font text-pedding" align="center">
                                            {{$storereceivesub->TREASURY_RECEIVE_SMALL_AMOUNT}}</td>
                                        <td class="text-font text-pedding" align="center">
                                            {{ManagerwarehouseController::sumtreasuryexportsubsmall($storereceivesub->TREASURY_RECEIVE_SMALL_ID)}}
                                        </td>
                                        <td class="text-font text-pedding" align="center">
                                            {{($storereceivesub->TREASURY_RECEIVE_SMALL_AMOUNT) - (ManagerwarehouseController::sumtreasuryexportsubsmall($storereceivesub->TREASURY_RECEIVE_SMALL_ID))}}
                                        </td>
                                        <td class="text-font text-pedding">{{$storereceivesub->SUP_UNIT_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;">
                                            {{number_format($storereceivesub->TREASURY_RECEIVE_SMALL_PICE_UNIT,5)}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;">
                                            {{number_format(($storereceivesub->TREASURY_RECEIVE_SMALL_AMOUNT - (ManagerwarehouseController::sumtreasuryexportsubsmall($storereceivesub->TREASURY_RECEIVE_SMALL_ID))) * $storereceivesub->TREASURY_RECEIVE_SMALL_PICE_UNIT,5)}}
                                        </td>
                                        <td class="text-font text-pedding">
                                            {{DateThai($storereceivesub->TREASURY_RECEIVE_SMALL_EXP_DATE)}}</td>
                                        <td class="text-font text-pedding">{{$storereceivesub->WAREHOUSE_SMALLHOS_NAME}}
                                        </td>
                                        <td class="text-font text-pedding">{{$storereceivesub->WAREHOUSE_SAVE_HR_NAME}}
                                        </td>
                                    </tr>

                                    <?php $number++; ?>
                                    @endforeach

                                </tbody>
                            </table>
                            <br>

                        </div>

                        <div class="tab-pane" id="object2" role="tabpanel">


                            <div style="text-align: right;">
                                มูลค่าการจ่ายรวม {{ number_format($balance2,5)}} บาท
                            </div>
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple"
                                style="width: 100%;">
                                <thead style="background-color: #ADD8E6;">

                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                            width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                            วันที่จ่าย</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รายการ
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ล็อต</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">จ่ายออก
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วย
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">
                                            ราคาต่อหน่วย</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">มูลค่า
                                        </th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">Exp</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $number=1; ?>
                                    @foreach ($storeexportsubs as $storeexportsub)

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding">
                                            {{DateThai($storeexportsub->TREASURT_PAY_SMALL_DATE)}}</td>
                                        <td class="text-font text-pedding">
                                            {{$storeexportsub->TREASURY_EXPORT_SMALL_NAME}}</td>
                                        <td class="text-font text-pedding">
                                            {{$storeexportsub->TREASURY_EXPORT_SMALL_LOT}}</td>
                                        <td class="text-font text-pedding">
                                            {{$storeexportsub->TREASURY_EXPORT_SMALL_AMOUNT}}</td>
                                        <td class="text-font text-pedding">{{$storeexportsub->SUP_UNIT_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;">
                                            {{number_format($storeexportsub->TREASURY_EXPORT_SMALL_PICE_UNIT,5)}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;">
                                            {{number_format($storeexportsub->TREASURY_EXPORT_SMALL_PICE_UNIT * $storeexportsub->TREASURY_EXPORT_SMALL_AMOUNT,5)}}
                                        </td>
                                        <td class="text-font text-pedding">
                                            {{DateThai($storeexportsub->TREASURY_EXPORT_SMALL_EXP_DATE)}}</td>




                                        <?php $number++; ?>
                                        @endforeach




                                </tbody>
                            </table>


            </div>

        </div>
    </div>
  
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


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
    $('select').select2({
    width: '100%'
});

    });
$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection