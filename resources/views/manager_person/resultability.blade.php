@extends('layouts.person')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

table, td, th {
    border: 1px solid black;   
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

$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>
       
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-10" align="left">
            ผลการประเมิน
          </div>
          <div class="col-md-2">
               <a href="{{ url('person/excelall')}}"  class="btn btn-success btn-lg"  ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
             
          </div>
          </div>
          </h2>  
                                
             <form action="{{ route('mperson.search') }}" method="get">
            
               
             <div class="row">
             <div class="col-md-4">
                  
                  </div>  
                
                  <div class="col-md-2">
                    ปีงบประมาณ
                  </div>  
                  <div class="col-md-2">
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>2563</option>
                    <option>2562</option>
                  
                  </select>
                    </div>  
                 
                  <div class="col-md-3">
                  <span>
                 <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >
                </span>
                 </div>
                 <div class="col-md-1">
                 <span>
                     <button type="submit" class="btn btn-info" >ค้นหา</button>
                 </span> 
                 </div>
               
          
                  </div>  
             </form>
            
         
        <div class="panel-body" style="overflow-x:auto;">     
        <table class="table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;" style="border: 1px solid black;"  >
                  
        <tr height="40" style="border: 1px solid black;"   >    
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%"  rowspan="2">ลำดับ</td>       

      
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="18%" rowspan="2">ชื่อ นามสกุล</td>
            

        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" rowspan="2">ตำแหน่ง</td>
      
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" rowspan="2">หน่วยงาน</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;border: 1px solid black;"  colspan="5">ครั้งที่ 1</td>   
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #AFEEEE;border: 1px solid black;"  colspan="5">ครั้งที่ 2</td>          
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">สรุป</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2"width="5%">คำสั่ง</td>
      </tr>

      <tr height="40" style="border: 1px solid black;"   >    

        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #FFF0F5;border: 1px solid black;"">KPI</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #E6E6FA;border: 1px solid black;"">Core</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #FAFAD2;border: 1px solid black;"">Func</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;border: 1px solid black;"">ระดับ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #48D1CC;border: 1px solid black;"">คะแนน</td>
        
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #FFF0F5;border: 1px solid black;"">KPI</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #E6E6FA;border: 1px solid black;"">Core</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #FAFAD2;border: 1px solid black;"">Func</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #F0F8FF;border: 1px solid black;"">ระดับ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center; background-color: #48D1CC;border: 1px solid black;"">คะแนน</td>


        </tr>
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
                   <tr style="{{$color}}" height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>  

                     <td class="text-pedding text-font">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     

                     <td class="text-pedding text-font"> {{ $person -> POSITION_IN_WORK }}</td>   
    
                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_SUB_NAME }}</td> 
                     <td class="text-pedding text-font"> </td>  
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                     <td class="text-pedding text-font"> </td> 
                   
                     <td align="center">
                    <div class="dropdown">
                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                   ประเมิน
                                               </button>
                                               <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('manager_person/jobdescription') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >Job description</a>
                                                    <a class="dropdown-item" href="{{ url('manager_person/kpis_detail') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ข้อมูลตัวชี้วัด (KPI)</a>
                                                    <a class="dropdown-item" href="{{ url('manager_person/corecompetency_detail') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ประเมิน Core</a>
                                                    <a class="dropdown-item" href="{{ url('manager_person/funtionalcompetency_detail') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  > ประเมิน Funtional</a>

                                               </div>
                   </div>
                    </td>                        
                   </tr>

                   @endforeach 
                   </tbody>
                  </table>
</div>
    
                      

@endsection
@section('footer')
    
     <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


        <script>

          function checkpass(id) {
          var  text;
          var  NEWPASSWORD = document.getElementById("NEWPASSWORD_"+id).value;
          var  CHECK_NEWPASSWORD = document.getElementById("CHECK_NEWPASSWORD_"+id).value;

       
         // alert(NEWPASSWORD);
         
            if(NEWPASSWORD !== CHECK_NEWPASSWORD){
              document.getElementById("text"+id).style.display = "";     
            text = "*กรุณาระบุรหัสผ่านให้ตรงกับยืนยันรหัสผ่าน";
            document.getElementById("text"+id).innerHTML = text;
            

          }
          

          if(NEWPASSWORD !== CHECK_NEWPASSWORD){
             return false; 
          }else if(NEWPASSWORD==null || NEWPASSWORD=='' || CHECK_NEWPASSWORD==null || CHECK_NEWPASSWORD==''){
  
            return false; 
          }

          }

        </script>
@endsection