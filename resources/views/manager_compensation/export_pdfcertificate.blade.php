
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal;  
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }


 
 
        body {
            font-family: "THSarabunNew";
            font-size: 22px;
            line-height: 0.9;
            padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
       
        }

        .text-pedding{
    padding-left:10px;
    padding-right:10px;
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
    return thainumDigit($strDay.' เดือน'.$strMonthThai.'  พ.ศ. '.$strYear);
    }


    ?>
</head>

<body>
<center>
<img src="image/Garuda.png" width="100" height="110"><br>
ที่ {{thainumDigit($hrddepartment->BOOK_NUM.'/')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{{$infoorg->ORG_NAME}}                                                                                
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อำเภอ{{$infoorg->DISTRICT}}&nbsp;จังหวัด{{thainumDigit($infoorg->PROVINCE)}}</label>

</center>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infoorg->ORG_NAME}} ขอรับรองว่า  {{$infocertificate->CER_HR_PERSON_NAME}}   {{$infocertificate->HR_PERSON_TYPE_NAME}} ตำแหน่ง {{$infocertificate->POSITION_IN_WORK}}{{$infocertificate->HR_LEVEL_NAME}} 
{{$infocertificate->HR_DEPARTMENT_SUB_SUB_NAME}} {{$infocertificate->HR_DEPARTMENT_SUB_NAME}} {{thainumDigit($infoorg->ORG_NAME)}}  สำนักงานสาธารณสุขจังหวัด{{thainumDigit($infoorg->PROVINCE)}} มีรายได้ดังต่อไปนี้</label>
<center>
    <br>
    <br>
<table  width="50%">
<?php $number=0;?>
@foreach ($infocersubs as $infocersub)
   
    @if($infocersub->CERSUB_AMOUNT !== null && $infocersub->CERSUB_AMOUNT !== '')
    <?php $number++;?>
        <tr>
            <td width="130px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{thainumDigit($number)}}.&nbsp;&nbsp;</label></td>
            <td width="200px;">{{$infocersub->CERSUB_RECEIVE_NAME}}</label>
            <td class="text-pedding" ><label for="" style="text-align: right;">{{thainumDigit(number_format($infocersub->CERSUB_AMOUNT,2))}}</label></td>
            </td>
            <td><label for="" >บาท</td>
        </tr>
    @endif
@endforeach  

</table>
<br>
</center>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
รวมทั้งสิ้น {{thainumDigit(number_format($suminfocersum,2))}} บาท &nbsp;&nbsp;({{convert(number_format($suminfocersum,2))}})</label>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงออกหนังสือรับรองให้ไว้เป็นหลักฐาน</label>
<br>
<br>

<center>
ให้ไว้ ณ วันที่&nbsp;&nbsp;{{DateThaifrom(date('Y-m-d'))}}
<br>
<br>
<br>
<br>
<br>
<br>
<br>
({{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}}&nbsp;&nbsp;{{$infoorg->HR_LNAME}}) 
<br>
ผู้อำนายการ{{$infoorg->ORG_NAME}}
</center>
            


</body>
</html>