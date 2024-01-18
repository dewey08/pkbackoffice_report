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
          padding: 5.00pt 7.1732pt 7.1732pt 5.00pt;             
      }
      
      table {
  border: 1px solid black;
}
td {
  border: 1px solid black;
  font-size: 13px !important;
}
th {
  border: 1px solid black;
  font-size: 13px !important;
}

table {    
  width: 100%;
  margin-left: 1%;
  border-collapse: collapse;
}
  </style>
  
  <?php
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
        <center >
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แบบ ๔<br><br>
        </center> 
          <center >
            <B style="font-size: 15px;">บันทึกการใช้รถ </B><br>
              <B style="font-size: 15px;">รถหมายเลขทะเบียน &nbsp;{{$regcars->CAR_REG}}</B>
        </center> <br>

        <table class="table" style="width: 100%;" >
            <thead>
                <tr height="40">
                    <th class="text-font text-pedding" width="5%">ลำดับ</th>
                    <th class="text-font text-pedding" width="10%">ออกเดินทาง <br>วันที่ / เวลา</th>
                    <th class="text-font text-pedding" width="10%">ผู้ใช้รถ</th>
                    <th class="text-font text-pedding" width="19%">สถานที่ไป</th>
                    <th class="text-font text-pedding" width="12%">ระยะทางเมื่อรถ<br> ออกเดินทาง</th>
                    <th class="text-font text-pedding" width="10%">กลับถึงสำนักงาน <br>วันที่ / เวลา</th>
                    <th class="text-font text-pedding" width="12%">ระยะทางเมื่อรถ<br>กลับสำนักงาน</th>
                    <th class="text-font text-pedding" width="7%">ระยะทาง กม.</th>
                    <th class="text-font text-pedding" >พนักงาน<br>ขับรถ</th>
     
                </tr >
            </thead>
            <tbody>         
            <?php $number = 0; ?>
            @foreach ($infocars as $infocar)
            <?php $number++; ?>
                <tr height="20">
                    <td class="text-font text-pedding" width="5%">&nbsp;&nbsp;{{$number}}</td>
                    @if ($infocar->RESERVE_BEGIN_TIME == '' || $infocar->RESERVE_BEGIN_TIME == null)
                    <td class="text-font text-pedding" width="10%">&nbsp;&nbsp;{{ DateThai($infocar->RESERVE_BEGIN_DATE) }} </td>
                    @else
                    <td class="text-font text-pedding" width="10%">&nbsp;&nbsp;{{ DateThai($infocar->RESERVE_BEGIN_DATE) }} <br>&nbsp;&nbsp;{{ formatetime($infocar->RESERVE_BEGIN_TIME) }}&nbsp; น.</td>
                    @endif
                   
                   
                    <td class="text-font text-pedding" width="10%">&nbsp;&nbsp;{{ $infocar->HR_FNAME }}&nbsp;{{ $infocar->HR_LNAME }}</td>
                    <td class="text-font text-pedding" width="19%">&nbsp;&nbsp;{{ $infocar->LOCATION_ORG_NAME }}</td>
                    <td class="text-font" width="12%">&nbsp;&nbsp;{{$infocar->CAR_NUMBER_BEGIN }}</td>
                    @if($infocar->BACK_DATE != '' || $infocar->BACK_DATE != NUll)
                    <td class="text-font text-pedding" width="12%">&nbsp;&nbsp;{{DateThai($infocar->BACK_DATE)}} <br> &nbsp;&nbsp;{{ formatetime($infocar->BACK_TIME) }}&nbsp; น.</td>                                        
                    @else
                    <td class="text-font text-pedding" ></td>
                    @endif                                       
                
                    <td class="text-font text-pedding" >&nbsp;&nbsp;{{ $infocar->CAR_NUMBER_BACK }}</td>
                    <td class="text-font text-pedding" >&nbsp;&nbsp;{{$infocar->CAR_NUMBER_BACK - $infocar->CAR_NUMBER_BEGIN}}</td>
                    <td class="text-font text-pedding" >&nbsp;&nbsp;{{ $infocar->HR_FNAME }} {{ $infocar->HR_LNAME }}</td>
            
                </tr>
                @endforeach   
         
            </tbody>
        </table>
 
    <center >
        <br><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
        ผู้บันทึก...............................................<br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ตำแหน่ง...............................................
      </center> 
     </body>
  </html> 