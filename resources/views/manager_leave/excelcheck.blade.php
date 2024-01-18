<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSONLEAVECHECK.xls"');//ชื่อไฟล์


use App\Http\Controllers\ManagerleaveController;
?>

<style>
            .center {
              margin: auto;
              width: 100%;
              padding: 10px;
            }
            body {
                  font-family: 'Kanit', sans-serif;
                  font-size: 14px;
                
                  }
            
                  label{
                        font-family: 'Kanit', sans-serif;
                        font-size: 14px;
                    
                  } 
            
                  @media only screen and (min-width: 1200px) {
            label {
                float:right;
              }
            
                  }
            
                  
                  .text-pedding{
               padding-left:10px;
                                }
            
                    .text-font {
                font-size: 13px;
                              }   
              
                  
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>

<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
    </script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>
<?php
 
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');    
?>      
                
<br>
<br>
    <center>    
        <div class="block" style="width: 95%;">          
                <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ลา</B></h3>
                            
                        </div>
              
             <div class="table-responsive"> 
                           
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%" >สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="7%">ปีงบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%"> ชื่อผู้แจ้งลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">ประเภทการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="25%" >เหตุผลการลา</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ตำแหน่ง</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">หน่วยงาน</th>      
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันเริ่มลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="10%">ลาถึงวันที่</th> 
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
                                    <tr height="20">
                                        <td class="text-font" align="center">{{ $number }}</td>
                                        <td class="d-none d-sm-table-cell" align="center">
                                            <span class="{{$statuscol}}" >{{ $inforleave -> STATUS_NAME }}</span>
                                        </td>

                                        <td class="text-font" align="center" class="d-none d-sm-table-cell" >
                                        {{ $inforleave -> LEAVE_YEAR_ID }}
                                        </td>
                                        <td class="text-font text-pedding" >
                                        {{ $inforleave -> LEAVE_PERSON_FULLNAME }}
                                        </td>

                                        <td class="text-font text-pedding" >
                                        {{ $inforleave -> LEAVE_TYPE_NAME }}
                                        </td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_BECAUSE }}</td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{$inforleave -> POSITION_IN_WORK}}</td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{$inforleave -> HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                        <td class="text-font"  align="center">{{ DateThai($inforleave->LEAVE_DATE_BEGIN)}}</td>
                                        <td class="text-font"  align="center">{{ DateThai($inforleave->LEAVE_DATE_END)}}</td>                           
                                        @if($inforleave->WORK_DO == 0.5)
                                        <td class="text-font"  align="center">ครึ่งวัน</td>
                                        @else
                                        <td class="text-font"  align="center">{{ number_format($inforleave->WORK_DO,1) }}</td>
                                        @endif

                                 
                                    </tr>
                                     
                   @endforeach 
                                    </tbody>
                  </table>



