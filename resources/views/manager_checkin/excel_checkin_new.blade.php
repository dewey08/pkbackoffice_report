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
?>


      

<table  width="100%">
    <thead >        
        <tr style="background-color: #FFEBCD;" height="40">  
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="5%" >ลำดับ</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%" >วันที่</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">เวลา</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">ชื่อ-นามสกุล</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">หน่วยงาน</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="8%">ประเภทการลง</th>
            <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="7%">ประเภทเวร</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="7%">ชื่อเวร</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  >หมายเหตุ</th>            
        </tr>
    </thead>
    <tbody>       
        <?php $number = 0 ;?>
        @foreach ($inforcheckins as $inforcheckin)
        <?php $number++;?>

            <tr height="20">
                <td class="text-font" align="center">{{  ($number++) }}</td>
                <td class="text-font" align="center">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->CHEACKIN_TIME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->HR_FNAME }}  &nbsp;&nbsp; {{$inforcheckin->HR_LNAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->CHECKIN_TYPE_NAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->OPERATE_TYPE_NAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->OPERATE_JOB_NAME }}</td>
                <td class="text-font" align="center" >{{  $inforcheckin->CHECKIN_REMARK }}</td>

            </tr>
            @endforeach
    </tbody>
</table>
