<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์


use Illuminate\Support\Facades\DB;
use App\Person;
use App\Incidence;
use App\Risk_internalcontrol;
use App\Risk_internalcontrol_organi;
use App\Risk_internalcontrol_organi_sub;
use App\Riskrep;
use App\Risk_setupincidence_level;
use App\Risk_internalcontrol_pk5;
use App\Risk_internalcontrol_pk5_sub;
?>

<h4 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-9" align="center">
          รายงานการประเมินผลการควบคุมภายใน &nbsp;&nbsp;  &nbsp;&nbsp; ({{ $icontrols-> HR_DEPARTMENT_SUB_NAME}})
            </div>
          <div class="col-md-3" align="right">
         <small> แบบ ปค.5 องค์กร </small>
       
          </div>
          </div>
          </h4>  
<br>
<table  width="100%">
    <thead >        
        <tr style="background-color: #FFEBCD;" height="40">  
            <th class="text-font" style="text-align: center;">ภารกิจหลัก || วัตถุประสงค์</th>
            <th class="text-font" style="text-align: center;">การควบคุมภายในที่มีอยู่</th> 
            <th class="text-font" style="text-align: center;">ความเสี่ยงที่ยังมีอยู่</th> 
            <th class="text-font" style="text-align: center;">การปรับปรุงการควบคุมภายใน</th> 
            <th class="text-font" style="text-align: center;">หน่วยงานที่รับผิดชอบ/กำหนดเสร็จ</th>
          
        </tr>
    </thead>
    <tbody>   
    <?php $number = 0; ?>
                       
                       <?php $number++; ?>
                       <tr> 
                     
                           <td rowspan="50" style="text-align: left;font-size: 14px;font-weight:normal;">                               
                           {{$icontrols->INTERNALCONTROL_MISSION}}<br>
                         
                           <?php $count = 1; ?>
                           @foreach ($icontrol_subs as $item)
                           {{$count}}&nbsp;&nbsp;{{$item->INTERNALCONTROL_OBJECTIVE}}<br>
                           <?php $count++; ?>
                               @endforeach  

                           </td>
      
                           </tr>
        @foreach ($icontrol_organisubs as $icontrol_organisub)
        <tr> 
                <input type="hidden" name="PK5_DEPART_SUB_ID[]" id="PK5_DEPART_SUB_ID[]" value="{{$id}}">
                <td  style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; {{$icontrol_organisub->PK5_ORGANI_SUB_CONTROL }} </td>
                <td  style="text-align: left;font-size: 14px;font-weight:normal;"> &nbsp;&nbsp; {{$icontrol_organisub->PK5_ORGANI_SUB_HAVERISK }}</td >
                <td style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; {{$icontrol_organisub->PK5_ORGANI_SUB_UPDATECONTROL }} </td>                                       
                <td style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; {{$icontrol_organisub->PK5_ORGANI_SUB_USER }} </td>
        </tr>
    @endforeach   
           
    </tbody>
</table>
