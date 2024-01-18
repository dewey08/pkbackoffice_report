@extends('layouts.launder')
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
            table, td, th {
            border: 1px solid black;
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
  <br>
  <br>
<center>    
     <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">
        <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าหน่วยงานรับผ้า</h2>

                        <div class="row">
                            <div class="col-lg-12" align="left">
                                <a href="{{ url('manager_launder/launder_dep_add') }}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>

                              </div>
                         
                      </div>

                        <div class="block-content">
             
         
        <div class="panel-body" style="overflow-x:auto;">     
        <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="5%" >ลำดับ</th>       
    
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="10%">ชื่อย่อหน่วยงาน</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" >หน่วยงาน</th>
      
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;" width="10%" >คำสั่ง</th>
       
     
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $number = 0; ?>
                   @foreach ($infolaunderdeps as $infolaunderdep)
                   <?php $number++; 
                
                   ?> 
                   <tr  height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>          
                     
                    <td class="text-pedding text-font"> {{ $infolaunderdep -> LAUNDER_DEP_NAMECODE }}</td>   
                    <td class="text-pedding text-font"> {{ $infolaunderdep -> LAUNDER_DEP_NAME }}</td>   
                   
                    
                    <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="{{ url('manager_launder/launder_dep_edit/'.$infolaunderdep->LAUNDER_DEP_ID)  }}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_launder/launder_dep_clothingtype/'.$infolaunderdep->LAUNDER_DEP_ID)  }}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">เพิ่มประเภทผ้า</a>
                                                    <a class="dropdown-item" href="{{ url('manager_launder/launder_dep_destroy/'.$infolaunderdep->LAUNDER_DEP_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>  
                  
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