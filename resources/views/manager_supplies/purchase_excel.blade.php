<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PURCHASE.xls"');//ชื่อไฟล์

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
                <B>สรุปผลการดำเนินการจัดซื้อ/จัดจ้าง</B><br>
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
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >งานที่จะจัดซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วงเงินที่จะซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคากลาง</th>


                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วิธีซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายชื่อผู้เสนอราคาและราคาที่เสนอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ที่ได้รับการคัดเลือกและราคาที่ตกลงซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลที่คัดเลือกโดยสรุป</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" colspan="3">เลขที่และวันที่ของสัญญาหรือข้อตกลงในการจัดซื้อหรือจัดจ้าง</th>
                        </tr> 
                    </thead>
                    <tbody>

                    
                    <?php $number = 0; ?>
                    @foreach ($infosupcons as $inforequest)  

                    <?php $number++;
                    

                    
                    ?>

                        <tr height="20">
                
                            <td class="text-font" style="border: 1px solid black;"  align="center">{{$number}}</td>
                            <td class="text-font" style="border: 1px solid black;"  align="center">{{DateThai($inforequest->DATE_REGIS)}}</td>
                            <td class="text-font  text-pedding" style="border: 1px solid black;" >{{$inforequest->SUP_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;"  align="right">
                            <?php
                                                        $query= DB::table('supplies_con_quotation')  
                                                        ->leftJoin('supplies_vendor','supplies_vendor.VENDOR_ID','=','supplies_con_quotation.QUOTATION_VENDOR_ID')
                                                        ->where('QUOTATION_CON_NUM','=',$inforequest->CON_NUM)
                                                        ->where('QUOTATION_WIN','=',1)
                                                        ->get();      
                                                                                    
                                                        foreach ($query as $row){
                                                         
                                                                echo $row->QUOTATION_VENDOR_PICE;
                                                        }
                                                            
                                                              
                                            ?>
                            
                            </td>  
                            <td class="text-font text-pedding" style="border: 1px solid black;" ></td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >{{$inforequest->BUY_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >
                            <?php
                                                        $query= DB::table('supplies_con_quotation')  
                                                        ->leftJoin('supplies_vendor','supplies_vendor.VENDOR_ID','=','supplies_con_quotation.QUOTATION_VENDOR_ID')
                                                        ->where('QUOTATION_CON_NUM','=',$inforequest->CON_NUM)->get();
                                                                                    
                                                                                    
                    
                                                        foreach ($query as $row){
                                                         
                                                                echo $row->VENDOR_NAME."<br>เสนอราคาเป็นเงิน ".$row->QUOTATION_VENDOR_PICE." บาท";
                                                        }
                                                            
                                                              
                                            ?>
                            
                            </td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >
                            
                            <?php
                                                        $query= DB::table('supplies_con_quotation')  
                                                        ->leftJoin('supplies_vendor','supplies_vendor.VENDOR_ID','=','supplies_con_quotation.QUOTATION_VENDOR_ID')
                                                        ->where('QUOTATION_CON_NUM','=',$inforequest->CON_NUM)
                                                        ->where('QUOTATION_WIN','=',1)
                                                        ->get();
                                                                                    
                                                                                    
                    
                                                        foreach ($query as $row){
                                                         
                                                                echo $row->VENDOR_NAME."<br>เสนอราคาเป็นเงิน ".$row->QUOTATION_VENDOR_PICE." บาท";
                                                        }
                                                            
                                                              
                                            ?>
                            
                            </td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >เสนอราคาถูกต้องตามเงื่อนไขที่กำหนด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >{{substr($inforequest->CON_NUM,3)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >ลว</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" >{{DateThai($inforequest->DATE_REGIS)}}</td>

                       
                        </tr>  
                        @endforeach   

                    </tbody>
                </table>