<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_SCREEN.xls"');//ชื่อไฟล์

use App\Http\Controllers\AbilityController;
?>

        ข้อมูลผู้ตรวจสุขภาพประจำปี {{$year_id}} จำนวน {{$amount}} คน
      
          
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">

        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">สถานะ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">วันที่คัดกรอง</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ชื่อ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">เพศ</th>   
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อายุ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">หน่วยงาน</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">BMI</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ครอบครัว</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การเจ็บป่วย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">สูบบุรี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ดื่มสุรา</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ออกกำลังกาย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อาหาร</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การขับขี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">เพศสัมพันธ์</th>

        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $number = 1; ?>
                   @foreach ($infos as $info)
      
                   <tr height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>  
                   <td align="center" >
                     @if($info->HEALTH_SCREEN_STATUS == 'SUCCESS')
                     <span class="badge badge-success" >ตรวจแล้ว</span>       
                    @elseif($info->HEALTH_SCREEN_STATUS == 'CONFIRM')
                    <span class="badge badge-info" >ยืนยันการตรวจ</span>
                    @else
                    <span class="badge badge-warning" >คัดกรอง</span>
                     @endif
                     
                     </td>
               
                     <td class="text-font text-pedding">{{DateThai($info->HEALTH_SCREEN_DATE)}}</td> 
                     <td class="text-font text-pedding">{{$info->HR_PREFIX_NAME}}{{$info->HR_FNAME}} {{$info->HR_LNAME}}</td> 
                 
                     <td class="text-font text-pedding">{{$info->SEX_NAME}}</td> 
                     <td class="text-font text-pedding">{{$info->HEALTH_SCREEN_AGE}}</td> 
                     <td class="text-font text-pedding">{{$info->HR_DEPARTMENT_SUB_SUB_NAME}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkbmi($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkfamily($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkillness($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checksmok($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkdrink($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkex($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checklike($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkcar($info->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checksex($info->HEALTH_SCREEN_ID)}}</td> 

        

                  

                   </tr>

                   <?php $number++; ?>
                   @endforeach 
                   </tbody>
                  </table>

    
