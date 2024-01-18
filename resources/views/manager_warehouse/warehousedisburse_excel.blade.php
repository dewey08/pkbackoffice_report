<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_DISBURSE.xls"');//ชื่อไฟล์
?>          

        <div class="block block-rounded block-bordered">

        <div class="block-header block-header-default"  style="text-align: left;">
             
               
             <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการขอเบิกวัสดุ</B></h3>
        
  
         
             <div class="table-responsive"> 
              
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่เบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ต้องการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เหตุผลขอเบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รพ.สต.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่เบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                    @foreach ($inforwarehouserequests as $inforwarehouserequest)

                    <?php $number++;

                    $status =  $inforwarehouserequest -> WAREHOUSE_STATUS;

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
                    <td class="text-font" align="center" style="border: 1px solid black;">{{$number}}</td>
                            <td class="text-font" style="border: 1px solid black;" align="center">
                                    <span class="{{$statuscol}}">{{ $inforwarehouserequest -> STATUS_NAME }}</span>
                            </td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_CODE }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_TIME_SAVE) }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_WANT) }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_BUY_COMMENT }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> INVEN_NAME }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_SMALLHOS_NAME }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_SAVE_HR_NAME }}</td>
                             
                        <td class="text-font text-pedding" style="border: 1px solid black;">
                            @if($inforwarehouserequest -> WAREHOUSE_TOP_LEADER_AC_DATE_TIME <> '' && $inforwarehouserequest -> WAREHOUSE_TOP_LEADER_AC_DATE_TIME <> null)  
                            {{ DateThai($inforwarehouserequest -> WAREHOUSE_TOP_LEADER_AC_DATE_TIME) }}
                            @endif
                        </td>
                        
                  
            
                        </tr>    
                         


                        @endforeach  

                    </tbody>
                </table>
         