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

  label {
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
    font-weight: bold;
    text-align: center;
    font-size: 14px;
}

.font-title{
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.font-content{
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
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
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
        <i class="fas fa-plus"></i> เพิ่มข้อมูลรูปแบบห้องประชุม
      </h2>
    </div>
  <form action="{{ route('admin_meeting.style-room.edit-config') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="idRoom" value="{{ $style_room->id }}">
    <div class="block-content">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <span class="font-title">ภาพรูปแบบห้องประชุม</span><br><br>
            <span>
                <img id="image_upload_preview" name="image_upload_preview"
                src="data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }}"
                height="550px;" width="100%;">
                <input type="file" name="imgRoom" id="imgRoom" class="form-control">
            </span>
          </div>
          <div class="col-md-6">
            <div class="col-md-12">
              <span class="font-title">ชื่อรูปแบบห้องประชุม</span><br><br>
              <span>
                <input type="text" class="form-control input-lg" name="nameRoom" id="nameRoom" value="{{ $style_room->STYLEROOM_NAME }}">
              </span>
            </div>
            <div class="col-md-12">
              <span class="font-title">สถานะรูปแบบห้องประชุม</span><br><br>
              <span>
                <select class="form-control" name="statusRoom" id="statusRoom">
                  <option value="true">พร้อมใช้งาน</option>
                  <option value="false">ไม่พร้อมใช้งาน</option>
                </select>
              </span>
            </div>
            <div class="col-md-12">
              <span class="font-title">รายละเอียด</span><br><br>
              <span>
                <textarea class="form-control" name="detailRoom" id="detailRoom" cols="30" rows="10" value="{{ $style_room->STYLEROOM_DETAIL }}">{{ $style_room->STYLEROOM_DETAIL }}</textarea>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12" style="text-align: right; margin-top:30px; margin-bottom:30px;">
        <button type="submit" class="btn btn-hero-sm btn-hero-info btn-add-config">
          <i class="fas fa-save"></i> บันทึกข้อมูล
        </button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal">
          <i class="fas fa-window-close"></i> ยกเลิก
        </button>
    </div>
    </div>
  </form>
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



<script>
    
    function readURL(input) {
        var fileInput = document.getElementById('imgRoom');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }
            
                $("#imgRoom").change(function () {
                    readURL(this);
                });
</script>

@endsection