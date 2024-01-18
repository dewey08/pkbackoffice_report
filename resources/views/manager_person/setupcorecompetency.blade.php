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
          <div class="col-md-7" align="left">
            ตั้งค่า Core competency
            </div>
          <div class="col-md-5" align="right">
               <a href="{{ url('manager_person/setupcorecompetency_add')  }}"  class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
              
          </div>
          </div>
          </h2>  
                                
        <div class="panel-body" style="overflow-x:auto;">     
        <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" >ลำดับ</th>     
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  >Core competency</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="60%">คำจำกัดความ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="8%">ระดับ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">เปิดใช้</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"width="8%">คำสั่ง</th>
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>


                    <?php $number = 0; ?>
                      @foreach ($corecompetecys as $corecompetecy)
                      <?php $number++;  ?>

                   <tr height="20">
                     <td class="text-font text-pedding" >{{$number}}</td> 
                     <td class="text-font text-pedding">{{ $corecompetecy-> COR_COM_NAME }}</td>  
                     <td class="text-font text-pedding">{{ $corecompetecy-> COR_COM_DETAIL }}</td>  
                     <td class="text-font text-pedding" align="center">
                     <a href="{{ url('manager_person/setupcorecompetencylevel/'.$corecompetecy-> COR_COM_ID )}}"     class="btn btn-success fa fa-chevron-down"></a>
                     </td> 
                     <td align="center" width="5%">
                                            <div class="custom-control custom-switch custom-control-lg ">
                                             @if($corecompetecy-> ACTIVE == 'True' )
                                                 <input type="checkbox" class="custom-control-input" id="{{ $corecompetecy-> COR_COM_ID }}" name="{{ $corecompetecy-> COR_COM_ID }}" onchange="switchactive({{ $corecompetecy-> COR_COM_ID }});" checked>
                                             @else
                                                <input type="checkbox" class="custom-control-input" id="{{ $corecompetecy-> COR_COM_ID }}" name="{{ $corecompetecy-> COR_COM_ID }}" onchange="switchactive({{ $corecompetecy-> COR_COM_ID }});">
                                             @endif
                                                <label class="custom-control-label" for="{{ $corecompetecy-> COR_COM_ID }}"></label>
                                            </div>
                    </td>
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="{{ url('manager_person/setupcorecompetency_edit/'.$corecompetecy-> COR_COM_ID )}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >แก้ไข</a>
                                                    <a class="dropdown-item" href="{{ url('manager_person/setupcorecompetency_destroy/'.$corecompetecy-> COR_COM_ID )}}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ลบ</a>
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