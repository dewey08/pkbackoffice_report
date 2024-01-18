<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="สรุปงานวัสดุคงคลังตามประเภทสิ่งของ-คลังย่อย.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerwarehouseController; 
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานวัสดุคงคลังตามประเภทสิ่งของ คลังย่อย</B></h3>
             
             
            </div>
            <div class="block-content ">
    

            <div class="table-responsive"> 
              
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการสินค้า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ายกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนรับใหม่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ารับใหม่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนคงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงเหลือ</th>

                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number=0;  ?>
                    @foreach ($infosuptypes as $infosuptype)
                    <?php $number++; 
    
                  $sum1 =  ManagerwarehouseController::valueamountforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueamountforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end);
                  $sum2 =  ManagerwarehouseController::valuesubforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valuesubforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end);

                ?>
            
                    <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>        
                        <td class="text-font text-pedding" >{{$infosuptype->TREASURY_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infosuptype->TREASURY_CODE}}</td>
                        <td class="text-font text-pedding" >{{$infosuptype->TREASURY_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infosuptype->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infosuptype->SUP_UNIT_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{$sum1 - ManagerwarehouseController::valueamountpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum2 -ManagerwarehouseController::valuesubpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>

                        </tr>    
       
                        @endforeach  

                        <?php

                    $sum11 =  ManagerwarehouseController::sumvalueamountforwardtreasury($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueamountforwardtreasuryinmonth($displaydate_bigen,$displaydate_end);
                    $sum22 =  ManagerwarehouseController::sumvaluesubforwardtreasury($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvaluesubforwardtreasuryinmonth($displaydate_bigen,$displaydate_end);
  
                      ?>
              
                      <tr height="20" style="background-color: #FFB6C1;">
                      <td  colspan="6" style="text-align: center; font-size: 13px;">รวม</td>
                          <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountforwardtreasury($displaydate_bigen,$displaydate_end)}}</td>
                          <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubforwardtreasury($displaydate_bigen,$displaydate_end),5)}}</td>
                          <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountforwardtreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                          <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubforwardtreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                          <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountpaytreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                          <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubpaytreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                          <td class="text-font text-pedding" style="text-align: center;">{{$sum11 - ManagerwarehouseController::sumvalueamountpaytreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                          <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum22 -ManagerwarehouseController::sumvaluesubpaytreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
  
                          </tr>    

                    </tbody>
                </table>
 