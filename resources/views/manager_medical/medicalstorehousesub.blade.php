@extends('layouts.medical')   
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

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
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

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
             
               
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรับเข้าคลัง :: {{$warehousestore->STORE_CODE}}  {{$warehousestore->STORE_NAME}}</B></h3>
                <div align="right">

<a href="{{ url('manager_medical/storehouse') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
</div>
            </div>
            <div class="block-content ">
             
              
         
                
                 
                <div class="block block-rounded block-bordered">
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E9967A;">
                        <li class="nav-item">
                            <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการรับเข้าพัสดุ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการเบิกจ่ายวัสดุ</a>
                        </li>


                      
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="object1" role="tabpanel">

                        <div class="row">                                      
                            <div class="col-md-9"></div>
                        
                             <div class="col-md-3">                    
                                        มูลค่าคงเหลือรวม {{ number_format(ManagerwarehouseController::sumvaluestore($idstore),5)}} บาท                  
                            </div>
                        </div>
                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                            <thead style="background-color: #F0F8FF;">
                                                <tr height="40">
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วันที่รับ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ล็อต</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับเข้า</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายออก</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนคงเหลือ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคาต่อหน่วย</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่า</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >Exp</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับจาก</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้รับ</th>
                                                </tr >
                                            </thead>
                                            <tbody>
                                        
                                                
                                                <?php $number=1; ?>
                                                @foreach ($storereceivesubs as $storereceivesub)

                                                <tr height="20">
                                                <td class="text-font" align="center">{{$number}}</td>
                                                <td class="text-font text-pedding" >{{DateThai($storereceivesub->RECEIVE_CHECK_DATE)}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->SUP_TYPE_NAME}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->RECEIVE_SUB_NAME}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->RECEIVE_SUB_LOT}}</td>
                                                <td class="text-font text-pedding" style="text-align: center;" >{{$storereceivesub->RECEIVE_SUB_AMOUNT}}</td>
                                                <td class="text-font text-pedding" style="text-align: center;" >{{number_format(ManagerwarehouseController::sumstoreexportlot($storereceivesub->RECEIVE_SUB_ID))}}</td>
                                                <td class="text-font text-pedding" style="text-align: center;" >{{$storereceivesub->RECEIVE_SUB_AMOUNT - (ManagerwarehouseController::sumstoreexportlot($storereceivesub->RECEIVE_SUB_ID))}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->SUP_UNIT_NAME}}</td>
                                                <td class="text-font text-pedding" style="text-align: right;">{{number_format($storereceivesub->RECEIVE_SUB_PICE_UNIT,5)}}</td>
                                                <td class="text-font text-pedding" style="text-align: right;" >{{number_format(($storereceivesub->RECEIVE_SUB_AMOUNT - (ManagerwarehouseController::sumstoreexportlot($storereceivesub->RECEIVE_SUB_ID))) * $storereceivesub->RECEIVE_SUB_PICE_UNIT,5)}}</td>
                                                <td class="text-font text-pedding" >{{DateThai($storereceivesub->RECEIVE_SUB_EXP_DATE)}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->RECEIVE_ACCEPT_FROM}}</td>
                                                <td class="text-font text-pedding" >{{$storereceivesub->RECEIVE_PERSON_NAME}}</td>
                                                </tr>

                                                <?php $number++; ?>
                                                @endforeach  
                                            
                                    
                                            
                                        

                                            </tbody>
                                        </table>
                                        <br>
                        </div>

    <div class="tab-pane" id="object2" role="tabpanel">

        <div class="row push" style="text-align: left;">     
                    
        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                <thead style="background-color: #FFF8DC;">
                
                    <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ID</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วันที่จ่าย</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัสจ่าย</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ล็อต</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายออก</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคาต่อหน่วย</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่า</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >Exp</th>
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้รับ</th>
                
                    </tr >
                </thead>
                <tbody>
                                    
                    <?php $number=1; ?>
                        @foreach ($storeexportsubs as $storeexportsub)

                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->EXPORT_SUB_ID}}</td>
                        <td class="text-font text-pedding" >{{DateThai($storeexportsub->WAREHOUSE_PAYDAY)}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->WAREHOUSE_REQUEST_CODE}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->CYCLE_DISBURSE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->EXPORT_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->EXPORT_SUB_LOT}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{$storeexportsub->EXPORT_SUB_AMOUNT}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->SUP_UNIT_NAME}}</td>                    
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format($storeexportsub->EXPORT_SUB_PICE_UNIT,5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format($storeexportsub->EXPORT_SUB_AMOUNT * $storeexportsub->EXPORT_SUB_PICE_UNIT,5)}}</td>
                        <td class="text-font text-pedding" >{{DateThai($storeexportsub->EXPORT_SUB_EXP_DATE)}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->HR_FNAME}} {{$storeexportsub->HR_LNAME}}</td>
                
                        </tr>

                        <?php $number++; ?>
                        @endforeach  
            
                </tbody>
            </table>
            <br>
        </div>

              


   
 


@endsection

@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
$(document).ready(function () {

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    autoclose: true                    //Set เป็นปี พ.ศ.
});  //กำหนดเป็นวันปัจุบัน
});
</script>
@endsection