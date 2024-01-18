<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSONLEAVEDAY.xls"');//ชื่อไฟล์


use App\Http\Controllers\ManagerleaveController;
?>
<?php

$color_a = 'background-color: #F0F8FF;';

?>

<center>

    <div style="width:95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                        <div class="col-md-10" align="left">
                            รายงานวันลาบุคลากร
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </h2>

         
                                    &nbsp;ปี &nbsp;

                                    {{$budgetyearnow}}
                                  
                           
                                            &nbsp; เดือน  &nbsp;
                              

                                               
                                                @if($month == '01')มกราคม
                                                @elseif($month == '02')กุมภาพันธ์ 
                                                @elseif($month == '03') มีนาคม
                                                @elseif($month == '04')เมษายน
                                                @elseif($month == '05')พฤษภาคม
                                                @elseif($month == '06')มิถุนายน
                                                @elseif($month == '07')กรกฎาคม 
                                                @elseif($month == '08')สิงหาคม 
                                                @elseif($month == '09')กันยายน
                                                @elseif($month == '10')ตุลาคม 
                                                @elseif($month == '11')พฤศจิกายน  
                                                @elseif($month == '12')ธันวาคม @endif


  &nbsp;ค้นหา &nbsp;{{$search}}
               

                <div class="panel-body" style="overflow-x:auto;">

                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                        <thead style="background-color: #FFEBCD;">

                            <tr height="40">
                                <td class="text-font"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="5%"
                                rowspan="2">ลำดับ</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="15%"
                                    rowspan="2">ชื่อ นามสกุล</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">ตำแหน่ง</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">ฝ่าย/แผนก</td>

                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    colspan="4">ประเภทการลา</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">รวมได้ลาแล้ว</td>
               

                            </tr>
                            <tr>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ลาป่วย</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลากิจ</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลาพักผ่อน
                                </td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลาคลอดบุตร
                                </td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($persons as $person)

                            <?php $number++; 
                  

                            if( $person->HR_STATUS_ID == 5 || $person->HR_STATUS_ID == 6 || $person->HR_STATUS_ID == 7 || $person->HR_STATUS_ID == 8){
                            $color = 'background-color: #FFF0F5;';
                           
                             }else{
                             $color = '';
                            }
                            ?> 

                            <tr style="{{$color}}"  height="20">
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $number }}</td>                     
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                     
        
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> POSITION_IN_WORK }}</td>   
                              
           
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>    
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'01')}}
                                </td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'03') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'04') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'02') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::sumleavemonth($person ->ID,$budgetyearnow,$month) }}</td>
                            

                            </tr>
                            @endforeach 
                        </tbody>
                    </table>

                </div>

      