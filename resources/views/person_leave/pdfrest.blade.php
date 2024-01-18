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
$pdf->SetLeftMargin( 22 );
$pdf->SetRightMargin( 5);
$pdf->AddPage();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew Bold','','THSarabunNew Bold.php');
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'                        
                                             แบบใบลาพักผ่อน<br><br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             
                                         เขียนที่   '));

$pdf->SetFont('THSarabunNew','',15);
$data1= " ".$orgname->ORG_NAME;
$data1.= "<br>                                         
                                          วันที่  ".dayThai($datnow)."   เดือน ".monthThai($datnow)."  พ.ศ. ".yearThai($datnow);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data1));  

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>เรื่อง  '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ขอลาพักผ่อน'));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>เรียน  '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br><br>        ข้าพเจ้า '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforleave->LEAVE_PERSON_FULLNAME));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'           ตำแหน่ง '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforperson->POSITION_IN_WORK));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ระดับ '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforperson->HR_LEVEL_NAME));


$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'                          สังกัด '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforperson->HR_DEPARTMENT_SUB_NAME.'<br>'));


$detail='มีวันลาพักผ่อนสะสม    '.($leaveday->DAY_LEAVE_OVER_BEFORE - 10).'    วันทำการ      มีสิทธิลาพักผ่อนประจำปีนี้อีก  10  วันทำการ    รวมเป็น   '.number_format($leaveday->DAY_LEAVE_OVER_BEFORE,1).'  วันทำการ <br>';

if($inforleave->WORK_DO == 0.5){ 
  $dateresultwork = 'ครึ่ง';
}else{
  $dateresultwork = number_format($inforleave->WORK_DO);
}

$detail .='ขอลาพักผ่อนตั้งแต่วันที่   '.dayThai($inforest->LEAVE_DATE_BEGIN).'  เดือน   '.monthThai($inforest->LEAVE_DATE_BEGIN).'     พ.ศ. '.yearThai($inforest->LEAVE_DATE_BEGIN).' ถึงวันที่    '.dayThai($inforest->LEAVE_DATE_END).'  เดือน   '.monthThai($inforest->LEAVE_DATE_END).'  พ.ศ. '.yearThai($inforest->LEAVE_DATE_END).'   มีกำหนด '.$dateresultwork.' วัน<br>';
$detail .='ในระหว่างลาติดต่อข้าพเจ้าได้ที่<br>';
$detail .= 'โทรศัพท์ '.$inforleave->LEAVE_CONTACT_PHONE.'<br>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));



$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>      
                                               
                                             ขอแสดงความนับถือ<br><br>'));
$pdf->SetFont('THSarabunNew','',15);

if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig1),137,85.5,20,10);
  }
  
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                                    
                                        ลงชื่อ............................................................<br>
                                                    
                                        ( '.$inforleave->LEAVE_PERSON_FULLNAME.' )<br>
                                                    
                                        ตำแหน่ง '.$inforperson->POSITION_IN_WORK.' '.$inforperson->HR_LEVEL_NAME.'<br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->Text(120,121,iconv( 'UTF-8','TIS-620','ความคิดเห็นของผู้บังคับบัญชา'));

if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig2),140,127.5,20,10);
  }

$pdf->SetFont('THSarabunNew','',15);


if($inforleave->ACCEPT_COMMENT != '' || $inforleave->ACCEPT_COMMENT != null){
  $pdf->Text(115,127,iconv( 'UTF-8','TIS-620',$inforleave->ACCEPT_COMMENT));
}else{
  $pdf->Text(115,127,iconv( 'UTF-8','TIS-620','....................................................................'));
}
$pdf->Text(115,138,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................หัวหน้างาน'));
$pdf->Text(118,144,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
$pdf->Text(115,150,iconv( 'UTF-8','TIS-620','ตำแหน่ง'.$inforleave->LEADER_POSITION_IN_WORK.' '.$lavel1->HR_LEVEL_NAME));


if($inforleave->LEAVE_POSITION_DATE == '' || $inforleave->LEAVE_POSITION_DATE == null){
  $pdf->Text(115,156,iconv( 'UTF-8','TIS-620','วันที่  '.formate($datnow)));
}else{
  $pdf->Text(115,156,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->LEAVE_POSITION_DATE)));
}


if($checksig == 1 && $sig3 !== null && $sig3 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig3),140,157.5,20,10);
  }


