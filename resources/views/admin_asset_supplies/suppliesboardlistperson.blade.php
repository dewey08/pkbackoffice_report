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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
           
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">

                <div class="row">
                <div class="col-md-10">
                กำหนดข้อมูลกรรมการ :: {{$infosuppboardlistname->BOARD_GROUP_NAME}}

               </div>
                <div class="col-md-2">
               <a href="{{ url('admin_asset_supplies/setupsuppliesboardlist') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                </h2>


                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ url('admin_asset_supplies/setupsuppliesboardlistperson/add/'.$infosuppboardlistname->BOARD_GROUP_ID) }}" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-plus"></i> เพิ่มข้อมูลกรรมการ</a>

                              </div>
                            <div class="col-lg-4">
                                  <input style="font-family: 'Kanit', sans-serif;" class="form-control" id="myInput" type="text" placeholder="Search..">
                            </div>
                      </div>
                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                  <thead style="background-color: #FFEBCD;">

        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">กรรมการ</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>

        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>



      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infosuppliesboardlistpersons as $infosuppliesboardlistperson)
                   <tr height="40">
                     <td align="center"  class="text-font">{{ $infosuppliesboardlistperson-> ID }} </td>
                     <td  class="text-font text-pedding">{{ $infosuppliesboardlistperson->HR_NAME}}</td>
                     <td class="text-font text-pedding">{{ $infosuppliesboardlistperson-> POSITION_NAME }}</td>

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_asset_supplies/setupsuppliesboardlistperson/edit/'.$infosuppliesboardlistperson-> ID.'/'.$infosuppliesboardlistperson-> BOARD_GROUP_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_asset_supplies/setupsuppliesboardlistperson/destroy/'.$infosuppliesboardlistperson-> ID.'/'.$infosuppliesboardlistperson-> BOARD_GROUP_ID) }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infosuppliesboardlistperson-> ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>

                                                </div>
                    </div>
                     </td>

                   </tr>

                   @endforeach
                   </tbody>
                  </table>



@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<script>

 function switchactivetypesub(typesub){
      // alert(budget);
      var checkBox=document.getElementById(typesub);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.suppliestypesub')}}",
              method:"GET",
              data:{onoff:onoff,typesub:typesub,_token:_token}
      })
      }

</script>
  <!-- Page JS Plugins -->
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
