<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOANNOUNCE.xls"');//ชื่อไฟล์

  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');

?>

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลประกาศ</B></h3>

<div class="block-content block-content-full">


<div class="table-responsive"> 

<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
         
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">File</th>
                       
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่รับ</th>
        
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookannounces as $infobookannounce)
                                <?php $number++;  ?>
                               
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>

                                        @if($infobookannounce->BOOK_HAVE_FILE == 'True')
                                            <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookannounce->BOOK_FILE_NAME) ; ?>
                                                @if(file_exists($bookpdf))
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @else
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @endif
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif

                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookannounce->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookannounce->BOOK_DETAIL}}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($infobookannounce->DATE_SAVE)}}</td>


                                        
                                        
                                      

                                    </tr>
                                    @endforeach  
   </tbody>
</table>
