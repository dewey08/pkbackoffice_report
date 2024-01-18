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
            <h3 class="block-title text-center fs-24">ชุดคำถาม : {{ $info_exam_series ->NAME_EXAM_GROUP}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
        <div class="row">
            <div class="col-md-12" align="right">
            <a href="{{ url('e_learning/manage_exam')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen"  ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>
        </div>
        <br>
        <div class="row">
                <div class="col-lg-1"></div>             
                <div class="col-lg-10">
      
                </div>
                <div class="col-lg-1"></div>
            </div>
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
                <div class="col-lg-2"></div>
                <div class="col-lg-8" align="right">
                        <button type="button" class="btn btn-outline-info mr-1 mb-3 text"  data-toggle="modal" data-target="#add_exam">
                         <i class="fa fa-fw fa-plus mr-1"></i>เพิ่มคำถาม 
                        </button>    
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row">
                <br>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12"><br>
                                <table class="table table-bordered table-hover  table-vcenter js-dataTable-full text-center">
                                <thead class=" table-warning">
                                            <tr>
                                                <th  width="5%"><span style="font-size: 14px;">ลำดับ</span</th>
                                                <th width="25%"><span style="font-size: 14px;">รูปคำถาม</span</th>
                                                <th><span style="font-size: 14px;">คำถาม</span</th>
                                                <th width="15%"><span style="font-size: 14px;">เปิดใช้</span</th>
                                                <th width="15%"><span style="font-size: 14px;">คำสั่ง</span</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php $number = 0; ?>
                                @foreach ($info_exam as $row)
                                    <?php $number++; ?>
                                            <tr>
                                                <td class=""><span style="font-size: 14px;">{{$number}}</span</td>
                                                @if($row->QUESTION_IMG_EXAMP == ' ' || $row->QUESTION_IMG_EXAMP == null )
                                                    <td></td>
                                                @else
                                                    <td class=""><img  width="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->QUESTION_IMG_EXAMP)) }}"></td>
                                                @endif
                                                <td class="" align="left"><span style="font-size: 14px;">{{ $row ->QUESTION_EXAM}}</span</td>
                                                <td align="center" width="10%">
                                                    <div class="custom-control custom-switch custom-control-lg ">
                                                        @if($row-> ACTIVE_EXAM == 'True' )
                                                            <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_EXAM }}" name="{{ $row-> ID_EXAM }}" onchange="switch_status({{ $row-> ID_EXAM }});" checked>
                                                        @else
                                                            <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_EXAM }}" name="{{ $row-> ID_EXAM }}" onchange="switch_status({{ $row-> ID_EXAM }});">
                                                        @endif
                                                            <label class="custom-control-label" for="{{ $row-> ID_EXAM }}"></label>
                                                    </div>
                                                </td>
                                                <td >
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-info dropdown-toggle foo13" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                                ทำรายการ
                                                        </button>
                                                            <div class="dropdown-menu foo13" style="width:15px">
                                                                <a class="dropdown-item loadscreen"  href="{{ url('/e_learning/manage_exam/detail_choice/'.$row->ID_EXAM)}}">รายละเอียด</a>
                                                                <a class="dropdown-item loadscreen"  href="{{ url('/e_learning/manage_exam/edit_question/'.$row->ID_EXAM)}}" >แก้ไขข้อมูล</a>
                                                            </div>
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

    </div>
</div>



<!-- The Modal add exam-->
<div class="modal fade" id="add_exam" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-success">
                            <h2 class="block-title">เพิ่มคำถาม</h2>
                        </div>
                        <div class="block-content">
                        <form  method="post" action="{{ url('e_learning/manage_exam/save_question/'.$info_exam_series ->ID_EXAM_GROUP) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">ชุดคำถาม <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-10 text-left" align="left">
                                    <div class="form-group">
                                        <input type="hidden" id="ID_EXAM_GROUP"  name="ID_EXAM_GROUP" value="{{$info_exam_series ->ID_EXAM_GROUP}}">
                                        <input type="text" class="form-control"   style=" font-family: 'Kanit', sans-serif;" value="{{$info_exam_series ->NAME_EXAM_GROUP}}" disabled>
                                    </div>
                                </div> 
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">คำถาม <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-10 text-left" align="left">
                                    <input type="text" class="form-control" required placeholder="กรุณากรอกคำถาม..." id="QUESTION_EXAM" name="QUESTION_EXAM" style=" font-family: 'Kanit', sans-serif;">
                                </div> 
                            </div><br>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">รูปคำถาม </label>
                                </div> 
                                <div class="col-md-8 text-secondary">
                                    <div class="form-group">
                                        <img id="image_upload_preview"  width="270px" height="200px" src="{{asset('image/elearning_question/exam.png') }}">
                                    </div>
                                   **ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง)
                                    <div class="form-group">
                                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="QUESTION_IMG_EXAMP" id="QUESTION_IMG_EXAMP" class="form-control-file border">
                                    </div>
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
<script>
  function readURL_edit(input) {
    var fileInput = document.getElementById('QUESTION_IMG_EXAMP');
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
  $("#QUESTION_IMG_EXAMP").change(function () {
    readURL_edit(this);
  });
</script>

<!-- on off -->
<script>
        function switch_status(status_exam) {
            // alert(budget);
            var checkBox = document.getElementById(status_exam);
            var onoff;

            if (checkBox.checked == true) {
                onoff = "True";
            } else {
                onoff = "False";
            }
            //alert(onoff);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('switch_exams_question')}}",
                method: "GET",
                data: {
                    onoff: onoff,
                    status_exam: status_exam,
                    _token: _token
                }
            })
        }
</script>


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

    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>


<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>  

$(document).ready(function () {
         $('#select_add_exam').select2();
    });
</script>
 @endsection




