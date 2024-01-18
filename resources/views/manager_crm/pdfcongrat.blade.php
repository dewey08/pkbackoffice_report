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
            line-height: 0.8;  
            /* padding: 10.00pt 7.1732pt 7.1732pt 40.00pt;              */
        }
        .font-title{
            font-size: 16px;
        }
        .font-content{
            font-size: 14px;
            margin-top: 10px;
        }

        .table-border{
            border: 1px solid black;
        }
        .table-border-bottom{
            border-bottom: 1px solid #000;

        }
        .table-border-left{
            border-left: 1px solid #000;
            /* padding-top:5px; */
        }

        .table-border-right{
            border-right: 1px solid #000;
        }
        .table-sub-border-bottom{
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .table-sub-border-left{
            border-left: 1px solid #000;
        }
        .page_break{ 
            page-break-before: always; 
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

            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
            $strMonthThai=$strMonthCut[$strMonth];
            return $strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear;
            }


    ?>
</head>
<?php
use App\Models\Org; 
$org = Org::find(1);

?>
<body>
    <center>       
        
        <table>
            <tr>
                <td>
                    @if ( $org->img_logo == Null )
                    <img id="image_upload_preview" src="{{asset('img/pers.png')}}" height="80" width="80"> 
                    @else
                    <img id="image_upload_preview" src="data:img/png;base64,{{ chunk_split(base64_encode($org->img_logo)) }}" height="80" width="80"> 
                    @endif       
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>               
                    <img src="image/Congrat1.jpg" width="350" height="60">      
                </td>
            </tr>
        </table>
    </center>
<br>

<center>
    <label for="" style="font-size:25px;"><b>ใบรับเงินบริจาค</b></label>
   
</center>
<br>
<center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="" style="font-size:25px;">เลขที่ &nbsp;{{$infocongrat->PERSON_DONATE_SUB_BOOKNO}}</label>
</center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for="" style="font-size:25px;">ผู้บริจาค : &nbsp;&nbsp;{{$infocongrat->DONATE_PERSON_NAME}}</label><br>

&nbsp;&nbsp;&nbsp;<label for="" style="font-size:25px;">เลขประจำตัวผู้เสียภาษีอากร : &nbsp;&nbsp;{{$infocongrat->DONATE_PERSON_VAT_NO}}</label>
<br>
&nbsp;&nbsp;&nbsp;<label for="" style="font-size:25px;">หน่วยรับบริจาค :&nbsp;&nbsp; {{$infoorg->ORG_NAME}}</label><br>
&nbsp;&nbsp;&nbsp;<label for="" style="font-size:25px;">ที่อยู่ &nbsp;&nbsp;{{$infoorg->ORG_ADDRESS}}</label>

&nbsp;&nbsp;&nbsp;<label for="" style="font-size:25px;">อำเภอ/เขต &nbsp;&nbsp;{{$infoorg->DISTRICT}}</label>
&nbsp;
&nbsp;<label for="" style="font-size:25px;">จังหวัด &nbsp;&nbsp;{{$infoorg->PROVINCE}}</label>
<br>
&nbsp;&nbsp;
<label for="" style="font-size:25px;">เป็นจำนวนเงิน &nbsp;&nbsp;{{number_format($infocongrat->PERSON_DONATE_SUB_PRICE,2)}}&nbsp; บาท</label>
<label for="" style="font-size:25px;">( {{convert(number_format($infocongrat->PERSON_DONATE_SUB_PRICE,2))}})</label>
&nbsp;
<label for="" style="font-size:25px;">วันที่ &nbsp;{{DateThaifrom(date('Y-m-d'))}}</label>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<center>
    @if ($sig == '')
    ........................................
    @else
        @if($checksig == 1 && $sig !== null && $sig !== '')
        <img src="{{Storage::path('public/images/'.$sig)}}" width="100" height="50">
        @endif 
    @endif
<br>
<label for="" style="font-size:25px;">({{$orgname->HR_PREFIX_NAME}} {{$orgname->HR_FNAME}} {{$orgname->HR_LNAME}})</label>
<br>
<label for="" style="font-size:25px;">ผู้มีอำนาจลงนาม</label>
<br>
</center>
<br>
<center>
<img src="image/Congrat2.jpg" width="400" height="50">
    </center>
</body>
</html>