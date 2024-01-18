@extends('layouts.leave')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')
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
            
                  @media only screen and (min-width: 1200px) {
            label {
                float:right;
              }
            
                  }
            
                  
                  .text-pedding{
               padding-left:10px;
                                }
            
                    .text-font {
                font-size: 13px;
                              }   
              
                  
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>
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

                                
             <form  method="post">
             @csrf

             <div class="row">
                   <div class="col-md-4" align="left">
                  <h4>กำหนดการนับรวมวันลาในวันหยุด</h4>
                   </div>
                   <div class="col-md-3">
                    
                  </div>  
                  <div class="col-md-3">
                  <span>
                 <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" value="{{$search}}">
                </span>
                 </div>
                 <div class="col-md-1.5">
                 <span>
                    
                     <button type="submit" class="btn btn-hero-sm btn-hero-info " ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                 </span> 
                 </div>
               
          
                  </div>  
             </form>
            
         
        <div class="panel-body" style="overflow-x:auto;">     
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" >ลำดับ</th>       
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" >CID</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="18%">ชื่อ นามสกุล</th>
            
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานะ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ตำแหน่ง</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วยงาน</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ฝ่าย/แผนก</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="90px">นับรวม<br>วันหยุด</th>
       
     
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
                   <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"> {{ $number }}</td>  
                     <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_CID }}</td>  
                     <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                 
                     <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_STATUS_NAME }}</td>   
                     <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> POSITION_IN_WORK }}</td>   
                   
                     <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_DEPARTMENT_SUB_SUB_NAME }}</td> 
                     <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>     
                      
                     <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                       <div class="custom-control custom-switch custom-control-lg ">
                        @if($person-> LEAVEDAY_ACTIVE == 'True' )
                        <input type="checkbox" class="custom-control-input" id="{{ $person-> ID }}" name="{{ $person-> ID }}" onchange="switchleave({{  $person-> ID }});" checked>
                        @else
                        <input type="checkbox" class="custom-control-input" id="{{ $person-> ID }}" name="{{ $person-> ID }}" onchange="switchleave({{  $person-> ID }});">
                        @endif
                        <label class="custom-control-label" for="{{  $person-> ID }}"></label>
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

function switchleave(idperson){
     // alert(budget);
     var checkBox=document.getElementById(idperson);
     var onoff;

     if (checkBox.checked == true){
       onoff = "True";
 } else {
       onoff = "False";
 }
//alert(onoff);

var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('mleave.idperson')}}",
             method:"GET",
             data:{onoff:onoff,idperson:idperson,_token:_token}
     })
     }

</script>

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