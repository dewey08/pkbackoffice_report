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


<b>เรื่อง</b> ขอติดตามลูกหนี้เงินยืม สัญญาเงินที่ {{$infomation->BORROW_NUMBER}} ครั้งที่ ๑ <br>
________________________________________________________________________________________<br><br>
<label for="">  เรียน ผู้อำนวยการ{{$infoorg->ORG_NAME}}   </label> <br><br>

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องด้วย {{$infomation->BORROW_HR_PERSON_NAME}} ได้ยืมเงิน{{$infoorg->ORG_NAME}} 
 เพื่อ เป็นค่าใช้จ่าย {{$infomation->BORROW_COMMENT}} 
 ตามสัญญายืมเงินเลขที่ {{$infomation->BORROW_NUMBER}} เมื่อวันที่ {{DateThaifrom($infomation->BORROW_DATE)}}  เป็นจำนวนเงิน {{thainumDigit(number_format($infomun))}} บาท
 <br>( {{convert(number_format($infomun,2))}} )<br>

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;งานการเงินได้ตรวจสอบแล้วพบว่า สัญญายืมเงินของ {{$infomation->BORROW_HR_PERSON_NAME}} ได้ใกล้ครบกำหนดแล้วในวันที่ <br> {{DateThaifrom($infomation->BORROW_BACK_DATE)}} 
จึงขอให้เร่งดำเนินการ ให้แล้วเสร็จทันภายในกำหนดเวลา<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดทราบ<br>
<br><br><br>
<table width="100%">
    <tr>
        <td width="42%"></td>
        <td>(............................................)</td>
    </tr>  
    <tr>
        <td width="42%"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้าการเงิน</td>
    </tr>   
</table>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

ความเห็นของหัวหน้าฝ่ายบริหาร<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
.............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
.............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ลงชื่อ.........................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
( {{$info_leader->HR_PREFIX_NAME}} {{$info_leader->HR_FNAME}} {{$info_leader->HR_LNAME }} )<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
......../......../........<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ความเห็นของผู้อำนวยการ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
.............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
.............................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ลงชื่อ.........................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
( {{$infoorg->HR_PREFIX_NAME}} {{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME }} )<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
......../......../........<br>

แจ้งผู้ยืมลงชื่อรับทราบ<br>
ลงชื่อ.......................ผู้ยืมเงิน<br>
( {{$infomation->BORROW_HR_PERSON_NAME}} )<br>
   </body>
</html> 