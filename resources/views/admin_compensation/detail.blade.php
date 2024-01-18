@extends('layouts.backend_admin')


<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 10px;
      font-size: 1.0rem;
      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>           
                    <!-- Advanced Tables -->
                   
                <div class="content">
                <div class="block block-rounded block-bordered">

    
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่า</h2>  
                       
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ url('') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                        
                              </div>
                            <div class="col-lg-4">
                                  <input style="font-family: 'Kanit', sans-serif;" class="form-control" id="myInput" type="text" placeholder="Search..">
                            </div>
                      </div>   
                 
                        
                        
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">1</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">2</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">3</th>
 
      
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                  
                   <tr  height="40">
                     <td class="text-font" align="center" ></td> 
                     <td class="text-font text-pedding" ></td>  

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>                        


                 
                    
                   </tr> 

    

               
                   </tbody>
                  </table>
                 <br>
                      

@endsection

@section('footer')

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