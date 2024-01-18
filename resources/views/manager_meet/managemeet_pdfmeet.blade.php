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
              <B style="font-size: 17px;">ใบขอใช้ห้องประชุม</B>
        </center> <br>
        <center>         
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
            <b><label for="">{{$orgname->ORG_NAME}}</label></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
      </center> 
                &nbsp;<b><label for="">เลขที่ &nbsp;&nbsp;{{$inforoomservice-> ID}}</label></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="">วันที่ {{DateThaifrom(date('Y-m-d'))}}</label> <br>     
                &nbsp;<b><label for="">เรื่อง &nbsp;&nbsp;{{$inforoomservice-> SERVICE_STORY}}</label></b> <br> 
                &nbsp;<b><label for="">เรียน&nbsp;&nbsp;ผู้อำนวยการ{{$orgname->ORG_NAME}} </label></b> <br>    
  <table>
      <tr>
          <td>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า&nbsp; {{$inforoomservice->PERSON_REQUEST_NAME}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              ตำแหน่ง&nbsp;{{$inforoomservice->PERSON_REQUEST_POSITION}}
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
              &nbsp;หน่วยงาน&nbsp; {{$inforoomservice->PERSON_REQUEST_DEP}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            เบอร์โทร&nbsp;{{$inforoomservice->PERSON_REQUEST_PHONE}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
            &nbsp;มีความประสงค์ขออนุญาตใช้ห้องประชุมของ &nbsp;&nbsp;{{$orgname->ORG_NAME}}<br>
            &nbsp;ในวันที่ &nbsp; {{DateThaifrom($inforoomservice->DATE_BEGIN)}}&nbsp;เวลา&nbsp;{{$inforoomservice->TIME_BEGIN}}&nbsp;น.&nbsp;ถึงวันที่&nbsp;{{DateThaifrom($inforoomservice->DATE_END)}}&nbsp;เวลา&nbsp;{{$inforoomservice->TIME_END}}&nbsp;น. <br>
            &nbsp;เพื่อใช้ในการ &nbsp;&nbsp;{{$inforoomservice->OBJECTIVE_NAME}}<br>
            &nbsp;รายละเอียด &nbsp;&nbsp;{{$inforoomservice->SERVICE_STORY}} <br>
            &nbsp;ห้องประชุมที่ขอใช้ &nbsp;&nbsp;{{$inforoomservice->ROOM_NAME}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนผู้เข้าประชุม &nbsp;&nbsp;{{$inforoomservice->TOTAL_PEOPLE}}&nbsp;&nbsp;คน <br>
            
            &nbsp;<b>อุปกรณ์</b><br>
            @foreach ($articlelist as $articlelist)
            &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;{{$articlelist->ARTICLE_NAME}}&nbsp;&nbsp; &nbsp;&nbsp; {{$articlelist->TOTAL}} <br>
            @endforeach 
            &nbsp;<b>งบประมาณ</b>
            @foreach ($mbbudgets as $mbbudget)
            &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;{{$mbbudget->MB_PRICE}}&nbsp;&nbsp;บาท <br>
            @endforeach 
            &nbsp;<b>อาหาร</b><br>
            @foreach ($infofoodlists as $infofoodlist)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;{{$infofoodlist->FOOD_NAME}}&nbsp;&nbsp;จำนวน {{$infofoodlist->TOTAL}} &nbsp;{{$infofoodlist->FOOD_UNIT}}<br>
            @endforeach            
        </td>
      </tr>
    </table> 
  <table>
    <tr>
        <td rowspan="3">
            <b>จึงเรียนมาเพื่อทราบและโปรดพิจารณาอนุมัติ</b><br><br><br>
            @if ($checksigno->ACTIVE == 'False')
            {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................หัวหน้างาน<br> --}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................&nbsp;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;...............................................&nbsp;)<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้างาน&nbsp;
            @else
                @if($checksig == 1 && $sig !== null && $sig !== '')
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$sig)}}" width="100" height="30"> <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;{{$leader->LEADER_NAME}}&nbsp;) <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้างาน&nbsp;
                @endif 
            @endif  
       
        </td>
        <td rowspan="2">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td rowspan="3">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                
            </b><br><br><br>
            @if ($checksigno->ACTIVE == 'False')
            {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................ผู้ขอใช้<br> --}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................&nbsp;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;...............................................&nbsp;)<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ขอใช้&nbsp;
            @else
                @if($checksig == 1 && $sigpe !== null && $sigpe !== '')
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$sigpe)}}" width="100" height="30">  <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;{{$inforoomservice->PERSON_REQUEST_NAME}}&nbsp;) <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ขอใช้&nbsp;
                @endif 
            @endif                  
        </td>
     </tr>   
