<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_OT.xls"');//ชื่อไฟล์

  function Monththai($strtime)
  {
    if($strtime == '1'){
        $month = 'มกราคม';
    }else if($strtime == '2'){
        $month = 'กุมภาพันธ์';
    }else if($strtime == '3'){
        $month = 'มีนาคม';
    }else if($strtime == '4'){
        $month = 'เมษายน';
    }else if($strtime == '5'){
        $month = 'พฤษภาคม';
    }else if($strtime == '6'){
        $month = 'มิถุนายน';
    }else if($strtime == '7'){
        $month = 'กรกฎาคม';
    }else if($strtime == '8'){
        $month = 'สิงหาคม';
    }else if($strtime == '9'){
        $month = 'กันยายน';
    }else if($strtime == '10'){
        $month = 'ตุลาคม';
    }else if($strtime == '11'){
        $month = 'พฤศจิกายน';
    }else if($strtime == '12'){
        $month = 'ธันวาคม';
    }else{
        $month = '';
    }

    return $month;
    }

    function Yearthai($strtime)
    {
      $year = $strtime+543;
      return $year;
    }

?>
 
     
     
         
       <center>   
         <br>  
         หลักฐานใบสำคัญการจ่ายเงินค่าตอบแทนผู้ปฏิบัติงานราชการสำหรับเจ้าหน้าที่ ที่ขึ้นปฏิบัติงาน <BR>
            นอกเวลาราชการ ในการให้บริการขงโรงพยาบาล <BR>
            ประจำเดือน  {{Monththai($infomationot->OT_MONTH)}} พ.ศ. 2564
              
            {{-- หน่วยงาน :{{$infomationot->OT_DEP_SUB_SUB }}

            ประเภท OT :  
                @if($infomationot->OT_TYPE == 1)งานประจำ
                @elseif($infomationot->OT_TYPE == 2)งานเสริมฉุกเฉิน
                @elseif($infomationot->OT_TYPE == 3)งาน REFER 
                @elseif($infomationot->OT_TYPE == 4)งานตรวจการ@endif   
 
         
            ผู้บันทึก :  {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
           --}}
        
        </center>
        <br>
   
            <table border="1" style="border-color: #000000;"  width="120%">
                <thead style="background-color: #FFEBCD;">
                    <tr>
                        <th class="text-center" width="1%">ลำดับ</th>
                        <th class="text-center" width="20%">ชื่อ-นามสกุล</th>
                        <th class="text-center" width="10%">เวร</th>
                        <th class="text-center"  width="5%">อัตรา</th>
                        <th class="text-center" width="1%">1</th>
                        <th class="text-center" width="1%">2</th>
                        <th class="text-center" width="1%">3</th>
                        <th class="text-center" width="1%">4</th>
                        <th class="text-center" width="1%">5</th>
                        <th class="text-center" width="1%">6</th>
                        <th class="text-center" width="1%">7</th>
                        <th class="text-center" width="1%">8</th>
                        <th class="text-center" width="1%">9</th>
                        <th class="text-center" width="1%">10</th>
                        <th class="text-center" width="1%">11</th>
                        <th class="text-center" width="1%">12</th>
                        <th class="text-center" width="1%">13</th>
                        <th class="text-center" width="1%">14</th>
                        <th class="text-center" width="1%">15</th>
                        <th class="text-center" width="1%">16</th>
                        <th class="text-center" width="1%">17</th>
                        <th class="text-center" width="1%">18</th>
                        <th class="text-center" width="1%">19</th>
                        <th class="text-center" width="1%">20</th>
                        <th class="text-center" width="1%">21</th>
                        <th class="text-center" width="1%">22</th>
                        <th class="text-center" width="1%">23</th>
                        <th class="text-center" width="1%">24</th>
                        <th class="text-center" width="1%">25</th>
                        <th class="text-center" width="1%">26</th>
                        <th class="text-center" width="1%">27</th>
                        <th class="text-center" width="1%">28</th>
                        <th class="text-center" width="1%">29</th>
                        <th class="text-center" width="1%">30</th>
                        <th class="text-center" width="5%">31</th>
                        <th class="text-center" >รวมวัน</th>
                        <th class="text-center" >จำนวนเงินรวมทั้งสิ้น</th>
                        <th class="text-center" >วันที่รับเงิน</th>
                        <th class="text-center" >ลงชื่อผู้รับ</th>



                    </tr>
                </thead>
                <tbody class="tbody1">
                    <?php $number = 0; ?>
                    @foreach ($infomationotsubs as $infomationotsub)
                    <?php $number++;  ?>
                    <tr>
                    <td class="text-font" align="center" >{{$number}}</td>
                    <td class="text-font" align="center" >   
                    <select name="OT_PERSON_ID[]" id="OT_PERSON_ID0" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือกบุคคล--</option>
                            @foreach ($PERSONALLs as $PERSONALL) 
                                    @if($infomationotsub->OT_PERSON_ID == $PERSONALL ->ID)
                                    <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>   
                            
                                    @else
                                    <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>   
                                    @endif
                                @endforeach 
                    </select>    
                    </td>
                    <td class="text-font" align="center" >
                        <select name="OT_JOB[]" id="่OT_JOB0" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                            <option value="">--เวร--</option>
                                @foreach ($operats as $operat) 
                                    @if($infomationotsub->OT_JOB == $operat ->OPERATE_JOB_ID )
                                    <option value="{{ $operat ->OPERATE_JOB_ID  }}" selected>{{$operat->OPERATE_JOB_NAME}}</option>   
                                    @else
                                    <option value="{{ $operat ->OPERATE_JOB_ID  }}">{{$operat->OPERATE_JOB_NAME}}</option>   
                                    @endif
                                    @endforeach 
                        </select>    

                    </td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_RATE }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_1DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_2DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_3DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_4DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_5DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_6DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_7DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_8DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_9DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_10DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_11DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_12DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_13DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_14DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_15DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_16DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_17DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_18DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_19DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_20DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_21DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_22DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_23DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_24DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_25DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_26DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_27DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_28DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_29DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_30DAY }}</td>
                    <td class="text-font" align="center" >{{$infomationotsub->OT_31DAY }}</td>
                    <td class="text-font" align="center" ></td>
                    <td class="text-font" align="center" >{{number_format($infomationotsub->OT_SUM) }}</td>
                    <td class="text-font" align="center" ></td>
                    <td class="text-font" align="center" ></td>

                    </tr>

                    @endforeach 
                   
                     </tbody>
                 </table><br>
ข้าพเจ้าได้ตรวจสอบแล้ว เห็นว่า เจ้าหน้าที่ดังกล่าวได้ปฏิบัติงานจริงตามคำสั่ง และมีสิทธิ์ได้รับเงินค่าตอบแทนตามระแบบขงทางราชการถูกต้องแล้ว<br/>
รวมทั้งสิ้น<br/><br/>
ลงชื่อ............................................................(ผู้ควบคุม)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ............................................................(ผู้จ่ายเงิน)<br>
&nbsp;&nbsp;&nbsp;&nbsp;(............................................................)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(............................................................)<br>


               