
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
            line-height: 0.8;
            padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
        }

        .text-pedding{
            padding-left:10px;
            padding-right:10px;
        }
        .table_temdelivery thead th,.table_temdelivery td{
            border:solid 1px black;
            text-align:center;
            vertical-align:middle;
        }
    </style>
</head>

<body class="position-relative">
<div style="font-size:18px;" class="text-center"><b>ใบส่งของชั่วคราว</b></div>
<br>
<p style="margin:0px">วันที่ {{dateThaifromFull(date('Y-m-d'))}}</p>
<p style="margin:0px">ข้าพเจ้า นาย.... ... ขอส่งวัสดุประกอบอาหาร ตามรายละเอียดดังนี้</p>
<table class="table_temdelivery" style="width:100%">
    <colgroup>
        <col width="">
    </colgroup>
    <thead style="font-size:13px;font-weight:800">
        <tr>
            <th rowspan="2">ลำดับ</th>
            <th rowspan="2">รายการ</th>
            <th rowspan="2">หน่วยงาน</th>
            <th colspan="2">จำนวน</th>
            <th>รวมเงิน</th>
            <th colspan="2">ผลการตรวจจับ</th>
            <th rowspan="2">หมายเหตุ</th>
        </tr>
        <tr>
            <th>จำนวน</th>
            <th>ราคาต่อหน่วย</th>
            <th>บาท</th>
            <th>ครบ</th>
            <th > ไม่ครบ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
            <td style="text-align:right">12</td>
            <td style="text-align:right">0</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="4">ยอดรวม</td>
            <td style="text-align:right">0</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
<br>
<table style="width:100%">
    <tr>
        <td width="50%" style="text-align:left">ลงชื่อ.................................................ผู้ส่งของ</td>
        <td width="50%" style="text-align:right">ลงชื่อ.................................................ผู้รับรอง</td>
    </tr>
</table>
<p>MMIJ</p>
</body>
</html>