</table> 
      <table>
        <tr>
            <td rowspan="3">
                <br>             
                <b>งานบริการห้องประชุม</b>
               <br><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;ประสานงานผู้เกี่ยวข้อง<br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;โภชนาศาสตร์<br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;ผู้ดูแลห้องประชุม<br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;ผู้ประสานงาน<br>
            </td>
            <td rowspan="2">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                
            </td>
            <td rowspan="3" style="text-align: center;">               
                <br>
                @if ($checksigno->ACTIVE == 'False')
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................ผู้ดูแลห้องประชุม<br> --}}
                &nbsp;...............................................&nbsp;<br> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;...............................................&nbsp;)<br>  
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลห้องประชุม&nbsp;

                @else
                        <br><br> 
                        @if ($inforoomservice->STATUS == 'LASTAPP' || $inforoomservice->STATUS == 'NOTLASTAPP')
                                @if($checksig == 1 && $siginad !== null && $siginad !== '')
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$siginad)}}" width="100" height="30"> <br>
                                        @foreach ($infoper as $item)  
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp; {{$item->HR_FNAME}}&nbsp;&nbsp;&nbsp;{{$item->HR_LNAME}}&nbsp;)<br>
                                        @endforeach
                                @endif 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลห้องประชุม
                            
                        @else 
                                @if($checksig == 1 && $siginad !== null && $siginad !== '')
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$siginad)}}" width="100" height="30">  <br>
                                            @foreach ($infoper as $item)  
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp; {{$item->HR_FNAME}}&nbsp;&nbsp;&nbsp;{{$item->HR_LNAME}}&nbsp;)<br>
                                            @endforeach
                                @endif 
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ดูแลห้องประชุม
                        @endif
                @endif         
                 
            </td>
        </tr>
      </table>
      <table>
        <tr>
            <td rowspan="3">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td rowspan="2">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                
            </td>
            <td rowspan="3" >
                @if ($checksigno->ACTIVE == 'False')
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;...............................................&nbsp;)<br>
                &nbsp;&nbsp;&nbsp;หัวหน้ากลุ่มงานพัฒนาทรัพยากรบุคคล
                @else
                     @if ($inforoomservice->STATUS == 'LASTAPP' || $inforoomservice->STATUS == 'NOTLASTAPP')
                         @if($checksig == 1 && $sigpo !== null && $sigpo !== '')
                             {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$sigpo)}}" width="100" height="40"> --}}
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................
                             <br>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br>
                            &nbsp;หัวหน้ากลุ่มงานพัฒนาทรัพยากรบุคคล
                         @endif
                     @else  
                            @if($checksig == 1 && $sigpo !== null && $sigpo !== '')
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...............................................
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br>
                            &nbsp;หัวหน้ากลุ่มงานพัฒนาทรัพยากรบุคคล
                        @endif   
                     @endif   
                @endif   
            </td>
        </tr>
      </table>
   <table>
    <tr>
        <td rowspan="3">
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          
        </td>
        <td rowspan="1">
            {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
        </td>
        <td rowspan="2" style="text-align: center;">
            <br>
            @if ($checksigno->ACTIVE == 'False')
                &nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;อนุมัติ &nbsp;&nbsp;
                &nbsp;&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;ไม่อนุมัติ &nbsp;&nbsp;<br><br><br><br><br>          
                &nbsp;&nbsp;...............................................<br>
                &nbsp;(&nbsp;{{$orgname->HR_PREFIX_NAME}} {{$orgname->HR_FNAME}} {{$orgname->HR_LNAME}}&nbsp;)<br>
                &nbsp;ผู้อำนวยการ{{$orgname->ORG_NAME}}

            @else
                        @if ($inforoomservice->STATUS == 'LASTAPP')
                            &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/checked.png')}}" width="10" height="10">&nbsp;&nbsp;อนุมัติ &nbsp;&nbsp;
                            &nbsp;&nbsp;<img src="{{Storage::path('public/images/checkno.jpg')}}" width="10" height="10">&nbsp;&nbsp;ไม่อนุมัติ 
                        @elseif ($inforoomservice->STATUS == 'NOTLASTAPP')
                            &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/checkno.jpg')}}" width="10" height="10">&nbsp;&nbsp;อนุมัติ &nbsp;&nbsp;
                            &nbsp;&nbsp;<img src="{{Storage::path('public/images/checked.png')}}" width="10" height="10">&nbsp;&nbsp;ไม่อนุมัติ 
                        @else
                            &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/checkno.jpg')}}" width="10" height="10">&nbsp;&nbsp;อนุมัติ &nbsp;&nbsp;
                            &nbsp;&nbsp;<img src="{{Storage::path('public/images/checkno.jpg')}}" width="10" height="10">&nbsp;&nbsp;ไม่อนุมัติ 
                        @endif  

            <br><br><br>
                        @if ($inforoomservice->STATUS == 'LASTAPP' || $inforoomservice->STATUS == 'NOTLASTAPP')
                            @if($checksig == 1 && $sigpo !== null && $sigpo !== '')
                                &nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$sigpo)}}" width="100" height="30"><br>
                                &nbsp;&nbsp;(&nbsp;{{$orgname->HR_PREFIX_NAME}} {{$orgname->HR_FNAME}} {{$orgname->HR_LNAME}}&nbsp;)<br>
                                ผู้อำนวยการ{{$orgname->ORG_NAME}}
                            @endif
                        @else  

                            @if($checksig == 1 && $sigpo !== null && $sigpo !== '')
                                &nbsp;&nbsp;&nbsp;<img src="{{Storage::path('public/images/'.$sigpo)}}" width="100" height="30"><br>
                                &nbsp;&nbsp;(&nbsp;{{$orgname->HR_PREFIX_NAME}} {{$orgname->HR_FNAME}} {{$orgname->HR_LNAME}}&nbsp;)<br>
                                ผู้อำนวยการ{{$orgname->ORG_NAME}}
                            @endif
                        @endif   
            @endif   
        </td>
    </tr>
  </table>
</center>
     </body>
  </html> 