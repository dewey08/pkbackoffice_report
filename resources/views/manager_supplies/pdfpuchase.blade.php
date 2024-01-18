
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
              
           
            }
    
    
    .text-pedding{
        padding-left:10px;
        padding-right:10px;
    }   
    /* table, th, td {
         border: 1px solid #000;
    }
    .non-table{
         border: px solid #000;
    } */
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
    <B style="font-size: 22px;">ใบสั่งซื้อ/สั่งจ้าง</B><BR><BR></center>
    
    <table >
      <tr>
            <td style="width: 350px">ผู้ขาย/ผู้รับจ้าง  {{isset($inforconquotation->VENDOR_NAME) ? $inforconquotation->VENDOR_NAME : ''}}</td>
            <td style="width: 350px">  ใบสั่งซื้อ/สั่งจ้างเลขที่ {{thainumDigit($inforcon->PO_NUM)}}</td>
      </tr>
      <tr>
            <td style="width: 350px">ที่อยู่ {{ isset($inforconquotation->QUOTATION_VENDOR_ADD) ? thainumDigit($inforconquotation->QUOTATION_VENDOR_ADD) : ''}}</td>
            <td style="width: 350px">วันที่ {{DateThaifrom($inforcon->PO_DATE)}}<br>ส่วนราชการ {{$infoorg->ORG_NAME}}</td>
      </tr>
      <tr>
            <td style="width: 350px">โทรศัพท์ {{ isset($inforconquotation->VENDOR_PHONE) ? thainumDigit($inforconquotation->VENDOR_PHONE) : ''}}</td>
            <td style="width: 350px">ที่อยู่ {{thainumDigit($infoorg->ORG_ADDRESS)}}</td>
      </tr>
      <tr>
            <td style="width: 350px">เลขประจำตัวผู้เสียภาษี {{ isset($inforconquotation->QUOTATION_VENDOR_TAXNUM) ? thainumDigit($inforconquotation->QUOTATION_VENDOR_TAXNUM) : ''}}</td>
            <td style="width: 350px">โทรศัพท์ {{ isset($infoorg->ORG_PHONE) ? thainumDigit($infoorg->ORG_PHONE) : ''}}</td>
      </tr>
      <tr>
            <td style="width: 350px">เลขที่บัญชีเงินฝากธนาคาร {{ isset($inforconquotation->VENDOR_BANK_NUM) ?  thainumDigit($inforconquotation->VENDOR_BANK_NUM) : ''}}</td>
            <td style="width: 350px"></td>
      </tr>
      <tr>
            <td style="width: 350px">ชื่อบัญชี {{ isset($inforconquotation->VENDOR_BANK_NAME) ? thainumDigit($inforconquotation->VENDOR_BANK_NAME) : ''}}</td>
            <td style="width: 350px"></td>
      </tr>
      <tr>
            <td style="width: 350px">ธนาคาร {{ isset($inforconquotation->VENDOR_BANK) ? thainumDigit($inforconquotation->VENDOR_BANK) : ''}}</td>
            <td style="width: 350px"></td>
      </tr>
    </table>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ {{isset($inforconquotation->VENDOR_NAME) ? $inforconquotation->VENDOR_NAME : ''}} ได้เสนอราคาไว้ต่อ {{isset($infoorg->ORG_NAME) ? $infoorg->ORG_NAME : ''}} ซึ่งได้รับราคาและตกลงซื้อ/จ้าง ตามรายการดังต่อไปนี้
    
    <table style="width: 700px; border: 1px solid black;"> <!-- only added this -->
        <tr>
            <th style="width: 25px; border: 1px solid black;" ><center>ลำดับ</center></th>
            <th style="width: 200px; border: 1px solid black;" ><center>รายการ</center></th>
            <th style="width: 50px; border: 1px solid black;" ><center>จำนวน</center></th>
            <th style="width: 50px; border: 1px solid black;" ><center>หน่วย</center></th>
            <th style="width: 100px; border: 1px solid black;" ><center>ราคา/หน่วย</center></th>
            <th style="width: 100px; border: 1px solid black;" ><center>จำนวนเงิน</center></th>
        </tr>
        
        <?php $number = 0; ?>
                        @foreach ($infocons as $infocon)  
    
                        <?php $number++;?>
    
        <tr>
            <td style="width: 25px word-break:break-all; word-wrap:break-word; border: 1px solid black;" class="text-font text-pedding"><center>{{thainumDigit($number)}}</center></td>
            <td style="width: 200px word-break:break-all; word-wrap:break-word; border: 1px solid black;" class="text-font text-pedding">{{thainumDigit($infocon->SUP_NAME)}}</td>
            <td style="width: 25px word-break:break-all; word-wrap:break-word; border: 1px solid black;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->SUP_TOTAL))}} </td>
            <td style="width: 25px word-break:break-all; word-wrap:break-word; border: 1px solid black;text-align: center" class="text-font text-pedding">{{$infocon->SUP_UNIT_NAME}} </td>
            <td style="width:50px; word-break:break-all; word-wrap:break-word; border: 1px solid black;text-align: right" class="text-font text-pedding">{{thainumDigit(number_format($infocon->PRICE_PER_UNIT,2))}}
            </td>
            <td style="width: 25px; word-break:break-all; word-wrap:break-word; border: 1px solid black;text-align: right" class="text-font text-pedding">
           {{thainumDigit(number_format($infocon->PRICE_SUM,2))}}
            </td>
     
          @endforeach   
        </tr>
    
        <tr>
            <td style="border: 1px solid black;word-break:break-all; word-wrap:break-word;" colspan="4" rowspan="4"><center>({{convert($total)}})</center></td>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>รวมเป็นเงิน </center></td>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right;"  class="text-font text-pedding">{{thainumDigit(number_format($totalsum_real,2))}}</td>
           
        </tr>
        
        <tr>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ภาษีมูลค่าเพิ่ม </center></td>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right;"  class="text-font text-pedding">{{thainumDigit($texreal)}}</td>
           
        </tr>
        <tr>
        <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>ส่วนลด </center></td>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right;"  class="text-font text-pedding">{{thainumDigit(number_format($discountnum,2))}}</td>
           
        </tr>
        <tr>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;" ><center>รวมเป็นเงินทั้งสิ้น </center></td>
            <td style="width: 100px; border: 1px solid black;word-break:break-all; word-wrap:break-word;text-align: right;"  class="text-font text-pedding">{{thainumDigit($total)}}</td>
           
        </tr>
     
    
    
    </table><br>
    การซื้อ/จ้าง  อยู่ภายใต้เงื่อนไขดังต่อไปนี้ <br>
    ๑. กําหนดส่งมอบภายใน {{thainumDigit($DATE_WANT_COUNT)}} วัน นับถัดจากวันที่ผู้จ้างได้รับใบสั่งซื้อ <br>
    ๒. ครบกําหนดส่งมอบวันที่ {{DateThaifrom($inforcon->SEND_DATE)}}<br>
    ๓. สถานที่ส่งมอบ {{$infoorg->ORG_NAME}}<br> 
    ๔. ระยะเวลารับประกัน    {{thainumDigit($inforcon->INSURANCE_YEAR)}} ปี  {{thainumDigit($inforcon->INSURANCE_MONT)}}    เดือน      <br>
    ๕. สงวนสิทธิ์ค่าปรับส่งมอบเกินกําหนด โดยคิดค่าปรับเป็นรายวันในอัตราร้อยละ ๐.๒๐ ของราคาสิ่งของที่ยังไม่ได้รับมอบ จะต้องไม่ต่ํากว่าวันละ ๑๐๐.๐๐ บาท <br>
    ๖. ส่วนราชการสงวนสิทธิ์ที่จะไม่รับมอบถ้าปรากฏว่าสินค้านั้นมีลักษณะไม่ตรงตามรายการที่ระบุไว้ในใบสั่งซื้อ กรณีนี้ผู้ขายจะต้องดําเนินการเปลี่ยนใหม่ให้ถูกต้องตามใบสั่งซื้อทุกประการ<br> 
    ๗. กรณีงานจ้าง ผู้จ้างจะต้องไม่เอางานทั้งหมดหรือแค่บางส่วนแห่งสัญญานี้ไปจ้างช่วงอีกทอดหนึ่ง เว้นแต่การจ้างช่วงงาน 
    ไม่เป็นเหตุให้ผู้รับจ้างหลุดพ้นจากความรับผิดหรือพันธะหน้าที่ตามสัญญานี้  และผู้รับจ้างจะยังคงต้องรับผิดในความผิด และประมาทเลินเล่อของผู้รับจ้างช่วง  หรือของตัวแทนหรือลูกน้องของผู้รับจ้างช่วงนั้นทุกประการ กรณีผู้รับจ้างไปจ้าง ช่วงงานแต่บางส่วนโดยฝ่าฝืนความในวรรคหนึ่ง  ผู้รับจ้างต้องชําระค่าปรับให้แก่ผู้ว่าจ้างเป็นจํานวนเงินในอัตรา ร้อยละ ๑๐ (สิบ)  ของวงเงินของงานที่จ้างช่วงตามสัญญา ทั้งนี้ไม่ตัดสิทธิผู้ว่าจ้างในการบอกเลิกสัญญา<br>
    ๘. การประเมินผลการปฏิบัติงานของผู้ประกอบการ หน่วยงานของรัฐสามารถนําผลการปฏิบัติงานแล้วเสร็จตามสัญญา หรือข้อตกลงของคู่สัญญาเพื่อนํามาประเมินผลการปฏิบัติงานของผู้ประกอบการ
    <br><br><br><br>
     <p style="text-decoration:underline">หมายเหตุ</p>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๑. การติดอากรแสตมป์ให้เป็นไปตามประมวลกฏหมายรัษฎากร หากต้องการให้ใบสั่งซื้อมีผลตามกฏหมาย <br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๒. ใบสั่งซื้อสั่งจ้างนี้อ้างอิงตามเลขที่โครงการ {{thainumDigit($inforcon->EGP_CODE)}} จัดซื้อจัดจ้าง {{$infotypebuy}}  โดยวิธี {{$inforcon->BUY_NAME}} <br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามประกาศ {{$infoorg->ORG_NAME}} วันที่ {{DateThaifrom($inforcon->DATE_REGIS)}}<br><br><br><br>
     <table style="width: 700px;">
     <tr><td >
     <center>
    ลงชื่อ......................................................ใบสั่งซื้อ/ใบสั่งจ้าง<br>
    ({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
    ผู้อำนวยการ{{$infoorg->ORG_NAME}}<BR>
    ปฏิบัติราชการแทน ผู้ว่าราชการจังหวัด{{isset($infoorg->PROVINCE) ? $infoorg->PROVINCE : ''}}<BR>
    วันที่  {{DateThaifrom($inforcon->PO_DATE)}}<br><br><br>
    ลงชื่อ......................................................ผู้รับใบสั่งซื้อ/ใบสั่งจ้าง<br>
    ({{$inforcon->RECIPIENT_NAME}})<br>
    {{$inforcon->RECIPIENT_POSITION}}<br>
    วันที่  {{DateThaifrom($inforcon->PO_DATE)}}<br>
    </center><br><br>
    เลขที่โครงการ  {{thainumDigit($inforcon->EGP_CODE)}}<br>
    เลขคุมสัญญา
    </td><tr>
    </table>
    </body>
    </html>