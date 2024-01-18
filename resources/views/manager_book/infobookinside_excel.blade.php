<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOINSIDE.xls"');//ชื่อไฟล์

  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');

?>

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนหนังสือส่ง</B></h3>

</div>
<div class="block-content block-content-full">

<div class="table-responsive"> 
<!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
         

           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เลขรับ</th>                    
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เลขหนังสือ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่รับ</th>
         
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookinsides as $infobookinside)
                                <?php $number++;  ?>
                             
                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>



                                        @if($infobookinside->SEND_STATUS == '1')
                                        <td  align="center">ลงรับ</td>
                                        @elseif($infobookinside->SEND_STATUS == '2')
                                        <td  align="center">ส่งหน่วยงาน</td>
                                        @elseif($infobookinside->SEND_STATUS == '3')
                                        <td  align="center">ผอ.ลงนาม</td>
                                
                                       @elseif($infobookinside->SEND_STATUS == '4')
                                        <td  align="center">เสนอ ผอ.</td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif

                                        <td class="text-font" align="center" >{{ $infobookinside->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" >{{ $infobookinside->BOOK_NUMBER}}</td>
                                       
                                        @if($infobookinside->BOOK_SECRET_ID == 2)
                                        <td >ลับ :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @elseif($infobookinside->BOOK_SECRET_ID == 3)
                                        <td >ลับมาก :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @elseif($infobookinside->BOOK_SECRET_ID == 4)
                                        <td >ลับที่สุด :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @else
                                        <td > {{ $infobookinside->BOOK_NAME}}</td>
                                        @endif

                                        <td class="text-font" align="center">{{ DateThai($infobookinside->DATE_SAVE)}}</td>


                                    </tr>
                              
                                    @endforeach  
   </tbody>
</table>
