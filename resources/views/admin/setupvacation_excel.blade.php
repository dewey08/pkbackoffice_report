<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="MyXls.xls"');//ชื่อไฟล์
?>  

   

                กำหนดค่าวันลาพักผ่อนในงบปี {{ $budget }}        
                  <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="45">
        <th style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
        <th style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
        <th style="border-color:#F0FFFF;text-align: center;">ชื่อ นามสกุล</th>
        <th style="border-color:#F0FFFF;text-align: center;" width="15%">ประเภทบุคคล</th>
        <th style="border-color:#F0FFFF;text-align: center;" width="15%">คงเหลือ<br>ปีงบก่อน</th>
        <th  style="border-color:#F0FFFF;text-align: center;">อายุทำงาน</th>
        <th  style="border-color:#F0FFFF;text-align: center;">ปีงบประมาณนี้ลาได้</th>
        <th style="border-color:#F0FFFF;text-align: center;" width="10%">ปีงบประมาณ</th>
      
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $count=0; ?> 
                   @foreach ($infoinfovacations as $infoinfovacation)
                   <?php $count++; ?> 
                   <tr height="45">
                    <td align="center">{{ $count }}</td> 
                     <td align="center">{{ $infoinfovacation-> ID }}</td> 
                     <td>{{ $infoinfovacation-> HR_PREFIX_NAME }} {{ $infoinfovacation-> HR_FNAME }} {{ $infoinfovacation-> HR_LNAME }}</td> 
                     <td>{{ $infoinfovacation-> HR_PERSON_TYPE_NAME }}</td> 
                     <td align="center">{{ number_format($infoinfovacation-> DAY_LEAVE_OVER_BEFORE) }}</td> 
                     <td align="center">{{ $infoinfovacation-> OLDS }}</td> 
                     <td align="center" >{{number_format($infoinfovacation-> DAY_LEAVE_OVER) }}</td> 
                     <td align="center">{{ $infoinfovacation-> OVER_YEAR_ID }}</td> 
                          
                   </tr> 
                   @endforeach 
                   </tbody>
                  </table>
              
                
                 