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
            <h3 class="block-title text-center fs-24">แก้ไขคำถาม</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
        <div class="row">
                <div class="col-lg-1"></div>             
                <div class="col-lg-10">
                <form  method="post" action="{{ url('/e_learning/manage_exam/update_question/'.$info_exam->ID_EXAM)}}" enctype="multipart/form-data">
                @csrf
                    <input type="hidden"id="ID_EXAM" name="ID_EXAM" style=" font-family: 'Kanit', sans-serif;"value="{{$info_exam->ID_EXAM}}">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="fs-20">ชุดคำถาม <span class="text-danger">*</span></label>
                        </div> 
                        <div class="col-md-10 text-left" align="left">
                            <div class="form-group">
                            <select class="js-select2 form-control" id="select_edit_exam"  name="ID_EXAM_GROUP" style="width: 100%;" data-placeholder="Choose one..">
                                <option></option>
                                @foreach ($info_exam_series as $row_id_exam_group)
                                    @if( $row_id_exam_group ->ID_EXAM_GROUP == $info_exam->ID_EXAM_GROUP)
                                        <option value="{{ $row_id_exam_group->ID_EXAM_GROUP  }}" selected>{{$row_id_exam_group->NAME_EXAM_GROUP}}</option>
                                    @else
                                        <option value="{{ $row_id_exam_group->ID_EXAM_GROUP  }}">{{$row_id_exam_group->NAME_EXAM_GROUP}}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
                        </div> 
                    </div><br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="fs-20">คำถาม <span class="text-danger">*</span></label>
                        </div> 
                        <div class="col-md-10 text-left" align="left">
                            <input type="text" class="form-control"  required onkeyup="check_question()" id="QUESTION_EXAM" name="QUESTION_EXAM" style=" font-family: 'Kanit', sans-serif;" value="{{$info_exam->QUESTION_EXAM}}">
                            <div style="color: red;" id="question"></div>
                        </div> 
                    </div><br>

                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="fs-20">รูปคำถาม </label>
                        </div> 
                        <div class="col-md-8 text-secondary">
                            <div class="form-group">
                                @if($info_exam->QUESTION_IMG_EXAMP == '' || $info_exam->QUESTION_IMG_EXAMP == null)
                                <img id="image_upload_preview_edit" width="270px" height="200px" src="{{asset('image/elearning_question/exam.png') }}">
                                @else
                                <img id="image_upload_preview_edit"  width="300px" height="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_exam->QUESTION_IMG_EXAMP)) }}">
                                @endif
                            </div>
                                **ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง)
                            <div class="form-group">
                                <input style="font-family: 'Kanit', sans-serif;" type="file" name="QUESTION_IMG_EXAMP" id="QUESTION_IMG_EXAMP" class="form-control-file border">
                            </div>
                        </div> 
                    </div><br>  
                    <div align="right">
                        <br>
                        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                        <a href="{{ url('e_learning/manage_exam/detail_question/'.$info_exam->ID_EXAM_GROUP) }}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>                      
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
<!-- เช็คค่าว่างในฟอร์ม -->
<script>
    function check_question()
        {        
                name = document.getElementById("QUESTION_EXAM").value;             
                if (name==null || name==''){
                document.getElementById("question").style.display = "";     
                text_name = "*กรุณาระบุคำถาม";
                document.getElementById("question").innerHTML = text_name;
                }else{
                document.getElementById("question").style.display = "none";
                }
        }
</script>

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
            $('#image_upload_preview_edit').attr('src', e.target.result);
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
         $('#select_edit_exam').select2();
    });
</script>
 @endsection




