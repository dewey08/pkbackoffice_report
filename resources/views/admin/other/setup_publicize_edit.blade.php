@extends('layouts.backend_admin')
@section('css_after')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<style>
  td {
    font-size: 16px !important;
  }
</style>
@endsection
@section('content')
<div class="content mb-5">
  <div class="block block-rounded block-bordered">
    <div class="block-content">
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i>
        แก้ไขข้อมูลลิงค์ประชาสัมพันธ์</h2>
      <form method="post" action="{{route('admin.setupinfo.publicize_update')}}" enctype="multipart/form-data">
        @csrf()
        <input type="hidden" name="id" value="{{$infopublic->IPUB_ID}}">
        <div class="row push">
          <div class="col-lg-12">
            <h4 class="fw-b fs-16">ภาพปก</h4>
            <div class="form-group">
              @if(!empty($infopublic->IPUB_IMG))
                <img id="image_upload_preview" width="400px" height="300px" src="data:image/png;base64,{{base64_encode($infopublic->IPUB_IMG)}}">
              @else
                <img id="image_upload_preview" width="400px" height="300px" src="{{asset('image/information_publicize.png')}}">
              @endif
            </div>
            ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง) หรือ อัตราส่วนภาพ 4:3
            <div class="form-group">
              <input style="font-family: 'Kanit', sans-serif;" type="file" name="IPUB_IMG" id="IPUB_IMG"
                class="form-control">
            </div>
          </div>
        </div>
        <div class="row push">
          <div class="col-lg-6">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-3 mb-2 text-left">
                  <label>ชื่อลิงก์</label> <span style="color:red">*</span>
                </div>
                <div class="col-sm-9 mb-2">
                  <input required name="IPUB_NAME" value="{{$infopublic->IPUB_NAME}}" id="IPUB_NAME" maxlength="255" class="form-control input-lg f-kanit">
                </div>
                <div class="col-sm-3 mb-2 text-left">
                  <label>รายละเอียด</label>
                </div>
                <div class="col-sm-9 mb-2">
                  <textarea required name="IPUB_DETAIL" id="IPUB_DETAIL" cols="30" rows="10" maxlength="400"
                    class="form-control">{{$infopublic->IPUB_DETAIL}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-3 mb-2 text-left">
                  <label>ลิงก์</label>
                </div>
                <div class="col-sm-9 mb-2">
                  <input required type="url" value="{{$infopublic->IPUB_LINK}}" name="IPUB_LINK" id="IPUB_LINK" class="form-control input-lg f-kanit"
                    placeholder="https://www.thairath.co.th/news/local/2192273">
                </div>
                <div class="col-sm-3 mb-2 text-left">
                  <label>วันที่</label>
                </div>
                <div class="col-sm-9 mb-2">
                  <input required type="text" value="{{date('d/m/Y',strtotime($infopublic->IPUB_DATE))}}" name="IPUB_DATE" id="IPUB_DATE"
                    class="form-control input-lg f-kanit datepicker" readonly>
                </div>
                <div class="col-sm-3 mb-2 text-left">
                  <label>เวลา</label>
                </div>
                <div class="col-sm-9 mb-2">
                  <input required type="time" value="{{$infopublic->IPUB_TIME}}" name="IPUB_TIME" id="IPUB_TIME"
                    class="form-control input-lg f-kanit">
                </div>
                <div class="col-sm-3 mb-2 text-left">
                  <label>เผยแพร่</label>
                </div>
                <div class="col-sm-9 mb-2">
                  <div class="custom-control custom-switch custom-control-lg ">
                    <input type="checkbox" class="custom-control-input" value="1" id="IPUB_ACTIVE" name="IPUB_ACTIVE" {{$infopublic->IPUB_ACTIVE?'checked':''}}>
                    <label class="custom-control-label" for="IPUB_ACTIVE"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info">แก้ไขข้อมูล</button>
            <a href="{{route('admin.setupinfo.publicize')}}" class="btn btn-hero-sm btn-hero-danger"
              onclick="return confirm('ต้องการที่จะยกเลิกแก้ไขข้อมูล ?')">ยกเลิก</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    todayHighlight: true,
    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    autoclose: true //Set เป็นปี พ.ศ.
  });
</script>
<script>
  function readURL(input) {
    var fileInput = document.getElementById('IPUB_IMG');
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var numb = input.files[0].size / 1024;
    if (numb > 16000) {
      alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
      fileInput.value = '';
      return false;
    }
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_upload_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#IPUB_IMG").change(function () {
    readURL(this);
  });
</script>
@endsection