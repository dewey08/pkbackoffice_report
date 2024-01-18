<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์

function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }

  function RemovegetAge($birthday) {
    $then = strtotime($birthday);
    return(floor((time()-$then)/31556926));
}

?>

<table class="table table-hover" style="width: 100%">
    <thead>
        <tr>
            <th align="center" width="5%">ลำดับ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="10%">สถานะ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%" >ปีงบ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="15%" >ประเภทการลา</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เนื่องจาก</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันเริ่มลา</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ลาถึงวันที่</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="8%">จำนวนวันลา</th> 
        </tr>
    </thead>
    <tbody>
        <?php $number = 0; ?>
        @foreach ($inforleaves as $inforleave)
        <?php $number++; 
         $status =  $inforleave -> STATUS_CODE;

         if( $status === 'Pending'){
            $statuscol =  "badge badge-danger";

        }else if($status === 'Approve'){
           $statuscol =  "badge badge-warning";

        }else if($status === 'Verify'){
            $statuscol =  "badge badge-info";
        }else if($status === 'Allow'){
            $statuscol =  "badge badge-success";
        }else{
            $statuscol =  "badge badge-secondary";
        }
        
        ?> 
        <tr>
            <td class="text-font" align="center">{{ $number }}</td>
            <td class="text-font" align="center">
                <span class="{{$statuscol}}">{{ $inforleave -> STATUS_NAME }}</span>
            </td>
            <td class="text-font" align="center" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_YEAR_ID }}</td>
            <td class="text-font text-pedding">{{ $inforleave -> LEAVE_TYPE_NAME }}</td>
            <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_BECAUSE }}</td>  
            <td class="text-font" align="center" class="d-none d-sm-table-cell">{{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}</td>
            <td class="text-font" align="center" class="d-none d-sm-table-cell" >{{ DateThai($inforleave -> LEAVE_DATE_END) }}</td>
            
            @if($inforleave->WORK_DO == 0.5)
            <td class="text-font"  align="center">ครึ่งวัน</td>
            @else
            <td class="text-font"  align="center">{{ number_format($inforleave->WORK_DO) }}</td>
            @endif
        </tr>

        @endforeach

    </tbody>
</table>
