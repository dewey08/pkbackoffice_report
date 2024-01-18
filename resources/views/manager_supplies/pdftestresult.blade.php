
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
                line-height: 0.7;
               
           
            }
    
          
    table, th, td {
      border: 1px solid black;
    }
    
    
            
        </style>
    
    <?php
    
    function RemovethainumDigit($num){
        return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
    }
    
    function Removeconvert($number){ 
        $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
        $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
        $number = str_replace(",","",$number); 
        $number = str_replace(" ","",$number); 
        $number = str_replace("บาท","",$number); 
        $number = explode(".",$number); 
        if(sizeof($number)>2){ 
        return ''; 
        exit; 
        } 
        $strlen = strlen($number[0]); 
        $convert = ''; 
        for($i=0;$i<$strlen;$i++){ 
            $n = substr($number[0], $i,1); 
            if($n!=0){ 
                if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
                elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
                elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
                else{ $convert .= $txtnum1[$n]; } 
                $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        
        $convert .= 'บาท'; 
        if($number[1]=='0' OR $number[1]=='00' OR 
        $number[1]==''){ 
        $convert .= 'ถ้วน'; 
        }else{ 
        $strlen = strlen($number[1]); 
        for($i=0;$i<$strlen;$i++){ 
        $n = substr($number[1], $i,1); 
            if($n!=0){ 
            if($i==($strlen-1) AND $n==1){$convert 
            .= 'เอ็ด';} 
            elseif($i==($strlen-2) AND 
            $n==2){$convert .= 'ยี่';} 
            elseif($i==($strlen-2) AND 
            $n==1){$convert .= '';} 
            else{ $convert .= $txtnum1[$n];} 
            $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        $convert .= 'สตางค์'; 
        } 
        return $convert; 
        } 
    
    
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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <B style="font-size: 26px;">บันทึกข้อความ</B><BR>
    <b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
    <b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/'.$inforcon->PO_NUM)}}
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <B>วันที่</B> {{DateThaifrom($inforcon->CHECK_DATE)}}<br>
    <b>เรื่อง</b> รายงานผลการตรวจรับพัสดุ <br>
    <B>เรียน</B> ผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>๑.เรื่องเดิม</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จังหวัด{{$infoorg->PROVINCE}} โดย{{$infoorg->ORG_NAME}} ได้ตกลงซื้อ/จ้าง {{$infotypebuy}}  โดยวิธี{{$inforcon->BUY_NAME}}
    ตามรายงานผลการพิจารณาและขออนุมัติสั่งซื้อสั่งจ้าง ฉบับลงวันที่ {{DateThaifrom($inforcon->DATE_REGIS)}} และใบสั่งซื้อสั่งจ้างเลขที่ {{thainumDigit($inforcon->PO_NUM)}}
    ลงวันที่ {{DateThaifrom($inforcon->PO_DATE)}} กับ {{isset($inforconquotation->VENDOR_NAME) ? $inforconquotation->VENDOR_NAME : ''}} ในราคา {{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}} บาท ({{convert(number_format($inforcon->BUDGET_SUM,2))}})<br>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>๒.ข้อกฎหมายและระเบียบที่เกี่ยวข้อง</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามระเบียบกระทรวงการคลังว่าด้วยการจัดซื้อจัดจ้าง และการบริหารพัสดุภาครัฐ พ.ศ.๒๕๖๐ ข้อ ๑๗๕(๔)
    ความว่า "เมื่อตรวจถูกต้องครบถ้วนแล้วให้รับพัสดุไว้และถือว่าผู้ขายหรือผู้รับจ้างได้ส่งมอบพัสดุถูกต้องครบถ้วนตั้งแต่วันที่ผู้ขาย หรือผู้รับจ้าง นำพัสดุนั้นมาส่งแล้วมอบแก่เจ้าหน้าที่
    พร้อมกับทำใบตรวจรับ โดยลงชื่อไว้เป็นหลักฐาน อย่างน้อย ๒ ฉบับ มอบแก่ ผู้ขายหรือผู้รับจ้าง ๑ ฉบับ และเจ้าหน้าที่ ๑ ฉบับ เพื่อดำเนินการเบิกจ่าย
    เงินตามระเบียบ ของหน่วยรัฐและรายงานให้หัวหน้า หน่วยงานของรัฐทราบ"<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>๓.ข้อเท็จจริง</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๓.๑ ผู้ขาย {{isset($inforconquotation->VENDOR_NAME) ? $inforconquotation->VENDOR_NAME : ''}} ขอส่งมอบพัสดุตามใบส่งของเลขที่ {{thainumDigit($inforcon->INVOICE_NUM)}}
    คณะกรรมการตรวจรับพัสดุ ได้ดำเนินการตรวจรับพัสดุ ในวันที่ {{DateThaifrom($inforcon->CHECK_DATE)}} เวลา {{thainumDigit($inforcon->CHECK_TIME)}} ซึ่งมีผลการตรวจรับ ปรากฏว่า ถูกต้อง และ ครบถ้วนตามสัญญา
    ความละเอียดตามใบการตรวจรับการจัดซื้อ/จัดจ้าง ฉบับลงวันที่ {{DateThaifrom($inforcon->CHECK_DATE)}}<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;๓.๒ ผู้ขายส่งมอบพัสดุภายในกำหนดสัญญา จึงเบิกจ่ายเงินให้ผู้ขาย {{thainumDigit(number_format($inforcon->BUDGET_SUM,2))}} บาท ({{convert(number_format($inforcon->BUDGET_SUM,2))}})<br>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>๔.ข้อพิจารณา</B><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;งานพัสดุ กลุ่มงานบริหารทั่วไป {{$infoorg->ORG_NAME}} พิจารณาแล้ว เห็นว่าผู้ขายส่งมอบพัสดุ ตามสัญญาประกอบกับคณะกรรมการตรวจรับพัสดุได้ตรวจรับไว้ถูกต้อง ครบถ้วนแล้ว และจะส่งมอบใบตรวจรับการจัดซื้อจัดจ้าง ให้ผู้ที่เกี่ยวข้อง เพื่อดำเนินการเบิกจ่ายเงิน ตามระเบียบฯ ดังนั้น เพื่อให้ชอบด้วยระเบียบกระทรวงการคลังว่าด้วยการ จัดซื้อจัดจ้างและบริหารพัสดุ ภาครัฐ พ.ศ.๒๕๖๐ ข้อ ๑๗๕(๔) จึงเสนอรายงานมาเพื่อทราบ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>๕.ข้อเสนอ</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ.....................................................เจ้าหน้าที่<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดทราบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_NAME}})<br>
    ความเห็นหัวหน้าเจ้าหน้าที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าหน้าที่พัสดุ<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-เพื่อโปรดทราบ<br><br><br>
    ({{$inforcon->COMMIT_HR_LEADER_NAME}})&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ.....................................................เจ้าหน้าที่<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้าเจ้าหน้าที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}<BR>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปฏิบัติราชการแทน ผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}<BR>
    </body>
    </html>