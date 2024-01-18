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

    label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
                /* font-size: 1.0rem; */
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">

                <div class="row">
                <div class="col-md-10">

                กำหนดข้อมูลชั้น :: {{$infosupplocationname->LOCATION_NAME}} >> {{$infosupplocationlevelname->LOCATION_LEVEL_NAME}}

               </div>
                <div class="col-md-2">
               <a href="{{ url('admin_asset_supplies/setupsupplieslocationlevel/'.$infosupplocationname->LOCATION_ID) }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                </h2>
                        <a href="{{ url('admin_asset_supplies/setupsupplieslocationlevelroom/add/'.$infosupplocationname->LOCATION_ID.'/'.$infosupplocationlevelname->LOCATION_LEVEL_ID)}}" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-plus"></i> เพิ่มข้อมูลห้อง</a>


                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                  <thead style="background-color: #FFEBCD;">

        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" width="40%"style="border-color:#F0FFFF;text-align: center;">ห้อง</th>

        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>



      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($infosupplieslocationlevelrooms as $infosupplieslocationlevelroom)
                   <tr height="40">
                     <td align="center"  class="text-font">{{ $infosupplieslocationlevelroom-> LEVEL_ROOM_ID }} </td>
                     <td  class="text-font text-pedding">{{ $infosupplieslocationlevelroom->LEVEL_ROOM_NAME}}</td>

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_asset_supplies/setupsupplieslocationlevelroom/edit/'.$infosupplieslocationlevelroom-> LEVEL_ROOM_ID.'/'.$infosupplocationname-> LOCATION_ID.'/'.$infosupplieslocationlevelroom-> LOCATION_LEVEL_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_asset_supplies/setupsupplieslocationlevelroom/destroy/'.$infosupplieslocationlevelroom-> LEVEL_ROOM_ID.'/'.$infosupplocationname-> LOCATION_ID.'/'.$infosupplieslocationlevelroom-> LOCATION_LEVEL_ID) }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infosupplieslocationlevelroom-> LEVEL_ROOM_ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>

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




  <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>


        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


@endsection