$pdf->Text(115,168,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................หัวหน้ากลุ่มงาน'));
$pdf->Text(118,174,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_DEP_PERSON_NAME.')'));
$pdf->Text(115,180,iconv( 'UTF-8','TIS-620','ตำแหน่ง'.$inforleave->LEADER_DEP_PERSON_POSITION.' '.$lavel2->HR_LEVEL_NAME));

if($inforleave->LEAVE_POSITION_DATE == '' || $inforleave->LEAVE_POSITION_DATE == null){
  $pdf->Text(115,186,iconv( 'UTF-8','TIS-620','วันที่  '.formate($datnow)));
}else{
  $pdf->Text(115,186,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->LEAVE_POSITION_DATE)));
}

$pdf->SetFont('THSarabunNew Bold','U',15);
$pdf->Text(140,195,iconv( 'UTF-8','TIS-620','คำสั่ง'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(130,205,iconv( 'UTF-8','TIS-620','อนุญาต                   ไม่อนุญาต'));


if($inforleave->LEAVE_STATUS_CODE == 'Allow'){
  $pdf-> Image(base_path('public').'/fpdf/img/checked.png',124,201.5,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',156,201.5,4.5,4.5);

 
}else{

  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',124,201.5,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',156,201.5,4.5,4.5);

}

if($checksig == 1 && $sig4 !== null && $sig4 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig4),140,210.5,20,10);
  }

$pdf->Text(115,220,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(118,226,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(115,234,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(115,242,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'สถิติการลาในปีงบประมาณ '.$idyear.'<br>'));

$table_h ='<table border="1"><tr>
<td width="70" height="50" >ลามาแล้ว</td>
<td width="70" height="50" >ลาครั้งนี้</td>
<td width="70" height="50" >รวมเป็น</td></tr>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$table_h));



if($inforleave->LEAVE_STATUS_CODE == 'Allow'){
  $sumrest_use = $sumrest - $inforleave->WORK_DO;
}else{
  $sumrest_use = $sumrest;
}

$total = $sumrest_use + $inforleave->WORK_DO;


$pdf->SetFont('THSarabunNew','',15);
$table_b ='<tr>
<td width="70" height="50" >'.number_format($sumrest_use, 1, '.', '').'</td>
<td width="70" height="50" >'.number_format($inforleave->WORK_DO, 1, '.', '').'</td>
<td width="70" height="50" >'.number_format($total, 1, '.', '').'</td></tr>
</table>';

if($checksig == 1 && $sig5 !== null && $sig5 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig5),35,125.5,20,10);
  }


$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$table_b));

if($inforleave->CONFIRM_CHECK_DATE == '' || $inforleave->CONFIRM_CHECK_DATE == null){
  $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้ตรวจสอบ<br>
        ( '.$infocon->HR_PREFIX_NAME.''.$infocon->HR_FNAME.' '.$infocon->HR_LNAME.')<br>
ตำแหน่ง '.$infocon->POSITION_IN_WORK.' '.$lavel3->HR_LEVEL_NAME.'<br>วันที่  '.formate($datnow).'<br><br>'));
}else{

  $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้ตรวจสอบ<br>
    ( '.$infocon->HR_PREFIX_NAME.''.$infocon->HR_FNAME.' '.$infocon->HR_LNAME.')<br>
ตำแหน่ง '.$infocon->POSITION_IN_WORK.' '.$lavel3->HR_LEVEL_NAME.'<br>วันที่  '.formate($inforleave->CONFIRM_CHECK_DATE).'<br><br>'));
}

if($checksig == 1 && $sig6 !== null && $sig6 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig6),35,164.5,20,10);
  }

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ในระหว่างลานี้ ข้าพเจ้าขอมอบหมายงานในรับผิดชอบ<br>ให้กับ '.$inforleave->LEAVE_WORK_SEND.'<br>'));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้มอบ<br>
        ('.$inforleave->LEAVE_PERSON_FULLNAME.')<br>
ตำแหน่ง  '.$inforperson->POSITION_IN_WORK.' '.$lavel4->HR_LEVEL_NAME.'<br>วันที่  '.formate($datnow).'<br><br>'));

if($checksig == 1 && $sig7 !== null && $sig7 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig7),35,194.5,20,10);
  }

$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้รับมอบ<br>
        ( '.$inforleave->LEAVE_WORK_SEND.' )<br>
ตำแหน่ง '.$infoworksend->POSITION_IN_WORK.' '.$lavel5->HR_LEVEL_NAME.'<br>วันที่  '.formate($datnow).'<br><br>'));



$pdf->Output();
exit;

?>