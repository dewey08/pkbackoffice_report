
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('asset/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- icon -->
    <style>
        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal;  
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal; 
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
 
 
        body {
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 1;
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

    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return $strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear;
    }
    ?>
    <style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>

<body>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<label style="font-size:18px;"><b>ใบสำคัญจ่ายเงินค่าอาหาร  อาหารผู้ป่วยใน</b></label>
<br>
ข้าพเจ้าผู้นามข้างท้ายนี้ ได้ร่วมกันจัดซื้อวัตถุดิบ เพื่อไปประกอบอาหารให้ผู้ป่วยของ {{$orgname->ORG_NAME}} 
<br>
วันที่&nbsp;{{DateThaifrom($foodbillday->FOOD_BILL_DAY_DATE)}}
<br>
<br>
<table width="100%">
  <tr>
    <td rowspan="2"style="text-align: center;" width="5%">ลำดับ</td>    
    <td rowspan="2" style="text-align: center;">รายการ</td>  
    <th colspan="2" width="15%" style="text-align: center;font-size:12px;">จำนวน</th>    
    <th colspan="2" width="12%" style="text-align: center;font-size:12px;">จำนวนเงิน</th>   
    <th colspan="2" width="14%" style="text-align: center;font-size:12px;">ผลการตรวจรับ</th>  
    <td rowspan="2"  width="15%" style="text-align: center;">รายการอาหารประจำวัน</td> 
    
  </tr>
  <tr>      
    <td style="text-align: center;">จำนวน/หน่วย</td>
    <td style="text-align: center;">ราคา/หน่วย</td>   
    <td style="text-align: center;">บาท</td>
    <td style="text-align: center;">สตางค์</td>
    <td style="text-align: center;">ผ่าน</td>  
    <td style="text-align: center;">ไม่ผ่าน</td>        
  </tr>

  
  <?php $number = 0; ?>
    @foreach ($foodindexstaples as $foodindexstaple)  
 <?php $number++; ?>

  <tr>
    <td style="text-align: center;">{{$number}}</td>
    <td style="text-align: left;" class="text-pedding">{{$foodindexstaple->SUP_NAME}}</td>
    <td style="text-align: center;">{{$foodindexstaple->FOOD_INDEX_STAPLE_BUY_TOTAL}} / {{$foodindexstaple->FOOD_UNIT_NAME}}</td>
    <td style="text-align: center;">{{number_format($foodindexstaple->FOOD_INDEX_STAPLE_PERUNIT,2)}}</td>
    <td style="text-align: center;">{{number_format($foodindexstaple->FOOD_INDEX_STAPLE_PICE,2)}}</td>
  

    <td style="text-align: center;">  </td>
    <td style="text-align: center;">  </td>
    <td style="text-align: center;">  </td>
    <td>  </td>
  </tr>
  @endforeach

</table>
<br>
<table  class="table gwt-table">
    <tr height="10">           
        <td class="width= 100px" style="border: 1px solid black;text-align: center;">มื้อเช้า</td>
        <td class="width= 100px" style="border: 1px solid black;text-align: center;">มื้อเที่ยง</td>                          
        <td class="width= 100px" style="border: 1px solid black;text-align: center;">มื้อเย็น</td> 
    </tr>   
    <tr height="10">           
        <td >
        @foreach ($foodindexmenu1s as $foodindexmenu1)  
        {{$foodindexmenu1->FOOD_MENU_NAME}}&nbsp;
        @endforeach
        </td>
        <td >
        @foreach ($foodindexmenu2s as $foodindexmenu2)  
        {{$foodindexmenu2->FOOD_MENU_NAME}}&nbsp;
        @endforeach
        
        </td>                          
        <td >
        @foreach ($foodindexmenu3s as $foodindexmenu3)  
        {{$foodindexmenu3->FOOD_MENU_NAME}}&nbsp;
        @endforeach
        </td> 
    </tr>   
</table>  
   
<table> <tr><td  style="border: 1px solid rgb(255, 255, 255)">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    รวมเป็นเงินทั้งสิ้น&nbsp;&nbsp;{{number_format($sumtotal,2)}} บาท &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตัวอักษร ( {{convert(number_format($sumtotal,2))}}  )
    <br>
 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ลงชื่อ.....................................( ผู้จัดสั่งซื้อ )
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ข้าพเจ้าได้ตรวจสอบวัตถุดิบประกอบอาหารตามชนิดและจำนวนข้างต้นไปเพื่อประกอบอาหารให้ผู้ป่วย
    <br>
    และนักศึกษาฝึกงาน  {{$orgname->ORG_NAME}} ถูกต้องแล้ว
    <br>
 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ลงชื่อ.....................................( ผู้ตรวจรับวัตถุประกอบอาหาร )
    <br>
    เรียน  ผู้อำนวยการ  {{$orgname->ORG_NAME}} 
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ได้ตรวจสอบทะเบียนผู้ป่วยและวิธีการดำเนินการจัดซื้อวัสดุอาหารถูกต้องตามข้อเท็จจริงและเป็นตามระเบียบแล้ว
    <br>
    เห็นควรอนุมัติให้จ่ายได้
    <br>
   
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ลงชื่อ.....................................( หัวหน้าฝ่ายบริหาร ฯ )
    <br>
    อนุมัติให้จ่ายเงิน &nbsp;&nbsp; จำนวน &nbsp;{{number_format($sumtotal,2)}} บาท  ( {{convert(number_format($sumtotal,2))}} )
    <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    (.................................................)<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
    ผอ.{{$orgname->ORG_NAME}} 
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    {{$orgname->HR_PREFIX_NAME}}  {{$orgname->HR_FNAME}}  {{$orgname->HR_LNAME}} 

</td></tr>
</table> 
</body>
</html>