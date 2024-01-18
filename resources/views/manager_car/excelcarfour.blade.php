<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายงานประเภทรถส่วนกลาง แบบ๒.xls"');//ชื่อไฟล์

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');


?>
   
     <center>
     <B>รายงานบันทึกการใช้รถ</B> <br>
     <B> <label style="font-family: 'Kanit', sans-serif;font-weight:normal;color:blue">รถหมายเลขทะเบียน &nbsp;{{$regcars->CAR_REG}}</label></B>
       </center>                   


       
        <table  width="100%">
            <thead >
                <tr height="40">
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ออกเดินทาง <br>วันที่ / เวลา</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ผู้ใช้รถ</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สถานที่ไป</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ระยะทางเมื่อรถออกเดินทาง</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">กลับถึงสำนักงาน <br>วันที่ / เวลา</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ระยะทางเมื่อรถกลับสำนักงาน</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ระยะทาง กม.</th>
                  <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >พนักงานขับรถ</th>
                  <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หมายเหตุ</th> 
                </tr >
            </thead>
            <tbody>
            

            <?php $number = 0; ?>
            @foreach ($infocar_position as $infocarposition)
            <?php $number++; ?>
                <tr height="20">
                    <td class="text-font"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">{{ DateThai($infocar->RESERVE_BEGIN_DATE) }} &nbsp;/&nbsp; {{formatetime($infocar->RESERVE_BEGIN_TIME) }}&nbsp; น.</td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infocar->RESERVE_PERSON_NAME }}</td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->LOCATION_ORG_NAME }}</td>
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{number_format($infocar->CAR_NUMBER_BEGIN) }}</td>
                    @if($infocar->BACK_DATE != '' || $infocar->BACK_DATE != NUll)
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{DateThai($infocar->BACK_DATE)}} &nbsp;/&nbsp; {{$infocar->BACK_TIME}}&nbsp; น.</td>                                        
                    @else
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                    @endif                                       
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ number_format($infocar->CAR_NUMBER_BACK) }}</td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{(number_format($infocar->CAR_NUMBER_BACK - $infocar->CAR_NUMBER_BEGIN))}}</td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->HR_FNAME }} {{ $infocar->HR_LNAME }}</td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{ $infocar->COMMENT }}</td>                                     
                </tr>
                @endforeach   
          
            </tbody>
        </table>

                   

                
                 
                  
      
                      

