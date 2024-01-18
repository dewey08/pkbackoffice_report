@extends('layouts.backend_admin')



@section('content')

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;
     
      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>           
                    <!-- Advanced Tables -->
                   
                <div class="content">
                <div class="block block-rounded block-bordered">

    
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"></h2>  
                  <div class="row">
                      <div class="col-lg-12">
                        
                          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าธุรการกลุ่มงาน</h2>  
                        </div>
                    
                </div>   


                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;">ชื่อกลุ่มงาน</th>
        <th  class="text-font" width="10%"style="border-color:#F0FFFF;text-align: center;">เลขที่หนังสือ</th>
        <th  class="text-font" width="20%"style="border-color:#F0FFFF;text-align: center;">ธุรการ</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th> 


      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infobookdepartmentadmins as $infobookdepartmentadmin)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infobookdepartmentadmin-> HR_DEPARTMENT_ID }}</td> 
                     <td class="text-font text-pedding" >{{ $infobookdepartmentadmin-> HR_DEPARTMENT_NAME }}</td>  
                     <td class="text-font text-pedding" >{{ $infobookdepartmentadmin-> BOOK_NUM }}</td>  
                     <td class="text-font text-pedding" >{{ $infobookdepartmentadmin -> HR_FNAME }}  {{ $infobookdepartmentadmin -> HR_LNAME }}</td>  

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_book/setupbookdepartmentadmin/edit/'.$infobookdepartmentadmin-> HR_DEPARTMENT_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
    
                                                  
                                                </div>
                    </div>
                     </td>                        


                 
                    
                   </tr> 

    

                   @endforeach 
                   </tbody>
                  </table>
                 <br>
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   

        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

        <script>
            $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>

@endsection