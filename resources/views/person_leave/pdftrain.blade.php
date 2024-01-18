<?php

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
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             แบบใบลาไปศึกษา ฝึกอบรม ปฎิบัติการวิจัยหรือดูงาน<br><br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             
                                                    เขียนที่   '));

$pdf->SetFont('THSarabunNew','',15);
$data1= " ".$orgname->ORG_NAME;
$data1.= "<br>
                                                                                                         วันที่  ".dayThai($datnow)."   เดือน ".monthThai($datnow)."  พ.ศ. ".yearThai($datnow);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data1));



 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>      เรื่อง  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ลาไปศึกษา ฝึกอบรม ปฎิบัติการวิจัยหรือดูงาน <br>'));

 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>      เรียน  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));
 

$pdf->SetFont('THSarabunNew','',14);
$pdf->Text(25,58,iconv( 'UTF-8','TIS-620','   ข้าพเจ้า '.$inforleave->LEAVE_PERSON_FULLNAME));
$pdf->Text(100,58,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforperson->POSITION_IN_WORK));
$pdf->Text(15,66,iconv( 'UTF-8','TIS-620','   สังกัด '.$inforperson->HR_DEPARTMENT_SUB_NAME));
$pdf->Text(100,66,iconv( 'UTF-8','TIS-620','เกิดวันที่ '.dayThai($inforperson->HR_BIRTHDAY).'  เดือน    '.monthThai($inforperson->HR_BIRTHDAY).'    พ.ศ. '.yearThai($inforperson->HR_BIRTHDAY)));
$pdf->Text(15,75,iconv( 'UTF-8','TIS-620','   เข้ารับราชการเมื่อวันที่ '.dayThai($inforperson->HR_WORK_REGISTER_DATE).'  เดือน    '.monthThai($inforperson->HR_WORK_REGISTER_DATE).'    พ.ศ. '.yearThai($inforperson->HR_WORK_REGISTER_DATE)));
$pdf->Text(90,75,iconv( 'UTF-8','TIS-620','รับเงินเดือน เดือนละ  '.number_format($inforperson->HR_SALARY,2).' บาท'));


$pdf->Text(15,83,iconv( 'UTF-8','TIS-620','   มีความประสงค์ขอลาไป'));
// $pdf->Text(160,83,iconv( 'UTF-8','TIS-620','บาท'));
$pdf->Text(30,91,iconv( 'UTF-8','TIS-620','ศึกษาวิชา '.$inforleave->EDU_SUBJECT));
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',23,87,4.5,4.5);
$pdf->Text(90,91,iconv( 'UTF-8','TIS-620','ชั้นปริญญา '.$inforleave->EDU_BRANCH));
$pdf->Text(15,99,iconv( 'UTF-8','TIS-620','   ณ สถานศึกษา '.$inforleave->EDU_ACADEMY));
$pdf->Text(90,99,iconv( 'UTF-8','TIS-620','ประเทศไทย '));
$pdf->Text(15,108,iconv( 'UTF-8','TIS-620','   ด้วยทุน'.$inforleave->EDU_TON));
$pdf->Text(30,117,iconv( 'UTF-8','TIS-620','ฝึกอบรม'));
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',23,113,4.5,4.5);
$pdf->Text(67,117,iconv( 'UTF-8','TIS-620','ปฎิบัติการวิจัย'));
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',60,113,4.5,4.5);
$pdf->Text(110,117,iconv( 'UTF-8','TIS-620','ดูงาน ด้าน/หลักสูตร '.$inforleave->EDU_T_COURSE));
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',103,113,4.5,4.5);
$pdf->Text(15,126,iconv( 'UTF-8','TIS-620','   ณ '.$inforleave->EDU_T_LOCATION));
$pdf->Text(90,126,iconv( 'UTF-8','TIS-620','ประเทศไทย'));
$pdf->Text(15,135,iconv( 'UTF-8','TIS-620','   ด้วยทุน'.$inforleave->EDU_TON));
$pdf->Text(15,144,iconv( 'UTF-8','TIS-620','   ทั้งนี้ตั้งแต่วันที่ '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_BEGIN).'     พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN)));
$pdf->Text(90,144,iconv( 'UTF-8','TIS-620','ถึงวันที่ '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_END).'  พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END)));

if($inforleave->WORK_DO == 0.5){ 
  $dateresultwork = 'ครึ่ง';
}else{
  $dateresultwork = number_format($inforleave->WORK_DO);
}

$pdf->Text(15,153,iconv( 'UTF-8','TIS-620','   มีกำหนด     '.$dateresultwork.'     วัน'));
$pdf->Text(90,153,iconv( 'UTF-8','TIS-620','ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่'));
$pdf->Text(15,162,iconv( 'UTF-8','TIS-620','   โทรศัพท์ '.$inforleave->LEAVE_CONTACT_PHONE));

$pdf->Text(30,171,iconv( 'UTF-8','TIS-620','   ข้าพเจ้าขอรับรองว่าจะปฎิบัติตามกฎหมายและระเบียบของทางราชการเกี่ยวกับการไปศึกษาฝึกอบรมปฎิบัติการวิจัย'));
$pdf->Text(15,180,iconv( 'UTF-8','TIS-620','   หรือดูงาน ทุกประการ'));


if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig1),105,174.5,20,10);
}

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(90,186,iconv( 'UTF-8','TIS-620','ลงชื่อ.........................................................'));
$pdf->Text(99,194,iconv( 'UTF-8','TIS-620','('.$inforleave->LEAVE_PERSON_FULLNAME.')'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(15,204,iconv( 'UTF-8','TIS-620','   ความเห็นผู้บังคับบัญชา ......................................................'));

if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig2),105,208.5,20,10);
}
$pdf->Text(90,219,iconv( 'UTF-8','TIS-620','ลงชื่อ..........................................................'));
$pdf->Text(99,226,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
$pdf->Text(95,233,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK));
$pdf->Text(98,240,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));


$pdf->SetFont('THSarabunNew Bold','U',15);
$pdf->Text(15,235,iconv( 'UTF-8','TIS-620','   คำสั่ง'));
$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(29,245,iconv( 'UTF-8','TIS-620','อนุญาต'));
$pdf->Text(55,245,iconv( 'UTF-8','TIS-620','ไม่อนุญาต'));

if($inforleave->LEAVE_STATUS_CODE == 'Allow'){ 
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',23,242,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',49,242,4.5,4.5);
}else{
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',23,242,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',49,242,4.5,4.5);
}

$pdf->Text(15,250,iconv( 'UTF-8','TIS-620','.........................................................................................................................................................................................'));

if($checksig == 1 && $sig4 !== null && $sig4 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig4),105,256.5,20,10);
}

$pdf->Text(90,268,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(99,275,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(95,283,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(98,290,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));
$pdf->Output();
exit;

?>
