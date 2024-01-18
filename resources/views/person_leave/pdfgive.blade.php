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
                                                    แบบใบลาไปช่วยเหลือภริยาที่คลอดบุตร<br><br>'));
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
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ลาไปช่วยเหลือภริยาที่คลอดบุตร'));
 
 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>        เรียน  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));


 $pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br><br>                  ข้าพเจ้า '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforleave->LEAVE_PERSON_FULLNAME));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'              ตำแหน่ง '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforperson->POSITION_IN_WORK));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>        สังกัด '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforperson->HR_DEPARTMENT_SUB_NAME.'<br>'));

if($inforleave->WORK_DO == 0.5){ 
  $dateresultwork = 'ครึ่ง';
}else{
  $dateresultwork = number_format($inforleave->WORK_DO);
}

$detail ='              มีความประสงค์ลาไปช่วยเหลือภริยาโดยชอบด้วยกฎหมายชื่อ '.$inforleave->LEAVE_WORD_BEGIN.''.$inforleave->LEAVE_MARRY_NAME.'<br>';
$detail .='        ซึ่งคลอดบุตรเมื่อวันที่ '.dayThai($inforleave->LEAVE_DATE_SPAWN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_SPAWN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_SPAWN).' จึงขออนุญาตลาไปช่วยเหลือภริยาที่คลอดบุตร<br>';
$detail .='        ตั้งแต่วันที่  '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_BEGIN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN).'    ถึงวันที่   '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_END).'     พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END).'    มีกำหนด   '.$dateresultwork.'   วัน<br>';
$detail .= '       '.$inforleave->LEAVE_CONTACT.'<br>        โทรศัพท์ '.$inforleave->LEAVE_CONTACT_PHONE.'<br>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));


if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig1),100,95.5,20,10);
}

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(90,106,iconv( 'UTF-8','TIS-620','ลงชื่อ.........................................................'));
$pdf->Text(100,115,iconv( 'UTF-8','TIS-620','('.$inforleave->LEAVE_PERSON_FULLNAME.')'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(15,135,iconv( 'UTF-8','TIS-620','      ความเห็นผู้บังคับบัญชา ...............................................................................................................................................................'));
$pdf->Text(15,144,iconv( 'UTF-8','TIS-620','      ......................................................................................................................................................................................................'));


if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
$pdf-> Image(Storage::path('public/public/images/'.$sig2),100,150.5,20,10);
}

$pdf->Text(90,160,iconv( 'UTF-8','TIS-620','ลงชื่อ..........................................................'));
$pdf->Text(90,168,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
$pdf->Text(90,177,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK));
$pdf->Text(90,186,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));


$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->Text(15,200,iconv( 'UTF-8','TIS-620','       คำสั่ง'));
$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(29,208,iconv( 'UTF-8','TIS-620','     อนุญาต'));
$pdf->Text(55,208,iconv( 'UTF-8','TIS-620','     ไม่อนุญาต'));

if($inforleave->LEAVE_STATUS_CODE == 'Allow'){ 
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',28,205,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',54,205,4.5,4.5);
}else{
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',28,205,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',54,205,4.5,4.5);
}



// $pdf-> Image('fpdf/img/checkno.jpg',23,205,4.5,4.5);
// $pdf-> Image('fpdf/img/checkno.jpg',49,205,4.5,4.5);
$pdf->Text(15,217,iconv( 'UTF-8','TIS-620','       ..................................................................................................................................................................................................'));
$pdf->Text(15,226,iconv( 'UTF-8','TIS-620','       ...................................................................................................................................................................................................'));

if($checksig == 1 && $sig4 !== null && $sig4 !== ''){
$pdf-> Image(Storage::path('public/images/'.$sig4),100,236.5,20,10);
}

$pdf->Text(90,246,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(90,256,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(90,266,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(90,276,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));

$pdf->Output();
exit;

?>
