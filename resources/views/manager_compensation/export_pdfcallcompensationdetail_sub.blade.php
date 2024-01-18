<html>
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
             font-family: 'THSarabunNew', sans-serif;
             font-size: 14px;
            line-height: 1;     
        
         }
 
       
     table, th, td {
     /* border: 1px solid black; */
     }
 
 
     .text-pedding{
     padding-left:10px;
     padding-right:10px;
 }   
               
 table{
      border-collapse: collapse;  //กรอบด้านในหายไป
 }
             
         </style>
 
     <?php
 
    function month($number)
    {
     
    $strMonth= $number;

    $strMonthCut =  Array(
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม");

    $strMonthThai=$strMonthCut[$strMonth];
    return " $strMonthThai ";
    }
    function year($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

 
    $strMonthThai=$strMonthCut[$strMonth];
    return " $strYear ";
    }



    function RemovethainumDigit($num){
        return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
    }

    function Removeconvert($number){ 
        $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
        $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
        $number = str_replace(",","",$number); 
        $number = str_replace(" ","",$number); 
        $number = str_replace("บาท","",$number); 
        $number = explode(".",$number); 
        if(sizeof($number)>2){ 
        return ''; 
        exit; 
        } 
        $strlen = strlen($number[0]); 
        $convert = ''; 
        for($i=0;$i<$strlen;$i++){ 
            $n = substr($number[0], $i,1); 
            if($n!=0){ 
                if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
                elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
                elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
                else{ $convert .= $txtnum1[$n]; } 
                $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        
        $convert .= 'บาท'; 
        // if($number[1]=='0' OR $number[1]=='00' OR 
        // $number[1]=='')
        // { 
        $convert .= 'ถ้วน'; 
        // }else{ 
        // $strlen = strlen($number[1]); 
        // for($i=0;$i<$strlen;$i++){ 
        // $n = substr($number[1], $i,1); 
        //     if($n!=0){ 
        //     if($i==($strlen-1) AND $n==1){$convert 
        //     .= 'เอ็ด';} 
        //     elseif($i==($strlen-2) AND 
        //     $n==2){$convert .= 'ยี่';} 
        //     elseif($i==($strlen-2) AND 
        //     $n==1){$convert .= '';} 
        //     else{ $convert .= $txtnum1[$n];} 
        //     $convert .= $txtnum2[$strlen-$i-1]; 
        //     } 
        // } 
        // $convert .= 'สตางค์'; 
        // } 
        return $convert; 
            } 

            


                function DateThaifrom($strDate)
            {
            $strYear = date("Y",strtotime($strDate))+543;
            $strMonth= date("n",strtotime($strDate));
            $strDay= date("j",strtotime($strDate));

            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
            $strMonthThai=$strMonthCut[$strMonth];
            return $strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear;
            }
     ?>

     
   
</head>

<body >
    <table width="100%">
        <tr>
            {{-- <td width="40%"><img src="image/Garuda.png" width="50" height="50"></td> --}}
            <td width="38%"></td>
            <td><B style="font-size: 25px;">บันทึกข้อความ</B></td>
        </tr>   
    </table>  
    <table width="100%">
        <tr>
            <td style="font-size: 16px;"width="13%"><b style="font-size: 16px;">ส่วนราชการ</b> </td>
            <td style="font-size: 16px;"><b>{{($infoorg->ORG_NAME)}}</b></td>
        </tr>   
    </table>
    <table width="100%">
        <tr>
            <td style="font-size: 16px;"width="40%"><b>ที่</b> </td>
            <td style="font-size: 16px;"><b>วันที่&nbsp;&nbsp;{{DateThai(date('Y-m-d'))}}</b> </td>
        </tr> 
      
    </table>
    <table width="100%">
    <tr>
        <td style="font-size: 16px;"width="100%"><b>เรื่อง ขออนุมัติจ่ายเงินค่าตอบแทนพิเศษ(เงินเดือนเต็มขั้น)</b> </td>
    </tr> 
    <tr>
        <td style="font-size: 16px;"width="40%"><b> เรียน ผู้อำนวยการ{{($infoorg->ORG_NAME)}}</b> </td>
        <td style="font-size: 16px;"><b></b> </td>
    </tr>   
    </table>



    <table width="100%">
        <tr >
            <td width="15%"> </td>
            <td width="98%" id="mylayout_1">{{$infoorg->ORG_NAME}} อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}} มีความประสงค์ขออนุมัติจ่ายเงินเดือนเพื่อเป็นเงินค่าตอบแทนพิเศษ</td>
            
        </tr> 
        
        </table>
        <table width="100%">
            <tr>
                {{-- <td width="10%"> </td> --}}
                <td width="98%" id="mylayout_1">(เงินเดือนเต็มขั้น) ประจำเดือน {{month($salary_all->SALARYALL_MONTH_ID)}} {{($salary_all->SALARYALL_YEAR_ID)}} จำนวน {{$salary_allc}} ราย จำนวนเงิน {{$se}} บาท ({{Removeconvert($se)}}) ดังรายละเอียดที่แนบมาพร้อมหนังสือตัวนี้แล้ว จำนวน 1 ชุด</td>
            </tr> 
            
            </table>
            <table width="100%">
                <tr>
                    {{-- <td width="10%"> </td> --}}
                    <td width="98%"> </td>
                </tr> 
                
                </table>
                <table width="100%">
                    <tr>
                        <td width="18%"></td>
                        <td>จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</td>
                    </tr>  
                </table>
    <table width="100%">
        <tr>
            <td width="47%"></td>
            <td>&nbsp;</td>
        </tr>  
       
    </table>

  
    <table width="100%">
        <tr>
            <td width="38%"></td>
            <td>&nbsp;</td>
        </tr>
    </table> 


    <table width="100%">
        <tr>
            <td width="43%"></td>
            <td>(............................................)</td>
        </tr>  
    </table>
        <table width="100%">
        <tr>
            <td width="38%"></td>
            <td>เจ้าพนักงานการเงินและบัญชี ชำนาญงาน</td>
        </tr>   
    </table>
    
    <table width="100%">
        <tr>
            <td width="47%"></td>
            <td>&nbsp;</td>
        </tr>  
        <tr>
            <td width="47%"></td>
            <td>&nbsp;</td>
        </tr>  
    </table>

    <table width="100%">
    <tr>
        <td width="51%"></td>
        <td style="font-size: 18px;"><b>อนุมัติ</b></td>
    </tr>  
</table>
    <table width="100%">
        <tr>
            <td width="38%"></td>
            <td>&nbsp;</td>
        </tr>
    </table> 
    <table width="100%">
        <tr>
            <td width="38%"></td>
            <td>&nbsp;</td>
        </tr>
    </table> 
        <table width="100%">
        <tr  >
            <td width="44%"></td>
            <td><b>({{($infoorg->ORG_AMPHUR)}})</b></td>
        </tr>  
    </table>
    <table width="100%">
        <tr>
            <td width="42%"></td>
            <td><b>ผู้อำนวยการ{{($infoorg->ORG_NAME)}}</b></td>
        </tr>   
    </table>
    
</body>
</html>