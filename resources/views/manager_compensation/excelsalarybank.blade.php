<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_SALARYBANK.xls"');//ชื่อไฟล์


?>
<?php
function MONTHThai($strMonth)
{
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai";
  }

?>
        
    
         รายงานข้อมูลเงินเดือนบุคคล
    
        <br>  
        ปี&nbsp; {{$year}} &nbsp;&nbsp;เดือน&nbsp; {{MONTHThai($month)}}<br>        
      
        <table class="gwt-table table-striped" width="100%">
        <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่ายงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เลขบัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เงินเดือนสุทธิ</th>
     
                         
                        </tr >
                    </thead>
                    <tbody>
                   <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)

                   
                        <tr>
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->SALARYALL_PERSON_NAME}} </td>
                        <td class="text-font text-pedding" >{{$infoperson->POSITION_IN_WORK}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->SALARYALL_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->SALARYALL_BOOK_NUM}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format($infoperson->SALARYALL_TOTAL,2)}}</td>
                     
            
                        </tr>
                        
                        <?php  $count++;?>
                        @endforeach 
                   </tbody>
                  </table>
</div>
    
  