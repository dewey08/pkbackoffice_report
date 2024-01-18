@extends('layouts.backend_admin')
@section('css_after')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="content mb-5">
  <div class="block block-rounded block-bordered">
    <form method="post" action="{{route('admin.setupinfo.pagefacebook_save')}}" enctype="multipart/form-data">
      @csrf()
      <div class="block-content">
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i>
          เพิ่มข้อมูลเพจเฟซบุ๊ก</h2>
        <div class="row push fs-16">
          <div class="col-lg-12 mb-2">
            <!-- <h4 class="fw-b fs-22">ลิ้งผู้พัฒนา facebook สำหรับการฝังโค้ด pagefacebook <a
                href="https://developers.facebook.com/docs/plugins/page-plugin?locale=th_TH" target="_blank"
                rel="noopener noreferrer"> คลิ๊ก</a></h4> -->
          </div>
          <div class="col-lg-3 mb-2">
            <div class="form-group">
              <label class="fs-16">ปลั๊กอิน (ขั้นตอนที่ 2)</label> <span style="color:red">*</span>
            </div>
          </div>
          <div class="col-sm-9 mb-2">
            <textarea class="form-control" name="IFP_PLUGIN" id="IFP_PLUGIN" required maxlength="400" cols="30"
              rows="8"></textarea>
          </div>
          <div class="col-lg-3 mb-2">
            <div class="form-group">
              <label class="fs-16">โค้ดแสดงผล (ขั้นตอนที่ 3)</label> <span style="color:red">*</span>
            </div>
          </div>
          <div class="col-sm-9 mb-2">
            <textarea class="form-control" name="IFP_DATASHOW" id="IFP_DATASHOW" required maxlength="1000" cols="30"
              rows="10"></textarea>
          </div>
          <div class="col-sm-3 mb-2 text-left">
            <label class="fs-16">ใช้งาน</label>
          </div>
          <div class="col-sm-9 mb-2">
            <div class="custom-control custom-switch custom-control-lg ">
              <input type="checkbox" class="custom-control-input" value="1" id="IFP_ACTIVE" name="IFP_ACTIVE" checked>
              <label class="custom-control-label" for="IFP_ACTIVE"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div align="right">
          <button type="submit" class="btn btn-hero-sm btn-hero-info">บันทึกข้อมูล</button>
          <a href="{{route('admin.setupinfo.pagefacebook')}}" class="btn btn-hero-sm btn-hero-danger"
            onclick="return confirm('ต้องการที่จะยกเลิกแก้ไขข้อมูล ?')">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>

  <div class="block">
    <div class="block-content">
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"> วิธีรับโค้ดฝังหน้าเว็บ Page Facebook</h2>
      
      <div class="row push fs-16">
        <div class="col-lg-12 mb-2">
          <h4 class="fw-b m-0 mb-2">ขั้นตอนการรับโค้ดฝังหน้าเว็บ <a
                href="https://developers.facebook.com/docs/plugins/page-plugin?locale=th_TH" target="_blank"
                rel="noopener noreferrer"> คลิ๊ก developers.facebook.com : page-plugin </a></h4></h4>
          <ol class="fs-16">
            <li>ใส่ลิงก์เพจ</li>
            <li>กำหนดขนาด กว้าง*สูง (แนะนำ 500x900)</li>
            <li>เลือก options ดังนี้
              <ul>
                <li>ใช้ส่วนหัวขนาดเล็ก</li>
                <li>ซ่อนรูปภาพหน้าปก</li>
                <li><i class="fa fa-check-square"></i> ปรับให้เข้ากับความกว้างคอนเทนเนอร์ของปลั๊กอิน</li>
                <li><i class="fa fa-check-square"></i> แสดงใบหน้าของเพื่อน</li>
              </ul>
            </li>
            <li>รับโค้ด และคัดลอก "ขั้นตอนที่ 2" และ "ขั้นตอน 3" มาเพิ่มข้อมูล</li>
          </ol>
        </div>
        <hr>
        <div id="c1" class="col-lg-12 mb-2 pt-5">
          <h1 class="fw-b">1. ใส่ลิงค์เพจ</h1>
          <img class="shadow mb-3" src="{{asset('image/plugin_page_facebook.png')}}"  width="100%" alt="" srcset="">
          <p>กรอกลิงค์ เพจที่ต้องการแสดงลงในช่อง <span style="text-decoration:underline;">URL เพจ Facebook</span> เช่น เพจโรงพยาบาลสำหรับประชาสัมพันธ์</p>
        <div id="c2" class="col-lg-12 mb-2 pt-5">
          <h1 class="fw-b">2. กำหนดขนาด กว้าง*สูง</h1>
          <img class="shadow mb-3" src="{{asset('image/plugin_page_facebook_2.png')}}"  width="100%" alt="" srcset="">
        </div>
        <div id="c3" class="col-lg-12 mb-2 pt-5">
          <h1 class="fw-b">3. เลือก options</h1>
          <img class="shadow mb-3" src="{{asset('image/plugin_page_facebook_3.png')}}"  width="100%" alt="" srcset="">
          <p>กำหนดความกว้าง 500 และกำหนดความสูง 900</p>
        </div>
        <div id="c4" class="col-lg-12 mb-2 pt-5">
          <h1 class="fw-b">4. รับโค้ด และ copy ขั้นตอนที่ 2 และ 3 มาเพิ่มข้อมูล</h1>
          <img class="shadow mb-2" src="{{asset('image/plugin_page_facebook_4.1.png')}}"  width="100%" alt="" srcset="">
          <p>คลิ๊กที่ <span class="btn py-1 text-white fw-5" style="background:#4267b2;">รับรหัส</span></p>
          <img class="shadow mb-3" src="{{asset('image/plugin_page_facebook_4.2.png')}}"  width="100%" alt="" srcset="">
          <p>คัดลอกขั้นตอนที่ 2 และจั้นตอนที่ 3 มายังโปรแกรมเพื่อบันทึก </p>

          <p style="color:red;">***หมายเหตุ ข้อมูลเพจ จะแสดงเพจล่าสุดที่มีการแก้ไข และสถานะเปิดใช้งานเท่านั้น</p>
        </div>
      </div>
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