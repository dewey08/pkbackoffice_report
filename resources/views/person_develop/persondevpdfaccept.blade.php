

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
             font-size: 16px;
            line-height: 1;     
        
         }
 
       
     table, th, td {
     border: 1px solid black;
     }
 
 
     .text-pedding{
     padding-left:10px;
     padding-right:10px;
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

        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
    }


    ?>
</head>

<body>
<center>

<b style="font-size:25px;">แบบตอบรับการเป็นวิทยากร</b><br>
<b>วิทยากร เรื่อง {{$grecord_index->RECORD_HEAD_USE}}</b>
<br>
วันที่&nbsp;{{DateThaifrom($grecord_index->DATE_GO)}}&nbsp;ถึงวันที่&nbsp;{{DateThaifrom($grecord_index->DATE_BACK)}}
<br>
<b>{{$grecord_index->LOCATION_ORG_NAME}}</b> 
</center>
<hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

วันที่&nbsp;{{DateThaifrom(date('Y-m-d'))}}
<br>
เรื่อง&nbsp;&nbsp;ตอบรับการเป็นวิทยากร
<br>
เรียน&nbsp;&nbsp;{{$grecord_index->LOCATION_ORG_NAME}}
<br><br><br>
<label for="">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่{{$grecord_index->LOCATION_ORG_NAME}}
ตามหนังสืออ้างถึง&nbsp;{{$grecord_book->BOOK_NUM}} 
<br>
ได้จัดอบรม/โครงการ วิทยากร&nbsp;&nbsp;{{$grecord_index->RECORD_HEAD_USE}}&nbsp;
ในวันที่&nbsp;&nbsp;{{DateThaifrom($grecord_index->DATE_GO)}}&nbsp;&nbsp;ถึงวันที่&nbsp;&nbsp;{{DateThaifrom($grecord_index->DATE_BACK)}}&nbsp;
ณ {{$grecord_index->LOCATION_ORG_NAME}}
</label>
<br>
ทั้งนี้ได้เรียนเชิญข้าพเจ้าเป็นวิทยากร&nbsp;&nbsp;ตามรายละเอียดทราบแล้วนั้น&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($grecord_index->RECORD_EXPERT_RESULT == 'can')<input type="checkbox" id="check1" name="check1" checked>@else<input type="checkbox" id="check1" name="check1"> @endif&nbsp;&nbsp;<label for="check1">ยินดีตอบรับเป็นวิทยากร</label>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($grecord_index->RECORD_EXPERT_RESULT == 'cannot')<input type="checkbox" id="check2" name="check2" checked>@else<input type="checkbox" id="check2" name="check2"> @endif&nbsp;&nbsp;<label for="check2">ไม่สามารถเป็นวิทยากรได้&nbsp;เนื่องจาก&nbsp;{{$grecord_index->RECORD_EXPERT_REMARK}}</label>
<br>


<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
จึงเรียนมาเพื่อทราบ
<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ลงชื่อ.........................................................
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$grecord_index->USER_POST_NAME}})
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง {{$infopredev->POSITION_IN_WORK}} {{$infopredev->HR_LEVEL_NAME}}
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br>

<br>
{{$infoorg->ORG_NAME}}<br>
โทรศัพท์ {{thainumDigit($infoorg->ORG_PHONE)}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


          


</body>
</html>