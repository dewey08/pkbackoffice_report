<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_SALARYSLIP.xls"');//ชื่อไฟล์


?>
<?php
function MONTHThai($strMonth)
{
  

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai";
  }
  
use App\Http\Controllers\ManagercompensationController;
use App\Salaryallpay;
use App\Salaryallreceive;
?>
        
    
         รายงานข้อมูลเงินเดือนบุคคลแบบระเอียด
    
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

                        <tr>
                        <td> </td>
                            <td> <B>รายรับ </B></td>
                            <td></td>
                        </tr>

                        <?php
                         $receivepersons = Salaryallreceive::leftJoin('salary_all','salary_all.SALARYALL_ID','=','salary_all_receive.SALARYALL_ID')
                         ->where('SALARYALL_PERSON_ID','=',$infoperson->SALARYALL_PERSON_ID)
                         ->where('SALARYALL_RECEIVE_YEAR','=',$year)
                          ->where('SALARYALL_RECEIVE_MONTH','=',$month)
                          ->get(); ?>
            
                        @foreach ($receivepersons as $receiveperson)
                        <tr>
                        <td class="text-font" align="center"></td>
                       
                        <td class="text-font text-pedding" >{{$receiveperson->SALARYALL_RECEIVE_LISTNAME}} </td>
                        <td class="text-font text-pedding" >{{$receiveperson->SALARYALL_RECEIVE_AMOUNT}}</td>
                      
                        </tr>
                           
                        @endforeach  
                       
                        <tr>
                            <td> </td>
                            <td><B>รายจ่าย</B></td>
                            <td></td>
                        </tr>
                       
                        <?php
                        $paypersons = Salaryallpay::leftJoin('salary_all','salary_all.SALARYALL_ID','=','salary_all_pay.SALARYALL_ID')
                          ->where('SALARYALL_PERSON_ID','=',$infoperson->SALARYALL_PERSON_ID)
                        ->where('SALARYALL_PAY_YEAR','=',$year)
                        ->where('SALARYALL_PAY_MONTH','=',$month)
                        ->get(); ?>
            
                        @foreach ($paypersons as $payperson)
                        <tr>
                        <td class="text-font" align="center"></td>
                        <td class="text-font text-pedding" >{{$payperson->SALARYALL_PAY_LISTNAME}} </td>
                        <td class="text-font text-pedding" >{{$payperson->SALARYALL_PAY_AMOUNT}}</td>
                      
                        </tr>
                           
                        @endforeach  
                        <tr></tr>
                        <?php  $count++;?>
                        @endforeach 
                   </tbody>
                  </table>
</div>
    
  