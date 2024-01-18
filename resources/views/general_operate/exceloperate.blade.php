<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Operate.xls"');//ชื่อไฟล์

function Monththai($strtime)
{
  if($strtime == '1'){
      $month = 'มกราคม';
  }else if($strtime == '2'){
      $month = 'กุมภาพันธ์';
  }else if($strtime == '3'){
      $month = 'มีนาคม';
  }else if($strtime == '4'){
      $month = 'เมษายน';
  }else if($strtime == '5'){
      $month = 'พฤษภาคม';
  }else if($strtime == '6'){
      $month = 'มิถุนายน';
  }else if($strtime == '7'){
      $month = 'กรกฎาคม';
  }else if($strtime == '8'){
      $month = 'สิงหาคม';
  }else if($strtime == '9'){
      $month = 'กันยายน';
  }else if($strtime == '10'){
      $month = 'ตุลาคม';
  }else if($strtime == '11'){
      $month = 'พฤศจิกายน';
  }else if($strtime == '12'){
      $month = 'ธันวาคม';
  }else{
      $month = '';
  }

  return $month;
  }

  function Yearthai($strtime)
  {
    $year = $strtime+543;
    return $year;
  }
?>  

<style>
  
  @font-face {
    font-family: 'THSarabunNew';
    src:  url('{{ asset('Font/THSarabunNew.ttf') }}') format('truetype');
  
}

body{
            font-family: 'THSarabunNew', sans-serif;   
      } 

      .font-size{
        font-size: 20px;
           
                   
      } 

</style>

