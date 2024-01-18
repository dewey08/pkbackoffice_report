<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์

  function Datetime($time_a,$time_b)
{
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
   
    return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ";
  
    }

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
            <th class="text-font" style="text-align: center;">วันที่</th>
            <th class="text-font" style="text-align: center;">เวลา</th> 
            <th class="text-font" style="text-align: center;">ประเภทการลง</th> 
            <th class="text-font" style="text-align: center;">ประเภทเวร</th> 
            <th class="text-font" style="text-align: center;">ชื่อเวร</th> 
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สาย</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ออกก่อน</th>
            
        </tr>
    </thead>
    <tbody>       
        <?php $number = 0 ;?>
        @foreach ($inforcheckins as $inforcheckin)
        <?php $number++;?>


            <tr height="20">
            
                <td class="text-font" align="center">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->CHEACKIN_TIME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->CHECKIN_TYPE_NAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->OPERATE_TYPE_NAME }}</td>
                <td class="text-font" align="center">{{  $inforcheckin->OPERATE_JOB_NAME }}</td>
               

                @if(strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->CHEACKIN_TIME) > strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->OPERATE_JOB_TIMEBIGEN))
                @if($inforcheckin->CHECKIN_TYPE_ID == "1")
                <td class="text-font text-pedding" > {{Datetime($inforcheckin->CHEACKIN_TIME,$inforcheckin->OPERATE_JOB_TIMEBIGEN)}} </td>
                @else                                                        
                <td class="text-font text-pedding" > - </td>                                                        
                @endif
    @else
                <td class="text-font text-pedding" > - </td>
    @endif


    @if(strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->CHEACKIN_TIME) < strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->OPERATE_JOB_TIMEEND))
            @if($inforcheckin->CHECKIN_TYPE_ID == "2")
            <td class="text-font text-pedding" > {{Datetime($inforcheckin->CHEACKIN_TIME,$inforcheckin->OPERATE_JOB_TIMEEND)}} </td>                                    
            @else
            <td class="text-font text-pedding" > - </td>
            @endif

    @else
    <td class="text-font text-pedding" > - </td>
    @endif


            </tr>
            @endforeach
    </tbody>
</table>
