
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
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

        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal; 
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
             font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 0.8;
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
    return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
    }


    ?>
</head>

<body>
<img src="image/Garuda.png" width="50" height="50">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
บันทึกข้อความ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br>
ส่วนราชการ &nbsp;&nbsp;&nbsp;
โรงพยาบาล สมมุติเทพ มหาเทพวชิรเทพ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
อำเภอ ด่านซ้าย
<br>
ที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลส/2563251450
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
วันที่&nbsp;{{DateThaifrom(date('Y-m-d'))}}
<br>
เรื่อง&nbsp;&nbsp;ขออนุมัติซื้อวัสดุประกอบอาหาร
<hr>
เรียน&nbsp;&nbsp;หัวหน้างานบริการอาหาร
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยงานบริการอาหาร&nbsp;มีความประสงค์จะขออนุมัติซื้อวัสดุเพื่อนำมาประกอบอาหารให้แก่ผู้ป่วยและนักศึกษาฝึกงาน
<br>
ตามรายละเอียดจำนวนผู้ป่วย &nbsp; นักศึกษาฝึกงาน&nbsp; และรายการจ่ายเงินค่าอาหารดังนี้
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-ผู้ป่วยสามัญ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คน 
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-ผู้ป่วยห้องพิเศษ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คน

<center>


รวมเป็นเงินทั้งสิ้น &nbsp;&nbsp;59,653.00&nbsp;บาท&nbsp;&nbsp;(ห้าหมื่นเก้าพันหกร้อยห้าสิบสามบาทถ้วน)
<br>
&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณาต่อไปด้วย
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
ลงชื่อ .........................................(นักโภชนาการ)
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
.............................................................................
</center>

เรียน  ผู้อำนวยการโรงพยาบาล สมมุติเทพ มหาเทพวชิรเทพ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ได้ตรวจสอบทะเบียนผู้ป่วยและวิธีการจัดซื้ออุปกรณ์ประกอบอาหาร  แล้วถูกต้องตามข้อเท็จจริง  เห็นควรอนุมัติ
ดำเนินการ จัดซื้อด้วยเงินบำรุงของโรงพยาบาล  ในอัตราค่าอาหารนักศึกษาฝึกงานคนละ 50.00 บาท/วัน <br>
ผู้ป่วยสามัญคนละ  80.00 บาท/วัน  ผู้ป่วยห้องพิเศษคนละ  150.00 บาท/วัน  หนังสือกรมบัญชีกลาง ที่ กค 0526.4/334  ลงวันที่  {{DateThaifrom(date('Y-m-d'))}} ,
หนังสือกรมบัญชีกลาง ที่ กค 0526.4/339  ลงวันที่  {{DateThaifrom(date('Y-m-d'))}} ,
<br>
หนังสือกรมบัญชีกลาง ที่ กค 0526.4/339  ลงวันที่  {{DateThaifrom(date('Y-m-d'))}} และตามหนังสือศาลากลางจังหวัดเลย 
<br>
ที่ ลย 3256/ว 1235 ลงวันที่  {{DateThaifrom(date('Y-m-d'))}} โดยไห้เจ้าหน้าที่ผู้มีนามต่อไปนี้เป็นผู้จัดซื้อวัสดุตามตารางเวร
<br>
ที่หัวหน้ากลุ่มการพยาบาลมอบหมายไห้ในแต่ละวัน คือ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<br>                                                                            
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
1.นาย สมจิตร &nbsp;&nbsp; ภักดีสมโภช &nbsp;&nbsp;&nbsp;&nbsp;  ตำแหน่ง &nbsp;&nbsp;&nbsp;&nbsp; นักโภชนาการ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
2.นาย สมจิตร &nbsp;&nbsp; ภักดีสมโภช &nbsp;&nbsp;&nbsp;&nbsp;  ตำแหน่ง &nbsp;&nbsp;&nbsp;&nbsp; นักโภชนาการ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
3.นาย สมจิตร &nbsp;&nbsp; ภักดีสมโภช &nbsp;&nbsp;&nbsp;&nbsp;  ตำแหน่ง &nbsp;&nbsp;&nbsp;&nbsp; นักโภชนาการ
<br>
และไห้เจ้าหน้าที่ ที่ได้รับมอบหมายจากหัวหน้ากลุ่มการพยาบาลเป็นผู้ตรวจรับวัสดุประกอบอาหารในแต่ละวัน และขอเบิกค่าวัสดุประกอบอาหาร&nbsp;
จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ
ตามจำนวนจริงเป็นเงิน 52,452.00  บาท
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(ลงชื่อ).....................................................(หัวหน้างานโภชนาศาสตร์)
<br>
ความเห็นหัวหน้าเจ้าหน้าที่พัสดุ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(นาง สายสมร  มาสมนึก)
<br>
&nbsp;&nbsp;&nbsp;-เห็นควรอนุมัติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
พยาบาลวิชาชีพชำนาญการ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นาย สมชายวัง   สานึกูล )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>อนุมัติ</b>
<br>
นักวิชาการสาธารณสุขชำนาญการ(หัวหน้าเจ้าหน้าที่พัสดุ)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
(นาย ภักดี สืบภานุ)
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{DateThaifrom(date('Y-m-d'))}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ผอ.รพร สมมุติเทพ มหาเทพวชิรเทพ
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ปฎิบัติการแทนผู้ว่าราชการจังหวัดเลย


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          


</body>
</html>