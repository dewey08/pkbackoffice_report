<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="report_riskdepartment_self_subsub.xls"');//ชื่อไฟล์

use App\Http\Controllers\ManagerriskController;
use App\Models\Riskrep;
?>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานหน่วยงานที่รายงานอุบัติการณ์ความเสี่ยงของตนเอง</B></h3>   
               
                  
                 
        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" >ระดับความรุนแรง</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">A</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">B</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">C</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">D</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">E</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">F</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">G</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">H</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">I</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">1</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">2</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">3</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">4</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">5</th>    
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="7%">จำนวนรวม</th>                        
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="7%">ร้อยละ</th> 
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($infodepsubsubs as $infodepsubsub)
                            <?php
                            $number++;

                               $number01 = number_format(ManagerriskController::countriskdepsubsub_self_sum('0',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end));
                               $number02 = number_format(ManagerriskController::countriskdepsubsub_self_all('0',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end));
                            
                                   if($number02 == 0  ){
                                    $sumper = 0;
                                   }else{
                                    $sumper = ($number01/$number02)*100;
                                   }

                                    $from = date($displaydate_bigen);
                                    $to = date($displaydate_end);

                                        $information =  Riskrep::leftjoin('risk_account_detail','.RISKREP_ACC_ID','=','risk_account_detail.RISK_ACC_ID')
                                        ->where('RISKREP_DEPARTMENT_SUB','=',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID)
                                        ->where('RISK_ACC_AGENCY','=',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID)
                                        ->WhereBetween('RISKREP_DATESAVE',[$from,$to]) 
                                        ->get();

                                        $A=0;$B=0;$C=0;$D=0;$E=0;$F=0;$G=0;$H=0;$I=0;
                                        $num1=0;$num2=0;$num3=0;$num4=0;$num5=0;
                                        foreach ($information as $info){

                                             if($info->RISKREP_LEVEL == 'A'){ $A++; }
                                             elseif($info->RISKREP_LEVEL== 'B'){ $B++; }
                                             elseif($info->RISKREP_LEVEL== 'C'){ $C++; }
                                             elseif($info->RISKREP_LEVEL== 'D'){ $D++; }
                                             elseif($info->RISKREP_LEVEL== 'E'){ $E++; }
                                             elseif($info->RISKREP_LEVEL== 'F'){ $F++; }
                                             elseif($info->RISKREP_LEVEL== 'G'){ $G++; }
                                             elseif($info->RISKREP_LEVEL== 'H'){ $H++; }
                                             elseif($info->RISKREP_LEVEL== 'I'){ $I++; }
                                             elseif($info->RISKREP_LEVEL== '1'){ $num1++; }
                                             elseif($info->RISKREP_LEVEL== '2'){ $num2++; }
                                             elseif($info->RISKREP_LEVEL== '3'){ $num3++; }
                                             elseif($info->RISKREP_LEVEL== '4'){ $num4++; }
                                             elseif($info->RISKREP_LEVEL== '5'){ $num5++; }
                                         

                                        }

                                    

                            ?>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" style="text-align: left;">  {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($A)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($B)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($C)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($D)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($E)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($F)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($G)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($H)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($I)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num1)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num3)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num4)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num5)}}</td>        
                                <td class="text-font text-pedding" style="text-align: center;background-color: #FFF8DC;" >{{$number01}}</td>
                                <td class="text-font text-pedding" style="text-align: center;background-color: #FFF8DC;" >{{number_format($sumper,2)}}</td>
                            </tr>

                            @endforeach


                           <tr style="background-color: #E0FFFF;" height="20">                       
                    
                                <td class="text-font text-pedding" style="text-align: center;" colspan="2" >รวม</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumA)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumB)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumC)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumD)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumE)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumF)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumG)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumH)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumI)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum1)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum3)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum4)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum5)}}</td>        
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumuse)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumuse/$sumall )* 100,2)}}</td>
                            </tr>
                            
                           <tr style="background-color: #E0FFFF;" height="20">                       
                          
                            <td class="text-font text-pedding" style="text-align: center;" colspan="2" >ร้อยละ</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumA/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumB/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumC/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumD/$sumuse)*100,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumE/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumF/$sumuse)*100,2)}}</td> 
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumG/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumH/$sumuse)*100,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumI/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumnum1/$sumuse)*100,2)}}</td> 
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumnum2/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumnum3/$sumuse)*100,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumnum4/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumnum5/$sumuse)*100,2)}}</td>        
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumuse/$sumuse)*100,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>                
               
        </div>
    </div>    
</div> 
  