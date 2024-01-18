<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFORECEIPT.xls"');//ชื่อไฟล์

  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>


<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนหนังสือรับ</B></h3>

</div>
<div class="block-content block-content-full">


</div>
<div class="table-responsive" style="height:500px;"> 
<!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>         

           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ส่งหน่วยงาน</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขรับ</th>                    
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เลขหนังสือ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่รับ</th>
          
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookreceipts as $infobookreceipt)
                                <?php $number++;  ?>
                               
                              
                                  <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                                       

                                        @if($infobookreceipt->SEND_STATUS == '1')
                                        <td  align="center">ลงรับ</td>
                                        @elseif($infobookreceipt->SEND_STATUS == '2')
                                        <td  align="center">ส่งหน่วยงาน</td>
                                        @elseif($infobookreceipt->SEND_STATUS == '3')
                                        <td  align="center">ผอ.ลงนาม</td>
                                
                                       @elseif($infobookreceipt->SEND_STATUS == '4')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เสนอ ผอ.</td>
                                       @else
                                       <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{ $infobookreceipt->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookreceipt->BOOK_NUMBER}}</td>
                                           
                                        @if($infobookreceipt->BOOK_SECRET_ID == 2)
                                        <td >ลับ :: {{ $infobookreceipt->BOOK_NAME}}</td>
                                        @elseif($infobookreceipt->BOOK_SECRET_ID == 3)
                                        <td >ลับมาก :: {{ $infobookreceipt->BOOK_NAME}}</td>
                                        @elseif($infobookreceipt->BOOK_SECRET_ID == 4)
                                        <td >ลับที่สุด :: {{ $infobookreceipt->BOOK_NAME}}</td>
                                        @else
                                        <td > {{ $infobookreceipt->BOOK_NAME}}</td>
                                        @endif
                                        
                                      
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($infobookreceipt->DATE_SAVE)}}</td>
                  
                                 

                                    </tr>



@endforeach  
   </tbody>
</table>
