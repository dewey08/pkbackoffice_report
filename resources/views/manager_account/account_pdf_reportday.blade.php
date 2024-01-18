
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
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

        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal; 
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
             font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        } 
        body {
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 1;                 
        }        
</style>
    
<?php

    function RemovethainumDigit($num){
        return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
    }
    function DateThaifrom($strDate)
        {
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));

            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
            $strMonthThai=$strMonthCut[$strMonth];
            return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
        }
?>
</head>
<body>
<center><P style="font-size: 24px;">รายงานรายการรายวัน</P></center>
    <center><P style="font-size: 20px;">โรงพยาบาลสมเด็จพระยุพราชด่านซ้าย</P></center>

        <p>ระหว่างวันที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ถึงวันที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     
        </p>
       

<table style="width: 700px; border: 1px solid black;">
    <tr>
        <th style="width: 100px; border: 1px solid black;"><center> วันที่เอกสาร</center><center>รหัสบัญชี</center> </th>
        <th style="width: 80px; border: 1px solid black;" ><center>เลขที่เอกสาร</center><center>รหัสแผนก</center> </th>
        <th style="width: 90px; border: 1px solid black;" ><center>สมุดรายวัน</center><center>รหัสฝ่าย สาขา</center> </th>
        <th style="width: 80px; border: 1px solid black;" ><center>เลขที่ใบเสร็จ</center><center>รหัสย่อย</center> </th>
        <th style="width: 150px; border: 1px solid black;" ><center>คำอธิบาย</center><center>รายละเอียด</center> </th>
        <th style="width: 50px; border: 1px solid black;" ><center>เดบิต</center></th>
        <th style="width: 50px; border: 1px solid black;" ><center>เครดิต</center></th>
    </tr>
        
    <tr>
        <td style="width: 100px;word-break:break-all; word-wrap:break-word;text-align: center" class="text-font text-pedding"><center>15 มิย 2563</center></td>
        <td style="width: 80px;word-break:break-all; word-wrap:break-word;text-align: center" class="text-font text-pedding">ทดสอบ</td>
        <td style="width: 90px;word-break:break-all; word-wrap:break-word;text-align: center" class="text-font text-pedding">เงินสด</td>
        <td style="width: 80px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding"><center>ทดสอบ </center></td>
        <td style="width: 150px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding">ทดสอบ </td>
        <td style="width: 50px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding" ><center>ทดสอบ </center></td>
        <td style="width: 50px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding"><center>ทดสอบ </center></td>
    </tr>
    <tr>
        <td style="width: 100px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding"><center>15 มิย 2563</center></td>
        <td style="width: 80px;word-break:break-all; word-wrap:break-word;text-align: center" class="text-font text-pedding">ทดสอบ</td>
        <td style="width: 90px;word-break:break-all; word-wrap:break-word;text-align: center" class="text-font text-pedding">เงินสด</td>
        <td style="width: 80px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding"><center>ทดสอบ </center></td>
        <td style="width: 150px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding">ทดสอบ </td>
        <td style="width: 50px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding" ><center>ทดสอบ </center></td>
        <td style="width: 50px;word-break:break-all; word-wrap:break-word;text-align: " class="text-font text-pedding"><center>ทดสอบ </center></td>
    </tr>
  
  
   

</table><br>

</center><br>
<center><br>
    ลงชื่อ......................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
    ลงชื่อ......................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ลงชื่อ......................................................<br>                                                          
    ผู้จัดทำ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ผู้อนุมัติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ผู้ลงบัญชี
    <br>
    
    
    
    </center><br><br>

</body>
</html>