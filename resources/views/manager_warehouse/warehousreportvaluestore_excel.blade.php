<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="สรุปงานวัสดุคงคลังตามประเภทสิ่งของ-คลังหลัก.xls"');//ชื่อไฟล์

    use App\Http\Controllers\ManagerwarehouseController;
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานวัสดุคงคลังตามประเภทสิ่งของ คลังหลัก</B></h3>
             
             
            </div>
            <div class="block-content ">
          
         
                <div class="table-responsive"> 
                
                    <table class="table-striped table-vcenter" id="table" style="width: 100%;">
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
                     <?php 
                     $number                = 1;  
                     $sum_quote_amount      = 0;
                     $sum_quote_value       = 0;
                     $sum_receive_amount    = 0;
                     $sum_receive_value     = 0;
                     $sum_export_amount     = 0;
                     $sum_export_value      = 0;
                     $sum_balance_amount    = 0;
                     $sum_balance_value     = 0;
                     ?>
                        @foreach ($conclude_store as $con_store)
                        <?php
                            $quote_amount   = $con_store['receive_before_amount'] - $con_store['export_before_amount'] ;
                            $quote_value    = $con_store['receive_before_value'] - $con_store['export_before_value'] ;
                            $balance_amount = $con_store['all_receive_amount'] - $con_store['all_export_amount'] ;
                            $balance_value  = $con_store['all_receive_value'] - $con_store['all_export_value'] ;
                            
                            $sum_quote_amount      += $quote_amount;
                            $sum_quote_value       += $quote_value;
                            $sum_receive_amount    += (double)$con_store['receive_amount'];
                            $sum_receive_value     += (double)$con_store['receive_value'];
                            $sum_export_amount     += (double)$con_store['export_amount'];
                            $sum_export_value      += (double)$con_store['export_value'];
                            $sum_balance_amount    += $balance_amount;
                            $sum_balance_value     += $balance_value;
                        ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number++}}</td>        
                            <td class="text-font text-pedding" >{{$con_store['STORE_TYPE_NAME']}}</td>
                            <td class="text-font text-pedding" >{{$con_store['STORE_CODE']}}</td>
                            <td class="text-font text-pedding" >{{$con_store['STORE_NAME']}}</td>
                            <td class="text-font text-pedding" >{{$con_store['SUP_TYPE_NAME']}}</td>
                            <td class="text-font text-pedding" >{{$con_store['SUP_UNIT_NAME']}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$quote_amount}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($quote_value,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$con_store['receive_amount']}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($con_store['receive_value'],2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$con_store['export_amount']}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($con_store['export_value'],2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{($quote_amount + $con_store['receive_amount'])- $con_store['export_amount']}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format(($quote_value + $con_store['receive_value']) - $con_store['export_value'],2)}}</td>
                        </tr>    
                            @endforeach  
                        <tr>
                            <td class="text-center" colspan="6">รวม</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$sum_quote_amount}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_quote_value,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$sum_receive_amount}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_receive_value,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$sum_export_amount}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format($sum_export_value,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{($sum_quote_amount+$sum_receive_amount) - $sum_export_amount}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format(($sum_quote_value+$sum_receive_value)-$sum_export_value,2)}}</td>
                        </tr>
                        </tbody>
                    </table>