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
                    padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
            
                }

      
table, th, td {
     border: 1px solid #000;
}
table{
     border-collapse: collapse;  //กรอบด้านในหายไป
}
.text-pedding{
    padding-left:10px;
    padding-right:10px;
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

<center><B style="font-size: 18px;">รายละเอียดขอบเขตงานหรือรายละเอียดคุณลักษณะของพัสดุที่จะซื้อหรือจ้าง</B></center><BR>
สำหรับการจัดซื้อ/จัดจ้าง<br>
<br>

<table style="width: 600px"> <!-- only added this -->
    <tr>
        <th style="width: 25px" rowspan="2"><center>ลำดับ</center></th>
        <th style="width: 200px" rowspan="2"><center>รายละเอียดขอบเขตงานหรือรายละเอียด<br>คุณลักษณะของพัสดุที่จะซื้อหรือจ้าง</center></th>
        <th style="width: 200px" colspan="4"><center>ความต้องการซื้อจ้างครั้งนี้</center></th>
      
      
    </tr>
    <tr>
    <th style="width: 25px" ><center>จำนวน</center></th>
    <th style="width: 20px"><center>หน่วย</center></th>
        <th style="width: 90px"><center>ราคา/หน่วย</center></th>
        <th style="width: 90px"><center>ราคารวม</center></th>
        </tr>

        <?php $number = 0; ?>
                    @foreach ($infocons as $infocon)  

                    <?php $number++;?>

    <tr>
        <td style="width: 25px word-break:break-all; word-wrap:break-word;" class="text-font text-pedding"><center>{{thainumDigit($number)}}</center></td>
        <td style="width: 200px word-break:break-all; word-wrap:break-word;" class="text-font text-pedding">{{thainumDigit($infocon->SUP_NAME)}}</td>
        <td style="width: 50px word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->SUP_TOTAL))}} </td>
        <td style="width: 20px word-break:break-all; word-wrap:break-word;" class="text-font text-pedding">{{$infocon->SUP_UNIT_NAME}}</td>
        <td style="width:50px; word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->PRICE_PER_UNIT,2))}}
        </td>
        <td style="width: 25px; word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">
       {{thainumDigit(number_format($infocon->PRICE_SUM,2))}}
        </td>
 
      @endforeach 
    
</table>

<br>
        แหล่งที่มาของราคากลาง<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) ราคาที่ได้มาจากการคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) ราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิงของพัสดุที่กรมบัญชีกลางจัดทำ<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) ราคามาตรฐานที่สำนักงบประมาณหรือหน่วยงานกลางอื่นกำหนด<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) ราคาที่ได้มาจากการสืบราคาท้องตลาด จำนวน..................รายการ<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) ราคาที่เคยซื้อหรือจ้างครั้งหลังสุด ภายในระยะเวลาสองปีงบประมาณ<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามใบสั่งซื้อสั่งจ้าง/หนังสือข้อตกลงซื้อขาย/สัญญาซื้อขาย เลขที่....................................<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงวันที่.............................................


</body>
</html>