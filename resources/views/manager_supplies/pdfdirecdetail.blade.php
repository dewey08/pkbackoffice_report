

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
                    font-size: 13.5px;
                    line-height: 1;
                    padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
            
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


  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }
    ?>

</head>
<body>
<img src="image/Garuda.png" width="50" height="50">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<b style="font-size:20px">บันทึกข้อความ</b><br>
<b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
ที่ {{thainumDigit($hrddepartment->BOOK_NUM)}}/
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
วันที่ {{DateThaifrom(date('Y-m-d'))}}<br>
<b>เรื่อง</b> ขออนุมัติแต่งตั้งคณะกรรมการกำหนดรายละเอียดคุณลักษณะเฉพาะ <br>
________________________________________________________________________________________<br>
<b>เรียน</b> ผู้อำนวยการ{{$infoorg->ORG_NAME}}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย{{$infoorg->ORG_NAME}} มีความประสงค์จะดำเนินการ {{$infotypebuy}}  ประจำปีงบประมาณ 

{{thainumDigit($yearbudget)}} วงเงินงบประมาณ {{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}} บาท ({{convert(number_format($inforcon->BUDGET_SUM,2))}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ดังนั้น เพื่อให้การจัดทำรายละเอียดคุณลักษณะเฉพาะของพัสดุดั่งกล่าว เป็นไปตามระเบียบ
กระทรวงสาธารณสุข ว่าด้วยวิธีปฏิบัติเกี่ยวกับการจัดซื้อจัดจ้างและการพัสดุโดยใช้เงินบริจาคของหน่วยบริการสาธารณสุข พ.ศ. ๒๕๖๑ ข้อง ๑๓ ในการซื้อหรือจ้างที่มิใ่การจ้งก่อสร้าง
 ให้ผู้อำนวยการแต่งตั้งคณะกรรมการขึ้นมาคณะหนึ่งหรือจะให้เจ้าหน้าที่หรือบุคคลใด บุคคลหนึ่งรับผิดชอบในการจัดทำร่างของเขตของงาน
 หรือรายละเอียดคุณลักษณะเฉพาะของพัสดุที่จะซื้อหรือจ้าง รวมทั้งกำหนดหลักเกณฑ์การพิจารณาคัดเลือกข้อเสนอด้วย จึงเห็นสมควร
 แต่งตั้งคณะกรรมการจัดทำราคากลางของพัสดุที่จะซื้อ ประกอบด้วย
<br><br>
<center>
<table>
<?php $num = 0; ?>
@foreach ($boarddetails as $boarddetail)  
<?php $num++; ?>
<tr>
<td style="width: 30px">{{thainumDigit($num)}}.</td>
<td style="width: 250px">{{$boarddetail->BOARD_DETAIL_HR_NAME}}</td>
<td style="width: 150px">{{$boarddetail->BOARD_DETAIL_HR_POSITION}}</td>
<td style="width: 10px">&nbsp;</td>
<td style="width: 100px">{{$boarddetail->POSITION_NAME}}</td>
</tr>

@endforeach  
</table>
</center>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>ข้อเสนอ</B><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรดลงนามในคำสั่งแต่งตั้งต่อไปด้วย จะเป็นพระคุณยิ่ง<br><br><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(____________________________)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าพนักงานพัสดุปฏิบัติงาน<br>

<B>ความเห็นหัวหน้าเจ้าหน้าที่</B><br>
เรียน ผู้อำนวยการ{{$infoorg->ORG_NAME}}<br>
- เพื่อโปรดพิจารณาอนุมัติ<br>
<br><br><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(____________________________)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้าเจ้าหน้าที่
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ผู้อำนวยการ{{$infoorg->ORG_NAME}}


</body>
</html>