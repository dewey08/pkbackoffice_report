<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายละเอียดการตรวจเช็คออกซิเจนเหลว.xls"');//ชื่อไฟล์

?>
<br><br>
<label for="" style="font-family: 'Kanit', sans-serif;font-size: 25px;"><b>
ข้อมูลตรวจเช็คออกซิเจนเหลวจำนวน  {{ $count }} รายการ </b>
</label>     
<br><br>
<table  width="100%">
<thead >
        
<tr style="background-color: #FFEBCD;" height="40">    
  <th class="text-font" style="text-align: center;border: 1px solid black;" width="5%">ลำดับ</th> 
  <th class="text-font" style="text-align: center;border: 1px solid black;" width="8%">ปี</th>  
  <th class="text-font" style="text-align: center;border: 1px solid black;" width="15%">OXIGEN_NO</th>
  <th class="text-font" style="text-align: center;border: 1px solid black;" width="15%">วันที่บันทึก</th>
  <th class="text-font" style="text-align: center;border: 1px solid black;" width="12%">เวลา</th>   
  <th class="text-font" style="text-align: center;border: 1px solid black;" >ผู้บันทึก</th> 
  <th class="text-font" style="text-align: center;border: 1px solid black;" >ผู้ตรวจสอบ</th>         

</tr>
         </tr>
         </thead>
         <tbody>
         <?php $number = 0; ?>
         @foreach ($oxi as $oxi)
         <?php $number++; ?> 
         <tr height="40">
            <td class="text-font" style="border: 1px solid black;" align="center"> {{ $number}}</td> 
            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$oxi->OXIGEN_YEAR}}</td>  
            <td class="text-font text-pedding" style="border: 1px solid black;">{{$oxi->OXIGEN_BILL_NO}}</td>
            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{DateThai($oxi->OXIGEN_DATE)}}</td>
            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$oxi->OXIGEN_TIME}}</td> 
            <td class="text-font text-pedding" style="border: 1px solid black;">{{$oxi->HR_FNAME}} {{$oxi->HR_LNAME}}</td> 
            <td class="text-font text-pedding" style="border: 1px solid black;">{{$oxi->OXIGEN_CHECK_NAME}} </td>  
         </tr>
       
         @endforeach 
         </tbody>
        </table>
