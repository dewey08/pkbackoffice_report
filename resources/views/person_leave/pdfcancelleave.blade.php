<?php

function dayThai($strDate)
{
  $strDay= date("j",strtotime($strDate));

  return $strDay;
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
                                                              ใบขอยกเลิกใบลา<br><br>'));
$pdf->SetFont('THSarabunNew Bold','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'
                                             
                                         เขียนที่   '));

$pdf->SetFont('THSarabunNew','',15);
$data1= " ".$orgname->ORG_NAME;
$data1.= "<br><br>
                                                                                                        วันที่  ".dayThai($datnow)."   เดือน ".monthThai($datnow)."  พ.ศ. ".yearThai($datnow);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data1));
 $pdf->SetFont('THSarabunNew Bold','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'<br>เรื่อง  '));
 $pdf->SetFont('THSarabunNew','',15);
 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,'ขอยกเลิกใบลา'));
 
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


 $detail ='         ได้รับอนุญาตให้ลาตั้งแต่วันที่  '.dayThai($inforleave->LEAVE_DATE_BEGIN).'  เดือน    '.monthThai($inforleave->LEAVE_DATE_BEGIN).'    พ.ศ. '.yearThai($inforleave->LEAVE_DATE_BEGIN).'    ถึงวันที่   '.dayThai($inforleave->LEAVE_DATE_END).'  เดือน   '.monthThai($inforleave->LEAVE_DATE_END).'     พ.ศ. '.yearThai($inforleave->LEAVE_DATE_END).'    มีกำหนด   '.number_format($inforleave->WORK_DO).'   วัน นั้นจะขอยกเลิกการลา เนื่องจาก '.$inforleave->LEAVE_CANCEL_COMMENT.'<br>';

 $pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$detail));

 if($checksig == 1 && $sig1 !== null && $sig1 !== ''){
  $pdf->Image(Storage::path('public/images/'.$sig1),100,100.5,20,10);
  }

  if($checksig == 1 && $sig2 !== null && $sig2 !== ''){
  $pdf-> Image(Storage::path('public/images/'.$sig2,100,160.5,20,10));
  }

 $pdf->SetFont('THSarabunNew','',15);
 $pdf->Text(90,112,iconv( 'UTF-8','TIS-620','ลงชื่อ..................................................'));
 $pdf->Text(90,122,iconv( 'UTF-8','TIS-620','('.$inforleave->LEAVE_PERSON_FULLNAME.')'));
 
 
 $pdf->SetFont('THSarabunNew Bold','U',15);
 $pdf->Text(15,132,iconv( 'UTF-8','TIS-620','ความเห็นผู้บังคับบัญชา'));
 $pdf->SetFont('THSarabunNew','',14);
 $pdf->Text(29,142,iconv( 'UTF-8','TIS-620','อนุญาต'));
 $pdf->Text(55,142,iconv( 'UTF-8','TIS-620','ไม่อนุญาต'));



 if($inforleave->LEAVE_STATUS_CODE == 'Cancel'){
 $pdf-> Image(base_path('public').'/fpdf/img/checked.png',23,138,4.5,4.5);
 $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',49,138,4.5,4.5);

 
}else{


  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',23,138,4.5,4.5);
  $pdf-> Image(base_path('public').'/fpdf/img/checkno.jpg',49,138,4.5,4.5);

}

 $pdf->Text(15,152,iconv( 'UTF-8','TIS-620','...............................................................................................................................................................................................................................'));
 $pdf->Text(15,160,iconv( 'UTF-8','TIS-620','...............................................................................................................................................................................................................................'));
 


 
 $pdf->Text(90,170,iconv( 'UTF-8','TIS-620','ลงชื่อ..........................................................'));
 $pdf->Text(90,180,iconv( 'UTF-8','TIS-620','('.$inforleave->LEADER_PERSON_NAME.')'));
 $pdf->Text(90,190,iconv( 'UTF-8','TIS-620','ตำแหน่ง '.$inforleave->LEADER_POSITION_IN_WORK.' '.$lavel1->HR_LEVEL_NAME));
 $pdf->Text(90,200,iconv( 'UTF-8','TIS-620','วันที่  '.formate($inforleave->updated_at)));
 
 

$pdf->Output();
exit;

?>
