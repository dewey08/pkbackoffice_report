<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_guesthouserequestexcel.xls"');//ชื่อไฟล์
?>
<center>    

            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนคำร้องขอบ้านพัก</B></h3>  
            </div>
          
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple text-center" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th class="text-font" width="4%">ลำดับ</th>
                            <th class="text-font" width="6%">สถานะ</th>
                            <th class="text-font" width="8%">ประเภทคำร้อง</th>
                            <th class="text-font" width="7%">วันที่ร้องขอ</th> 
                            <th class="text-font" width="14%">ผู้ร้องขอ</th>
                            <th class="text-font" width="7%">เบอร์โทร</th>
                            <th class="text-font" >ชื่ออาคาร</th>
                            <th class="text-font" width="5%">ชั้น</th>
                            <th class="text-font" width="5%">ชื่อห้อง</th>
                            <th class="text-font" width="14%">เจ้าหน้าที่</th>
                          
                        </tr >
                    </thead>
                    <tbody>  
                    <?php $number = 0; ?>
                        @foreach ($infopetitions as $infopetition)

                        <?php $number++;?>
            
                                    <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">{{$number}}</td>                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" >
                                        
                                        
                    
                                         @if($infopetition->PETITION_STATUS == 'SUCCESS')
                                        <span class="badge badge-success" >อนุมัติ</span>&nbsp;&nbsp;
                                        @elseif($infopetition->PETITION_STATUS == 'MOVEOUT')
                                        <span class="badge badge-info" >ย้ายออก</span>&nbsp;&nbsp;
                                        @else

                                        <span class="badge badge-warning" >ร้องขอ</span>
                                        &nbsp;&nbsp;
                                        @endif

                                        </td>
                                            @if($infopetition->PETITION_TYPE == '1')
                                           <?php $nametype = 'ขอเข้าพัก' ?>
                                            @elseif($infopetition->PETITION_TYPE == '2')
                                            <?php $nametype = 'ขอเปลี่ยนแปลง' ?>
                                            @elseif($infopetition->PETITION_TYPE == '3')
                                            <?php $nametype = 'ขอย้ายออก' ?>
                                            @else
                                            <?php $nametype = '' ?>
                                            @endif
                                      
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;border: 1px solid black;" >{{$nametype}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;border: 1px solid black;">{{DateThai($infopetition->created_at)}}</td>
                                        <td class="text-font text-pedding" style="text-align: left;font-size: 13px;border: 1px solid black;" >{{$infopetition->HR_FNAME}} {{$infopetition->HR_LNAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: left;font-size: 13px;border: 1px solid black;" >{{$infopetition->PETITION_HR_TEL}}</td>
                                        <td class="text-font text-pedding" style="text-align: left;font-size: 13px;border: 1px solid black;" >{{$infopetition->LOCATION_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;border: 1px solid black;" >{{$infopetition->LOCATION_LEVEL_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;border: 1px solid black;" >{{$infopetition->LEVEL_ROOM_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: left;font-size: 13px;border: 1px solid black;" >{{$infopetition->INFMATION_HR_NAME}}</td>

                                    </tr>  



                        @endforeach  
                    </tbody>
                </table>
     
  