<?php
header("Content-Type: application/vnd.msword");
header('Content-Disposition: attachment; filename="Operate.doc"');//ชื่อไฟล์

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
                <B>สรุปข้อมูลตารางเวรปฏิบัติงาน<br></B>      
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
                 