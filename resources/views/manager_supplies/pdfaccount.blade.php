
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
                font-family: "THSarabunNew";
                font-size: 13px;
                line-height: 1;
              
            }
    
            @page{
            margin-top: 10px;
            margin-left: 110px;
            margin-right: 60px;
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
    
    <table style="font-size: 10px;" ><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    
    
    </td><td> ใบสำคัญที่&nbsp;</td><td style="border: 1px solid black;">&nbsp;บจ..........................................</td><tr><td>&nbsp;</td><td>&nbsp;</td><td  style="border: 1px solid black;"> &nbsp;บท..........................................</td></tr></table>
    
    
    <img src="image/Garuda.png" width="60" height="60">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <B style="font-size: 26px;">บันทึกข้อความ</B><BR> 
    
    <b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
    <b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/')}}
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>วันที่</b>.............................................. <br>
    <b>เรื่อง</b> ขออนุมัติจ่ายเงินบำรุง <br>
    <B>เรียน</B> ผู้อำนวยการ{{$infoorg->ORG_NAME}}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องด้วย{{$infoorg->ORG_NAME}}ได้รับอนุมัติให้ดำเนินการจัดซื้อ/จัดจ้าง <B>{{$infotypebuy}} </B> 
    ตามบันทึกของ{{$infoorg->ORG_NAME}} ลงวันที่ {{DateThaifrom($inforcon->DATE_REGIS)}} ซึ่ง บัดนี้เจ้าหน้าที่ ได้ดำเนินการเสร็จเรียบร้อยแล้วดังรายละเอียดที่แนบมาพร้อมนี้<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฉะนั้นอาศัยตามคำสั่งของสำนักงานปลัดกระทรวงสาธารณสุข ที่ ๒๐๑๑/๒๕๖๓ ลงวันที่ ๑๗ สิงหาคม ๒๕๖๓
    ข้อ ๑(๓) ผู้อำนวยการโรงพยาบาลชุมชน  หรือผู้ปฏิบัติหน้าที่ผู้อำนวยการโรงพยาบาลชุมชน มีอำนาจอนุมัติ จ่ายเงินบำรุงได้ครั้งหนึ่งไม่เกิน ๒,๐๐๐,๐๐๐ บาท(สองล้านบาทถ้วน)
    <br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติจ่ายเงินบำรุง จำนวน <B>{{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}}</B> บาท <B>({{convert(number_format($inforcon->BUDGET_SUM,2))}})</B>
    ให้แก่ <B>{{$inforconquotation->VENDOR_NAME}}</B><br>
    <br><br><br>
    <center><br>
    (นางภัทรา ประดิษฐ์ศิลา)<br>
    นักวิชาการเงินและบัญชี</center>
    <br><br><br>
    <B>- ความเห็นของหัวหน้าฝ่ายบริหารทั่วไป</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ได้ตรวจสอบหลักฐานถูกต้องแล้ว เห็นควรอนุมัติจ่ายเงินได้<br>
    <br><br></center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_LEADER_NAME}})&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B style="font-size: 23px;">อนุมัติ</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นักจัดการงานทั่วไปชำนาญการ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}<BR>
    </body>
    </html>