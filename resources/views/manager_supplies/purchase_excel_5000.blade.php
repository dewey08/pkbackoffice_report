<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PURCHASE_5000.xls"');//ชื่อไฟล์
    $date = date('Y-m-d');
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">
                <B>สรุปผลการดำเนินการจัดซื้อ/จัดจ้าง ที่มีมูลค่า ต่ำกว่า 5,000 บาท</B><br>
                <B>วันที่  {{DateThai($displaydate_bigen)}} ถึง    {{DateThai($displaydate_end)}} </B> 
         
                </h3>
        
            </div>
            <div class="block-content block-content-full">
          
           
             <div class="table-responsive" style="min-height: 450px;"> 
             <div style="text-align: right;">มูลค่ารวม {{ number_format($budgetsum,5)}} บาท</div>
             <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วัน/เดือน/ปี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เลขประจำตัวผู้เสียภาษี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อผู้ประกอบการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการพัสดุที่จัดซื้อจัดจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วงเงินที่จัดซื้อจัดจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เลขที่สัญญาหรือข้อตกลง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หมายเหตุ</th>

                        </tr> 
                    </thead>
                    <tbody>

                    
                    <?php $number = 0; ?>
                    @foreach ($infosupcons as $inforequest)  

                    <?php $number++;
                    
                    $query= DB::table('supplies_con_quotation')  
                    ->leftJoin('supplies_vendor','supplies_vendor.VENDOR_ID','=','supplies_con_quotation.QUOTATION_VENDOR_ID')
                    ->where('QUOTATION_CON_NUM','=',$inforequest->CON_NUM)
                    ->where('QUOTATION_WIN','=',1)
                    ->first();      
                                                
        
                            
                    if($query == null || $query == ''){
                            $amount_pay = 0;
                            $vendor_name = '-';
                            $taxname = '-';
                         }else{
                            $amount_pay = $query->QUOTATION_VENDOR_PICE;
                            $vendor_name = $query->VENDOR_NAME;
                            $taxname = $query->VENDOR_TAX_NUM;
                         }   
                          
                    
                    ?>

                  @if($amount_pay < 5000)

                        <tr height="20">
                
                            <td class="text-font" style="border: 1px solid black;"  align="center">{{$number}}</td>
                            <td class="text-font" style="border: 1px solid black;"  align="center">{{DateThai($inforequest->DATE_REGIS)}}</td>
                            <td class="text-font  text-pedding" style="border: 1px solid black;" >{{$taxname}}</td>
                            <td class="text-font  text-pedding" style="border: 1px solid black;" >{{$vendor_name}}</td>
                            <td class="text-font  text-pedding" style="border: 1px solid black;" >{{$inforequest->SUP_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;"  align="right">{{$amount_pay}}</td>  
                            <td class="text-font text-pedding" style="border: 1px solid black;" >{{$inforequest->CON_NUM}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >เป็นการจัดซื้อจัดจ้างวงเงินเล็กน้อยตามมาตรา ๙๖ วรรคสอง</td>
                           
                       
                        </tr>  

                        @endif
                        @endforeach   

                    </tbody>
                </table>