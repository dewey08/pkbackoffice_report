   
 <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <style>

    body {
       
                font-size: 18px;
                line-height: 1;
                padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
        
            }

  
.text-pedding{
padding-left:10px;
padding-right:10px;
                    }

     

    
</style>
<?php

function RemovethainumDigit($num){
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
}

function Removeconvert($number){ 
    $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
    $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
    $number = str_replace(",","",$number); 
    $number = str_replace(" ","",$number); 
    $number = str_replace("บาท","",$number); 
    $number = explode(".",$number); 
    if(sizeof($number)>2){ 
    return ''; 
    exit; 
    } 
    $strlen = strlen($number[0]); 
    $convert = ''; 
    for($i=0;$i<$strlen;$i++){ 
        $n = substr($number[0], $i,1); 
        if($n!=0){ 
            if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
            elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
            elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
            else{ $convert .= $txtnum1[$n]; } 
            $convert .= $txtnum2[$strlen-$i-1]; 
        } 
    } 
    
    $convert .= 'บาท'; 
    if($number[1]=='0' OR $number[1]=='00' OR 
    $number[1]==''){ 
    $convert .= 'ถ้วน'; 
    }else{ 
    $strlen = strlen($number[1]); 
    for($i=0;$i<$strlen;$i++){ 
    $n = substr($number[1], $i,1); 
        if($n!=0){ 
        if($i==($strlen-1) AND $n==1){$convert 
        .= 'เอ็ด';} 
        elseif($i==($strlen-2) AND 
        $n==2){$convert .= 'ยี่';} 
        elseif($i==($strlen-2) AND 
        $n==1){$convert .= '';} 
        else{ $convert .= $txtnum1[$n];} 
        $convert .= $txtnum2[$strlen-$i-1]; 
        } 
    } 
    $convert .= 'สตางค์'; 
    } 
    return $convert; 
    } 


    function DateThaifrom($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
  }


    ?>
</head>
<body>
<div style="text-align: right;">{{$inforsuprequest->REQUEST_ID}}</div><br>
<center><B style="font-size: 22px;">ใบแสดงความต้องการพัสดุ</B></center><br>


<table style="line-height: 0.8;"> <!-- only added this -->
    <tr>
        <td style="width:300px">เรียน ผู้อำนวยการ{{$infoorg->ORG_NAME}}</td>
        <td style="width:150px"></td>
        <td style="width:200px"></td>
      </tr> 
      <tr>
        <td style="width: 300px">จากหน่วยงาน {{$inforsuprequest->SAVE_HR_DEP_SUB_NAME}} </td>
        <td style="width: 150px">โทรศัพท์ภายใน  </td>
        <td style="width: 200px">ลงวันที่ {{DateThaifrom($inforsuprequest->DATE_TIME_SAVE)}}</td>
      </tr> 
      <tr>
        <td style="width:300px" colspan="3">เพื่อจัดซื้อ/ซ่อมแซม  {{$inforsuprequest->REQUEST_BUY_COMMENT}}</td>
       
      </tr> 
</table>

