@extends('layouts.backend_admin')
<!-- Page JS Plugins CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{asset('select2/select2.min.css')}}" rel="stylesheet" />

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

  .text-pedding {
    padding-left: 10px;
  }

  .text-font {
    font-size: 13px;
  }

  table,
  td,
  th {
    border: 1px solid black;
  }
  
  .font-sub-menu{
    font-family: 'Kanit', sans-serif; 
    font-size: 15px;
    font-weight:normal;
  }

  .dropdown-menu-size{
    max-height: 300px;
    overflow: scroll;
  }
  .center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
.font-table-title{
    border-color:#F0FFFF;
}

.font-table-th{
    font-family: 'Kanit', sans-serif;
    font-weight: bold;
    text-align: center;
    font-size: 14px;
}

.font-table-td{
    font-family: 'Kanit', sans-serif;
    font-size: 14px;
}

.font-title{
    font-family: 'Kanit', sans-serif;
    font-size: 16px;
    font-weight: bold;
}
.font-dropdown{
    font-family: 'Kanit', sans-serif;
    font-size: 14px;
    font-weight: bold;
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

@section('content')
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <h2 class="content-heading pt-8" style="font-family: 'Kanit', sans-serif;">
                ตั้งค่ารูปแบบห้องประชุม
            </h2>
            <div class="row">
                <div class="col-lg-8">
                    <a class="btn btn-hero-sm btn-hero-info" href="{{ url('/admin_meeting/style-room/add-view') }}">
                        <i class="fas fa-plus"></i> เพิ่มข้อมูลรูปแบบห้องประชุม
                    </a>
                </div>
            </div>
            <div class="mt-3">
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-full">
                        <thead style="background-color: #FFEBCD; ">
                            <tr height="40">
                                <th class="font-table-title" width="5%">
                                    <span class="font-table-th">รหัส</span>
                                </th>
                                <th class="font-table-title" width="15%">
                                    <span class="font-table-th">ชื่อห้องประชุม</span>
                                </th>
                                <th class="font-table-title" width="15%">
                                    <span class="font-table-th">รูปภาพ</span>
                                </th>
                                <th class="font-table-title">
                                    <span class="font-table-th">รายละเอียด</span>
                                </th>
                                <th class="font-table-title">
                                    <span class="font-table-th">เปิดใช้</span>
                                </th>
                                <th class="font-table-title">
                                    <span class="font-table-th">คำสั่ง</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($style_rooms as $style_room)
                            <tr>
                                <td class="font-table-td text-pedding" align="center">
                                    {{ $style_room->id }}
                                </td>
                                <td class="font-table-td text-pedding" align="center">
                                    {{ $style_room->STYLEROOM_NAME }}
                                </td>
                                <td align="center">
                                    <img id="image_upload_preview"
                                    src="data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }}"
                                    height="150px" width="150px">
                                </td>
                                <td width="50%" class="font-table-td text-pedding">
                                    {{ $style_room->STYLEROOM_DETAIL }}
                                </td>
                                <td class="font-table-td text-pedding">
                                    <div class="custom-control custom-switch custom-control-lg ">
                                        @if($style_room-> STYLEROOM_STATUS == 'true' )
                                        <input type="checkbox" class="custom-control-input" id="{{ $style_room-> id }}"
                                            name="{{ $style_room-> id }}" onchange="switchactive({{ $style_room-> id }});" checked>
                                        @else
                                        <input type="checkbox" class="custom-control-input" id="{{ $style_room-> id }}"
                                            name="{{ $style_room-> id }}" onchange="switchactive({{ $style_room-> id }});">
                                        @endif
                                        <label class="custom-control-label" for="{{ $style_room-> id }}"></label>
                                    </div>
                                </td>
                                <td class="font-table-td text-pedding" align="center">
                                    <div class="dropdown">
                                      <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                        ทำรายการ
                                      </button>
                                      <div class="dropdown-menu" style="width:10px">
                                        <a class="dropdown-item" href="{{ route('admin_meeting.style-room.edit-view', $style_room->id) }}"
                                          style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                        <a class="dropdown-item"
                                          href="{{ route('admin_meeting.style-room.delete-config', $style_room->id) }}"
                                          onclick="return confirm('ต้องการที่จะลบข้อมูลรูปแบบห้องประชุม {{ $style_room-> id }} ?')"
                                          style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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

<script type="text/javascript">

$(document).on('click','.update_style_room',function(){
        var id = $(this).attr('data-id');
        // console.log(id);
        // var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
        type: 'GET',
        url: "/admin_meeting/style-room/edit-view/"+id,
        data: {
            // _token: token,
            _method: 'GET',
            id: id,
        },
            success: function (response) {
                console.log("ASD");

            }
        });
        // window.location = "/person/info-regalia/view-edit/"+id;
    });

    function readURL1(input) {
        var fileInput = document.getElementById('picture1');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var numb = input.files[0].size / 1024;

        if (numb > 64) {
            alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
            fileInput.value = '';
            return false;
        }

        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
            fileInput.value = '';
            return false;
        }
    }

    $("#picture1").change(function () {
        readURL1(this);
    });

</script>

<script>
    function switchactive(room) {
      // alert(budget);
      var checkBox = document.getElementById(room);
      var onoff;

      if (checkBox.checked == true) {
        onoff = "true";
      } else {
        onoff = "false";
      }
      //alert(onoff);

      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{route('admin_meeting.style-room.setup.style.room')}}",
        method: "GET",
        data: {
          onoff: onoff,
          room: room,
          _token: _token
        }
      })
    }
  </script>

@endsection