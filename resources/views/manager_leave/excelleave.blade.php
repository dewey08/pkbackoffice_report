<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSONLEAVE.xls"');//ชื่อไฟล์


use App\Http\Controllers\ManagerleaveController;
?>
<?php

$color_a = 'background-color: #F0F8FF;';

$yearbudget = $year_id;

?>
        
    
         รายงานข้อมูลการลาของบุคลากร
    
        <br>  
        ปีงบประมาณ&nbsp; {{$yearbudget}} &nbsp;&nbsp;วันที่&nbsp; {{DateThai($displaydate_bigen)}}&nbsp; ถึงวันที่&nbsp; {{DateThai($displaydate_end)}}<br>        
        &nbsp;&nbsp;ค = จำนวนครั้ง ,ว = จำนวนวัน
        <table class="gwt-table table-striped" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" rowspan="2">ลำดับ</td>       
    
      
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%" rowspan="2">ชื่อ นามสกุล</td> 
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ตำแหน่ง</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ฝ่าย/แผนก</td>
       
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาป่วย</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลากิจ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาพักผ่อน</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาคลอดบุตร</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาช่วยคลอด</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาติดตามคู่สมรส</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาทำงานต่างประเทศ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาฟื้นฟูอาชีพ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาศึกษา ฝึกอบรม</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาอุปสมบท</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาเกณฑ์ทหาร</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">รวม</td>
      </tr><tr>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ว</td>
     
                   </tr>
                   </thead>
                   <tbody>
                   <?php $number = 0; ?>
                   @foreach ($persons as $person)
                   <?php $number++; 
                  

                   if( $person->HR_STATUS_ID == 5 || $person->HR_STATUS_ID == 6 || $person->HR_STATUS_ID == 7 || $person->HR_STATUS_ID == 8){
                   $color = 'background-color: #FFF0F5;';
                  
                    }else{
                    $color = '';
                   }
                   ?> 
                   <tr style="{{$color}}" height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>  
                 
                     <td class="text-pedding text-font">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                     
        
                     <td class="text-pedding text-font"> {{ $person -> POSITION_IN_WORK }}</td>   
                   

                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>     
                      
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,1,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,1,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,3,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,3,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,4,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,4,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,2,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,2,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,6,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,6,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,10,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,10,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,9,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,9,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,11,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,11,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,8,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,8,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,5,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,5,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,7,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,7,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="background-color: #FFF0F5;" class="text-pedding text-font">{{  number_format(ManagerleaveController::sumcountamountdayleavemonth($person ->ID,$yearbudget,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td style="background-color: #FFF0F5;" class="text-pedding text-font">{{  number_format(ManagerleaveController::sumcountdayleavemonth($person ->ID,$yearbudget,$displaydate_bigen,$displaydate_end),1) }}</td>

                   </tr>

  
                 
                   @endforeach 
                   </tbody>
                  </table>
</div>
    
  