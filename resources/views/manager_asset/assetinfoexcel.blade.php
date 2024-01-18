<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_ASSET.xls"');//ชื่อไฟล์

  
?>

           
                    <!-- Advanced Tables -->
<br>
<br>
<br>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนครุภัณฑ์</B></h3>
                            <div align="right">

  
        </div>
                        </div>
                        <div class="block-content block-content-full">
                     
                  
             <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr style="background-color: #FCFCE5;" height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ลำดับ</th>                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ปีงบ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">เลขครุภัณฑ์</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="5%">วันที่รับเข้า</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="18%">ประเภทครุภัณฑ์</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ชื่อ</th>

                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ลักษณะ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ประจำอยู่หน่วยงาน</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> หน่วย</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ยี่ห้อ</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> สี</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> รุ่น</th> 

                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> เลขเครื่อง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> วิธีได้มา</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> งบที่ใช้</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ประเภทค่าเสื่อม</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> การจัดซื้อ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ผู้จำหน่าย</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ขนาด</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> ราคา</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%">ความเสี่ยง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%">การเบิกใช้</th>                                      
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%">สถานะ</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%">หน่วยงานขอยืม</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">สถานที่ตั้ง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่อยู่ชั้น</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ที่ตั้งห้อง</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">ผู้รับผิดชอบ</th>                                      
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">การบำรุงรักษา PM</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">การสอบเทียบ CAL</th>                                      
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="6%">อายุการใช้งาน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">วันหมดสภาพ</th>  
                                    
                                </tr>
                                </thead>
                                <tbody >
   
  
                                <?php $number = 0; ?>
                                @foreach ($infoassets as $infoasset)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font" align="center">{{ $infoasset->YEAR_ID }}</td>
                                        <td class="text-font" align="center">{{ $infoasset->ARTICLE_NUM }}</td>
                                        <td class="text-font" align="center">{{ DateThai($infoasset->RECEIVE_DATE) }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->DECLINE_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->ARTICLE_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->ARTICLE_PROP }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                        <td class="text-font text-pedding" align="center">{{ $infoasset->SUP_UNIT_NAME }}</td>
                                        <td class="text-font text-pedding" align="center">{{ $infoasset->BRAND_NAME }}</td>
                                        <td class="text-font text-pedding" align="center">{{ $infoasset->COLOR_NAME }}</td>
                                        <td class="text-font text-pedding" align="center">{{ $infoasset->MODEL_NAME }}</td>

                                        <td class="text-font text-pedding" align="left">{{ $infoasset->SERIAL_NO }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->METHOD_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->BUDGET_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->SUP_TYPE_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->BUY_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->VENDOR_NAME }}</td>

                                        <td class="text-font text-pedding" align="center">{{ $infoasset->SIZE_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->PRICE_PER_UNIT }}</td>
                                       

                                        @if( $infoasset->RISK_TYPE_ID == '0')
                                        <td align="center" ><span class="badge badge-info" >ต่ำ</span></td>
                                         @elseif($infoasset->RISK_TYPE_ID== '1')
                                        <td align="center" ><span class="badge badge-success" >กลาง</span></td>
                                        @elseif($infoasset->RISK_TYPE_ID == '2')
                                        <td align="center" ><span class="badge badge-danger" >สูง</span></td>
                                        @else
                                        <td align="center" ></td>
                                        @endif


                                        @if( $infoasset->OPENS == 'True')
                                        <td class="text-font" align="center" ><span class="btn btn-success fa-xs fa fa-check"></span>เบิก</td>
                                        @else
                                        <td class="text-font" align="center" >ไม่เบิก</td>
                            
                                        @endif

                                       

                                         @if($infoasset->STATUS_ID == 4)
                                        <td class="text-font" align="center">ถูกยืม</td>
                                        @elseif($infoasset->STATUS_ID == 3)
                                        <td class="text-font" align="center">รอจำหน่าย</td>
                                        @elseif($infoasset->STATUS_ID == 2)
                                        <td class="text-font" align="center">จำหน่ายแล้ว</td>
                                        @else
                                        <td class="text-font" align="center">ปกติ</td>
                                        @endif


                                        <td class="text-font text-pedding" align="left">{{ $infoasset->DEP_SUB_SUB_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->LOCATION_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->LOCATION_LEVEL_NAME }}</td>
                                        <td class="text-font text-pedding" align="center">{{ $infoasset->LEVEL_ROOM_NAME }}</td>
                                        <td class="text-font" align="center" align="center">{{ $infoasset->HR_FNAME }}&nbsp;&nbsp; {{ $infoasset->HR_LNAME}}</td>                                        
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->PM_TYPE_NAME }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->CAL_TYPE_NAME }}</td>
                                        <td class="text-font" align="center" align="center">{{ getAge($infoasset->RECEIVE_DATE) }}</td>
                                         <td class="text-font " align="center" align="center">{{ DateThai($infoasset->EXPIRE_DATE)  }}</td>
                                     
                                     
                                    </tr>

                                

                                    @endforeach   
                      </tbody>
                    </table>
              </div>
              <br>
              <div style="font-family: 'Kanit', sans-serif; font-size: 15px;font-size: 1.0rem;font-weight:normal;">จำนวน {{$countarticle}} รายการ</div>
          </div>
      </div>           
  </div>



