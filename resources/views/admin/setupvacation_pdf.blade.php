<?php
define('FPDF_FONTPATH','font/');
$test = '0123';
require("fpdf/WriteHTML.php");
$pdf=new PDF();
$pdf->AddPage();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->SetFont('THSarabunNew','',12);
$pdf->WriteHTML('                                                                            ดูที่นั่น<br>ดูที่นั่น<br>');
$data = "ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น";
$data .= "ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น";
$data .= "ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น";
$data .= "ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น ดูที่นั่น";
$html='<br><table border="1">
<tr>
<td width="200" height="30">ดูที่นั่น</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30" >'.$test.'ดูที่นั่น02</td><td width="200" height="30">cell 4</td>
</tr>
</table>';
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$data));
$pdf->SetFont('THSarabunNew','',15);
$pdf->WriteHTML(iconv( 'UTF-8','cp874' ,$html));
$pdf-> Image('fpdf/img/checked.png',10,100,5,5);
$pdf-> Image('fpdf/img/checkno.jpg',10,120,5,5);
$pdf->Output();
exit;

?>