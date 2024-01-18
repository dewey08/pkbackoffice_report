<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal;  
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }  
        body {
            font-family: "THSarabunNew";
            font-size: 20px;
            line-height: 0.8;   
        }    
    </style>    
<?php

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

    <B style="font-size: 25px;">ใบแจ้งซ่อมอุปกรณ์เครื่องมือแพทย์ </B>
    
    <br><br><br><br>

<table style="line-height: 1;"> <!-- only added this -->
    <tr>
        <td style="font-size: 22px;width:300px"><b></b></td>
        <td style="width:100px"></td>
        <td style="font-size: 22px;width:200px"><b>ใบแจ้งซ่อมเลขที่</b> {{ $inforepairmedical->REPAIR_ID}} </td>
      </tr> 
      <tr>
        <td style="font-size: 22px;width: 300px"><b> </b></td>
        <td style="font-size: 22px;width: 250px"><b> </b> </td>
        <td style="font-size: 22px;width: 100px"><b>วันเวลาที่แจ้ง</b> {{ $inforepairmedical->DATE_SAVE}} </td>
      </tr> 
      <tr>
        <td style="font-size: 22px;width:300px" colspan="3"><b>เรียน หัวหน้าศูนย์เครื่องมือแพทย์ </b></td>
       
      </tr> 
</table>

<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้วยหน่วยงาน {{ $inforepairmedical->HR_DEPARTMENT_SUB_SUB_NAME}} <br><br>
        มีความประสงค์ส่งซ่อมอุปกรณ์ {{ $inforepairmedical->REPAIR_NAME}} <br><br>
        ครุภัณฑ์เลขที่ {{ $inforepairmedical->ARTICLE_NUM}} <br><br>
        ชื่อครุภัณฑ์ {{ $inforepairmedical->ARTICLE_NAME}} <br><br>
        <b> สาเหตุ / หรืออาการ </b> {{ $inforepairmedical->SYMPTOM}} 

<br><br><br>

<table style="line-height: 2;">
    <tr>
        <td style="font-size: 22px;width:300px"><b></b></td>
        <td style="font-size: 20px;width:250px">ลงชื่อ</td>
        <td style="font-size: 20px;width:50px">ผู้ส่งซ่อม</td>
      </tr> 
      <tr>
        <td style="font-size: 22px;width:300px"><b></b></td>
        <td style="font-size: 20px;width:250px">ลงชื่อ</td>
        <td style="font-size: 20px;width:50px">ผู้รับซ่อม</td>
      </tr>      
</table>

<hr>
<br>

<b>หมายเหตุ</b><br><br>
[&nbsp;&nbsp;&nbsp;&nbsp;] ส่งซ่อมปกติ<br><br>
[&nbsp;&nbsp;&nbsp;&nbsp;] ส่งซ่อมย้อนหลัง ช่างดำเนินการซ่อมให้ก่อน<br><br><hr>

<b>บันทึกงานซ่อมเครื่องมือแพทย์</b><br><br>
[&nbsp;&nbsp;&nbsp;&nbsp;] ซ่อมได้  &nbsp;&nbsp;&nbsp;&nbsp; [&nbsp;&nbsp;&nbsp;&nbsp;] ส่งซ่อมภายนอก   &nbsp;&nbsp;&nbsp;&nbsp;  [&nbsp;&nbsp;&nbsp;&nbsp;] ชำรุดขอจำหน่าย <br><br>

ปัญหาที่พบในระหว่างการซ่อม.....................................................................<br><br>
กระบวนการ / แนวทางแก้ไข.....................................................................<br><br>

<hr>
<br>
<b>บันทึกฝ่ายบริหารทั่วไป</b><br><br>
[&nbsp;&nbsp;&nbsp;&nbsp;] อนุมัติ    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ลงชื่อ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ผู้ตรวจเช็ค<br><br>
[&nbsp;&nbsp;&nbsp;&nbsp;] ไม่อนุมัติ 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
วันที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
เวลา
<br><br><br><br>

<table style="line-height: 2;">
    <tr>
        <td style="font-size: 22px;width:350px"><b></b></td>
        <td style="font-size: 24px;width:100px">ลงชื่อ</td>
     
      </tr> 
      <tr>
        <td style="font-size: 22px;width:270px"><b></b></td>
        <td style="font-size: 20px;width:50px"></td>
        <td style="font-size: 24px;width:350px">หัวหน้าพัสดุ</td>
      </tr>      
</table>

</body>
</html>