@extends('layouts.leave')
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

                                
             <form action="{{ route('mperson.search') }}" method="get">
            
             <div class="row">
                   <div class="col-md-5" align="left">
                  กำหนดการนับรวมวันลาในวันหยุด
                   </div>
                   <div class="col-md-3">
                    
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
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" >ลำดับ</th>       
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%" >CID</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="18%">ชื่อ นามสกุล</th>
            
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สถานะ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ฝ่าย/แผนก</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รวมวันหยุด</th>
       
     
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
                     <td class="text-font" align="center"> {{ $person -> HR_CID }}</td>  
                     <td class="text-pedding text-font">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                 
                     <td class="text-pedding text-font"> {{ $person -> HR_STATUS_NAME }}</td>   
                     <td class="text-pedding text-font"> {{ $person -> POSITION_IN_WORK }}</td>   
                   
                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_SUB_NAME }}</td> 
                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>     
                      
                   <td></td>

                   </tr>

                   
<div id="changpass_modal{{ $person -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขรหัสผ่าน {{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('updatepass.store') }}" onSubmit="return checkpass({{ $person -> ID }})">
        @csrf
        <input type="hidden" name="ID" value="{{ $person -> ID }}"/>
       <center><div style="color: red;" id="text{{ $person -> ID }}"></div></center>
     
        <div class="row push">
      <div class="col-sm-3 text-left">  
      <label >รหัสผ่านใหม่</label>
      </div>
      <div class="col-sm-7">  
      <input type="password" name = "NEWPASSWORD"  id="NEWPASSWORD_{{ $person -> ID }}"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      <div class="row push">
      <div class="col-sm-3 text-left">  
      <label >ยืนยันรหัสผ่านใหม่</label>
      </div>
      <div class="col-sm-7">  
      <input type="password" name = "CHECK_NEWPASSWORD"  id="CHECK_NEWPASSWORD_{{ $person -> ID }}"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>






                   
<div id="changstatususer_modal{{ $person -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">กำหนดประเภทผู้ใช้งาน {{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('updatestatusuer.store') }}">
        @csrf
        <input type="hidden" name="ID" value="{{ $person -> ID }}"/>
     
        <div class="row push">
      <div class="col-sm-3 text-left">  
      <label >กำหนดประเภทผู้ใช้งาน</label>
      </div>
      <div class="col-sm-7">  
    
      <select  name = "status"  id="status"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
          @if( $person->status == 'USER')<option value="USER" selected>USER</option>@else<option value="USER">USER</option>@endif
          @if( $person->status == 'ADMIN')<option value="ADMIN" selected>ADMIN</option>@else<option value="ADMIN">ADMIN</option>@endif
          @if( $person->status == 'NOTUSER')<option value="NOTUSER" selected>NOTUSER</option>@else<option value="NOTUSER">NOTUSER</option>@endif
     
      </select>
    
    </div>
      </div>

      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>
                 
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