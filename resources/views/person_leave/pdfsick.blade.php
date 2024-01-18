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
                                             แบบใบลาป่วย<br><br>'));
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
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ลาป่วย'));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>เรียน  '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ผู้อำนวยการ'.$orgname->ORG_NAME));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br><br>        ข้าพเจ้า '));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$inforleave->LEAVE_PERSON_FULLNAME));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'              ตำแหน่ง '));
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


$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->Cell(10,30,iconv( 'UTF-8','TIS-620','ขอลา'));


$pdf->Image(base_path('public').'/fpdf/img/checked.png',55,62,4,4);
$pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',55,70,4.5,4.5);
$pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',55,78,4.5,4.5);

$html1='<br><table >
                                    <tr>
<td width="200" height="50" >ลาป่วย</td>';
$html2='<td width="60" height="50" >เนื่องจาก';
$htmlre= $inforleave->LEAVE_BECAUSE.'</td>
</tr>';
$html3='                                    <tr>
<td width="100" height="50" >กิจส่วนตัว</td>
</tr>
                                    <tr>
<td width="100" height="50" >คลอดบุตร</td>
</tr>
</table>';

$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$html1));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$html2));

$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$htmlre));
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$html3));

if($inforleave->WORK_DO == 0.5){ 
  $dateresultwork = 'ครึ่ง';
}else{
  $dateresultwork = number_format($inforleave->WORK_DO);
}


if($lastsick == null || $lastsick ==''){
$detail ='ตั้งแต่วันที่  '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_BEGIN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN).'    ถึงวันที่   '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_END).'     พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END).'    มีกำหนด   '.$dateresultwork.'   วัน<br>';
$detail .='ข้าพเจ้าได้ลา            ป่วย            กิจส่วนตัว          คลอด     ในระหว่างลาติดต่อข้าพเจ้าได้ที่<br>';
$detail .= $inforleave->LEAVE_CONTACT.' โทรศัพท์ '.$inforleave->LEAVE_CONTACT_PHONE.'<br><br>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));
}else{

  if($lastsick->LEAVE_DATE_SUM == 0.5){ 
    $dateresult = 'ครึ่ง';
  }else{
    $dateresult = number_format($lastsick->LEAVE_DATE_SUM);
  }

  $detail ='ตั้งแต่วันที่  '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_BEGIN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN).'    ถึงวันที่   '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_END).'     พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END).'    มีกำหนด   '.$dateresultwork.'   วัน<br>';
  $detail .='ข้าพเจ้าได้ลา            ป่วย            กิจส่วนตัว          คลอด    ครั้งสุดท้าย    ตั้งแต่วันที่   '.dayThai($lastsick->LEAVE_DATE_BEGIN).'  เดือน   '.monthThai($lastsick->LEAVE_DATE_BEGIN).'     พ.ศ. '.yearThai($lastsick->LEAVE_DATE_BEGIN).'<br>';
  $detail .='ถึงวันที่    '.dayThai($lastsick->LEAVE_DATE_END).'  เดือน   '.monthThai($lastsick->LEAVE_DATE_END).'  พ.ศ. '.yearThai($lastsick->LEAVE_DATE_END).'   มีกำหนด     '.$dateresult.'     วัน   ในระหว่างลาติดต่อข้าพเจ้าได้ที่<br>';
  $detail .= $inforleave->LEAVE_CONTACT.'<br>โทรศัพท์ '.$inforleave->LEAVE_CONTACT_PHONE.'<br>';
  $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));

}
$pdf->Image(base_path('public').'/fpdf/img/checked.png',47,90.5,4,4);
$pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',65,90.5,4.5,4.5);
$pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',91,90.5,4.5,4.5);

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>      
                                               
                                             ขอแสดงความนับถือ<br><br>'));
$pdf->SetFont('THSarabunNew','',15);




//$dataURI= 'data:image/png;base64,'.chunk_split(base64_encode($inforsignature1->IMG)).'';
//$pdf-> Image($dataURI,81,90.5,4.5,4.5);
if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig1),140,118.5,20,10);
}
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                                    
                                        ลงชื่อ............................................................<br>
                                                    
                                            ( '.$inforleave->LEAVE_PERSON_FULLNAME.' )<br>
                                                    
                                        ตำแหน่ง '.$inforperson->POSITION_IN_WORK.' '.$inforperson->HR_LEVEL_NAME.'<br>'));
$pdf->SetFont('THSarabunNew Bold','',15);

if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig2),140,147.5,20,10);
}

$pdf->Text(120,144,iconv( 'UTF-8','TIS-620','ความคิดเห็นของผู้บังคับบัญชา'));

$pdf->SetFont('THSarabunNew','',15);

if($inforleave->ACCEPT_COMMENT != '' || $inforleave->ACCEPT_COMMENT != null){
  $pdf->Text(115,150,iconv( 'UTF-8','TIS-620',$inforleave->ACCEPT_COMMENT));
}else{
  $pdf->Text(115,150,iconv( 'UTF-8','TIS-620','....................................................................'));
}



$pdf->Text(115,158,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................หัวหน้างาน'));
$pdf->Text(118,164,iconv( 'UTF-8','TIS-620','( '.$inforleave->LEADER_PERSON_NAME.' )'));
$pdf->Text(115,170,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK.' '.$lavel1->HR_LEVEL_NAME));

