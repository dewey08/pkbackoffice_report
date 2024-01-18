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
                                             แบบหนังสือขอลาออกจากราชการของลูกจ้างชั่วคราว<br><br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             
                                                   เขียนที่   '));

$pdf->SetFont('THSarabunNew','',15);
$data1= " ".$orgname->ORG_NAME;
$data1.= "<br>
                                                                                                        วันที่  ".dayThai($datnow)."   เดือน ".monthThai($datnow)."  พ.ศ. ".yearThai($datnow);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data1));

 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>        เรื่อง  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ลาออกจากราชการของลูกจ้างชั่วคราว'));
 
 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>        เรียน  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));
 
 $pdf->SetFont('THSarabunNew','',15);
 $detail ='<br><br>                    ด้วยข้าพเจ้า  '.$inforleave->LEAVE_PERSON_FULLNAME.' ได้รับบรรจุเป็นลูกจ้างชั่วคราว <br>';
 $detail .='        วันที่  '.dayThai($inforleave->EXIT_DATE_BEGIN).'  เดือน   '.monthThai($inforleave->EXIT_DATE_BEGIN).'  พ.ศ. '.yearThai($inforleave->EXIT_DATE_BEGIN).' ปัจจุบันดำรงตำแหน่ง '.$inforperson->POSITION_IN_WORK.'  <br>';
 $detail .='        สังกัด  '.$inforperson->HR_DEPARTMENT_SUB_NAME.' ได้รับอัตราค่าจ้าง เดือนละ '.$inforleave->EXIT_SALARY.' บาท <br>';
 $detail .='        มีความประสงค์ขอลาออกจากราชการเพราะ '.$inforleave->EXIT_BECAUSE.' <br><br>';
 $detail .='                                          จึงเรียนมาเพื่อขอลาออกจากการปฏิบัติงาน ตั้งแต่วันที่ '.dayThai($inforleave->EXIT_IN_DATE).'  เดือน   '.monthThai($inforleave->EXIT_IN_DATE).'  พ.ศ. '.yearThai($inforleave->EXIT_IN_DATE).'  <br>';
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));



$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(104,100,iconv( 'UTF-8','TIS-620','ขอแสดงความนับถือ'));
$pdf->Text(90,112,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................'));
$pdf->Text(90,122,iconv( 'UTF-8','TIS-620','('.$inforleave->LEAVE_PERSON_FULLNAME.')'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(15,135,iconv( 'UTF-8','TIS-620','        ความเห็นผู้บังคับบัญชา ..........................................................................................................................................................'));
$pdf->Text(15,144,iconv( 'UTF-8','TIS-620','        ................................................................................................................................................................................................'));


$pdf->Text(90,160,iconv( 'UTF-8','TIS-620','ลงชื่อ..........................................................'));
$pdf->Text(90,168,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
$pdf->Text(90,177,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK));
$pdf->Text(90,186,iconv( 'UTF-8','TIS-620','วันที่........../.........................../...................'));


$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->Text(15,200,iconv( 'UTF-8','TIS-620','          คำสั่ง'));
$pdf->SetFont('THSarabunNew','',14);
$pdf->Text(29,208,iconv( 'UTF-8','TIS-620','          อนุญาต'));
$pdf->Text(55,208,iconv( 'UTF-8','TIS-620','          ไม่อนุญาต'));
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',32,205,4.5,4.5);
$pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',59,205,4.5,4.5);
$pdf->Text(15,217,iconv( 'UTF-8','TIS-620','            .........................................................................................................................................................................................................'));
$pdf->Text(15,226,iconv( 'UTF-8','TIS-620','            .........................................................................................................................................................................................................'));


$pdf->Text(90,246,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(90,256,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(90,266,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(90,276,iconv( 'UTF-8','TIS-620','วันที่........../.........................../..............'));

$pdf->Output();
exit;

?>
