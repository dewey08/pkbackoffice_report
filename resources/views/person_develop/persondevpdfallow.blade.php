
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
<img src="image/Garuda.png" width="115" height="125"><br>
&nbsp;&nbsp;<label for="">ที่ {{thainumDigit($hrddepartment->BOOK_NUM.'/')}}</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for="">{{$infoorg->ORG_NAME}} </label>                                                                                
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="">อำเภอ{{$infoorg->DISTRICT}}&nbsp;จังหวัด{{thainumDigit($infoorg->PROVINCE)}}</label>

</center>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
วันที่ {{DateThaifrom(date('Y-m-d'))}}<br>

เรื่อง {{$grecord_index->RECORD_HEAD_USE}}<br>
เรียน ผู้อำนายการ{{$infoorg->ORG_NAME}}<br>
อ้างถึง หนังสือ ที่ ................................................<br>

<label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามหนังสือที่อ้างอิงถึงของ........................................................ได้ขอความอนุเคราะห์&nbsp;
<br>{{$grecord_index->USER_POST_NAME}}&nbsp;ตำแหน่ง&nbsp;{{$grecord_index->POSITION_IN_WORK}}&nbsp;
หน่วยงาน {{$grecord_index->HR_DEPARTMENT_SUB_SUB_NAME}}<br>
เข้าร่วมเป็นวิทยากร ในวันที่ &nbsp;{{DateThaifrom($grecord_index->DATE_GO)}}&nbsp;ถึงวันที่&nbsp;{{DateThaifrom($grecord_index->DATE_BACK)}}
ตั้งแต่เวลา...........................ถึงเวลา........................... สถานที่ ณ {{$grecord_index->LOCATION_ORG_NAME}}</label><br>
ข้าพเจ้าได้รับหนังสือดังกล่าวเรียบร้อยแล้ว<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อทราบ<br>
<br>
<br>
<br>
<br>
<br>
<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for="">
@if($grecord_index->STATUS == 'SUCCESS')
<input type="checkbox" id="check1" name="check1" checked>&nbsp;
@else
<input type="checkbox" id="check1" name="check1" >&nbsp;
@endif
<label for="check1">อนุญาต</label>
&nbsp;&nbsp;
<input type="checkbox" id="check2" name="check2" >&nbsp;
<label for="check2">ไม่อนุญาต</label>

</label>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ขอแสดงความนับถือ<br><br>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}}&nbsp;&nbsp;{{$infoorg->HR_LNAME}}) 
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ผู้อำนายการ{{$infoorg->ORG_NAME}}
</center>
<div class="">




</div><div class=""></div>


</body>
</html>