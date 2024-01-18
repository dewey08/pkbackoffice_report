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
                    padding: 28.3465pt 7.1732pt 7.1732pt 28.3465pt;
            
                }
                table{
     border-collapse: collapse;  //กรอบด้านในหายไป
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
<center>
    <B style="font-size: 14px;">ตารางที่ ๒</B>
</center>
    <BR>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตารางการขึ้นปฏิบัติงานด้านการพัฒนาระบบบริการและสนับสนุนบริการสุขภาพขึ้นปฏิบัติงานในการสนับสนุนงาน การปฏิบัติงานการให้บริการแก่ผู้มารับบริการโรงพยาบาล
โดยปฏิบัติงานนอกเวลาราชการตั้งแต่เวลา ๑๖.๓๐-๒๒.๓๐ น. และวันหยุดราชการตั้งแต่เวลา ๐๘.๓๐-๒๒.๓๐ น.ซึ้งเป็นการขึ้นปฏิบัติงานตามท่หัวหน้าทีมเห็นชอบให้ขึ้น ปฏิบัติงานได้ในแต่ละวัน ผู้มีหน้าที่ขึ้นปฏิบัติงานให้
เป็นไปตามบัญชีรายชื่อผู้ขึ้นปฏิบัติงานดังนี้
<br>
<BR>
<table style="width: 700px; border: 1px solid black;"> <!-- only added this -->
    <tr>
        <th style="width: 100px; border: 1px solid black;" ><center>นอกเวลาราชการ ๑๖.๓๐-๒๒.๓๐ น.</center></th>
        <th style="width: 100px; border: 1px solid black;" ><center>วันหยุดราชการ ๐๘.๓๐-๒๒.๓๐ น.</center></th>
 
    </tr>
    

  
    <tr>
        <td style="width: 100px word-break:break-all; word-wrap:break-word; border: 1px solid black;" class="text-font text-pedding">
       <?php $number_1 = 1; ?>
            @foreach ($infopersons as $infoperson)
       &nbsp;&nbsp;&nbsp;&nbsp;{{thainumDigit($number_1)}}.{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}<br>
       <?php $number_1++; ?>
       @endforeach    
    
        </td>
        <td style="width: 100px word-break:break-all; word-wrap:break-word; border: 1px solid black;" class="text-font text-pedding">
            <?php $number_2 = 1; ?>
            @foreach ($infopersons as $infoperson)
            &nbsp;&nbsp;&nbsp;&nbsp;{{thainumDigit($number_2)}}.{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}<br>
            <?php $number_2++; ?>
            @endforeach  
       </td>
      
      
    </tr>


 


</table><br>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

ผู้อำนวยการ{{$infoorg->ORG_NAME}}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp; -->

            


</body>
</html>