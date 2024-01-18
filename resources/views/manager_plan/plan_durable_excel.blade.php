<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="DURABLE_PLAN.xls"');//ชื่อไฟล์

?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนจัดซื้อครุภัณฑ์</B></h3>
              
            </div>
            <div class="block-content block-content-full">

            
            
             <div class="table-responsive"> 
             <div align="right">งบประมาณรวม {{number_format($sumbudget,2)}}  บาท</div>
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="10%">	สถานะ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ปีงบ</th>
                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ทีม/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ค่าครุภัณฑ์/ที่ดิน/สิ่งก่อสร้าง/จ้างเหมา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ประเภทงบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	เหตุผล	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ครุภัณฑ์เดิม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ราคาต่อหน่วย	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	จำนวน	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ราคา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	วันที่	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ผู้รับผิดชอบ	</th>



                           
                        </tr >
                    </thead>
                    <tbody>

                    <?php $number = 0; ?>
                                @foreach ($infodurables as $infodurable)
                    <?php $number++; ?>
                   
                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>

                                <td align="center" >
                                   @if($infodurable->DUR_STATUS == 'WAIT')
                                   <span class="badge badge-info"> รอพิจารณา </span>
                                   @elseif($infodurable->DUR_STATUS == 'APP')
                                         <span class="badge badge-success"> อนุมัติ </span>
                                   @elseif($infodurable->DUR_STATUS == 'NOTAPP')
                                        <span class="badge badge-warning"> ไม่อนุมัติ </span>
                                   @else
                                  
                                   @endif                  
                                  </td> 
                                <td class="text-font text-pedding" >{{$infodurable->BUDGET_YEAR}}</td>

                                @if( $infodurable->DUR_TYPE == 'team')
                                <td class="text-font text-pedding" >ทีมประสาน</td>
                                @else
                                <td class="text-font text-pedding" >หน่วยงาน</td>
                                @endif 

                               
                                <td class="text-font text-pedding" >{{$infodurable->DUR_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_TEAM_NAME}}</td>
            
                                <td class="text-font text-pedding" >{{$infodurable->DUR_ASS_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->BUDGET_NAME}}</td>
                                <td class="text-font text-pedding" >
                                  @if($infodurable->DUR_REASON_ID == '1')
                                      ทดแทนของเก่า
                                  @else
                                      จัดซื้อของใหม่ 
                                  @endif

                                </td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_ASS_OLD}}</td>
                                <td class="text-font text-pedding" >{{number_format($infodurable->DUR_ASS_PICE_UNIT,2)}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_ASS_AMOUNT}}</td>
                                <td class="text-font text-pedding" >{{number_format($infodurable->DUR_PICE_SUM,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infodurable->BUDGET_PICE_REAL,2)}}</td>
                                <td class="text-font text-pedding" align="center">{{DateThai($infodurable->DUR_ASS_BEGIN_DATE)}}<br>{{DateThai($infodurable->DUR_ASS_END_DATE)}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_TEAM_HR_NAME}}</td>
                               

                               
                           
                        
                        </tr>

                     
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>
       