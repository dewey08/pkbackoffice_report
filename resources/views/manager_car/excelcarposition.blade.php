<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายงานประเภทรถประจำตำแหน่ง แบบ๑.xls"');//ชื่อไฟล์

  

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');


?>
   
     <center>
     <B>ประเภทรถประจำตำแหน่ง</B> <br>
     <B> ทำเบียนรถของ  {{$orgname->ORG_NAME}}</B>
       </center>                   


        <table  width="100%">
            <thead >
                <tr height="40">
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ชื่อของรถ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">แบบ/รุ่นปี/ขนาด(ซี.ซี)</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หมายเลขทะเบียนรถ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประจำตำแหน่งใด</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ราคา</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันได้มา</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันจำหน่าย</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หมายเหตุ</th>  
                </tr >
            </thead>
            <tbody>
            

            <?php $number = 0; ?>
            @foreach ($infocar_position as $infocarposition)
            <?php $number++; ?>
                <tr height="20">
                  <td class="text-font"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>
                  <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ $infocarposition->ARTICLE_NAME}}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="15%">{{ $infocarposition->BRAND_NAME }} / {{ $infocarposition->YEAR_ID }} / {{ $infocarposition->CAR_CC }}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infocarposition->CAR_REG }}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infocarposition->POSITION_NAME }}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;" width="10%">{{ $infocarposition->PRICE_PER_UNIT }} &nbsp;&nbsp;</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ DateThai($infocarposition->RECEIVE_DATE )}}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ DateThai($infocarposition->SOLDOUT_DATE )}}</td>
                  <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%"></td>      
                </tr>
                @endforeach   
          
            </tbody>
        </table>

                   

                
                 
                  
      
                      

