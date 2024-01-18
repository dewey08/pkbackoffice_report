<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="PROJECT_PLAN.xls"');//ชื่อไฟล์
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนงานโครงการ</B></h3>
              
            </div>
            <div class="block-content block-content-full">




             <div class="table-responsive"> 
             <div align="right">งบประมาณรวม {{number_format($sumbudget,2)}}  บาท</div>
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="10%">	สถานะ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;"  width="8%">ทีม/หน่วยงาน</th>
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;"  width="8%">	รหัสเป้าประสงค์	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">	รหัสตัวชี้วัด	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">	ประเภทโครงการ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="30%">	ชื่อแผนงาน/โครงการ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	ประเภทงบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	งบประมาณ	</th>
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	วันที่	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">	ผู้รับผิดชอบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">	สถานะโครงการ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	รายละเอียด	</th>



                           
                        </tr >
                    </thead>
                    <tbody>

                    <?php $number = 0; ?>
                                @foreach ($infoprojects as $infoproject)
                    <?php $number++; ?>
                   
                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>

                                <td align="center" >
                                   @if($infoproject->PRO_STATUS == 'WAIT')
                                   <span class="badge badge-info"> รอพิจารณา </span>
                                   @elseif($infoproject->PRO_STATUS == 'APP')
                                         <span class="badge badge-success"> อนุมัติ </span>
                                   @elseif($infoproject->PRO_STATUS == 'NOTAPP')
                                        <span class="badge badge-warning"> ไม่อนุมัติ </span>
                                   @else
                                  
                                   @endif                  
                                  </td> 

                                <td class="text-font text-pedding" >{{$infoproject->BUDGET_YEAR}}</td>

                                @if( $infoproject->PRO_TYPE == 'team')
                                <td class="text-font text-pedding" >ทีมประสาน</td>
                                @else
                                <td class="text-font text-pedding" >หน่วยงาน</td>
                                @endif                      
                                <td class="text-font text-pedding" >{{$infoproject->PRO_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->PRO_TEAM_NAME}}</td>
                             
                                <td class="text-font text-pedding" >{{$infoproject->TARGET_CODE}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->KPI_CODE}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->PLAN_TYPE_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->PRO_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->BUDGET_NAME}}</td>
                                <td class="text-font text-pedding" align="right">{{number_format($infoproject->BUDGET_PICE,2)}}</td>
                                <td class="text-font text-pedding" align="right">{{number_format($infoproject->BUDGET_PICE_REAL,2)}}</td>

                                <td class="text-font text-pedding" align="center">{{DateThai($infoproject->PRO_BEGIN_DATE)}}<br>{{DateThai($infoproject->PRO_END_DATE)}}</td>

                                <td class="text-font text-pedding" >{{$infoproject->PRO_TEAM_HR_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infoproject->PLAN_TRACKING_NAME}}</td>
                                 @if($infoproject -> PRO_COMMENT !== '' && $infoproject -> PRO_COMMENT !== null)
                                 <td class="text-font text-pedding" align="center"><a  href="{{ $infoproject -> PRO_COMMENT }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank"><span class="btn fa fa-1.5x fa-paperclip" style="background-color:#6495ED;color:#FFFFFF;"></span></a> </td>    
                                 @else
                                 <td class="text-font text-pedding" align="center"> </td>      
                                 @endif
                       
                              
                        
                        </tr>

                     
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>
      