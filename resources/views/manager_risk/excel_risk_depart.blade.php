<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์


use Illuminate\Support\Facades\DB;
use App\Person;
use App\Incidence;
use App\Risk_internalcontrol;
use App\Risk_internalcontrol_sub;
use App\Risk_internalcontrol_subsub;
use App\Riskrep;
use App\Risk_setupincidence_level;
use App\Risk_internalcontrol_pk5;
use App\Risk_internalcontrol_pk5_sub;
?>

<h4 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-9" align="center">
          แก้ไขรายงานการประเมินผลการควบคุมภายใน &nbsp;&nbsp; ({{ $icontrols-> HR_DEPARTMENT_SUB_NAME}})
            </div>
          <div class="col-md-3" align="right">
         <small> แบบ ปค.5 หน่วยงานย่อย </small>
       
          </div>
          </div>
          </h4>  
<br>
<table  width="100%">
    <thead >        
        <tr style="background-color: #FFEBCD;" height="40">  
            <th class="text-font" style="text-align: center;">ภารกิจหลัก || วัตถุประสงค์</th>
            <th class="text-font" style="text-align: center;">ความเสี่ยง</th> 
            <th class="text-font" style="text-align: center;">การควบคุมภายในที่มีอยู่</th> 
            <th class="text-font" style="text-align: center;">การประเมินผลการควบคุมภายใน</th> 
            <th class="text-font" style="text-align: center;">ความเสี่ยงที่ยังมีอยู่</th>
          
        </tr>
    </thead>
    <tbody>   
    <?php $number = 0; ?>
                       
        <?php $number++; ?>    
        <tr height="40">    
        <td rowspan="50" style="text-align: left;font-size: 14px;font-weight:normal;">                               
                                {{$icontrols->INTERNALCONTROL_MISSION}}<br>
                                <?php $count = 1; ?>
                                @foreach ($icontrol_subs as $item)
                                {{$count}}&nbsp;&nbsp;{{$item->INTERNALCONTROL_OBJECTIVE}}<br>
                                <?php $count++; ?>
                                    @endforeach                                   
                                </td>
                                </tr>

        @foreach ($icontrol_detailsubsubs as $icontrol_detailsubsub)
        <tr> 
                <input type="hidden" name="PK5_DEPART_SUB_ID[]" id="PK5_DEPART_SUB_ID[]" value="{{$id}}">
                <td  style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp;{{$icontrol_detailsubsub->PK5_DEPART_SUB_RISK }} </td>
                <td  style="text-align: left;font-size: 14px;font-weight:normal;"> &nbsp;&nbsp; {{$icontrol_detailsubsub->PK5_DEPART_SUB_CONTROL }}</td >
                <td style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; {{$icontrol_detailsubsub->PK5_DEPART_SUB_EVACONTROL }} </td>                                       
                <td style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;&nbsp; {{$icontrol_detailsubsub->PK5_DEPART_SUB_HAVERISK }} </td>
        </tr>
    @endforeach   
           
    </tbody>
</table>
