
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
<center><P style="font-size: 24px;">ส่วนราชการโรงพยาบาลสมเด็จพระยุพราชด่านซ้าย</P></center>
    <center><P style="font-size: 20px;">ทะเบียนจ่ายเช็ค</P></center>
        <center><P style="font-size: 20px;">ธนาคารกรุงไทย(เงินบำรุง) สาขา ด่านซ้าย เลขที่บัญชี 123456-789</P></center>

       

<table style="width: 700px; border: 1px solid black;">
    <tr>
        <th style="width: 25px; border: 1px solid black;"><center> ลำดับ</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>ว/ด/ป</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>เลขที่เช็ค</center></th>
        <th style="width: 100px; border: 1px solid black;" ><center>จ่ายเช็คให้</center></th>
        <th style="width: 100px; border: 1px solid black;" ><center>หมายเหตุ</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>จำนวนเงิน</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>ผู้อนุมัติ</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>ผู้จ่าย</center></th>
        <th style="width: 80px; border: 1px solid black;" ><center>ผู้รับเช็ค</center></th>
    </tr>
        
    <tr>
        <td style="width: 25px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>1</center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>ทดสอบ</center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>ทดสอบ</center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>ทดสอบ </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
    </tr>
    <tr>
        <td style="width: 25px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>1</center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;">ทดสอบ</td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;">ทดสอบ</td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"><center>ทดสอบ </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
        <td style="width: 80px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ทดสอบ </center></td>
    </tr>
   
   

</table><br><br>



</center><br><br>

</body>
</html>