<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSONUSE.xls"');

 ?>
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>จ่ายออกวัสดุบุคคล | หน่วยงาน {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}</B></h3>

        </div>
        <div class="block-content block-content-full">

        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยนับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคาต่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ารวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้จ่ายวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้เบิกวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คลัง</th>

                       
                        </tr >
                    </thead>
                    <tbody>     
                  
                    <?php $number = 0; ?>
                    @foreach ($infomationuses as $infomationuse)

                    <?php $number++;   ?>
                    <tr height="20">
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>
                       
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infomationuse ->TREASURT_PAY_CODE  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ Datethai($infomationuse ->TREASURT_PAY_DATE)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURY_EXPORT_SUB_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_AMOUNT,0)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->SUP_UNIT_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_PICE_UNIT,2)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_VALUE,2)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_SAVE_HR_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_REQUEST_HR_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_NAME  }}</td>
            
                        </tr>
                    @endforeach   
                 
                


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
