@extends('layouts.elearning')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
            <h3 class="block-title text-center fs-24">ข้อมูลชุดคำถาม</h3>
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
                <div class="col-lg-7"></div>
                <div class="col-lg-4" align="right">
                        <button type="button" class="btn btn-outline-info mr-1 mb-3 text"  data-toggle="modal" data-target="#add_exam_series">
                         <i class="fa fa-fw fa-plus mr-1"></i>เพิ่มชุดคำถาม 
                        </button> 
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <table class="table table-bordered table-hover  table-vcenter js-dataTable-full text-center">
                                <thead class=" table-warning">
                                        <tr>
                                            <th width="5%"><span style="font-size: 14px;">ลำดับ</span></th>
                                            <th><span style="font-size: 14px;">ชื่อชุดคำถาม</span></th>
                                            <th width="25%"><span style="font-size: 14px;">ชื่อบทเรียน</span></th>
                                            <th width="13%"><span style="font-size: 14px;">เกณฑ์คะเเนน</span></th>
                                            <th width="7%"><span style="font-size: 14px;">เปิดใช้</span></th>
                                            <th width="5%"><span style="font-size: 14px;">คำสั่ง</span></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                    @foreach ($data_exam_series as $row)
                                <?php $number++; ?>
                                        <tr>
                                            <td class=""><span style="font-size: 14px;">{{ $number }}</span></td>
                                            <td class="" align="left"><span style="font-size: 14px;">{{$row-> NAME_EXAM_GROUP}}</span></td>
                                            <td class="" align="left"><span style="font-size: 14px;">{{$row-> NAME_LESSON}}</span></td>
                                            <td class="text-center" align="left"><span style="font-size: 14px;">{{$row-> SCORE_CRITERIA}}</span></td>
                                            <td align="center" width="10%">
                                                <div class="custom-control custom-switch custom-control-lg ">
                                                    @if($row-> ACTIVE_EXAM_GROUP == 'True' )
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_EXAM_GROUP }}" name="{{ $row-> ID_EXAM_GROUP }}" onchange="switch_status({{ $row-> ID_EXAM_GROUP }});" checked>
                                                    @else
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_EXAM_GROUP }}" name="{{ $row-> ID_EXAM_GROUP }}" onchange="switch_status({{ $row-> ID_EXAM_GROUP }});">
                                                    @endif
                                                    <label class="custom-control-label" for="{{ $row-> ID_EXAM_GROUP }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle foo13" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                        ทำรายการ
                                                </button>
                                                    <div class="dropdown-menu foo13" style="width:15px">
                                                        <a class="dropdown-item loadscreen"  href="{{ url('/e_learning/manage_exam/detail_question/'.$row->ID_EXAM_GROUP)}}"  >รายละเอียด</a>
                                                        <a class="dropdown-item"  href="#edit_exam_series{{ $row -> ID_EXAM_GROUP }}"  data-toggle="modal"  >แก้ไขข้อมูล</a>
                                                    </div>
                                            </div>
                                        </td>  
                                        </tr> 
                                        <script>
                                            $(document).ready(function() {
                                            $("#ID_LESSON_edit{{ $row -> ID_EXAM_GROUP }}").select2({ 
                                                dropdownParent: $("#edit_exam_series{{ $row -> ID_EXAM_GROUP }}") 
                                                });
                                            });
                                        </script>
                                        <!-- The Modal edit exam_series-->
                                    <div class="modal fade " id="edit_exam_series{{ $row -> ID_EXAM_GROUP }}" role="dialog" aria-labelledby="modal-block-fromright" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-fromright modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-themed block-transparent mb-0">
                                                            <div class="block-header bg-warning">
                                                                <h2 class="block-title">แก้ไขชุดคำถาม</h2>
                                                            </div>
                                                            <div class="block-content">
                                                            <form  method="post" action="{{ route('update_exam_series') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden"id="ID_EXAM_GROUP" name="ID_EXAM_GROUP" style=" font-family: 'Kanit', sans-serif;"value="{{$row->ID_EXAM_GROUP}}">
                                                            <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="" class="fs-20">บทเรียน <span class="text-danger">*</span></label>
                                                                    </div> 
                                                                    <div class="col-md-8 text-left" align="left">
                                                                        <div class="form-group">
                                                                            <select class=" form-control" id="ID_LESSON_edit{{ $row -> ID_EXAM_GROUP }}" name="ID_LESSON_edit" style="width: 100%;" data-placeholder="Choose one..">
                                                                                <option></option>
                                                                                @foreach ($id_lesson as $row_id_lesson)
                                                                                    @if( $row_id_lesson ->ID_LESSON == $row->ID_LESSON)
                                                                                        <option value="{{ $row_id_lesson->ID_LESSON  }}" selected>{{$row_id_lesson->NAME_LESSON}}</option>
                                                                                    @else
                                                                                        <option value="{{ $row_id_lesson->ID_LESSON  }}">{{$row_id_lesson->NAME_LESSON}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                </div><br>

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="" class="fs-20">ชื่อชุดคำถาม <span class="text-danger">*</span></label>
                                                                    </div> 
                                                                    <div class="col-md-8 text-left" align="left">
                                                                        <input type="text" class="form-control" required id="NAME_EXAM_GROUP_edit" name="NAME_EXAM_GROUP_edit" style=" font-family: 'Kanit', sans-serif;" value="{{$row->NAME_EXAM_GROUP}}">
                                                                    </div> 
                                                                </div><br>  

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="" class="fs-20">เกณฑ์คะเเนน <span class="text-danger">*</span></label>
                                                                    </div> 
                                                                    <div class="col-md-8 text-left" align="left">
                                                                        <input type="text" class="form-control" required id="SCORE_CRITERIA_edit" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" name="SCORE_CRITERIA_edit" style=" font-family: 'Kanit', sans-serif;" value="{{$row->SCORE_CRITERIA}}">
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
                                @endforeach
                                </tbody>
                        </table><br>
                </div>
            </div>
        </div>    

    </div>
</div>
<!-- The Modal add exam_series-->
<div class="modal fade" id="add_exam_series" role="dialog" aria-labelledby="modal-block-fromleft" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-success">
                            <h2 class="block-title">เพิ่มชุดคำถาม</h2>
                        </div>
                        <div class="block-content">
                        <form  method="post" action="{{ route('save_exam_series') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="fs-20">บทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-8 text-left" align="left">
                                    <div class="form-group">
                                        <select class="js-select2 form-control" required id="ID_LESSON"  name="ID_LESSON" style="width: 100%;" data-placeholder="Choose one..">
                                            <option></option>
                                                @foreach ($id_lesson as $row)
                                                    <option value="{{$row->ID_LESSON}}"> {{$row->NAME_LESSON}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div> 
                            </div><br>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="fs-20">ชื่อชุดคำถาม <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-8 text-left" align="left">
                                    <input type="text" class="form-control"required placeholder="กรุณากรอกชื่อชุดคำถาม..." id="NAME_EXAM_GROUP" name="NAME_EXAM_GROUP" style=" font-family: 'Kanit', sans-serif;">
                                </div> 
                            </div><br>  

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="fs-20">เกณฑ์คะเเนน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-8 text-left" align="left">
                                    <input type="text" class="form-control" required id="SCORE_CRITERIA" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" placeholder="กรุณากรอกเกณฑ์คะเเนน..."name="SCORE_CRITERIA" style=" font-family: 'Kanit', sans-serif;">
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

    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>


<script>
  function readURL(input) {
    var fileInput = document.getElementById('QUESTION_IMG_EXAMP');
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
        $('#image_upload_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#QUESTION_IMG_EXAMP").change(function () {
    readURL(this);
  });
</script>

<!-- on off -->
<script>
        function switch_status(status_exams_series) {
            // alert(budget);
            var checkBox = document.getElementById(status_exams_series);
            var onoff;

            if (checkBox.checked == true) {
                onoff = "True";
            } else {
                onoff = "False";
            }
            //alert(onoff);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('switch_exams_series')}}",
                method: "GET",
                data: {
                    onoff: onoff,
                    status_exams_series: status_exams_series,
                    _token: _token
                }
            })
        }
</script>

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
   $("#ID_LESSON").select2({ 
	dropdownParent: $("#add_exam_series") 
	});
});
</script>
 @endsection




