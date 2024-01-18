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
                    line-height: 0.8;
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
<img src="image/Garuda.png" width="60" height="60">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<B style="font-size: 20px;">บันทึกข้อความ</B><BR>
<b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
<b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/'.substr($inforcon->REQUEST_ID,4))}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>วันที่</b> {{DateThaifrom($inforcon->DATE_REGIS)}}<br>
<b>เรื่อง</b> รายงานผลการพิจารณาและขออนุมัติสั่งซื้อสั่งจ้าง<br>
<B>เรียน</B> {{$inforcon->ORG_PROVINCE_LEADER}}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอรายงานผลการพิจารณา {{$infotypebuy}}  โดยวิธี{{$inforcon->BUY_NAME}} ดังนี้<br>


<table style="width: 600px"> <!-- only added this -->
    <tr>
        <th style="width: 25px" rowspan="2"><center>ลำดับ</center></th>
        <th style="width: 200px" rowspan="2"><center>รายการ</center></th>
        <th style="width: 100px" colspan="3"><center>ความต้องการซื้อจ้างครั้งนี้</center></th>
      
      
    </tr>
    <tr>
        <th style="width: 25px"  ><center>จำนวน</center></th>
        <th style="width: 100px"><center>ราคา/หน่วย</center></th>
        <th style="width: 100px"><center>ราคารวม</center></th>
    </tr>
    
    <?php $number = 0; ?>
                    @foreach ($infoconlists as $infocon)  

                    <?php $number++;?>

    <tr>
        <td style="width: 25px word-break:break-all; word-wrap:break-word;" class="text-font text-pedding"><center>{{thainumDigit($number)}}</center></td>
        <td style="width: 200px word-break:break-all; word-wrap:break-word;" class="text-font text-pedding">{{thainumDigit($infocon->SUP_NAME)}}</td>
        <td style="width: 25px word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->SUP_TOTAL))}} </td>
        <td style="width:50px; word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->PRICE_PER_UNIT,2))}}
        </td>
        <td style="width: 25px; word-break:break-all; word-wrap:break-word;text-align: right" class="text-font text-pedding">
       {{thainumDigit(number_format($infocon->PRICE_SUM,2))}}
        </td>
  </tr>
      @endforeach   
      <tr>
        <td style="border: 1px solid black;word-break:break-all; word-wrap:break-word;" colspan="2" rowspan="4"><center>({{convert($total)}})</center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" colspan="2" ><center>รวมเป็นเงิน </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right" class=" text-pedding">{{thainumDigit(number_format($totalsum_real,2))}}</td>
       
    </tr>
    
    <tr>
    <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;"colspan="2"  ><center>ภาษีมูลค่าเพิ่ม </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right" class=" text-pedding">{{thainumDigit($texreal)}}</td>
       
    </tr>
    <tr>
    <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" colspan="2" ><center>ส่วนลด </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right" class=" text-pedding">{{thainumDigit(number_format($discountnum,2))}}</td>
       
    </tr>
    <tr>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" colspan="2" ><center>รวมเป็นเงินทั้งสิ้น </center></td>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right" class=" text-pedding">{{thainumDigit($total)}}</td>
       
    </tr>

    

   
        

</table>

<br>
<p style="font-size: 15px;">*ราคาที่เสนอ และราคาที่ตกลงซื้อจ้าง เป็นราคารวมภาษีมูลค่าเพิ่มและภาษีอื่น ค่าข่นส่ง ค่าจดทะเบียน และค่าใช้จ่ายอื่นๆ ทั้งปวง </p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดยเกณฑ์การพิจารณาผลการยื่นข้อเสนอครั้งนี้ จะพิจารณาตัดสินโดยใช้หลักเกณฑ์ราคา จังหวัด{{$infoorg->PROVINCE}} โดย {{$infoorg->ORG_NAME}}
พิจารณาแล้ว เห็นสมควรจัดซื้อจัดจ้างจากผู้เสนอราคาดังกล่าว<br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรดอนุมัติให้สั่งซื้อสั่งจ้างจากผู้เสนอราคาดังกล่าว
<br><br><br>
<table style="border: none;">
<tr style="border: none;">
<td style="border: none;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$inforcon->COMMIT_HR_POSITION}}{{$inforcon->HR_LEVEL_NAME}}<br>
</td>
</tr>
</table>
<table style="border: none;">
<tr style="border: none;">
<td style="border: none;">
เรียน {{$inforcon->ORG_PROVINCE_LEADER}}<br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- เห็นควรอนุมัติ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B style="font-size: 21px;">อนุมัติ</B><br>
<br>
({{$inforcon->COMMIT_HR_LEADER_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้าเจ้าหน้าที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{$inforcon->ORG_PROVINCE}}<BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงวันที่ {{DateThaifrom($inforcon->DATE_REGIS)}}<BR>
</td>
</tr>
</table>


</body>
</html>