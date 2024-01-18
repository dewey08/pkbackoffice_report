<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    
    <style>
        @font-face {
                    font-family: 'THSarabunNew';
            src: url('fonts/thsarabunnew-webfont.eot');
            src: url('fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
                url('fonts/thsarabunnew-webfont.woff') format('woff'),
                url('fonts/thsarabunnew-webfont.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }        
        @font-face {
            font-family: 'THSarabunNew';
            src: url('fonts/thsarabunnew_bolditalic-webfont.eot');
            src: url('fonts/thsarabunnew_bolditalic-webfont.eot?#iefix') format('embedded-opentype'),
                url('fonts/thsarabunnew_bolditalic-webfont.woff') format('woff'),
                url('fonts/thsarabunnew_bolditalic-webfont.ttf') format('truetype');
            font-weight: bold;
            font-style: italic;
        }
        @font-face {
            font-family: 'THSarabunNew';
            src: url('fonts/thsarabunnew_italic-webfont.eot');
            src: url('fonts/thsarabunnew_italic-webfont.eot?#iefix') format('embedded-opentype'),
                url('fonts/thsarabunnew_italic-webfont.woff') format('woff'),
                url('fonts/thsarabunnew_italic-webfont.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
        }
        @font-face {
            font-family: 'THSarabunNew';
            src: url('fonts/thsarabunnew_bold-webfont.eot');
            src: url('fonts/thsarabunnew_bold-webfont.eot?#iefix') format('embedded-opentype'),
                url('fonts/thsarabunnew_bold-webfont.woff') format('woff'),
                url('fonts/thsarabunnew_bold-webfont.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        body {
            font-family: "THSarabunNew";
            font-size: 13px;
            line-height: 0.8;  
            padding: 10.00pt 7.1732pt 7.1732pt 40.00pt;             
        }
        .font-title{
            font-size: 18px;
        }
        .font-content{
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
    <?php 

    $dayNow = date("d");
    // $strDayThai= date("d",strtotime($dayNow));

    $monNow = date("M");
    $strMonth= date("n",strtotime($monNow));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];

    $yearNow = date("Y");
    $strYearThai = date("Y",strtotime($yearNow))+543;

    $dateThai = $dayNow.' '.$strMonthThai.' '.$strYearThai; 

    ?>

<body>  
<div class="container">
    <div class="col-md-12" >
        <span><center><h2><b>แบบสรุปวันลา</b></h2></center></span>
    </div>
    <div class="col-md-12">
        <span><center><font style="font-size:14px;">
            ของ {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }}
        </font></center></span>
    </div>
    <div class="col-md-12" style="margin-top:5px;">
        <span><center><font style="font-size:14px;">
            ตำแหน่ง {{ $hrd_person->POSITION_IN_WORK }}
        </font></center></span>
    </div>
    <div class="col-md-12" style="margin-top:5px;">
        <center>
            <span style="font-size: 14px;">ระหว่างวันที่</span>
            <span style="font-size: 14px; margin-left:10px;">.........</span>
            <span style="font-size: 14px; margin-left:10px;">ถึงวันที่</span>
            <span style="font-size: 14px; margin-left:10px;">........</span>
        </center>
    </div>
    <div class="row" style="margin-top:10px;">
        <table width="90%"class="font-content" style="margin-left: auto; margin-right:auto;">
            <tr>
                <td align="center">๑. ลากิจ</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ได้ลากิจมาแล้ว</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ครั้งสุดท้ายลากิจเมื่อวันที่</td>
                <td align="center" width="25%">...........</td>
                <td align="center"></td>
            </tr>
        </table>
    </div>
    <div class="row" style="margin-top:10px;">
        <table width="90%"class="font-content" style="margin-left: auto; margin-right:auto;">
            <tr>
                <td align="center">๒. ลาป่วย</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ได้ลาป่วยมาแล้ว</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ครั้งสุดท้ายลาป่วยเมื่อวันที่</td>
                <td align="center" width="25%">...........</td>
                <td align="center"></td>
            </tr>
        </table>
    </div>
    <div class="row" style="margin-top:10px;">
        <table width="90%"class="font-content" style="margin-left: auto; margin-right:auto;">
            <tr>
                <td align="center">๓. คลอดบุตร</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ได้ลาคลอดบุตรมาแล้ว</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ครั้งสุดท้ายลาคลอดบุตรเมื่อวันที่</td>
                <td align="center" width="25%">...........</td>
                <td align="center"></td>
            </tr>
        </table>
    </div>
    <div class="row" style="margin-top:10px;">
        <table width="90%"class="font-content" style="margin-left: auto; margin-right:auto;">
            <tr>
                <td align="center">๔ .ลาพักผ่อน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">มีวันลาพักผ่อนสะสมประจำปี</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ปีนี้มีวันลาพักผ่อนประจำปี</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">รวมวันลาพักผ่อนประจำปีทั้งสิ้น</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ปีนี้ได้ลามาแล้ว</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ยังคงเหลือวันลาอีก</td>
                <td align="center" width="25%">...........</td>
                <td align="center">วัน</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="40%">ครั้งสุดท้ายลาพักผ่อนประจำปีเมื่อวันที่</td>
                <td align="center" width="25%">...........</td>
                <td align="center"></td>
            </tr>
        </table>
    </div>
    <div class="row" style="margin-top:10px;">
        <table class="font-content" width="90%" style="margin-left:auto; margin-right:auto;">
            <tr align="center" style="margin-top:10px;">
                <td width="60%"></td>
                <td >ผู้ตรวจวันลา</td>
            </tr>
            <tr align="center" style="margin-top:10px;">
                <td></td>
                <td>(..........................)</td>
            </tr>
            <tr align="center" style="margin-top:10px;">
                <td></td>
                <td>ตำแหน่ง</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="font-content" align="right">
            ขอรับรองวันลาที่เจ้าหน้าที่ตรวจสอบถูกต้องแล้ว
        </div>
    </div>
</div>
</body>
</html>
