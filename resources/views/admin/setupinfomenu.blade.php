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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าเปิดใช้เมนู</h2>

                      



                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr  height="40">
        <th class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียด</th>
        <th class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">เปิดใช้</th>


      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($informenus as $informenu)
                   <tr  height="40">
        
                     <td class="text-font text-pedding" align="center">{{ $informenu-> PERMIS_MENU_ID }}</td>
                     <td class="text-font text-pedding" align="left">{{ $informenu-> PERMIS_MENU_NAME }}</td>

        

                    
                    <td class="text-font" align="center" width="10%">
                     <div class="custom-control custom-switch custom-control-lg ">
                    @if($informenu-> ACTIVE == 'True' )
                    <input type="checkbox" class="custom-control-input" id="{{ $informenu-> PERMIS_MENU_ID }}" name="{{ $informenu-> PERMIS_MENU_ID }}" onchange="switchinfomenu({{ $informenu-> PERMIS_MENU_ID }});" checked>
                    @else
                    <input type="checkbox" class="custom-control-input" id="{{ $informenu-> PERMIS_MENU_ID }}" name="{{ $informenu-> PERMIS_MENU_ID }}" onchange="switchinfomenu({{ $informenu-> PERMIS_MENU_ID }});">
                    @endif
                    <label class="custom-control-label" for="{{ $informenu-> PERMIS_MENU_ID }}"></label>
                    </div>
                    </td>


                   </tr>



                   @endforeach
                   </tbody>
                  </table>
                 <br>


@endsection

@section('footer')


<script>

 function switchinfomenu(idref){
   
      var checkBox=document.getElementById(idref);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
  
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.switchinfomenu')}}",
              method:"GET",
              data:{onoff:onoff,idref:idref,_token:_token}
      })
      }



</script>

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
