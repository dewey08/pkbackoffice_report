<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
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
         font-size: 13px;
        line-height: 0.8;     
        padding: 2.10pt 14.1pt 1.1pt 14.00pt;  
        /* เรียงจากบน ขวา ล่าง  ซ้าย */
     }

   
 table, th, td {
    border: none;
 }


 .text-pedding{
 padding-left:10px;
 padding-right:10px;
}   

   
     
     </style>
    
    <?php
    
        function caldate($displaydate_end,$displaydate_bigen){ 
            $sumdate = round(abs(strtotime($displaydate_end) - strtotime($displaydate_bigen))/60/60/24)+1;
            return thainumDigit($sumdate); 
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
                function timefrom($strtime)
                {
                        $time = substr($strtime,0,5);
                        
                    return thainumDigit($time);
                }
                $date = date('Y-m-d');



    ?>

</head>
<body>
<table width="100%">
    <tr>
        <td width="40%"><img src="image/Garuda.png" width="50" height="50"></td>
        <td><B style="font-size: 25px;">บันทึกข้อความ</B></td>
    </tr>   
</table>
<br>
<b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
<table width="100%">
    <tr>
        <td width="40%"><b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/'  )}}</td>
        <td>วันที่ {{DateThaifrom(date('Y-m-d'))}}</td>
    </tr>   
</table>
<b>เรื่อง</b> นำส่งหลักฐานใบสำคัญชดใช้เงินยืมตามสัญญาเงินยืมเลขที่ {{$infomation->BORROW_NUMBER}} <br>
________________________________________________________________________________________<br><br>
<label for="">  เรียน ผู้อำนวยการ{{$infoorg->ORG_NAME}}   </label> <br><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามบันทึกข้อความที่.................................ลงวันที่...............................ได้รับอนุมัติให้ยืมเงินตามสัญญา<br>
เงินยืมเลขที่ {{$infomation->BORROW_NUMBER}} วงเงินตามสัญญาจำนวนเงิน {{thainumDigit(number_format($infomun))}} บาท ( {{convert(number_format($infomun,2))}} )<br>
เพื่อ {{$infomation->BORROW_COMMENT}} <br>
นั้น บัดนี้การดำเนินการดังกล่าวแล้วเสร็จ ข้าพเจ้า {{$infomation->BORROW_HR_PERSON_NAME}} 
จึงขอนำส่งหลักฐานใบสำคัญเพื่อชดใช้เงินยืม โดยรายละเอียดดังนี้ <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="position: absolute;"> &nbsp;&nbsp;&nbsp;ค่าใช้จ่ายที่จ่ายไปทั้งสิ้น จำนวน.............................................บาท (.................................................)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="position: absolute;"> &nbsp;&nbsp;&nbsp;มีเงินเหลือจ่ายส่งคืน จำนวน.............................................บาท (.................................................)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="position: absolute;"> &nbsp;&nbsp;&nbsp;ไม่มีเงินเหลือจ่าย<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="position: absolute;"> &nbsp;&nbsp;&nbsp;ส่งชดใช้เงินยืมล่าช้า เนื่องจาก........................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="position: absolute;"> &nbsp;&nbsp;&nbsp;ส่งหลักฐานใบสำคัญต่ำกว่า ๗๐ % เนื่องจาก........................................................<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดทราบพิจารณา<br>
<br>
<br>
<table width="100%">
    <tr>
        <td width="55%"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;............................................</td>
    </tr>
    <tr>
        <td width="55%"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( {{$infomation->BORROW_HR_PERSON_NAME}} )</td>
    </tr>
    <tr>
        <td width="55%"></td>
        <td>ตำแหน่ง {{$infopersonref->POSITION_IN_WORK}}</td>
    </tr>
</table>
<table width="100%">
<tr>
<td>
    <b>งานการเงินตรวจสอบ</b><br>
    <input type="checkbox" valign="bottom">&nbsp;เอกสารถูกต้อง ครบถ้วน<br>
    <input type="checkbox" valign="bottom">&nbsp;เอกสารไม่ถูกต้อง ครบถ้วน<br>

    <b>หลักฐานทางการเงิน</b><br>
    <input type="checkbox" valign="bottom">&nbsp;ใบสำคัญรับเงิน เล่มที่.......เลขที่ จำนวน...............บาท<br>
    <input type="checkbox" valign="bottom">&nbsp;ใบเสร็จรับเงิน เล่มที่.......เลขที่ จำนวน...............บาท<br>
<br>

    ลงชื่อ......................เจ้าหน้าที่การเงิน<br> 
    &nbsp;&nbsp;({{$info_staff->HR_PREFIX_NAME}} {{$info_staff->HR_FNAME}} {{$info_staff->HR_LNAME }} )<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;......../......../........<br><br>

</td>

<td>
    <b>ความเห็นของหัวหน้างานการเงิน</b><br>
    &nbsp;&nbsp;&nbsp;&nbsp;.............................................<br>
    &nbsp;&nbsp;&nbsp;&nbsp;.............................................<br>
    &nbsp;&nbsp;ลงชื่อ.........................................<br>
   
    &nbsp;&nbsp;(...................................................)<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;......../......../........<br><br>
 
<b>ความเห็นของหัวหน้าฝ่ายบริหาร</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;.............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;.............................................<br>
&nbsp;&nbsp;ลงชื่อ.........................................<br>
&nbsp;&nbsp;({{$info_leader->HR_PREFIX_NAME}} {{$info_leader->HR_FNAME}} {{$info_leader->HR_LNAME }} )<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;......../......../........<br><br>



</td>

</tr>
</table>





<center>

ความเห็นของผู้อำนวยการโรงพยาบาล<br>

...........................................................<br>

ลงชื่อ.........................................<br>

( {{$infoorg->HR_PREFIX_NAME}} {{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME }} )<br>

......../......../........<br>

</center>
   </body>
</html> 