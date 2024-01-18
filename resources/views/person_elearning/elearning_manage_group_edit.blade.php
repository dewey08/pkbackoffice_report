@extends('layouts.elearning')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@section('content')
<style>
    body * {
        font-family: 'Kanit', sans-serif;
    }
    p {
        word-wrap: break-word;
    }
    .text {
        font-family: 'Kanit', sans-serif;
    }

</style>

<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">แก้ไขหมวดหมู่บทเรียน</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
            <div class="row">
                <div class="col-lg-1"></div>             
                <div class="col-lg-10" >
                <form  method="post" action="{{  route('update_lessongroup') }}" enctype="multipart/form-data">
                @csrf         
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="fs-20">ภาพปก</label>
                        </div> 
                        <div class="col-md-7">
                            <div class="form-group">
                            @if($infolessongroup->IMG_LESSON_GROUP == '' || $infolessongroup->IMG_LESSON_GROUP == null)
                                <img id="image_edit_preview" width="300px" height="200px" src="{{asset('image/elearning_question/learning.png') }}">
                                @else
                                <img id="image_edit_preview"  width="300px" height="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($infolessongroup->IMG_LESSON_GROUP)) }}">
                                @endif
                            </div>
                                <p class="text-secondary">**ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง) หรือ อัตราส่วนภาพ 4:3</p>
                            <div class="form-group">
                                <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture_img" id="picture_img" class="form-control-file border">
                            </div>
                        </div>
                    </div><br>  
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="fs-20">ชื่อหมวดหมู่บทเรียน <span class="text-danger">*</span></label>
                        </div> 
                        <div class="col-md-7 text-left" align="left">
                            <input type="hidden" name="ID_LESSON_GROU" id="ID_LESSON_GROU" value="{{$infolessongroup->ID_LESSON_GROU}}">
                            <input type="text" class="form-control" name="NAME_LESSON_GROUP"  id="NAME_LESSON_GROUP" onkeyup="check_namelessongroup()" required style=" font-family: 'Kanit', sans-serif;" value="{{$infolessongroup->NAME_LESSON_GROUP}}">
                            <div style="color: red;" id="name_lesson_group"></div>
                        </div> 
                    </div><br> 
                    <div align="right">
                        <br>
                        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                        <a href="{{ url('e_learning/manage_group') }}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>                      
                        <br><br>
                    </div>  
                </form>                
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>

    </div>
</div>



@endsection

@section('footer')
<!-- เช็คข้อมูล -->
<script>
     function check_namelessongroup()
        {        
                name = document.getElementById("NAME_LESSON_GROUP").value;             
                if (name==null || name==''){
                document.getElementById("name_lesson_group").style.display = "";     
                text_name = "*กรุณาระบุข้อมูลชื่อหมวดหมู่บทเรียน";
                document.getElementById("name_lesson_group").innerHTML = text_name;
                }else{
                document.getElementById("name_lesson_group").style.display = "none";
                }
        }
</script>

<script>
  function readURL_edit(input) {
    var fileInput = document.getElementById('picture_img');
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var numb = input.files[0].size / 1024;
    if (numb > 10000) {
      alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
      fileInput.value = '';
      return false;
    }
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_edit_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#picture_img").change(function () {
    readURL_edit(this);
  });
</script>


<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


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
@endsection