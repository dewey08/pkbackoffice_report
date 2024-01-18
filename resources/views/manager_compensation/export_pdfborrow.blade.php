
<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
<html>
<head>

<style>
        @font-face {
            font-family: 'THSarabunNew';  
            font-style: normal;
            font-weight: normal;  
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

      
 
        body {
            font-family: "THSarabunNew";
            font-size: 18px;
            line-height: 0.8;
            padding: 7.00pt 7.1732pt 7.1732pt 7.00pt;   
       
        }

        .text-pedding{
            padding-left:10px;
            padding-right:10px;
                                }
                                B {
                font-size: 11px;
       }
        
    </style>
<?php

        function DateThaifrom($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return $strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear;
    }

  $date = date("d/m/Y");

  

  function DateThaifrom2($strDate)
  {
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","01","02","03","04","05","06","07","08","09","10","11","12");
  $strMonthThai=$strMonthCut[$strMonth];
  return $strDay.'/'.$strMonthThai.'/'.$strYear;
  }

?>
</head>

<body>
</center>
<B>
ปีงบประมาณ&nbsp; {{$infosalaryborrow->BORROW_YEAR}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;รหัสเบิกจ่าย &nbsp;{{$infosalaryborrow->BORROW_NUMBER}}
<br>
ประเภทเงิน&nbsp;&nbsp;เงินบำรุง
<br>
หมวดรายจ่าย
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
แบบ &nbsp;216</B>
<br>

        <table  border="1" style="width: 100%;">
                 <tr>
                    <td class="text-pedding"  rowspan="2"><B>สัญญาการยืมเงิน </B><br>
                    <B> ยื่นต่อ ผู้อำนวยการ{{$infoorg->ORG_NAME}}</B>
                    </td>
                    <td class="text-pedding"  style="width: 30%;"><B>เลขที่ {{$infosalaryborrow->BORROW_NUMBER}}</B></td>
                   
                   
                                            
                </tr>
                <tr>
                <td class="text-pedding" ><B>วันครบกำหนด {{DateThaifrom2($infosalaryborrow->BORROW_END_DATE)}}<B></td>
             </tr>
                <tr>
                    <td class="text-pedding"  colspan="2"  >
                                <table border="0" style="width: 100%;">
                                    <tr>
                                        <td  style="width: 50%;">  ข้าพเจ้า {{$infosalaryborrow->BORROW_HR_PERSON_NAME}}</td> 
                                        <td>  ตำแหน่ง {{$infosalaryborrow->POSITION_IN_WORK}}{{$infosalaryborrow->HR_LEVEL_NAME}}  </td> 
                                    </tr>

                                    <tr>
                                        <td  style="width: 50%;">สังกัด {{$infosalaryborrow->HR_AGENCY_ID}} จังหวัด {{$infoorg->PROVINCE}} </td> 
                                        <td>มีความประสงค์ขอยืมเงินจาก เงินบำรุงของโรงพยาบาล</td> 
                                    </tr>
                                </table>
                                <table border="0" style="width: 100%;">
                                    <tr>
                                        <td  style="width: 80%;"> เพื่อ {{$infosalaryborrow->BORROW_COMMENT}} </td> 
                                        <td>  ดังรายละเอียดต่อไปนี้ </td> 
                                    </tr>
                                </table>
                                <table class="gwt-table table-striped table-vcenter js-dataTable-full" style="width: 100%;">                                                       
                                    @foreach ($detaillists as $detaillist)
                                    @if($detaillist->BORROW_SUB_PICE !== null && $detaillist->BORROW_SUB_PICE !== '')
                                        <tr>
                                            <td class="text-pedding" style="width: 70%;">{{$detaillist->BORROW_SUB_NAME}}</td> 
                                            <td class="text-pedding" style="text-align: right;">{{number_format($detaillist->BORROW_SUB_PICE,2)}} บาท</td> 
                                        
                                        </tr>
                                    @endif
                                    @endforeach  

                                    <tr bgcolor="#DCDCDC">
                                        <td  class="text-pedding" style="width: 70%;">จำนวนเงิน ({{convert(number_format($sumdetaillist,2))}})</td> 

                                        <td class="text-pedding" style="text-align: right;">  {{number_format($sumdetaillist,2)}} บาท</td> 
                                       
                                    </tr>
                                </table>
                                <br>              
                    </td>                          
                </tr>
                <tr>
                <td colspan="2" class="text-pedding" >   
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าสัญญาว่าจะปฏิบัติตามระเบียบทางราชการทุกประการ และจะนำใบสำคัญคู่จ่ายที่ถูกต้อง พร้อมทั้งเงินเหลือจ่าย (ถ้ามี) 
                 ส่งใช้ภายในกำหนดไว้ในระเบียบการเบิกจ่ายเงินจากคลัง คือ ภายใน {{$BORROWDATEAMOUNT}} วัน นับตั้งแต่วันที่ได้รับเงินนี้ <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ถ้าข้าพเจ้าไม่ส่งคืนตามกำหนด
                  ข้าพเจ้ายินยิมให้หักเงินเดือนค่าจ้าง เบี้ยหวัด บำเหน็จบำนาญ หรือเงินอื่นใด </u> ที่ข้าพเจ้าพึงได้รับจากทางราชการชดใช้จำนวนเงินที่ยืมไป
                  จนครบถ้วนได้ทันที<br><br><br>

                  ลายมื่อ...........................................ผู้ยืม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ {{DateThai($infosalaryborrow->BORROW_DATE)}}
                 <br>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infosalaryborrow->BORROW_HR_PERSON_NAME}}
                 <br>
                </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-pedding" >   
                     <B> เสนอ ผู้อำนวยการ{{$infoorg->ORG_NAME}} </B><br>
                    ได้ตรวจสอบแล้ว เห็นควรอนุมัติให้ยืมตามใบยืมฉบับนี้ได้จำนวน       {{number_format($sumdetaillist,2)}}         บาท<br><br>

                    ลายมื่อ...........................................ผู้ตรวจสอบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่............................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infover->HR_PREFIX_NAME}}{{$infover->HR_FNAME}} {{$infover->HR_LNAME}}
                 <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-pedding" > 
                    <center><B>คำอนุมัติ</B></center> <br>
                    อนุมัติให้ยืมตามเงื่อนไขข้างต้นได้ เป็นเงิน        {{number_format($sumdetaillist,2)}}        บาท<br><br>

                    ลายมื่อ...........................................ผู้อนุมัติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่............................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infoorg->HR_PREFIX_NAME}}{{$infoorg->HR_FNAME}} {{$infoorg->HR_LNAME}}
                 <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-pedding" >   

                    <center><B>ใบสำคัญรับเงิน</B></center> <br>
                    ได้รับเงินยืมจำนวน       {{number_format($sumdetaillist,2)}}        บาท<br>
                    ไว้เป็นการถูกต้องแล้ว<br><br>
                    ลายมื่อ...........................................ผู้รับเงิน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่............................................
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infosalaryborrow->BORROW_HR_PERSON_NAME}}
                 <br>
                    </td>
                </tr>

                
            </tbody>
        </table>
  
</div>


            

<script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
    <!-- Morris Chart Js -->
    <script src="{{ asset('assets/js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/morris/morris.js') }}"></script>
	
	
	<script src="{{ asset('assets/js/easypiechart.js') }}"></script>
	<script src="{{ asset('assets/js/easypiechart-data.js') }}"></script>
	
	 <script src="{{ asset('assets/js/Lightweight-Chart/jquery.chart.js') }}"></script>
	
    <!-- Custom Js -->
    <script src="{{ asset('assets/js/custom-scripts.js') }}"></script>
</body>
</html>