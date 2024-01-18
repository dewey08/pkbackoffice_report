<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์

?>


      

<table  width="100%">
    <thead >        
        <tr style="background-color: #FFEBCD;" height="40">  
            <th style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
            <th  class="text-font" class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ชื่อ-นามสกุล</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ตำแหน่ง</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">วันที่เข้าประชุม</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เรื่องที่ประชุม</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="26%">สถานที่</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 0; ?>
        @foreach ($inforrecordindexs as $inforrecordindex)
        <?php $number++; ?>

            <tr height="20">
                <td align="center">{{$number}}</td> 
                <td class="text-font text-pedding" >{{ $inforrecordindex->HR_FULLNAME}}</td>
                <td class="text-font text-pedding" >{{ $inforrecordindex->HR_POSITION}}</td>
                <td class="text-font text-pedding" >{{ DateThai($inforrecordindex->DATE_GO)}}</td>
                <td class="text-font text-pedding" >{{ $inforrecordindex->RECORD_HEAD_USE}}</td>
                <td class="text-font text-pedding" >{{ $inforrecordindex->LOCATION_ORG_NAME}}</td>
               

            </tr>

          
@endforeach

        </tbody>
</table>
