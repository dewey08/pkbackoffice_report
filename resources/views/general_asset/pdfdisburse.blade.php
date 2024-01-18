
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
            font-size: 14px;
            line-height: 1;
       
        }



        .table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}

      
    </style>
   
</head>
<body>
<center><B style="font-size: 20px;">ใบเบิกพัสดุ|ครุภัณฑ์</B></center>


<table> <!-- only added this -->
  
      <tr>
        <td style="width: 400px"><b>จากหน่วยงาน </b>{{$inforequest->DEP_SUB_SUB_NAME}}</td>
        <td style="width: 200px"><b>เลขที่ใบเบิก </b>{{$inforequest->REQUEST_HEAD}} </td>
       
      </tr> 
      <tr>
        <td style="width: 400px"><b>ถึง </b> เจ้าหน้าที่พัสดุ </td>
        <td style="width: 200px"><b>วันบันทึกเบิก </b>{{formate($inforequest->DATE_TIME_SAVE)}}</td>
       
      </tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประเภทพัสดุครุภัณฑ์ และต้องการใช้สิ่งของถายใน {{formate($inforequest->DATE_WANT)}} 
        วัตถุประสงค์การเบิก เพื่อให้เพียงพอสำหรับให้บริการ<br>

<table class="table"> <!-- only added this -->
    <tr>
        <th style="width: 25px"><center>ลำดับ</center></th>
        <th style="width: 100"><center>หมายเลขครุภัณฑ์</center></th>
        <th style="width: 200" ><center>รายการ</center></th>
        <th style="width: 50px"><center>หน่วย</center></th>
        <th style="width: 25px"><center>จำนวน</center></th>
        <th style="width: 50px"><center>ราคารวม</center></th>
    </tr>
 
    <?php $number = 0; ?>
    @foreach ($infoassetrequestsubs as $infoassetrequestsub)  

    <?php $number++; ?>
    
    <tr>
        <td style="width: 25px word-break:break-all; word-wrap:break-word;">{{$number}}</td>
        <td style="width: 100px word-break:break-all; word-wrap:break-word;">{{$infoassetrequestsub->ASSET_REQUEST_SUB_NUMBER}}</td>
        <td style="width: 200px word-break:break-all; word-wrap:break-word;">{{$infoassetrequestsub->ASSET_REQUEST_SUB_DETAIL}}</td>
        <td style="width:50px; word-break:break-all; word-wrap:break-word;">
            {{$infoassetrequestsub->SUP_UNIT_NAME}}
        </td>
        <td style="width: 25px; word-break:break-all; word-wrap:break-word;">
           1
        </td>
        <td style="width: 50px; word-break:break-all; word-wrap:break-word;">
          
       {{number_format($infoassetrequestsub->ASSET_REQUEST_SUB_PRICE,2)}}
           
        </td>
    </tr>
   
    </tr>
    @endforeach   

</table>
<br>

<table class="table table-borderless" >
<tr style="border: none;" >
        <td style="width: 120px">
        
<center>
ลงชื่อ......................................................ผู้เบิก<br>
 (.................................................)<br>
ได้รับของเรียบร้อยเล้ว</center><br>
<center>
        </td>
        <td>
        <center>
        ผู้อนุมัติจ่าย......................................................<br>
        (.................................................)<br>
<center>
        </td>
</tr>
<tr>
        <td style="width: 120px">
        <center>
ลงชื่อ......................................................ผู้รับพัสดุ<br>
(.................................................)<br>
</center><br>
<center>
        </td>
        <td>
        <center>
        ผู้จ่าย......................................................<br>
        (.................................................)<br>

<center>
        </td>
</tr>

</table>
</body>
</html>