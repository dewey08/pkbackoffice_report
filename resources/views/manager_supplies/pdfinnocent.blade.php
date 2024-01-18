
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

        
    </style>
</head>
<body>
<center><B>แบบแสดงความบริสุทธิ์ใจในการจัดซื้อจัดจ้างทุกวิธีของหน่วยงาน<><BR>
ในการเปิดเผยข้อมูลความขัดแย้งทางผลประโยชน์ของหัวหน้าเจ้าหน้าที่ เจ้าหน้าที่ <br>
คณะกรรมการตรวจรับพัสดุ และผู้ตรวจรับพัสดุ</B><br>
<br>
<table>
<tr>
<td style="width: 430px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า {{$inforcon->COMMIT_HR_LEADER_NAME}}</td><td style="width: 100px">(หัวหน้าเจ้าหน้าที่)</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า {{$inforcon->COMMIT_HR_NAME}}</td><td>(เจ้าหน้าที่)</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า {{$conboardhread->BOARD_HR_NAME}}</td><td>(คณะกรรมการตรวจรับพัสดุ)</td>
</tr>

@foreach ($conboards as $conboard)  
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า {{$conboard->BOARD_HR_NAME}}</td><td>(คณะกรรมการตรวจรับพัสดุ)</td>
</tr>
@endforeach 

</table>
</center>
<br><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอให้คำรับรองว่าไม่มีความเกี่ยวข้องหรือมีส่วนได้ส่วนเสียไม่ว่าโดยตรงหรือโดยอ้อม หรือผลประโยชน์ใดๆ ที่ก่อให้เกิด ความขัดแย้ง ทางผลประโยชน์กับผู้ขาย ผู้รับจ้าง ผู้เสนองาน ผู้ชนะการประมูล หรือผู้มีส่วนเกี่ยวข้องที่เข้ามามีนิติสัมพันธ์ และวางตัวเป็นกลางในการดำเนินการ เกี่ยวกับการพัสดุ ปฏิบัติหน้าที่
ด้วยจิตสำนึก ด้วยความโปร่งใสสามารถให้มีผู้เกี่ยวข้อง ตรวจสอบได้ทุกเวลา มุ่งประโยชน์ส่วนรวมเป็นสำคัญ ตามที่ระบุไว้ในประกาศ 
สำนักงานปลัดกระทรวงสาธารณสุขว่าด้วย แนวทางปฏิบัติงานเพื่อตรวจสอบบุคลากรในหน่วยงานด้านการจัดซื้อจัดจ้าง พ.ศ. ๒๕๖๐
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หากปรากฏว่าเกิดความขัดแย้งทางผลประโยชน์ระหว่างข้าพเจ้ากับผู้ขาย ผู้รับจ้าง ผู้เสนองาน ผู้ชนะการประมูล หรือผู้มีส่วนเกี่ยวข้องที่เข้ามามีนิติสัมพันธ์ ข้าพเจ้าจะรายงานให้ทราบโดยทันที
<br><br><br>
<table>
<tr>
<td style="width: 400px">
<br><br>
ลงนาม......................................................................... <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_LEADER_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(หัวหน้าเจ้าหน้าที่)<br>
</td>
<td>
<br><br>
ลงนาม.........................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inforcon->COMMIT_HR_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(เจ้าหน้าที่)<br>
<td>
</tr>

<tr>
<td style="width: 300px">
<br><br>
ลงนาม......................................................................... <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$conboardhread->BOARD_HR_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ประธานกรรมการ/ผู้ตรวจรับพัสดุ)<br>
</td>
<?php $count = 0; ?>
@foreach ($conboards as $conboard) 
<?php $count++ ?>
 @if( $count == '1')
<td>
<br><br>
ลงนาม.........................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$conboard->BOARD_HR_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(กรรมการ) <br>
<td>
</tr>
 @endif
 @if( $count == '2')
<tr>
<td style="width: 300px">
<br><br>
ลงนาม.........................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$conboard->BOARD_HR_NAME}})<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(กรรมการ) <br>
</td>

</tr>
@endif
@endforeach 



</table>
<br><br><br>


</body>
</html>