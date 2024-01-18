<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="riskincidencelevel.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerriskController;
?>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานการเกิด/แก้ไขอุบัติการณ์ความเสี่ยงแยกตามระดับความรุนแรง</B></h3>   
               <div align="right ">
                 
                  </div>
                </div>
             
                 
        <div class="block-content">  
            <div class="table-responsive"> 
               <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" >ระดับความรุนแรง</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">A</th>
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">B</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">C</th>
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">D</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">E</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">F</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">G</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">H</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">I</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">1</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">2</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">3</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">4</th> 
                        <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">5</th>    
                        <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">รวม</th>        
                        <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">ร้อยละ</th> 
                    </tr >
                </thead>
                <tbody>
                    <?php $number = 0; ?>
                    @foreach ($riskprograms as $riskprogram)
                        <?php
                        $number++;

                           $num1 = number_format(ManagerriskController::countrisklevel_sum($riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end));
                           $num2 = number_format(ManagerriskController::countrisklevel_sumall($displaydate_bigen,$displaydate_end)); 
                        ?>
               
                        <tr height="20">                       
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font text-pedding" style="text-align: left;">{{$riskprogram->RISK_REPPROGRAM_NAME}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('A',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('B',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('C',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('D',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('E',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('F',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('G',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('H',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('I',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('1',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('2',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('3',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('4',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>
                            <td class="text-font text-pedding" >{{number_format(ManagerriskController::countrisklevel('5',$riskprogram->RISK_REPPROGRAM_ID,$displaydate_bigen,$displaydate_end))}}</td>        
                            <td class="text-font text-pedding" >{{$num1}}</td>
                            <td class="text-font text-pedding" >{{number_format(($num1/$num2) *100,2)}} </td>
                        </tr>

                        @endforeach
                       
                    </tbody>
                </table>
    