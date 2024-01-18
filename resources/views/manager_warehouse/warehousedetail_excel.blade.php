<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_WAREHOUSEDETAIL.xls"');//ชื่อไฟล์
 
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
     
            <div class="block-header block-header-default">
          
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการตรวจรับ</B></h3>
                               
            
            </div>
            <div class="block-content ">
        
          </form>
             <div class="table-responsive"> 
             <div align="right">มูลค่ารวม {{number_format($sumbudget,5)}}  บาท</div>
               
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">เลขทะเบียนคุม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ตรวจรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประเภทการรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประเภทวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">คลังที่รับเข้า</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับจาก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เลขที่เอกสาร</th>
                            
                        </tr >
                    </thead>
                    <tbody>

                    <?php $count=1;?>
                     @foreach ($infocheckreceives as $infocheckreceive)

                     <?php 
                    
                    $status =  $infocheckreceive -> RECEIVE_CHECK_STATUS;

                    if( $status == 1){
                       $statuscol =  "badge badge-success";

                   }else if($status == 2){
                      $statuscol =  "badge badge-warning";

                   }else if($status == 3){
                    $statuscol =  "badge badge-info";

                  }else{
                       $statuscol =  "badge badge-secondary";
                   }
                    
                    ?>


                     <tr height="20">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >
                        <span class="{{$statuscol}}">{{$infocheckreceive->STATUS_CHECK_NAME}}</span>
                        
                        </td>
                        <td class="text-font text-pedding" >{{$infocheckreceive->RECEIVE_CODE}}</td>
                        <td class="text-font text-pedding" >{{$infocheckreceive->CON_NUM}}</td>
                        @if($infocheckreceive->RECEIVE_CHECK_DATE == '0000-00-00' || $infocheckreceive->RECEIVE_CHECK_DATE == null)
                        <td class="text-font text-pedding" ></td>
                        @else
                        <td class="text-font text-pedding" >{{DateThai($infocheckreceive->RECEIVE_CHECK_DATE)}}</td>
                        @endif
                       

                        @if($infocheckreceive->TYPE_CHECK_NAME == 'รับจากพัสดุ')
                        <td class="text-font text-pedding" ><span class="badge badge-success">{{$infocheckreceive->TYPE_CHECK_NAME}}</span></td>
                        @else
                        <td class="text-font text-pedding" ><span class="badge badge-warning">{{$infocheckreceive->TYPE_CHECK_NAME}}</span></td>
                        @endif
                      
                        <td class="text-font text-pedding" >{{$infocheckreceive->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infocheckreceive->INVEN_NAME}}</td>
                      
                        <td class="text-font text-pedding" >{{$infocheckreceive->RECEIVE_ACCEPT_FROM}}</td>
                        <td class="text-font text-pedding" >{{$infocheckreceive->RECEIVE_PERSON_NAME}}</td>
                        <td class="text-font text-pedding" align="right">{{number_format($infocheckreceive->RECEIVE_VALUE,5)}}</td>
                        <td class="text-font text-pedding" >{{$infocheckreceive->RECEIVE_NUMBER}}</td>
            
                        </tr>



                     <?php  $count++;?>

                    @endforeach 

                 
                  

                    </tbody>
                </table>
      