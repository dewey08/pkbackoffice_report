<?php
use Illuminate\Support\Facades\Storage;
function dayThai($strDate)
{
  $strDay= date("j",strtotime($strDate));

  return $strDay;
  }

function monthThai($strDate)
{

  $strMonth= date("n",strtotime($strDate));
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์ ","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return $strMonthThai;
  }

  function yearThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  return $strYear;
  }

  
  function Removeformate($strDate)
  {
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  $strMonthCut = Array("","มกราคม","กุมภาพันธ์ ","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  if( $strDay < 10){
    $strDay = substr($strDay,1);
  }

  return $strDay." ".$strMonthThai." ".$strYear;
  }
    //$datnow = date("Y-m-j"); 

    $date=date_create($inforleave->created_at);
    $datnow =  date_format($date,"Y-m-j");

?>

<?php
define('FPDF_FONTPATH','font/');
require(base_path('public')."/fpdf/WriteHTML.php");
$pdf=new PDF();
$pdf->AddPage();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew Bold','','THSarabunNew Bold.php');
$pdf->SetFont('THSarabunNew Bold','',16);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                                             แบบใบลาอุปสมบท<br><br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             
                                                    เขียนที่   '));

$pdf->SetFont('THSarabunNew','',15);
$data1= " ".$orgname->ORG_NAME;
$data1.= "<br>
                                                                                                      วันที่   ".dayThai($datnow)."    เดือน ".monthThai($datnow)."  พ.ศ.  ".yearThai($datnow);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data1));

 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>           เรื่อง  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ลาอุปสมบท'));
 

 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>           เรียน  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));
 

$pdf->SetFont('THSarabunNew','',14);
$pdf->Text(45,60,iconv( 'UTF-8','TIS-620','   ข้าพเจ้า '.$inforleave->LEAVE_PERSON_FULLNAME));
$pdf->Text(125,60,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforperson->POSITION_IN_WORK));


$pdf->Text(25,67,iconv( 'UTF-8','TIS-620','สังกัด '.$inforperson->HR_DEPARTMENT_SUB_NAME));

$pdf->Text(25,75,iconv( 'UTF-8','TIS-620','เกิดวันที่ '.dayThai($inforperson->HR_BIRTHDAY).'  เดือน    '.monthThai($inforperson->HR_BIRTHDAY).'    พ.ศ. '.yearThai($inforperson->HR_BIRTHDAY)));
$pdf->Text(90,75,iconv( 'UTF-8','TIS-620','เข้ารับราชการเมื่อวันที่ '.dayThai($inforperson->HR_WORK_REGISTER_DATE).'  เดือน    '.monthThai($inforperson->HR_WORK_REGISTER_DATE).'    พ.ศ. '.yearThai($inforperson->HR_WORK_REGISTER_DATE)));
// $pdf->Text(10,83,iconv( 'UTF-8','TIS-620','พ.ศ'));

$pdf->Text(25,83,iconv( 'UTF-8','TIS-620','ข้าพเจ้า'));
$pdf->SetFont('THSarabunNew','',14);
$pdf->Text(50,83,iconv( 'UTF-8','TIS-620','ยังไม่เคย'));
$pdf->Text(79,83,iconv( 'UTF-8','TIS-620','เคย อุปสมบท'));
// $pdf-> Image('fpdf/img/checkno.jpg',43,79,4.5,4.5);
// $pdf-> Image('fpdf/img/checkno.jpg',72,79,4.5,4.5);

if($inforleave->LEAVE_TYPE_CODE == '05'){ 
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',43,79,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',72,79,4.5,4.5);
}else{
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',43,79,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',72,79,4.5,4.5);
}



$pdf->Text(43,91,iconv( 'UTF-8','TIS-620','บัดนี้ มีศรัทธาจะอุปสมบทในพระพุทธศาสนา ณ วัด '.$inforleave->ODEIN_TEMPLE));
$pdf->Text(25,99,iconv( 'UTF-8','TIS-620','ตั้งอยู่ ณ '.$inforleave->ODEIN_TEMPLE_ADD));
$pdf->Text(25,109,iconv( 'UTF-8','TIS-620','กำหนดอุปสมบท วันที่ '.dayThai($inforleave->ODEIN_DATE).'  เดือน    '.monthThai($inforleave->ODEIN_DATE).'    พ.ศ. '.yearThai($inforleave->ODEIN_DATE)));
$pdf->Text(104,109,iconv( 'UTF-8','TIS-620','และจำพรรษาอยู่ ณ วัด'.$inforleave->ODEN_TEMPLE_LIVE));
$pdf->Text(25,118,iconv( 'UTF-8','TIS-620','ตั้งอยู่ ณ '.$inforleave->ODEN_TEMPLE_LIVE_ADD));
$pdf->Text(25,127,iconv( 'UTF-8','TIS-620','ตั้งแต่วันที่ '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_BEGIN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN)));
$pdf->Text(90,127,iconv( 'UTF-8','TIS-620','ถึงวันที่ '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_END).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END)));

if($inforleave->WORK_DO == 0.5){ 
  $dateresultwork = 'ครึ่ง';
}else{
  $dateresultwork = number_format($inforleave->WORK_DO);
}

$pdf->Text(25,136,iconv( 'UTF-8','TIS-620','มีกำหนด '.$dateresultwork.' วัน'));

if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig1),105,135.5,20,10);
}

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(90,146,iconv( 'UTF-8','TIS-620','ลงชื่อ.........................................................'));
$pdf->Text(100,156,iconv( 'UTF-8','TIS-620','('.$inforleave->LEAVE_PERSON_FULLNAME.')'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(15,176,iconv( 'UTF-8','TIS-620','         ความเห็นผู้บังคับบัญชา ...........................................................................................................................................................'));


if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig2),105,175.5,20,10);
}
$pdf->Text(90,186,iconv( 'UTF-8','TIS-620','ลงชื่อ..........................................................'));
$pdf->Text(105,196,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
$pdf->Text(100,206,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK));
$pdf->Text(90,216,iconv( 'UTF-8','TIS-620','วันที่........../.........................../...................'));


$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->Text(15,220,iconv( 'UTF-8','TIS-620','         คำสั่ง'));
$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(29,230,iconv( 'UTF-8','TIS-620','       อนุญาต'));
$pdf->Text(55,230,iconv( 'UTF-8','TIS-620','       ไม่อนุญาต'));


if($inforleave->LEAVE_STATUS_CODE == 'Allow'){ 
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',30,226,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',57,226,4.5,4.5);
}else{
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',30,226,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.png',57,226,4.5,4.5);
}

// $pdf-> Image('fpdf/img/checkno.jpg',23,227,4.5,4.5);
// $pdf-> Image('fpdf/img/checkno.jpg',49,227,4.5,4.5);
$pdf->Text(15,240,iconv( 'UTF-8','TIS-620','        ..............................................................................................................................................................................................'));


if($checksig == 1 && $sig4 !== null && $sig4 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig4),105,240.5,20,10);
}
$pdf->Text(90,250,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(105,260,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(100,270,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(90,280,iconv( 'UTF-8','TIS-620','วันที่........../.........................../..............'));
$pdf->Output();
exit;

?>
