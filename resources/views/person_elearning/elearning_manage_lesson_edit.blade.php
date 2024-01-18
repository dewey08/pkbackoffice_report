@extends('layouts.elearning')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@section('content')
<style>
    .center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
      
        }
        .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        }
        #pages{
                text-align: center;
            }
            .page{
                width: 90%;
                margin: 10px;
                box-shadow: 0px 0px 5px #000;
                animation: pageIn 1s ease;
                transition: all 1s ease, width 0.2s ease;
            }
            @keyframes pageIn{
            0%{
                transform: translateX(-300px);
                opacity: 0;
            }
            100%{
                transform: translateX(0px);
                opacity: 1;
            }
            }
            #zoom-in{
                
            }
            #zoom-percent{
                display: inline-block;
            }
            #zoom-percent::after{
                content: "%";
            }
            #zoom-out{
                
            }
        .table-fixed tbody {
                height: 300px;
                overflow-y: auto;
                width: 100%;
            }

            .table-fixed thead,
            .table-fixed tbody,
            .table-fixed tr,
            .table-fixed td,
            .table-fixed th {
                display: block;
            }

            .table-fixed tbody td,
            .table-fixed tbody th,
            .table-fixed thead > tr > th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
</style>


<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">แก้ไขบทเรียน</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
            <div class="row">
                <br>
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <form  method="post" action="{{ route('update_lesson') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- hidden -->
                                <input type="hidden" id="ID_LESSON"  name="ID_LESSON" value="{{$info_lesson->ID_LESSON}}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">หมวดหมู่บทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-lg-4 text-left" align="left">
                                            <div class="form-group">
                                                <select class="js-select2 form-control"  id="ID_LESSON_GROUP"  name="ID_LESSON_GROUP" style="width: 100%;" data-placeholder="Choose one..">
                                                    <option></option>
                                                    @foreach ($id_lesson_group as $row)
                                                        @if( $row ->ID_LESSON_GROU == $info_lesson->ID_LESSON_GROUP)
                                                            <option value="{{ $row->ID_LESSON_GROU  }}" selected>{{$row->NAME_LESSON_GROUP}}</option>
                                                        @else
                                                            <option value="{{ $row->ID_LESSON_GROU  }}">{{$row->NAME_LESSON_GROUP}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                </div>
                                <div class="col-md-2" >
                                    <label for="" class="fs-20">ชื่อบทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" >
                                    <input type="text" class="form-control" onkeyup="check_namelesson()" required id="NAME_LESSON" name="NAME_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->NAME_LESSON}}">
                                    <div style="color: red;" id="name_lesson"></div>
                                </div>  
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">วัตถุประสงค์ <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    @if(!empty($info_lesson->OBJECTIVE_LESSON))
                                        <textarea class="form-control" rows="1" onkeyup="check_objectivelesson()" required id="OBJECTIVE_LESSON" name="OBJECTIVE_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->OBJECTIVE_LESSON}}">{{$info_lesson->OBJECTIVE_LESSON}}</textarea>
                                    @else
                                        <textarea class="form-control" rows="1" onkeyup="check_objectivelesson()" required id="OBJECTIVE_LESSON" name="OBJECTIVE_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->OBJECTIVE_LESSON}}"></textarea>
                                    @endif
                                    <div style="color: red;" id="objective_lesson"></div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="" class="fs-20">รายละเอียด <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" >
                                @if(!empty($info_lesson->DETAIL_LESSON))
                                    <textarea class="form-control" rows="1" onkeyup="check_detaillesson()"  required id="DETAIL_LESSON" name="DETAIL_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->DETAIL_LESSON}}">{{$info_lesson->DETAIL_LESSON}}</textarea>
                                @else
                                    <textarea class="form-control" rows="1" onkeyup="check_detaillesson()" required id="DETAIL_LESSON" name="DETAIL_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->DETAIL_LESSON}}"></textarea>
                                @endif
                                <div style="color: red;" id="detail_lesson"></div>
                                </div> 
                            </div><br>  

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">ชื่อผู้สอน </label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    <input type="text" class="form-control" id="TEACH_LESSON" name="TEACH_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->TEACH_LESSON}}">
                                </div> 
                                <div class="col-md-2">
                                    <label for="" class="fs-20">เวลาในการเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    <input type="text" class="form-control" onkeyup="check_timelesson()" required id="TIME_LESSON" name="TIME_LESSON" style=" font-family: 'Kanit', sans-serif;" value="{{$info_lesson->TIME_LESSON}}">
                                    <div style="color: red;" id="time_lesson"></div>
                                </div> 
                            </div><br> 
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">ภาพปกบทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                    @if($info_lesson->IMG_LESSON == '' || $info_lesson->IMG_LESSON == null)
                                    <img id="image_upload_preview_lesson" width="300px" height="200px" src="{{asset('image/elearning_question/learning.png') }}">
                                    @else
                                    <img id="image_upload_preview_lesson"  width="300px" height="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_lesson->IMG_LESSON)) }}">
                                    @endif
                                    </div>
                                    **ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง)
                                    <div class="form-group">
                                    <input style="font-family: 'Kanit', sans-serif;" type="file"  name="picture_edit" id="picture_edit" class="form-control-file border">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="fs-20">รูปผู้สอน </label>
                                </div> 
                                <div class="col-md-4 text-secondary">
                                    <div class="form-group">
                                    @if($info_lesson->TEACH_IMG_LESSON == '' || $info_lesson->TEACH_IMG_LESSON == null)
                                    <img id="image_upload_preview_edit" width="270px" height="200px" src="{{asset('image/elearning_question/teach.jpg') }}">
                                    @else
                                    <img id="image_upload_preview_edit"  width="270px" height="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_lesson->TEACH_IMG_LESSON)) }}">
                                    @endif
                                    </div>
                                   **ขนาดภาพแนะนำ 400 * 300 พิกเซล*(กว้างxสูง)
                                    <div class="form-group">
                                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="TEACH_IMG_LESSON_edit" id="TEACH_IMG_LESSON_edit" class="form-control-file border">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">วิดีโอ <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-10 text-left text-secondary" align="left">
                                    <div class="form-group">
                                        <video src="{{ asset('storage/lesson_video/'.$info_lesson->VIDEO_LESSON) }}" id="preview_video_edit" controls  width="400px" height="300px"></video>
                                    </div>
                                    **ขนาดไฟล์วิดีโอแนะนำไม่เกิน 100 MB
                                    <div class="form-group">
                                        <input type="file"  class="form-control-file border"  name="upvideo_edit" id="upvideo_edit" accept="video/*" style=" font-family: 'Kanit', sans-serif;">
                                    </div>
                                </div> 
                            </div><br>
                            
                        

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">เอกสารประกอบ </label><br> 
                                </div> 
                                <div class="col-md-10 text-left text-secondary" align="left">
                                    **ขนาดไฟล์ pdf แนะนำไม่เกิน 1 MB (ไฟล์นามสกุล .pdf) <br> 
                                    <input type="file" id="pdfupload" name="DOCUMENT_LESSON"  accept="application/pdf" style="width:75%;"/>
                                    <div id="zoom-percent" style="text-align: right;">90</div>
                                    <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
                                    <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
                                    <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a><br><br>
                                    <div style='overflow:scroll; width:auto;height:700px; text-align: center; background-color: #404040;' id="pages">
                                    @if($info_lesson->DOCUMENT_LESSON == '' || $info_lesson->DOCUMENT_LESSON == null)
                                        ไม่มีข้อมูลไฟล์อัปโหลด 
                                    @else
                                        <iframe src="{{ asset('storage/lesson_doc/'.$info_lesson->DOCUMENT_LESSON) }}" height="680px" width="100%"></iframe>
                                    @endif
                                    </div>
                                </div> 
                            </div><br>
                           
                       

                        <div align="right">
                                <br>
                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                        <a href="{{ url('e_learning/manage_lesson') }}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>                      
                                <br><br>
                            </div>  
                   </form>      
                </div>
            </div>
        </div>    

    </div>
