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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่ากลุ่มภารกิจ</h2>

                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ url('admin_person/setupinfoworkgroup/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลกลุ่มภารกิจ</a>
                            </div>
                      
                      </div>
                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อกลุ่มภารกิจ</th>
        <th  class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">เลขหนังสือ</th>
        <th  class="text-font" width="20%" style="border-color:#F0FFFF;text-align: center;">หัวหน้าภารกิจ</th>
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">เปิดใช้</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>

      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infodepartments as $infodepartment)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infodepartment-> HR_DEPARTMENT_ID }}</td>
                     <td class="text-font text-pedding">{{ $infodepartment-> HR_DEPARTMENT_NAME }}</td>
                     <td class="text-font text-pedding">{{ $infodepartment-> BOOK_NUM }}</td>
                     <td class="text-font text-pedding"> {{ $infodepartment-> HR_FNAME }} {{ $infodepartment-> HR_LNAME }}</td>

                     <td align="center" width="10%">
                     <div class="custom-control custom-switch custom-control-lg ">
                    @if($infodepartment-> ACTIVE == 'True' )
                    <input type="checkbox" class="custom-control-input" id="{{ $infodepartment-> HR_DEPARTMENT_ID }}" name="{{ $infodepartment-> HR_DEPARTMENT_ID }}" onchange="switchdepartment({{ $infodepartment-> HR_DEPARTMENT_ID }});" checked>
                    @else
                    <input type="checkbox" class="custom-control-input" id="{{ $infodepartment-> HR_DEPARTMENT_ID }}" name="{{ $infodepartment-> HR_DEPARTMENT_ID }}" onchange="switchdepartment({{ $infodepartment-> HR_DEPARTMENT_ID }});">
                    @endif
                    <label class="custom-control-label" for="{{ $infodepartment-> HR_DEPARTMENT_ID }}"></label>
                    </div>

                    <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_person/setupinfoworkgroup/edit/'.$infodepartment -> HR_DEPARTMENT_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_person/setupinfoworkgroup/destroy/'.$infodepartment->HR_DEPARTMENT_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลรหัส{{ $infodepartment-> HR_DEPARTMENT_ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>

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


<script>

 function switchdepartment(department){
      // alert(budget);
      var checkBox=document.getElementById(department);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.department')}}",
              method:"GET",
              data:{onoff:onoff,department:department,_token:_token}
      })
      }



</script>

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
