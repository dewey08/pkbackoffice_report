
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
    
    
    
    <body>
    <img src="image/Garuda.png" width="60" height="60">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;
    
    <B style="font-size: 26px;">บันทึกข้อความ</B><BR>
    <b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}}  อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
    <b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/'.substr($inforcon->REQUEST_ID,4))}}
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>วันที่</b> {{DateThaifrom($inforcon->DATE_WANT)}}<br>
    <b>เรื่อง</b> รายงานขอซื้อ{{$infotypebuy}}   โดยวิธี{{$inforcon->BUY_NAME}} <br>
    <b>เรียน</b> ผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}<br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย {{$infoorg->ORG_NAME}}
    มีความประสงค์จะซื้อ {{$infotypebuy}}   โดยวิธี {{$inforcon->BUY_NAME}} ซึ่งมีรายละเอียดดังต่อไปนี้<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑.เหตุผลและความจำเป็นที่ต้องจัดซื้อ/จ้าง<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$inforcon->CON_DETAIL}}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๒.รายละเอียดของพัสดุ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดตามเอกสารแนบ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๓.ราคากลางของพัสดุที่จะซื้อหรือจ้าง
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องจากการจัดหาพัสดุรายการดังกล่าวไม่ใช่รายการสิ่งก่อสร้างจึงไม่สามารถใช้ราคาที่ได้มาจาก 
    การคำนวณตามหลักเกณฑ์ที่คณะกรรมการราคากลางกำหนด  และไม่มีราคาที่ได้มาจากฐานข้อมูลราคาอ้างอิง ของพัสดุที่กรมบัญชีกลางจัดทำและไม่มีราคามาตรฐานที่สำนักงบประมาณหรือหน่วยกลางอื่นกำหนด 
    จึงใช้ราคาที่ได้มา จากการสืบราคาจากท้องตลาดเป็นเงินจำนวน  {{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}} บาท ({{convert(number_format($inforcon->BUDGET_SUM,2))}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๔.วงเงินที่จะซื้อ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เงินนอกงบประมาณจาก <B>{{$inforcon->BUDGET_NAME}}</B>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน {{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}} บาท ({{convert(number_format($inforcon->BUDGET_SUM,2))}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๕.กำหนดเวลาที่ต้องการใช้พัสดุนั้น หรือให้งานนั้นแล้วเสร็จ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กำหนดเวลาส่งมอบพัสดุ หรือให้งานแล้วเสร็จภายใน {{thainumDigit($inforcon->DATE_WANT_COUNT)}} วัน&nbsp;&nbsp;&nbsp;&nbsp;นับถัดจากวันลงนามในสัญญา<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๖.วิธีที่จะซื้อ และเหตุผลที่ต้องซื้อ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ดำเนินการด้วยวิธีเฉพาะเจาะจงเนื่องจากการจัดซื้อจัดจ้างพัสดุที่มีการผลิต จำหน่าย ก่อสร้าง หรือให้บริการทั่วไปและมีวงเงินในการจัดซื้อจัดจ้างครั้งหนึ่งไม่เกินวงเงินที่กำหนดในกฎกระทรวง<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๖.๑ พระราชบัญญัติการจัดซื้อจัดจ้างและการบริหารพัสดุ พ.ศ ๒๕๖๐ มาตรา ๕๖(๒)(ข)การจัดซื้อจัดจ้างพัสดุที่มีการผลิต จำหน่าย ก่อสร้าง หรือให้บริการทั่วไปและมีวงเงิน ในการจัดซื้อจัดจ้างครั้งหนึ่งไม่เกินวงเงินตามที่กำหนดในกฎกระทรวง<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๖.๒ กฎกระทรวง กำหนดวงเงินการจัดซื้อจัดจ้างพัสดุโดยวิธีเฉพาะเจาะจงวงเงินการจัดซื้อจัดจ้าง ที่ไม่ทำข้อตกลงเป็นหนังสือ
            และวงเงินการจัดซื้อจัดจ้างในการแต่งตั้งผู้ตรวจรับพัสดุ พ.ศ ๒๕๖๐<br>
    
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ ๑) การจัดซื้อจัดจ้างสินค้า งานบริการ หรืองานก่อสร้าง ที่มีการผลิต จำหน่าย ก่อสร้างหรือให้บริการทั่วไป และมีวงเงินในการจัดซื้อจัดจ้างไม่เกิน ๕๐๐,๐๐๐ บาท ให้ใช้วิธีเฉพาะเจาะจง<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๖.๓ คำสั่งจังหวัด{{$infoorg->PROVINCE}} ที่ ๓๔๓๗/๒๕๖๔ ลงวันที่ ๔ ตุลาคม ๒๕๖๔ เรื่อง มอบอำนาจของผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}ด้านการสั่งซื้อสั่งจ้าง<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ ๑)การดำเนินการจัดซื้อจัดจ้างและการอนุมัติสั่งซื้อสั่งจ้าง ให้หมายถึงการเช่าด้วยภายในวงเงิน ต่อไปนี้<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๓)วิธีเฉพาะเจาะจง ครั้งหนึ่งไม่เกิน ๕๐๐,๐๐๐ บาท ตามมาตรา ๕๖(๒)(ก)(ข)(ค)(ง)(จ)(ฉ)(ช) และ (ซ) ยกเว้นกรณีสำหรับการสั่งซื้อหรือสั่งจ้างเวชภัณฑ์จากองค์การเภสัชกรรมและสภากาชาดไทย ให้มีอำนาจในวงเงิน ครั้งละไม่เกิน ๑,๐๐๐,๐๐๐ บาท<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๖.๔ ระเบียบกระทรวงสาธารณสุขว่าด้วยเงินบำรุงของหน่วยบริการในสังกัด กระทรวงสาธารณสุข ที่ ๒๐๑๑/๒๕๖๓ ลงวันที่ ๑๗ สิงหาคม ๒๕๖๓<br>
    
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๗.หลักเกณฑ์การพิจารณาคัดเลือกข้อเสนอ<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การพิจารณาคัดเลือกข้อเสนอโดยใช้&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>{{$inforcon->ASPECT_NAME}}</B><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๘.การขออนุมัติแต่งตั้งคณะกรรมการต่างๆ<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คณะกรรมการตรวจรับพัสดุ<br>
                <center>
    <table>
    <?php $num = 0; ?>
    @foreach ($boards as $board)  
    <?php $num++; ?>
    <tr>
    <td style="width: 30px">&nbsp;</td>
    <td style="width: 250px">{{thainumDigit($num)}}.{{$board->BOARD_HR_NAME}}</td>
    <td style="width: 150px">{{$board->BOARD_HR_POSITION}}</td>
    <td style="width: 10px">&nbsp;</td>
    <td style="width: 100px">{{$board->POSITION_NAME}}</td>
    </tr>
    
    @endforeach  
    </table>
    </center>
    
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อำนาจและหน้าที่<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทำการตรวจรับพัสดุให้เป็นไปตามเงื่อนไขของสัญญาหรือข้อตกลงนั้น<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรดอนุมัติให้ดำเนินการ ตามรายละเอียดในรายงานขอซื้อดังกล่าวข้างต้น<br>
                <br><br><br><br>
    
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
    ความเห็นหัวหน้าเจ้าหน้าที่<br> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- เห็นควรอนุมัติ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_LEADER_NAME}})<br>
    นักจัดการงานทั่วไปชำนาญการ(หัวหน้าเจ้าหน้าที่)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}<BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;{{$inforcon->ORG_PROVINCE}}<BR>
    
    </td>
    </tr>
    </table>
    
    </body>
    </html>
    