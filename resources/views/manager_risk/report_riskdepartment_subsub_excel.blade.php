<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="riskdepartment_subsub.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerriskController;
?>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานหน่วยงานที่รายงานอุบัติการณ์ความเสี่ยง</B></h3>   
               
            
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
                        @foreach ($infodepsubsubs as $infodepsubsub)
                            <?php
                                $number++;

                                $num1 = number_format(ManagerriskController::countriskdepsubsub_sum($infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end));
                                $num2 = number_format(ManagerriskController::countriskdepsubsub_sumall($displaydate_bigen,$displaydate_end)); 

                            ?>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" style="text-align: left;">  {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('A',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('B',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('C',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('D',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('E',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('F',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('G',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('H',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('I',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('1',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td> 
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('2',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('3',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>  
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('4',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>
                                <td class="text-font text-pedding" >{{number_format(ManagerriskController::countriskdepsubsub('5',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end))}}</td>        
                                <td class="text-font text-pedding" >{{$num1}}</td>
                                <td class="text-font text-pedding" >{{number_format(($num1/$num2) *100,2)}} </td>
                            </tr>

                            @endforeach
                       
                       
                    </tbody>
                </table>
      