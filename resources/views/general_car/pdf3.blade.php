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
          font-family: "THSarabunNew";
          font-size: 13px;
          line-height: 0.8;  
          padding: 10.00pt 7.1732pt 7.1732pt 40.00pt;             
      }
      
  </style>
  
  <?php
      function RemovethainumDigit($num){
          return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
      }
      function caldate($displaydate_end,$displaydate_bigen){ 
          $sumdate = round(abs(strtotime($displaydate_end) - strtotime($displaydate_bigen))/60/60/24)+1;
          return thainumDigit($sumdate); 
          }   
          function DateThaifrom($strDate)
              {
                      $strYear = date("Y",strtotime($strDate))+543;
                      $strMonth= date("n",strtotime($strDate));
                      $strDay= date("j",strtotime($strDate));  
                      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                      $strMonthThai=$strMonthCut[$strMonth];
                  return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
              }
              function timefrom($strtime)
              {
                      $time = substr($strtime,0,5);
                      
                  return thainumDigit($time);
              }
              $date = date('Y-m-d');
  ?>
  
  </head>
      <body>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(แบบ 3)<br><br><br>
          <center >
              {{-- <B style="font-size: 17px;">ใบขออนุญาตใช้รถยนต์ส่วนกลาง/รถรับรอง/รถรับรองประจำจังหวัด/รถอารักขา</B> --}}
            
                    <B style="font-size: 17px;">{{$f}}</B>
             
              
        </center> <br>
          <center>
         
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="">วันที่ {{DateThaifrom(date('Y-m-d'))}}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;       
          </center> 
          &nbsp;<label for="">เรียน ผู้อำนวยการ{{$orgname->ORG_NAME}} </label> <br>    
  <table>
      <tr>
          <td>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า&nbsp; {{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              ตำแหน่ง&nbsp;{{$inforperson->POSITION_IN_WORK}}
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          </td>
      </tr>
      <tr>
        <td>&nbsp;ขออนุญาตใช้รถไป &nbsp;&nbsp; {{$inforcar->LOCATION_ORG_NAME }}</td>
    </tr>
      <tr>
          <td>&nbsp;เพื่อ&nbsp;&nbsp; {{$inforcar->RESERVE_NAME}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; มีคนนั่ง&nbsp;&nbsp; {{thainumDigit($indexpersoncount)}} &nbsp;&nbsp;คน</td>
      </tr>
      <tr>
          <td>&nbsp;ในวันที่&nbsp;&nbsp; {{DateThaifrom($inforcar->RESERVE_BEGIN_DATE)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เวลา&nbsp;&nbsp; {{thainumDigit(formatetime($inforcar->RESERVE_BEGIN_TIME))}} น.<br>
          &nbsp;ถึงวันที่&nbsp;&nbsp; {{DateThaifrom($inforcar->RESERVE_END_DATE)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เวลา&nbsp;&nbsp; {{thainumDigit(formatetime($inforcar->RESERVE_END_TIME))}} น.</td>
        </tr>
  
    <tr>
        <td> <br><br><br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @if ($sigper == '')
            ........................................
            @else
                @if($checksig == 1 && $sigper !== null && $sigper !== '')
                <img src="{{Storage::path('public/images/'.$sigper)}}" width="100" height="40">
                @endif 
            @endif  
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ขออนุญาต <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( {{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}} )<br>
          
        </td>
    </tr>
    

    @if ($funch == 'APPROVE')
        <tr>
            <td>
                <br><br>
                @foreach ($infoper as $infoper)
                @if ($infoper->ID == $inforcar->CAR_DRIVER_SET_ID)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ได้ตรวจสอบแล้ว มีรถยนต์ส่วนกลางที่สามารถนำไปปฎิบัติงานได้ จึงเห็นสมควรอนุญาตให้ใช้รถยนต์ &nbsp;&nbsp;<br>
                &nbsp;&nbsp;หมายเลขทะเบียน  &nbsp;&nbsp;&nbsp; {{$inforcar->CAR_REG}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; โดยมี &nbsp;&nbsp;&nbsp;{{$infoper->HR_FNAME}} &nbsp;{{$infoper->HR_LNAME}}&nbsp;&nbsp;&nbsp;&nbsp;เป็นพนักงานขับรถยนต์<br>
                &nbsp;&nbsp;เลขไมล์ก่อนไป  &nbsp;&nbsp;&nbsp;{{$inforcar->CAR_NUMBER_BEGIN}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขไมล์หลังไป&nbsp;&nbsp;&nbsp;{{$inforcar->CAR_NUMBER_BACK}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม. &nbsp;&nbsp; {{$inforcar->CAR_NUMBER_BACK - $inforcar->CAR_NUMBER_BEGIN}} &nbsp;&nbsp;  กิโลเมตร<br><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @if ($sigdriver == '')
                ........................................
                @else
                    @if($checksig == 1 && $sigdriver !== null && $sigdriver !== '')
                    <img src="{{Storage::path('public/images/'.$sigdriver)}}" width="100" height="40">
                    @endif 
                @endif  
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พนักงานขับรถ <br>
          
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( {{$infoper->HR_FNAME}}&nbsp; {{$infoper->HR_LNAME}} )<br>
                @else
              
                @endif
                    
                @endforeach
                </td>
        </tr>
    @else
        
    @endif
   

 
    <tr>
        <td style="text-align: center;">
            <br>
            <br>
            <br>           
            <br>
            <br> 
          
           @if ($funcgleave == '')
           ........................................
           @else
                @if($checksig == 1 && $sig !== null && $sig !== '')
                        <img src="{{Storage::path('public/images/'.$sig)}}" width="100" height="40">
                    @endif 
           @endif
           

            <br>
            ({{$orgname->HR_PREFIX_NAME}} {{$orgname->HR_FNAME}} {{$orgname->HR_LNAME}})<br>
            ผู้อำนวยการ{{$orgname->ORG_NAME}}<br>
           
        </td>

    </tr>  
  </table>  
  
  
</center>
     </body>
  </html> 