<body>
              
               
                <center>
                <B>สรุปข้อมูลตารางเวรปฏิบัติงาน {{$infooper->OPERATE_TYPE_NAME}} 
                    
                <br>ประจำเดือน {{Monththai($operateindexinfo->OPERATE_INDEX_MONTH)}}   ปี พ.ศ. {{Yearthai($operateindexinfo->OPERATE_INDEX_YEAR)}}  หน่วยงาน {{$operateindexinfo->HR_DEPARTMENT_SUB_SUB_NAME}} </B>      
                </center>
                <br>  
               
                       <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                       <table border="1" style="border-color: #000000;"  width="100%">
                           <thead >
                               <tr style="background-color: #FFEBCD;">
                                   <th class="text-center" width="1%">ลำดับ</th>
                                   <th class="text-center" width="7%">ชื่อ-นามสกุล</th>
                                   <th class="text-center" width="5%">ตำแหน่ง</th>
                                 
                                   <th class="text-center" width="1%">1</th>
                                   <th class="text-center" width="1%">2</th>
                                   <th class="text-center" width="1%">3</th>
                                   <th class="text-center" width="1%">4</th>
                                   <th class="text-center" width="1%">5</th>
                                   <th class="text-center" width="1%">6</th>
                                   <th class="text-center" width="1%">7</th>
                                   <th class="text-center" width="1%">8</th>
                                   <th class="text-center" width="1%">9</th>
                                   <th class="text-center" width="1%">10</th>
                                   <th class="text-center" width="1%">11</th>
                                   <th class="text-center" width="1%">12</th>
                                   <th class="text-center" width="1%">13</th>
                                   <th class="text-center" width="1%">14</th>
                                   <th class="text-center" width="1%">15</th>
                                   <th class="text-center" width="1%">16</th>
                                   <th class="text-center" width="1%">17</th>
                                   <th class="text-center" width="1%">18</th>
                                   <th class="text-center" width="1%">19</th>
                                   <th class="text-center" width="1%">20</th>
                                   <th class="text-center" width="1%">21</th>
                                   <th class="text-center" width="1%">22</th>
                                   <th class="text-center" width="1%">23</th>
                                   <th class="text-center" width="1%">24</th>
                                   <th class="text-center" width="1%">25</th>
                                   <th class="text-center" width="1%">26</th>
                                   <th class="text-center" width="1%">27</th>
                                   <th class="text-center" width="1%">28</th>
                                   <th class="text-center" width="1%">29</th>
                                   <th class="text-center" width="1%">30</th>
                                   <th class="text-center" width="1%">31</th>
                                  
                           
                                  
                                
                                   
                               </tr>
                           </thead>
                           <tbody>
                           <?php 
                           use Illuminate\Http\Request;
                           use Illuminate\Support\Facades\DB;
                           $number = 0; ?>
                           @foreach ($infoactivitys as $infoactivity)
                           <?php $number++;  ?>
                           <tr>
                          
                          <td align="center" >{{$number}}</td>
                          <td class="text-pedding text-font">{{ $infoactivity->OPERATE_MEMBER_PERSON_NAME }}</td>
                          <td class="text-pedding text-font">{{ $infoactivity->OPERATE_MEMBER_POSITION_NAME }}</td>
                              
                 
                                   @foreach ($operatejobs as $operatejob)
                                       <?php 
                                  
                                           if($infoactivity->DATE_1 == $operatejob->OPERATE_JOB_ID){
                                               $DATE_1 = $operatejob->OPERATE_JOB_NAME;
                                               $color_1 = $operatejob->OPERATE_JOB_COLOR;
                                               break;
                                           }else{
                                               $DATE_1='';
                                               $color_1 ='';       
                                           }                             
                                       ?>
                                   @endforeach


                           <!------------------------------------------------------>           
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_2 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_2 = $operatejob->OPERATE_JOB_NAME;
                                       $color_2 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_2='';
                                       $color_2 = '';      
                                   }
                                   
                              ?>
                          @endforeach  
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_3 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_3 = $operatejob->OPERATE_JOB_NAME;
                                       $color_3 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_3='';
                                       $color_3 = '';            
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_4 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_4 = $operatejob->OPERATE_JOB_NAME;
                                       $color_4 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_4='';
                                       $color_4 = '';   
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_5 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_5 = $operatejob->OPERATE_JOB_NAME;
                                       $color_5 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_5='';
                                       $color_5 = '';      
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_6 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_6 = $operatejob->OPERATE_JOB_NAME;
                                       $color_6 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_6='';
                                       $color_6 = '';      
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_7 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_7 = $operatejob->OPERATE_JOB_NAME;
                                       $color_7 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_7='';
                                       $color_7 = '';         
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_8 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_8 = $operatejob->OPERATE_JOB_NAME;
                                       $color_8 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_8=''; 
                                       $color_8 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_9 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_9 = $operatejob->OPERATE_JOB_NAME;
                                       $color_9 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_9='';
                                       $color_9 = '';        
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_10 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_10 = $operatejob->OPERATE_JOB_NAME;
                                       $color_10 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_10='';
                                       $color_10 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_11 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_11 = $operatejob->OPERATE_JOB_NAME;
                                       $color_11 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_11=''; 
                                       $color_11 = '';        
                                   }
                                   
                              ?>
                          @endforeach   

                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_12 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_12 = $operatejob->OPERATE_JOB_NAME;
                                       $color_12 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_12='';
                                       $color_12 = '';          
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_13 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_13 = $operatejob->OPERATE_JOB_NAME;
                                       $color_13 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_13='';
                                       $color_13 = '';          
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_14 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_14 = $operatejob->OPERATE_JOB_NAME;
                                       $color_14 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_14='';
                                       $color_14 = '';         
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_15 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_15 = $operatejob->OPERATE_JOB_NAME;
                                       $color_15 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_15='';
                                       $color_15 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_16 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_16 = $operatejob->OPERATE_JOB_NAME;
                                       $color_16 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_16=''; 
                                       $color_16 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_17 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_17 = $operatejob->OPERATE_JOB_NAME;
                                       $color_17 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_17=''; 
                                       $color_17 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_18 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_18 = $operatejob->OPERATE_JOB_NAME;
                                       $color_18 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_18='';       
                                       $color_18 = '';   
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_19 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_19 = $operatejob->OPERATE_JOB_NAME;
                                       $color_19 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_19='';
                                       $color_19 = '';          
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_20 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_20 = $operatejob->OPERATE_JOB_NAME;
                                       $color_20 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_20='';
                                       $color_20 = '';        
                                   }
                                   
                              ?>
                          @endforeach   

                            <!------------------------------------------------------>   
                            @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_21 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_21 = $operatejob->OPERATE_JOB_NAME;
                                       $color_21 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_21='';
                                       $color_21 = '';           
                                   }
                                   
                              ?>
                          @endforeach   

                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_22 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_22 = $operatejob->OPERATE_JOB_NAME;
                                       $color_22 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_22='';
                                       $color_22 = '';         
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_23 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_23 = $operatejob->OPERATE_JOB_NAME;
                                       $color_23 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_23='';
                                       $color_23 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_24 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_24 = $operatejob->OPERATE_JOB_NAME;
                                       $color_24 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_24=''; 
                                       $color_24 = '';        
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_25 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_25 = $operatejob->OPERATE_JOB_NAME;
                                       $color_25 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_25='';
                                       $color_25 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_26 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_26 = $operatejob->OPERATE_JOB_NAME;
                                       $color_26 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_26='';
                                       $color_26 = '';              
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_27 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_27 = $operatejob->OPERATE_JOB_NAME;
                                       $color_27 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_27=''; 
                                       $color_27 = '';         
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_28 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_28 = $operatejob->OPERATE_JOB_NAME;
                                       $color_28 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_28=''; 
                                       $color_28 = '';      
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_29 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_29 = $operatejob->OPERATE_JOB_NAME;
                                       $color_29 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_29='';
                                       $color_29 = '';       
                                   }
                                   
                              ?>
                          @endforeach   
                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_30 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_30 = $operatejob->OPERATE_JOB_NAME;
                                       $color_30 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_30='';
                                       $color_30 = '';           
                                   }
                                   
                              ?>
                          @endforeach  

                           <!------------------------------------------------------>   
                           @foreach ($operatejobs as $operatejob)
                                <?php 
                                   if($infoactivity->DATE_31 == $operatejob->OPERATE_JOB_ID){
                                       $DATE_31 = $operatejob->OPERATE_JOB_NAME;
                                       $color_31 = $operatejob->OPERATE_JOB_COLOR;
                                       break;
                                    }else{
                                       $DATE_31='';
                                       $color_31 = '';       
                                   }
                                   
                              ?>
                          @endforeach   



                          <td class="text-font" align="center" bgcolor="{{ $color_1 }}">{{$DATE_1}}</td>
                          <td class="text-font" align="center" bgcolor="{{ $color_2 }}">{{$DATE_2}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_3 }}">{{$DATE_3}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_4 }}">{{$DATE_4}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_5 }}">{{$DATE_5}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_6 }}">{{$DATE_6}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_7 }}">{{$DATE_7}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_8 }}">{{$DATE_8}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_9 }}">{{$DATE_9}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_10 }}">{{$DATE_10}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_11 }}">{{$DATE_11}}</td>
                          <td class="text-font" align="center" bgcolor="{{ $color_12 }}">{{$DATE_12}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_13 }}">{{$DATE_13}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_14 }}">{{$DATE_14}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_15 }}">{{$DATE_15}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_16 }}">{{$DATE_16}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_17 }}">{{$DATE_17}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_18 }}">{{$DATE_18}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_19 }}">{{$DATE_19}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_20 }}">{{$DATE_20}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_21 }}">{{$DATE_21}}</td>
                          <td class="text-font" align="center" bgcolor="{{ $color_22 }}">{{$DATE_22}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_23 }}">{{$DATE_23}}</td>  
                          <td class="text-font" align="center" bgcolor="{{ $color_24 }}">{{$DATE_24}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_25 }}">{{$DATE_25}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_26 }}">{{$DATE_26}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_27 }}">{{$DATE_27}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_28 }}">{{$DATE_28}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_29 }}">{{$DATE_29}}</td> 
                          <td class="text-font" align="center" bgcolor="{{ $color_30 }}">{{$DATE_30}}</td>
                          <td class="text-font" align="center" bgcolor="{{ $color_31 }}">{{$DATE_31}}</td>
                       
                          @endforeach 
                          </tr>
                   </tbody>
                  </table>
                  <br>
                  
                  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
                  ลงชื่อ........................................(ผู้อนุมัติเวร)
                  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 (........................................)
                 