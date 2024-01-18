<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="STOCK-CARD.xls"');//ชื่อไฟล์

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ManagerwarehouseController;

?>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
             
               
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรับเข้าพัสดุ :: {{$warehousestore->STORE_CODE}}  {{$warehousestore->STORE_NAME}}</B></h3>
                <div align="right">
                   
            </div>
            <div class="block-content ">
                <div class="block block-rounded block-bordered">
                               
                    <div class="block-content tab-content">  
                        <div class="row">                                      
                            <div class="col-md-2">
                                
                                    <h5 style="font-family: 'Kanit', sans-serif;">รายการรับเข้าพัสดุ</h3>
                            </div>
                            <div class="col-md-7">
                            </div>  
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
                                    <hr>
                            
                                    <div class="block-content tab-content">
                                        <div class="tab-pane active" id="object2" role="tabpanel">
        
                                            <div class="row">                                      
                                                <div class="col-md-2">
                                                 
                                                        <h5 style="font-family: 'Kanit', sans-serif;">รายการเบิกจ่ายวัสดุ</h3>
                                                </div>
                                            <div class="col-md-7">
                                            </div>  
                                            <div class="col-md-3"> 
                                            </div> 
                                        </div> 
           
                                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                            <thead style="background-color: #FFF8DC;">
                            
                                <tr height="40">
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
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
<br>
