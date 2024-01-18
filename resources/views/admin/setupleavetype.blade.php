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
      font-size: 14px;
     
      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าประเภทการลา</h2>                       
                        <div class="row">
                            <div class="col-lg-8">
                               <!--- <a href="{{ url('admin_leave/setupinfoleavetype/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทการลา</a>-->
                              </div>                        
                      </div>  
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead style="background-color: #FFEBCD;">                    
                      <tr height="40">
                          <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
                          <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ประเภทการลา</th>  
                      </tr>
                    </tr>
                    </thead>
                      <tbody id="myTable">
                          @foreach ($infoleavetypes as $infoleavetype)
                          <tr height="40">
                              <td class="text-font" align="center">{{ $infoleavetype-> LEAVE_TYPE_ID }}</td> 
                              <td class="text-font text-pedding">{{ $infoleavetype-> LEAVE_TYPE_NAME }}</td> 
                          </tr> 
                          @endforeach 
                      </tbody>
                  </table>
                  <br>
                 
@endsection

@section('footer')

       <!-- Page JS Plugins -->
       <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>

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