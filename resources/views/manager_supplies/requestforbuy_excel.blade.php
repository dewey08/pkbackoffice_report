<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_FORBUY.xls"');//ชื่อไฟล์

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปผลการดำเนินจัดซื้อ/จัดจ้าง</B></h3>
           
            </div>
            <div class="block-content block-content-full">

             <div class="table-responsive"> 
             <div align="right">มูลค่ารวม {{number_format($sumbudget,2)}}  บาท</div>
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >งานที่จะจัดซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วงเงินที่จะซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคากลาง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วิธีซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายชื่อผู้เสนอราคาและราคาที่เสนอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ที่ได้รับการคัดเลือกและราคาที่ตกลงซื้อหรือจ้าง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลที่คัดเลือกโดยสรุป</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เลขที่และวันที่ของสัญญาหรือข้อตกลงในการจัดซื้อหรือจ้าง</th>

                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 1; ?>
                    @foreach ($inforequests as $inforequest)  

         
                        <tr height="20">
                        <td class="text-font" align="center" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>

                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($inforequest -> DATE_WANT) }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ $inforequest -> REQUEST_FOR }}</td>
                            <td class="text-font text-pedding" align="right" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ number_format($inforequest -> BUDGET_SUM,2) }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td> 


                           
                        </tr>

                        <?php $number++; ?>
                        @endforeach   

                    </tbody>
                </table>