if($inforleave->LEAVE_POSITION_DATE == '' || $inforleave->LEAVE_POSITION_DATE == null){
  $pdf->Text(115,176,iconv( 'UTF-8','TIS-620','วันที่  '.formate($datnow)));
}else{
  $pdf->Text(115,176,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->LEAVE_POSITION_DATE)));
}


if($checksig == 1 && $sig3 !== null && $sig3 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig3),140,177.5,20,10);
}

$pdf->Text(115,188,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................หัวหน้ากลุ่มงาน'));
$pdf->Text(118,194,iconv( 'UTF-8','TIS-620','( '.$inforleave->LEADER_DEP_PERSON_NAME.' )'));
$pdf->Text(115,200,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_DEP_PERSON_POSITION.' '.$lavel2->HR_LEVEL_NAME));

if($inforleave->LEAVE_POSITION_DATE == '' || $inforleave->LEAVE_POSITION_DATE == null){
  $pdf->Text(115,206,iconv( 'UTF-8','TIS-620','วันที่  '.formate($datnow)));
}else{
  $pdf->Text(115,206,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->LEAVE_POSITION_DATE)));
}


$pdf->SetFont('THSarabunNew Bold','U',15);
$pdf->Text(140,215,iconv( 'UTF-8','TIS-620','คำสั่ง'));

$pdf->SetFont('THSarabunNew','',15);
$pdf->Text(130,225,iconv( 'UTF-8','TIS-620','อนุญาต                   ไม่อนุญาต'));

if($inforleave->LEAVE_STATUS_CODE == 'Allow'){
  $pdf->Image(base_path('public').'/fpdf/img/checked.png',124,221.5,4.5,4.5);
  $pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',156,221.5,4.5,4.5);

 
}else{

  $pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',124,221.5,4.5,4.5);
  $pdf->Image(base_path('public').'/fpdf/img/checkno.jpg',156,221.5,4.5,4.5);

}


if($checksig == 1 && $sig4 !== null && $sig4 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig4),140,230.5,20,10);
}

$pdf->Text(115,240,iconv( 'UTF-8','TIS-620','ลงชื่อ.............................................................'));
$pdf->Text(118,246,iconv( 'UTF-8','TIS-620','( '.$orgname->HR_PREFIX_NAME.''.$orgname->HR_FNAME.' '.$orgname->HR_LNAME.' )'));
$pdf->Text(115,254,iconv( 'UTF-8','TIS-620','ผู้อำนวยการ'.$orgname->ORG_NAME));
$pdf->Text(115,262,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'สถิติการลาในปีงบประมาณ '.$idyear.'<br>'));

$table_h ='<table border="1"><tr><td width="70" height="50" >ประเภท</td>
<td width="70" height="50" >ลามาแล้ว</td>
<td width="70" height="50" >ลาครั้งนี้</td>
<td width="70" height="50" >รวมเป็น</td></tr>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$table_h));


$total = $sumsick + $inforleave->WORK_DO;
$pdf->SetFont('THSarabunNew','',15);
$table_b ='<tr><td width="70" height="50" >ป่วย</td>
<td width="70" height="50" >'.number_format($sumsick, 1, '.', '').'</td>
<td width="70" height="50" >'.number_format($inforleave->WORK_DO, 1, '.', '').'</td>
<td width="70" height="50" >'.number_format($total, 1, '.', '').'</td></tr>
<tr><td width="70" height="50" >กิจส่วนตัว</td>
<td width="70" height="50" >'.number_format($sumwork, 1, '.', '').'</td>
<td width="70" height="50" >0.0</td>
<td width="70" height="50" >'.number_format($sumwork, 1, '.', '').'</td></tr>
<tr><td width="70" height="50" >คลอดบุตร</td>
<td width="70" height="50" >'.number_format($sumbirth, 1, '.', '').'</td>
<td width="70" height="50" >0.0</td>
<td width="70" height="50" >'.number_format($sumbirth, 1, '.', '').'</td></tr></table>';

if($checksig == 1 && $sig5 !== null && $sig5 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig5),35,177.5,20,10);
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
  $pdf->Image(Storage::path('public/images/'.$sig6),35,215.5,20,10);
}

$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ในระหว่างลานี้ ข้าพเจ้าขอมอบหมายงานในรับผิดชอบ<br>ให้กับ '.$inforleave->LEAVE_WORK_SEND.'<br>'));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้มอบ<br>
        ( '.$inforleave->LEAVE_PERSON_FULLNAME.' )<br>
ตำแหน่ง  '.$inforperson->POSITION_IN_WORK.' '.$lavel4->HR_LEVEL_NAME.'<br>วันที่  '.formate($datnow).'<br><br>'));

if($checksig == 1 && $sig7 !== null && $sig7 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig7),35,245.5,20,10);
}
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>ลงชื่อ..................................................ผู้รับมอบ<br>
        ( '.$inforleave->LEAVE_WORK_SEND.' )<br>
ตำแหน่ง '.$infoworksend->POSITION_IN_WORK.' '.$lavel5->HR_LEVEL_NAME.'<br>วันที่  '.formate($datnow).'<br><br>'));



$pdf->Output();
exit;

?>