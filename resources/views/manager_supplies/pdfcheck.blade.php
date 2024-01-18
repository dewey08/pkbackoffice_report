

<html>
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
           font-family: 'THSarabunNew', sans-serif;
            font-size: 14px;
            line-height: 1;
       
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
<center><B style="font-size: 22px;">ใบตรวจรับการจัดซื้อ/จัดจ้าง</B></center>

@if($inforcon->CHECK_DATE !== '' && $inforcon->CHECK_DATE !== null && $inforcon->CHECK_DATE !=='0000-00-00')
<center><b>วันที่ {{DateThaifrom($inforcon->CHECK_DATE)}}</b></center>
@else
<center><b>วันที่........................................</b></center>
@endif
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามใบสั่งซื้อ/สั่งจ้างเลขที่ {{thainumDigit($inforcon->PO_NUM)}}  ลงวันที่ {{DateThaifrom($inforcon->DATE_REGIS)}}
{{$infoorg->ORG_NAME}} ได้ตกลงซื้อ/จ้าง กับ {{isset($inforconquotation->VENDOR_NAME) ? $inforconquotation->VENDOR_NAME : ''}}
สำหรับโครงการ {{$infotypebuy}}   โดยวิธี{{$inforcon->BUY_NAME}}   ใบส่งของเลขที่  {{thainumDigit($inforcon->INVOICE_NUM)}}
จำนวนเงินทั้งสิ้น {{thainumDigit(number_format(isset($inforcon->BUDGET_SUM) ? $inforcon->BUDGET_SUM : 0,2))}} บาท ({{(convert(number_format(isset($inforcon->BUDGET_SUM) ? $inforcon->BUDGET_SUM : 0,2)))}}) <br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ตรวจรับพัสดุ ได้ตรวจรับงานแล้ว ผลปรากฏดังนี้ <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑.ผลการตรวจรับ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;/&nbsp;] ถูกต้อง<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;/&nbsp;] ครบถ้วนตามสัญญา<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] ไม่ครบถ้วนตามสัญญา<br>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๒.ค่าปรับ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] มีค่าปรับ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;/&nbsp;] ไม่มีค่าปรับ<br>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๓.การเบิกจ่าย<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;] เบิกจ่ายเงินเป็นจำนวนทั้งสิ้น&nbsp;{{thainumDigit(number_format(isset($inforconquotation->QUOTATION_VENDOR_PICE) ? $inforconquotation->QUOTATION_VENDOR_PICE : 0,2))}}&nbsp;บาท <br>
<br>
<br>
<div style="text-align: right;">
ลงชื่อ.................................................ประธานกรรมการ/ผู้ตรวจรับ&nbsp;<br>
({{$conboardhread->BOARD_HR_NAME}})&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
<br>
@foreach ($conboards as $conboard)  
ลงชื่อ.................................................กรรมการ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
({{$conboard->BOARD_HR_NAME}})&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
<br>
@endforeach   


</div>
</body>
</html>