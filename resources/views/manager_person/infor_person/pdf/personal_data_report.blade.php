<!DOCTYPE html>
<html lang="en">
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
            padding: 10.00pt 7.1732pt 7.1732pt 40.00pt;             
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

    $dayNow = date("d");
    // $strDayThai= date("d",strtotime($dayNow));

    $monNow = date("M");
    $strMonth= date("n",strtotime($monNow));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];

    $yearNow = date("Y");
    $strYearThai = date("Y",strtotime($yearNow))+543;

    $dateThai = $dayNow.' '.$strMonthThai.' '.$strYearThai; 

    ?>
    


<body>
    
{{-- แบบฟอร์มรายละเอียด --}}
<div class="container">
    <div class="col-md-12" align="center">
        <h3><b>
            วันที่พิมพ์ใบรายงาน <?php echo $dateThai; ?>
        </b></h3>
    </div>
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><b>ข้อมูลการปฏิบัติราชการ</b></label>
    </div>
    <div class="col-md-12 font-content">
        <table winth="100%" border="0">
            <tr>
                <td>ชื่อ</td>
                <td>.......................</td>
                <td>วันเกิด</td>
                <td>.......................</td>
                <td>อายุ</td>
                <td>...... ปี</td>
                <td>
                    <span style="margin-left:5px;">วัน</span>
                    <span style="margin-left:5px;">เดือน</span>
                    <span style="margin-left:5px;">ปี</span>
                </td>
                <td>วันเกษียณอายุ</td>
                <td>
                    <span style="margin-left:5px;">วัน</span>
                    <span style="margin-left:5px;">เดือน</span>
                    <span style="margin-left:5px;">ปี</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <span>ตำแหน่งเลขที่ที่ครอง</span>
        <span style="margin-left:20px;">....................</span>
        <span style="margin-left:100px;">ตำแหน่ง</span>
        <span style="margin-left:20px;">.....................</span>
    </div>
    <div class="col-md-12 font-content">
        <span>ประเภท</span>
        <span style="margin-left:30px;">ทั่วไป</span>
        <span style="margin-left:70px;">ระดับ</span>
        <span style="margin-left:20px;">ชำนาญงาน</span>
        <span style="margin-left:70px;">เงินเดือน</span>
        <span style="margin-left:70px;">28,930</span>
        <span style="margin-left:10px;">บาท</span>
    </div>
    <div class="col-md-12 font-content">
        <span>ต้นสังกัด</span>
        <span style="margin-left:30px;">..........................</span>
    </div>
    <div class="col-md-12 font-content">
        <span>ปฏิบัติงานจริง</span>
        <span style="margin-left:30px;">..........................</span>
    </div>
    <div class="col-md-12 font-content">
        <span>กบช</span>
        <span style="margin-left:30px;">..........................</span>
    </div>
    <div class="col-md-12 font-content">
        <span>วันที่บรรจุครั้งแรก</span>
        <span style="margin-left:30px;">...........................</span>
        <span style="margin-left:50px;" >อายุราชการ</span>
        <span style="margin-left:10px;">21</span>
        <span style="margin-left:10px;">ปี</span>
        <span style="margin-left:10px;">วัน เดือน ปี</span>
    </div>
    <div class="col-md-12 font-content">
        <span>วันที่บรรจุกลับ</span>
        <span style="margin-left:30px;"></span>
    </div>
    <div class="col-md-12 font-content">
        <span>วันที่รับโอน</span>
        <span style="margin-left:30px;"></span>
    </div>
    <div class="col-md-12 font-content">
        <span>วันที่ให้โอน</span>
        <span style="margin-left:30px;"></span>
    </div>
    <div class="con-md-12 font-content">
        <table width="100%" border="0">
            <tr>
                <td width="50%">
                    <span>วันที่เข้าสู่หน่วยงานปัจจุบัน</span>
                    <span style="margin-left:30px;">5 ก.ค. 2545</span>
                </td>
                <td width="50%">
                    <span>เป็นระยะเวลา</span>
                    <span style="margin-left:30px;">18 ปี 1 เดือน 14 วัน</span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <span>วันเข้าสู่ระดับตาม พ.ร.บ. เดิม</span>
                    <span style="margin-left:30px;"></span>
                </td>
                <td width="50%">
                    <span>เป็นระยะเวลา</span>
                    <span style="margin-left:30px;"></span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <span>วันที่เข้าสู่ระดับปัจจุบัน</span>
                    <span style="margin-left:30px;"></span>
                </td>
                <td width="50%">
                    <span>เป็นระยะเวลา</span>
                    <span style="margin-left:30px;"></span>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <span>วุฒิในตำแหน่ง</span>
        <span style="margin-left: 30px;"></span>
    </div>
    <div class="col-md-12 font-content">
        <span>สาขา/วิชาเอก</span>
        <span style="margin-left: 30px;"></span>
    </div>
    <div class="col-md-12 font-content">
        <span>ได้รับเงินเดือนพิเศษ</span>
        <span style="margin-left:50px;"></span>
        <span style="margin-left:50px;">จำนวน</span>
    </div>
    <div class="col-md-12 font-content">
        <label style="text-decoration: underline;"><b>ข้อมูลส่วนตัวและครอบครัว</b></label>
    </div>
    <div class="con-md-12 font-content">
        <table width="100%" border="0">
            <tr>
                <td width="10%">
                    <span>บิดา</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;">นายมิตร เทมลา</span>
                </td>
                <td width="10%" align="center">
                    <span>สกุลเดิม</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;"></span>
                </td>
            </tr>
            <tr style="margin-top:10px;">
                <td width="10%">
                    <span>มารดา</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;">ชื่อ - นามสกุล</span>
                </td>
                <td width="10%" align="center">
                    <span>สกุลเดิม</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;"></span>
                </td>
            </tr>
            <tr style="margin-top:10px;">
                <td width="10%">
                    <span>คู่สมรส</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;">ชื่อ - นามสกุล</span>
                </td>
                <td width="10%" align="center">
                    <span>สกุลเดิม</span>
                </td>
                <td width="40%">
                    <span style="margin-left:10px;"></span>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <span>จำนวนบุตร</span>
        <span style="margin-left:20px;">.........</span>
    </div><br><br><br>
    <div class="col-md-12 font-content">
        <div align="right">
            <label style="margin-top:10px; margin-right:70px;">ตวรจสอบแล้ว</label><br><br>
            <label style="margin-top:10px; margin-right:50px;">(...............................)</label><br><br>
            <label style="margin-top:10px; margin-right:30px;">
                <span>วันที่ตรวจสอบ</span>
                <span>.........................</span>
            </label>
        </div>
    </div>
