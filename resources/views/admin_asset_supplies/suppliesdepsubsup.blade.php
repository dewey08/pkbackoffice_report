@extends('layouts.backend_admin')


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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"></h2>

                <div class="row">
                    <div class="col-lg-8">
                        {{-- <a href="{{ url('admin_leave/setupinfoleavetype/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทการลา</a> --}}
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ข้อมูลคลังย่อย</h2>
                      </div>

              </div>


                        <div class="block-content">
                        <div class="table-responsive">

                            <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                                <thead style="background-color: #FFEBCD;">

                   <tr  height="40">
                    <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ฝ่าย/แผนก</th>




                     </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infosuppliesdepsubsups as $infosuppliesdepsubsup)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infosuppliesdepsubsup-> HR_DEPARTMENT_SUB_SUB_ID }}</td>
                     <td class="text-font text-pedding" >{{ $infosuppliesdepsubsup-> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                     <td class="text-font text-pedding" >{{ $infosuppliesdepsubsup-> HR_DEPARTMENT_SUB_NAME }}</td>





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
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
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
