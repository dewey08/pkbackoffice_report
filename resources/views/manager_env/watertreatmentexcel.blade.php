<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="รายละเอียดผลวิเคราะห์คุณภาพน้ำทิ้ง.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerenvController;
?>
<style>
  table {
  border: 1px solid black;
}
td {
  border: 1px solid black;
  font-family: 'Kanit', sans-serif;
  font-size: 13px !important;

}
th {
  border: 1px solid black;
  font-family: 'Kanit', sans-serif;
  font-weight:normal;
  font-size: 15px !important;
}
</style>
<br><br>
<label for="" style="font-family: 'Kanit', sans-serif;font-size: 25px;"><b>
  รายละเอียดผลวิเคราะห์คุณภาพน้ำทิ้งจำนวน  {{ $count }} รายการ </b>
</label>     
<br><br>
<table  width="100%">
<thead >
        
<tr style="background-color: #FFEBCD;" height="40">    
  <th class="text-font" style="text-align: center;" width="4%">ลำดับ</th> 
  <th  class="text-font" style="text-align: center;" width="5%">ปี</th>  
  <th  class="text-font" style="text-align: center;" width="7%">วันที่บันทึก</th>
  <th  class="text-font" style="text-align: center;" width="10%">สถานที่เก็บตัวอย่าง</th>
  <th  class="text-font" style="text-align: center;">ลักษณะตัวอย่าง</th>
  <th  class="text-font" style="text-align: center;">วันที่รับตัวอย่าง</th>
  <th  class="text-font" style="text-align: center;">วันที่วิเคราะห์ตัวอย่าง</th>
  <th  class="text-font" style="text-align: center;" width="10%">ผู้วิเคราะห์ตัวอย่าง</th>
  @foreach($lists as $list)
  <th  class="text-font" style="text-align: center;" width="8%">{{$list->LIST_PARAMETER_DETAIL}}</th>
  @endforeach 
  <th  class="text-font" style="text-align: center;" width="8%">ผู้บันทึก</th> 
                        

</tr>
         </tr>
         </thead>
         <tbody>
         <?php $number = 0; ?>
         @foreach ($parameters as $parameter)
         <?php $number++; ?> 
         <tr height="20">
          <td class="text-font" align="center" width="4%"> {{ $number}} </td>
          <td class="text-font" align="center" width="5%">{{ $parameter->PARAMETER_YEAR }}</td>   
          <td class="text-font text-pedding" width="7%">{{ DateThai($parameter->PARAMETER_DATE) }}</td> 
          <td class="text-font" align="center" width="10%">{{$parameter->LOCATION_EX}}</td>
           <td class="text-font" align="center" width="10%">{{$parameter->GROUP_EXCAMPLE}}</td>
           <td class="text-font text-pedding"  width="7%">{{DateThai($parameter->LOCATION_EXDATE)}}</td>
           <td class="text-font text-pedding"  width="7%">{{DateThai($parameter->GROUP_EXCAMPLEDATE)}}</td>
           <td class="text-font" align="center" width="10%">{{$parameter->USER_EXCAMPLE}}</td>
           @foreach($lists as $list)
           <th  class="text-font" style="text-align: center;" width="8%">{{ManagerenvController::total_parameter($list->LIST_PARAMETER_ID,$parameter->PARAMETER_ID)}}</th>
    
           @endforeach  
         

          <td class="text-font" align="center" width="8%">{{ $parameter->HR_FNAME }}  {{ $parameter->HR_LNAME }}</td> 
        
     </tr> 
       
         @endforeach 
         </tbody>
        </table>
