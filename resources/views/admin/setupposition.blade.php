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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าตำแหน่ง</h2>
                <div class="row">
                      <div class="col-lg-8">
                            <a href="{{ url('admin/setupinfoposition/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลตำแหน่ง</a>
                      </div>
                
                </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เปิดใช้การตรวจสอบวันหยุด</th>
                            <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>

                          </tr>
                    </thead>
                     <tbody id="myTable">
                          @foreach ($infopositions as $infoposition)
                              <tr height="40">
                                    <td class="text-font" align="center">{{ $infoposition-> HR_POSITION_ID }}</td>
                                    <td class="text-font text-pedding">{{ $infoposition-> HR_POSITION_NAME }}</td>
                                    <td align="center">
                                        <div class="custom-control custom-switch custom-control-lg ">
                                            @if($infoposition-> HR_POSITION_CHECK_HOLIDAY == 'True' )
                                                <input type="checkbox" class="custom-control-input" id="{{ $infoposition-> HR_POSITION_ID }}" name="{{ $infoposition-> HR_POSITION_ID }}" onchange="switchposition({{ $infoposition-> HR_POSITION_ID }});" checked>
                                            @else
                                                  <input type="checkbox" class="custom-control-input" id="{{ $infoposition-> HR_POSITION_ID }}" name="{{ $infoposition-> HR_POSITION_ID }}" onchange="switchposition({{ $infoposition-> HR_POSITION_ID }});">
                                            @endif
                                                  <label class="custom-control-label" for="{{ $infoposition-> HR_POSITION_ID }}"></label>
                                        </div>
                                  {{-- </td> --}}
                                    <td align="center">
                                        <div class="dropdown">
                                              <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            ทำรายการ
                                              </button>
                                              <div class="dropdown-menu" style="width:10px">
                                                  <a class="dropdown-item" href="{{ url('admin/setupinfoposition/edit/'.$infoposition -> HR_POSITION_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                  <a class="dropdown-item" href="{{ url('admin/setupinfoposition/destroy/'.$infoposition->HR_POSITION_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลตำแหน่งรหัส {{ $infoposition->HR_POSITION_ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>

                                              </div>
                                        </div>
                                    </td>
                              </tr>
                            @endforeach
                       </tbody>
                  </table>
                 <br>
              </div>
        </div>

@endsection

@section('footer')


<script>

 function switchposition(position){
      // alert(budget);
      var checkBox=document.getElementById(position);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.position')}}",
              method:"GET",
              data:{onoff:onoff,position:position,_token:_token}
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