</div>

{{-- ตำแหน่งและอัตราเงินเดือน --}}
<div class="container" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ตำแหน่งและอัตราเงินเดือน</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="10%">วัน เดือน ปี</td>
                    <td width="20%" class="table-border-left">ตำแหน่ง</td>
                    <td width="15%" class="table-border-left">เลขที่ ตำแหน่ง</td>
                    <td width="10%" class="table-border-left">ระดับ</td>
                    <td width="10%" class="table-border-left">อัตราเงินเดือน</td>
                    <td width="20%" class="table-border-left">เอกสารอ้างอิง</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1 เม.ย. 2542</td>
                    <td class="table-border-left">
                        <div style="margin-left:10px;">
                            บรรจุผู้ได้รับคัดเลือก (ม.50) เจ้าพนักงาน ทันตสาธารณสุข 2 สอ.ปากช่อง
                        </div>
                    </td>
                    <td class="table-border-left" align="center">149111</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left" align="center">5,180</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            จ.เพชรบูรณ์ 2159/42 ลว.28 ก.ย.42
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ข้อมูลการศึกษา --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ข้อมูลการศึกษา</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="10%">ลำดับ</td>
                    <td width="20%" class="table-border-left">วันที่จบ</td>
                    <td width="15%" class="table-border-left">วุฒิการศึกษา</td>
                    <td width="10%" class="table-border-left">สาขา/วิชาเอก</td>
                    <td width="10%" class="table-border-left">สถาบัน</td>
                    <td width="20%" class="table-border-left">ประเทศ</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">31 มี.ค. 2542</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            ประกาศนียบัตรสาธารณสุข
                        </div>
                    </td>
                    <td class="table-border-left" align="center">ทันตสาธารณสุข</td>
                    <td class="table-border-left" align="center">วสส.ชลบุรี</td>
                    <td class="table-border-left" align="center">ไทย</td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td class="table-border-left" align="center">31 มี.ค. 2542</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            ประกาศนียบัตรสาธารณสุข
                        </div>
                    </td>
                    </td>
                    <td class="table-border-left" align="center">ทันตสาธารณสุข</td>
                    <td class="table-border-left" align="center">วสส.ชลบุรี</td>
                    <td class="table-border-left" align="center">ไทย</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ใบประกอบวิชาชีพ --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ใบประกอบวิชาชีพ</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="10%">ใบประกอบวิชาชีพ</td>
                    <td width="5%" class="table-border-left">เลขที่</td>
                    <td width="10%" class="table-border-left">สถาบันที่ออก</td>
                    <td width="10%" class="table-border-left">ออกให้ ณ วันที่</td>
                    <td width="7%" class="table-border-left">หมดอายุวันที่</td>
                    <td width="7%" class="table-border-left">ต่ออายุครั้งที่</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ข้อมูลอบรมดูงาน --}}
