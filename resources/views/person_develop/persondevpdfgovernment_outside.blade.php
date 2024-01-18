
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
        font-size: 20px;
        line-height: 1.2;  
        padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
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
<img src="image/Garuda.png" width="50" height="50">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<B style="font-size: 30px;">บันทึกข้อความ</B><BR>
<b>ส่วนราชการ</b> {{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}}<br>
<b>ที่</b> {{thainumDigit($hrddepartment->BOOK_NUM.'/'                )}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
วันที่ {{DateThaifrom(date('Y-m-d'))}}<br>
<b>เรื่อง</b> ขออนุมัติเดินทางไปราชการ นอกสำนักงาน <br>
________________________________________________________________________________________<br><br>
<label for="">  เรียน ผู้ว่าราชการจังหวัด{{thainumDigit($infoorg->PROVINCE)}}   </label> <br><br>
<table>
<?php $num = 0; ?>
    @foreach ($index_persons as $index_person)  
        <?php $num++; ?>
            <tr>
                <td style="width: 60px">&nbsp;</td>
                @if($num == '1' && $check != '1')
                <td style="width: 230px">ด้วยข้าพเจ้า {{$index_person->HR_FULLNAME}}</td>
                @else
                <td style="width: 230px">{{$index_person->HR_FULLNAME}}</td>
                @endif
                <td style="width: 5px">ตำแหน่ง</td>
                <td style="width: 10px">&nbsp;</td>
                @if($num == '1'  && $check != '1')
                <td style="width: 100px">{{$index_person->HR_POSITION}}{{$index_person->HR_LAVEL}} พร้อมด้วย</td>
                @else
                <td style="width: 250px">{{$index_person->HR_POSITION}}{{$index_person->HR_LAVEL}}</td>
                @endif
            </tr>
    @endforeach  
</table>
<table>
    <tr>
        <td>มีความประสงค์ขออนุมัติไปราชการเพื่อ {{$infopredev->RECORD_HEAD_USE}}</td>
    </tr>
    <tr>
        <td>สถานที่ไป {{$infopredev->LOCATION_ORG_NAME}} จังหวัด {{$infopredev->PROVINCE_NAME}} ระยะห่างจากสำนักงาน {{thainumDigit(number_format($infopredev->DISTANCE/2))}} กิโลเมตร</td>
    </tr>
    <tr>
        <td>ในวันที &nbsp;{{DateThaifrom($infopredev->DATE_GO) }}&nbsp;ถึงวันที่ &nbsp;{{DateThaifrom($infopredev->DATE_BACK) }}&nbsp;รวม {{caldate($infopredev->DATE_BACK,$infopredev->DATE_GO) }} วัน</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จะออกเดินทางในวันที่  {{DateThaifrom($infopredev->DATE_TRAVEL_GO) }}&nbsp;เวลา  {{timefrom($infopredev->FROM_TIME)}} น.&nbsp; จะกลับในวันที่ &nbsp;&nbsp;{{DateThaifrom($infopredev->DATE_TRAVEL_BACK) }}&nbsp;&nbsp; เวลา  {{timefrom($infopredev->BACK_TIME)}} น.
            โดยพาหนะ &nbsp;
            @if($infopredev->RECORD_VEHICLE_ID == '3')
                รถยนต์ส่วนราชการ
            @elseif($infopredev->RECORD_VEHICLE_ID == '2')
                รถยนต์ส่วนบุคคล ทะเบียน {{thainumDigit($infopredev->CAR_REG)}}
            @elseif($infopredev->RECORD_VEHICLE_ID == '1')
                รถยนต์ประจำทาง
            @elseif($infopredev->RECORD_VEHICLE_ID == '4')
                เครื่องบิน
                @elseif($infopredev->RECORD_VEHICLE_ID == '5')
                รถไฟ
                @elseif($infopredev->RECORD_VEHICLE_ID == '6')
                เรือ
                @elseif($infopredev->RECORD_VEHICLE_ID == '8')
                รถจ้างเหมา
            @else
                อื่น ๆ {{thainumDigit($infopredev->CAR_REG)}}
            @endif
        </td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการไปราชการครั้งนี้ ได้มอบหมายงานในหน้าที่ให้กับ {{$infopredev->OFFER_WORK_HR_NAME}}&nbsp;&nbsp;&nbsp;&nbsp; ตำแหน่ง {{$indexpersonwork->POSITION_IN_WORK}} ปฎิบัติงานแทน</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            จึงเรียนมาเพื่อทราบและโปรดพิจารณาอนุมัติ</td>
    </tr>
</table>

     
<br><br>

<table style="width: 700px">  
<tr><td>   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

ลงชื่อ........................................................

&nbsp;ผู้ขออนุมัติ  
<center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ({{$infopredev->USER_POST_NAME}})<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ตำแหน่ง {{$infopredev->POSITION_IN_WORK}} {{$infopredev->HR_LEVEL_NAME}}
<br><br>
</center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
ลงชื่อ........................................................ &nbsp;ผู้รับมอบหมายงาน
<center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
({{$infopredev->OFFER_WORK_HR_NAME}})
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ตำแหน่ง {{$infooffer->POSITION_IN_WORK}} {{$infooffer->HR_LEVEL_NAME}}
<br><br>
</center> 
<center><B style="font-size: 22px;">คำสั่ง</B>

    <div class="form-check form-check-inline">     
        @if($infopredev->STATUS == 'SUCCESS')
        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5" checked>
        @else
        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5" >
        @endif
        <label class="form-check-label" for="inlineCheckbox5">&nbsp;&nbsp;อนุมัติ</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="option6">
        <label class="form-check-label" for="inlineCheckbox6">&nbsp;&nbsp;ไม่อนุมัติ</label>        
      </div>

      @if($infopredev->DR_PROVINCE_USE == 'true')
      <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
ลงชื่อ........................................................
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
(&nbsp;&nbsp;{{ $infoorg->PROVINCE_DR_NAME }} &nbsp;&nbsp;)
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
{{$infoorg->PROVINCE_DR_POSITION}}
<br>
ปฎิบัติราชการแทน ผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}
<br>

      @else
      <br>   
ลงชื่อ........................................................
<br>
({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}})
<br>
ผู้อำนวยการ{{$infoorg->ORG_NAME}}
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ปฎิบัติราชการแทน ผู้ว่าราชการจังหวัด{{$infoorg->PROVINCE}}
<br>

      @endif

</center> 
</td></tr>
</table>
   </body>
</html> 