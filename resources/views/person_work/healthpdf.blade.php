
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }
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
            font-size: 14px;
            line-height: 1;
       
        }
        input.largerCheckbox { 
            transform : scale(10); 
        } 
       
      
    </style>
</head>
<?php

function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }

?>
<body>
<center>
<B style="font-size: 20px;">หนังสือรับรองการตรวจสุขภาพประจำปี</B> <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

เขียนที่ &nbsp;{{$org->ORG_NAME}}
<br>
<B style="font-size: 14px;">วันที่ {{DateThai(date('Y-m-d'))}}</B><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for="">ข้าพเจ้า {{$inforperson->HR_PREFIX_NAME}} {{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}} อายุ {{$infomation->HEALTH_SCREEN_AGE}} ปี
หน่วยงานต้นสังกัด {{$inforperson->HR_DEPARTMENT_SUB_SUB_NAME}} </label><br> 
<label for="">เลขบัตร {{$inforperson->HR_CID}}  ที่อยู่ บ้านเลขที่ {{ $inforperson -> HR_HOME_NUMBER }}  หมู่ที่ {{ $inforperson -> HR_VILLAGE_NO }} ถนน {{  $inforperson -> HR_ROAD_NAME }} ซอย {{ $inforperson -> HR_SOI_NAME }} ตำบล  {{ $inforperson -> TUMBON_NAME }} อำเภอ {{ $inforperson -> AMPHUR_NAME }} จังหวัด {{ $inforperson -> PROVINCE_NAME }}  รหัสไปรษณีย์  {{ $inforperson -> HR_ZIPCODE }}
ได้เข้ารับการตรวจสุขภาพประจำปี &nbsp;&nbsp; ที่ {{$org->ORG_NAME}} &nbsp;&nbsp; เมื่อวันที่..............................................
</label><br>
<label for="">เป็นเงิน {{number_format($sumamount,2)}} บาท ตามรายการดังนี้</label>
<br>
</center>
<br>
<center>


<table class="gwt-table table-striped table-vcenter" width="100%">
<thead style="background-color: #FFEBCD;">
                <tr height="20">
                    <th style="text-align: center;">รหัสรายการ</th>
                    <th style="text-align: center;">รายการ</th>  
                    <th style="text-align: center;">จำนวน</th>  
                    <th style="text-align: center;">ราคาต่อหน่วย</th>  
                    <th style="text-align: center;">ราคารวม</th>                                      
                </tr>
                </thead>
                <tbody>
                   
                @foreach ($infolabs as $infolab)  
                <tr height="10">                  
                    <td class="text-font text-pedding">
                    {{$infolab->HEALTH_SCREEN_CON_CODE}}
                    </td>   
                    <td class="text-font text-pedding"> 
                    {{ $infolab->HEALTH_SCREEN_CON_NAME}}
                    </td>  
                    <td class="text-font text-pedding" style="text-align: center;"> 
                    {{$infolab->HEALTH_SCREEN_CON_AMOUNT}}
                    </td>    
                    <td class="text-font text-pedding" style="text-align: right;"> 
                    {{number_format($infolab->HEALTH_SCREEN_CON_PICE,2)}}
                    </td>    
                    <td class="text-font text-pedding" style="text-align: right;"> 
                    {{number_format($infolab->HEALTH_SCREEN_CON_SUMPICE,2)}}
                    </td>                          
                </tr>
                @endforeach  
                <tr height="10"> 
                    <td colspan="4" class="text-font text-pedding" style="text-align: center;">
                    รวมเป็นเงิน
                    </td>
                    <td class="text-font text-pedding" style="text-align: right;">
                    {{number_format($sumamount,2)}}
                    </td>
                </tr>
                </tbody> 
          </table><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ...........................................เจ้าหน้าที่ รพ.<br>


( {{$inforperson->HR_PREFIX_NAME}} {{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}})<br>


ตำแหน่ง {{$inforperson->POSITION_IN_WORK }}<br>
<!-- </div> -->
</center>


