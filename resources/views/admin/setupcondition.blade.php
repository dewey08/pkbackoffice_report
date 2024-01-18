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
                {{-- <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าเงือนไขการลาพักผ่อน</h2>   --}}
                      
                
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าเงือนไขการลาพักผ่อน</h2> 
                      </div>
              
              </div>   



                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ประเถทบุคลากร</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">เงือนไขการลา</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ลาพักผ่อนต่อปี</th>
    
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infoconditions as $infocondition)
                   <tr height="40">
                     <td class="text-font" align="center">{{ $infocondition->HR_PERSON_TYPE_ID }}</td> 
                     <td class="text-font text-pedding">{{ $infocondition-> HR_PERSON_TYPE_NAME }}</td>
                     <td class="text-font text-pedding">{{ $infocondition-> HR_LEAVE04_CMD }}</td>
                     <td class="text-font"  align="center">{{ $infocondition-> HR_LEAVE04_DAY }}</td>    
                                 
                   </tr> 
                   @endforeach 
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