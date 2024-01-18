
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal;  
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal; 
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
 
 
        body {
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 1;
            padding: 28.3465pt 7.1732pt 7.1732pt 56.6929pt;
       
        }

        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }
        
    </style>
    <?php

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
        if($number[1]=='0' OR $number[1]=='00' OR 
        $number[1]==''){ 
        $convert .= 'ถ้วน'; 
        }else{ 
        $strlen = strlen($number[1]); 
        for($i=0;$i<$strlen;$i++){ 
        $n = substr($number[1], $i,1); 
            if($n!=0){ 
            if($i==($strlen-1) AND $n==1){$convert 
            .= 'เอ็ด';} 
            elseif($i==($strlen-2) AND 
            $n==2){$convert .= 'ยี่';} 
            elseif($i==($strlen-2) AND 
            $n==1){$convert .= '';} 
            else{ $convert .= $txtnum1[$n];} 
            $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        $convert .= 'สตางค์'; 
        } 
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

    function Removeformate($strDate)
    {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("m",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));
    
      return $strDay."/".$strMonth."/".$strYear;
      }  
    ?>
    <style>

</style>
</head>

<body>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:23px;"><b>โรงพยาบาลรุ่งเรือง</b></label><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:23px;"><b>ใบสำคัญการลงบัญชี</b></label>

<table width="100%">
   <tr>
        <td>
    
                        <table  >
                                <tr>
                                    <td>รหัสสมุดรายวัน</td>  
                                    <td colspan="3"> &nbsp;&nbsp;
                                    
                                    <?php if($infoaccount->ACCOUNT_TYPE == '01'){
                                    echo '01  สมุดบัญชีรายรับ';
                                    }elseif($infoaccount->ACCOUNT_TYPE == '02'){
                                        echo '02  สมุดบัญชีรายจ่าย';
                                    }elseif($infoaccount->ACCOUNT_TYPE == '03'){
                                        echo '03  สมุดบัญชีทั่วไป';
                                    }elseif($infoaccount->ACCOUNT_TYPE == '04'){
                                        echo '04  สมุดรายวันลูกหนี้';
                                    }elseif($infoaccount->ACCOUNT_TYPE == '05'){
                                        echo '05  สมุดรายวันซื้อ';
                                    }
                                    ?>
                                    
                                    </td>
                                    


                                </tr>
                                <tr>
                                <td>วันที่เอกสาร </td> 
                                <td>&nbsp;&nbsp;{{formate($infoaccount->ACCOUNT_OUT_DATE)}}</td> 
                                <td>&nbsp;&nbsp;เลขที่เอกสาร</td>
                                <td>&nbsp;&nbsp;{{ $infoaccount->ACCOUNT_NUMBER}}</td>
                                </tr>
                                <tr>
                                <td>วันที่ใบกำกับภาษี</td> 
                                 @if($infoaccount->ACCOUNT_DOCTAX_DATE == null)
                                    <td>&nbsp;&nbsp;</td>
                                  @else
                                  <td>&nbsp;&nbsp;{{formate($infoaccount->ACCOUNT_DOCTAX_DATE)}}</td>
                                  @endif
                                <td>&nbsp;&nbsp;เลขที่ใบกำกับภาษี</td>
                                <td>&nbsp;&nbsp;{{$infoaccount->ACCOUNT_DOCTAX_NUM}}</td>
                                </tr>
                                <tr>
                                <td>วันที่เอกสารอ้างอิง</td>  
                                @if($infoaccount->ACCOUNT_DOCTAX_DATE == null)
                                <td>&nbsp;&nbsp;</td>
                                @else
                                <td>&nbsp;&nbsp;{{formate($infoaccount->ACCOUNT_DOCREF_DATE)}}</td>
                                @endif
                                <td>&nbsp;&nbsp;เลขที่เอกสารอ้างอิง</td>
                                <td>&nbsp;&nbsp;{{$infoaccount->ACCOUNT_DOCREF_NUM}}</td>
                                </tr>
                                <tr>
                                <td>คำอธิบาย</td>
                                <td colspan="3">&nbsp;&nbsp;{{$infoaccount->ACCOUNT_DETAIL}}</td>
                                </tr>

                        </table>
                </div>
               </td>
               <td>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               </td>

                  <td>
                             
                          
                                    ด้านรับ <br>
                             
                                    ด้านจ่าย <br>
                             
                                    ด้านทั่วไป <br>
                            
                  </td>
            </tr>
    </table>
          
<br>

<table width="100%">
<thead style="border: 1px solid black;">
  <tr>
    <td style="text-align: center;border: 1px solid black;" width="5%">ลำดับ</td>    
    <td style="text-align: center;border: 1px solid black;">รหัสบัญชี</td>  
    <th style="text-align: center;border: 1px solid black;" width="55%">รายการ</th>    
    <th  style="text-align: center;border: 1px solid black;">เดบิต</th>   
    <th  style="text-align: center;border: 1px solid black;">เครดิต</th>  
   
    
  </tr>
  </thead>
 <tbody>
 <?php $count=1;?>
    @foreach ($infosubs as $infosub)              

  <tr>
    <td style="text-align: center;border-right:: 1px solid black;border-left:: 1px solid black;">{{$count}}</td>
    <td style="text-align: left;padding-left:10px;border-right:: 1px solid black;">{{$infosub->ACCOUNT_SUB_NUM}}</td>
    <td style="text-align: left;padding-left:10px;border-right:: 1px solid black;">{{$infosub->ACCOUNT_SUB_DETAIL}}</td>
    <td style="text-align: right;padding-right:10px;border-right:: 1px solid black;">{{number_format($infosub->ACCOUNT_SUB_DEBIT,2)}}</td>
    <td style="text-align: right;padding-right:10px;border-right:: 1px solid black;">{{number_format($infosub->ACCOUNT_SUB_CREDIT,2)}}</td>
  </tr>

  <?php  $count++;?>

@endforeach 
<tr >
    <td style="border-top:: 1px solid black;" colspan="3"></td>
    <td style="text-align: right;padding-right:10px;border: 1px solid black;">{{number_format($sumdebit,2)}}</td>
    <td style="text-align: right;padding-right:10px;border: 1px solid black;">{{number_format($sumcredit,2)}}</td>

</tr>

  </tbody>

</table>
<br>
หมายเหตุ : ช่องผู้อนุมัติให้ใช้กรณีใบสำคัญการลงบัญชีที่ไม่ใช่การรับเงินสด เงินฝากธนาคารหรือเงินฝากคลัง


<br>
<br>
<br>

            <table width="100%">
            <tr>
               <td style="text-align: center;">
               {{$infoperson1->HR_PREFIX_NAME}}{{$infoperson1->HR_FNAME}}  {{$infoperson1->HR_LNAME}}
               </td>
               <td style="text-align: center;">
               {{$infoperson2->HR_PREFIX_NAME}}{{$infoperson2->HR_FNAME}}  {{$infoperson2->HR_LNAME}}
               </td>
               <td style="text-align: center;">
               {{$infoperson3->HR_PREFIX_NAME}}{{$infoperson3->HR_FNAME}}  {{$infoperson3->HR_LNAME}}
              </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                ผู้ตรวจสอบ
                </td>
                <td style="text-align: center;">
                ผู้อนุมัติ
                </td>
                <td style="text-align: center;">
                ผู้ลงบัญชี
                </td>
            </tr>
           
            </table>
   

</body>
</html>