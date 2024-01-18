@extends('layouts.headdep')

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
  
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
        
      }

       .text-pedding{
   padding-left:10px;
}

.text-font {
    font-size: 13px;
}   
</style>

@section('content')
<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
    </script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 


?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            }

            p {
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ใต้บังคับบัญชา</B></h3>
                 
            </div>
            <div class="block-content">


          
           
        
       <div class="panel-body" style="overflow-x:auto;">     
       <table class="gwt-table table-striped table-vcenter js-dataTable" width="100%">
       <thead style="background-color: #FFEBCD;">
                 
       <tr height="40">    
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" >ลำดับ</th>       
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="18%">ชื่อ นามสกุล</th>
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ฝ่าย/แผนก</th>
      
       <th class="text-font" style="border-color:#F0FFFF;text-align: center;"width="8%">ประเมิน</th>
       
     </tr>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $number = 0; ?>
                    @foreach ($infopersonapprovs as $infopersonapprov)
                    <?php $number++; ?>
                  <tr  height="20">
                    <td class="text-font" align="center">{{$number}}</td>  
                    <td class="text-pedding text-font">{{$infopersonapprov->PERSON_NAME}} </td> 
                    <td class="text-pedding text-font">{{$infopersonapprov->POSITION_IN_WORK}} </td>     
                    <td class="text-pedding text-font">{{$infopersonapprov->HR_DEPARTMENT_SUB_NAME}} </td>    
                    <td class="text-pedding text-font">{{$infopersonapprov->HR_DEPARTMENT_SUB_SUB_NAME}} </td>    
                    <td align="center">
                    <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                   ประเมิน
                                               </button>
                                               <div class="dropdown-menu" style="width:10px">
                                                 
                                                   <a class="dropdown-item" href="{{ url('person_headdep/headdep_kpis') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ข้อมูลตัวชี้วัด (KPI)</a>
                                                   <a class="dropdown-item" href="{{ url('person_headdep/headdep_corecompetency/'.$infopersonapprov->PERSON_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ประเมิน Core</a>
                                                   <a class="dropdown-item" href="{{ url('person_headdep/headdep_funtionalcompetency/'.$infopersonapprov->PERSON_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  > ประเมิน Funtional</a>

                                               </div>
                   </div>
                    </td>                        

                  </tr>
                  @endforeach

              
             
                  </tbody>
                 </table>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>
        
            </div>
   

  

@endsection