<div class="container page_break" style="margin-top:100px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ข้อมูลอบรมดูงาน</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="5%">ลำดับ</td>
                    <td width="10%" class="table-border-left">ตั้งแต่วันที่</td>
                    <td width="10%" class="table-border-left">ถึงวันที่</td>
                    <td width="30%" class="table-border-left">หลักสูตร</td>
                    <td width="10%" class="table-border-left">สถาบัน</td>
                    <td width="10%" class="table-border-left">ประเทศ</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left" align="center">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ข้อมูลเครื่องราชอิสริยาภรณ์ --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ข้อมูลเครื่องราชอิสริยาภรณ์</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="5%">ปี</td>
                    <td width="20%" class="table-border-left">ชั้นตราเครื่องราชอิสริยาภรณ์</td>
                    <td width="5%" class="table-border-left">เล่มที่</td>
                    <td width="5%" class="table-border-left">ตอนที่</td>
                    <td width="20%" class="table-border-left">วันที่ประกาศราชกิจจานุเบกษา</td>
                    <td width="5%" class="table-border-left">หน้าที่</td>
                    <td width="5%" class="table-border-left">ลำดับที่</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">2547</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            จัตุรถาภรณ์มงกุฏไทย
                        </div>
                    </td>
                    <td class="table-border-left" align="center">122</td>
                    <td class="table-border-left" align="center">11 ช</td>
                    <td class="table-border-left" align="center">23 ก.ค. 2548</td>
                    <td class="table-border-left" align="center">128</td>
                    <td class="table-border-left" align="center">920</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ข้อมูลประเมินผลงานทางวิชาการ --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ข้อมูลประเมินผลงานทางวิชาการ</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="12%">วันที่รับคำขอ</td>
                    <td width="10%" class="table-border-left">ประเภท</td>
                    <td width="20%" class="table-border-left">ขอแต่งตั้งเป็น</td>
                    <td width="7%" class="table-border-left">ครั้งที่</td>
                    <td width="10%" class="table-border-left">วันที่ประเมิน</td>
                    <td width="15%" class="table-border-left">สถานะการพิจารณา</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left" align="center">2</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                    <td class="table-border-left" align="center">6</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- โทษทางวินัย --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>โทษทางวินัย</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="12%">วันที่มีผล</td>
                    <td width="20%" class="table-border-left">กรณีความผิด</td>
                    <td width="20%" class="table-border-left">โทษที่ได้รับ</td>
                    <td width="20%" class="table-border-left">เลขที่คำสั่ง</td>
                    <td width="20%" class="table-border-left">หมายเหตุ</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            2
                        </div>
                    </td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                    <td class="table-border-left" align="center">4</td>
                    <td class="table-border-left" align="center">5</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

{{-- ข้อมูลระยะเวลาการดำรงตำแหน่ง --}}
<div class="container page_break" style="margin-top:20px;">
    <div class="col-md-12 font-content">
        <br>
        <label style="text-decoration: underline;"><center><b>ข้อมูลระยะเวลาการดำรงตำแหน่ง</b></center></label>
    </div>
    <div class="col-md-12 font-cntent" style="margin-top:20px;">
        <table width="100%" border="0">
            <tr>
                <td width="2%">ชื่อ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        {{-- {{ $hrd_person->HR_FNAME }} {{ $hrd_person->HR_LNAME }} --}}
                    </span>
                </td>
                <td width="5%" align="center">ระดับ</td>
                <td width="10%">
                    <span style="margin-left:10px;">
                        .....................
                    </span>
                </td>
                <td width="30%">กระทรวงสาธารณสุข กรมสำนักงานปลัดกระทรวง</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 font-content" style="margin-top:20px;">
        <table width="100%" border="0" class="table-border">
            <thead class="table-border-bottom">
                <tr align="center">
                    <td width="20%">
                        <table width="100%">
                            <tr align="center">
                                <td class="table-sub-border-bottom">
                                    ระยะเวลาการดำรงตำแหน่ง<br>
                                    ในสายงานอื่นที่นำมา<br>
                                    นับเกื้อกูล
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr align="center">
                                <td width="50">ตั้งแต่วันที่</td>
                                <td width="50" class="table-sub-border-left">ถึงวันที่</td>
                            </tr>
                        </table>
                    </td>
                    <td width="20%" class="table-border-left">กรณีความผิด</td>
                    <td width="20%" class="table-border-left">โทษที่ได้รับ</td>
                </tr>
            </thead>
            <tbody height="100">
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            2
                        </div>
                    </td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            2
                        </div>
                    </td>
                    <td class="table-border-left">
                        <div style="margin-left: 10px;">
                            3
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 font-content">
        <div align="right">
            วิไชยัน <?php echo $dateThai ?>
        </div>
    </div>
</div>

</body>
</html>
