<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_TREASURY.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerwarehouseController; 
?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  >             

    
    <div align="right">มูลค่ารวม {{number_format($sumvalue,5)}}  บาท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div class="block-content ">            
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #48D1CC;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัสวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ประเภทวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงคลัง</th>  
                       
                            
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number=1; ?>
                        @foreach ($infowarehousetreasurys as $infowarehousetreasury)

                        <?php
                                    $num1 = ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID);
                                    $num2 = ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID);  
                                     $resultnum = $num1-  $num2;
                            ?> 
                       
                        <tr height="20">
                        <td class="text-font" align="center" style="border: 1px solid black;">{{$number}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_CODE}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->SUP_UNIT_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format($resultnum)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvaluetreasury($infowarehousetreasury->TREASURY_ID),5)}}</td>
                     
                   
                        
                        </tr>
                        <?php $number++; ?>
                        @endforeach  

                    </tbody>
                </table>
     