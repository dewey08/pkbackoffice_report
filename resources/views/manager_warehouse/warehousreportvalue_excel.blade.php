<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="สรุปงานวัสดุคงคลัง-คลังพัสดุ.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerwarehouseController;

?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานวัสดุคงคลัง คลังพัสดุ</B></h3>
             
             
            </div>
            <div class="block-content ">
          
         
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ยอดคงเหลือยกมา<br>คลังหลัก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ยอดคงเหลือยกมา<br>คลังย่อย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ยอดคงเหลือยกมา<br>รวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ซื้อระหว่างเดือน<br>รวม</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ารวม</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">จ่ายส่วนของ รพ.สต.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายส่วนของ รพร. <br>(คลังหลัก)</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายส่วนของ รพร. <br>(คลังย่อย)</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงเหลือ <br>(หลังตัดคลังหลัก)</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงเหลือ <br>(หลังตัดคลังย่อย)</th>
                  
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number=0;  ?>
                    @foreach ($infosuptypes as $infosuptype)
                    <?php 
                  $sum1  = ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end);

                  $sum2 = ManagerwarehouseController::valueforwardstoreinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end);
                    
                  $sum_fomain  = ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end);
                  $sumrefomain = ($sum_fomain+$sum2);
                  $sumre = ($sum1+$sum2);
                  $summain =(ManagerwarehouseController::valueforuserstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end));
                    ?>
                   
                    <?php $number++; ?>
                    <tr height="20">
                    <td class="text-font" align="center">{{$number}}</td>
                         
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $infosuptype -> SUP_TYPE_NAME }}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format((ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end)),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::valueforwardstoreinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
 
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{ number_format($sum1+$sum2,5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">0.0000</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::valueforuserstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::valueforuser($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
   
                        
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(($sumrefomain-$summain),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(($sum1+$sum2)-ManagerwarehouseController::valueforuser($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                
            
                     
            
                        </tr>    
                  
                        @endforeach  

                        <tr height="20" style="background-color: #FFB6C1;">
                        <?php 
                 
                 $sum11  = ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end);

                 $sum22 = ManagerwarehouseController::sumvalueforwardstoreinmonth($displaydate_bigen,$displaydate_end);
                   
                 $sum13  = ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end);  
                   ?>
           
                         
                  <td  colspan="2" style="text-align: center; font-size: 13px;border: 1px solid black;">รวม</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format((ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end)),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvalueforwardstoreinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{ number_format($sum11 + $sum22,5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">0.0000</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvalueforuserstore($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvalueforuser($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(($sum13 + $sum22)-ManagerwarehouseController::sumvalueforuserstore($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(($sum11 + $sum22)-ManagerwarehouseController::sumvalueforuser($displaydate_bigen,$displaydate_end),5)}}</td>
                 
                  </tr>    

                    </tbody>
                </table>