</div>




@endsection

@section('footer')
<!-- เช็คข้อมูล -->
<script>
    function check_namelesson()
        {        
                name = document.getElementById("NAME_LESSON").value;             
                if (name==null || name==''){
                document.getElementById("name_lesson").style.display = "";     
                text_name = "*กรุณาระบุชื่อบทเรียน";
                document.getElementById("name_lesson").innerHTML = text_name;
                }else{
                document.getElementById("name_lesson").style.display = "none";
                }
        }

    function check_objectivelesson()
        {        
                name = document.getElementById("OBJECTIVE_LESSON").value;             
                if (name==null || name==''){
                document.getElementById("objective_lesson").style.display = "";     
                text_name = "*กรุณาระบุวัตถุประสงค์บทเรียน";
                document.getElementById("objective_lesson").innerHTML = text_name;
                }else{
                document.getElementById("objective_lesson").style.display = "none";
                }
        }

    function check_detaillesson()
        {        
                name = document.getElementById("DETAIL_LESSON").value;             
                if (name==null || name==''){
                document.getElementById("detail_lesson").style.display = "";     
                text_name = "*กรุณาระบุรายละเอียดบทเรียน";
                document.getElementById("detail_lesson").innerHTML = text_name;
                }else{
                document.getElementById("detail_lesson").style.display = "none";
                }
        }

    function check_timelesson()
        {        
                name = document.getElementById("TIME_LESSON").value;             
                if (name==null || name==''){
                document.getElementById("time_lesson").style.display = "";     
                text_name = "*กรุณาระบุเวลาในการเรียน";
                document.getElementById("time_lesson").innerHTML = text_name;
                }else{
                document.getElementById("time_lesson").style.display = "none";
                }
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>
<script>
//---------------------------------------------------------------------------------
pdfjsLib.GlobalWorkerOptions.workerSrc =
"{{ asset('pdfupload/pdf_upwork.js') }}";

  document.querySelector("#pdfupload").addEventListener("change", function(e){
  document.querySelector("#pages").innerHTML = "";

	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		alert(file.name + " is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);
    
		pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has", pdf.numPages, "page(s).");
      for (var i = 0; i < pdf.numPages; i++) {
        (function(pageNum){
        pdf.getPage(i+1).then(function(page) {
          // you can now use *page* here
          var viewport = page.getViewport(2.0);
          var pageNumDiv = document.createElement("div");
          pageNumDiv.className = "pageNumber";
          pageNumDiv.innerHTML = "Page " + pageNum;
          var canvas = document.createElement("canvas");
          canvas.className = "page";
          canvas.title = "Page " + pageNum;
          document.querySelector("#pages").appendChild(pageNumDiv);
          document.querySelector("#pages").appendChild(canvas);
          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: canvas.getContext('2d'),
            viewport: viewport
          }).promise.then(function(){
            console.log('Page rendered');
          });
          page.getTextContent().then(function(text){
              console.log(text);
          });
        });
        })(i+1);
      }

		});
	};
 
	fileReader.readAsArrayBuffer(file);
   

});
</script>
<script>
  function readURL_lesson(input) {
    var fileInput = document.getElementById('picture_edit');
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
        $('#image_upload_preview_lesson').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#picture_edit").change(function () {
    readURL_lesson(this);
  });
</script>
<script>
  function readURL_edit(input) {
    var fileInput = document.getElementById('TEACH_IMG_LESSON_edit');
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
  $("#TEACH_IMG_LESSON_edit").change(function () {
    readURL_edit(this);
  });
</script>


<script>  
    $(document).ready(function () {
         $('#ID_LESSON_GROUP').select2();
    });

</script>

<script type="text/javascript" >
$(function () {
    $("#upvideo_edit").on("change",function(){
    var file = this.files[0]; // เก็บค่าเป็น  flistlist object
    var video_type = file.type; // ตรวจสอบประเภท video
    var video_canplay=$("#preview_video_edit")[0].canPlayType(video_type);
    // ถ้าสามารถแสดงได้
        if(video_canplay){// กำหนด url object อ้างอิงขึ้นกับ browservar URL = window.URL || window.webkitURL;var fileURL = URL.createObjectURL(file); // สร้าง url object$("#preview_video")[0].src = fileURL;  // แสดง video จาก url 
            var URL = window.URL || window.webkitURL;
            var fileURL = URL.createObjectURL(file); // สร้าง url object
            $("#preview_video_edit")[0].src = fileURL;
        }else{
            // can't play
        } 
    });
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

 @endsection




