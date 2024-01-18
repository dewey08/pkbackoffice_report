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
            <h3 class="block-title text-center fs-24">ข้อมูลหมวดหมู่บทเรียน</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
        <div class="row">
                <div class="col-md-12">
                    @if (session('alert'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="flex-fill ml-3">
                                            <p class="mb-0">{{ session('alert') }}</p>
                                        </div>
                    </div>

                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>             
                <div class="col-lg-10">
           
                </div>
                <div class="col-lg-1"></div>
            </div>
                   
            <div class="row">
                <div class="col-lg-9"></div>             
                <div class="col-lg-2"align="right" >
                        <button type="button" class="btn btn-outline-info mr-1 mb-3 text"  data-toggle="modal" data-target="#add_group">
                         <i class="fa fa-fw fa-plus mr-1"></i>เพิ่มหมวดหมู่บทเรียน 
                        </button>          
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <table class="table table-bordered table-hover  table-vcenter js-dataTable-full text-center ">
                                <thead class=" table-warning">
                                        <tr>
                                            <th  width="5%"><span style="font-size: 15px;">ลำดับ</span></th>
                                            <th  width="25%"><span style="font-size: 15px;">ภาพปก</span></th>
                                            <th><span style="font-size: 15px;">ชื่อบทเรียน</span></th>
                                            <th width="7%"><span style="font-size: 15px;">เปิดใช้</span></th>
                                            <th  width="5%"><span style="font-size: 15px;">คำสั่ง</span></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infolessongroup as $row)
                                <?php $number++; ?>
                                        <tr>
                                            <td class=""><span style="font-size: 15px;">{{ $number }}</span></td>
                                            <td class=""><img  width="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->IMG_LESSON_GROUP)) }}"></td>
                                            <td class="" align="left"><span style="font-size: 15px;">{{ $row ->NAME_LESSON_GROUP}}</span></td>
                                            <td align="center" width="10%">
                                                <div class="custom-control custom-switch custom-control-lg ">
                                                    @if($row-> ACTIVE_LESSON_GROUP == 'True' )
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_LESSON_GROU }}" name="{{ $row-> ID_LESSON_GROU }}" onchange="switch_status({{ $row-> ID_LESSON_GROU }});" checked>
                                                    @else
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_LESSON_GROU }}" name="{{ $row-> ID_LESSON_GROU }}" onchange="switch_status({{ $row-> ID_LESSON_GROU }});">
                                                    @endif
                                                    <label class="custom-control-label" for="{{ $row-> ID_LESSON_GROU }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle foo13" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                        ทำรายการ
                                                </button>
                                                    <div class="dropdown-menu foo13" style="width:15px">
                                                        <a class="dropdown-item loadscreen"  href="{{ url('/e_learning/manage_group/detail/'.$row->ID_LESSON_GROU)}}"  >รายละเอียด</a>
                                                        <a class="dropdown-item loadscreen"  href="{{ url('/e_learning/manage_group/edit/'.$row->ID_LESSON_GROU)}}" >แก้ไขข้อมูล</a>
                                                        <a class="dropdown-item "  href="{{ url('/e_learning/manage_group/destroy/'.$row->ID_LESSON_GROU)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล?')">ลบข้อมูล</a></div>
                                                     </div>
                                        </td>  
                                        </tr> 
                                 @endforeach
                                </tbody>
                        </table><br>
                </div>
            </div>
        </div>    

    </div>
</div>

<!-- The Modal add-->
<div class="modal fade" id="add_group" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-success">
                            <h2 class="block-title">เพิ่มหมวดหมู่บทเรียน</h2>
                        </div>
                        <div class="block-content">
                        <form  method="post" action="{{ route('save_lessongroup') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="fs-20">ภาพปก <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-7">
                                    <div class="form-group">
                                    <img id="image_upload_preview" width="200px" height="200px" src="{{asset('image/elearning_question/learning.png') }}">
                                    </div>
                                    <p class="text-secondary">**ขนาดภาพแนะนำ 200 * 200 พิกเซล*(กว้างxสูง) หรือ อัตราส่วนภาพ 4:3</p>
                                    <div class="form-group">
                                    <input style="font-family: 'Kanit', sans-serif;" required  type="file" name="picture" id="picture" class="form-control-file border">
                                    </div>
                                </div>
                            </div><br>  
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="fs-20">ชื่อหมวดหมู่บทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-7 text-left" align="left">
                                    <input type="text" class="form-control" placeholder="กรุณากรอกชื่อหมวดหมู่บทเรียน..." name="NAME_LESSON_GROUP" id="NAME_LESSON_GROUP" required  style=" font-family: 'Kanit', sans-serif;">
                                    <div style="color: red;" id="name_lesson_group"></div>
                                </div> 
                            </div><br> 
                            </div>
                            <div class="block-content block-content-full text-right bg-light">
                                <div align="right">
                                <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                    <button type="submit"  class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i class="fas fa-times mr-2"></i>ยกเลิก</button>
                                </div>
                            </div>
                        </form>
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
    if (numb > 100) {
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

<script>
  function readURL(input) {
    var fileInput = document.getElementById('picture');
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
        $('#image_upload_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#picture").change(function () {
    readURL(this);
  });
</script>

<!-- on off -->
<script>
        function switch_status(status_lesson_group) {
            // alert(budget);
            var checkBox = document.getElementById(status_lesson_group);
            var onoff;

            if (checkBox.checked == true) {
                onoff = "True";
            } else {
                onoff = "False";
            }
            //alert(onoff);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('switch_lessongroup')}}",
                method: "GET",
                data: {
                    onoff: onoff,
                    status_lesson_group: status_lesson_group,
                    _token: _token
                }
            })
        }
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