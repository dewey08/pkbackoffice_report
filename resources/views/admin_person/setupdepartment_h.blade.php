@extends('layouts.backend_admin')

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่ากลุ่มงาน</h2>

                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อกลุ่มงาน</th>
        <th  class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">เลขหนังสือ</th>
        <th  class="text-font" width="20%" style="border-color:#F0FFFF;text-align: center;">หัวหน้ากลุ่มงาน</th>
 

      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infodepartments as $infodepartment)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infodepartment-> HR_DEPARTMENT_ID }}</td>
                     <td class="text-font text-pedding">{{ $infodepartment-> HR_DEPARTMENT_NAME }}</td>
                     <td class="text-font text-pedding">{{ $infodepartment-> BOOK_NUM }}</td>
                     <td class="text-font text-pedding"> 
                     
                     <select name="DEP{{ $infodepartment-> HR_DEPARTMENT_ID }}" id="DEP{{ $infodepartment-> HR_DEPARTMENT_ID }}" onchange="depselect({{  $infodepartment-> HR_DEPARTMENT_ID}});" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" >
                            <option value="">--กรุณาเลือกหัวหน้า--</option>
                        @foreach ($infopersons as $infoperson)  

                            @if($infoperson ->ID == $infodepartment-> LEADER_HR_ID )
                            <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                            @else
                            <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                            @endif                                                   
                           
                        @endforeach 
                    </select>
                     
                     
                     </td>

                

                 


                   </tr>



                   @endforeach
                   </tbody>
                  </table>
                 <br>


@endsection

@section('footer')




<script>
 
 function depselect(iddep){
      
      var value=document.getElementById('DEP'+iddep).value;
     
     // alert(value+"::"+iddep);

      var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.updatedepartment_h')}}",
              method:"GET",
              data:{value:value,iddep:iddep,_token:_token}
      })
 }
    
  
</script>

<script src="{{ asset('select2/select2.min.js') }}"></script>

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
          $(document).ready(function() {
              $('select').select2();
        
              });
        </script>
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