<table  style="border: 1px solid black;border-collapse: collapse;"> <!-- only added this -->
    <tr style="border: 1px solid black;border-collapse: collapse;">
        <th style="border: 1px solid black;border-collapse: collapse;width: 25px"><center>ลำดับ</center></th>
        <th style="border: 1px solid black;border-collapse: collapse;width: 200px"><center>รายการและรายละเอียด</center></th>
        <th style="border: 1px solid black;border-collapse: collapse;width: 25px" ><center>จำนวน</center></th>
        <th style="border: 1px solid black;border-collapse: collapse;width: 100px"><center>หน่วย</center></th>
        <th style="border: 1px solid black;border-collapse: collapse;width: 100px"><center>ราคาประมาณ</center></th>
        <th style="border: 1px solid black;border-collapse: collapse;width: 150px"><center>เหตุผลความจำเป็น</center></th>
    </tr>


    <?php $number = 0; ?>
    @foreach ($inforsuprequestsubs as $inforsuprequestsub)  

    <?php $number++;?>
 
    <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width: 25px word-break:break-all; word-wrap:break-word;"  class="text-font text-pedding"><center>{{thainumDigit($number)}}</center></td>
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width: 200px word-break:break-all; word-wrap:break-word;"  class="text-font text-pedding">{{thainumDigit($inforsuprequestsub->SUPPLIES_REQUEST_SUB_DETAIL)}}</td>
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width: 25px word-break:break-all; word-wrap:break-word;text-align: center"  class="text-font text-pedding">{{thainumDigit($inforsuprequestsub->SUPPLIES_REQUEST_SUB_AMOUNT)}} </td>
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width:50px; word-break:break-all; word-wrap:break-word;text-align: center"  class="text-font text-pedding">{{$inforsuprequestsub->SUPPLIES_REQUEST_SUB_UNIT}}
        </td>
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width: 25px; word-break:break-all; word-wrap:break-word;text-align: right"  class="text-font text-pedding">
        {{thainumDigit(number_format($inforsuprequestsub->SUPPLIES_REQUEST_SUB_PRICE*$inforsuprequestsub->SUPPLIES_REQUEST_SUB_AMOUNT,2))}}
        </td>
        <td style="border: 1px solid black;padding-left:10px;padding-right:10px;border-collapse: collapse;width: 150px; word-break:break-all; word-wrap:break-word;"  class="text-font text-pedding">
          
        {{$inforsuprequestsub->SUPPLIES_REQUEST_SUB_REMARK}}
           
        </td>
    </tr>
    @endforeach   


</table><br>
<table class="table">
<tr>
<td style="width: 200px;text-align: left;">
<b>ความเห็นหัวหน้ากลุ่มหัวหน้า/หัวหน้าหน่วยงาน</b><br>
- เพื่อโปรดทราบ<br>
- เห็นควรพิจารณาอนุมัติ<br><br><br>
ลงชื่อ{{$inforsuprequest->AGREE_HR_NAME}} <br>
ตำแหน่ง {{$inforsuprequest->AGREE_HR_POSITION}} <br>
วันที่ {{DateThaifrom($inforsuprequest->DATE_TIME_SAVE)}}<br><br><br>

<center>[&nbsp;&nbsp;&nbsp;&nbsp;] อนุมัติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [&nbsp;&nbsp;&nbsp;&nbsp;] ไม่อนุมัติ</center><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ...........................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}
</td>
<td style="width: 200px">
<br><br>

<center>
ลงชื่อ {{$inforsuprequest->SAVE_HR_NAME}} ผู้รายงาน<br>
ตำแหน่ง {{$inforsuprequest->SAVE_HR_POSITION}}</center>
<br><br><br>
<b>ผู้เห็นชอบ</b>
<table  class="table gwt-table">
<tr>
 <td style="width: 300px; text-align: left;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ตรวจสอบแล้ว</b><br><br>
 @if($inforsuprequest->REQUEST_PLAN_TYPE_ID == '1')
 
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;/&nbsp;] อยู่ในแผนการจัดซื้อ/จัดจ้าง<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] ไม่อยู่ในแผนการจัดซื้อ/จัดจ้าง<br><br>
 @elseif($inforsuprequest->REQUEST_PLAN_TYPE_ID == '2')

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] อยู่ในแผนการจัดซื้อ/จัดจ้าง<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;/&nbsp;] ไม่อยู่ในแผนการจัดซื้อ/จัดจ้าง<br><br>

 @else

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] อยู่ในแผนการจัดซื้อ/จัดจ้าง<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] ไม่อยู่ในแผนการจัดซื้อ/จัดจ้าง<br><br>

 @endif




&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforsuprequest->USER_CONFIRM_CHECK_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าหน้าที่พัสดุ
 </td>
</tr>
</table>
</td>
</tr>
</table>

<!--หมายเหตุ : ให้หน่วยงานพิมพ์ใบรายงานความต้องการและรายละเอียดต่างๆออกจากระบบคอมพิวเตอร์เท่านั้น<br>-->

{{-- </body>
</html> --}}